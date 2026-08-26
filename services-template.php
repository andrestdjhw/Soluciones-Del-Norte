<?php
/**
 * Template Name: Servicios
 *
 * Soluciones del Norte · Servicios (hub)
 *
 * Los siete servicios se presentan como carrusel de tarjetas en
 * movimiento continuo. Desviación consciente respecto al brief, que
 * para esta página pedía Index-First (lista de siete filas con reglas
 * de un pixel). Consecuencia a tener presente: el mega-menú pasa a ser
 * el único lugar del sitio donde los siete se ven a la vez.
 *
 * Debajo: testimonios, preguntas frecuentes y el formulario de cierre.
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

/* ── Fotos de las tarjetas ─────────────────────────────────
   Un archivo por servicio, todos en la misma carpeta de la biblioteca.
   Los nombres ya están escritos: cuando subas las imágenes con estos
   nombres exactos, aparecen solas y no hay que tocar la plantilla.

   Mientras un archivo no exista, su tarjeta se dibuja sin foto —ni
   hueco roto ni icono de imagen rota— gracias a la comprobación de
   más abajo.

   Formato: WebP, 1200 × 900 (4:3), sin filtros ni superposiciones.
   El brief es explícito en §3.7: foto recta, esquinas de 2 px. La
   marca es un despacho de nómina, no una agencia creativa.

   ── Búsquedas sugeridas para Envato Elements ──────────────
   Van en inglés porque el buscador de Envato responde mucho mejor así.
   El criterio en todas: gente trabajando de verdad, luz natural,
   nada de traje azul apuntando a una gráfica ni de apretón de manos.

   nomina            → "small business owner reviewing payroll documents desk"
                       alterna: "hispanic business owner laptop paperwork office"
   nomina-certificada→ "construction crew foreman clipboard job site morning"
                       alterna: "road construction workers public works project"
   contabilidad      → "bookkeeper reviewing financial statements desk natural light"
                       alterna: "accountant organizing receipts invoices desk"
   impuestos         → "tax documents calculator desk paperwork organized"
                       alterna: "W-2 1099 tax forms flat lay desk"
   notaria           → "notary public stamping document signature desk"
                       alterna: "signing legal document pen close up office"
   tiempo-y-asistencia → "landscaping crew field workers timesheet"
                       alterna: "warehouse shift workers clocking in"
   auditorias        → "reviewing spreadsheets magnifier audit paperwork"
                       alterna: "two people reviewing documents together desk"

   Evita en todas: fondos blancos de estudio, modelos sonriendo a
   cámara, cascos amarillos impecables, y cualquier imagen con texto
   en inglés legible dentro de la foto (el sitio es bilingüe).
   ───────────────────────────────────────────────────────── */
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

/* Devuelve la URL solo si el archivo está subido. Así la página no
   muestra imágenes rotas mientras se consigue la fotografía. */
$sdn_photo_url = function ( $key ) use ( $sdn_photos, $sdn_upload_dir ) {
	if ( empty( $sdn_photos[ $key ] ) ) {
		return '';
	}

	$relative = $sdn_upload_dir . $sdn_photos[ $key ];

	return file_exists( WP_CONTENT_DIR . $relative ) ? content_url( $relative ) : '';
};

/* ── Testimonios ───────────────────────────────────────────
   TODO: pendiente de recibir testimonios reales del cliente, por
   escrito y con autorización de la persona que los da.

   El array va vacío a propósito. La regla de honestidad del copy
   (brief §2, y el mismo criterio del Pendiente 04 con las cifras de
   "10+ años" y "200+ negocios") prohíbe inventar testimonios, así que
   el bloque no se imprime mientras no haya contenido.

   No se traducen: un testimonio se publica en el idioma en que lo dio
   la persona. Por eso este array es uno solo y no tiene versión ES/EN.

	array(
		'quote' => 'Lo que dijo la persona, literal.',
		'name'  => 'Nombre y apellido',
		'org'   => 'Negocio · Ciudad, Estado',
	),
   ───────────────────────────────────────────────────────── */
$sdn_testimonials = array();

$c = $is_en ? array(
	'eyebrow'   => 'Services',
	'h1'        => 'Seven services, ordered by what they solve.',
	'deck'      => 'Each one has its own page with what we need from you, what we do and what you get. If you don’t know where to start, start with Payroll.',
	'link'      => 'See details',
	'rail_l'    => 'All seven services',
	'rail_hint' => 'Hover to stop · swipe to browse',

	/* Texto alternativo de cada foto, en el idioma de la página. */
	'alts'      => array(
		'payroll'           => 'Business owner reviewing payroll documents at a desk',
		'certified-payroll' => 'Crew foreman with a clipboard on a public works site',
		'bookkeeping'       => 'Bookkeeper reconciling accounts against a bank statement',
		'taxes'             => 'Tax forms and a calculator laid out on a desk',
		'notary'            => 'Notary stamping a document at the Hillsboro office',
		'time-attendance'   => 'Field crew recording hours at the start of a shift',
		'payroll-audits'    => 'Two people reviewing prior-period payroll records',
	),

	'tst_l'     => 'Clients',
	'tst_h2'    => 'What businesses we work with say.',
	'tst_hint'  => 'Swipe to read more',

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
			'How does the work start?',
			'In three steps: intake call, records handover, and calendar operation. In the second one we reconcile your current-year records before touching anything.',
		),
		array(
			'I only work with 1099 contractors — do I need payroll?',
			'No. What you need is bookkeeping, plus 1099 preparation at year end.',
		),
		array(
			'Do you work outside Oregon and Washington?',
			'We work with Oregon and Washington. If your situation includes income from other states, say so on the intake call — it changes the scope.',
		),
		array(
			'Do I have to come to the office?',
			'Only for notarizations and in-person appointments, which happen in Hillsboro. Everything else we handle remotely.',
		),
		array(
			'I’m coming from another provider and I think there are errors in earlier periods.',
			'If we find something open from a prior year, you hear it in the first week. Reviewing it properly is a separate service: payroll audits.',
		),
		array(
			'What language will I be served in?',
			'Spanish or English, whichever you use. There’s no translator in between: it’s the same person who runs your payroll explaining the letter that arrived.',
		),
	),

	'end_h2'    => 'None of these are bought sight unseen.',
	'end_deck'  => 'Everything starts with the same intake call. Tell us how many employees you have and which states you operate in.',
	'end_note'  => 'We reply during office hours, Monday to Friday.',
	'end_cta'   => 'Book an intake call',
) : array(
	'eyebrow'   => 'Servicios',
	'h1'        => 'Siete servicios, ordenados por lo que resuelven.',
	'deck'      => 'Cada uno tiene su propia página con lo que necesitamos de ti, lo que hacemos y lo que recibes. Si no sabes por dónde empezar, empieza por Nómina.',
	'link'      => 'Ver detalle',
	'rail_l'    => 'Los siete servicios',
	'rail_hint' => 'Pasa el cursor para detener · desliza para recorrer',

	'alts'      => array(
		'payroll'           => 'Dueño de negocio revisando documentos de nómina en su escritorio',
		'certified-payroll' => 'Encargado de cuadrilla con portapapeles en una obra pública',
		'bookkeeping'       => 'Contadora conciliando cuentas contra el estado de cuenta',
		'taxes'             => 'Formas de impuestos y una calculadora sobre el escritorio',
		'notary'            => 'Notario sellando un documento en la oficina de Hillsboro',
		'time-attendance'   => 'Cuadrilla en campo registrando horas al inicio del turno',
		'payroll-audits'    => 'Dos personas revisando registros de nómina de periodos anteriores',
	),

	'tst_l'     => 'Clientes',
	'tst_h2'    => 'Lo que dicen los negocios con los que trabajamos.',
	'tst_hint'  => 'Desliza para leer más',

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
			'¿Cómo empieza el trabajo?',
			'En tres pasos: consulta inicial, traspaso de registros y operación en calendario. En el segundo conciliamos tus registros del año en curso antes de tocar nada.',
		),
		array(
			'Solo trabajo con contratistas 1099, ¿necesito nómina?',
			'No. Lo que necesitas es contabilidad, más la preparación de las 1099 al cierre del año.',
		),
		array(
			'¿Atienden fuera de Oregon y Washington?',
			'Trabajamos con Oregon y Washington. Si tu caso incluye ingresos de otros estados, dilo en la consulta inicial: cambia el alcance.',
		),
		array(
			'¿Tengo que ir a la oficina?',
			'Solo para notarizaciones y citas presenciales, que son en Hillsboro. Todo lo demás lo llevamos a distancia.',
		),
		array(
			'Vengo de otro proveedor y creo que hay errores de años anteriores.',
			'Si encontramos algo abierto de un año anterior, te lo decimos en la primera semana. Revisarlo a fondo es un servicio aparte: auditorías de nómina.',
		),
		array(
			'¿En qué idioma me atienden?',
			'Español o inglés, el que uses. No hay traductor de por medio: es la misma persona que hace tu nómina la que te explica la carta que te llegó.',
		),
	),

	'end_h2'    => 'Ninguno de estos servicios se contrata a ciegas.',
	'end_deck'  => 'Todo empieza con la misma consulta inicial. Dinos cuántos empleados tienes y en qué estados operas.',
	'end_note'  => 'Respondemos en horario de oficina, de lunes a viernes.',
	'end_cta'   => 'Agendar consulta inicial',
);

/*
 * TODO (Pendiente 03): las ocho respuestas de las FAQ no traen ningún
 * dato nuevo — están reformuladas del copy deck (las etapas 1.0 a 4.0
 * de las siete páginas y el bloque 08 de la home). Aun así el cliente
 * tiene que confirmarlas: una FAQ es lo que más se cita de vuelta en
 * una llamada, y la de precio en particular fija una expectativa.
 */

$sdn_contact = sdn_route( 'contact' );
$sdn_list    = array_values( sdn_services() );
$sdn_keys    = array_keys( sdn_services() );

$sdn_tel = 'tel:+1' . preg_replace( '/\D/', '', $sdn['phone1'] );

/* Fondo en video del cierre — el mismo del bloque 08 de la home. */
$sdn_video_bg     = content_url( '/uploads/2026/08/Abstract_blue_dark.mp4' );
$sdn_video_poster = '';
?>

<!-- ══════════════ Entrada ══════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 pb-14 pt-16 lg:px-12 lg:pb-16 lg:pt-24">
    <div data-reveal>

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['eyebrow'] ); ?>
      </p>

      <h1 class="sdn-measure mt-5 font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-ink sm:text-[2.75rem] lg:text-5xl">
        <?php echo esc_html( $c['h1'] ); ?>
      </h1>

      <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

      <p class="sdn-measure mt-8 text-[1.125rem] leading-[1.65] text-ink-2">
        <?php echo esc_html( $c['deck'] ); ?>
      </p>

    </div>
  </div>
</section>

<!-- ══════════════ Los siete servicios · carrusel continuo ══════════════
     El riel se mueve solo, en CSS, sin librería: el proyecto sigue
     siendo motion-cut.

     Tres cosas que hacen que un marquee sea usable y no una molestia:

       · Se detiene al pasar el cursor y al recibir foco de teclado.
         Sin esto, cada tarjeta es un objetivo en movimiento y clicarla
         es una pelea. Es la diferencia entre un carrusel y un anuncio.

       · Las tarjetas están duplicadas para que el bucle no tenga
         costura. La segunda copia lleva aria-hidden y tabindex="-1":
         para un lector de pantalla y para el tabulador los servicios
         siguen siendo siete, no catorce.

       · Con prefers-reduced-motion la animación no arranca, los clones
         se ocultan y el riel se vuelve una lista deslizable normal.
     ══════════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper-2 border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] py-14 lg:py-16">

    <div data-reveal class="flex flex-wrap items-baseline justify-between gap-x-6 gap-y-2 px-6 lg:px-12">
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['rail_l'] ); ?>
      </p>
      <p aria-hidden="true" class="font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-rule">
        <?php echo esc_html( $c['rail_hint'] ); ?>
      </p>
    </div>

    <div data-reveal="80" class="sdn-marquee mt-8">
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
        		$img = $sdn_photo_url( $key );
        		$alt = isset( $c['alts'][ $key ] ) ? $c['alts'][ $key ] : $svc['name'];
        		?>
        		<li class="w-[17rem] shrink-0 sm:w-[20rem]"
        		    <?php echo $clone ? 'aria-hidden="true"' : ''; ?>>
        			<a href="<?php echo esc_url( home_url( $svc['path'] ) ); ?>"
        			   <?php echo $clone ? 'tabindex="-1"' : ''; ?>
        			   class="group flex h-full flex-col overflow-hidden rounded-sm border border-rule bg-paper transition-colors duration-150 hover:border-accent">

        				<?php if ( $img ) : ?>
        					<img src="<?php echo esc_url( $img ); ?>"
        					     alt="<?php echo $clone ? '' : esc_attr( $alt ); ?>"
        					     width="1200" height="900" loading="lazy" decoding="async"
        					     class="aspect-[4/3] w-full object-cover">
        				<?php else : ?>
        					<!-- Reserva mientras no exista el archivo: una banda de
        					     papel con el número de orden. Ni hueco roto ni
        					     imagen de relleno de banco de imágenes. -->
        					<div aria-hidden="true"
        					     class="flex aspect-[4/3] w-full items-center justify-center bg-paper-3">
        						<span class="font-mono text-[2.5rem] font-light leading-none tabular-nums text-rule">
        							<?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) ); ?>
        						</span>
        					</div>
        				<?php endif; ?>

        				<div class="flex flex-1 flex-col p-6">
        					<h2 class="font-display text-[1.125rem] font-semibold leading-tight text-ink group-hover:text-accent-2">
        						<?php echo esc_html( $svc['name'] ); ?>
        					</h2>
        					<p class="mt-2 flex-1 text-[0.9375rem] leading-snug text-muted">
        						<?php echo esc_html( $svc['desc'] ); ?>
        					</p>
        					<span class="mt-5 flex items-center gap-2 whitespace-nowrap font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted group-hover:text-accent-2">
        						<?php echo esc_html( $c['link'] ); ?>
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

<!-- ══════════════ Testimonios ══════════════
     Carrusel con scroll-snap, sin movimiento automático: aquí el
     visitante está leyendo, y un texto que se desplaza solo no se lee.

     Si el array está vacío, la sección entera no se imprime.
     ═════════════════════════════════════════ -->
<?php if ( $sdn_testimonials ) : ?>
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] py-16 lg:py-20">

    <div data-reveal class="px-6 lg:px-12">
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['tst_l'] ); ?>
      </p>
      <h2 class="sdn-measure mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-[2.25rem]">
        <?php echo esc_html( $c['tst_h2'] ); ?>
      </h2>
    </div>

    <ul data-reveal="80"
        tabindex="0"
        aria-label="<?php echo esc_attr( $c['tst_h2'] ); ?>"
        class="sdn-rail mt-10 flex snap-x snap-mandatory gap-5 overflow-x-auto px-6 pb-6 lg:px-12">
      <?php foreach ( $sdn_testimonials as $t ) : ?>
        <li class="w-[85%] shrink-0 snap-start sm:w-[60%] lg:w-[32%]">
          <figure class="flex h-full flex-col rounded-sm border border-rule bg-paper-2 p-7">
            <div class="h-1 w-12 bg-accent" aria-hidden="true"></div>

            <blockquote class="mt-6 flex-1 text-[1.0625rem] leading-[1.65] text-ink">
              <?php echo esc_html( $t['quote'] ); ?>
            </blockquote>

            <figcaption class="mt-7 border-t border-rule-2 pt-5">
              <span class="block font-display text-[0.9375rem] font-semibold text-ink">
                <?php echo esc_html( $t['name'] ); ?>
              </span>
              <?php if ( ! empty( $t['org'] ) ) : ?>
                <span class="mt-1 block font-mono text-[0.8125rem] text-muted">
                  <?php echo esc_html( $t['org'] ); ?>
                </span>
              <?php endif; ?>
            </figcaption>
          </figure>
        </li>
      <?php endforeach; ?>
    </ul>

    <?php if ( count( $sdn_testimonials ) > 1 ) : ?>
      <p aria-hidden="true" class="px-6 font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted lg:px-12">
        <?php echo esc_html( $c['tst_hint'] ); ?>
      </p>
    <?php endif; ?>

  </div>
</section>
<?php endif; ?>

<!-- ══════════════ Preguntas frecuentes ══════════════
     <details> nativo: se abre y se cierra sin JavaScript, funciona con
     teclado sin que haya que cablear nada, y sigue siendo utilizable si
     el bundle no carga.
     ══════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">
    <div class="lg:grid lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)] lg:gap-16">

      <div data-reveal class="lg:pt-1">
        <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
          <?php echo esc_html( $c['faq_l'] ); ?>
        </p>
        <h2 class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-[2.25rem]">
          <?php echo esc_html( $c['faq_h2'] ); ?>
        </h2>
        <p class="sdn-measure-sm mt-5 text-[0.9375rem] leading-relaxed text-muted">
          <?php echo esc_html( $c['faq_note'] ); ?>
        </p>
      </div>

      <div data-reveal="80" class="mt-10 lg:mt-0">
        <?php foreach ( $c['faqs'] as $i => $faq ) : ?>
          <details class="sdn-faq group border-b border-rule <?php echo 0 === $i ? 'border-t' : ''; ?>">
            <summary class="flex cursor-pointer items-start justify-between gap-6 py-5">
              <span class="sdn-measure-sm font-display text-[1.0625rem] font-semibold leading-snug text-ink transition-colors duration-150 group-hover:text-accent-2">
                <?php echo esc_html( $faq[0] ); ?>
              </span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                   class="mt-1 h-4 w-4 shrink-0 text-muted transition-transform duration-200 group-open:rotate-180" aria-hidden="true">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </summary>
            <p class="sdn-measure-sm pb-6 text-[1.0625rem] leading-[1.65] text-ink-2">
              <?php echo esc_html( $faq[1] ); ?>
            </p>
          </details>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Cierre — texto izquierda / formulario derecha ══════════════
     Mismo bloque que el 08 de la home: fondo en video sobre Space
     Indigo, con el color de la superficie debajo para que el contraste
     no dependa de que el MP4 cargue.
     ═══════════════════════════════════════════════════════════════════ -->
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

    <div data-reveal class="lg:pt-2">
      <h2 class="font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-4xl">
        <?php echo esc_html( $c['end_h2'] ); ?>
      </h2>
      <p class="sdn-measure mt-5 leading-relaxed text-rule"><?php echo esc_html( $c['end_deck'] ); ?></p>
      <p class="mt-6 font-mono text-[0.8125rem] text-rule"><?php echo esc_html( $c['end_note'] ); ?></p>
    </div>

    <!--
      Nodo de montaje del ContactForm. El contenido interno es la
      reserva: si el JS no carga, el visitante sigue teniendo salida.
    -->
    <div data-reveal="80"
         id="sdn-contact-form-servicios"
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
           class="mt-6 inline-block whitespace-nowrap rounded-sm bg-accent-2 px-6 py-3.5 font-body text-[0.9375rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px">
          <?php echo esc_html( $c['end_cta'] ); ?>
        </a>
      </div>
    </div>

  </div>
</section>

<?php
get_footer();