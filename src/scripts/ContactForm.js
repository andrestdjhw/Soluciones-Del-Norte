import React, { useState, useRef, useCallback, useId } from "react"
import { PhoneIcon, MailIcon, ArrowIcon, ChevronIcon } from "./icons"
import { useLang } from "./langState"

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

   Antispam: honeypot + trampa de tiempo (ya estaban) y reCAPTCHA v3
   (window.sdnConfig.recaptcha). El script de Google lo encola PHP
   —necesita la site key en la URL desde el primer momento—, así que
   aquí solo se pide el token y se manda a verificar al endpoint REST
   que sdn_verify_recaptcha() atiende en functions.php. Si la site key
   no está configurada, se salta el paso: el formulario sigue
   funcionando con lo que ya tenía.

   Variantes por props:
     density = "compact" (hero) | "comfortable" (página /contacto)
     persistent = "true" — siempre visible, sin disparador
   ───────────────────────────────────────────────────────────── */

const EMAILJS_CDN =
  "https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"

const RECAPTCHA_ACTION = "contact"

const COPY = {
  es: {
    name: "Nombre",
    phone: "Teléfono",
    email: "Correo",
    employees: "Número de empleados",
    statesLegend: "Estados donde operas",
    statesPlaceholder: "Selecciona un estado",
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
    statesPlaceholder: "Select a state",
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

/* Token de reCAPTCHA v3 para esta llamada — no se reutiliza, cada
   verificación pide el suyo. `grecaptcha.ready` resuelve enseguida si
   el script ya cargó (lo normal, porque PHP lo encola de entrada) y
   espera si todavía no. */
function getRecaptchaToken(siteKey) {
  return new Promise((resolve, reject) => {
    if (!window.grecaptcha) {
      reject(new Error("grecaptcha no disponible"))
      return
    }
    window.grecaptcha.ready(() => {
      window.grecaptcha
        .execute(siteKey, { action: RECAPTCHA_ACTION })
        .then(resolve, reject)
    })
  })
}

/* Manda el token al endpoint REST de functions.php, que es quien
   consulta a Google con la clave secreta. Un `false` aquí puede ser
   spam de verdad o solo un tropiezo de red — en ambos casos se trata
   igual que un fallo de envío: la salida por teléfono/correo sigue
   ahí. */
async function verifyRecaptcha(verifyUrl, token) {
  const res = await fetch(verifyUrl, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({ token, action: RECAPTCHA_ACTION }),
  })
  if (!res.ok) return false
  const data = await res.json()
  return !!data.success
}

const LABEL_CLS =
  "block font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted"
const LABEL_CLS_DARK =
  "block font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-paper/60"

/**
 * Campo de texto (o desplegable, con type="select" + options). Vive a nivel
 * de módulo a propósito: si se declara dentro de ContactForm, React lo ve
 * como un tipo distinto en cada render, desmonta el input y el foco se
 * pierde a cada tecla.
 *
 * `dark` = variante sobre el cristal esmerilado oscuro del hero (compact):
 * mismo layout, paleta invertida (texto claro, control translúcido).
 */
function Field({ uid, name, label, value, error, onChange, pad, type = "text", inputMode, autoComplete, hint, dark, options }) {
  const fid = `${uid}-${name}`
  const describedBy = error ? `${fid}-err` : hint ? `${fid}-hint` : undefined
  const isSelect = type === "select"

  const controlCls = `mt-1.5 block w-full rounded-sm border ${pad} ${
    isSelect ? "appearance-none pr-9" : ""
  } font-body text-[0.9375rem] transition-colors duration-150 ${
    dark
      ? `bg-paper/10 text-paper placeholder:text-paper/40 ${error ? "border-accent" : "border-paper/20 hover:border-paper/40"}`
      : `bg-paper text-ink placeholder:text-neutral ${error ? "border-accent-2" : "border-rule hover:border-rule-2"}`
  }`

  return (
    <div className="min-w-0">
      <label htmlFor={fid} className={dark ? LABEL_CLS_DARK : LABEL_CLS}>
        {label}
      </label>
      <div className={isSelect ? "relative" : undefined}>
        {isSelect ? (
          <select
            id={fid}
            name={name}
            value={value}
            onChange={onChange}
            aria-invalid={error ? "true" : undefined}
            aria-describedby={describedBy}
            className={controlCls}
          >
            {options.map((opt) => (
              <option key={opt.value} value={opt.value} disabled={opt.value === ""}>
                {opt.label}
              </option>
            ))}
          </select>
        ) : (
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
            className={controlCls}
          />
        )}
        {isSelect && (
          <ChevronIcon
            className={`pointer-events-none absolute right-3 top-1/2 h-4 w-4 -translate-y-1/2 ${dark ? "text-paper/50" : "text-muted"}`}
          />
        )}
      </div>
      {hint && !error && (
        <p id={`${fid}-hint`} className={`mt-1.5 text-[0.75rem] ${dark ? "text-paper/50" : "text-muted"}`}>
          {hint}
        </p>
      )}
      {error && (
        <p id={`${fid}-err`} className={`mt-1.5 text-[0.75rem] ${dark ? "text-accent" : "text-accent-2"}`}>
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
  const lang = useLang(props.lang)
  const t = COPY[lang]
  const compact = props.density === "compact"
  // La variante compact es la del hero, ahora sobre cristal esmerilado
  // oscuro (ver cardCls) — mismo layout, paleta de texto invertida.
  const dark = compact

  const cfg = (typeof window !== "undefined" && window.sdnConfig) || {}
  const ejs = { ...(cfg.emailjs || {}), ...props }
  const recaptcha = cfg.recaptcha || {}
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
      // Si la site key está configurada, un token que no verifica corta
      // el envío aquí mismo — mismo tratamiento que un fallo de EmailJS.
      // Si no está configurada, se salta el paso entero: sin site key no
      // hay nada que pedirle a Google.
      if (recaptcha.siteKey) {
        const token = await getRecaptchaToken(recaptcha.siteKey)
        const ok = await verifyRecaptcha(recaptcha.verifyUrl, token)
        if (!ok) throw new Error("reCAPTCHA no verificó el envío")
      }

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

  /* La versión "compact" solo la usa el hero de home, que ahora tiene
     video de fondo: un cristal esmerilado oscuro (Space Indigo translúcido,
     como en la referencia everridgeus.com) deja asomar el video detrás sin
     sacrificar legibilidad — texto y controles pasan a la paleta clara
     (ver `dark` en Field y en los bloques de abajo). */
  const cardCls = compact
    ? "rounded-sm border border-paper/15 bg-deep/70 shadow-[0_20px_50px_rgba(8,10,20,0.45)] backdrop-blur-md"
    : "sdn-frame rounded-sm border border-rule bg-paper-2"

  /* ── Estado: enviado ─────────────────────────────────────── */
  if (status === "success") {
    return (
      <div
        className={`${cardCls} ${compact ? "p-6" : "p-8"}`}
        role="status"
        aria-live="polite"
      >
        <div className="h-1 w-12 bg-accent" aria-hidden="true" />
        <p className={`mt-5 font-display text-xl font-semibold ${dark ? "text-paper" : "text-ink"}`}>{t.successTitle}</p>
        <p className={`sdn-measure mt-2 text-[0.9375rem] leading-relaxed ${dark ? "text-paper/80" : "text-ink-2"}`}>{t.success}</p>
        <button
          type="button"
          onClick={restart}
          className={`mt-6 inline-flex items-center gap-2 font-mono text-[0.6875rem] uppercase tracking-[0.12em] ${dark ? "text-accent hover:text-paper" : "text-accent-2 hover:text-accent"}`}
        >
          {t.successAgain}
          <ArrowIcon className="h-3.5 w-3.5" />
        </button>
      </div>
    )
  }

  /* ── Formulario ──────────────────────────────────────────── */
  return (
    <div className={`${cardCls} ${compact ? "p-6" : "p-8"}`}>
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
          <Field uid={uid} name="name" label={t.name} autoComplete="name" dark={dark}
                 value={values.name} error={errors.name} onChange={set("name")} pad={pad} />
          <Field uid={uid} name="phone" label={t.phone} type="tel" inputMode="tel" autoComplete="tel" dark={dark}
                 value={values.phone} error={errors.phone} onChange={set("phone")} pad={pad} />
        </div>

        <Field uid={uid} name="email" label={t.email} type="email" inputMode="email" autoComplete="email" dark={dark}
               value={values.email} error={errors.email} onChange={set("email")} pad={pad} />

        <div className={compact ? "grid gap-4 sm:grid-cols-2" : "grid gap-5 sm:grid-cols-2"}>
          <Field uid={uid} name="employees" label={t.employees} inputMode="numeric" dark={dark}
                 value={values.employees} error={errors.employees} onChange={set("employees")} pad={pad} />

          <Field
            uid={uid}
            name="states"
            label={t.statesLegend}
            type="select"
            dark={dark}
            value={values.states}
            error={errors.states}
            onChange={set("states")}
            pad={pad}
            options={[
              { value: "", label: t.statesPlaceholder },
              { value: "Oregon", label: t.stateOR },
              { value: "Washington", label: t.stateWA },
              { value: "Ambos", label: t.stateBoth },
            ]}
          />
        </div>

        <div>
          <label htmlFor={`${uid}-message`} className={dark ? LABEL_CLS_DARK : LABEL_CLS}>
            {t.message}
          </label>
          <textarea
            id={`${uid}-message`}
            name="message"
            rows={compact ? 3 : 4}
            value={values.message}
            onChange={set("message")}
            aria-describedby={`${uid}-message-hint`}
            className={`mt-1.5 block w-full resize-y rounded-sm border ${pad} font-body text-[0.9375rem] transition-colors duration-150 ${
              dark
                ? "border-paper/20 bg-paper/10 text-paper hover:border-paper/40"
                : "border-rule bg-paper text-ink hover:border-rule-2"
            }`}
          />
          <p id={`${uid}-message-hint`} className={`mt-1.5 text-[0.75rem] ${dark ? "text-paper/50" : "text-muted"}`}>
            {t.messageHint}
          </p>
        </div>

        <button
          type="submit"
          disabled={status === "sending"}
          className="sdn-cta w-full"
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

        <p className={`text-[0.75rem] leading-snug ${dark ? "text-paper/50" : "text-muted"}`}>{t.legal}</p>
      </form>
    </div>
  )
}