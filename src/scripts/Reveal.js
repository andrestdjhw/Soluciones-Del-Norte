/**
 * Revelado de secciones al entrar en viewport.
 * Sin librería: el proyecto es motion-cut, así que esto es
 * IntersectionObserver + dos clases. Una sola vez por elemento.
 *
 * Uso en las plantillas:  <div data-reveal>  ·  <div data-reveal="80">
 * El valor opcional es el desfase en milisegundos.
 */

export default function initReveal() {
  const nodes = document.querySelectorAll("[data-reveal]")
  if (!nodes.length) return

  const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches

  // Sin IntersectionObserver o con movimiento reducido: estado final directo.
  if (reduced || !("IntersectionObserver" in window)) {
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