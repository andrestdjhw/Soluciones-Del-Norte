import React from "react"
import ReactDOM from "react-dom/client"
import Navbar from "./scripts/Navbar"
import Footer from "./scripts/Footer"
import ContactForm from "./scripts/ContactForm"
import Chatbot from "./scripts/Chatbot"
import initReveal from "./scripts/reveal"
import initHeroFinisher from "./scripts/heroFinisher"

/**
 * Monta los componentes React del tema.
 * Los datos del sitio vienen de PHP como data-attributes: así el
 * teléfono, el logotipo y las URLs viven en un solo sitio (functions.php)
 * y no hay que reconstruir el bundle para cambiarlos.
 */

/* Componentes únicos por página. */
function mount(selector, Component) {
  const node = document.querySelector(selector)
  if (!node) return
  ReactDOM.createRoot(node).render(<Component {...node.dataset} />)
}

/* Componentes que pueden repetirse en la misma página: el ContactForm
   vive a la vez en el hero y en el bloque de cierre de la home. */
function mountAll(selector, Component) {
  document.querySelectorAll(selector).forEach((node) => {
    ReactDOM.createRoot(node).render(<Component {...node.dataset} />)
  })
}

mount("#sdn-navbar", Navbar)
mount("#sdn-footer", Footer)
mountAll("[data-sdn-form]", ContactForm)
mount("#sdn-chatbot", Chatbot)

initReveal()
initHeroFinisher()