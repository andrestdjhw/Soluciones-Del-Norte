/**
 * Paso activo en la sección "Etapas" de las páginas de servicio —
 * mismo mecanismo de scrollytelling que ecconstructioninc.com/#how-we-work
 * (rail de texto fijo a la izquierda con contador y barra de progreso,
 * columna de pasos a la derecha, el paso que cruza el centro de la
 * ventana se resalta con una línea que se va rellenando). Pedido
 * explícito del cliente, tomado como referencia de mecánica de
 * interacción — los colores, la tipografía y el resto del tratamiento
 * visual son los de este sitio, no los de la referencia.
 *
 * IntersectionObserver con una banda angosta en el centro de la
 * ventana, no un listener de scroll recalculando en cada frame: el
 * proyecto ya pagó el costo de esa lección (ver el comentario de
 * rendimiento de `.sdn-grid` en index.css) y esto sigue la misma
 * regla — el estado cambia solo cuando un paso cruza la banda, no en
 * cada pixel de scroll.
 *
 * Uso en las plantillas:
 *   <div data-sdn-steps-bar style="width:25%">…</div>   (dentro de la sección)
 *   <span data-sdn-steps-current>01</span>
 *   <div data-sdn-steps>
 *     <article data-sdn-step>
 *       <span data-sdn-step-line data-active="false"></span>  (opcional, no en el primero)
 *       <p data-sdn-step-num data-active="true">1.0</p>
 *       …
 *     </article>
 *     …
 *   </div>
 *
 * El primer paso ya lleva `data-active="true"` desde PHP: sin este
 * módulo (JS desactivado, IntersectionObserver ausente) la sección se
 * ve completa e igual de legible, solo sin el resaltado que se mueve.
 */

export default function initSteps() {
  const containers = document.querySelectorAll("[data-sdn-steps]")
  if (!containers.length) return
  if (!("IntersectionObserver" in window)) return

  containers.forEach(setUpContainer)
}

function setUpContainer(container) {
  const steps = Array.from(container.querySelectorAll("[data-sdn-step]"))
  if (!steps.length) return

  const section = container.closest("section")
  const bar = section && section.querySelector("[data-sdn-steps-bar]")
  const counter = section && section.querySelector("[data-sdn-steps-current]")
  const total = steps.length

  const setActive = (index) => {
    steps.forEach((step, i) => {
      const num = step.querySelector("[data-sdn-step-num]")
      const line = step.querySelector("[data-sdn-step-line]")
      if (num) num.dataset.active = i === index ? "true" : "false"
      if (line) line.dataset.active = i <= index ? "true" : "false"
    })
    if (bar) bar.style.width = `${((index + 1) / total) * 100}%`
    if (counter) counter.textContent = String(index + 1).padStart(2, "0")
  }

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return
        const index = steps.indexOf(entry.target)
        if (index !== -1) setActive(index)
      })
    },
    { rootMargin: "-45% 0px -45% 0px", threshold: 0 }
  )

  steps.forEach((step) => io.observe(step))
}
