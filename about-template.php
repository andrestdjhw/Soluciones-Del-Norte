<?php
/**
 * Template Name: Nosotros
 *
 * Soluciones del Norte · Nosotros
 * Macroestructura: Long Document (02) — prosa continua con encabezados
 * en línea y raíl de etiquetas a la izquierda. Medida de 62 caracteres.
 * Sin tarjetas: es la única página donde la voz se permite ser larga,
 * porque quien llega aquí ya está evaluando si confía.
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
		array( 'Hours', 'Mon to Fri, 10:00–14:00' ),
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
		array( 'Horario', 'Lun a Vie, 10:00–14:00' ),
	),

	'cta_h2'    => 'Empieza por la consulta inicial.',
	'cta_p'     => 'Dinos cuántos empleados tienes y en qué estados operas. Con eso ya podemos decirte qué necesitas.',
	'cta'       => 'Agendar consulta inicial',
	'cta_alt'   => 'Ver los siete servicios',
);

$sdn_contact  = sdn_route( 'contact' );
$sdn_services = sdn_route( 'services' );

/* Video de fondo del cierre — mismo archivo en las ocho páginas que
   llevan esta banda (nosotros + los siete servicios de a uno). El
   razonamiento completo (por qué el `src` no va en el HTML, el
   umbral de mayúsculas del nombre) está en home-template.php, no se
   repite aquí. */
$sdn_video_bg     = content_url( '/uploads/2026/08/abstract_glowing_grid_SDN.mp4' );
$sdn_video_poster = '';

/* Video de fondo de la entrada — archivo propio de esta página, no el
   de las bandas de cierre. Mismo mecanismo (ver el comentario junto a
   la sección más abajo): el color de la superficie sigue debajo,
   así que si no carga el contraste del texto no se pierde. */
$sdn_video_hero_bg     = content_url( '/uploads/2026/08/About_Hero_SDN.mp4' );
$sdn_video_hero_poster = '';

/* Video de fondo de Valores — el mismo archivo que el hero de
   home-template.php (Abstract_blue_dark.mp4), no uno propio de esta
   sección. Es la única banda del sitio que reutiliza el video de
   otra página a propósito: pidieron ese fondo específico, no uno
   nuevo con el mismo tratamiento. */
$sdn_video_values_bg     = content_url( '/uploads/2026/08/Abstract_blue_dark.mp4' );
$sdn_video_values_poster = '';

/* Foto del equipo, junto a la prosa. Es horizontal (1024×683) — a
   diferencia de la vertical que llevaba antes, esta sí sirve de
   fondo a sangre de media ventana, como las fotos de servicio. */
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
?>

<!-- ══════════════ Entrada — foto de fondo en video ══════════════
     Mismo mecanismo que el hero de las páginas de servicio: el color
     de la superficie sigue debajo del <video>, así que si no carga el
     contraste del texto no se pierde. Sin .sdn-grid: la retícula
     encima del video sería una textura sobre otra.

     La foto del equipo ya no va aquí — se movió a la sección de
     prosa de abajo (ver el comentario ahí). Por eso el texto vuelve
     a ser una sola columna, igual que en los heroes de servicio, sin
     el grid de dos columnas que le hacía sitio a la figura.
     ═══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--video text-paper border-b border-paper/15">
  <?php if ( $sdn_video_hero_bg ) : ?>
    <video
      class="sdn-video"
      data-sdn-video
      data-src="<?php echo esc_url( $sdn_video_hero_bg ); ?>"
      <?php if ( $sdn_video_hero_poster ) : ?>poster="<?php echo esc_url( $sdn_video_hero_poster ); ?>"<?php endif; ?>
      muted loop playsinline preload="none"
      aria-hidden="true" tabindex="-1"></video>
  <?php endif; ?>
  <div class="sdn-veil" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 pb-16 pt-16 lg:px-12 lg:pb-20 lg:pt-24">
    <div data-reveal>
      <p data-i18n="about.eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
        <?php echo esc_html( $c['eyebrow'] ); ?>
      </p>

      <h1 data-i18n="about.h1" class="sdn-measure-sm mt-5 font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-paper sm:text-[2.75rem] lg:text-5xl">
        <?php echo esc_html( $c['h1'] ); ?>
      </h1>

      <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

      <p data-i18n="about.lede1" class="sdn-measure-sm mt-8 text-[1.125rem] leading-[1.65] text-paper">
        <?php echo esc_html( $c['lede1'] ); ?>
      </p>
      <p data-i18n="about.lede2" class="sdn-measure-sm mt-5 text-[1.0625rem] leading-[1.65] text-rule">
        <?php echo esc_html( $c['lede2'] ); ?>
      </p>
    </div>
  </div>
</section>

<!-- ══════════════ En números ══════════════
     TODO: las cuatro cifras vienen de un mockup del cliente, no de un
     dato verificado — ni "200 empresas atendidas" ni "3,452 procesos
     de nómina" ni "43" en equipo bilingüe (que además contradice al
     despacho pequeño que describe el H1 de arriba) están confirmados.
     Se publican así por decisión explícita del cliente, para
     corregir en la próxima reunión — no por descuido. Mismo criterio
     de honestidad de copy que ya reserva la sección de testimonios de
     services-template.php (ver el comentario ahí): la regla no
     prohíbe publicar un placeholder cuando el cliente lo pide con los
     ojos abiertos, prohíbe inventarlo sin que nadie lo sepa.

     Iconos en línea, mismo criterio que el resto del sitio: formas
     simples (círculos, rectángulos, líneas rectas) en vez de un path
     complejo copiado de otro lado — más fácil de verificar que
     renderiza bien.
     ═══════════════════════════════════════════════════════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-6 py-14 lg:px-12 lg:py-16">

    <div data-reveal class="sdn-measure-sm">
      <p data-i18n="about.stats_eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['stats_eyebrow'] ); ?>
      </p>
      <h2 data-i18n="about.stats_h2" class="mt-4 font-display text-[1.5rem] font-semibold leading-[1.15] text-ink sm:text-[1.75rem]">
        <?php echo esc_html( $c['stats_h2'] ); ?>
      </h2>
    </div>

    <ul data-reveal="80" class="mt-10 grid gap-x-8 gap-y-10 sm:grid-cols-2 lg:grid-cols-4">

      <li>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 text-accent-2" aria-hidden="true">
          <path d="M4 21V7a1 1 0 0 1 1-1h5v15" />
          <path d="M14 21V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v17" />
          <path d="M4 21h16" />
          <path d="M7.5 9.5h.01M7.5 13h.01M7.5 16.5h.01M17.5 6.5h.01M17.5 10h.01M17.5 13.5h.01M17.5 17h.01" />
        </svg>
        <p class="mt-4 font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][0][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][0][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.0.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][0][2] ); ?>
        </p>
      </li>

      <li>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 text-accent-2" aria-hidden="true">
          <path d="M7 3h7l4 4v14a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Z" />
          <path d="M14 3v4h4" />
          <path d="M9 12h6M9 15.5h6M9 9h3" />
        </svg>
        <p class="mt-4 font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][1][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][1][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.1.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][1][2] ); ?>
        </p>
      </li>

      <li>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 text-accent-2" aria-hidden="true">
          <rect x="3.5" y="5" width="17" height="16" rx="1.5" />
          <path d="M3.5 9.5h17M8 3v4M16 3v4" />
          <path d="M7.5 13h.01M12 13h.01M16.5 13h.01M7.5 17h.01M12 17h.01" />
        </svg>
        <p class="mt-4 font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][2][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][2][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.2.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][2][2] ); ?>
        </p>
      </li>

      <li>
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-9 w-9 text-accent-2" aria-hidden="true">
          <circle cx="9" cy="8" r="3" />
          <path d="M3.5 20c0-3.5 2.5-6 5.5-6s5.5 2.5 5.5 6" />
          <circle cx="17" cy="7" r="2.3" />
          <path d="M14.8 12c2.6.3 4.7 2.5 4.7 5.5" />
        </svg>
        <p class="mt-4 font-display text-[2.25rem] font-bold leading-none tracking-[-0.02em] text-ink">
          <?php echo esc_html( $c['stats'][3][0] ); ?><span class="text-accent-2"><?php echo esc_html( $c['stats'][3][1] ); ?></span>
        </p>
        <p data-i18n="about.stats.3.label" class="mt-2 text-[0.9375rem] text-ink-2">
          <?php echo esc_html( $c['stats'][3][2] ); ?>
        </p>
      </li>

    </ul>

  </div>
</section>

<!-- ══════════════ Prosa con raíl de etiquetas — mitad ventana ══════════════
     Misma mecánica de sangrado a la mitad que "Nómina certificada" e
     "Idioma" en home-template.php: la foto llega al borde real de la
     ventana, no al borde de los 1200px del resto del sistema. Por eso
     el `max-w`/`mx-auto`/`px-*` que en el resto de esta página vive en
     el contenedor de la sección se movió adentro, a la columna de
     texto solamente — la de la imagen no lleva ninguno.

     La foto es horizontal (1024×683) — a diferencia de la vertical
     que llevaba antes, esta sí aguanta un recorte a sangre completa
     sin cortar cabezas.
     ═══════════════════════════════════════════════════════════════ -->
<section class="border-b border-rule">
  <div class="grid lg:grid-cols-2 lg:items-stretch">

    <div class="px-6 py-16 lg:flex lg:flex-col lg:justify-center lg:px-16 lg:py-16 xl:px-20">
      <?php
      $sdn_section_keys = array( 'a', 'b', 'c' );
      foreach ( $sdn_sections as $i => $s ) :
      	$sk = $sdn_section_keys[ $i ];
      	?>
        <article data-reveal="<?php echo esc_attr( $i * 60 ); ?>"
                 class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12 <?php echo $i ? 'mt-14 border-t border-rule-2 pt-14' : ''; ?>">

          <p data-i18n="about.rail_<?php echo esc_attr( $sk ); ?>" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-2">
            <?php echo esc_html( $s[0] ); ?>
          </p>

          <div class="mt-4 lg:mt-0">
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

    <figure data-reveal="80" class="mt-14 lg:mt-0">
      <img src="<?php echo esc_url( $sdn_img_team['src'] ); ?>"
           <?php if ( $sdn_img_team['srcset'] ) : ?>srcset="<?php echo esc_attr( $sdn_img_team['srcset'] ); ?>" sizes="100vw"<?php endif; ?>
           data-i18n-alt="about.photo_alt"
           alt="<?php echo esc_attr( $c['photo_alt'] ); ?>"
           width="<?php echo esc_attr( $sdn_img_team['width'] ); ?>" height="<?php echo esc_attr( $sdn_img_team['height'] ); ?>"
           loading="lazy" decoding="async"
           class="aspect-[4/3] h-full w-full object-cover lg:aspect-auto">
    </figure>

  </div>
</section>

<!-- ══════════════ Valores — fondo en video ══════════════
     Cambió de lugar con "Datos en corto" (antes iba después, ahora
     va antes) — a diferencia de home-template.php, aquí no hay un
     ritmo paper/paper-2 que preservar entre estas dos secciones, así
     que el bloque completo se movió tal cual, sin ajustes.

     Antes iba como una fila de texto a propósito (Pendiente 07: los
     cuatro valores son enunciados genéricos, intercambiables con los
     de cualquier despacho — cuatro tarjetas con icono les daban un
     peso visual que el contenido todavía no sostenía). Pasa a
     tarjetas ahora por pedido directo del cliente, con este mockup
     de referencia. La nota sigue siendo válida en teoría —si algún
     día entran los cuatro compromisos verificables que proponía—,
     pero la decisión de cuándo mostrar más peso visual es del
     cliente, no nuestra.

     El fondo es el mismo video del hero de home-template.php
     (Abstract_blue_dark.mp4) — pedido explícito, no un archivo nuevo
     con el mismo tratamiento. Las tarjetas quedan opacas (bg-deep-2)
     a propósito: legibles pase lo que pase en el video detrás.
     ═══════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--video text-paper border-b border-paper/15">
  <?php if ( $sdn_video_values_bg ) : ?>
    <video
      class="sdn-video"
      data-sdn-video
      data-src="<?php echo esc_url( $sdn_video_values_bg ); ?>"
      <?php if ( $sdn_video_values_poster ) : ?>poster="<?php echo esc_url( $sdn_video_values_poster ); ?>"<?php endif; ?>
      muted loop playsinline preload="none"
      aria-hidden="true" tabindex="-1"></video>
  <?php endif; ?>
  <div class="sdn-veil" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">

    <div data-reveal class="sdn-measure">
      <p data-i18n="about.values_eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
        <?php echo esc_html( $c['values_eyebrow'] ); ?>
      </p>
      <h2 data-i18n="about.values_h2" class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-4xl">
        <?php echo esc_html( $c['values_h2'] ); ?>
      </h2>
      <p data-i18n="about.values_deck" class="mt-4 leading-relaxed text-rule">
        <?php echo esc_html( $c['values_deck'] ); ?>
      </p>
    </div>

    <ul data-reveal="80" class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
      <?php foreach ( $c['values'] as $vi => $value ) : ?>
        <li class="sdn-value-card rounded-sm border border-paper/15 bg-deep-2 p-6">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="h-7 w-7 text-accent-2" aria-hidden="true">
            <path d="M9 12.75l2.25 2.25L15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 0 1-1.043 3.296 3.745 3.745 0 0 1-3.296 1.043A3.745 3.745 0 0 1 12 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 0 1-3.296-1.043 3.745 3.745 0 0 1-1.043-3.296A3.745 3.745 0 0 1 3 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 0 1 1.043-3.296 3.746 3.746 0 0 1 3.296-1.043A3.746 3.746 0 0 1 12 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 0 1 3.296 1.043 3.746 3.746 0 0 1 1.043 3.296A3.745 3.745 0 0 1 21 12Z" />
          </svg>
          <p data-i18n="about.values.<?php echo esc_attr( $vi ); ?>" class="mt-4 font-display text-[0.9375rem] font-semibold leading-snug">
            <?php echo esc_html( $value ); ?>
          </p>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>

<!-- ══════════════ Preguntas frecuentes ══════════════
     Mismo componente que services-template.php: <details> nativo, se
     abre y cierra sin JavaScript y sigue siendo utilizable si el
     bundle no carga. Versión general, no atada a un servicio — la
     misma sección (copy y markup) se repite en home-template.php,
     justo antes del formulario de cierre.
     ══════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">
    <div class="lg:grid lg:grid-cols-[minmax(0,20rem)_minmax(0,1fr)] lg:gap-16">

      <div data-reveal class="lg:pt-1">
        <p data-i18n="about.faq.l" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
          <?php echo esc_html( $c['faq_l'] ); ?>
        </p>
        <h2 data-i18n="about.faq.h2" class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-[2.25rem]">
          <?php echo esc_html( $c['faq_h2'] ); ?>
        </h2>
        <p data-i18n="about.faq.note" class="sdn-measure-sm mt-5 text-[0.9375rem] leading-relaxed text-muted">
          <?php echo esc_html( $c['faq_note'] ); ?>
        </p>
      </div>

      <div data-reveal="80" class="mt-10 lg:mt-0">
        <?php foreach ( $c['faqs'] as $i => $faq ) : ?>
          <details class="sdn-faq group border-b border-rule <?php echo 0 === $i ? 'border-t' : ''; ?>">
            <summary class="flex cursor-pointer items-start justify-between gap-6 py-5">
              <span data-i18n="about.faq.<?php echo esc_attr( $i ); ?>.q" class="sdn-measure-sm font-display text-[1.0625rem] font-semibold leading-snug text-ink transition-colors duration-150 group-hover:text-accent-2">
                <?php echo esc_html( $faq[0] ); ?>
              </span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                   class="mt-1 h-4 w-4 shrink-0 text-muted transition-transform duration-200 group-open:rotate-180" aria-hidden="true">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </summary>
            <p data-i18n="about.faq.<?php echo esc_attr( $i ); ?>.a" class="sdn-measure-sm pb-6 text-[1.0625rem] leading-[1.65] text-ink-2">
              <?php echo esc_html( $faq[1] ); ?>
            </p>
          </details>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Datos en corto ══════════════ -->
<section class="border-b border-rule bg-paper-2">
  <div class="mx-auto max-w-[1200px] px-6 py-14 lg:px-12 lg:py-16">
    <div data-reveal class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12">

      <p data-i18n="about.facts_l" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-1">
        <?php echo esc_html( $c['facts_l'] ); ?>
      </p>

      <dl class="mt-5 grid gap-x-10 gap-y-5 sm:grid-cols-2 lg:mt-0 lg:grid-cols-4">
        <?php foreach ( $c['facts'] as $fi => $fact ) : ?>
          <div class="min-w-0 border-t border-rule pt-4">
            <dt data-i18n="about.facts.<?php echo esc_attr( $fi ); ?>.dt" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
              <?php echo esc_html( $fact[0] ); ?>
            </dt>
            <dd data-i18n="about.facts.<?php echo esc_attr( $fi ); ?>.dd" class="mt-1.5 font-mono text-[0.9375rem] tabular-nums text-ink">
              <?php echo esc_html( $fact[1] ); ?>
            </dd>
          </div>
        <?php endforeach; ?>
      </dl>

    </div>
  </div>
</section>

<!-- ══════════════ Cierre — fondo en video ══════════════
     Mismo mecanismo que el cierre de home-template.php: el color de
     la superficie sigue debajo del <video>, así que si no carga la
     banda se ve en Space Indigo plano y el texto no pierde contraste.
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
  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">
    <div data-reveal class="lg:grid lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end lg:gap-16">

      <div>
        <h2 data-i18n="about.cta_h2" class="sdn-measure-sm font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-[2.25rem]">
          <?php echo esc_html( $c['cta_h2'] ); ?>
        </h2>
        <p data-i18n="about.cta_p" class="sdn-measure-sm mt-4 leading-relaxed text-rule">
          <?php echo esc_html( $c['cta_p'] ); ?>
        </p>
      </div>

      <div class="mt-8 flex flex-wrap items-center gap-3 lg:mt-0 lg:shrink-0">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           data-i18n="about.cta" data-i18n-href="route.contact"
           class="sdn-cta">
          <?php echo esc_html( $c['cta'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           data-i18n="about.cta_alt" data-i18n-href="route.services"
           class="sdn-cta sdn-cta--ghost">
          <?php echo esc_html( $c['cta_alt'] ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();