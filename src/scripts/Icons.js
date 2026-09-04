import React from "react"

/**
 * Iconos SVG en línea. Sin librería externa: son seis trazos y no
 * justifican añadir una dependencia al bundle.
 * Todos heredan el color del texto (currentColor) y el tamaño se
 * controla con clases de Tailwind desde el componente que los usa.
 */

const base = {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24",
  fill: "none",
  stroke: "currentColor",
  strokeWidth: 1.6,
  strokeLinecap: "round",
  strokeLinejoin: "round",
  "aria-hidden": "true",
  focusable: "false",
}

export function PhoneIcon(props) {
  return (
    <svg {...base} {...props}>
      <path d="M6.5 3h3l1.5 4-2 1.4a12 12 0 0 0 5.6 5.6L16 12l4 1.5v3a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 3.5 5.2 2 2 0 0 1 5.5 3Z" />
    </svg>
  )
}

export function MailIcon(props) {
  return (
    <svg {...base} {...props}>
      <rect x="2.5" y="4.5" width="19" height="15" rx="1.5" />
      <path d="m3 6 9 6.5L21 6" />
    </svg>
  )
}

export function PinIcon(props) {
  return (
    <svg {...base} {...props}>
      <path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z" />
      <circle cx="12" cy="10" r="2.6" />
    </svg>
  )
}

export function ChevronIcon(props) {
  return (
    <svg {...base} {...props}>
      <path d="m6 9 6 6 6-6" />
    </svg>
  )
}

export function ArrowIcon(props) {
  return (
    <svg {...base} {...props}>
      <path d="M4 12h15" />
      <path d="m13 6 6 6-6 6" />
    </svg>
  )
}

export function ChatIcon(props) {
  return (
    <svg {...base} {...props}>
      <path d="M20.5 12.2c0 4-3.8 7.2-8.5 7.2a9.8 9.8 0 0 1-2.6-.35L4.5 20.5l1.35-3.9A6.9 6.9 0 0 1 3.5 12.2C3.5 8.2 7.3 5 12 5s8.5 3.2 8.5 7.2Z" />
    </svg>
  )
}

export function CloseIcon(props) {
  return (
    <svg {...base} {...props}>
      <path d="m6 6 12 12M18 6 6 18" />
    </svg>
  )
}

export function BackIcon(props) {
  return (
    <svg {...base} {...props}>
      <path d="M20 12H5" />
      <path d="m11 6-6 6 6 6" />
    </svg>
  )
}

/* Las marcas van en relleno sólido, no en trazo: así se leen a 16 px. */
const brand = {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24",
  fill: "currentColor",
  "aria-hidden": "true",
  focusable: "false",
}

export function FacebookIcon(props) {
  return (
    <svg {...brand} {...props}>
      <path d="M13.5 21v-7.6h2.6l.4-3h-3V8.5c0-.9.25-1.5 1.5-1.5H16.6V4.3A20 20 0 0 0 14.3 4.2c-2.3 0-3.9 1.4-3.9 4v2.2H7.8v3h2.6V21h3.1Z" />
    </svg>
  )
}

export function InstagramIcon(props) {
  return (
    <svg {...brand} {...props}>
      <path d="M12 4.6c2.4 0 2.7 0 3.6.05.9.04 1.4.2 1.7.32.43.17.74.37 1.06.7.33.32.53.63.7 1.06.12.3.28.8.32 1.7.05.9.05 1.2.05 3.6s0 2.7-.05 3.6c-.04.9-.2 1.4-.32 1.7-.17.43-.37.74-.7 1.06-.32.33-.63.53-1.06.7-.3.12-.8.28-1.7.32-.9.05-1.2.05-3.6.05s-2.7 0-3.6-.05c-.9-.04-1.4-.2-1.7-.32a2.9 2.9 0 0 1-1.06-.7 2.9 2.9 0 0 1-.7-1.06c-.12-.3-.28-.8-.32-1.7C4.6 14.7 4.6 14.4 4.6 12s0-2.7.05-3.6c.04-.9.2-1.4.32-1.7.17-.43.37-.74.7-1.06a2.9 2.9 0 0 1 1.06-.7c.3-.12.8-.28 1.7-.32.9-.05 1.2-.05 3.6-.05Zm0 4a3.4 3.4 0 1 0 0 6.8 3.4 3.4 0 0 0 0-6.8Zm0 5.6a2.2 2.2 0 1 1 0-4.4 2.2 2.2 0 0 1 0 4.4Zm4.35-5.74a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0Z" />
    </svg>
  )
}

export function TikTokIcon(props) {
  return (
    <svg {...brand} {...props}>
      <path d="M16.1 3h-2.7v11.4a2.1 2.1 0 1 1-1.75-2.07V9.6a4.9 4.9 0 1 0 4.45 4.88V9.06a5.9 5.9 0 0 0 3.4 1.07V7.4a3.3 3.3 0 0 1-3.4-3.2V3Z" />
    </svg>
  )
}

/* Marca de Google (la "G" oficial, en un solo trazo para que herede
   currentColor como las demás). Enlaza al perfil de Google Business.
   El viewBox lleva margen extra: el glifo llena su lienzo de borde a
   borde y sin ese aire se veía más grande que Facebook o Instagram. */
export function GoogleIcon(props) {
  return (
    <svg {...brand} {...props} viewBox="-7 -7 38 38">
      <path d="M12.48 10.92v3.28h7.84c-.24 1.84-.853 3.187-1.787 4.133-1.147 1.147-2.933 2.4-6.053 2.4-4.827 0-8.6-3.893-8.6-8.72s3.773-8.72 8.6-8.72c2.6 0 4.507 1.027 5.907 2.347l2.307-2.307C18.747 1.44 16.133 0 12.48 0 5.867 0 .307 5.387.307 12s5.56 12 12.173 12c3.573 0 6.267-1.173 8.373-3.36 2.16-2.16 2.84-5.213 2.84-7.667 0-.76-.053-1.467-.173-2.053H12.48z" />
    </svg>
  )
}

/* ── Banderas del selector de idioma ─────────────────────────────
   Dibujos propios y simplificados (franjas y formas geométricas,
   sin el escudo nacional ni ningún emblema con derechos), recortados
   en círculo. Llevan su propio color de relleno — no heredan
   currentColor como los íconos de trazo de arriba. */

export function FlagUSIcon(props) {
  return (
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false" {...props}>
      <defs>
        <clipPath id="sdn-flag-us"><circle cx="12" cy="12" r="11" /></clipPath>
      </defs>
      <g clipPath="url(#sdn-flag-us)">
        <rect x="1" y="1" width="22" height="22" fill="#fff" />
        <g fill="#b22234">
          <rect x="1" y="1" width="22" height="1.7" />
          <rect x="1" y="4.4" width="22" height="1.7" />
          <rect x="1" y="7.8" width="22" height="1.7" />
          <rect x="1" y="11.15" width="22" height="1.7" />
          <rect x="1" y="14.5" width="22" height="1.7" />
          <rect x="1" y="17.9" width="22" height="1.7" />
          <rect x="1" y="21.3" width="22" height="1.7" />
        </g>
        <rect x="1" y="1" width="10" height="11.9" fill="#3c3b6e" />
      </g>
      <circle cx="12" cy="12" r="11" fill="none" stroke="rgba(0,0,0,.14)" />
    </svg>
  )
}

export function FlagMXIcon(props) {
  return (
    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" aria-hidden="true" focusable="false" {...props}>
      <defs>
        <clipPath id="sdn-flag-mx"><circle cx="12" cy="12" r="11" /></clipPath>
      </defs>
      <g clipPath="url(#sdn-flag-mx)">
        <rect x="1" y="1" width="7.33" height="22" fill="#006847" />
        <rect x="8.33" y="1" width="7.33" height="22" fill="#fff" />
        <rect x="15.66" y="1" width="7.34" height="22" fill="#ce1126" />
        <circle cx="12" cy="12" r="2.1" fill="none" stroke="#8a6d3b" strokeWidth="1" />
      </g>
      <circle cx="12" cy="12" r="11" fill="none" stroke="rgba(0,0,0,.14)" />
    </svg>
  )
}