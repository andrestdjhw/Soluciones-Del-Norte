<?php
/**
 * Template Name: Aviso de privacidad
 *
 * Soluciones del Norte · Aviso de privacidad
 * Macroestructura: Long Document (02), la misma que Nosotros — prosa
 * continua con raíl de etiquetas a la izquierda, sin tarjetas. Es la
 * plantilla correcta para un texto legal: aquí no se vende nada, se
 * explica.
 *
 * TODO: este texto lo redactó un asistente a partir de lo que el sitio
 * hace de verdad (EmailJS para el envío, reCAPTCHA v3 para el filtro
 * de spam, Google Maps y Google Fonts como recursos externos, sin
 * analítica ni publicidad). Sirve para publicar algo honesto desde
 * el día uno, pero no reemplaza la revisión de un abogado — en
 * particular si el negocio empieza a recopilar más datos de los que
 * recopila hoy (pagos en línea, cuentas de usuario, etc.).
 *
 * Plantilla autocontenida: todo el markup y el copy viven aquí, sin partials.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();

$sdn      = sdn_site_data();
$sdn_lang = $sdn['lang'];
$is_en    = ( 'en' === $sdn_lang );

/* Los enlaces a las políticas de los proveedores externos van una sola
   vez aquí, no repetidos en cada idioma: son URLs, no copy. */
$sdn_emailjs_privacy = 'https://www.emailjs.com/legal/privacy-policy/';
$sdn_google_privacy  = 'https://policies.google.com/privacy';
$sdn_google_terms    = 'https://policies.google.com/terms';

/* Clase compartida por los enlaces dentro de párrafos de prosa —
   mismo tratamiento que ya usa el sitio en contact-template.php. */
$sdn_link_cls = 'underline decoration-rule underline-offset-4 hover:decoration-accent';

$c = $is_en ? array(
	'eyebrow'   => 'Legal',
	'h1'        => 'Privacy notice',
	'lede'      => 'How we collect, use and protect your information when you visit this site or write to us through the contact form.',
	'updated'   => 'Last updated: August 26, 2026.',
	'cta_h2'    => 'Questions about your information?',
	'cta_p'     => 'Write to us or call — we reply during office hours, Monday to Friday.',
	'cta'       => 'Contact us',
	'cta_alt'   => 'Terms & conditions',
) : array(
	'eyebrow'   => 'Legal',
	'h1'        => 'Aviso de privacidad',
	'lede'      => 'Cómo recopilamos, usamos y protegemos tu información cuando visitas este sitio o nos escribes por el formulario de contacto.',
	'updated'   => 'Última actualización: 26 de agosto de 2026.',
	'cta_h2'    => '¿Preguntas sobre tu información?',
	'cta_p'     => 'Escríbenos o llama — respondemos en horario de oficina, de lunes a viernes.',
	'cta'       => 'Contáctanos',
	'cta_alt'   => 'Términos y condiciones',
);

$sdn_contact = sdn_route( 'contact' );
$sdn_terms   = sdn_route( 'terms' );

/* Cada fila es [ etiqueta de raíl, encabezado, cuerpo, ¿el cuerpo trae
   HTML de confianza? ]. El cuarto valor es falso salvo en las tres
   secciones que enlazan a políticas de terceros — ese HTML lo escribe
   este archivo, no un visitante, así que wp_kses_post() basta y el
   resto de las secciones se queda con esc_html() a secas. */
$sdn_sections = $is_en ? array(
	array(
		'What you give us',
		'Information you give us directly',
		'When you fill out the contact form you share your name, phone, email, employee count, the states you operate in and, if you want, a message. We don’t ask for more than we need to tell which service fits.',
		false,
	),
	array(
		'Automatic',
		'Information the server collects automatically',
		'Like any site, our hosting logs basic technical data for every visit — IP address, browser, pages viewed — for security and to keep things running. We don’t cross it with analytics or advertising: this site doesn’t run Google Analytics or social-media pixels.',
		false,
	),
	array(
		'How we use it',
		'What we use your data for',
		'Only to answer your enquiry: book the intake call, answer your questions and, if you become a client, open your file. We don’t sell or rent your information, and we don’t sign you up for a newsletter you didn’t ask for.',
		false,
	),
	array(
		'Third parties',
		'Who processes the contact form',
		sprintf(
			'The contact form runs on two outside services. <a href="%1$s" target="_blank" rel="noopener noreferrer" class="%3$s">EmailJS</a> delivers your message straight from your browser to our inbox. Google reCAPTCHA v3 checks that whoever is sending it is a person, not a script — this site is protected by reCAPTCHA and the Google <a href="%2$s" target="_blank" rel="noopener noreferrer" class="%3$s">Privacy Policy</a> and <a href="%4$s" target="_blank" rel="noopener noreferrer" class="%3$s">Terms of Service</a> apply. Neither service uses your message for anything beyond that delivery or that check.',
			esc_url( $sdn_emailjs_privacy ),
			esc_url( $sdn_google_privacy ),
			esc_attr( $sdn_link_cls ),
			esc_url( $sdn_google_terms )
		),
		true,
	),
	array(
		'More from Google',
		'The map and the fonts',
		'The map of our office and the site’s typefaces load from Google’s own servers (Google Maps and Google Fonts). Loading them can register your IP address with Google, independently of this site. Neither runs advertising or analytics cookies of its own — only what’s needed to serve the map and the fonts.',
		false,
	),
	array(
		'Cookies',
		'Cookies',
		'This site doesn’t set its own analytics or advertising cookies. The Google services above may set their own technical cookies when they load, governed by Google’s own policy — we don’t control those.',
		false,
	),
	array(
		'How long',
		'How long we keep your information',
		'We keep contact messages for as long as the relationship with your business lasts, or as long as it’s reasonable to follow up. If you write to us and don’t move forward, you can ask us to delete your information at any time.',
		false,
	),
	array(
		'Your rights',
		'What you can ask us for',
		sprintf(
			'You can ask what information we hold about you, ask us to correct it if it’s wrong, or ask us to delete it. Write to <a href="mailto:%1$s" class="%3$s">%1$s</a> or call <a href="tel:+1%2$s" class="%3$s">%4$s</a>.',
			esc_attr( $sdn['email'] ),
			esc_attr( preg_replace( '/\D/', '', $sdn['phone1'] ) ),
			esc_attr( $sdn_link_cls ),
			esc_html( $sdn['phone1'] )
		),
		true,
	),
	array(
		'Security',
		'How we protect your information',
		'The site is served over an encrypted connection (HTTPS). Access to the messages we receive is limited to the team that handles enquiries.',
		false,
	),
	array(
		'Minors',
		'This site isn’t for minors',
		'Soluciones del Norte serves businesses, not a child audience. We don’t knowingly collect information from minors.',
		false,
	),
	array(
		'Changes',
		'Changes to this notice',
		'We may update this notice if something changes in how we process your information. The date at the top shows the last update.',
		false,
	),
) : array(
	array(
		'Qué recopilamos',
		'Información que nos das tú mismo',
		'Cuando llenas el formulario de contacto nos compartes tu nombre, teléfono, correo, número de empleados, los estados donde operas y, si quieres, un mensaje. No pedimos más de lo que necesitamos para saber qué servicio te conviene.',
		false,
	),
	array(
		'Automático',
		'Información que recopila el servidor',
		'Como cualquier sitio, el alojamiento registra datos técnicos básicos de cada visita —dirección IP, navegador, páginas vistas— con fines de seguridad y de funcionamiento. No los cruzamos con analítica ni publicidad: este sitio no lleva Google Analytics ni píxeles de redes sociales.',
		false,
	),
	array(
		'Cómo la usamos',
		'Para qué usamos tus datos',
		'Solo para responder tu consulta: agendar la llamada inicial, contestar tus preguntas y, si contratas el servicio, dar de alta tu expediente. No vendemos ni alquilamos tu información, y no te suscribimos a ningún boletín que no hayas pedido.',
		false,
	),
	array(
		'Terceros',
		'Quién procesa el formulario de contacto',
		sprintf(
			'El formulario de contacto lo procesan dos servicios externos. <a href="%1$s" target="_blank" rel="noopener noreferrer" class="%3$s">EmailJS</a> entrega tu mensaje directo desde tu navegador a nuestro correo. Google reCAPTCHA v3 verifica que quien lo envía es una persona, no un programa automatizado — este sitio está protegido por reCAPTCHA y aplican la <a href="%2$s" target="_blank" rel="noopener noreferrer" class="%3$s">Política de Privacidad</a> y los <a href="%4$s" target="_blank" rel="noopener noreferrer" class="%3$s">Términos de Servicio</a> de Google. Ninguno de los dos usa tu mensaje para otra cosa que no sea esa entrega o esa verificación.',
			esc_url( $sdn_emailjs_privacy ),
			esc_url( $sdn_google_privacy ),
			esc_attr( $sdn_link_cls ),
			esc_url( $sdn_google_terms )
		),
		true,
	),
	array(
		'Más de Google',
		'El mapa y las tipografías',
		'El mapa de nuestra oficina y las tipografías del sitio se cargan desde servidores propios de Google (Google Maps y Google Fonts). Cargarlos puede registrar tu dirección IP en Google, de forma independiente a este sitio. Ninguno de los dos lleva cookies de publicidad o analítica propias — solo lo necesario para servir el mapa y las tipografías.',
		false,
	),
	array(
		'Cookies',
		'Cookies',
		'Este sitio no pone cookies propias de analítica ni publicidad. Los servicios de Google de arriba pueden dejar sus propias cookies técnicas al cargar, según su propia política — no tenemos control sobre esas cookies.',
		false,
	),
	array(
		'Cuánto tiempo',
		'Cuánto tiempo guardamos tu información',
		'Guardamos los mensajes de contacto mientras dure la relación con tu negocio, o mientras sea razonable para darte seguimiento. Si nos escribes y no sigues con nosotros, puedes pedir que borremos tu información en cualquier momento.',
		false,
	),
	array(
		'Tus derechos',
		'Qué puedes pedirnos',
		sprintf(
			'Puedes pedirnos que te digamos qué información tenemos sobre ti, que la corrijamos si está mal, o que la borremos. Escríbenos a <a href="mailto:%1$s" class="%3$s">%1$s</a> o llama al <a href="tel:+1%2$s" class="%3$s">%4$s</a>.',
			esc_attr( $sdn['email'] ),
			esc_attr( preg_replace( '/\D/', '', $sdn['phone1'] ) ),
			esc_attr( $sdn_link_cls ),
			esc_html( $sdn['phone1'] )
		),
		true,
	),
	array(
		'Seguridad',
		'Cómo protegemos tu información',
		'El sitio se sirve por conexión cifrada (HTTPS). El acceso a los mensajes que recibimos está limitado al equipo que atiende consultas.',
		false,
	),
	array(
		'Menores',
		'Este sitio no es para menores',
		'Soluciones del Norte atiende negocios, no público infantil. No recopilamos a sabiendas información de menores de edad.',
		false,
	),
	array(
		'Cambios',
		'Cambios a este aviso',
		'Podemos actualizar este aviso si cambia algo en cómo procesamos tu información. La fecha de arriba indica la última actualización.',
		false,
	),
);
?>

<!-- ══════════════ Entrada ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-3 pb-16 pt-16 lg:px-6 lg:pb-20 lg:pt-24">
    <div data-reveal class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12">

      <p data-i18n="privacy.eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-3">
        <?php echo esc_html( $c['eyebrow'] ); ?>
      </p>

      <div class="mt-5 lg:mt-0">
        <h1 data-i18n="privacy.h1" class="sdn-measure-sm font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-ink sm:text-[2.75rem] lg:text-5xl">
          <?php echo esc_html( $c['h1'] ); ?>
        </h1>

        <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

        <p data-i18n="privacy.lede" class="sdn-measure-sm mt-8 text-[1.125rem] leading-[1.65] text-ink">
          <?php echo esc_html( $c['lede'] ); ?>
        </p>
        <p data-i18n="privacy.updated" class="mt-4 font-mono text-[0.8125rem] text-muted">
          <?php echo esc_html( $c['updated'] ); ?>
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Prosa con raíl de etiquetas ══════════════
     Mismo patrón que about-template.php, con más filas: un aviso de
     privacidad es una lista de respuestas puntuales, no un ensayo.
     ═══════════════════════════════════════════════════════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-3 py-16 lg:px-6 lg:py-20">

    <?php foreach ( $sdn_sections as $i => $s ) : ?>
      <article data-reveal="<?php echo esc_attr( min( $i * 40, 400 ) ); ?>"
               class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12 <?php echo $i ? 'mt-12 border-t border-rule-2 pt-12' : ''; ?>">

        <p data-i18n="privacy.<?php echo esc_attr( $i ); ?>.rail" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-2">
          <?php echo esc_html( $s[0] ); ?>
        </p>

        <div class="mt-4 lg:mt-0">
          <h2 data-i18n="privacy.<?php echo esc_attr( $i ); ?>.head" class="sdn-measure-sm font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
            <?php echo esc_html( $s[1] ); ?>
          </h2>
          <p data-i18n="privacy.<?php echo esc_attr( $i ); ?>.body" class="sdn-measure mt-4 text-[1.0625rem] leading-[1.65] text-ink-2">
            <?php echo $s[3] ? wp_kses_post( $s[2] ) : esc_html( $s[2] ); ?>
          </p>
        </div>

      </article>
    <?php endforeach; ?>

  </div>
</section>

<!-- ══════════════ Cierre — sin video a propósito ══════════════
     Las demás páginas cierran con la banda en video: aquí no. Quien
     llega a un aviso de privacidad está verificando algo, no
     decidiendo si confía — el cierre de venta sobraría.
     ═══════════════════════════════════════════════════════════ -->
<section class="bg-paper-2">
  <div class="mx-auto max-w-[1200px] px-3 py-14 lg:px-6 lg:py-16">
    <div data-reveal class="lg:grid lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end lg:gap-16">

      <div>
        <h2 data-i18n="privacy.cta_h2" class="sdn-measure-sm font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
          <?php echo esc_html( $c['cta_h2'] ); ?>
        </h2>
        <p data-i18n="privacy.cta_p" class="sdn-measure-sm mt-3 leading-relaxed text-ink-2">
          <?php echo esc_html( $c['cta_p'] ); ?>
        </p>
      </div>

      <div class="mt-6 flex flex-wrap items-center gap-3 lg:mt-0 lg:shrink-0">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           data-i18n="privacy.cta" data-i18n-href="route.contact"
           class="sdn-cta">
          <?php echo esc_html( $c['cta'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_terms ); ?>"
           data-i18n="privacy.cta_alt" data-i18n-href="route.terms"
           class="sdn-cta sdn-cta--ghost-ink">
          <?php echo esc_html( $c['cta_alt'] ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();
