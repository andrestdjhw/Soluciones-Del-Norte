/**
 * Fondo animado del hero — FinisherHeader.
 *
 * El script no viene en el repositorio: hay que descargar
 * `finisher-header.es5.min.js` desde https://www.finisher.co/lab/header/
 * y dejarlo en `assets/` del tema. functions.php lo encola solo si el
 * archivo existe, así que mientras no esté, el hero usa la reserva en CSS
 * y no se rompe nada.
 *
 * Configuración: la que Daniel generó en el laboratorio, con dos cambios
 * deliberados:
 *   · skew 0 — el corte inclinado lo hace el clip-path de `.sdn-hero`,
 *     para que se vea igual con script y sin él. Dos skews se suman.
 *   · sin movimiento si el visitante pide movimiento reducido.
 *
 * Los hex están escritos aquí porque el script no entiende `oklch()`.
 * Son los mismos valores de marca que hay en los tokens de index.css:
 * cambiar uno obliga a cambiar el otro.
 */

const CONFIG = {
  count: 10,
  size: { min: 1300, max: 1500, pulse: 0 },
  speed: { x: { min: 0.1, max: 0.6 }, y: { min: 0.1, max: 0.6 } },
  colors: {
    background: "#292d58", // Space Indigo  → --color-deep
    particles: [
      "#1581aa", // Cerulean    → --color-brand-cerulean
      "#1d1816", // Coffee Bean → --color-ink
      "#c2c7c7", // Silver      → --color-rule
    ],
  },
  blending: "overlay",
  opacity: { center: 0.5, edge: 0.05 },
  skew: 0,
  shapes: ["c"],
}

export default function initHeroFinisher() {
  const hero = document.querySelector(".sdn-hero")
  if (!hero) return

  if (window.matchMedia("(prefers-reduced-motion: reduce)").matches) return
  if (typeof window.FinisherHeader !== "function") return

  try {
    hero.classList.add("finisher-header", "is-finisher")
    new window.FinisherHeader(CONFIG)
  } catch (err) {
    // Si el script falla, volvemos a la reserva en CSS.
    hero.classList.remove("finisher-header", "is-finisher")
    console.error("[heroFinisher]", err)
  }
}