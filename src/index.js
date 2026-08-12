import React from "react"
import ReactDOM from "react-dom/client"
import Navbar from "./scripts/Navbar"
import Footer from "./scripts/Footer"
import Chatbot from "./scripts/Chatbot"
import initReveal from "./scripts/reveal"

/**
 * Monta los componentes React del tema.
 * Los datos del sitio vienen de PHP como data-attributes: así el
 * teléfono, el logotipo y las URLs viven en un solo sitio (functions.php)
 * y no hay que reconstruir el bundle para cambiarlos.
 */

function mount(selector, Component) {
  const node = document.querySelector(selector)
  if (!node) return
  ReactDOM.createRoot(node).render(<Component {...node.dataset} />)
}

mount("#sdn-navbar", Navbar)
mount("#sdn-footer", Footer)
mount("#sdn-chatbot", Chatbot)

initReveal()