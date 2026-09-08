<?php
/**
 * Template Name: Nosotros
 *
 * Soluciones del Norte · Nosotros
 * Macroestructura: Long Document (02) — prosa continua con encabezados
 * en línea y raíl de etiquetas a la izquierda. Medida de 62 caracteres.
 *
 * Sistema de movimiento "v2" (el mismo de home-template.php): revelados
 * direccionales, imagen en cortina (.sdn-wipe), ficha de póster, panel
 * de acento y tarjetas con inclinación 3D. El hero es deliberadamente
 * distinto al de home — un solo bloque de texto, sin formulario, con
 * su propio video — para que esta página se sienta como el documento
 * largo que es, no como una copia de la portada.
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

$c = $is_en ? array(
	'eyebrow'   => 'About',
	'h1'        => 'A small firm that works on a calendar.',
	'lede1'     => 'Soluciones del Norte serves small and mid-size businesses in Oregon and Washington with the work almost nobody wants and everybody has to do: pay correctly, record everything, file on time.',
	'lede2'     => 'Most businesses that come to us don’t have an accounting problem — they have a time problem. The owner runs payroll on Sunday night because there’s no other moment. What we offer is that Sunday going away.',
	'photo_alt' => 'The Soluciones del Norte team',

	/* TODO: cifras de referencia (mockup del cliente), no verificadas.
	   Van publicadas por decisión explícita del cliente, a corregir en
	   la próxima reunión — ver el comentario junto a la sección más
	   abajo para el detalle completo. */
	'stats_eyebrow' => 'By the numbers',
	'stats_h2'      => 'What we’ve done so far.',
	'stats'         => array(
		array( '200', '+', 'Businesses served' ),
		array( '3,452', '+', 'Payroll runs processed' ),
		array( '25', '+', 'Years of experience' ),
		array( '43', '+', 'Bilingual team members' ),
	),

	'rail_a'    => 'Language',
	'head_a'    => 'Service in your language',
	'body_a'    => 'The whole team works in Spanish and English. There’s no translator in between — it’s the same person who runs your payroll explaining the letter that arrived.',

	'rail_b'    => 'Coverage',
	'head_b'    => 'Two states, every month',
	'body_b'    => 'Oregon and Washington each have their own rules and calendars. We work with both continuously, not as an exception.',

	'rail_c'    => 'How we work',
	'head_c'    => 'What we tell you before you ask',
	'body_c'    => 'If we find something open from a prior year, you hear it in the first week. If a service isn’t right for you, you hear it on the intake call. It costs less than saying it later.',

	'values_eyebrow' => 'Values',
	'values_h2'      => 'Trust is designed too, with good process.',
	'values_deck'    => 'Every service is built to create certainty, cut friction, and keep the client informed.',
	'values'         => array( 'Continuous improvement', 'Real commitment', 'Guaranteed quality', 'Deep expertise' ),

	/* Preguntas frecuentes — versión general, no atada a un servicio.
	   Misma sección (copy + markup) que se repite tal cual en
	   home-template.php, justo antes del formulario de cierre. Cada
	   archivo es autocontenido, así que el bloque vive completo en
	   los dos en vez de en un partial. */
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

	'facts_l'   => 'At a glance',
	'facts'     => array(
		array( 'Office', 'Hillsboro, OR' ),
		array( 'Coverage', 'Oregon + Washington' ),
		array( 'Languages', 'Spanish / English' ),
		array( 'Hours', 'Mon–Fri 9:00–18:00 · Sat 10:00–14:00' ),
	),

	'cta_h2'    => 'Start with the intake call.',
	'cta_p'     => 'Tell us how many employees you have and which states you operate in. That’s enough for us to tell you what you need.',
	'cta'       => 'Book an intake call',
	'cta_alt'   => 'See the seven services',
) : array(
	'eyebrow'   => 'Nosotros',
	'h1'        => 'Un despacho pequeño que trabaja con calendario.',
	'lede1'     => 'Soluciones del Norte atiende a pequeñas y medianas empresas de Oregon y Washington en lo que casi nadie quiere hacer y todos tienen que hacer: pagar bien, registrar todo y presentar en fecha.',
	'lede2'     => 'La mayoría de los negocios que llegan aquí no tienen un problema de contabilidad: tienen un problema de tiempo. El dueño hace la nómina el domingo por la noche porque no hay otro momento. Lo que ofrecemos es que ese domingo deje de existir.',
	'photo_alt' => 'El equipo de Soluciones del Norte',

	'stats_eyebrow' => 'En números',
	'stats_h2'      => 'Lo que llevamos hecho hasta ahora.',
	'stats'         => array(
		array( '200', '+', 'Empresas atendidas' ),
		array( '3,452', '+', 'Procesos de nómina' ),
		array( '25', '+', 'Años de experiencia' ),
		array( '43', '+', 'Equipo bilingüe' ),
	),

	'rail_a'    => 'Idioma',
	'head_a'    => 'Atención en tu idioma',
	'body_a'    => 'Todo el equipo trabaja en español e inglés. No es un traductor de por medio: es la misma persona que hace tu nómina explicándote qué dice la carta que te llegó.',

	'rail_b'    => 'Cobertura',
	'head_b'    => 'Dos estados, todos los meses',
	'body_b'    => 'Oregon y Washington tienen reglas propias y calendarios propios. Trabajamos con los dos de forma continua, no como excepción.',

	'rail_c'    => 'Cómo trabajamos',
	'head_c'    => 'Lo que decimos antes de que preguntes',
	'body_c'    => 'Si encontramos algo abierto de un año anterior, te lo decimos en la primera semana. Si un servicio no te conviene, te lo decimos en la consulta inicial. Cuesta menos que decirlo después.',

	'values_eyebrow' => 'Valores',
	'values_h2'      => 'La confianza también se diseña con buenos procesos.',
	'values_deck'    => 'Cada servicio está pensado para dar certeza, reducir fricción y mantener al cliente informado.',
	'values'         => array( 'Mejora constante', 'Compromiso real', 'Calidad garantizada', 'Alto nivel de conocimiento' ),

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

	'facts_l'   => 'En corto',
	'facts'     => array(
		array( 'Oficina', 'Hillsboro, OR' ),
		array( 'Cobertura', 'Oregon + Washington' ),
		array( 'Idiomas', 'Español / Inglés' ),
		array( 'Horario', 'Lun a Vie 9:00–18:00 · Sáb 10:00–14:00' ),
	),

	'cta_h2'    => 'Empieza por la consulta inicial.',
	'cta_p'     => 'Dinos cuántos empleados tienes y en qué estados operas. Con eso ya podemos decirte qué necesitas.',
	'cta'       => 'Agendar consulta inicial',
	'cta_alt'   => 'Ver los siete servicios',
);

$sdn_contact  = sdn_route( 'contact' );
$sdn_services = sdn_route( 'services' );

/* ── Los dos videos que quedan en esta página ──────────────────
   El hero dejó de llevar video (ver la sección de abajo: ahora es un
   collage claro, a pedido explícito). "About_Hero_SDN.mp4" —el que
   vivía ahí— se queda exclusivo de la home, que es donde mejor abre
   la marca. Sus dos bandas de video reparten los otros dos archivos,
   ninguno repetido dentro de esta misma página:

     valores → Abstract_blue_dark.mp4          (sin cambios — pedido
               explícito del cliente, ver el comentario junto a esa
               sección más abajo)
     cierre  → abstract_glowing_grid_SDN.mp4   (antes vivía en el hero)

   Mismo mecanismo en los dos: el color de la superficie sigue debajo
   del <video>, así que si no carga el contraste del texto no se
   pierde. */
$sdn_video_values_bg     = content_url( '/uploads/2026/08/Abstract_blue_dark.mp4' );
$sdn_video_values_poster = '';

$sdn_video_bg     = content_url( '/uploads/2026/08/abstract_glowing_grid_SDN.mp4' );
$sdn_video_poster = '';

/* Foto del equipo, junto a la prosa. Horizontal (1024×683): aguanta un
   recorte a sangre completa sin cortar cabezas. */
$sdn_img_team_url = content_url( '/uploads/2026/08/SDN-AboutMejorada.jpg' );
$sdn_img_team     = sdn_attachment_image( $sdn_img_team_url ) ?: array(
	'src'    => $sdn_img_team_url,
	'srcset' => '',
	'sizes'  => '',
	'width'  => 1024,
	'height' => 683,
);

/* Las tres secciones de prosa: etiqueta de raíl, encabezado y cuerpo. */
$sdn_sections = array(
	array( $c['rail_a'], $c['head_a'], $c['body_a'] ),
	array( $c['rail_b'], $c['head_b'], $c['body_b'] ),
	array( $c['rail_c'], $c['head_c'], $c['body_c'] ),
);

/* Tres tonos de marca, en rotación — los mismos que ya usa el FAQ y el
   raíl de prosa, para que ninguna lista de esta página se vea de un
   solo color. */
$sdn_tones = array( 'var(--color-accent)', 'var(--color-deep)', 'var(--color-accent-2)' );
?>

<!-- Barra de avance de lectura — igual que en home, nunca oculta nada. -->
<div id="sdn-progress" aria-hidden="true"></div>

<!-- ══════════════ 01 · ENTRADA — collage claro, sin video ══════════════
     A propósito, un hero muy distinto al de home y al que tenía esta
     página antes: fondo claro con dos manchas de color suaves (nada
     de video), prosa a la izquierda y un collage de tres fichas a la
     derecha — el mismo dato real repartido en tres formatos (una cita
     de Valores, la lista de Cobertura y la frase de Idioma), no datos
     nuevos. Las tres llevan inclinación 3D al pasar el cursor, igual
     que las tarjetas de servicio de home.
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper sdn-edge-accent text-ink border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>
  <div class="sdn-hero-slab" aria-hidden="true"></div>
  <div class="pointer-events-none absolute inset-0" aria-hidden="true" style="background: radial-gradient(circle at 8% 10%, color-mix(in oklab, var(--color-accent) 16%, transparent), transparent 38%);"></div>

  <div class="sdn-layer mx-auto max-w-[1400px] px-3 py-16 lg:px-6 lg:py-24">

    <span class="sdn-ghost-num sdn-ghost-num--tr" aria-hidden="true">01</span>

    <div class="grid gap-12 lg:grid-cols-[1.05fr_0.95fr] lg:items-center">

      <div data-reveal-group>
        <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
          <p data-i18n="about.eyebrow" class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
            <?php echo esc_html( $c['eyebrow'] ); ?>
          </p>
          <span class="sdn-tag" aria-hidden="true">01 / 07</span>
        </div>

        <h1 data-i18n="about.h1" class="sdn-reveal-stagger sdn-measure-sm mt-5 font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-ink sm:text-[2.75rem] lg:text-5xl">
          <?php echo esc_html( $c['h1'] ); ?>
        </h1>

        <div class="sdn-hero-rule sdn-reveal-stagger mt-6 h-1 bg-accent" aria-hidden="true"></div>

        <p data-i18n="about.lede1" class="sdn-reveal-stagger sdn-measure-sm mt-8 text-[1.125rem] leading-[1.65] text-ink">
          <?php echo esc_html( $c['lede1'] ); ?>
        </p>
        <p data-i18n="about.lede2" class="sdn-reveal-stagger sdn-measure-sm mt-5 text-[1.0625rem] leading-[1.65] text-ink-2">
          <?php echo esc_html( $c['lede2'] ); ?>
        </p>

        <div class="sdn-reveal-stagger mt-8 flex flex-wrap items-center gap-3">
          <a href="<?php echo esc_url( $sdn_contact ); ?>"
             data-i18n="about.cta" data-i18n-href="route.contact"
             class="sdn-cta sdn-magnetic">
            <?php echo esc_html( $c['cta'] ); ?>
          </a>
          <a href="<?php echo esc_url( $sdn_services ); ?>"
             data-i18n="about.cta_alt" data-i18n-href="route.services"
             class="sdn-cta sdn-cta--ghost-ink sdn-magnetic">
            <?php echo esc_html( $c['cta_alt'] ); ?>
          </a>
        </div>
      </div>

      <div data-reveal-group class="grid gap-4 sm:grid-cols-2">

        <div class="sdn-tilt sdn-reveal-stagger overflow-hidden rounded-sm bg-deep text-paper shadow-[0_18px_40px_rgba(29,24,22,0.18)]">
          <div class="sdn-card-wipe p-6">
            <p data-i18n="about.values_eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.18em] text-rule">
              <?php echo esc_html( $c['values_eyebrow'] ); ?>
            </p>
            <p data-i18n="about.values_h2" class="mt-4 font-display text-[1.375rem] font-bold leading-tight tracking-[-0.02em]">
              <?php echo esc_html( $c['values_h2'] ); ?>
            </p>
            <p data-i18n="about.values_deck" class="mt-4 text-[0.875rem] leading-relaxed text-rule">
              <?php echo esc_html( $c['values_deck'] ); ?>
            </p>
          </div>
        </div>

        <div class="sdn-tilt sdn-reveal-stagger overflow-hidden rounded-sm border border-rule bg-paper shadow-[0_14px_32px_rgba(29,24,22,0.06)]">
          <div class="sdn-card-wipe p-6">
            <p data-i18n="about.rail_b" class="font-mono text-[0.6875rem] uppercase tracking-[0.18em] text-accent-2">
              <?php echo esc_html( $c['rail_b'] ); ?>
            </p>
            <ul class="mt-4 space-y-2 font-display text-[0.9375rem] font-semibold text-ink">
              <li class="border-t border-rule-2 pt-2">Oregon</li>
              <li class="border-t border-rule-2 pt-2">Washington</li>
            </ul>
          </div>
        </div>

        <div class="sdn-tilt sdn-reveal-stagger overflow-hidden rounded-sm border border-rule bg-paper shadow-[0_14px_32px_rgba(29,24,22,0.06)] sm:col-span-2">
          <div class="sdn-card-wipe p-6">
            <p data-i18n="about.rail_a" class="font-mono text-[0.6875rem] uppercase tracking-[0.18em] text-accent-2">
              <?php echo esc_html( $c['rail_a'] ); ?>
            </p>
            <p data-i18n="about.head_a" class="mt-3 font-display text-[1.125rem] font-bold leading-snug tracking-[-0.02em] text-ink">
              <?php echo esc_html( $c['head_a'] ); ?>
            </p>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Tira en marcha — los mismos cuatro datos de "En corto" (más abajo
     en esta misma página), reutilizando sus claves de traducción:
     nada nuevo que mantener, dos vistas del mismo dato real. -->
<div class="sdn-ticker" aria-hidden="true">
  <div class="sdn-ticker__track">
    <?php for ( $tick_pass = 0; $tick_pass < 2; $tick_pass++ ) : ?>
      <?php foreach ( $c['facts'] as $tick_i => $tick_fact ) : ?>
        <span class="sdn-ticker__item">
          <span data-i18n="about.facts.<?php echo esc_attr( $tick_i ); ?>.dt"><?php echo esc_html( $tick_fact[0] ); ?></span>
          <span>&nbsp;·&nbsp;</span>
          <span data-i18n="about.facts.<?php echo esc_attr( $tick_i ); ?>.dd"><?php echo esc_html( $tick_fact[1] ); ?></span>
        </span>
        <span class="sdn-ticker__dot">&#9670;</span>
      <?php endforeach; ?>
    <?php endfor; ?>
  </div>
</div>

<!-- ══════════════ 02 · En números ══════════════
     TODO: las cuatro cifras vienen de un mockup del cliente, no de un
     dato verificado — ni "200 empresas atendidas" ni "3,452 procesos
     de nómina" ni "43" en equipo bilingüe (que además contradice al
     despacho pequeño que describe el H1 de arriba) están confirmados.
     Se publican así por decisión explícita del cliente, para
     corregir en la próxima reunión — no por descuido. Mismo criterio
     de honestidad de copy que ya reserva la sección de testimonios de
     services-template.php (ver el comentario ahí): la regla no
     prohíbe publicar un placeholder cuando el cliente lo pide con los
     ojos abiertos, prohíbe inventarlo sin que nadie lo sepa. El
     tratamiento visual de los íconos cambió (relleno sólido, a tono
     con el resto del sitio), pero las cifras y la salvedad siguen
     intactas.
     ═══════════════════════════════════════════════════════════════ -->
<section class="relative overflow-hidden border-b border-rule">

  <div class="sdn-layer mx-auto max-w-[1400px] px-3 py-14 lg:px-6 lg:py-16">

    <span class="sdn-ghost-num sdn-ghost-num--tl" aria-hidden="true">02</span>

    <div data-reveal-group class="sdn-measure-sm">
      <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
        <p data-i18n="about.stats_eyebrow" class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
          <?php echo esc_html( $c['stats_eyebrow'] ); ?>
        </p>
        <span class="sdn-tag" aria-hidden="true">02 / 07</span>
      </div>
      <h2 data-i18n="about.stats_h2" class="sdn-reveal-stagger mt-4 font-display text-[1.5rem] font-semibold leading-[1.15] text-ink sm:text-[1.75rem]">
        <?php echo esc_html( $c['stats_h2'] ); ?>
      </h2>
    </div>

    <ul data-reveal-group class="mt-10 grid gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-4">

      <li class="sdn-reveal-stagger">
        <span class="sdn-stat-card__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 21V7a1 1 0 0 1 1-1h5v15" />
            <path d="M14 21V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v17" />
            <path d="M4 21h16" />
          </svg>
        </span>
        <p class="font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][0][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][0][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.0.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][0][2] ); ?>
        </p>
      </li>

      <li class="sdn-reveal-stagger">
        <span class="sdn-stat-card__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <path d="M7 3h7l4 4v14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" />
            <path d="M14 3v4h4" />
            <path d="M9 12h6M9 15.5h6M9 9h3" />
          </svg>
        </span>
        <p class="font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][1][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][1][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.1.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][1][2] ); ?>
        </p>
      </li>

      <li class="sdn-reveal-stagger">
        <span class="sdn-stat-card__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3.5" y="5" width="17" height="16" rx="1.5" />
            <path d="M3.5 9.5h17M8 3v4M16 3v4" />
          </svg>
        </span>
        <p class="font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][2][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][2][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.2.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][2][2] ); ?>
        </p>
      </li>

      <li class="sdn-reveal-stagger">
        <span class="sdn-stat-card__icon" aria-hidden="true">
          <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="9" cy="8" r="3" />
            <path d="M3.5 20c0-3.5 2.5-6 5.5-6s5.5 2.5 5.5 6" />
            <circle cx="17" cy="7" r="2.3" />
            <path d="M14.8 12c2.6.3 4.7 2.5 4.7 5.5" />
          </svg>
        </span>
        <p class="font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][3][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][3][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.3.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][3][2] ); ?>
        </p>
      </li>

    </ul>

  </div>
</section>

<!-- ══════════════ 03 · Prosa con raíl de etiquetas — mitad ventana ══════════════
     Misma mecánica de sangrado a la mitad que "Nómina certificada" e
     "Idioma" en home-template.php: la foto llega al borde real de la
     ventana. Cada artículo suma una barra de acento a la izquierda,
     en rotación de los tres tonos de marca — el mismo criterio que ya
     usa el FAQ de esta página, para que el raíl no se lea como un
     solo bloque gris.
     ═══════════════════════════════════════════════════════════════ -->
<section class="relative border-b border-rule">
  <div class="grid lg:grid-cols-2 lg:items-stretch">

    <div data-reveal-group class="relative px-3 py-16 lg:flex lg:flex-col lg:justify-center lg:px-9 lg:py-16 xl:px-12">
      <span class="sdn-ghost-num sdn-ghost-num--tl" aria-hidden="true">03</span>
      <span class="sdn-tag sdn-reveal-stagger mb-6 self-start" aria-hidden="true">03 / 07</span>

      <?php
      $sdn_section_keys = array( 'a', 'b', 'c' );
      foreach ( $sdn_sections as $i => $s ) :
      	$sk = $sdn_section_keys[ $i ];
      	?>
        <article class="sdn-reveal-stagger border-l-4 pl-6 lg:grid lg:grid-cols-[8rem_minmax(0,1fr)] lg:gap-10 lg:border-l-0 lg:pl-0 <?php echo $i ? 'mt-10' : ''; ?>"
                 style="--rail-tone: <?php echo esc_attr( $sdn_tones[ $i % 3 ] ); ?>; border-left-color: var(--rail-tone);">

          <p data-i18n="about.rail_<?php echo esc_attr( $sk ); ?>" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] lg:border-l-4 lg:pl-4 lg:pt-2" style="color: var(--rail-tone); border-left-color: var(--rail-tone);">
            <?php echo esc_html( $s[0] ); ?>
          </p>

          <div class="mt-3 lg:mt-0">
            <h2 data-i18n="about.head_<?php echo esc_attr( $sk ); ?>" class="sdn-measure-sm font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
              <?php echo esc_html( $s[1] ); ?>
            </h2>
            <p data-i18n="about.body_<?php echo esc_attr( $sk ); ?>" class="sdn-measure-sm mt-4 text-[1.0625rem] leading-[1.65] text-ink-2">
              <?php echo esc_html( $s[2] ); ?>
            </p>
          </div>

        </article>
      <?php endforeach; ?>
    </div>

    <figure class="sdn-wipe sdn-frame overflow-hidden">
      <img src="<?php echo esc_url( $sdn_img_team['src'] ); ?>"
           <?php if ( $sdn_img_team['srcset'] ) : ?>srcset="<?php echo esc_attr( $sdn_img_team['srcset'] ); ?>" sizes="100vw"<?php endif; ?>
           data-i18n-alt="about.photo_alt"
           alt="<?php echo esc_attr( $c['photo_alt'] ); ?>"
           width="<?php echo esc_attr( $sdn_img_team['width'] ); ?>" height="<?php echo esc_attr( $sdn_img_team['height'] ); ?>"
           loading="lazy" decoding="async"
           class="sdn-wipe__img aspect-[4/3] h-full w-full object-cover lg:aspect-auto">
    </figure>

  </div>
</section>

<!-- ══════════════ 04 · Valores — fondo en video ══════════════
     El fondo es el mismo video del hero de home-template.php
     (Abstract_blue_dark.mp4) — pedido explícito, no un archivo nuevo
     con el mismo tratamiento. Las tarjetas quedan opacas (bg-deep-2)
     a propósito: legibles pase lo que pase en el video detrás. Suman
     inclinación 3D al pasar el cursor (mismo mecanismo que las
     tarjetas del carrusel de servicios en home) y un número de orden,
     real: son cuatro valores, no más.
     ═══════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--video text-paper border-b border-paper/15">
  <video
    class="sdn-video"
    data-sdn-video
    data-src="<?php echo esc_url( $sdn_video_values_bg ); ?>"
    <?php if ( $sdn_video_values_poster ) : ?>poster="<?php echo esc_url( $sdn_video_values_poster ); ?>"<?php endif; ?>
    muted loop playsinline preload="none"
    aria-hidden="true" tabindex="-1"></video>
  <div class="sdn-veil" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1400px] px-3 py-16 lg:px-6 lg:py-20">

    <span class="sdn-ghost-num sdn-ghost-num--tr" aria-hidden="true">04</span>

    <div data-reveal-group class="sdn-measure">
      <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
        <p data-i18n="about.values_eyebrow" class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
          <?php echo esc_html( $c['values_eyebrow'] ); ?>
        </p>
        <span class="sdn-tag" aria-hidden="true">04 / 07</span>
      </div>
      <h2 data-i18n="about.values_h2" class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-4xl">
        <?php echo esc_html( $c['values_h2'] ); ?>
      </h2>
      <p data-i18n="about.values_deck" class="sdn-reveal-stagger mt-4 leading-relaxed text-rule">
        <?php echo esc_html( $c['values_deck'] ); ?>
      </p>
    </div>

    <ul data-reveal-group class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-12">
      <?php
      /* Un ícono propio por valor — no el mismo repetido cuatro veces
         disfrazado de check genérico — y un tono de marca alternado
         (acento / acento oscuro) para que la fila no se lea como un
         solo bloque plano. El orden de $c['values'] es el mismo en
         los dos idiomas, así que indexar por posición es seguro.
         El mosaico de anchos (7/5/5/7) y el número gigante detrás del
         texto rompen el patrón "cuatro cajas iguales con ícono y
         numerito" — el motivo por el que se veían genéricas. La
         entrada usa .sdn-card-wipe, la misma cortina de las fichas
         del hero, para que las dos filas de tarjetas de esta página
         se sientan del mismo sistema. */
      $sdn_value_icons = array(
      	'<path d="M4 17l4.5-5 4 3.5L20 6"/><path d="M14.5 6H20v5.5"/>',
      	'<path d="M12 20s-6.8-4.2-9-8.4C1.6 8.6 3 5.3 6 5.3c1.9 0 3.3 1.1 3.8 2.7.5-1.6 1.9-2.7 3.8-2.7 3 0 4.4 3.3 3.2 6.3-2.2 4.2-9 8.4-9 8.4Z"/>',
      	'<path d="M12 3l7 3v6c0 4.5-3 7.5-7 9-4-1.5-7-4.5-7-9V6l7-3Z"/><path d="M9 12l2 2 4-4"/>',
      	'<path d="M4 5.3c2.2-1 5-1 8 .3v13c-3-1.3-5.8-1.3-8-.3V5.3Z"/><path d="M20 5.3c-2.2-1-5-1-8 .3v13c3-1.3 5.8-1.3 8-.3V5.3Z"/>',
      );
      $sdn_value_tones = array( 'var(--color-accent)', 'var(--color-accent-2)' );
      $sdn_value_spans = array( 'lg:col-span-7', 'lg:col-span-5', 'lg:col-span-5', 'lg:col-span-7' );
      foreach ( $c['values'] as $vi => $value ) :
      	$vtone = $sdn_value_tones[ $vi % 2 ];
      	$vspan = $sdn_value_spans[ $vi % 4 ];
      	?>
        <li class="sdn-tilt sdn-value-card sdn-reveal-stagger relative overflow-hidden rounded-sm border p-6 <?php echo esc_attr( $vspan ); ?>"
            style="--tone: <?php echo esc_attr( $vtone ); ?>; border-color: color-mix(in oklab, var(--tone) 30%, var(--color-paper) 15%); background: linear-gradient(160deg, color-mix(in oklab, var(--tone) 16%, var(--color-deep-2)) 0%, var(--color-deep-2) 65%);">
          <span class="sdn-value-glow" aria-hidden="true"></span>
          <span class="sdn-value-num" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $vi + 1 ), 2, '0', STR_PAD_LEFT ) ); ?></span>
          <div class="sdn-card-wipe">
            <span class="sdn-value-icon" aria-hidden="true">
              <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"><?php echo $sdn_value_icons[ $vi ]; ?></svg>
            </span>
            <p data-i18n="about.values.<?php echo esc_attr( $vi ); ?>" class="mt-6 max-w-[24rem] font-display text-[1.0625rem] font-semibold leading-snug">
              <?php echo esc_html( $value ); ?>
            </p>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>

<!-- ══════════════ Preguntas frecuentes ══════════════
     Mismo componente que home-template.php: <details> nativo, número
     y acento de color por pregunta, en rotación de los tres tonos de
     marca. Se abre y cierra sin JavaScript y sigue siendo utilizable
     si el bundle no carga.
     ══════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1400px] px-3 py-16 lg:px-6 lg:py-20">

    <span class="sdn-ghost-num sdn-ghost-num--tr" aria-hidden="true">?</span>

    <div class="lg:grid lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)] lg:gap-16">

      <div data-reveal-group class="lg:pt-1">
        <div class="sdn-reveal-stagger flex flex-wrap items-center justify-between gap-3">
          <p data-i18n="about.faq.l" class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
            <?php echo esc_html( $c['faq_l'] ); ?>
          </p>
          <span class="sdn-tag" aria-hidden="true">05 / 07</span>
        </div>
        <h2 data-i18n="about.faq.h2" class="sdn-reveal-stagger mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-[2.25rem]">
          <?php echo esc_html( $c['faq_h2'] ); ?>
        </h2>
        <p data-i18n="about.faq.note" class="sdn-reveal-stagger sdn-measure-sm mt-5 text-[0.9375rem] leading-relaxed text-muted">
          <?php echo esc_html( $c['faq_note'] ); ?>
        </p>
      </div>

      <div data-reveal-group class="mt-10 space-y-3 lg:mt-0">
        <?php foreach ( $c['faqs'] as $i => $faq ) : ?>
          <details class="sdn-faq2 sdn-reveal-stagger group" style="--faq-tone: <?php echo esc_attr( $sdn_tones[ $i % 3 ] ); ?>;">
            <summary class="flex cursor-pointer items-start gap-4 py-5">
              <span class="sdn-faq2__num mt-0.5 shrink-0" aria-hidden="true"><?php echo esc_html( str_pad( (string) ( $i + 1 ), 2, '0', STR_PAD_LEFT ) . ' / ' . str_pad( (string) count( $c['faqs'] ), 2, '0', STR_PAD_LEFT ) ); ?></span>
              <span data-i18n="about.faq.<?php echo esc_attr( $i ); ?>.q" class="sdn-measure-sm flex-1 font-display text-[1.0625rem] font-semibold leading-snug text-ink transition-colors duration-150 group-hover:text-accent-2">
                <?php echo esc_html( $faq[0] ); ?>
              </span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                   class="mt-1 h-4 w-4 shrink-0 text-muted transition-transform duration-200 group-open:rotate-180" aria-hidden="true">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </summary>
            <p data-i18n="about.faq.<?php echo esc_attr( $i ); ?>.a" class="sdn-measure-sm py-1 pb-6 pl-[2.25rem] text-[1.0625rem] leading-[1.65] text-ink-2">
              <?php echo esc_html( $faq[1] ); ?>
            </p>
          </details>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Datos en corto ══════════════
     Deliberadamente sin la cuadrícula de ícono + etiqueta que ya usan
     las cifras, la banda de operación y las tarjetas de Valores más
     arriba — para no repetir la misma fórmula una cuarta vez, los
     mismos cuatro datos van en una sola ficha "timbrada", inclinada,
     con sello en la esquina y renglones punteados. Mismo dato, otro
     formato. -->
<section class="sdn-surface sdn-surface--paper-2 sdn-edge-accent border-b border-rule">

  <div class="sdn-layer mx-auto max-w-[1400px] px-3 py-16 lg:px-6 lg:py-20">

    <span class="sdn-ghost-num sdn-ghost-num--tl" aria-hidden="true">06</span>

    <div class="grid gap-10 lg:grid-cols-2 lg:items-center">

      <div data-reveal-group>
        <div class="sdn-reveal-stagger flex flex-wrap items-center gap-3">
          <p data-i18n="about.facts_l" class="sdn-eyebrow font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
            <?php echo esc_html( $c['facts_l'] ); ?>
          </p>
          <span class="sdn-tag" aria-hidden="true">06 / 07</span>
        </div>
        <p class="sdn-reveal-stagger sdn-measure mt-4 text-[0.9375rem] leading-relaxed text-ink-2">
          <?php echo esc_html( $sdn['address'] ); ?>
        </p>
      </div>

      <div class="sdn-reveal-scale flex lg:justify-end">
        <dl class="sdn-fact-card w-full max-w-[24rem]">
          <span class="sdn-fact-card__seal" aria-hidden="true">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12.5l4.5 4.5L19 7"/></svg>
          </span>
          <?php foreach ( $c['facts'] as $fi => $fact ) : ?>
            <div class="sdn-fact-row">
              <dt data-i18n="about.facts.<?php echo esc_attr( $fi ); ?>.dt" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
                <?php echo esc_html( $fact[0] ); ?>
              </dt>
              <dd data-i18n="about.facts.<?php echo esc_attr( $fi ); ?>.dd" class="font-mono text-[0.9375rem] tabular-nums text-ink text-right">
                <?php echo esc_html( $fact[1] ); ?>
              </dd>
            </div>
          <?php endforeach; ?>
        </dl>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Cierre — fondo en video ══════════════
     Mismo mecanismo que el cierre de home-template.php: el color de
     la superficie sigue debajo del <video>, así que si no carga la
     banda se ve en Space Indigo plano y el texto no pierde contraste.
     El archivo es "About_Hero_SDN.mp4" — el que soltó el hero de esta
     misma página (ver el bloque de PHP al principio del archivo).
     ═══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--video text-paper">
  <video
    class="sdn-video"
    data-sdn-video
    data-src="<?php echo esc_url( $sdn_video_bg ); ?>"
    <?php if ( $sdn_video_poster ) : ?>poster="<?php echo esc_url( $sdn_video_poster ); ?>"<?php endif; ?>
    muted loop playsinline preload="none"
    aria-hidden="true" tabindex="-1"></video>
  <div class="sdn-veil" aria-hidden="true"></div>
  <div class="sdn-layer mx-auto max-w-[1400px] px-3 py-16 lg:px-6 lg:py-20">

    <span class="sdn-ghost-num sdn-ghost-num--tl" aria-hidden="true">07</span>

    <div data-reveal-group class="lg:grid lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end lg:gap-16">

      <div>
        <span class="sdn-tag sdn-reveal-stagger mb-4 inline-flex" aria-hidden="true">07 / 07</span>
        <h2 data-i18n="about.cta_h2" class="sdn-reveal-stagger sdn-measure-sm font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-[2.25rem]">
          <?php echo esc_html( $c['cta_h2'] ); ?>
        </h2>
        <p data-i18n="about.cta_p" class="sdn-reveal-stagger sdn-measure-sm mt-4 leading-relaxed text-rule">
          <?php echo esc_html( $c['cta_p'] ); ?>
        </p>
      </div>

      <div class="sdn-reveal-stagger mt-8 flex flex-wrap items-center gap-3 lg:mt-0 lg:shrink-0">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           data-i18n="about.cta" data-i18n-href="route.contact"
           class="sdn-cta sdn-magnetic">
          <?php echo esc_html( $c['cta'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           data-i18n="about.cta_alt" data-i18n-href="route.services"
           class="sdn-cta sdn-cta--ghost sdn-magnetic">
          <?php echo esc_html( $c['cta_alt'] ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();
