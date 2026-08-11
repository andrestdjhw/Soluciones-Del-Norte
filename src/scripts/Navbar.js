import React, { useState, useEffect, useRef, useCallback } from "react"
import {
  PhoneIcon, MailIcon, PinIcon, ChevronIcon, ArrowIcon,
  FacebookIcon, InstagramIcon, TikTokIcon,
} from "./icons"

/* ─────────────────────────────────────────────────────────────
   Navbar · arquetipo N11 (mega-menu panel)
   Hallmark: los siete servicios agrupados justifican el panel.
   El topbar se retrae al bajar y vuelve al subir.
   ───────────────────────────────────────────────────────────── */

const DEFAULTS = {
  home: "/",
  logo: "/wp-content/uploads/2026/08/soluciones-dle-norte-horizontal.png",
  phone1: "971-477-8337",
  phone2: "971-471-2600",
  email: "Admin@solucionesnorte.com",
  address: "1915 NE Stucki Ave, Suite 400, Hillsboro, OR 97006",
  addressShort: "Hillsboro, OR",
  mapUrl:
    "https://maps.google.com/?q=1915%20NE%20Stucki%20Ave%20Suite%20400%20Hillsboro%20OR%2097006",
  facebook: "https://facebook.com/solucionesdelnorte",
  instagram: "https://instagram.com/solucionesdelnorte",
  tiktok: "https://tiktok.com/@solucionesdelnorte",
  lang: "es",
}

const COPY = {
  es: {
    skip: "Saltar al contenido principal",
    home: "Inicio",
    services: "Servicios",
    about: "Nosotros",
    contact: "Contacto",
    cta: "Agendar consulta",
    altLang: "EN",
    altLangLabel: "Ver este sitio en inglés",
    altHref: "/en",
    panelTitle: "Los siete servicios",
    panelFoot: "¿No sabes cuál necesitas? Empieza por la consulta inicial.",
    panelFootCta: "Agendar consulta inicial",
    featuredEyebrow: "Especialidad",
    featuredTitle: "Nómina certificada",
    featuredBody:
      "Reportes semanales para contratos estatales y municipales, en el ciclo que exige el proyecto.",
    featuredCta: "Ver detalle",
    openMenu: "Menú",
    closeMenu: "Cerrar",
    logoAlt: "Soluciones del Norte — inicio",
    hoursShort: "Lun a Vie, 10:00–14:00",
    social: "Redes sociales",
  },
  en: {
    skip: "Skip to main content",
    home: "Home",
    services: "Services",
    about: "About",
    contact: "Contact",
    cta: "Book a call",
    altLang: "ES",
    altLangLabel: "View this site in Spanish",
    altHref: "/",
    panelTitle: "All seven services",
    panelFoot: "Not sure which one you need? Start with the intake call.",
    panelFootCta: "Book an intake call",
    featuredEyebrow: "Specialty",
    featuredTitle: "Certified payroll",
    featuredBody:
      "Weekly reports for state and city contracts, on the cycle your project requires.",
    featuredCta: "See details",
    openMenu: "Menu",
    closeMenu: "Close",
    logoAlt: "Soluciones del Norte — home",
    hoursShort: "Mon to Fri, 10:00–14:00",
    social: "Social media",
  },
}

const SERVICES = {
  es: [
    { href: "/servicios/nomina", name: "Nómina", desc: "Cálculo, pagos y retenciones en tu ciclo." },
    { href: "/servicios/nomina-certificada", name: "Nómina certificada", desc: "Reportes para obra estatal y municipal." },
    { href: "/servicios/contabilidad", name: "Contabilidad", desc: "Libros al día y cierre mensual." },
    { href: "/servicios/impuestos", name: "Impuestos", desc: "Declaraciones personales y de negocio." },
    { href: "/servicios/notaria", name: "Notaría y documentos", desc: "Certificación con cita en Hillsboro." },
    { href: "/servicios/tiempo-y-asistencia", name: "Tiempo y asistencia", desc: "Horas ordenadas antes de la corrida." },
    { href: "/servicios/auditorias-de-nomina", name: "Auditorías de nómina", desc: "Revisión de periodos anteriores." },
  ],
  en: [
    { href: "/en/services/payroll", name: "Payroll", desc: "Calculation, payments and withholdings." },
    { href: "/en/services/certified-payroll", name: "Certified payroll", desc: "Reports for state and city projects." },
    { href: "/en/services/bookkeeping", name: "Bookkeeping", desc: "Books kept current, monthly close." },
    { href: "/en/services/taxes", name: "Taxes", desc: "Personal and business returns." },
    { href: "/en/services/notary", name: "Notary and documents", desc: "Certification by appointment in Hillsboro." },
    { href: "/en/services/time-attendance", name: "Time and attendance", desc: "Hours sorted before the run." },
    { href: "/en/services/payroll-audits", name: "Payroll audits", desc: "Review of prior periods." },
  ],
}

const ROUTES = {
  es: { home: "/", services: "/servicios", about: "/nosotros", contact: "/contacto", featured: "/servicios/nomina-certificada" },
  en: { home: "/en", services: "/en/services", about: "/en/about", contact: "/en/contact", featured: "/en/services/certified-payroll" },
}

export default function Navbar(props) {
  const site = { ...DEFAULTS, ...props }
  const lang = site.lang === "en" ? "en" : "es"
  const t = COPY[lang]
  const routes = ROUTES[lang]
  const services = SERVICES[lang]

  const [topbarHidden, setTopbarHidden] = useState(false)
  const [detached, setDetached] = useState(false)
  const [megaOpen, setMegaOpen] = useState(false)
  const [mobileOpen, setMobileOpen] = useState(false)
  const [mobileServices, setMobileServices] = useState(false)

  const megaTriggerRef = useRef(null)
  const mobileTriggerRef = useRef(null)
  const headerRef = useRef(null)

  /* ── Scroll: retraer el topbar al bajar, devolverlo al subir ── */
  useEffect(() => {
    let last = window.scrollY
    let ticking = false

    const read = () => {
      const y = window.scrollY
      const delta = y - last

      setDetached(y > 4)

      // Cerca del tope el topbar siempre está visible.
      if (y <= 72) {
        setTopbarHidden(false)
        last = y
      } else if (Math.abs(delta) > 6) {
        setTopbarHidden(delta > 0)
        last = y
      }
      ticking = false
    }

    const onScroll = () => {
      if (ticking) return
      ticking = true
      window.requestAnimationFrame(read)
    }

    read()
    window.addEventListener("scroll", onScroll, { passive: true })
    return () => window.removeEventListener("scroll", onScroll)
  }, [])

  /* Con un panel abierto el topbar no se esconde: el usuario no está leyendo. */
  const topbarCollapsed = topbarHidden && !megaOpen && !mobileOpen

  /* ── Escape cierra y el foco vuelve al disparador ── */
  useEffect(() => {
    if (!megaOpen && !mobileOpen) return

    const onKey = (e) => {
      if (e.key !== "Escape") return
      if (mobileOpen) {
        setMobileOpen(false)
        mobileTriggerRef.current?.focus()
      } else if (megaOpen) {
        setMegaOpen(false)
        megaTriggerRef.current?.focus()
      }
    }

    document.addEventListener("keydown", onKey)
    return () => document.removeEventListener("keydown", onKey)
  }, [megaOpen, mobileOpen])

  /* ── Clic fuera y foco fuera cierran el mega-menú ── */
  useEffect(() => {
    if (!megaOpen) return

    const onPointer = (e) => {
      if (headerRef.current && !headerRef.current.contains(e.target)) setMegaOpen(false)
    }
    const onFocusIn = (e) => {
      if (headerRef.current && !headerRef.current.contains(e.target)) setMegaOpen(false)
    }

    document.addEventListener("pointerdown", onPointer)
    document.addEventListener("focusin", onFocusIn)
    return () => {
      document.removeEventListener("pointerdown", onPointer)
      document.removeEventListener("focusin", onFocusIn)
    }
  }, [megaOpen])

  /* ── Bloqueo de scroll con el menú móvil abierto ── */
  useEffect(() => {
    document.body.dataset.sdnLock = mobileOpen ? "true" : "false"
    return () => { document.body.dataset.sdnLock = "false" }
  }, [mobileOpen])

  const closeAll = useCallback(() => {
    setMegaOpen(false)
    setMobileOpen(false)
  }, [])

  const navLink =
    "whitespace-nowrap font-body text-[0.9375rem] text-ink hover:text-accent-2 transition-colors duration-150"

  return (
    <>
      <a
        href="#main"
        className="sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:rounded-sm focus:bg-deep focus:px-4 focus:py-2 focus:font-mono focus:text-sm focus:text-paper"
      >
        {t.skip}
      </a>

      <header ref={headerRef} className="sticky top-0 z-50">
        {/* ── Barra de utilidad ─────────────────────────────── */}
        <div
          className="sdn-topbar bg-deep text-paper"
          style={{ height: topbarCollapsed ? "0rem" : "var(--sdn-topbar-h)" }}
          aria-hidden={topbarCollapsed ? "true" : "false"}
        >
          <div className="mx-auto flex h-9 max-w-[1200px] items-center justify-between gap-4 px-6 lg:px-12">
            {/* Izquierda · teléfono y correo */}
            <div className="flex min-w-0 items-center gap-4 font-mono text-[0.75rem] tracking-wide">
              <a
                href={`tel:+1${site.phone1.replace(/\D/g, "")}`}
                className="flex shrink-0 items-center gap-1.5 whitespace-nowrap hover:text-rule"
              >
                <PhoneIcon className="h-3.5 w-3.5" />
                <span className="tabular-nums">{site.phone1}</span>
              </a>
              <a
                href={`mailto:${site.email}`}
                className="hidden shrink-0 items-center gap-1.5 whitespace-nowrap hover:text-rule sm:flex"
              >
                <MailIcon className="h-3.5 w-3.5" />
                <span>{site.email}</span>
              </a>
            </div>

            {/* Centro · geotag */}
            <a
              href={site.mapUrl}
              target="_blank"
              rel="noopener noreferrer"
              className="hidden shrink-0 items-center gap-1.5 whitespace-nowrap font-mono text-[0.75rem] tracking-wide hover:text-rule lg:flex"
            >
              <PinIcon className="h-3.5 w-3.5" />
              <span>{site.address}</span>
            </a>

            {/* Derecha · redes */}
            <nav aria-label={t.social} className="flex shrink-0 items-center gap-1">
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
                  className="flex h-7 w-7 items-center justify-center rounded-sm text-paper/85 transition-colors duration-150 hover:bg-deep-2 hover:text-paper"
                >
                  <Icon className="h-4 w-4" />
                  <span className="sr-only">{name}</span>
                </a>
              ))}
            </nav>
          </div>
        </div>

        {/* ── Barra principal ───────────────────────────────── */}
        <div
          className={`sdn-bar border-b ${
            detached
              ? "border-rule bg-paper/90 shadow-[0_1px_16px_rgba(29,24,22,0.06)] backdrop-blur-md"
              : "border-transparent bg-paper"
          }`}
        >
          <div className="mx-auto flex h-[var(--sdn-bar-h)] max-w-[1200px] items-center justify-between gap-6 px-6 lg:px-12">
            {/* Logotipo */}
            <a href={routes.home} className="flex shrink-0 items-center" onClick={closeAll}>
              <img
                src={site.logo}
                alt={t.logoAlt}
                width="420"
                height="96"
                className="h-8 w-auto md:h-10"
              />
            </a>

            {/* Enlaces · desde lg */}
            <nav aria-label={t.services} className="hidden items-center gap-8 lg:flex">
              <a href={routes.home} className={navLink}>{t.home}</a>

              <button
                ref={megaTriggerRef}
                type="button"
                aria-expanded={megaOpen}
                aria-controls="sdn-mega"
                onClick={() => setMegaOpen((v) => !v)}
                className={`flex items-center gap-1 whitespace-nowrap font-body text-[0.9375rem] transition-colors duration-150 ${
                  megaOpen ? "text-accent-2" : "text-ink hover:text-accent-2"
                }`}
              >
                {t.services}
                <ChevronIcon
                  className={`h-4 w-4 transition-transform duration-200 ${megaOpen ? "rotate-180" : ""}`}
                />
              </button>

              <a href={routes.about} className={navLink}>{t.about}</a>
              <a href={routes.contact} className={navLink}>{t.contact}</a>
            </nav>

            {/* Idioma + CTA */}
            <div className="flex shrink-0 items-center gap-3">
              <a
                href={t.altHref}
                aria-label={t.altLangLabel}
                className="hidden rounded-sm border border-rule px-2.5 py-1 font-mono text-[0.75rem] tracking-widest text-muted transition-colors duration-150 hover:border-accent hover:text-accent-2 md:block"
              >
                {t.altLang}
              </a>

              <a
                href={routes.contact}
                className="hidden whitespace-nowrap rounded-sm bg-accent-2 px-5 py-2.5 font-body text-[0.875rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px md:inline-block"
              >
                {t.cta}
              </a>

              {/* Disparador móvil */}
              <button
                ref={mobileTriggerRef}
                type="button"
                aria-expanded={mobileOpen}
                aria-controls="sdn-mobile"
                onClick={() => setMobileOpen((v) => !v)}
                className="flex h-11 w-11 items-center justify-center rounded-sm text-ink lg:hidden"
              >
                <span className="sr-only">{mobileOpen ? t.closeMenu : t.openMenu}</span>
                <span className="relative block h-4 w-6" aria-hidden="true">
                  <span
                    className={`absolute left-0 block h-[2px] w-6 bg-current transition-all duration-200 ${
                      mobileOpen ? "top-[7px] rotate-45" : "top-0"
                    }`}
                  />
                  <span
                    className={`absolute left-0 top-[7px] block h-[2px] w-6 bg-current transition-opacity duration-200 ${
                      mobileOpen ? "opacity-0" : "opacity-100"
                    }`}
                  />
                  <span
                    className={`absolute left-0 block h-[2px] w-6 bg-current transition-all duration-200 ${
                      mobileOpen ? "top-[7px] -rotate-45" : "top-[14px]"
                    }`}
                  />
                </span>
              </button>
            </div>
          </div>

          {/* ── Panel del mega-menú · N11 ───────────────────── */}
          <div
            id="sdn-mega"
            hidden={!megaOpen}
            className={`sdn-panel absolute inset-x-0 top-full hidden border-b border-rule bg-paper shadow-[0_18px_40px_rgba(29,24,22,0.08)] lg:block ${
              megaOpen ? "opacity-100 translate-y-0" : "pointer-events-none -translate-y-2 opacity-0"
            }`}
          >
            <div className="mx-auto grid max-w-[1200px] grid-cols-[minmax(0,2fr)_minmax(0,1fr)] gap-12 px-6 py-10 lg:px-12">
              <div>
                <p className="mb-5 font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
                  {t.panelTitle}
                </p>
                <ul className="grid grid-cols-2 gap-x-8 gap-y-1">
                  {services.map((s) => (
                    <li key={s.href}>
                      <a
                        href={s.href}
                        onClick={closeAll}
                        className="group block rounded-sm border-b border-rule-2 py-3 transition-colors duration-150 hover:border-accent"
                      >
                        <span className="block whitespace-nowrap font-display text-[0.9375rem] font-semibold text-ink group-hover:text-accent-2">
                          {s.name}
                        </span>
                        <span className="mt-0.5 block text-[0.8125rem] leading-snug text-muted">
                          {s.desc}
                        </span>
                      </a>
                    </li>
                  ))}
                </ul>

                <p className="mt-6 flex items-center gap-3 text-[0.8125rem] text-muted">
                  {t.panelFoot}
                  <a
                    href={routes.contact}
                    onClick={closeAll}
                    className="inline-flex items-center gap-1.5 whitespace-nowrap font-medium text-accent-2 hover:text-accent"
                  >
                    {t.panelFootCta}
                    <ArrowIcon className="h-3.5 w-3.5" />
                  </a>
                </p>
              </div>

              {/* Tarjeta destacada · el diferenciador comercial */}
              <a
                href={routes.featured}
                onClick={closeAll}
                className="group flex flex-col justify-between rounded-sm bg-deep p-7 transition-colors duration-150 hover:bg-deep-2"
              >
                <div>
                  <p className="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
                    {t.featuredEyebrow}
                  </p>
                  <p className="mt-3 font-display text-2xl font-semibold leading-tight text-paper">
                    {t.featuredTitle}
                  </p>
                  <p className="mt-3 text-[0.875rem] leading-relaxed text-rule">
                    {t.featuredBody}
                  </p>
                </div>
                <span className="mt-8 inline-flex items-center gap-2 whitespace-nowrap font-mono text-[0.75rem] uppercase tracking-[0.12em] text-paper">
                  {t.featuredCta}
                  <ArrowIcon className="h-4 w-4 transition-transform duration-150 group-hover:translate-x-1" />
                </span>
              </a>
            </div>
          </div>
        </div>

        {/* ── Panel móvil ───────────────────────────────────── */}
        <div
          id="sdn-mobile"
          hidden={!mobileOpen}
          className="h-[calc(100svh-var(--sdn-bar-h))] overflow-y-auto border-b border-rule bg-paper lg:hidden"
        >
          <nav aria-label={t.services} className="px-6 py-6">
            <a href={routes.home} onClick={closeAll} className="block border-b border-rule-2 py-4 font-display text-lg font-semibold text-ink">
              {t.home}
            </a>

            <div className="border-b border-rule-2">
              <button
                type="button"
                aria-expanded={mobileServices}
                aria-controls="sdn-mobile-services"
                onClick={() => setMobileServices((v) => !v)}
                className="flex w-full items-center justify-between py-4 text-left font-display text-lg font-semibold text-ink"
              >
                {t.services}
                <ChevronIcon className={`h-5 w-5 text-muted transition-transform duration-200 ${mobileServices ? "rotate-180" : ""}`} />
              </button>

              <ul id="sdn-mobile-services" hidden={!mobileServices} className="pb-2">
                {services.map((s) => (
                  <li key={s.href}>
                    <a
                      href={s.href}
                      onClick={closeAll}
                      className="block border-t border-rule-2 py-3 pl-4 text-[0.9375rem] text-ink-2"
                    >
                      {s.name}
                    </a>
                  </li>
                ))}
              </ul>
            </div>

            <a href={routes.about} onClick={closeAll} className="block border-b border-rule-2 py-4 font-display text-lg font-semibold text-ink">
              {t.about}
            </a>
            <a href={routes.contact} onClick={closeAll} className="block border-b border-rule-2 py-4 font-display text-lg font-semibold text-ink">
              {t.contact}
            </a>

            <a
              href={routes.contact}
              onClick={closeAll}
              className="mt-6 block rounded-sm bg-accent-2 px-5 py-3.5 text-center font-body text-[0.9375rem] font-medium text-paper"
            >
              {t.cta}
            </a>

            <div className="mt-8 space-y-3 font-mono text-[0.8125rem] text-muted">
              <a href={`tel:+1${site.phone1.replace(/\D/g, "")}`} className="flex items-center gap-2">
                <PhoneIcon className="h-4 w-4" />
                <span className="tabular-nums">{site.phone1}</span>
              </a>
              <a href={`mailto:${site.email}`} className="flex items-center gap-2 break-all">
                <MailIcon className="h-4 w-4 shrink-0" />
                <span>{site.email}</span>
              </a>
              <a href={site.mapUrl} target="_blank" rel="noopener noreferrer" className="flex items-start gap-2">
                <PinIcon className="mt-0.5 h-4 w-4 shrink-0" />
                <span>{site.address}</span>
              </a>
              <p className="pt-1">{t.hoursShort}</p>
            </div>

            <a
              href={t.altHref}
              className="mt-6 inline-block rounded-sm border border-rule px-3 py-1.5 font-mono text-[0.75rem] tracking-widest text-muted"
            >
              {t.altLang}
            </a>
          </nav>
        </div>
      </header>

      {/* Velo del mega-menú */}
      <div
        onClick={() => setMegaOpen(false)}
        aria-hidden="true"
        className={`sdn-scrim fixed inset-0 z-40 hidden bg-ink/25 lg:block ${
          megaOpen ? "opacity-100" : "pointer-events-none opacity-0"
        }`}
      />
    </>
  )
}