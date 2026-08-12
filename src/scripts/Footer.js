import React from "react"
import {
  PhoneIcon, MailIcon, PinIcon, ArrowIcon,
  FacebookIcon, InstagramIcon, TikTokIcon,
} from "./icons"

/* ─────────────────────────────────────────────────────────────
   Footer · arquetipo Ft1 (Mast headed)
   Una sola banda en Space Indigo: marca y tagline anclan la
   izquierda, cuatro bloques de datos la derecha, y una línea de
   cierre debajo de la regla.
   Deliberadamente NO lleva cuatro columnas de enlaces de servicio:
   ese sitemap ya vive en el mega-menú, que es donde se busca.
   ───────────────────────────────────────────────────────────── */

const DEFAULTS = {
  logoWhite: "/wp-content/uploads/2026/08/logo-blanco.png",
  phone1: "971-477-8337",
  phone2: "971-471-2600",
  email: "Admin@solucionesnorte.com",
  address: "1915 NE Stucki Ave, Suite 400, Hillsboro, OR 97006",
  mapUrl:
    "https://maps.google.com/?q=1915%20NE%20Stucki%20Ave%20Suite%20400%20Hillsboro%20OR%2097006",
  facebook: "https://facebook.com/solucionesdelnorte",
  instagram: "https://instagram.com/solucionesdelnorte",
  tiktok: "https://tiktok.com/@solucionesdelnorte",
  agencyUrl: "https://828marketingsolutions.com",
  lang: "es",
}

const COPY = {
  es: {
    logoAlt: "Soluciones del Norte",
    tagline:
      "Nómina, contabilidad, impuestos y documentos para negocios de Oregon y Washington.",
    social: "Redes sociales",
    labelPhone: "Teléfono",
    labelEmail: "Correo",
    labelOffice: "Oficina",
    labelHours: "Horario",
    hours: "Lunes a viernes, 10:00–14:00",
    hoursNote: "Cerrado fines de semana y días festivos.",
    directions: "Cómo llegar",
    navLabel: "Enlaces del pie",
    links: [
      { href: "/servicios", label: "Servicios" },
      { href: "/nosotros", label: "Nosotros" },
      { href: "/contacto", label: "Contacto" },
      { href: "/aviso-de-privacidad", label: "Aviso de privacidad" },
    ],
    rights: "Todos los derechos reservados.",
    credit: "Sitio por",
  },
  en: {
    logoAlt: "Soluciones del Norte",
    tagline:
      "Payroll, bookkeeping, taxes and documents for Oregon and Washington businesses.",
    social: "Social media",
    labelPhone: "Phone",
    labelEmail: "Email",
    labelOffice: "Office",
    labelHours: "Hours",
    hours: "Monday to Friday, 10:00–14:00",
    hoursNote: "Closed weekends and holidays.",
    directions: "Getting here",
    navLabel: "Footer links",
    links: [
      { href: "/en/services", label: "Services" },
      { href: "/en/about", label: "About" },
      { href: "/en/contact", label: "Contact" },
      { href: "/en/privacy", label: "Privacy notice" },
    ],
    rights: "All rights reserved.",
    credit: "Site by",
  },
}

/* Bloque de dato: etiqueta en versalitas mono, valor en mono tabular. */
function DataBlock({ label, icon: Icon, children }) {
  return (
    <div className="min-w-0">
      <p className="flex items-center gap-2 font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
        <Icon className="h-3.5 w-3.5" />
        {label}
      </p>
      <div className="mt-2 space-y-1 font-mono text-[0.8125rem] leading-relaxed text-paper">
        {children}
      </div>
    </div>
  )
}

export default function Footer(props) {
  const site = { ...DEFAULTS, ...props }
  const lang = site.lang === "en" ? "en" : "es"
  const t = COPY[lang]
  const year = new Date().getFullYear()
  const tel = (n) => `tel:+1${n.replace(/\D/g, "")}`

  return (
    <footer className="sdn-surface sdn-footer text-paper">
      {/* Mismas capas que el hero: manchas a la deriva + velo de contraste.
          Aquí van al 45 % de tamaño (--sdn-blob), porque el footer es mucho
          más bajo y a escala completa se vería como color plano. */}
      <div className="sdn-blobs" aria-hidden="true">
        <span /><span /><span /><span /><span />
        <span /><span /><span /><span /><span />
      </div>
      <div className="sdn-veil" aria-hidden="true" />

      <div className="sdn-layer mx-auto max-w-[1200px] px-6 lg:px-12">
        {/* ── Banda principal ─────────────────────────────── */}
        <div className="grid gap-12 py-14 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.2fr)] lg:gap-20 lg:py-16">
          {/* Mástil: marca + tagline + redes */}
          <div className="min-w-0">
            <img
              src={site.logoWhite}
              alt={t.logoAlt}
              width="420"
              height="96"
              className="h-11 w-auto"
            />

            <p className="mt-6 max-w-[42ch] text-[0.9375rem] leading-relaxed text-rule">
              {t.tagline}
            </p>

            <nav aria-label={t.social} className="mt-7 flex items-center gap-2">
              {[
                { href: site.facebook, Icon: FacebookIcon, name: "Facebook" },
                { href: site.instagram, Icon: InstagramIcon, name: "Instagram" },
                { href: site.tiktok, Icon: TikTokIcon, name: "TikTok" },
              ].map(({ href, Icon, name }) => (
                <a
                  key={name}
                  href={href}
                  target="_blank"
                  rel="noopener noreferrer"
                  className="flex h-10 w-10 items-center justify-center rounded-sm border border-paper/20 text-rule transition-colors duration-150 hover:border-accent hover:bg-deep-2 hover:text-paper"
                >
                  <Icon className="h-4 w-4" />
                  <span className="sr-only">{name}</span>
                </a>
              ))}
            </nav>
          </div>

          {/* Cuatro bloques de datos */}
          <div className="grid grid-cols-1 gap-x-10 gap-y-8 sm:grid-cols-2">
            <DataBlock label={t.labelPhone} icon={PhoneIcon}>
              <a href={tel(site.phone1)} className="block tabular-nums hover:text-accent">
                {site.phone1}
              </a>
              <a href={tel(site.phone2)} className="block tabular-nums hover:text-accent">
                {site.phone2}
              </a>
            </DataBlock>

            <DataBlock label={t.labelEmail} icon={MailIcon}>
              <a href={`mailto:${site.email}`} className="block break-all hover:text-accent">
                {site.email}
              </a>
            </DataBlock>

            <DataBlock label={t.labelOffice} icon={PinIcon}>
              <address className="not-italic">{site.address}</address>
              <a
                href={site.mapUrl}
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center gap-1.5 whitespace-nowrap pt-1 text-accent hover:text-paper"
              >
                {t.directions}
                <ArrowIcon className="h-3.5 w-3.5" />
              </a>
            </DataBlock>

            <DataBlock label={t.labelHours} icon={PinIcon}>
              <p className="tabular-nums">{t.hours}</p>
              <p className="text-rule">{t.hoursNote}</p>
            </DataBlock>
          </div>
        </div>

        {/* ── Línea de cierre ─────────────────────────────── */}
        <div className="flex flex-col gap-5 border-t border-paper/15 py-7 lg:flex-row lg:items-center lg:justify-between">
          <nav aria-label={t.navLabel}>
            <ul className="flex flex-wrap items-center gap-x-6 gap-y-2">
              {t.links.map((l) => (
                <li key={l.href}>
                  <a
                    href={l.href}
                    className="whitespace-nowrap text-[0.875rem] text-rule transition-colors duration-150 hover:text-paper"
                  >
                    {l.label}
                  </a>
                </li>
              ))}
            </ul>
          </nav>

          <p className="flex flex-wrap items-center gap-x-2 gap-y-1 font-mono text-[0.75rem] text-rule">
            <span className="tabular-nums">© {year} Soluciones del Norte.</span>
            <span>{t.rights}</span>
            <span aria-hidden="true" className="hidden text-paper/30 sm:inline">·</span>
            <span>
              {t.credit}{" "}
              <a
                href={site.agencyUrl}
                target="_blank"
                rel="noopener noreferrer"
                className="whitespace-nowrap text-paper underline decoration-paper/30 underline-offset-2 transition-colors duration-150 hover:decoration-accent"
              >
                828 Marketing Solutions
              </a>
            </span>
          </p>
        </div>
      </div>
    </footer>
  )
}