/**
 * Fondo en video para superficies .sdn-surface.
 *
 * El `src` no va en el HTML: lo pone este módulo cuando la sección
 * se acerca al viewport. Así el MP4 no se descarga en la primera
 * carga de la home, ni se descarga nunca si el visitante pide
 * movimiento reducido.
 *
 * El mismo observador pausa el video al salir de pantalla: un bucle
 * reproduciéndose fuera de vista solo gasta batería.
 *
 * Uso en las plantillas:
 *   <video class="sdn-video" data-sdn-video data-src="…" poster="…"
 *          muted loop playsinline preload="none" aria-hidden="true"></video>
 */

export default function initVideoBg() {
  const videos = document.querySelectorAll("video[data-sdn-video]")
  if (!videos.length) return

  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return

  videos.forEach((video) => {
    if (!video.dataset.src) return

    // El atributo `muted` del HTML basta, pero algunos navegadores
    // solo respetan la propiedad para el autoplay programático.
    video.muted = true

    video.addEventListener(
      "playing",
      () => video.classList.add("is-playing"),
      { once: true }
    )

    const start = () => {
      if (!video.src) {
        video.src = video.dataset.src
        video.load()
      }
      // En modo de bajo consumo el navegador rechaza la promesa:
      // el póster se queda puesto y no hay nada que arreglar.
      video.play()?.catch(() => {})
    }

    if (!("IntersectionObserver" in window)) {
      start()
      return
    }

    const io = new IntersectionObserver(
      (entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) start()
          else if (!video.paused) video.pause()
        })
      },
      { rootMargin: "200px 0px" }
    )

    io.observe(video)
  })
}