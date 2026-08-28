<?php
/**
 * Template Name: Servicio — Auditorías de nómina
 *
 * Soluciones del Norte · Auditorías de nómina
 * Macroestructura: Narrative Workflow (14) — cuatro etapas numeradas
 * ancladas a un raíl de 96 px. El orden es el mismo en las siete
 * páginas de servicio a propósito: quien compara dos servicios
 * encuentra la misma información en el mismo lugar. Lo que cambia es
 * el contenido, nunca el orden.
 *
 * La etapa 1 es «Qué necesitamos de ti» y va primero, no al final:
 * es la pregunta que el visitante trae y la que casi ningún sitio de
 * servicios contesta.
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

/* Clave de este servicio: sirve para excluirlo de la fila de cierre. */
$sdn_key = 'payroll-audits';

$c = $is_en ? array(
	'crumb'   => 'Services',
	'name'    => 'Payroll audits',
	'h1'      => 'When something doesn’t add up, you look backwards.',
	'deck'    => 'Review of prior-period records, calculations and filings, with the findings in writing.',
	'cta'     => 'Book an intake call',

	'st1'     => 'What we need from you',
	'st2'     => 'What we do',
	'st3'     => 'What you get',
	'st4'     => 'Who it’s for',

	/* Rail de texto de la sección "Etapas" — sticky en desktop,
	   mismo texto en las siete páginas de servicio porque el orden
	   de las cuatro etapas es a propósito idéntico entre ellas (ver
	   el comentario de cabecera del archivo). */
	'stages_eyebrow' => 'How it works',
	'stages_h2'      => 'Four stages, same order, every time.',
	'stages_note'    => 'The order doesn’t change between services — comparing two of them, the same information sits in the same place.',

	'need'    => 'The reports and stubs for the period under review, and any letter or notice you’ve received from an agency.',
	'do'      => array(
		'Rebuild the calculation period by period',
		'Match what was filed against what was paid',
		'Identify differences and where they came from',
		'Document what to fix and in what order',
	),
	'get'     => 'A report with the differences found, the amounts involved and the correction steps.',
	'who'     => 'Businesses that received an agency notice, changed payroll providers, or suspect an error in earlier periods.',

	'more_l'  => 'The other six services',

	'faq_l'    => 'FAQ',
	'faq_h2'   => 'What people ask about payroll audits.',
	'faq_note' => 'If yours isn’t here, ask it on the intake call.',
	'faq_alt'  => 'Soluciones del Norte team member working on a laptop',
	'faqs'     => array(
		array(
			'What should I bring to the first call?',
			'The reports and stubs for the period under review, and any letter or notice you’ve received from an agency.',
		),
		array(
			'What if I just changed payroll providers?',
			'That’s one of the most common reasons to run an audit — we rebuild the calculation period by period so nothing carries over unverified from the switch.',
		),
		array(
			'What do I get at the end?',
			'A written report with the differences found, the amounts involved and the correction steps — not just a verbal summary.',
		),
		array(
			'Does an audit fix the problem, or just find it?',
			'It finds and documents it. Correcting filings or payments is a separate step we lay out once you decide how to proceed.',
		),
	),

	'end_h2'  => 'Start with the intake call.',
	'end_p'   => 'Tell us how many employees you have and which states you operate in. That’s enough for us to tell you what you need.',
	'end_alt' => 'See all seven services',
) : array(
	'crumb'   => 'Servicios',
	'name'    => 'Auditorías de nómina',
	'h1'      => 'Cuando algo no cuadra, se revisa hacia atrás.',
	'deck'    => 'Revisión de registros, cálculos y presentaciones de periodos anteriores, con el resultado por escrito.',
	'cta'     => 'Agendar consulta inicial',

	'st1'     => 'Qué necesitamos de ti',
	'st2'     => 'Qué hacemos',
	'st3'     => 'Qué recibes',
	'st4'     => 'Para quién es',

	'stages_eyebrow' => 'Cómo trabajamos',
	'stages_h2'      => 'Cuatro etapas, mismo orden, siempre.',
	'stages_note'    => 'El orden no cambia entre servicios — quien compara dos encuentra la misma información en el mismo lugar.',

	'need'    => 'Los reportes y recibos del periodo a revisar, y cualquier carta o aviso que hayas recibido de una agencia.',
	'do'      => array(
		'Reconstruimos el cálculo periodo por periodo',
		'Cotejamos lo presentado contra lo pagado',
		'Identificamos diferencias y su origen',
		'Documentamos qué corregir y en qué orden',
	),
	'get'     => 'Un informe con las diferencias encontradas, el monto involucrado y los pasos de corrección.',
	'who'     => 'Negocios que recibieron un aviso de una agencia, cambiaron de proveedor de nómina o sospechan un error de periodos anteriores.',

	'more_l'  => 'Los otros seis servicios',

	'faq_l'    => 'Preguntas',
	'faq_h2'   => 'Lo que se pregunta sobre auditorías de nómina.',
	'faq_note' => 'Si la tuya no está aquí, hazla en la consulta inicial.',
	'faq_alt'  => 'Miembro del equipo de Soluciones del Norte trabajando en una laptop',
	'faqs'     => array(
		array(
			'¿Qué debo traer a la primera llamada?',
			'Los reportes y recibos del periodo a revisar, y cualquier carta o aviso que hayas recibido de una agencia.',
		),
		array(
			'¿Y si acabo de cambiar de proveedor de nómina?',
			'Es una de las razones más comunes para pedir una auditoría — reconstruimos el cálculo periodo por periodo para que nada pase sin verificar del cambio.',
		),
		array(
			'¿Qué recibo al final?',
			'Un informe por escrito con las diferencias encontradas, el monto involucrado y los pasos para corregirlas — no solo un resumen verbal.',
		),
		array(
			'¿La auditoría corrige el problema o solo lo encuentra?',
			'Lo encuentra y lo documenta. Corregir presentaciones o pagos es un paso aparte que definimos una vez que decides cómo seguir.',
		),
	),

	'end_h2'  => 'Empieza por la consulta inicial.',
	'end_p'   => 'Dinos cuántos empleados tienes y en qué estados operas. Con eso ya podemos decirte qué necesitas.',
	'end_alt' => 'Ver los siete servicios',
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

/* Foto de fondo del hero — la misma que la tarjeta de este servicio
   en el carrusel (mismo archivo, mismo criterio de encargo, ver
   services-template.php). Si el adjunto no se resuelve, $sdn_img_hero
   queda en null y el hero se ve en Space Indigo plano: el color de la
   superficie nunca dependió de la foto. */
$sdn_img_hero = sdn_attachment_image( content_url( '/uploads/2026/08/servicio-auditorias-de-nomina.webp' ), 'large' );

/* Foto de la sección de preguntas frecuentes — la misma en las siete
   páginas de servicio (no una por servicio, a diferencia de la del
   hero): es un retrato del equipo, no una escena de trabajo
   específica de este servicio. */
$sdn_img_faq = sdn_attachment_image( content_url( '/uploads/2026/08/SDN_FAQs.jpg' ), 'large' );

/* Las cuatro etapas. La 2 es la única que va en lista: son acciones
   operativas y se leen mejor una debajo de otra que en prosa. */
$sdn_stages = array(
	array( '1', $c['st1'], $c['need'], null ),
	array( '2', $c['st2'], null, $c['do'] ),
	array( '3', $c['st3'], $c['get'], null ),
	array( '4', $c['st4'], $c['who'], null ),
);
?>

<!-- ══════════════ Hero — foto de fondo ══════════════
     Foto propia del servicio, mismo velo diagonal que el cierre en
     video: el color de la superficie sigue debajo de la imagen, así
     que si no carga el contraste del texto no se pierde. Sin
     .sdn-grid: la retícula encima de una foto sería una textura
     sobre otra y no se leería ninguna de las dos.
     ═══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--video text-paper border-b border-paper/15">
  <?php if ( $sdn_img_hero ) : ?>
    <img src="<?php echo esc_url( $sdn_img_hero['src'] ); ?>"
         <?php if ( $sdn_img_hero['srcset'] ) : ?>srcset="<?php echo esc_attr( $sdn_img_hero['srcset'] ); ?>" sizes="100vw"<?php endif; ?>
         alt="" aria-hidden="true" fetchpriority="high"
         class="absolute inset-0 h-full w-full object-cover">
  <?php endif; ?>
  <div class="sdn-veil" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 pb-16 pt-16 lg:px-12 lg:pb-20 lg:pt-24">
    <div data-reveal>

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           data-i18n="svc.common.crumb" data-i18n-href="route.services"
           class="inline-block whitespace-nowrap transition-colors duration-150 hover:text-accent-2">
          <?php echo esc_html( $c['crumb'] ); ?>
        </a>
        <span aria-hidden="true" class="px-2 text-rule">/</span>
        <span data-i18n="svc.payroll-audits.name" class="text-paper"><?php echo esc_html( $c['name'] ); ?></span>
      </p>

      <h1 data-i18n="svc.payroll-audits.h1" class="sdn-measure-sm mt-5 font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-paper sm:text-[2.75rem] lg:text-5xl">
        <?php echo esc_html( $c['h1'] ); ?>
      </h1>

      <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

      <p data-i18n="svc.payroll-audits.deck" class="sdn-measure mt-8 text-[1.125rem] leading-[1.65] text-rule">
        <?php echo esc_html( $c['deck'] ); ?>
      </p>

      <a href="<?php echo esc_url( $sdn_contact ); ?>"
         data-i18n="svc.common.cta" data-i18n-href="route.contact"
         class="sdn-cta mt-9">
        <?php echo esc_html( $c['cta'] ); ?>
      </a>

    </div>
  </div>
</section>

<!-- ══════════════ Etapas 1 – 4 ══════════════
     Rail de texto fijo (sticky en desktop) a la izquierda, columna de
     etapas a la derecha: mismo mecanismo de scrollytelling que
     ecconstructioninc.com/#how-we-work — el paso que cruza el centro
     de la ventana se resalta y la línea de la izquierda se rellena,
     el contador del rail avanza con él. Lo mueve
     src/scripts/Steps.js vía IntersectionObserver; colores y
     tipografía son los de este sitio, no los de la referencia. Sin
     JS la sección se ve completa e igual de legible, solo sin el
     resaltado que se mueve — el primer paso ya nace con
     data-active="true" desde PHP.

     El número sigue anclado al raíl de 6 rem, como antes: es una
     marca de posición, no un titular. En móvil sube encima del
     título en lugar de desaparecer, y ni la línea ni el rail sticky
     se muestran — no hay dos columnas que sincronizar.

     `overflow: visible` en línea: `.sdn-surface` trae `overflow:
     hidden` por defecto (recorta el sangrado de `.sdn-grid`), pero un
     ancestro con overflow distinto de `visible` se vuelve el
     contenedor de referencia de cualquier `sticky` descendiente — y
     como esta sección no se desplaza por su cuenta (es la página la
     que hace scroll, no ella), el rail dejaba de pegarse y solo
     avanzaba con el resto del contenido. Se anula aquí mismo, sin
     tocar `.sdn-surface` para las demás secciones del sitio que sí
     dependen de ese recorte, y el recorte de `.sdn-grid` se mueve a
     un envoltorio propio que hace exactamente lo mismo. -->
<section class="sdn-surface sdn-surface--paper border-b border-rule" style="overflow: visible;">
  <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
    <div class="sdn-grid"></div>
  </div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-24">
    <div class="lg:grid lg:grid-cols-[minmax(0,18rem)_minmax(0,1fr)] lg:gap-16">

      <div data-reveal class="lg:sticky lg:top-[calc(var(--sdn-bar-h)+1rem)] lg:self-start">
        <p data-i18n="svc.common.stages_eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
          <?php echo esc_html( $c['stages_eyebrow'] ); ?>
        </p>
        <h2 data-i18n="svc.common.stages_h2" class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-[2.25rem]">
          <?php echo esc_html( $c['stages_h2'] ); ?>
        </h2>
        <p data-i18n="svc.common.stages_note" class="sdn-measure-sm mt-5 text-[0.9375rem] leading-relaxed text-muted">
          <?php echo esc_html( $c['stages_note'] ); ?>
        </p>

        <div class="mt-10 hidden lg:block">
          <div class="h-px w-full bg-rule-2">
            <div data-sdn-steps-bar
                 class="h-px bg-accent-2 transition-[width] duration-300 ease-out"
                 style="width: <?php echo esc_attr( round( 100 / count( $sdn_stages ), 4 ) ); ?>%"></div>
          </div>
          <p class="mt-3 font-mono text-[0.75rem] tabular-nums text-muted">
            <span data-sdn-steps-current class="text-accent-2">01</span> / <?php echo esc_html( sprintf( '%02d', count( $sdn_stages ) ) ); ?>
          </p>
        </div>
      </div>

      <div data-sdn-steps class="mt-12 lg:mt-0">
        <?php
        // Mismo orden que $sdn_stages: 1→need, 2→do[], 3→get, 4→who.
        $sdn_stage_body_keys = array( 'need', null, 'get', 'who' );
        foreach ( $sdn_stages as $i => $stage ) :
        	?>
          <article data-reveal="<?php echo esc_attr( $i * 60 ); ?>" data-sdn-step
                   class="relative lg:grid lg:grid-cols-[6rem_minmax(0,1fr)] lg:gap-8 <?php echo $i ? 'mt-12 border-t border-rule-2 pt-12 lg:mt-16 lg:border-t-0 lg:pt-0' : ''; ?>">

            <?php if ( $i ) : ?>
              <span aria-hidden="true" data-sdn-step-line data-active="false"
                    class="absolute left-0 -top-16 hidden h-16 w-px bg-rule-2 transition-colors duration-300 data-[active=true]:bg-accent-2 lg:block"></span>
            <?php endif; ?>

            <p aria-hidden="true" data-sdn-step-num data-active="<?php echo 0 === $i ? 'true' : 'false'; ?>"
               class="origin-left font-mono text-[3rem] font-medium leading-none tabular-nums text-rule transition-[color,transform] duration-300 ease-out data-[active=true]:scale-110 data-[active=true]:text-accent-2 lg:text-[4.5rem] lg:leading-[0.85]">
              <?php echo esc_html( $stage[0] ); ?>
            </p>

            <div class="mt-4 min-w-0 lg:mt-0">
              <h3 data-i18n="svc.payroll-audits.st<?php echo esc_attr( $i + 1 ); ?>" class="font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
                <?php echo esc_html( $stage[1] ); ?>
              </h3>

              <?php if ( $stage[2] ) : ?>
                <p data-i18n="svc.payroll-audits.<?php echo esc_attr( $sdn_stage_body_keys[ $i ] ); ?>" class="sdn-measure-sm mt-4 text-[1.0625rem] leading-[1.65] text-ink-2">
                  <?php echo esc_html( $stage[2] ); ?>
                </p>
              <?php endif; ?>

              <?php if ( $stage[3] ) : ?>
                <ul class="mt-5 space-y-3">
                  <?php foreach ( $stage[3] as $li => $line ) : ?>
                    <li class="sdn-measure-sm flex gap-4 text-[1.0625rem] leading-[1.65] text-ink-2">
                      <span aria-hidden="true" class="mt-[0.8em] h-px w-4 shrink-0 bg-accent"></span>
                      <span data-i18n="svc.payroll-audits.do.<?php echo esc_attr( $li ); ?>" class="min-w-0"><?php echo esc_html( $line ); ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              <?php endif; ?>
            </div>

          </article>
        <?php endforeach; ?>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Los otros seis servicios ══════════════
     Fila horizontal de texto, no seis tarjetas: es navegación
     lateral, no un segundo menú. El servicio actual se excluye.
     ═════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper-2 border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-12 lg:px-12 lg:py-14">
    <div data-reveal class="lg:grid lg:grid-cols-[6rem_minmax(0,1fr)] lg:gap-8">

      <p data-i18n="svc.common.more_l" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-1">
        <?php echo esc_html( $c['more_l'] ); ?>
      </p>

      <ul class="mt-4 flex flex-wrap gap-x-6 gap-y-3 lg:mt-0">
        <?php foreach ( sdn_services() as $key => $svc ) : ?>
          <?php if ( $key === $sdn_key ) { continue; } ?>
          <li>
            <a href="<?php echo esc_url( home_url( $svc['path'] ) ); ?>"
               data-i18n="svc.<?php echo esc_attr( $key ); ?>.name" data-i18n-href="svc.<?php echo esc_attr( $key ); ?>.href"
               class="whitespace-nowrap text-[0.9375rem] text-ink-2 underline decoration-rule underline-offset-4 transition-colors duration-150 hover:text-accent-2 hover:decoration-accent">
              <?php echo esc_html( $svc['name'] ); ?>
            </a>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
  </div>
</section>

<!-- ══════════════ Preguntas frecuentes — sobre este servicio ══════════════
     Mismo componente <details> que home-template.php y about-template.php,
     pero con preguntas propias de este servicio en vez de las generales
     del sitio. Va justo antes del cierre: es donde alguien que ya leyó
     las cuatro etapas trae la duda puntual antes de escribir.

     Foto a mitad de ventana, misma mecánica de sangrado que "Nómina
     certificada"/"Idioma" en home-template.php y la Prosa de
     about-template.php: el `max-w`/`mx-auto`/`px-*` que en el resto
     del sistema vive en el contenedor de la sección se movió adentro,
     a la columna de texto solamente — la de la foto no lleva ninguno,
     así que llega al borde real de la ventana. A diferencia de esas
     referencias, aquí la foto va primero (izquierda) y el texto
     después (derecha).
     ═══════════════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer grid lg:grid-cols-2 lg:items-stretch">

    <figure data-reveal>
      <?php if ( $sdn_img_faq ) : ?>
        <img src="<?php echo esc_url( $sdn_img_faq['src'] ); ?>"
             <?php if ( $sdn_img_faq['srcset'] ) : ?>srcset="<?php echo esc_attr( $sdn_img_faq['srcset'] ); ?>" sizes="100vw"<?php endif; ?>
             data-i18n-alt="svc.common.faq_alt"
             alt="<?php echo esc_attr( $c['faq_alt'] ); ?>"
             width="<?php echo esc_attr( $sdn_img_faq['width'] ); ?>" height="<?php echo esc_attr( $sdn_img_faq['height'] ); ?>"
             loading="lazy" decoding="async"
             class="aspect-[4/3] h-full w-full object-cover lg:aspect-auto">
      <?php endif; ?>
    </figure>

    <div class="px-6 py-16 lg:flex lg:flex-col lg:justify-center lg:px-16 lg:py-16 xl:px-20">
      <div data-reveal>
        <p data-i18n="svc.common.faq_l" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
          <?php echo esc_html( $c['faq_l'] ); ?>
        </p>
        <h2 data-i18n="svc.payroll-audits.faq_h2" class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-[2.25rem]">
          <?php echo esc_html( $c['faq_h2'] ); ?>
        </h2>
        <p data-i18n="svc.payroll-audits.faq_note" class="sdn-measure-sm mt-5 text-[0.9375rem] leading-relaxed text-muted">
          <?php echo esc_html( $c['faq_note'] ); ?>
        </p>
      </div>

      <div data-reveal="80" class="mt-10">
        <?php foreach ( $c['faqs'] as $i => $faq ) : ?>
          <details class="sdn-faq group border-b border-rule <?php echo 0 === $i ? 'border-t' : ''; ?>">
            <summary class="flex cursor-pointer items-start justify-between gap-6 py-5">
              <span data-i18n="svc.payroll-audits.faq.<?php echo esc_attr( $i ); ?>.q" class="sdn-measure-sm font-display text-[1.0625rem] font-semibold leading-snug text-ink transition-colors duration-150 group-hover:text-accent-2">
                <?php echo esc_html( $faq[0] ); ?>
              </span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round"
                   class="mt-1 h-4 w-4 shrink-0 text-muted transition-transform duration-200 group-open:rotate-180" aria-hidden="true">
                <path d="m6 9 6 6 6-6"/>
              </svg>
            </summary>
            <p data-i18n="svc.payroll-audits.faq.<?php echo esc_attr( $i ); ?>.a" class="sdn-measure-sm pb-6 text-[1.0625rem] leading-[1.65] text-ink-2">
              <?php echo esc_html( $faq[1] ); ?>
            </p>
          </details>
        <?php endforeach; ?>
      </div>
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
        <h2 data-i18n="svc.payroll-audits.end_h2" class="sdn-measure-sm font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-[2.25rem]">
          <?php echo esc_html( $c['end_h2'] ); ?>
        </h2>
        <p data-i18n="svc.common.end_p" class="sdn-measure-sm mt-4 leading-relaxed text-rule">
          <?php echo esc_html( $c['end_p'] ); ?>
        </p>
      </div>

      <div class="mt-8 flex flex-wrap items-center gap-3 lg:mt-0 lg:shrink-0">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           data-i18n="svc.common.cta" data-i18n-href="route.contact"
           class="sdn-cta">
          <?php echo esc_html( $c['cta'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           data-i18n="svc.common.end_alt" data-i18n-href="route.services"
           class="sdn-cta sdn-cta--ghost">
          <?php echo esc_html( $c['end_alt'] ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();