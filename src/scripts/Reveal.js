/**
 * Motor de movimiento del tema.
 *
 * Dos sistemas conviven a propósito, sin mezclarse:
 *
 *   1. [data-reveal] — el original, motion-cut, intacto. Lo sigue
 *      usando el resto del sitio (servicios, nosotros, contacto...).
 *      IntersectionObserver + una clase, con desfase numérico
 *      opcional: <div data-reveal>  ·  <div data-reveal="80">
 *
 *   2. .sdn-reveal-* / .sdn-wipe / [data-count-to] — el sistema nuevo,
 *      que hoy solo usa home-template.php. Regla de oro que evita el
 *      bug de la versión anterior de este archivo: el elemento que el
 *      observer vigila NUNCA lleva clip-path. Si algo se recorta para
 *      revelarse (.sdn-wipe), el recorte vive en un HIJO
 *      (.sdn-wipe__img) y la clase de estado (.is-visible) se pone en
 *      el PADRE — que el observer sí puede medir. Un elemento
 *      recortado a cero mide área cero, y un observer nunca dispara
 *      para eso; separar quién se mide de quién se recorta es lo que
 *      lo vuelve seguro.
 *
 * Además: contador numérico, parallax ligado al scroll, botones
 * magnéticos y tarjetas con inclinación 3D — todo apagado con
 * prefers-reduced-motion.
 */

const REDUCED = window.matchMedia("(prefers-reduced-motion: reduce)").matches

export default function initReveal() {
  initLegacyReveal()
  initScrollRevealV2()
  initParallax()
  initMagnetic()
  initTilt()
}

/* ── 1 · Revelado original — sin cambios de comportamiento ───── */

function initLegacyReveal() {
  const nodes = document.querySelectorAll("[data-reveal]")
  if (!nodes.length) return

  if (REDUCED || !("IntersectionObserver" in window)) {
    nodes.forEach((n) => n.classList.add("is-revealed"))
    return
  }

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return
        const delay = Number(entry.target.dataset.reveal) || 0
        window.setTimeout(() => entry.target.classList.add("is-revealed"), delay)
        io.unobserve(entry.target)
      })
    },
    { rootMargin: "0px 0px -12% 0px", threshold: 0.08 }
  )

  nodes.forEach((n) => io.observe(n))
}

/* ── 2 · Revelado nuevo (home) ────────────────────────────────── */

function initScrollRevealV2() {
  const selector = ".sdn-reveal-up, .sdn-reveal-left, .sdn-reveal-right, .sdn-reveal-stagger, .sdn-reveal-scale, .sdn-wipe, [data-count-to]"
  const nodes = Array.from(document.querySelectorAll(selector))
  if (!nodes.length) return

  // Escalonado: cada hijo directo de [data-reveal-group] recibe su
  // propio índice antes de que nada se revele.
  document.querySelectorAll("[data-reveal-group]").forEach((group) => {
    Array.from(group.children).forEach((child, i) => {
      if (child.classList.contains("sdn-reveal-stagger")) {
        child.style.setProperty("--i", String(i))
      }
    })
  })

  const reveal = (el) => {
    el.classList.add("is-visible")
    if (el.hasAttribute("data-count-to")) runCount(el)
  }

  if (REDUCED || !("IntersectionObserver" in window)) {
    nodes.forEach(reveal)
    return
  }

  const pending = new Set(nodes)

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return
        io.unobserve(entry.target)
        pending.delete(entry.target)
        reveal(entry.target)
      })
    },
    { rootMargin: "0px 0px -8% 0px", threshold: 0.1 }
  )
  nodes.forEach((n) => io.observe(n))

  /* Red de seguridad: lo que ya está en pantalla (o por encima) al
     cargar se revela sin esperar al observer, y un repaso ligado al
     scroll recoge cualquier cosa que no dispare — hasta que no queda
     nada pendiente, momento en que se desconecta solo. */
  const sweep = () => {
    const vh = window.innerHeight
    Array.from(pending).forEach((n) => {
      if (n.getBoundingClientRect().top < vh * 0.95) {
        io.unobserve(n)
        pending.delete(n)
        reveal(n)
      }
    })
    if (!pending.size) window.removeEventListener("scroll", onSweep)
  }
  const onSweep = () => window.requestAnimationFrame(sweep)

  window.addEventListener("scroll", onSweep, { passive: true })
  window.addEventListener("resize", onSweep, { passive: true })
  window.requestAnimationFrame(sweep)
}

/* ── Contador ──────────────────────────────────────────────── */

function runCount(el) {
  if (el.dataset.countDone === "1") return
  el.dataset.countDone = "1"

  const value = Number(el.dataset.countTo) || 0
  const settle = () => (el.textContent = String(value))

  if (REDUCED || value <= 0 || !("requestAnimationFrame" in window)) {
    settle()
    return
  }

  const dur = 1200
  const t0 = performance.now()
  const tick = (now) => {
    const t = Math.min(1, (now - t0) / dur)
    const eased = 1 - Math.pow(1 - t, 3)
    el.textContent = String(Math.round(eased * value))
    if (t < 1) window.requestAnimationFrame(tick)
    else settle()
  }
  window.requestAnimationFrame(tick)
}

/* ── Bucle de scroll compartido (parallax) ────────────────────── */

function rafGate() {
  let queued = false
  return (fn) => {
    if (queued) return
    queued = true
    window.requestAnimationFrame((now) => {
      queued = false
      fn(now)
    })
  }
}

function initParallax() {
  if (REDUCED || !("IntersectionObserver" in window)) return

  const nodes = document.querySelectorAll("[data-sdn-parallax]")
  if (!nodes.length) return

  const gate = rafGate()
  const visible = new Set()

  const update = () => {
    const vh = window.innerHeight
    const measures = []
    // Lectura primero, escritura después: sin reflows intercalados.
    visible.forEach((n) => {
      const r = n.getBoundingClientRect()
      measures.push({
        n,
        mid: r.top + r.height / 2,
        speed: Number(n.dataset.sdnParallax) || 0.1,
        scale: Number(n.dataset.sdnParallaxScale) || 1,
      })
    })
    for (const m of measures) {
      const raw = (m.mid - vh / 2) * -m.speed
      const off = Math.max(-30, Math.min(30, raw))
      m.n.style.transform = `translate3d(0, ${off.toFixed(2)}px, 0) scale(${m.scale})`
    }
  }
  const onScroll = () => gate(update)

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((e) => (e.isIntersecting ? visible.add(e.target) : visible.delete(e.target)))
      gate(update)
    },
    { rootMargin: "25% 0px 25% 0px" }
  )
  nodes.forEach((n) => {
    n.style.willChange = "transform"
    io.observe(n)
  })

  window.addEventListener("scroll", onScroll, { passive: true })
  window.addEventListener("resize", onScroll, { passive: true })
  update()
}

/* ── Botones magnéticos ───────────────────────────────────────── */

function initMagnetic() {
  if (REDUCED) return
  document.querySelectorAll(".sdn-magnetic").forEach((btn) => {
    btn.addEventListener("mousemove", (e) => {
      const r = btn.getBoundingClientRect()
      const x = (e.clientX - r.left - r.width / 2) * 0.3
      const y = (e.clientY - r.top - r.height / 2) * 0.3
      btn.style.transform = `translate(${x.toFixed(1)}px, ${y.toFixed(1)}px)`
    })
    btn.addEventListener("mouseleave", () => {
      btn.style.transform = ""
    })
  })
}

/* ── Tarjetas con inclinación 3D ──────────────────────────────── */

function initTilt() {
  if (REDUCED) return
  document.querySelectorAll(".sdn-tilt").forEach((card) => {
    card.addEventListener("mousemove", (e) => {
      const r = card.getBoundingClientRect()
      const px = (e.clientX - r.left) / r.width - 0.5
      const py = (e.clientY - r.top) / r.height - 0.5
      card.style.transform = `perspective(700px) rotateX(${(-py * 5).toFixed(2)}deg) rotateY(${(px * 5).toFixed(2)}deg)`
    })
    card.addEventListener("mouseleave", () => {
      card.style.transform = "perspective(700px) rotateX(0) rotateY(0)"
    })
  })
}
