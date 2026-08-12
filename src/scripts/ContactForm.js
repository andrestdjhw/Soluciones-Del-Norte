import React, { useState, useRef, useCallback, useId } from "react"
import { PhoneIcon, MailIcon, ArrowIcon } from "./icons"

/* ─────────────────────────────────────────────────────────────
   ContactForm
   Seis campos, los del copy deck. Los dos últimos —número de
   empleados y estados— existen porque son exactamente las dos
   respuestas que la home promete que bastan, y porque califican
   la consulta antes de la llamada.

   Envío: EmailJS. La configuración llega desde PHP
   (wp_localize_script → window.sdnConfig.emailjs), nunca escrita
   en el bundle. El SDK se carga bajo demanda: quien no envía el
   formulario no descarga la librería.

   Variantes por props:
     density = "compact" (hero) | "comfortable" (página /contacto)
     persistent = "true" — siempre visible, sin disparador
   ───────────────────────────────────────────────────────────── */

const EMAILJS_CDN =
  "https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"

const COPY = {
  es: {
    name: "Nombre",
    phone: "Teléfono",
    email: "Correo",
    employees: "Número de empleados",
    statesLegend: "Estados donde operas",
    stateOR: "Oregon",
    stateWA: "Washington",
    stateBoth: "Ambos",
    message: "Mensaje",
    messageHint: "Opcional. Si ya sabes qué necesitas, dínoslo aquí.",
    send: "Enviar",
    sending: "Enviando…",
    successTitle: "Recibido.",
    success: "Te contestamos en horario de oficina, de lunes a viernes.",
    successAgain: "Enviar otro mensaje",
    errorTitle: "No se pudo enviar.",
    error: "Llámanos o escríbenos directamente:",
    required: "Falta este dato.",
    badEmail: "Revisa el correo: falta la arroba o el dominio.",
    badPhone: "Revisa el teléfono: faltan dígitos.",
    badEmployees: "Escribe un número.",
    pickState: "Elige una opción.",
    legal:
      "Al enviar aceptas que te contactemos por teléfono o correo sobre tu consulta.",
    errorsTitle: "Revisa estos campos:",
  },
  en: {
    name: "Name",
    phone: "Phone",
    email: "Email",
    employees: "Number of employees",
    statesLegend: "States you operate in",
    stateOR: "Oregon",
    stateWA: "Washington",
    stateBoth: "Both",
    message: "Message",
    messageHint: "Optional. If you already know what you need, say so here.",
    send: "Send",
    sending: "Sending…",
    successTitle: "Received.",
    success: "We’ll reply during office hours, Monday to Friday.",
    successAgain: "Send another message",
    errorTitle: "Couldn’t send.",
    error: "Call or write to us directly:",
    required: "This one’s missing.",
    badEmail: "Check the email — the @ or the domain is missing.",
    badPhone: "Check the phone number — digits are missing.",
    badEmployees: "Enter a number.",
    pickState: "Pick one.",
    legal:
      "By sending this you agree to be contacted by phone or email about your enquiry.",
    errorsTitle: "Check these fields:",
  },
}

/* Carga el SDK de EmailJS una sola vez, cuando hace falta. */
let emailjsPromise = null

function loadEmailJs() {
  if (window.emailjs) return Promise.resolve(window.emailjs)
  if (emailjsPromise) return emailjsPromise

  emailjsPromise = new Promise((resolve, reject) => {
    const s = document.createElement("script")
    s.src = EMAILJS_CDN
    s.async = true
    s.onload = () => (window.emailjs ? resolve(window.emailjs) : reject(new Error("emailjs no disponible")))
    s.onerror = () => reject(new Error("no se pudo cargar emailjs"))
    document.head.appendChild(s)
  })

  return emailjsPromise
}

const LABEL_CLS =
  "block font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted"

/**
 * Campo de texto. Vive a nivel de módulo a propósito: si se declara dentro
 * de ContactForm, React lo ve como un tipo distinto en cada render, desmonta
 * el input y el foco se pierde a cada tecla.
 */
function Field({ uid, name, label, value, error, onChange, pad, type = "text", inputMode, autoComplete, hint }) {
  const fid = `${uid}-${name}`
  const describedBy = error ? `${fid}-err` : hint ? `${fid}-hint` : undefined

  return (
    <div className="min-w-0">
      <label htmlFor={fid} className={LABEL_CLS}>
        {label}
      </label>
      <input
        id={fid}
        name={name}
        type={type}
        inputMode={inputMode}
        autoComplete={autoComplete}
        value={value}
        onChange={onChange}
        aria-invalid={error ? "true" : undefined}
        aria-describedby={describedBy}
        className={`mt-1.5 block w-full rounded-sm border bg-paper ${pad} font-body text-[0.9375rem] text-ink placeholder:text-neutral transition-colors duration-150 ${
          error ? "border-accent-2" : "border-rule hover:border-rule-2"
        }`}
      />
      {hint && !error && (
        <p id={`${fid}-hint`} className="mt-1.5 text-[0.75rem] text-muted">
          {hint}
        </p>
      )}
      {error && (
        <p id={`${fid}-err`} className="mt-1.5 text-[0.75rem] text-accent-2">
          {error}
        </p>
      )}
    </div>
  )
}

const EMPTY = {
  name: "",
  phone: "",
  email: "",
  employees: "",
  states: "",
  message: "",
  company: "", // trampa para bots: un humano no la ve ni la llena
}

export default function ContactForm(props) {
  const lang = props.lang === "en" ? "en" : "es"
  const t = COPY[lang]
  const compact = props.density === "compact"

  const cfg = (typeof window !== "undefined" && window.sdnConfig) || {}
  const ejs = { ...(cfg.emailjs || {}), ...props }
  const contact = {
    phone: props.phone || cfg.phone || "971-477-8337",
    email: props.email || cfg.email || "Admin@solucionesnorte.com",
  }

  const uid = useId()
  const [values, setValues] = useState(EMPTY)
  const [errors, setErrors] = useState({})
  const [status, setStatus] = useState("idle") // idle | sending | success | error
  const formRef = useRef(null)
  const startedAt = useRef(Date.now())

  const set = (field) => (e) => {
    const v = e.target.value
    setValues((prev) => ({ ...prev, [field]: v }))
    setErrors((prev) => (prev[field] ? { ...prev, [field]: null } : prev))
  }

  const validate = useCallback(() => {
    const e = {}
    if (!values.name.trim()) e.name = t.required

    const digits = values.phone.replace(/\D/g, "")
    if (!values.phone.trim()) e.phone = t.required
    else if (digits.length < 10) e.phone = t.badPhone

    if (!values.email.trim()) e.email = t.required
    else if (!/^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/.test(values.email.trim())) e.email = t.badEmail

    if (!values.employees.trim()) e.employees = t.required
    else if (!/^\d{1,5}$/.test(values.employees.trim())) e.employees = t.badEmployees

    if (!values.states) e.states = t.pickState

    return e
  }, [values, t])

  const handleSubmit = async (event) => {
    event.preventDefault()
    if (status === "sending") return

    const found = validate()
    setErrors(found)

    if (Object.keys(found).length) {
      const first = formRef.current?.querySelector("[aria-invalid='true']")
      first?.focus()
      return
    }

    // Trampa de bots: campo oculto lleno, o formulario enviado en menos de 3 s.
    if (values.company || Date.now() - startedAt.current < 3000) {
      setStatus("success") // no damos pistas al bot
      return
    }

    setStatus("sending")

    try {
      if (!ejs.publicKey || !ejs.serviceId || !ejs.templateId) {
        throw new Error("EmailJS sin configurar: revisa SDN_EMAILJS_* en wp-config.php")
      }

      const emailjs = await loadEmailJs()
      emailjs.init({ publicKey: ejs.publicKey })

      await emailjs.send(ejs.serviceId, ejs.templateId, {
        from_name: values.name.trim(),
        from_phone: values.phone.trim(),
        from_email: values.email.trim(),
        employees: values.employees.trim(),
        states: values.states,
        message: values.message.trim(),
        page_url: window.location.href,
        lang,
      })

      setStatus("success")
      setValues(EMPTY)
    } catch (err) {
      console.error("[ContactForm]", err)
      setStatus("error")
    }
  }

  const restart = () => {
    setStatus("idle")
    setErrors({})
    startedAt.current = Date.now()
  }

  /* ── Estilos compartidos ─────────────────────────────────── */
  const pad = compact ? "px-3.5 py-2.5" : "px-4 py-3"
  const gap = compact ? "space-y-4" : "space-y-5"

  /* ── Estado: enviado ─────────────────────────────────────── */
  if (status === "success") {
    return (
      <div
        className={`rounded-sm border border-rule bg-paper-2 ${compact ? "p-6" : "p-8"}`}
        role="status"
        aria-live="polite"
      >
        <div className="h-1 w-12 bg-accent" aria-hidden="true" />
        <p className="mt-5 font-display text-xl font-semibold text-ink">{t.successTitle}</p>
        <p className="sdn-measure mt-2 text-[0.9375rem] leading-relaxed text-ink-2">{t.success}</p>
        <button
          type="button"
          onClick={restart}
          className="mt-6 inline-flex items-center gap-2 font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-accent-2 hover:text-accent"
        >
          {t.successAgain}
          <ArrowIcon className="h-3.5 w-3.5" />
        </button>
      </div>
    )
  }

  /* ── Formulario ──────────────────────────────────────────── */
  return (
    <div className={`rounded-sm border border-rule bg-paper-2 ${compact ? "p-6" : "p-8"}`}>
      <form ref={formRef} onSubmit={handleSubmit} noValidate className={gap}>

        {/* Trampa de bots — fuera de pantalla, fuera del orden de tabulación */}
        <div aria-hidden="true" className="absolute left-[-9999px] h-px w-px overflow-hidden">
          <label htmlFor={`${uid}-company`}>Company</label>
          <input
            id={`${uid}-company`}
            name="company"
            type="text"
            tabIndex={-1}
            autoComplete="off"
            value={values.company}
            onChange={set("company")}
          />
        </div>

        <div className={compact ? "grid gap-4 sm:grid-cols-2" : "grid gap-5 sm:grid-cols-2"}>
          <Field uid={uid} name="name" label={t.name} autoComplete="name"
                 value={values.name} error={errors.name} onChange={set("name")} pad={pad} />
          <Field uid={uid} name="phone" label={t.phone} type="tel" inputMode="tel" autoComplete="tel"
                 value={values.phone} error={errors.phone} onChange={set("phone")} pad={pad} />
        </div>

        <Field uid={uid} name="email" label={t.email} type="email" inputMode="email" autoComplete="email"
               value={values.email} error={errors.email} onChange={set("email")} pad={pad} />

        <div className={compact ? "grid gap-4 sm:grid-cols-2" : "grid gap-5 sm:grid-cols-2"}>
          <Field uid={uid} name="employees" label={t.employees} inputMode="numeric"
                 value={values.employees} error={errors.employees} onChange={set("employees")} pad={pad} />

          {/* Estados: tres opciones, no un desplegable — se ven de un vistazo */}
          <fieldset className="min-w-0">
            <legend className={LABEL_CLS}>{t.statesLegend}</legend>
            <div className="mt-1.5 grid grid-cols-3 gap-2">
              {[
                { value: "Oregon", label: t.stateOR },
                { value: "Washington", label: t.stateWA },
                { value: "Ambos", label: t.stateBoth },
              ].map((opt) => {
                const checked = values.states === opt.value
                return (
                  <label
                    key={opt.value}
                    className={`flex cursor-pointer items-center justify-center rounded-sm border px-2 py-2.5 text-center text-[0.8125rem] transition-colors duration-150 ${
                      checked
                        ? "border-accent bg-accent-2 text-paper"
                        : errors.states
                          ? "border-accent-2 bg-paper text-ink hover:bg-paper-3"
                          : "border-rule bg-paper text-ink hover:bg-paper-3"
                    }`}
                  >
                    <input
                      type="radio"
                      name={`${uid}-states`}
                      value={opt.value}
                      checked={checked}
                      onChange={set("states")}
                      aria-invalid={errors.states ? "true" : undefined}
                      aria-describedby={errors.states ? `${uid}-states-err` : undefined}
                      className="sr-only"
                    />
                    {opt.label}
                  </label>
                )
              })}
            </div>
            {errors.states && (
              <p id={`${uid}-states-err`} className="mt-1.5 text-[0.75rem] text-accent-2">
                {errors.states}
              </p>
            )}
          </fieldset>
        </div>

        <div>
          <label htmlFor={`${uid}-message`} className={LABEL_CLS}>
            {t.message}
          </label>
          <textarea
            id={`${uid}-message`}
            name="message"
            rows={compact ? 3 : 4}
            value={values.message}
            onChange={set("message")}
            aria-describedby={`${uid}-message-hint`}
            className={`mt-1.5 block w-full resize-y rounded-sm border border-rule bg-paper ${pad} font-body text-[0.9375rem] text-ink transition-colors duration-150 hover:border-rule-2`}
          />
          <p id={`${uid}-message-hint`} className="mt-1.5 text-[0.75rem] text-muted">
            {t.messageHint}
          </p>
        </div>

        <button
          type="submit"
          disabled={status === "sending"}
          className="w-full rounded-sm bg-accent-2 px-6 py-3.5 font-body text-[0.9375rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px disabled:pointer-events-none disabled:opacity-60"
        >
          {status === "sending" ? t.sending : t.send}
        </button>

        {/* Estado de error: siempre deja una salida humana */}
        {status === "error" && (
          <div role="alert" className="border-l-2 border-accent-2 bg-paper px-4 py-3">
            <p className="text-[0.875rem] font-medium text-ink">{t.errorTitle}</p>
            <p className="mt-1 text-[0.8125rem] text-ink-2">{t.error}</p>
            <p className="mt-2 space-y-1 font-mono text-[0.875rem]">
              <a
                href={`tel:+1${contact.phone.replace(/\D/g, "")}`}
                className="flex items-center gap-2 tabular-nums text-accent-2 hover:text-accent"
              >
                <PhoneIcon className="h-4 w-4" />
                {contact.phone}
              </a>
              <a
                href={`mailto:${contact.email}`}
                className="flex items-center gap-2 break-all text-accent-2 hover:text-accent"
              >
                <MailIcon className="h-4 w-4 shrink-0" />
                {contact.email}
              </a>
            </p>
          </div>
        )}

        <p className="text-[0.75rem] leading-snug text-muted">{t.legal}</p>
      </form>
    </div>
  )
}