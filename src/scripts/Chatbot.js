import React, { useState, useEffect, useRef, useCallback } from "react"
import { ChatIcon, CloseIcon, BackIcon, PhoneIcon, ArrowIcon } from "./icons"

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
  lang: "es",
}

/* Horario de oficina en la zona de la oficina, no en la del visitante. */
const OFFICE = { tz: "America/Los_Angeles", open: 10, close: 14 }

function isOfficeOpen(now = new Date()) {
  try {
    const parts = new Intl.DateTimeFormat("en-US", {
      timeZone: OFFICE.tz,
      weekday: "short",
      hour: "numeric",
      hour12: false,
    }).formatToParts(now)

    const weekday = parts.find((p) => p.type === "weekday")?.value
    const hour = Number(parts.find((p) => p.type === "hour")?.value)

    const weekdays = ["Mon", "Tue", "Wed", "Thu", "Fri"]
    return weekdays.includes(weekday) && hour >= OFFICE.open && hour < OFFICE.close
  } catch {
    return true // si Intl falla, no bloqueamos nada
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
    disclaimer: "Respuestas guionizadas. Para tu caso concreto habla con una persona.",
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
    disclaimer: "Scripted answers. For your specific case, talk to a person.",
  },
}

/* ── El guion ──────────────────────────────────────────────
   Cada nodo: lo que responde el bot, opcionalmente una lista de
   requisitos, y las salidas. `escalate` marca los nodos que ya
   deben ofrecer llamar o escribir.
   ───────────────────────────────────────────────────────── */

const SCRIPT = {
  es: {
    root: {
      body: ["Hola. ¿En qué te ayudo — nómina, impuestos o una cita?"],
      options: [
        { label: "Quiero cotizar nómina", to: "payroll" },
        { label: "Necesito nómina certificada", to: "certified" },
        { label: "Quiero una cita de notaría", to: "notary" },
        { label: "Otra cosa", to: "other" },
      ],
    },
    payroll: {
      body: [
        "Para cotizar nómina necesitamos dos datos: cuántos empleados tienes y en qué estados operas.",
        "Con eso te decimos el alcance y el precio en la consulta inicial. Después, cada ciclo solo nos mandas horas, altas y bajas.",
      ],
      need: [
        "Número de empleados en planilla",
        "Estados donde operas (Oregon, Washington o ambos)",
        "Cómo llevas la nómina hoy",
      ],
      escalate: true,
      options: [
        { label: "¿Y si solo tengo contratistas 1099?", to: "payroll-1099" },
        { label: "Ver la página de Nómina", href: "/servicios/nomina" },
      ],
    },
    "payroll-1099": {
      body: [
        "Si trabajas solo con contratistas 1099 no necesitas nómina: necesitas contabilidad, y preparación de las 1099 al cierre del año.",
      ],
      escalate: true,
      options: [{ label: "Ver Contabilidad", href: "/servicios/contabilidad" }],
    },
    certified: {
      body: [
        "La nómina certificada aplica cuando tienes un contrato estatal o municipal. No es la nómina normal en otro formato: cambia lo que se declara, cada cuánto y ante quién.",
        "Un reporte incompleto puede retener tu pago hasta que se corrija.",
      ],
      need: [
        "Número de contrato y agencia que lo otorgó",
        "La wage determination del proyecto",
        "Horas por trabajador y por clasificación",
      ],
      escalate: true,
      options: [
        { label: "Ver Nómina certificada", href: "/servicios/nomina-certificada" },
        { label: "Mi obra es privada", to: "payroll" },
      ],
    },
    notary: {
      body: [
        "Las notarizaciones son con cita, en la oficina de Hillsboro y en horario de oficina.",
        "Trae el documento sin firmar: la firma se hace frente al notario, nunca antes.",
      ],
      need: [
        "El documento sin firmar",
        "Identificación oficial vigente de cada firmante",
      ],
      escalate: true,
      options: [{ label: "Ver Notaría y documentos", href: "/servicios/notaria" }],
    },
    other: {
      body: [
        "También hacemos impuestos personales y de negocio, control de tiempo y asistencia, y auditorías de nómina.",
      ],
      options: [
        { label: "Impuestos", href: "/servicios/impuestos" },
        { label: "Tiempo y asistencia", href: "/servicios/tiempo-y-asistencia" },
        { label: "Auditorías de nómina", href: "/servicios/auditorias-de-nomina" },
        { label: "Prefiero hablar con alguien", to: "human" },
      ],
    },
    human: {
      body: [
        "Esto lo contesta mejor una persona. Llama en horario de oficina o déjanos tus datos y te buscamos.",
      ],
      escalate: true,
      options: [],
    },
  },

  en: {
    root: {
      body: ["Hi. What can I help with — payroll, taxes or an appointment?"],
      options: [
        { label: "I want a payroll quote", to: "payroll" },
        { label: "I need certified payroll", to: "certified" },
        { label: "I need a notary appointment", to: "notary" },
        { label: "Something else", to: "other" },
      ],
    },
    payroll: {
      body: [
        "For a payroll quote we need two things: how many employees you have and which states you operate in.",
        "With that we give you scope and price on the intake call. After that, each cycle you only send hours, hires and terminations.",
      ],
      need: [
        "Number of employees on payroll",
        "States you operate in (Oregon, Washington or both)",
        "How you run payroll today",
      ],
      escalate: true,
      options: [
        { label: "What if I only have 1099 contractors?", to: "payroll-1099" },
        { label: "See the Payroll page", href: "/en/services/payroll" },
      ],
    },
    "payroll-1099": {
      body: [
        "If you only work with 1099 contractors you don't need payroll — you need bookkeeping, plus 1099 preparation at year end.",
      ],
      escalate: true,
      options: [{ label: "See Bookkeeping", href: "/en/services/bookkeeping" }],
    },
    certified: {
      body: [
        "Certified payroll applies when you hold a state or city contract. It isn't standard payroll in a different format: what you report, how often and to whom all change.",
        "An incomplete report can hold your payment until it's fixed.",
      ],
      need: [
        "Contract number and awarding agency",
        "The project's wage determination",
        "Hours by worker and by classification",
      ],
      escalate: true,
      options: [
        { label: "See Certified payroll", href: "/en/services/certified-payroll" },
        { label: "My project is private", to: "payroll" },
      ],
    },
    notary: {
      body: [
        "Notarizations are by appointment, at the Hillsboro office, during office hours.",
        "Bring the document unsigned: signing happens in front of the notary, never before.",
      ],
      need: ["The unsigned document", "Current government-issued ID for each signer"],
      escalate: true,
      options: [{ label: "See Notary and documents", href: "/en/services/notary" }],
    },
    other: {
      body: [
        "We also handle personal and business taxes, time and attendance, and payroll audits.",
      ],
      options: [
        { label: "Taxes", href: "/en/services/taxes" },
        { label: "Time and attendance", href: "/en/services/time-attendance" },
        { label: "Payroll audits", href: "/en/services/payroll-audits" },
        { label: "I'd rather talk to someone", to: "human" },
      ],
    },
    human: {
      body: [
        "A person can answer this better. Call during office hours or leave your details and we'll reach you.",
      ],
      escalate: true,
      options: [],
    },
  },
}

export default function Chatbot(props) {
  const site = { ...DEFAULTS, ...props }
  const lang = site.lang === "en" ? "en" : "es"
  const t = COPY[lang]
  const script = SCRIPT[lang]

  const [open, setOpen] = useState(false)
  const [nodeId, setNodeId] = useState("root")
  const [history, setHistory] = useState([]) // ids visitados, para "volver"
  const [officeOpen, setOfficeOpen] = useState(() => isOfficeOpen())

  const launcherRef = useRef(null)
  const panelRef = useRef(null)
  const headingRef = useRef(null)

  const node = script[nodeId] || script.root

  /* El estado del horario se refresca solo: una pestaña abierta
     durante horas no debe seguir diciendo "abierto". */
  useEffect(() => {
    const id = setInterval(() => setOfficeOpen(isOfficeOpen()), 60000)
    return () => clearInterval(id)
  }, [])

  /* Al abrir, el foco entra al panel. Al cerrar, vuelve al disparador. */
  useEffect(() => {
    if (open) headingRef.current?.focus()
  }, [open])

  const close = useCallback(() => {
    setOpen(false)
    launcherRef.current?.focus()
  }, [])

  useEffect(() => {
    if (!open) return
    const onKey = (e) => { if (e.key === "Escape") close() }
    document.addEventListener("keydown", onKey)
    return () => document.removeEventListener("keydown", onKey)
  }, [open, close])

  const go = (to) => {
    setHistory((h) => [...h, nodeId])
    setNodeId(to)
  }

  const back = () => {
    setHistory((h) => {
      if (!h.length) return h
      setNodeId(h[h.length - 1])
      return h.slice(0, -1)
    })
  }

  const restart = () => {
    setHistory([])
    setNodeId("root")
  }

  const telHref = `tel:+1${site.phone1.replace(/\D/g, "")}`

  return (
    <>
      {/* ── Disparador ─────────────────────────────────────── */}
      <button
        ref={launcherRef}
        type="button"
        aria-expanded={open}
        aria-controls="sdn-chat-panel"
        onClick={() => (open ? close() : setOpen(true))}
        className={`fixed bottom-5 right-5 z-40 flex h-14 w-14 items-center justify-center rounded-full bg-deep text-paper shadow-[0_6px_24px_rgba(29,24,22,0.22)] transition-[background-color,transform] duration-150 hover:bg-deep-2 active:translate-y-px sm:bottom-7 sm:right-7 ${
          open ? "hidden sm:flex" : "flex"
        }`}
      >
        {open ? <CloseIcon className="h-6 w-6" /> : <ChatIcon className="h-6 w-6" />}
        <span className="sr-only">{open ? t.close : t.launch}</span>
        {!open && officeOpen && (
          <span
            aria-hidden="true"
            className="absolute right-1 top-1 h-3 w-3 rounded-full border-2 border-deep bg-accent"
          />
        )}
      </button>

      {/* ── Panel ──────────────────────────────────────────── */}
      <div
        id="sdn-chat-panel"
        ref={panelRef}
        role="dialog"
        aria-label={t.title}
        hidden={!open}
        className="sdn-panel fixed inset-x-0 bottom-0 top-0 z-40 flex flex-col border border-rule bg-paper shadow-[0_18px_48px_rgba(29,24,22,0.18)] sm:inset-x-auto sm:inset-y-auto sm:bottom-24 sm:right-7 sm:top-auto sm:h-[min(34rem,calc(100svh-9rem))] sm:w-[23rem] sm:rounded-sm"
      >
        {/* Cabecera */}
        <div className="flex items-start justify-between gap-3 bg-deep px-5 py-4 text-paper">
          <div className="min-w-0">
            <h2
              ref={headingRef}
              tabIndex={-1}
              className="font-display text-base font-semibold outline-none"
            >
              {t.title}
            </h2>
            <p className="mt-1 flex items-center gap-2 font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-rule">
              <span
                aria-hidden="true"
                className={`h-2 w-2 rounded-full ${officeOpen ? "bg-accent" : "bg-neutral"}`}
              />
              {officeOpen ? t.open : t.closed}
            </p>
          </div>

          <button
            type="button"
            onClick={close}
            className="-mr-1 flex h-9 w-9 shrink-0 items-center justify-center rounded-sm text-rule transition-colors duration-150 hover:bg-deep-2 hover:text-paper"
          >
            <CloseIcon className="h-5 w-5" />
            <span className="sr-only">{t.close}</span>
          </button>
        </div>

        {!officeOpen && (
          <p className="border-b border-rule bg-paper-2 px-5 py-3 text-[0.8125rem] leading-snug text-ink-2">
            {t.closedNote}
          </p>
        )}

        {/* Cuerpo */}
        <div
          className="flex-1 overflow-y-auto px-5 py-5"
          aria-live="polite"
          aria-label={t.transcript}
        >
          {node.body.map((line, i) => (
            <p key={i} className={`text-[0.9375rem] leading-relaxed text-ink ${i ? "mt-3" : ""}`}>
              {line}
            </p>
          ))}

          {node.need && (
            <div className="mt-5 border-l-2 border-accent bg-paper-2 px-4 py-3">
              <p className="font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted">
                {t.needLabel}
              </p>
              <ul className="mt-2 space-y-1.5">
                {node.need.map((n) => (
                  <li key={n} className="flex gap-2 text-[0.8125rem] leading-snug text-ink-2">
                    <span aria-hidden="true" className="text-accent">–</span>
                    {n}
                  </li>
                ))}
              </ul>
            </div>
          )}

          {/* Salidas del guion */}
          {node.options?.length > 0 && (
            <div className="mt-5 space-y-2">
              {node.options.map((o) =>
                o.href ? (
                  <a
                    key={o.label}
                    href={o.href}
                    className="group flex items-center justify-between gap-3 rounded-sm border border-rule px-4 py-3 text-left text-[0.875rem] text-ink transition-colors duration-150 hover:border-accent hover:bg-paper-2"
                  >
                    {o.label}
                    <ArrowIcon className="h-4 w-4 shrink-0 text-muted transition-transform duration-150 group-hover:translate-x-0.5 group-hover:text-accent-2" />
                  </a>
                ) : (
                  <button
                    key={o.label}
                    type="button"
                    onClick={() => go(o.to)}
                    className="flex w-full items-center justify-between gap-3 rounded-sm border border-rule px-4 py-3 text-left text-[0.875rem] text-ink transition-colors duration-150 hover:border-accent hover:bg-paper-2"
                  >
                    {o.label}
                  </button>
                )
              )}
            </div>
          )}

          {/* Escalamiento a persona */}
          {node.escalate && (
            <div className="mt-6 border-t border-rule pt-5">
              <a
                href={telHref}
                className="flex items-center justify-center gap-2 rounded-sm bg-accent-2 px-4 py-3 font-body text-[0.875rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px"
              >
                <PhoneIcon className="h-4 w-4" />
                <span className="tabular-nums">{t.call} {site.phone1}</span>
              </a>
              <a
                href={site.contactUrl}
                className="mt-2 flex items-center justify-center gap-2 rounded-sm border border-rule px-4 py-3 text-[0.875rem] text-ink transition-colors duration-150 hover:border-accent hover:bg-paper-2"
              >
                {t.write}
              </a>
              <p className="mt-3 text-center font-mono text-[0.6875rem] text-muted">{t.hours}</p>
            </div>
          )}
        </div>

        {/* Pie del panel */}
        <div className="flex items-center justify-between gap-3 border-t border-rule bg-paper-2 px-5 py-3">
          <button
            type="button"
            onClick={back}
            disabled={!history.length}
            className="flex items-center gap-1.5 font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted transition-colors duration-150 hover:text-accent-2 disabled:pointer-events-none disabled:opacity-40"
          >
            <BackIcon className="h-3.5 w-3.5" />
            {t.back}
          </button>

          <button
            type="button"
            onClick={restart}
            disabled={nodeId === "root"}
            className="font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted transition-colors duration-150 hover:text-accent-2 disabled:pointer-events-none disabled:opacity-40"
          >
            {t.restart}
          </button>
        </div>

        <p className="border-t border-rule px-5 py-2.5 text-center text-[0.6875rem] leading-snug text-muted">
          {t.disclaimer}
        </p>
      </div>
    </>
  )
}