/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/******/ 	var __webpack_modules__ = ({

/***/ "./src/scripts/Chatbot.js"
/*!********************************!*\
  !*** ./src/scripts/Chatbot.js ***!
  \********************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Chatbot)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./icons */ "./src/scripts/icons.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__);



/* ─────────────────────────────────────────────────────────────
   Chatbot · guionizado (Pendiente 12, opción A)
   Sin modelo detrás: un árbol de decisión corto que califica la
   consulta y la entrega a una persona. No simula escritura ni
   finge conversación — cada respuesta dice qué necesitamos, qué
   hacemos y con quién sigue.
   ───────────────────────────────────────────────────────────── */

const DEFAULTS = {
  phone1: "971-477-8337",
  email: "Admin@solucionesnorte.com",
  contactUrl: "/contacto",
  lang: "es"
};

/* Horario de oficina en la zona de la oficina, no en la del visitante. */
const OFFICE = {
  tz: "America/Los_Angeles",
  open: 10,
  close: 14
};
function isOfficeOpen(now = new Date()) {
  try {
    const parts = new Intl.DateTimeFormat("en-US", {
      timeZone: OFFICE.tz,
      weekday: "short",
      hour: "numeric",
      hour12: false
    }).formatToParts(now);
    const weekday = parts.find(p => p.type === "weekday")?.value;
    const hour = Number(parts.find(p => p.type === "hour")?.value);
    const weekdays = ["Mon", "Tue", "Wed", "Thu", "Fri"];
    return weekdays.includes(weekday) && hour >= OFFICE.open && hour < OFFICE.close;
  } catch {
    return true; // si Intl falla, no bloqueamos nada
  }
}
const COPY = {
  es: {
    launch: "Abrir el chat",
    close: "Cerrar el chat",
    back: "Volver",
    title: "Soluciones del Norte",
    subtitle: "Respuestas rápidas",
    open: "Abierto ahora",
    closed: "Cerrado ahora",
    closedNote: "Estamos cerrados. Deja tu mensaje y contestamos el siguiente día hábil.",
    hours: "Lun a Vie, 10:00–14:00 (hora del Pacífico)",
    call: "Llamar",
    write: "Escribir un mensaje",
    restart: "Empezar de nuevo",
    needLabel: "Lo que necesitamos de ti",
    transcript: "Conversación",
    disclaimer: "Respuestas guionizadas. Para tu caso concreto habla con una persona."
  },
  en: {
    launch: "Open chat",
    close: "Close chat",
    back: "Back",
    title: "Soluciones del Norte",
    subtitle: "Quick answers",
    open: "Open now",
    closed: "Closed now",
    closedNote: "We're closed. Leave a message and we'll reply the next business day.",
    hours: "Mon to Fri, 10:00–14:00 (Pacific time)",
    call: "Call",
    write: "Send a message",
    restart: "Start over",
    needLabel: "What we need from you",
    transcript: "Conversation",
    disclaimer: "Scripted answers. For your specific case, talk to a person."
  }
};

/* ── El guion ──────────────────────────────────────────────
   Cada nodo: lo que responde el bot, opcionalmente una lista de
   requisitos, y las salidas. `escalate` marca los nodos que ya
   deben ofrecer llamar o escribir.
   ───────────────────────────────────────────────────────── */

const SCRIPT = {
  es: {
    root: {
      body: ["Hola. ¿En qué te ayudo — nómina, impuestos o una cita?"],
      options: [{
        label: "Quiero cotizar nómina",
        to: "payroll"
      }, {
        label: "Necesito nómina certificada",
        to: "certified"
      }, {
        label: "Quiero una cita de notaría",
        to: "notary"
      }, {
        label: "Otra cosa",
        to: "other"
      }]
    },
    payroll: {
      body: ["Para cotizar nómina necesitamos dos datos: cuántos empleados tienes y en qué estados operas.", "Con eso te decimos el alcance y el precio en la consulta inicial. Después, cada ciclo solo nos mandas horas, altas y bajas."],
      need: ["Número de empleados en planilla", "Estados donde operas (Oregon, Washington o ambos)", "Cómo llevas la nómina hoy"],
      escalate: true,
      options: [{
        label: "¿Y si solo tengo contratistas 1099?",
        to: "payroll-1099"
      }, {
        label: "Ver la página de Nómina",
        href: "/servicios/nomina"
      }]
    },
    "payroll-1099": {
      body: ["Si trabajas solo con contratistas 1099 no necesitas nómina: necesitas contabilidad, y preparación de las 1099 al cierre del año."],
      escalate: true,
      options: [{
        label: "Ver Contabilidad",
        href: "/servicios/contabilidad"
      }]
    },
    certified: {
      body: ["La nómina certificada aplica cuando tienes un contrato estatal o municipal. No es la nómina normal en otro formato: cambia lo que se declara, cada cuánto y ante quién.", "Un reporte incompleto puede retener tu pago hasta que se corrija."],
      need: ["Número de contrato y agencia que lo otorgó", "La wage determination del proyecto", "Horas por trabajador y por clasificación"],
      escalate: true,
      options: [{
        label: "Ver Nómina certificada",
        href: "/servicios/nomina-certificada"
      }, {
        label: "Mi obra es privada",
        to: "payroll"
      }]
    },
    notary: {
      body: ["Las notarizaciones son con cita, en la oficina de Hillsboro y en horario de oficina.", "Trae el documento sin firmar: la firma se hace frente al notario, nunca antes."],
      need: ["El documento sin firmar", "Identificación oficial vigente de cada firmante"],
      escalate: true,
      options: [{
        label: "Ver Notaría y documentos",
        href: "/servicios/notaria"
      }]
    },
    other: {
      body: ["También hacemos impuestos personales y de negocio, control de tiempo y asistencia, y auditorías de nómina."],
      options: [{
        label: "Impuestos",
        href: "/servicios/impuestos"
      }, {
        label: "Tiempo y asistencia",
        href: "/servicios/tiempo-y-asistencia"
      }, {
        label: "Auditorías de nómina",
        href: "/servicios/auditorias-de-nomina"
      }, {
        label: "Prefiero hablar con alguien",
        to: "human"
      }]
    },
    human: {
      body: ["Esto lo contesta mejor una persona. Llama en horario de oficina o déjanos tus datos y te buscamos."],
      escalate: true,
      options: []
    }
  },
  en: {
    root: {
      body: ["Hi. What can I help with — payroll, taxes or an appointment?"],
      options: [{
        label: "I want a payroll quote",
        to: "payroll"
      }, {
        label: "I need certified payroll",
        to: "certified"
      }, {
        label: "I need a notary appointment",
        to: "notary"
      }, {
        label: "Something else",
        to: "other"
      }]
    },
    payroll: {
      body: ["For a payroll quote we need two things: how many employees you have and which states you operate in.", "With that we give you scope and price on the intake call. After that, each cycle you only send hours, hires and terminations."],
      need: ["Number of employees on payroll", "States you operate in (Oregon, Washington or both)", "How you run payroll today"],
      escalate: true,
      options: [{
        label: "What if I only have 1099 contractors?",
        to: "payroll-1099"
      }, {
        label: "See the Payroll page",
        href: "/en/services/payroll"
      }]
    },
    "payroll-1099": {
      body: ["If you only work with 1099 contractors you don't need payroll — you need bookkeeping, plus 1099 preparation at year end."],
      escalate: true,
      options: [{
        label: "See Bookkeeping",
        href: "/en/services/bookkeeping"
      }]
    },
    certified: {
      body: ["Certified payroll applies when you hold a state or city contract. It isn't standard payroll in a different format: what you report, how often and to whom all change.", "An incomplete report can hold your payment until it's fixed."],
      need: ["Contract number and awarding agency", "The project's wage determination", "Hours by worker and by classification"],
      escalate: true,
      options: [{
        label: "See Certified payroll",
        href: "/en/services/certified-payroll"
      }, {
        label: "My project is private",
        to: "payroll"
      }]
    },
    notary: {
      body: ["Notarizations are by appointment, at the Hillsboro office, during office hours.", "Bring the document unsigned: signing happens in front of the notary, never before."],
      need: ["The unsigned document", "Current government-issued ID for each signer"],
      escalate: true,
      options: [{
        label: "See Notary and documents",
        href: "/en/services/notary"
      }]
    },
    other: {
      body: ["We also handle personal and business taxes, time and attendance, and payroll audits."],
      options: [{
        label: "Taxes",
        href: "/en/services/taxes"
      }, {
        label: "Time and attendance",
        href: "/en/services/time-attendance"
      }, {
        label: "Payroll audits",
        href: "/en/services/payroll-audits"
      }, {
        label: "I'd rather talk to someone",
        to: "human"
      }]
    },
    human: {
      body: ["A person can answer this better. Call during office hours or leave your details and we'll reach you."],
      escalate: true,
      options: []
    }
  }
};
function Chatbot(props) {
  const site = {
    ...DEFAULTS,
    ...props
  };
  const lang = site.lang === "en" ? "en" : "es";
  const t = COPY[lang];
  const script = SCRIPT[lang];
  const [open, setOpen] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(false);
  const [nodeId, setNodeId] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)("root");
  const [history, setHistory] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)([]); // ids visitados, para "volver"
  const [officeOpen, setOfficeOpen] = (0,react__WEBPACK_IMPORTED_MODULE_0__.useState)(() => isOfficeOpen());
  const launcherRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const panelRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const headingRef = (0,react__WEBPACK_IMPORTED_MODULE_0__.useRef)(null);
  const node = script[nodeId] || script.root;

  /* El estado del horario se refresca solo: una pestaña abierta
     durante horas no debe seguir diciendo "abierto". */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    const id = setInterval(() => setOfficeOpen(isOfficeOpen()), 60000);
    return () => clearInterval(id);
  }, []);

  /* Al abrir, el foco entra al panel. Al cerrar, vuelve al disparador. */
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (open) headingRef.current?.focus();
  }, [open]);
  const close = (0,react__WEBPACK_IMPORTED_MODULE_0__.useCallback)(() => {
    setOpen(false);
    launcherRef.current?.focus();
  }, []);
  (0,react__WEBPACK_IMPORTED_MODULE_0__.useEffect)(() => {
    if (!open) return;
    const onKey = e => {
      if (e.key === "Escape") close();
    };
    document.addEventListener("keydown", onKey);
    return () => document.removeEventListener("keydown", onKey);
  }, [open, close]);
  const go = to => {
    setHistory(h => [...h, nodeId]);
    setNodeId(to);
  };
  const back = () => {
    setHistory(h => {
      if (!h.length) return h;
      setNodeId(h[h.length - 1]);
      return h.slice(0, -1);
    });
  };
  const restart = () => {
    setHistory([]);
    setNodeId("root");
  };
  const telHref = `tel:+1${site.phone1.replace(/\D/g, "")}`;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.Fragment, {
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("button", {
      ref: launcherRef,
      type: "button",
      "aria-expanded": open,
      "aria-controls": "sdn-chat-panel",
      onClick: () => open ? close() : setOpen(true),
      className: `fixed bottom-5 right-5 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-deep text-paper shadow-[0_6px_24px_rgba(29,24,22,0.22)] transition-[background-color,transform] duration-150 hover:bg-deep-2 active:translate-y-px sm:bottom-7 sm:right-7 ${open ? "hidden sm:flex" : "flex"}`,
      children: [open ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.CloseIcon, {
        className: "h-6 w-6"
      }) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.ChatIcon, {
        className: "h-6 w-6"
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
        className: "sr-only",
        children: open ? t.close : t.launch
      }), !open && officeOpen && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
        "aria-hidden": "true",
        className: "absolute right-1 top-1 h-3 w-3 rounded-full border-2 border-deep bg-accent"
      })]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
      id: "sdn-chat-panel",
      ref: panelRef,
      role: "dialog",
      "aria-label": t.title,
      hidden: !open,
      className: "sdn-panel fixed inset-x-0 bottom-0 top-0 z-40 flex flex-col border border-rule bg-paper shadow-[0_18px_48px_rgba(29,24,22,0.18)] sm:inset-x-auto sm:inset-y-auto sm:bottom-24 sm:right-7 sm:top-auto sm:h-[min(34rem,calc(100svh-9rem))] sm:w-[23rem] sm:rounded-sm",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        className: "flex items-start justify-between gap-3 bg-deep px-5 py-4 text-paper",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "min-w-0",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("h2", {
            ref: headingRef,
            tabIndex: -1,
            className: "font-display text-base font-semibold outline-none",
            children: t.title
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("p", {
            className: "mt-1 flex items-center gap-2 font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-rule",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
              "aria-hidden": "true",
              className: `h-2 w-2 rounded-full ${officeOpen ? "bg-accent" : "bg-neutral"}`
            }), officeOpen ? t.open : t.closed]
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("button", {
          type: "button",
          onClick: close,
          className: "-mr-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-sm text-rule transition-colors duration-150 hover:bg-deep-2 hover:text-paper",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.CloseIcon, {
            className: "h-5 w-5"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
            className: "sr-only",
            children: t.close
          })]
        })]
      }), !officeOpen && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
        className: "border-b border-rule bg-paper-2 px-5 py-3 text-[0.8125rem] leading-snug text-ink-2",
        children: t.closedNote
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        className: "flex-1 overflow-y-auto px-5 py-5",
        "aria-live": "polite",
        "aria-label": t.transcript,
        children: [node.body.map((line, i) => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
          className: `text-[0.9375rem] leading-relaxed text-ink ${i ? "mt-3" : ""}`,
          children: line
        }, i)), node.need && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "mt-5 border-l-2 border-accent bg-paper-2 px-4 py-3",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
            className: "font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted",
            children: t.needLabel
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("ul", {
            className: "mt-2 space-y-1.5",
            children: node.need.map(n => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("li", {
              className: "flex gap-2 text-[0.8125rem] leading-snug text-ink-2",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                "aria-hidden": "true",
                className: "text-accent",
                children: "\u2013"
              }), n]
            }, n))
          })]
        }), node.options?.length > 0 && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
          className: "mt-5 space-y-2",
          children: node.options.map(o => o.href ? /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
            href: o.href,
            className: "group flex items-center justify-between gap-3 rounded-sm border border-rule px-4 py-3 text-left text-[0.875rem] text-ink transition-colors duration-150 hover:border-accent hover:bg-paper-2",
            children: [o.label, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.ArrowIcon, {
              className: "h-4 w-4 shrink-0 text-muted transition-transform duration-150 group-hover:translate-x-0.5 group-hover:text-accent-2"
            })]
          }, o.label) : /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("button", {
            type: "button",
            onClick: () => go(o.to),
            className: "flex w-full items-center justify-between gap-3 rounded-sm border border-rule px-4 py-3 text-left text-[0.875rem] text-ink transition-colors duration-150 hover:border-accent hover:bg-paper-2",
            children: o.label
          }, o.label))
        }), node.escalate && /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "mt-6 border-t border-rule pt-5",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
            href: telHref,
            className: "flex items-center justify-center gap-2 rounded-sm bg-accent-2 px-4 py-3 font-body text-[0.875rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px",
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.PhoneIcon, {
              className: "h-4 w-4"
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("span", {
              className: "tabular-nums",
              children: [t.call, " ", site.phone1]
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
            href: site.contactUrl,
            className: "mt-2 flex items-center justify-center gap-2 rounded-sm border border-rule px-4 py-3 text-[0.875rem] text-ink transition-colors duration-150 hover:border-accent hover:bg-paper-2",
            children: t.write
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
            className: "mt-3 text-center font-mono text-[0.6875rem] text-muted",
            children: t.hours
          })]
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        className: "flex items-center justify-between gap-3 border-t border-rule bg-paper-2 px-5 py-3",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("button", {
          type: "button",
          onClick: back,
          disabled: !history.length,
          className: "flex items-center gap-1.5 font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted transition-colors duration-150 hover:text-accent-2 disabled:pointer-events-none disabled:opacity-40",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.BackIcon, {
            className: "h-3.5 w-3.5"
          }), t.back]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("button", {
          type: "button",
          onClick: restart,
          disabled: nodeId === "root",
          className: "font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted transition-colors duration-150 hover:text-accent-2 disabled:pointer-events-none disabled:opacity-40",
          children: t.restart
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
        className: "border-t border-rule px-5 py-2.5 text-center text-[0.6875rem] leading-snug text-muted",
        children: t.disclaimer
      })]
    })]
  });
}

/***/ },

/***/ "./src/scripts/Footer.js"
/*!*******************************!*\
  !*** ./src/scripts/Footer.js ***!
  \*******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ Footer)
/* harmony export */ });
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! react */ "react");
/* harmony import */ var react__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(react__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _icons__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./icons */ "./src/scripts/icons.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__);



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
  mapUrl: "https://maps.google.com/?q=1915%20NE%20Stucki%20Ave%20Suite%20400%20Hillsboro%20OR%2097006",
  facebook: "https://facebook.com/solucionesdelnorte",
  instagram: "https://instagram.com/solucionesdelnorte",
  tiktok: "https://tiktok.com/@solucionesdelnorte",
  agencyUrl: "https://828marketingsolutions.com",
  lang: "es"
};
const COPY = {
  es: {
    logoAlt: "Soluciones del Norte",
    tagline: "Nómina, contabilidad, impuestos y documentos para negocios de Oregon y Washington.",
    social: "Redes sociales",
    labelPhone: "Teléfono",
    labelEmail: "Correo",
    labelOffice: "Oficina",
    labelHours: "Horario",
    hours: "Lunes a viernes, 10:00–14:00",
    hoursNote: "Cerrado fines de semana y días festivos.",
    directions: "Cómo llegar",
    navLabel: "Enlaces del pie",
    links: [{
      href: "/servicios",
      label: "Servicios"
    }, {
      href: "/nosotros",
      label: "Nosotros"
    }, {
      href: "/contacto",
      label: "Contacto"
    }, {
      href: "/aviso-de-privacidad",
      label: "Aviso de privacidad"
    }],
    rights: "Todos los derechos reservados.",
    credit: "Sitio por"
  },
  en: {
    logoAlt: "Soluciones del Norte",
    tagline: "Payroll, bookkeeping, taxes and documents for Oregon and Washington businesses.",
    social: "Social media",
    labelPhone: "Phone",
    labelEmail: "Email",
    labelOffice: "Office",
    labelHours: "Hours",
    hours: "Monday to Friday, 10:00–14:00",
    hoursNote: "Closed weekends and holidays.",
    directions: "Getting here",
    navLabel: "Footer links",
    links: [{
      href: "/en/services",
      label: "Services"
    }, {
      href: "/en/about",
      label: "About"
    }, {
      href: "/en/contact",
      label: "Contact"
    }, {
      href: "/en/privacy",
      label: "Privacy notice"
    }],
    rights: "All rights reserved.",
    credit: "Site by"
  }
};

/* Bloque de dato: etiqueta en versalitas mono, valor en mono tabular. */
function DataBlock({
  label,
  icon: Icon,
  children
}) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
    className: "min-w-0",
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("p", {
      className: "flex items-center gap-2 font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(Icon, {
        className: "h-3.5 w-3.5"
      }), label]
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("div", {
      className: "mt-2 space-y-1 font-mono text-[0.8125rem] leading-relaxed text-paper",
      children: children
    })]
  });
}
function Footer(props) {
  const site = {
    ...DEFAULTS,
    ...props
  };
  const lang = site.lang === "en" ? "en" : "es";
  const t = COPY[lang];
  const year = new Date().getFullYear();
  const tel = n => `tel:+1${n.replace(/\D/g, "")}`;
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("footer", {
    className: "bg-deep text-paper",
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
      className: "mx-auto max-w-[1200px] px-6 lg:px-12",
      children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        className: "grid gap-12 py-14 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.2fr)] lg:gap-20 lg:py-16",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "min-w-0",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("img", {
            src: site.logoWhite,
            alt: t.logoAlt,
            width: "420",
            height: "96",
            className: "h-11 w-auto"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
            className: "mt-6 max-w-[42ch] text-[0.9375rem] leading-relaxed text-rule",
            children: t.tagline
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("nav", {
            "aria-label": t.social,
            className: "mt-7 flex items-center gap-2",
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
              className: "flex h-10 w-10 items-center justify-center rounded-sm border border-paper/20 text-rule transition-colors duration-150 hover:border-accent hover:bg-deep-2 hover:text-paper",
              children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(Icon, {
                className: "h-4 w-4"
              }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
                className: "sr-only",
                children: name
              })]
            }, name))
          })]
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
          className: "grid grid-cols-1 gap-x-10 gap-y-8 sm:grid-cols-2",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(DataBlock, {
            label: t.labelPhone,
            icon: _icons__WEBPACK_IMPORTED_MODULE_1__.PhoneIcon,
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: tel(site.phone1),
              className: "block tabular-nums hover:text-accent",
              children: site.phone1
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: tel(site.phone2),
              className: "block tabular-nums hover:text-accent",
              children: site.phone2
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(DataBlock, {
            label: t.labelEmail,
            icon: _icons__WEBPACK_IMPORTED_MODULE_1__.MailIcon,
            children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: `mailto:${site.email}`,
              className: "block break-all hover:text-accent",
              children: site.email
            })
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(DataBlock, {
            label: t.labelOffice,
            icon: _icons__WEBPACK_IMPORTED_MODULE_1__.PinIcon,
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("address", {
              className: "not-italic",
              children: site.address
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("a", {
              href: site.mapUrl,
              target: "_blank",
              rel: "noopener noreferrer",
              className: "inline-flex items-center gap-1.5 whitespace-nowrap pt-1 text-accent hover:text-paper",
              children: [t.directions, /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)(_icons__WEBPACK_IMPORTED_MODULE_1__.ArrowIcon, {
                className: "h-3.5 w-3.5"
              })]
            })]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)(DataBlock, {
            label: t.labelHours,
            icon: _icons__WEBPACK_IMPORTED_MODULE_1__.PinIcon,
            children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
              className: "tabular-nums",
              children: t.hours
            }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("p", {
              className: "text-rule",
              children: t.hoursNote
            })]
          })]
        })]
      }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("div", {
        className: "flex flex-col gap-5 border-t border-paper/15 py-7 lg:flex-row lg:items-center lg:justify-between",
        children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("nav", {
          "aria-label": t.navLabel,
          children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("ul", {
            className: "flex flex-wrap items-center gap-x-6 gap-y-2",
            children: t.links.map(l => /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("li", {
              children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
                href: l.href,
                className: "whitespace-nowrap text-[0.875rem] text-rule transition-colors duration-150 hover:text-paper",
                children: l.label
              })
            }, l.href))
          })
        }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("p", {
          className: "flex flex-wrap items-center gap-x-2 gap-y-1 font-mono text-[0.75rem] text-rule",
          children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("span", {
            className: "tabular-nums",
            children: ["\xA9 ", year, " Soluciones del Norte."]
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
            children: t.rights
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("span", {
            "aria-hidden": "true",
            className: "hidden text-paper/30 sm:inline",
            children: "\xB7"
          }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsxs)("span", {
            children: [t.credit, " ", /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_2__.jsx)("a", {
              href: site.agencyUrl,
              target: "_blank",
              rel: "noopener noreferrer",
              className: "whitespace-nowrap text-paper underline decoration-paper/30 underline-offset-2 transition-colors duration-150 hover:decoration-accent",
              children: "828 Marketing Solutions"
            })]
          })]
        })]
      })]
    })
  });
}

/***/ },

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
/* harmony export */   BackIcon: () => (/* binding */ BackIcon),
/* harmony export */   ChatIcon: () => (/* binding */ ChatIcon),
/* harmony export */   ChevronIcon: () => (/* binding */ ChevronIcon),
/* harmony export */   CloseIcon: () => (/* binding */ CloseIcon),
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
function ChatIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    ...base,
    ...props,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M20.5 12.2c0 4-3.8 7.2-8.5 7.2a9.8 9.8 0 0 1-2.6-.35L4.5 20.5l1.35-3.9A6.9 6.9 0 0 1 3.5 12.2C3.5 8.2 7.3 5 12 5s8.5 3.2 8.5 7.2Z"
    })
  });
}
function CloseIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("svg", {
    ...base,
    ...props,
    children: /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "m6 6 12 12M18 6 6 18"
    })
  });
}
function BackIcon(props) {
  return /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsxs)("svg", {
    ...base,
    ...props,
    children: [/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "M20 12H5"
    }), /*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_1__.jsx)("path", {
      d: "m11 6-6 6 6 6"
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

/***/ "./src/scripts/reveal.js"
/*!*******************************!*\
  !*** ./src/scripts/reveal.js ***!
  \*******************************/
(__unused_webpack_module, __webpack_exports__, __webpack_require__) {

__webpack_require__.r(__webpack_exports__);
/* harmony export */ __webpack_require__.d(__webpack_exports__, {
/* harmony export */   "default": () => (/* binding */ initReveal)
/* harmony export */ });
/**
 * Revelado de secciones al entrar en viewport.
 * Sin librería: el proyecto es motion-cut, así que esto es
 * IntersectionObserver + dos clases. Una sola vez por elemento.
 *
 * Uso en las plantillas:  <div data-reveal>  ·  <div data-reveal="80">
 * El valor opcional es el desfase en milisegundos.
 */

function initReveal() {
  const nodes = document.querySelectorAll("[data-reveal]");
  if (!nodes.length) return;
  const reduced = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // Sin IntersectionObserver o con movimiento reducido: estado final directo.
  if (reduced || !("IntersectionObserver" in window)) {
    nodes.forEach(n => n.classList.add("is-revealed"));
    return;
  }
  const io = new IntersectionObserver(entries => {
    entries.forEach(entry => {
      if (!entry.isIntersecting) return;
      const delay = Number(entry.target.dataset.reveal) || 0;
      window.setTimeout(() => entry.target.classList.add("is-revealed"), delay);
      io.unobserve(entry.target);
    });
  }, {
    rootMargin: "0px 0px -12% 0px",
    threshold: 0.08
  });
  nodes.forEach(n => io.observe(n));
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
/* harmony import */ var _scripts_Footer__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./scripts/Footer */ "./src/scripts/Footer.js");
/* harmony import */ var _scripts_Chatbot__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./scripts/Chatbot */ "./src/scripts/Chatbot.js");
/* harmony import */ var _scripts_reveal__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./scripts/reveal */ "./src/scripts/reveal.js");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__ = __webpack_require__(/*! react/jsx-runtime */ "react/jsx-runtime");
/* harmony import */ var react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6___default = /*#__PURE__*/__webpack_require__.n(react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__);







/**
 * Monta los componentes React del tema.
 * Los datos del sitio vienen de PHP como data-attributes: así el
 * teléfono, el logotipo y las URLs viven en un solo sitio (functions.php)
 * y no hay que reconstruir el bundle para cambiarlos.
 */

function mount(selector, Component) {
  const node = document.querySelector(selector);
  if (!node) return;
  react_dom_client__WEBPACK_IMPORTED_MODULE_1___default().createRoot(node).render(/*#__PURE__*/(0,react_jsx_runtime__WEBPACK_IMPORTED_MODULE_6__.jsx)(Component, {
    ...node.dataset
  }));
}
mount("#sdn-navbar", _scripts_Navbar__WEBPACK_IMPORTED_MODULE_2__["default"]);
mount("#sdn-footer", _scripts_Footer__WEBPACK_IMPORTED_MODULE_3__["default"]);
mount("#sdn-chatbot", _scripts_Chatbot__WEBPACK_IMPORTED_MODULE_4__["default"]);
(0,_scripts_reveal__WEBPACK_IMPORTED_MODULE_5__["default"])();
})();

/******/ })()
;
//# sourceMappingURL=index.js.map