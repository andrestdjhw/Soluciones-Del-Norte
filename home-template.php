<?php
/**
 * Template Name: Home — Landing principal
 *
 * Soluciones del Norte · Home
 * Macroestructura: Split Studio (15) — cada bloque parte la pantalla en
 * dos y la dirección se alterna al bajar. En móvil colapsa a una columna,
 * siempre texto primero.
 *
 * Sistema de movimiento "v2" (Reveal.js + index.css): revelados
 * direccionales, imagen en cortina (.sdn-wipe), contador, botones
 * magnéticos y tarjetas con inclinación 3D. Vive solo aquí — el resto
 * del sitio sigue con el [data-reveal] original, intacto.
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

/* ── Imágenes ────────────────────────────────────────────── */
$sdn_img_certified_url = content_url( '/uploads/2026/08/CuadrillaOregon.webp' );
// Si algún día el archivo cambia de nombre o sale de la biblioteca,
// cae al original en vez de romper la figura.
$sdn_img_certified     = sdn_attachment_image( $sdn_img_certified_url ) ?: array(
	'src'    => $sdn_img_certified_url,
	'srcset' => '',
	'sizes'  => '',
	'width'  => 1200,
	'height' => 900,
);
$sdn_img_team_url  = content_url( '/uploads/2026/08/SDN_Team.jpeg' );
$sdn_img_team      = sdn_attachment_image( $sdn_img_team_url ) ?: array(
	'src'    => $sdn_img_team_url,
	'srcset' => '',
	'sizes'  => '',
	'width'  => 1200,
	'height' => 900,
);
$sdn_img_contact   = content_url( '/uploads/2026/08/SDN_Contact.jpeg' );

/* ── Fotos del carrusel de servicios ─────────────────────────
   Mismos archivos que services-template.php (el criterio de encargo
   de las fotos está documentado allá, no se repite aquí). Mientras
   un archivo no exista, la tarjeta se dibuja sin foto: ni hueco roto
   ni imagen de relleno. */
$sdn_upload_dir = '/uploads/2026/08/';

$sdn_photos = array(
	'payroll'           => 'servicio-nomina.webp',
	'certified-payroll' => 'servicio-nomina-certificada.webp',
	'bookkeeping'       => 'servicio-contabilidad.webp',
	'taxes'             => 'servicio-impuestos.webp',
	'notary'            => 'servicio-notaria.webp',
	'time-attendance'   => 'servicio-tiempo-y-asistencia.webp',
	'payroll-audits'    => 'servicio-auditorias-de-nomina.webp',
);

/* Igual que en services-template.php: sirve el tamaño mediano que
   WordPress ya generó, no el original de la biblioteca (hasta 14 MB
   en este set, para una tarjeta de 17-20rem), vía la misma
   `sdn_attachment_image()` que resuelve $sdn_img_certified arriba. El
   razonamiento completo está en services-template.php. */
$sdn_photo = function ( $key ) use ( $sdn_photos, $sdn_upload_dir ) {
	if ( empty( $sdn_photos[ $key ] ) ) {
		return null;
	}

	$relative = $sdn_upload_dir . $sdn_photos[ $key ];

	if ( ! file_exists( WP_CONTENT_DIR . $relative ) ) {
		return null;
	}

	$full_url = content_url( $relative );
	$img      = sdn_attachment_image( $full_url );

	if ( ! $img ) {
		return array(
			'src'    => $full_url,
			'srcset' => '',
			'sizes'  => '',
			'width'  => 1200,
			'height' => 900,
		);
	}

	$img['sizes'] = '(min-width: 640px) 20rem, 17rem';

	return $img;
};

$sdn_list = array_values( sdn_services() );
$sdn_keys = array_keys( sdn_services() );

/* ── Video de fondo — hero y bloque de cierre ───────────────
   Dos archivos distintos a propósito: el hero usa el video de marca
   (el mismo que graba la cara de la empresa, "About_Hero_SDN.mp4" —
   el nombre viene de cuando solo iba a vivir en Nosotros, pero es el
   que mejor abre la home) y el cierre se queda con la textura
   abstracta, para que la banda final no repita el primer plano.

   Ojo con la mayúscula: los archivos se subieron con mayúsculas y el
   servidor de producción sí distingue mayúsculas de minúsculas.

   El póster es el primer fotograma: es lo que ve quien pide movimiento
   reducido y lo que tapa el hueco mientras el MP4 carga. Va vacío
   hasta que exista el archivo — con la cadena vacía el atributo no se
   imprime y no hay 404. Se genera con:
     ffmpeg -i About_Hero_SDN.mp4 -vf "select=eq(n\,30)" \
            -vframes 1 -q:v 80 about-hero-poster.webp
   y luego se devuelve la línea comentada de abajo. */
$sdn_video_hero    = content_url( '/uploads/2026/08/About_Hero_SDN.mp4' );
$sdn_video_hero_ps = '';
// $sdn_video_hero_ps = content_url( '/uploads/2026/08/about-hero-poster.webp' );

$sdn_video_bg     = content_url( '/uploads/2026/08/Abstract_blue_dark.mp4' );
$sdn_video_poster = '';
// $sdn_video_poster = content_url( '/uploads/2026/08/abstract-blue-dark-poster.webp' );

/* ── Copy ──────────────────────────────────────────────── */
$c = $is_en ? array(

	/* 01 · Hero */
	'hero_eyebrow'   => 'Oregon and Washington · Service in English and Spanish',
	'hero_h1'        => 'Your payroll goes out on time. So do your filings.',
	'hero_deck'      => 'We run payroll, keep your books and prepare your taxes for businesses in Oregon and Washington. We check each state’s rules before every payroll run, not after.',
	'hero_cta1'      => 'Book an intake call',
	'hero_cta2'      => 'See the seven services',

	/* Tira de confianza — datos reales, ya escritos en el resto de la
	   página: cobertura, idioma, especialidad y oficina. */
	'ticker'         => array(
		'Oregon + Washington',
		'Service in English and Spanish',
		'Certified payroll',
		'Hillsboro, OR office',
	),

	/* Fila de cifras — todas contables desde datos reales de la
	   plantilla, ninguna inventada. */
	'stats_services' => 'Services, one office',
	'stats_states'    => 'States covered',
	'stats_langs'     => 'Languages served',

	/* 02 · Servicios */
	'svc_eyebrow'    => 'What we do',
	'svc_h2'         => 'Seven services. One point of contact.',
	'svc_deck'       => 'You don’t need to coordinate a bookkeeper, a tax preparer and a notary separately. It all runs through one office and one calendar.',
	'svc_link'       => 'See details',
	'svc_rail_l'     => 'All seven services',
	'svc_hint'       => 'Hover to stop · swipe to browse',
	'svc_alts'       => array(
		'payroll'           => 'Business owner reviewing payroll documents at a desk',
		'certified-payroll' => 'Crew foreman with a clipboard on a public works site',
		'bookkeeping'       => 'Bookkeeper reconciling accounts against a bank statement',
		'taxes'             => 'Tax forms and a calculator laid out on a desk',
		'notary'            => 'Notary stamping a document at the Hillsboro office',
		'time-attendance'   => 'Field crew recording hours at the start of a shift',
		'payroll-audits'    => 'Two people reviewing prior-period payroll records',
	),

	/* 03 · Nómina certificada */
	'cert_eyebrow'   => 'Specialty',
	'cert_h2'        => 'Winning a public works contract changes the rules on your payroll.',
	'cert_p1'        => 'State and city contracts require certified payroll reports. It isn’t the same payroll in a different format: what you report, how often, and to whom all change.',
	'cert_p2'        => 'An incomplete report can hold your payment until it’s fixed. We prepare and file them on the cycle the project requires.',
	'cert_cta'       => 'See certified payroll',
	'cert_alt'       => 'Crew on a public works site in Oregon',

	/* 04 · Cómo empieza */
	'how_eyebrow'    => 'How it starts',
	'how_h2'         => 'Three steps to your first payroll.',
	'step_label'     => 'Step',
	'how_steps'      => array(
		array( '01', 'Intake call', 'You tell us how many employees you have, which states you operate in and how you run payroll today. We come out with a scope and a price.' ),
		array( '02', 'Records handover', 'We take in your current-year records and reconcile them before touching anything. If something from prior years is open, you hear about it at this stage.' ),
		array( '03', 'Calendar operation', 'Your cycle is locked and reporting dates are set. From then on you only send us changes: hires, terminations, hours.' ),
	),

	/* 05 · Cobertura */
	'cov_eyebrow'    => 'Coverage',
	'cov_h2'         => 'Two states. Two sets of rules.',
	'cov_p'          => 'Oregon and Washington don’t share calendars, forms or obligations. A business operating in both carries two compliance tracks at once. We work with both every month.',
	'cov_label'      => 'Main office',
	'cov_note'       => 'We serve businesses across Oregon and Washington. The Hillsboro office is where notarizations and in-person appointments happen.',
	'cov_maptitle'   => 'Map of the Hillsboro office',

	/* 06 · Idioma */
	'lang_eyebrow'   => 'Bilingual service',
	'lang_h2'        => 'Language isn’t an add-on.',
	'lang_p'         => 'A letter from the IRS or the Department of Revenue doesn’t get clearer because someone translates it over the phone. We explain what it says, what they’re asking for and what happens if you don’t answer — in the language you make decisions in.',
	'lang_alt'       => 'Soluciones del Norte team at the Hillsboro office',

	/* 07 · Datos de operación */
	'ops_phone'      => 'Phone',
	'ops_email'      => 'Email',
	'ops_office'     => 'Office',
	'ops_hours'      => 'Hours',
	'ops_hours_v'    => 'Monday to Friday, 9:00–18:00 · Saturday, 10:00–14:00',
	'ops_hours_n'    => 'Closed Sundays and holidays',

	/* Preguntas frecuentes — versión general, no atada a un servicio.
	   Misma sección (copy + markup) que about-template.php, después de
	   Valores. Cada archivo es autocontenido, así que el bloque vive
	   completo en los dos en vez de en un partial. */
	'faq_l'     => 'FAQ',
	'faq_h2'    => 'What people ask before the first call.',
	'faq_note'  => 'If yours isn’t here, ask it on the intake call — it’s what the call is for.',
	'faqs'      => array(
		array(
			'How much does it cost?',
			'We don’t publish a price list because scope changes with your employee count and the states you operate in. The price comes out of the intake call, together with the scope, before you commit to anything.',
		),
		array(
			'What do you need for the first call?',
			'How many employees you have and which states you operate in. With those two answers we can already tell you which service you need.',
		),
		array(
			'What states do you work in?',
			'Oregon and Washington. Each has its own rules and calendar, and we work with both every month, not as an exception.',
		),
		array(
			'What language will I be served in?',
			'Spanish or English, whichever you use. There’s no translator in between: it’s the same person who runs your account explaining the letter that arrived.',
		),
		array(
			'Do I have to come to the office?',
			'Only for notarizations and in-person appointments, which happen in Hillsboro. Everything else we handle remotely.',
		),
		array(
			'How does the work start?',
			'In three steps: intake call, records handover, and calendar operation. In the second one we reconcile your current-year records before touching anything.',
		),
	),

	/* 08 · Cierre */
	'end_h2'         => 'How many employees do you have, and in which states?',
	'end_deck'       => 'With those two answers we can already tell you what you need. Write to us and we’ll set up the intake call.',
	'end_note'       => 'We reply during office hours, Monday to Friday.',
	'end_cta'        => 'Book an intake call',
	'end_img_alt'    => 'Soluciones del Norte team ready to take your call',

) : array(

	/* 01 · Hero */
	'hero_eyebrow'   => 'Oregon y Washington · Atención en español e inglés',
	'hero_h1'        => 'Tu nómina sale a tiempo. Tus reportes también.',
	'hero_deck'      => 'Procesamos nómina, llevamos tus libros y preparamos tus impuestos para negocios de Oregon y Washington. Revisamos la regla de cada estado antes de cada ciclo de nómina, no después.',
	'hero_cta1'      => 'Agendar consulta inicial',
	'hero_cta2'      => 'Ver los siete servicios',

	'ticker'         => array(
		'Oregon + Washington',
		'Atención en español e inglés',
		'Nómina certificada',
		'Oficina en Hillsboro, OR',
	),

	'stats_services' => 'Servicios en una oficina',
	'stats_states'    => 'Estados con cobertura',
	'stats_langs'     => 'Idiomas de atención',

	/* 02 · Servicios */
	'svc_eyebrow'    => 'Qué hacemos',
	'svc_h2'         => 'Siete servicios. Un solo punto de contacto.',
	'svc_deck'       => 'No tienes que coordinar por separado a un contador, un preparador de impuestos y un notario. Todo pasa por la misma oficina y el mismo calendario.',
	'svc_link'       => 'Ver detalle',
	'svc_rail_l'     => 'Los siete servicios',
	'svc_hint'       => 'Pasa el cursor para detener · desliza para recorrer',
	'svc_alts'       => array(
		'payroll'           => 'Dueño de negocio revisando documentos de nómina en su escritorio',
		'certified-payroll' => 'Encargado de cuadrilla con portapapeles en una obra pública',
		'bookkeeping'       => 'Contadora conciliando cuentas contra el estado de cuenta',
		'taxes'             => 'Formas de impuestos y una calculadora sobre el escritorio',
		'notary'            => 'Notario sellando un documento en la oficina de Hillsboro',
		'time-attendance'   => 'Cuadrilla en campo registrando horas al inicio del turno',
		'payroll-audits'    => 'Dos personas revisando registros de nómina de periodos anteriores',
	),

	/* 03 · Nómina certificada */
	'cert_eyebrow'   => 'Especialidad',
	'cert_h2'        => 'Si ganaste obra pública, tu nómina cambia de reglas.',
	'cert_p1'        => 'Los contratos estatales y municipales exigen reportes de nómina certificada. No es la misma nómina con otro formato: cambia lo que hay que declarar, con qué frecuencia y ante quién.',
	'cert_p2'        => 'Un reporte incompleto puede retener tu pago hasta que se corrija. Nosotros los preparamos y los entregamos en el ciclo que el proyecto exige.',
	'cert_cta'       => 'Ver nómina certificada',
	'cert_alt'       => 'Cuadrilla en una obra pública de Oregon',

	/* 04 · Cómo empieza */
	'how_eyebrow'    => 'Cómo empieza',
	'how_h2'         => 'Tres pasos hasta tu primera nómina.',
	'step_label'     => 'Paso',
	'how_steps'      => array(
		array( '01', 'Consulta inicial', 'Nos cuentas cuántos empleados tienes, en qué estados operas y cómo llevas la nómina hoy. Salimos de ahí con un alcance y un precio.' ),
		array( '02', 'Traspaso de registros', 'Recibimos tus registros del año en curso y los conciliamos antes de tocar nada. Si hay algo abierto de años anteriores, te lo decimos en esta etapa.' ),
		array( '03', 'Operación en calendario', 'Tu ciclo queda fijo y las fechas de reporte quedan marcadas. A partir de ahí solo nos mandas novedades: altas, bajas, horas.' ),
	),

	/* 05 · Cobertura */
	'cov_eyebrow'    => 'Cobertura',
	'cov_h2'         => 'Dos estados. Dos juegos de reglas.',
	'cov_p'          => 'Oregon y Washington no comparten calendario, formatos ni obligaciones. Un negocio que opera en los dos lleva dos cumplimientos en paralelo. Trabajamos con ambos todos los meses.',
	'cov_label'      => 'Oficina principal',
	'cov_note'       => 'Atendemos negocios de todo Oregon y Washington. La oficina de Hillsboro es donde se hacen las notarizaciones y las citas presenciales.',
	'cov_maptitle'   => 'Mapa de la oficina de Hillsboro',

	/* 06 · Idioma */
	'lang_eyebrow'   => 'Atención bilingüe',
	'lang_h2'        => 'El idioma no es un servicio adicional.',
	'lang_p'         => 'Una carta del IRS o del Departamento de Ingresos no se entiende mejor porque alguien te la traduzca por teléfono. Te explicamos qué dice, qué te están pidiendo y qué pasa si no respondes — en el idioma en el que tomas decisiones.',
	'lang_alt'       => 'Equipo de Soluciones del Norte en la oficina de Hillsboro',

	/* 07 · Datos de operación */
	'ops_phone'      => 'Teléfono',
	'ops_email'      => 'Correo',
	'ops_office'     => 'Oficina',
	'ops_hours'      => 'Horario',
	'ops_hours_v'    => 'Lunes a viernes, 9:00–18:00 · Sábado, 10:00–14:00',
	'ops_hours_n'    => 'Cerrado domingos y días festivos',

	'faq_l'     => 'Preguntas',
	'faq_h2'    => 'Lo que se pregunta antes de la primera llamada.',
	'faq_note'  => 'Si la tuya no está aquí, hazla en la consulta inicial — para eso es.',
	'faqs'      => array(
		array(
			'¿Cuánto cuesta?',
			'No publicamos lista de precios porque el alcance cambia con el número de empleados y los estados donde operas. El precio sale de la consulta inicial, junto con el alcance, y antes de que contrates nada.',
		),
		array(
			'¿Qué necesitan para la primera llamada?',
			'Cuántos empleados tienes y en qué estados operas. Con esas dos respuestas ya podemos decirte qué servicio necesitas.',
		),
		array(
			'¿En qué estados trabajan?',
			'Oregon y Washington. Cada uno tiene sus propias reglas y calendario, y trabajamos con los dos todos los meses, no como excepción.',
		),
		array(
			'¿En qué idioma me atienden?',
			'Español o inglés, el que uses. No hay traductor de por medio: es la misma persona que lleva tu cuenta la que te explica la carta que te llegó.',
		),
		array(
			'¿Tengo que ir a la oficina?',
			'Solo para notarizaciones y citas presenciales, que son en Hillsboro. Todo lo demás lo llevamos a distancia.',
		),
		array(
			'¿Cómo empieza el trabajo?',
			'En tres pasos: consulta inicial, traspaso de registros y operación en calendario. En el segundo conciliamos tus registros del año en curso antes de tocar nada.',
		),
	),

	/* 08 · Cierre */
	'end_h2'         => '¿Cuántos empleados tienes y en qué estados?',
	'end_deck'       => 'Con esas dos respuestas ya podemos decirte qué necesitas. Escríbenos y coordinamos la consulta inicial.',
	'end_note'       => 'Respondemos en horario de oficina, de lunes a viernes.',
	'end_cta'        => 'Agendar consulta inicial',
	'end_img_alt'    => 'Equipo de Soluciones del Norte listo para atender tu consulta',
);

$sdn_contact  = sdn_route( 'contact' );
$sdn_services = sdn_route( 'services' );
$sdn_tel      = 'tel:+1' . preg_replace( '/\D/', '', $sdn['phone1'] );
$sdn_tel2     = 'tel:+1' . preg_replace( '/\D/', '', $sdn['phone2'] );

/* Palabras del titular del hero, para el revelado cinético en CSS
   puro (sin JavaScript ni scroll: solo juega una vez, al cargar). */
$sdn_hero_words = explode( ' ', $c['hero_h1'] );
?>

<!-- Barra de avance de lectura — solo decorativa, nunca oculta nada. -->
<div id="sdn-progress" aria-hidden="true"></div>

<!-- ══════════════ 01 · HERO — texto izquierda / formulario derecha ══════════════
     Fondo en video, igual mecanismo que el cierre (08): el color de la
     superficie está debajo del <video>, así que el contraste del texto
     no depende de que el MP4 cargue. El `src` no va aquí: lo pone
     videoBg.js, que arranca la descarga de inmediato porque el hero ya
     está en el viewport al cargar la página.

     El titular se trocea en palabras con CSS puro (.sdn-kinetic-word):
     como no depende de scroll ni de observer, no hay ventana en la que
     pueda fallar — juega sola, 150ms después de cargar.
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-hero sdn-surface--video text-paper">
  <video
    class="sdn-video"
    data-sdn-video
    data-src="<?php echo esc_url( $sdn_video_hero ); ?>"
    <?php if ( $sdn_video_hero_ps ) : ?>poster="<?php echo esc_url( $sdn_video_hero_ps ); ?>"<?php endif; ?>
    muted loop playsinline preload="none"
    aria-hidden="true" tabindex="-1"></video>
  <div class="sdn-veil" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto grid max-w-[1200px] gap-12 px-6 pb-24 pt-16 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:pb-32 lg:pt-24">

    <div>
      <p class="sdn-hero-fade font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
        <span class="sdn-pulse-dot mr-2 inline-block h-1.5 w-1.5 rounded-full bg-accent align-middle" aria-hidden="true"></span>
        <span data-i18n="home.hero.eyebrow"><?php echo esc_html( $c['hero_eyebrow'] ); ?></span>
      </p>

      <h1 data-i18n="home.hero.h1" class="mt-5 font-display text-[2.125rem] font-bold leading-[1.05] tracking-[-0.02em] text-paper sm:text-5xl lg:text-[3.5rem]">
        <?php foreach ( $sdn_hero_words as $wi => $word ) : ?><span class="sdn-kinetic-word"><span style="--i:<?php echo (int) $wi; ?>"><?php echo esc_html( $word ); ?></span></span><?php echo ' '; ?><?php endforeach; ?>
      </h1>

      <div class="sdn-hero-rule mt-6 h-1 bg-accent" aria-hidden="true"></div>

      <p class="sdn-hero-fade sdn-hero-fade--2" data-i18n="home.hero.deck">
        <span class="sdn-measure mt-7 block text-[1.0625rem] leading-relaxed text-rule"><?php echo esc_html( $c['hero_deck'] ); ?></span>
      </p>

      <div class="sdn-hero-fade sdn-hero-fade--3 mt-9 flex flex-wrap items-center gap-3">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           data-i18n-href="route.contact"
           class="sdn-cta sdn-magnetic">
          <span data-i18n="home.hero.cta1"><?php echo esc_html( $c['hero_cta1'] ); ?></span>
        </a>
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           data-i18n-href="route.services"
           class="sdn-cta sdn-cta--ghost sdn-magnetic">
          <span data-i18n="home.hero.cta2"><?php echo esc_html( $c['hero_cta2'] ); ?></span>
        </a>
      </div>
    </div>

    <!-- Columna derecha: solo el formulario. Los datos de operación
         (oficina, cobertura, idiomas, horario) siguen en el bloque 07. -->
    <div class="sdn-hero-fade sdn-hero-fade--4"
         id="sdn-contact-form-hero"
         data-sdn-form
         data-density="compact"
         data-persistent="true"
         data-lang="<?php echo esc_attr( $sdn_lang ); ?>">
      <div class="sdn-frame rounded-sm border border-paper bg-paper/75 p-6 shadow-[0_20px_50px_rgba(29,24,22,0.25)] backdrop-blur-md">
        <p class="font-mono text-[0.9375rem] leading-relaxed text-ink">
          <a href="<?php echo esc_url( $sdn_tel ); ?>" class="tabular-nums underline decoration-rule underline-offset-4 hover:decoration-accent"><?php echo esc_html( $sdn['phone1'] ); ?></a><br>
          <a href="mailto:<?php echo esc_attr( $sdn['email'] ); ?>" class="break-all underline decoration-rule underline-offset-4 hover:decoration-accent"><?php echo esc_html( $sdn['email'] ); ?></a>
        </p>
      </div>
    </div>

    <!-- Pista de scroll: cabecea al pie del hero, solo desde lg. -->
    <div class="sdn-scrollcue" aria-hidden="true">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 5v14"/><path d="m6 13 6 6 6-6"/></svg>
    </div>

  </div>
</section>

<!-- Tira de confianza en marcha — datos reales (cobertura, idioma,
     especialidad, oficina), ya escritos en el resto de la página.
     Decorativa: aria-hidden, no repite ningún enlace. -->
<div class="sdn-ticker" aria-hidden="true">
  <div class="sdn-ticker__track">
    <?php for ( $tick_pass = 0; $tick_pass < 2; $tick_pass++ ) : ?>
      <?php foreach ( $c['ticker'] as $tick_i => $tick_item ) : ?>
        <span class="sdn-ticker__item" data-i18n="home.ticker.<?php echo esc_attr( $tick_i ); ?>"><?php echo esc_html( $tick_item ); ?></span>
        <span class="sdn-ticker__dot">&#9670;</span>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>

<!-- ══════════════ 02 · SERVICIOS — carrusel continuo + cifras ══════════════
     Mismo componente que la sección "Los siete servicios" de
     services-template.php: la mecánica del riel (detención al hover/
     foco, tarjetas duplicadas para el bucle sin costura, reserva
     estática con prefers-reduced-motion) está comentada allá, no se
     repite aquí. Debajo del texto se suma una fila de cifras — las
     tres, contables desde datos reales de esta misma plantilla.
     ══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-20 lg:px-12 lg:py-28">

    <span class="sdn-ghost-num sdn-ghost-num--tr" aria-hidden="true">02</span>

    <div data-reveal-group class="sdn-measure">
      <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
        <p class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted" data-i18n="home.svc.eyebrow">
          <?php echo esc_html( $c['svc_eyebrow'] ); ?>
        </p>
        <span class="sdn-tag" aria-hidden="true">02 / 08</span>
      </div>
      <h2 class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl" data-i18n="home.svc.h2">
        <?php echo esc_html( $c['svc_h2'] ); ?>
      </h2>
      <p class="sdn-reveal-stagger mt-5 leading-relaxed text-ink-2" data-i18n="home.svc.deck">
        <?php echo esc_html( $c['svc_deck'] ); ?>
      </p>
    </div>

    <div class="sdn-reveal-up sdn-stat-row sdn-frame mt-10 grid sm:grid-cols-3">
      <div class="sdn-stat-card">
        <span class="sdn-stat-card__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="3.5" y="3.5" width="7" height="7" rx="1"/><rect x="13.5" y="3.5" width="7" height="7" rx="1"/><rect x="3.5" y="13.5" width="7" height="7" rx="1"/><rect x="13.5" y="13.5" width="7" height="7" rx="1"/></svg>
        </span>
        <div class="sdn-stat-card__num"><span class="sdn-count" data-count-to="<?php echo (int) count( $sdn_list ); ?>">0</span></div>
        <p class="sdn-stat-card__label" data-i18n="home.stats.services"><?php echo esc_html( $c['stats_services'] ); ?></p>
      </div>
      <div class="sdn-stat-card">
        <span class="sdn-stat-card__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z"/><circle cx="12" cy="10" r="2.6"/></svg>
        </span>
        <div class="sdn-stat-card__num"><span class="sdn-count" data-count-to="2">0</span></div>
        <p class="sdn-stat-card__label" data-i18n="home.stats.states"><?php echo esc_html( $c['stats_states'] ); ?></p>
      </div>
      <div class="sdn-stat-card">
        <span class="sdn-stat-card__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M20.5 12.2c0 4-3.8 7.2-8.5 7.2a9.8 9.8 0 0 1-2.6-.35L4.5 20.5l1.35-3.9A6.9 6.9 0 0 1 3.5 12.2C3.5 8.2 7.3 5 12 5s8.5 3.2 8.5 7.2Z"/></svg>
        </span>
        <div class="sdn-stat-card__num"><span class="sdn-count" data-count-to="2">0</span></div>
        <p class="sdn-stat-card__label" data-i18n="home.stats.langs"><?php echo esc_html( $c['stats_langs'] ); ?></p>
      </div>
    </div>

    <div class="sdn-reveal-up mt-14 flex flex-wrap items-baseline justify-between gap-x-6 gap-y-2">
      <p data-i18n="home.svc.rail_l" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['svc_rail_l'] ); ?>
      </p>
      <p aria-hidden="true" data-i18n="home.svc.hint" class="font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-rule">
        <?php echo esc_html( $c['svc_hint'] ); ?>
      </p>
    </div>

    <div class="sdn-reveal-scale sdn-marquee mt-4">
      <ul class="sdn-marquee__track">

        <?php
        /* Dos pasadas sobre la misma lista: la original y el clon que
           cierra el bucle. La variable $clone gobierna lo que cambia. */
        for ( $pass = 0; $pass < 2; $pass++ ) :
        	$clone = ( 1 === $pass );
        	?>
        	<?php foreach ( $sdn_list as $i => $svc ) : ?>
        		<?php
        		$key = $sdn_keys[ $i ];
        		$img = $sdn_photo( $key );
        		$alt = isset( $c['svc_alts'][ $key ] ) ? $c['svc_alts'][ $key ] : $svc['name'];
        		?>
        		<li class="w-[17rem] shrink-0 sm:w-[20rem]"
        		    <?php echo $clone ? 'aria-hidden="true"' : ''; ?>>
        			<a href="<?php echo esc_url( home_url( $svc['path'] ) ); ?>"
        			   data-i18n-href="svc.<?php echo esc_attr( $key ); ?>.href"
        			   <?php echo $clone ? 'tabindex="-1"' : ''; ?>
        			   class="sdn-tilt group relative flex h-full flex-col overflow-hidden rounded-sm border border-rule bg-paper transition-colors duration-150 hover:border-accent">

        				<span class="sdn-index-chip" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>

        				<?php if ( $img ) : ?>
        					<img src="<?php echo esc_url( $img['src'] ); ?>"
        					     <?php if ( $img['srcset'] ) : ?>srcset="<?php echo esc_attr( $img['srcset'] ); ?>" sizes="<?php echo esc_attr( $img['sizes'] ); ?>"<?php endif; ?>
        					     alt="<?php echo $clone ? '' : esc_attr( $alt ); ?>"
        					     <?php echo $clone ? '' : 'data-i18n-alt="svc.' . esc_attr( $key ) . '.alt"'; ?>
        					     width="<?php echo esc_attr( $img['width'] ); ?>" height="<?php echo esc_attr( $img['height'] ); ?>"
        					     loading="lazy" decoding="async"
        					     class="aspect-[4/3] w-full object-cover">
        				<?php else : ?>
        					<!-- Reserva mientras no exista el archivo: una banda de
        					     papel con el número de orden. -->
        					<div aria-hidden="true"
        					     class="flex aspect-[4/3] w-full items-center justify-center bg-paper-3">
        						<span class="font-mono text-[2.5rem] font-light leading-none tabular-nums text-rule">
        							<?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
        						</span>
        					</div>
        				<?php endif; ?>

        				<div class="flex flex-1 flex-col p-6">
        					<h3 data-i18n="svc.<?php echo esc_attr( $key ); ?>.name" class="font-display text-[1.125rem] font-semibold leading-tight text-ink group-hover:text-accent-2">
        						<?php echo esc_html( $svc['name'] ); ?>
        					</h3>
        					<p data-i18n="svc.<?php echo esc_attr( $key ); ?>.desc" class="mt-2 flex-1 text-[0.9375rem] leading-snug text-muted">
        						<?php echo esc_html( $svc['desc'] ); ?>
        					</p>
        					<span class="mt-5 flex items-center gap-2 whitespace-nowrap font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted group-hover:text-accent-2">
        						<span data-i18n="home.svc.link"><?php echo esc_html( $c['svc_link'] ); ?></span>
        						<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 transition-transform duration-150 group-hover:translate-x-1" aria-hidden="true"><path d="M4 12h15"/><path d="m13 6 6 6-6 6"/></svg>
        					</span>
        				</div>

        			</a>
        		</li>
        	<?php endforeach; ?>
        <?php endfor; ?>

      </ul>
    </div>

  </div>
</section>

<!-- ══════════════ 03 · IDIOMA — texto izquierda / foto derecha ══════════════
     Cambió de lugar con "Nómina certificada" (antes iba aquí, ahora
     va donde estaba esta sección) — el color de fondo se queda fijo
     en su puesto para no romper la alternancia paper/paper-2 con las
     secciones vecinas; lo que viaja es el contenido.

     Sangrado a la mitad, en espejo con la sección 06: aquí es la
     columna de texto la que lleva el `max-w`/`px-*` que en el resto
     del sitio vive en `.sdn-layer`, y la foto llega al borde derecho
     real de la ventana. Ver el comentario de la sección 06 para el
     porqué completo.
     ═══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper-2 border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer grid lg:grid-cols-2 lg:items-stretch">

    <div data-reveal-group class="relative px-6 py-20 lg:flex lg:flex-col lg:justify-center lg:px-16 lg:py-16 xl:px-20">
      <span class="sdn-ghost-num sdn-ghost-num--tl" aria-hidden="true">03</span>
      <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
        <p class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted" data-i18n="home.lang.eyebrow">
          <?php echo esc_html( $c['lang_eyebrow'] ); ?>
        </p>
        <span class="sdn-tag" aria-hidden="true">03 / 08</span>
      </div>
      <h2 class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl" data-i18n="home.lang.h2">
        <?php echo esc_html( $c['lang_h2'] ); ?>
      </h2>
      <p class="sdn-reveal-stagger sdn-measure-sm mt-5 leading-relaxed text-ink-2" data-i18n="home.lang.p"><?php echo esc_html( $c['lang_p'] ); ?></p>

      <div class="sdn-reveal-stagger mt-8 flex items-center gap-5">
        <span class="sdn-poster-tile" aria-hidden="true">03</span>
        <div class="sdn-pill-row" aria-hidden="true">
          <span class="sdn-pill">Español</span>
          <span class="sdn-pill">English</span>
        </div>
      </div>
    </div>

    <figure class="sdn-wipe sdn-frame overflow-hidden">
      <img src="<?php echo esc_url( $sdn_img_team['src'] ); ?>"
           <?php if ( $sdn_img_team['srcset'] ) : ?>srcset="<?php echo esc_attr( $sdn_img_team['srcset'] ); ?>" sizes="<?php echo esc_attr( $sdn_img_team['sizes'] ); ?>"<?php endif; ?>
           data-i18n-alt="home.lang.alt"
           alt="<?php echo esc_attr( $c['lang_alt'] ); ?>"
           width="<?php echo esc_attr( $sdn_img_team['width'] ); ?>" height="<?php echo esc_attr( $sdn_img_team['height'] ); ?>"
           loading="lazy" decoding="async"
           class="sdn-wipe__img aspect-[4/3] h-full w-full object-cover lg:aspect-auto">
    </figure>

  </div>
</section>

<!-- ══════════════ 04 · CÓMO EMPIEZA — texto izquierda / pasos derecha ══════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <span class="sdn-ghost-num sdn-ghost-num--bl" aria-hidden="true">04</span>

    <div data-reveal-group class="lg:pt-2">
      <div class="sdn-reveal-stagger sdn-panel-accent">
        <div class="flex flex-wrap items-center justify-between gap-3">
          <p class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted" data-i18n="home.how.eyebrow">
            <?php echo esc_html( $c['how_eyebrow'] ); ?>
          </p>
          <span class="sdn-tag" aria-hidden="true">04 / 08</span>
        </div>
        <h2 class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl" data-i18n="home.how.h2">
          <?php echo esc_html( $c['how_h2'] ); ?>
        </h2>
      </div>

      <div class="sdn-reveal-stagger mt-8 hidden lg:block">
        <span class="sdn-poster-tile sdn-poster-tile--deep sdn-poster-tile--rotate-right" aria-hidden="true">04</span>
      </div>
    </div>

    <ol data-reveal-group class="space-y-10">
      <?php foreach ( $c['how_steps'] as $step_i => $step ) : ?>
        <li class="sdn-reveal-stagger relative grid grid-cols-[3.5rem_minmax(0,1fr)] gap-5 lg:grid-cols-[5rem_minmax(0,1fr)] lg:gap-6">
          <?php if ( $step_i > 0 ) : ?>
            <span class="sdn-step-line absolute left-[1.75rem] top-[-2.5rem] h-10 w-px bg-rule lg:left-[2.5rem]" aria-hidden="true"></span>
          <?php endif; ?>
          <div>
            <span class="sdn-step-label" data-i18n="home.how.step_label"><?php echo esc_html( $c['step_label'] ); ?></span>
            <span aria-hidden="true" class="sdn-step-num sdn-count font-mono text-[2.5rem] font-light leading-none text-rule lg:text-[3.25rem]" data-count-to="<?php echo (int) ( $step_i + 1 ); ?>">0</span>
          </div>
          <div class="min-w-0">
            <h3 data-i18n="home.how.<?php echo esc_attr( $step_i ); ?>.title" class="font-display text-[1.125rem] font-semibold text-ink"><?php echo esc_html( $step[1] ); ?></h3>
            <p data-i18n="home.how.<?php echo esc_attr( $step_i ); ?>.desc" class="sdn-measure mt-2 text-[0.9375rem] leading-relaxed text-ink-2"><?php echo esc_html( $step[2] ); ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ol>

  </div>
</section>

<!-- ══════════════ 05 · COBERTURA — mapa izquierda / texto derecha ══════════════ -->
<section class="sdn-surface sdn-surface--paper-2 border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <span class="sdn-ghost-num sdn-ghost-num--tr" aria-hidden="true">05</span>

    <div data-reveal-group class="lg:order-2 lg:pt-2">
      <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
        <p class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted" data-i18n="home.cov.eyebrow">
          <?php echo esc_html( $c['cov_eyebrow'] ); ?>
        </p>
        <span class="sdn-tag" aria-hidden="true">05 / 08</span>
      </div>
      <h2 class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl" data-i18n="home.cov.h2">
        <?php echo esc_html( $c['cov_h2'] ); ?>
      </h2>
      <p class="sdn-reveal-stagger sdn-measure mt-5 leading-relaxed text-ink-2" data-i18n="home.cov.p"><?php echo esc_html( $c['cov_p'] ); ?></p>

      <div class="sdn-reveal-stagger sdn-panel-accent sdn-panel-accent--paper2 mt-8">
        <p data-i18n="home.cov.label" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
          <?php echo esc_html( $c['cov_label'] ); ?>
        </p>
        <address class="mt-2 font-mono text-[0.9375rem] not-italic text-ink">
          <?php echo esc_html( $sdn['address'] ); ?>
        </address>
        <div class="sdn-pill-row mt-4" aria-hidden="true">
          <span class="sdn-pill">Oregon</span>
          <span class="sdn-pill">Washington</span>
        </div>
      </div>

      <p class="sdn-reveal-stagger sdn-measure mt-6 text-[0.875rem] leading-relaxed text-muted" data-i18n="home.cov.note">
        <?php echo esc_html( $c['cov_note'] ); ?>
      </p>
    </div>

    <div class="sdn-wipe sdn-frame lg:order-1 lg:self-start">
      <div class="sdn-wipe__img overflow-hidden rounded-sm border border-rule">
        <iframe
          data-i18n-title="home.cov.maptitle"
          title="<?php echo esc_attr( $c['cov_maptitle'] ); ?>"
          src="https://www.google.com/maps?q=<?php echo rawurlencode( $sdn['address'] ); ?>&output=embed"
          width="600" height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          class="block h-[22rem] w-full lg:h-[26rem]"
          style="border:0"></iframe>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════ 06 · NÓMINA CERTIFICADA — foto izquierda / texto derecha ══════════════
     Cambió de lugar con "Idioma" (antes iba aquí, ahora va donde
     estaba esta sección) — mismo criterio que en la sección 03: el
     color de fondo se queda fijo en su puesto, lo que viaja es el
     contenido.

     Único par de secciones del sitio con sangrado a la mitad: la
     foto llega al borde real de la ventana, no al borde de los
     1200px del resto del sistema. Por eso el `max-w`/`mx-auto`/
     `px-*` que en todas las demás secciones vive en `.sdn-layer` se
     movió adentro, a la columna de texto solamente — la de la
     imagen no lleva ninguno.
     ═══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer grid lg:grid-cols-2 lg:items-stretch">

    <div data-reveal-group class="relative px-6 py-20 lg:order-2 lg:flex lg:flex-col lg:justify-center lg:px-16 lg:py-16 xl:px-20">
      <span class="sdn-ghost-num sdn-ghost-num--br" aria-hidden="true">06</span>
      <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
        <p class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-accent-2" data-i18n="home.cert.eyebrow">
          <?php echo esc_html( $c['cert_eyebrow'] ); ?>
        </p>
        <span class="sdn-tag" aria-hidden="true">06 / 08</span>
      </div>
      <h2 class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl" data-i18n="home.cert.h2">
        <?php echo esc_html( $c['cert_h2'] ); ?>
      </h2>
      <p class="sdn-reveal-stagger sdn-measure mt-5 leading-relaxed text-ink-2" data-i18n="home.cert.p1"><?php echo esc_html( $c['cert_p1'] ); ?></p>
      <p class="sdn-reveal-stagger sdn-measure mt-4 leading-relaxed text-ink-2" data-i18n="home.cert.p2"><?php echo esc_html( $c['cert_p2'] ); ?></p>

      <div class="sdn-reveal-stagger mt-8 flex flex-wrap items-center gap-5">
        <a href="<?php echo esc_url( home_url( $is_en ? '/en/services/certified-payroll' : '/servicios/nomina-certificada' ) ); ?>"
           data-i18n-href="route.certified_payroll"
           class="sdn-cta sdn-magnetic">
          <span data-i18n="home.cert.cta"><?php echo esc_html( $c['cert_cta'] ); ?></span>
        </a>
        <span class="sdn-poster-tile sdn-poster-tile--rotate-right" aria-hidden="true">06</span>
      </div>
    </div>

    <figure class="sdn-wipe sdn-frame overflow-hidden lg:order-1">
      <img src="<?php echo esc_url( $sdn_img_certified['src'] ); ?>"
           <?php if ( $sdn_img_certified['srcset'] ) : ?>srcset="<?php echo esc_attr( $sdn_img_certified['srcset'] ); ?>" sizes="<?php echo esc_attr( $sdn_img_certified['sizes'] ); ?>"<?php endif; ?>
           data-i18n-alt="home.cert.alt"
           alt="<?php echo esc_attr( $c['cert_alt'] ); ?>"
           width="<?php echo esc_attr( $sdn_img_certified['width'] ); ?>" height="<?php echo esc_attr( $sdn_img_certified['height'] ); ?>"
           loading="lazy" decoding="async"
           class="sdn-wipe__img aspect-[4/3] h-full w-full object-cover lg:aspect-auto">
    </figure>

  </div>
</section>

<!-- ══════════════ 07 · DATOS DE OPERACIÓN — banda a ancho completo ══════════════
     Retícula hexagonal (.sdn-grid) sobre Space Indigo. El
     contenido va en su propia capa para quedar siempre por encima.
     ═══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-edge-accent text-paper">
  <div class="sdn-grid" aria-hidden="true"></div>
  <div class="sdn-stripe-bg" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-14 lg:px-12 lg:py-16">

    <span class="sdn-ghost-num sdn-ghost-num--tl" aria-hidden="true">07</span>

    <div class="sdn-reveal-up mb-8 flex justify-end">
      <span class="sdn-tag" aria-hidden="true">07 / 08</span>
    </div>

    <div data-reveal-group class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

      <div class="sdn-reveal-stagger min-w-0">
        <span class="sdn-ops-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M6.5 3h3l1.5 4-2 1.4a12 12 0 0 0 5.6 5.6L16 12l4 1.5v3a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 3.5 5.2 2 2 0 0 1 5.5 3Z"/></svg>
        </span>
        <p data-i18n="home.ops.phone" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_phone'] ); ?></p>
        <p class="mt-3 space-y-1 font-mono text-[0.9375rem]">
          <a href="<?php echo esc_url( $sdn_tel ); ?>" class="block tabular-nums hover:text-accent"><?php echo esc_html( $sdn['phone1'] ); ?></a>
          <a href="<?php echo esc_url( $sdn_tel2 ); ?>" class="block tabular-nums hover:text-accent"><?php echo esc_html( $sdn['phone2'] ); ?></a>
        </p>
      </div>

      <div class="sdn-reveal-stagger min-w-0 lg:border-l lg:border-dashed lg:border-paper/20 lg:pl-8">
        <span class="sdn-ops-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><rect x="2.5" y="4.5" width="19" height="15" rx="1.5"/><path d="m3 6 9 6.5L21 6"/></svg>
        </span>
        <p data-i18n="home.ops.email" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_email'] ); ?></p>
        <p class="mt-3 font-mono text-[0.9375rem]">
          <a href="mailto:<?php echo esc_attr( $sdn['email'] ); ?>" class="break-all hover:text-accent"><?php echo esc_html( $sdn['email'] ); ?></a>
        </p>
      </div>

      <div class="sdn-reveal-stagger min-w-0 lg:border-l lg:border-dashed lg:border-paper/20 lg:pl-8">
        <span class="sdn-ops-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s7-6.2 7-11a7 7 0 1 0-14 0c0 4.8 7 11 7 11Z"/><circle cx="12" cy="10" r="2.6"/></svg>
        </span>
        <p data-i18n="home.ops.office" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_office'] ); ?></p>
        <address class="mt-3 font-mono text-[0.9375rem] not-italic leading-relaxed"><?php echo esc_html( $sdn['address'] ); ?></address>
      </div>

      <div class="sdn-reveal-stagger min-w-0 lg:border-l lg:border-dashed lg:border-paper/20 lg:pl-8">
        <span class="sdn-ops-icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="16" height="16" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="8.5"/><path d="M12 7.5V12l3 2"/></svg>
        </span>
        <p data-i18n="home.ops.hours" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_hours'] ); ?></p>
        <p data-i18n="home.ops.hours_v" class="mt-3 font-mono text-[0.9375rem] tabular-nums leading-relaxed"><?php echo esc_html( $c['ops_hours_v'] ); ?></p>
        <p data-i18n="home.ops.hours_n" class="mt-1 font-mono text-[0.8125rem] leading-relaxed text-rule"><?php echo esc_html( $c['ops_hours_n'] ); ?></p>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Preguntas frecuentes ══════════════
     Sigue siendo <details> nativo — se abre y cierra sin JavaScript y
     sigue siendo utilizable si el bundle no carga. La versión general,
     no atada a un servicio, se repite en about-template.php después de
     Valores. Cada pregunta suma un número y un acento de color, sin
     cambiar el mecanismo de abrir/cerrar. -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">
    <div class="lg:grid lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)] lg:gap-16">

      <div data-reveal-group class="lg:pt-1">
        <p class="sdn-reveal-stagger sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted" data-i18n="home.faq.l">
          <?php echo esc_html( $c['faq_l'] ); ?>
        </p>
        <h2 class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-[2.25rem]" data-i18n="home.faq.h2">
          <?php echo esc_html( $c['faq_h2'] ); ?>
        </h2>
        <p class="sdn-reveal-stagger sdn-measure-sm mt-5 text-[0.9375rem] leading-relaxed text-muted" data-i18n="home.faq.note">
          <?php echo esc_html( $c['faq_note'] ); ?>
        </p>
      </div>

      <div data-reveal-group class="mt-10 space-y-3 lg:mt-0">
        <?php
        $sdn_faq_tones = array( 'var(--color-accent)', 'var(--color-deep)', 'var(--color-accent-2)' );
        foreach ( $c['faqs'] as $i => $faq ) :
        ?>
          <details class="sdn-faq2 sdn-reveal-stagger group" style="--faq-tone: <?php echo esc_attr( $sdn_faq_tones[ $i % 3 ] ); ?>;">
            <summary class="flex cursor-pointer items-start gap-4 py-5">
              <span class="sdn-faq2__num mt-0.5 shrink-0" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) . ' / ' . str_pad( (string) count( $c['faqs'] ), 2, '0', STR_PAD_LEFT ) ); ?></span>
              <span data-i18n="home.faq.<?php echo esc_attr( $i ); ?>.q" class="sdn-measure-sm flex-1 font-display text-[1.0625rem] font-semibold leading-snug text-ink transition-colors duration-150 group-hover:text-accent-2">
                <?php echo esc_html( $faq[0] ); ?>
              </span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                   class="mt-1 h-4 w-4 shrink-0 text-muted transition-transform duration-200 group-open:rotate-180" aria-hidden="true">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </summary>
            <p data-i18n="home.faq.<?php echo esc_attr( $i ); ?>.a" class="sdn-measure-sm py-1 pb-6 pl-[2.25rem] text-[1.0625rem] leading-[1.65] text-ink-2">
              <?php echo esc_html( $faq[1] ); ?>
            </p>
          </details>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ 08 · CIERRE — texto izquierda / formulario derecha ══════════════
     Fondo en video sobre Space Indigo. El color de la superficie está
     debajo del <video>, así que el contraste del texto no depende de
     que el MP4 cargue: si falla, si tarda, o si el visitante pide
     movimiento reducido, la banda se ve en color plano y se lee igual.

     El `src` no va aquí: lo pone videoBg.js cuando la sección se
     acerca al viewport, para no descargar el archivo en la primera
     carga de la home.

     Sin .sdn-grid: la retícula hexagonal encima del video sería una
     textura sobre otra y no se leería ninguna de las dos.
     ═══════════════════════════════════════════════════════════════ -->
<section id="contacto" class="sdn-surface sdn-surface--video border-t border-paper/15 text-paper">
  <video
    class="sdn-video"
    data-sdn-video
    data-src="<?php echo esc_url( $sdn_video_bg ); ?>"
    <?php if ( $sdn_video_poster ) : ?>poster="<?php echo esc_url( $sdn_video_poster ); ?>"<?php endif; ?>
    muted loop playsinline preload="none"
    aria-hidden="true" tabindex="-1"></video>

  <div class="sdn-veil" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <span class="sdn-ghost-num sdn-ghost-num--tl" aria-hidden="true">08</span>

    <div data-reveal-group class="lg:pt-2">
      <div class="sdn-reveal-stagger flex justify-end">
        <span class="sdn-tag" aria-hidden="true">08 / 08</span>
      </div>
      <h2 class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-4xl" data-i18n="home.end.h2">
        <?php echo esc_html( $c['end_h2'] ); ?>
      </h2>
      <p class="sdn-reveal-stagger sdn-measure mt-5 leading-relaxed text-rule" data-i18n="home.end.deck"><?php echo esc_html( $c['end_deck'] ); ?></p>
      <p class="sdn-reveal-stagger mt-6 font-mono text-[0.8125rem] text-rule" data-i18n="home.end.note"><?php echo esc_html( $c['end_note'] ); ?></p>

      <figure class="sdn-wipe sdn-frame sdn-reveal-stagger mt-8 overflow-hidden rounded-sm border border-paper/15">
        <img src="<?php echo esc_url( $sdn_img_contact ); ?>"
             data-i18n-alt="home.end.img_alt"
             alt="<?php echo esc_attr( $c['end_img_alt'] ); ?>"
             width="1200" height="900" loading="lazy" decoding="async"
             class="sdn-wipe__img aspect-[4/3] w-full object-cover">
      </figure>
    </div>

    <!--
      Nodo de montaje del ContactForm (componente React, pendiente).
      El contenido interno es la reserva: si el JS no carga o el
      componente aún no existe, el visitante sigue teniendo una salida.
    -->
    <div class="sdn-reveal-right"
         id="sdn-contact-form-cierre"
         data-sdn-form
         data-density="comfortable"
         data-persistent="true"
         data-lang="<?php echo esc_attr( $sdn_lang ); ?>">
      <div class="rounded-sm border border-rule bg-paper-2 p-8">
        <p class="font-mono text-[0.9375rem] leading-relaxed text-ink">
          <a href="<?php echo esc_url( $sdn_tel ); ?>" class="tabular-nums underline decoration-rule underline-offset-4 hover:decoration-accent"><?php echo esc_html( $sdn['phone1'] ); ?></a><br>
          <a href="mailto:<?php echo esc_attr( $sdn['email'] ); ?>" class="break-all underline decoration-rule underline-offset-4 hover:decoration-accent"><?php echo esc_html( $sdn['email'] ); ?></a>
        </p>
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           data-i18n-href="route.contact"
           class="sdn-cta sdn-magnetic mt-6">
          <span data-i18n="home.end.cta"><?php echo esc_html( $c['end_cta'] ); ?></span>
        </a>
      </div>
    </div>

  </div>
</section>

<?php
get_footer();
