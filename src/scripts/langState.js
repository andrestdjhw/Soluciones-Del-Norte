import { useState, useEffect } from "react"

/* ─────────────────────────────────────────────────────────────
   Estado de idioma compartido — el toggle no navega a otra URL,
   así que el idioma que ve el visitante deja de ser "lo que
   renderizó PHP para esta ruta" y pasa a ser un estado que
   cualquier pieza de la página puede leer y seguir.

   Dos tipos de contenido en el sitio, dos formas de reaccionar:

     · Los cuatro componentes React montados aparte (Navbar, Footer,
       ContactForm, Chatbot) ya llevan su propio diccionario ES/EN
       (`COPY[lang]`) desde que existen — no necesitan un
       diccionario nuevo, solo que su `lang` deje de ser una
       constante derivada del prop del servidor y pase a ser este
       estado. Por eso `useLang()` es un hook: cada isla se
       re-renderiza sola cuando cambia.

     · El resto de cada plantilla es HTML estático de PHP, sin
       React. Ese lado lo cubre `I18n.js`, con la técnica del
       ejemplo (`data-i18n` + reescribir el DOM) — ver ese archivo.

   Las dos mitades comparten el mismo evento (`sdn:langchange`) y el
   mismo storage, para que un cambio de idioma se sienta como uno
   solo aunque la implementación de abajo sea distinta.
   ───────────────────────────────────────────────────────────── */

export const LANG_EVENT = "sdn:langchange"
export const LANG_STORAGE_KEY = "sdn-lang"

export function getStoredLang(serverLang) {
  const fallback = serverLang === "en" ? "en" : "es"
  try {
    const saved = localStorage.getItem(LANG_STORAGE_KEY)
    if (saved === "es" || saved === "en") return saved
  } catch (e) {}
  return fallback
}

export function setLang(lang) {
  const next = lang === "en" ? "en" : "es"
  try { localStorage.setItem(LANG_STORAGE_KEY, next) } catch (e) {}
  document.documentElement.lang = next
  try {
    window.dispatchEvent(new CustomEvent(LANG_EVENT, { detail: next }))
  } catch (e) {}
}

/* Hook para los componentes React: arranca en el idioma guardado
   (o el que mandó el servidor si no hay nada guardado) y se
   actualiza solo cuando algo llama a setLang() en cualquier parte
   de la página — incluida otra isla de React montada aparte. */
export function useLang(serverLang) {
  const [lang, setLocalLang] = useState(() => getStoredLang(serverLang))

  useEffect(() => {
    const onChange = (e) => setLocalLang(e.detail === "en" ? "en" : "es")
    window.addEventListener(LANG_EVENT, onChange)
    return () => window.removeEventListener(LANG_EVENT, onChange)
  }, [])

  return lang
}
