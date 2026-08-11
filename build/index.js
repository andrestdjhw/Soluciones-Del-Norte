/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scripts/Navbar.js"
/*!*******************************!*\
  !*** ./src/scripts/Navbar.js ***!
  \*******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Navbar)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./icons */ "./src/scripts/icons.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__);



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
  mapUrl: "https://maps.google.com/?q=1915%20NE%20Stucki%20Ave%20Suite%20400%20Hillsboro%20OR%2097006",
  facebook: "https://facebook.com/solucionesdelnorte",
  instagram: "https://instagram.com/solucionesdelnorte",
  tiktok: "https://tiktok.com/@solucionesdelnorte",
  lang: "es"
};
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
    featuredBody: "Reportes semanales para contratos estatales y municipales, en el ciclo que exige el proyecto.",
    featuredCta: "Ver detalle",
    openMenu: "Menú",
    closeMenu: "Cerrar",
    logoAlt: "Soluciones del Norte — inicio",
    hoursShort: "Lun a Vie, 10:00–14:00",
    social: "Redes sociales"
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
    featuredBody: "Weekly reports for state and city contracts, on the cycle your project requires.",
    featuredCta: "See details",
    openMenu: "Menu",
    closeMenu: "Close",
    logoAlt: "Soluciones del Norte — home",
    hoursShort: "Mon to Fri, 10:00–14:00",
    social: "Social media"
  }
};
const SERVICES = {
  es: [{
    href: "/servicios/nomina",
    name: "Nómina",
    desc: "Cálculo, pagos y retenciones en tu ciclo."
  }, {
    href: "/servicios/nomina-certificada",
    name: "Nómina certificada",
    desc: "Reportes para obra estatal y municipal."
  }, {
    href: "/servicios/contabilidad",
    name: "Contabilidad",
    desc: "Libros al día y cierre mensual."
  }, {
    href: "/servicios/impuestos",
    name: "Impuestos",
    desc: "Declaraciones personales y de negocio."
  }, {
    href: "/servicios/notaria",
    name: "Notaría y documentos",
    desc: "Certificación con cita en Hillsboro."
  }, {
    href: "/servicios/tiempo-y-asistencia",
    name: "Tiempo y asistencia",
    desc: "Horas ordenadas antes de la corrida."
  }, {
    href: "/servicios/auditorias-de-nomina",
    name: "Auditorías de nómina",
    desc: "Revisión de periodos anteriores."
  }],
  en: [{
    href: "/en/services/payroll",
    name: "Payroll",
    desc: "Calculation, payments and withholdings."
  }, {
    href: "/en/services/certified-payroll",
    name: "Certified payroll",
    desc: "Reports for state and city projects."
  }, {
    href: "/en/services/bookkeeping",
    name: "Bookkeeping",
    desc: "Books kept current, monthly close."
  }, {
    href: "/en/services/taxes",
    name: "Taxes",
    desc: "Personal and business returns."
  }, {
    href: "/en/services/notary",
    name: "Notary and documents",
    desc: "Certification by appointment in Hillsboro."
  }, {
    href: "/en/services/time-attendance",
    name: "Time and attendance",
    desc: "Hours sorted before the run."
  }, {
    href: "/en/services/payroll-audits",
    name: "Payroll audits",
    desc: "Review of prior periods."
  }]
};
const ROUTES = {
  es: {
    home: "/",
    services: "/servicios",
    about: "/nosotros",
    contact: "/contacto",
    featured: "/servicios/nomina-certificada"
  },
  en: {
    home: "/en",
    services: "/en/services",
    about: "/en/about",
    contact: "/en/contact",
    featured: "/en/services/certified-payroll"
  }
};
function Navbar(props) {
  const site = {
    ...DEFAULTS,
    ...props
  };
  const lang = site.lang === "en" ? "en" : "es";
  const t = COPY[lang];
  const routes = ROUTES[lang];
  const services = SERVICES[lang];
  const [topbarHidden, setTopbarHidden] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [detached, setDetached] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [megaOpen, setMegaOpen] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [mobileOpen, setMobileOpen] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [mobileServices, setMobileServices] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const megaTriggerRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const mobileTriggerRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const headerRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);

  /* ── Scroll: retraer el topbar al bajar, devolverlo al subir ── */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    let last = window.scrollY;
    let ticking = false;
    const read = () => {
      const y = window.scrollY;
      const delta = y - last;
      setDetached(y > 4);

      // Cerca del tope el topbar siempre está visible.
      if (y <= 72) {
        setTopbarHidden(false);
        last = y;
      } else if (Math.abs(delta) > 6) {
        setTopbarHidden(delta > 0);
        last = y;
      }
      ticking = false;
    };
    const onScroll = () => {
      if (ticking) return;
      ticking = true;
      window.requestAnimationFrame(read);
    };
    read();
    window.addEventListener("scroll", onScroll, {
      passive: true
    });
    return () => window.removeEventListener("scroll", onScroll);
  }, []);

  /* Con un panel abierto el topbar no se esconde: el usuario no está leyendo. */
  const topbarCollapsed = topbarHidden && !megaOpen && !mobileOpen;

  /* ── Escape cierra y el foco vuelve al disparador ── */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!megaOpen && !mobileOpen) return;
    const onKey = e => {
      if (e.key !== "Escape") return;
      if (mobileOpen) {
        setMobileOpen(false);
        mobileTriggerRef.current?.focus();
      } else if (megaOpen) {
        setMegaOpen(false);
        megaTriggerRef.current?.focus();
      }
    };
    document.addEventListener("keydown", onKey);
    return () => document.removeEventListener("keydown", onKey);
  }, [megaOpen, mobileOpen]);

  /* ── Clic fuera y foco fuera cierran el mega-menú ── */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!megaOpen) return;
    const onPointer = e => {
      if (headerRef.current && !headerRef.current.contains(e.target)) setMegaOpen(false);
    };
    const onFocusIn = e => {
      if (headerRef.current && !headerRef.current.contains(e.target)) setMegaOpen(false);
    };
    document.addEventListener("pointerdown", onPointer);
    document.addEventListener("focusin", onFocusIn);
    return () => {
      document.removeEventListener("pointerdown", onPointer);
      document.removeEventListener("focusin", onFocusIn);
    };
  }, [megaOpen]);

  /* ── Bloqueo de scroll con el menú móvil abierto ── */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    document.body.dataset.sdnLock = mobileOpen ? "true" : "false";
    return () => {
      document.body.dataset.sdnLock = "false";
    };
  }, [mobileOpen]);
  const closeAll = (0,react__WEBPACK_IMPORTED_MODULE_0__.useCallback)(() => {
    setMegaOpen(false);
    setMobileOpen(false);
  }, []);
  const navLink = "whitespace-nowrap font-body text-[0.9375rem] text-ink hover:text-accent-2 transition-colors duration-150";
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.Fragment, {
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
      href: "#main",
      className: "sr-only focus:not-sr-only focus:absolute focus:left-4 focus:top-4 focus:z-[60] focus:rounded-sm focus:bg-deep focus:px-4 focus:py-2 focus:font-mono focus:text-sm focus:text-paper",
      children: t.skip
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("header", {
      ref: headerRef,
      className: "sticky top-0 z-50",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        className: "sdn-topbar bg-deep text-paper",
        style: {
          height: topbarCollapsed ? "0rem" : "var(--sdn-topbar-h)"
        },
        "aria-hidden": topbarCollapsed ? "true" : "false",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "mx-auto flex h-9 max-w-[1200px] items-center justify-between gap-4 px-6 lg:px-12",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
            className: "flex min-w-0 items-center gap-4 font-mono text-[0.75rem] tracking-wide",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: `tel:+1${site.phone1.replace(/\D/g, "")}`,
              className: "flex shrink-0 items-center gap-1.5 whitespace-nowrap hover:text-rule",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.PhoneIcon, {
                className: "h-3.5 w-3.5"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                className: "tabular-nums",
                children: site.phone1
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: `mailto:${site.email}`,
              className: "hidden shrink-0 items-center gap-1.5 whitespace-nowrap hover:text-rule sm:flex",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.MailIcon, {
                className: "h-3.5 w-3.5"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                children: site.email
              })]
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
            href: site.mapUrl,
            target: "_blank",
            rel: "noopener noreferrer",
            className: "hidden shrink-0 items-center gap-1.5 whitespace-nowrap font-mono text-[0.75rem] tracking-wide hover:text-rule lg:flex",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.PinIcon, {
              className: "h-3.5 w-3.5"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
              children: site.address
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("nav", {
            "aria-label": t.social,
            className: "flex shrink-0 items-center gap-1",
            children: [{
              href: site.facebook,
              Icon: _icons__WEBPACK_IMPORTED_MODULE_1__.FacebookIcon,
              name: "Facebook"
            }, {
              href: site.instagram,
              Icon: _icons__WEBPACK_IMPORTED_MODULE_1__.InstagramIcon,
              name: "Instagram"
            }, {
              href: site.tiktok,
              Icon: _icons__WEBPACK_IMPORTED_MODULE_1__.TikTokIcon,
              name: "TikTok"
            }].map(({
              href,
              Icon,
              name
            }) => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: href,
              target: "_blank",
              rel: "noopener noreferrer",
              className: "flex h-7 w-7 items-center justify-center rounded-sm text-paper/85 transition-colors duration-150 hover:bg-deep-2 hover:text-paper",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(Icon, {
                className: "h-4 w-4"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                className: "sr-only",
                children: name
              })]
            }, name))
          })]
        })
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        className: `sdn-bar border-b ${detached ? "border-rule bg-paper/90 shadow-[0_1px_16px_rgba(29,24,22,0.06)] backdrop-blur-md" : "border-transparent bg-paper"}`,
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "mx-auto flex h-[var(--sdn-bar-h)] max-w-[1200px] items-center justify-between gap-6 px-6 lg:px-12",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
            href: routes.home,
            className: "flex shrink-0 items-center",
            onClick: closeAll,
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("img", {
              src: site.logo,
              alt: t.logoAlt,
              width: "420",
              height: "96",
              className: "h-8 w-auto md:h-10"
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("nav", {
            "aria-label": t.services,
            className: "hidden items-center gap-8 lg:flex",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: routes.home,
              className: navLink,
              children: t.home
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("button", {
              ref: megaTriggerRef,
              type: "button",
              "aria-expanded": megaOpen,
              "aria-controls": "sdn-mega",
              onClick: () => setMegaOpen(v => !v),
              className: `flex items-center gap-1 whitespace-nowrap font-body text-[0.9375rem] transition-colors duration-150 ${megaOpen ? "text-accent-2" : "text-ink hover:text-accent-2"}`,
              children: [t.services, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.ChevronIcon, {
                className: `h-4 w-4 transition-transform duration-200 ${megaOpen ? "rotate-180" : ""}`
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: routes.about,
              className: navLink,
              children: t.about
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: routes.contact,
              className: navLink,
              children: t.contact
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
            className: "flex shrink-0 items-center gap-3",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: t.altHref,
              "aria-label": t.altLangLabel,
              className: "hidden rounded-sm border border-rule px-2.5 py-1 font-mono text-[0.75rem] tracking-widest text-muted transition-colors duration-150 hover:border-accent hover:text-accent-2 md:block",
              children: t.altLang
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: routes.contact,
              className: "hidden whitespace-nowrap rounded-sm bg-accent-2 px-5 py-2.5 font-body text-[0.875rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px md:inline-block",
              children: t.cta
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("button", {
              ref: mobileTriggerRef,
              type: "button",
              "aria-expanded": mobileOpen,
              "aria-controls": "sdn-mobile",
              onClick: () => setMobileOpen(v => !v),
              className: "flex h-11 w-11 items-center justify-center rounded-sm text-ink lg:hidden",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                className: "sr-only",
                children: mobileOpen ? t.closeMenu : t.openMenu
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("span", {
                className: "relative block h-4 w-6",
                "aria-hidden": "true",
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                  className: `absolute left-0 block h-[2px] w-6 bg-current transition-all duration-200 ${mobileOpen ? "top-[7px] rotate-45" : "top-0"}`
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                  className: `absolute left-0 top-[7px] block h-[2px] w-6 bg-current transition-opacity duration-200 ${mobileOpen ? "opacity-0" : "opacity-100"}`
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                  className: `absolute left-0 block h-[2px] w-6 bg-current transition-all duration-200 ${mobileOpen ? "top-[7px] -rotate-45" : "top-[14px]"}`
                })]
              })]
            })]
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
          id: "sdn-mega",
          hidden: !megaOpen,
          className: `sdn-panel absolute inset-x-0 top-full hidden border-b border-rule bg-paper shadow-[0_18px_40px_rgba(29,24,22,0.08)] lg:block ${megaOpen ? "opacity-100 translate-y-0" : "pointer-events-none -translate-y-2 opacity-0"}`,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
            className: "mx-auto grid max-w-[1200px] grid-cols-[minmax(0,2fr)_minmax(0,1fr)] gap-12 px-6 py-10 lg:px-12",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
                className: "mb-5 font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted",
                children: t.panelTitle
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("ul", {
                className: "grid grid-cols-2 gap-x-8 gap-y-1",
                children: services.map(s => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
                  children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
                    href: s.href,
                    onClick: closeAll,
                    className: "group block rounded-sm border-b border-rule-2 py-3 transition-colors duration-150 hover:border-accent",
                    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                      className: "block whitespace-nowrap font-display text-[0.9375rem] font-semibold text-ink group-hover:text-accent-2",
                      children: s.name
                    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                      className: "mt-0.5 block text-[0.8125rem] leading-snug text-muted",
                      children: s.desc
                    })]
                  })
                }, s.href))
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("p", {
                className: "mt-6 flex items-center gap-3 text-[0.8125rem] text-muted",
                children: [t.panelFoot, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
                  href: routes.contact,
                  onClick: closeAll,
                  className: "inline-flex items-center gap-1.5 whitespace-nowrap font-medium text-accent-2 hover:text-accent",
                  children: [t.panelFootCta, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.ArrowIcon, {
                    className: "h-3.5 w-3.5"
                  })]
                })]
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: routes.featured,
              onClick: closeAll,
              className: "group flex flex-col justify-between rounded-sm bg-deep p-7 transition-colors duration-150 hover:bg-deep-2",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
                children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
                  className: "font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule",
                  children: t.featuredEyebrow
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
                  className: "mt-3 font-display text-2xl font-semibold leading-tight text-paper",
                  children: t.featuredTitle
                }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
                  className: "mt-3 text-[0.875rem] leading-relaxed text-rule",
                  children: t.featuredBody
                })]
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("span", {
                className: "mt-8 inline-flex items-center gap-2 whitespace-nowrap font-mono text-[0.75rem] uppercase tracking-[0.12em] text-paper",
                children: [t.featuredCta, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.ArrowIcon, {
                  className: "h-4 w-4 transition-transform duration-150 group-hover:translate-x-1"
                })]
              })]
            })]
          })
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
        id: "sdn-mobile",
        hidden: !mobileOpen,
        className: "h-[calc(100svh-var(--sdn-bar-h))] overflow-y-auto border-b border-rule bg-paper lg:hidden",
        children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("nav", {
          "aria-label": t.services,
          className: "px-6 py-6",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
            href: routes.home,
            onClick: closeAll,
            className: "block border-b border-rule-2 py-4 font-display text-lg font-semibold text-ink",
            children: t.home
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
            className: "border-b border-rule-2",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("button", {
              type: "button",
              "aria-expanded": mobileServices,
              "aria-controls": "sdn-mobile-services",
              onClick: () => setMobileServices(v => !v),
              className: "flex w-full items-center justify-between py-4 text-left font-display text-lg font-semibold text-ink",
              children: [t.services, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.ChevronIcon, {
                className: `h-5 w-5 text-muted transition-transform duration-200 ${mobileServices ? "rotate-180" : ""}`
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("ul", {
              id: "sdn-mobile-services",
              hidden: !mobileServices,
              className: "pb-2",
              children: services.map(s => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
                children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
                  href: s.href,
                  onClick: closeAll,
                  className: "block border-t border-rule-2 py-3 pl-4 text-[0.9375rem] text-ink-2",
                  children: s.name
                })
              }, s.href))
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
            href: routes.about,
            onClick: closeAll,
            className: "block border-b border-rule-2 py-4 font-display text-lg font-semibold text-ink",
            children: t.about
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
            href: routes.contact,
            onClick: closeAll,
            className: "block border-b border-rule-2 py-4 font-display text-lg font-semibold text-ink",
            children: t.contact
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
            href: routes.contact,
            onClick: closeAll,
            className: "mt-6 block rounded-sm bg-accent-2 px-5 py-3.5 text-center font-body text-[0.9375rem] font-medium text-paper",
            children: t.cta
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
            className: "mt-8 space-y-3 font-mono text-[0.8125rem] text-muted",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: `tel:+1${site.phone1.replace(/\D/g, "")}`,
              className: "flex items-center gap-2",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.PhoneIcon, {
                className: "h-4 w-4"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                className: "tabular-nums",
                children: site.phone1
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: `mailto:${site.email}`,
              className: "flex items-center gap-2 break-all",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.MailIcon, {
                className: "h-4 w-4 shrink-0"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                children: site.email
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: site.mapUrl,
              target: "_blank",
              rel: "noopener noreferrer",
              className: "flex items-start gap-2",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.PinIcon, {
                className: "mt-0.5 h-4 w-4 shrink-0"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                children: site.address
              })]
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
              className: "pt-1",
              children: t.hoursShort
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
            href: t.altHref,
            className: "mt-6 inline-block rounded-sm border border-rule px-3 py-1.5 font-mono text-[0.75rem] tracking-widest text-muted",
            children: t.altLang
          })]
        })
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
      onClick: () => setMegaOpen(false),
      "aria-hidden": "true",
      className: `sdn-scrim fixed inset-0 z-40 hidden bg-ink/25 lg:block ${megaOpen ? "opacity-100" : "pointer-events-none opacity-0"}`
    })]
  });
}

/***/ },

/***/ "./src/scripts/icons.js"
/*!******************************!*\
  !*** ./src/scripts/icons.js ***!
  \******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   ArrowIcon: () => (/* binding */ ArrowIcon),
/* harmony export */   ChevronIcon: () => (/* binding */ ChevronIcon),
/* harmony export */   FacebookIcon: () => (/* binding */ FacebookIcon),
/* harmony export */   InstagramIcon: () => (/* binding */ InstagramIcon),
/* harmony export */   MailIcon: () => (/* binding */ MailIcon),
/* harmony export */   PhoneIcon: () => (/* binding */ PhoneIcon),
/* harmony export */   PinIcon: () => (/* binding */ PinIcon),
/* harmony export */   TikTokIcon: () => (/* binding */ TikTokIcon)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__);


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
  focusable: "false"
};
function PhoneIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    ...base,
    ...props,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M6.5 3h3l1.5 4-2 1.4a12 12 0 0 0 5.6 5.6L16 12l4 1.5v3a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 3.5 5.2 2 2 0 0 1 5.5 3Z"
    })
  });
}
function MailIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
    ...base,
    ...props,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("rect", {
      x: "2.5",
      y: "4.5",
      width: "19",
      height: "15",
      rx: "1.5"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "m3 6 9 6.5L21 6"
    })]
  });
}
function PinIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
    ...base,
    ...props,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("circle", {
      cx: "12",
      cy: "10",
      r: "2.6"
    })]
  });
}
function ChevronIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    ...base,
    ...props,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "m6 9 6 6 6-6"
    })
  });
}
function ArrowIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
    ...base,
    ...props,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M4 12h15"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "m13 6 6 6-6 6"
    })]
  });
}

/* Las marcas van en relleno sólido, no en trazo: así se leen a 16 px. */
const brand = {
  xmlns: "http://www.w3.org/2000/svg",
  viewBox: "0 0 24 24",
  fill: "currentColor",
  "aria-hidden": "true",
  focusable: "false"
};
function FacebookIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    ...brand,
    ...props,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M13.5 21v-7.6h2.6l.4-3h-3V8.5c0-.9.25-1.5 1.5-1.5H16.6V4.3A20 20 0 0 0 14.3 4.2c-2.3 0-3.9 1.4-3.9 4v2.2H7.8v3h2.6V21h3.1Z"
    })
  });
}
function InstagramIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    ...brand,
    ...props,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M12 4.6c2.4 0 2.7 0 3.6.05.9.04 1.4.2 1.7.32.43.17.74.37 1.06.7.33.32.53.63.7 1.06.12.3.28.8.32 1.7.05.9.05 1.2.05 3.6s0 2.7-.05 3.6c-.04.9-.2 1.4-.32 1.7-.17.43-.37.74-.7 1.06-.32.33-.63.53-1.06.7-.3.12-.8.28-1.7.32-.9.05-1.2.05-3.6.05s-2.7 0-3.6-.05c-.9-.04-1.4-.2-1.7-.32a2.9 2.9 0 0 1-1.06-.7 2.9 2.9 0 0 1-.7-1.06c-.12-.3-.28-.8-.32-1.7C4.6 14.7 4.6 14.4 4.6 12s0-2.7.05-3.6c.04-.9.2-1.4.32-1.7.17-.43.37-.74.7-1.06a2.9 2.9 0 0 1 1.06-.7c.3-.12.8-.28 1.7-.32.9-.05 1.2-.05 3.6-.05Zm0 4a3.4 3.4 0 1 0 0 6.8 3.4 3.4 0 0 0 0-6.8Zm0 5.6a2.2 2.2 0 1 1 0-4.4 2.2 2.2 0 0 1 0 4.4Zm4.35-5.74a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0Z"
    })
  });
}
function TikTokIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    ...brand,
    ...props,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M16.1 3h-2.7v11.4a2.1 2.1 0 1 1-1.75-2.07V9.6a4.9 4.9 0 1 0 4.45 4.88V9.06a5.9 5.9 0 0 0 3.4 1.07V7.4a3.3 3.3 0 0 1-3.4-3.2V3Z"
    })
  });
}

/***/ },

/***/ "react"
/*!************************!*\
  !*** external "React" ***!
  \************************/
(module) {

module.exports = window["React"];

/***/ },

/***/ "react-dom/client"
/*!***************************!*\
  !*** external "ReactDOM" ***!
  \***************************/
(module) {

module.exports = window["ReactDOM"];

/***/ },

/***/ "react/jsx-runtime"
/*!**********************************!*\
  !*** external "ReactJSXRuntime" ***!
  \**********************************/
(module) {

module.exports = window["ReactJSXRuntime"];

/***/ }

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	const __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		const cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		const module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		if (!(moduleId in __webpack_modules__)) {
/******/ 			delete __webpack_module_cache__[moduleId];
/******/ 			const e = new Error("Cannot find module '" + moduleId + "'");
/******/ 			e.code = 'MODULE_NOT_FOUND';
/******/ 			throw e;
/******/ 		}
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	(() => {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = (module) => {
/******/ 			const getter = module && module.__esModule ?
/******/ 				() => (module['default']) :
/******/ 				() => (module);
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	(() => {
/******/ 		// define getter/value functions for harmony exports
/******/ 		__webpack_require__.d = (exports, definition) => {
/******/ 			if(Array.isArray(definition)) {
/******/ 				var i = 0;
/******/ 				while(i < definition.length) {
/******/ 					var key = definition[i++];
/******/ 					var binding = definition[i++];
/******/ 					if(!__webpack_require__.o(exports, key)) {
/******/ 						if(binding === 0) {
/******/ 							Object.defineProperty(exports, key, { enumerable: true, value: definition[i++] });
/******/ 						} else {
/******/ 							Object.defineProperty(exports, key, { enumerable: true, get: binding });
/******/ 						}
/******/ 					} else if(binding === 0) { i++; }
/******/ 				}
/******/ 			} else {
/******/ 				for(var key in definition) {
/******/ 					if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 						Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 					}
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	(() => {
/******/ 		__webpack_require__.o = (obj, prop) => (Object.hasOwn(obj, prop))
/******/ 	})();
/******/ 	
/******/ 	/* webpack/runtime/make namespace object */
/******/ 	(() => {
/******/ 		// define __esModule on exports
/******/ 		__webpack_require__.r = (exports) => {
/******/ 			if(Symbol.toStringTag) {
/******/ 				Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 			}
/******/ 			Object.defineProperty(exports, '__esModule', { value: true });
/******/ 		};
/******/ 	})();
/******/ 	
/************************************************************************/
let __webpack_exports__ = {};
// This entry needs to be wrapped in an IIFE because it needs to be isolated against other modules in the chunk.
(() => {
/*!**********************!*\
  !*** ./src/index.js ***!
  \**********************/
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! react-dom/client */ "react-dom/client");
/* harmony import */ var react_dom_client__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(react_dom_client__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _scripts_Navbar__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./scripts/Navbar */ "./src/scripts/Navbar.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__);




/**
 * Monta los componentes React del tema.
 * Los datos del sitio vienen de PHP como data-attributes: así el
 * teléfono, el logotipo y las URLs viven en un solo sitio (functions.php)
 * y no hay que reconstruir el bundle para cambiarlos.
 */

function mount(selector, Component) {
  const node = document.querySelector(selector);
  if (!node) return;
  react_dom_client__WEBPACK_IMPORTED_MODULE_1___default().createRoot(node).render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_3__.jsx)(Component, {
    ...node.dataset
  }));
}
mount("#sdn-navbar", _scripts_Navbar__WEBPACK_IMPORTED_MODULE_2__["default"]);
})();

/******/ })()
;
//# sourceMappingURL=index.js.map