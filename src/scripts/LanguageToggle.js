import React from "react"
import { FlagUSIcon, FlagMXIcon } from "./icons"
import { setLang } from "./langState"

/* ─────────────────────────────────────────────────────────────
   Interruptor de idioma — dos banderas siempre a la vista, la
   activa resaltada sobre una píldora blanca. Ya no navega a `/en`
   o `/`: hacer clic llama a `setLang()` (langState.js), que avisa
   por un evento a las islas de React (Navbar, Footer, ContactForm,
   Chatbot — cada una ya trae su propio diccionario ES/EN) y a
   `applyLang()` (I18n.js), que reescribe el resto del HTML de la
   página. El sitio entero cambia de idioma sin recargar, sin
   cambiar la URL — igual que el LanguageToggle.js de referencia.

   Uso:
     <LanguageToggle lang="es" />
   ───────────────────────────────────────────────────────────── */

const LANGS = {
  es: { label: "ES", Flag: FlagMXIcon },
  en: { label: "EN", Flag: FlagUSIcon },
}

export default function LanguageToggle({ lang, size = "md", className = "inline-flex" }) {
  const current = lang === "en" ? "en" : "es"
  const altCode = current === "es" ? "en" : "es"
  const self = LANGS[current]
  const alt = LANGS[altCode]
  const pad = size === "sm" ? "px-2.5 py-1" : "px-3 py-1.5"

  return (
    <div
      role="group"
      aria-label="Idioma / Language"
      className={`items-center gap-0.5 rounded-full border border-rule bg-paper-2 p-0.5 ${className}`}
    >
      <button
        type="button"
        aria-current="true"
        disabled
        className={`flex items-center gap-1.5 rounded-full bg-paper ${pad} font-mono text-[0.75rem] tracking-widest text-ink shadow-sm disabled:cursor-default`}
      >
        <self.Flag className="h-4 w-4 shrink-0 rounded-full" />
        {self.label}
      </button>

      <button
        type="button"
        onClick={() => setLang(altCode)}
        aria-label={altCode === "en" ? "View this site in English" : "Ver este sitio en español"}
        className={`flex items-center gap-1.5 rounded-full ${pad} font-mono text-[0.75rem] tracking-widest text-muted transition-colors duration-150 hover:text-accent-2`}
      >
        <alt.Flag className="h-4 w-4 shrink-0 rounded-full" />
        {alt.label}
      </button>
    </div>
  )
}
