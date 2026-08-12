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

	'rail_a'    => 'Language',
	'head_a'    => 'Service in your language',
	'body_a'    => 'The whole team works in Spanish and English. There’s no translator in between — it’s the same person who runs your payroll explaining the letter that arrived.',

	'rail_b'    => 'Coverage',
	'head_b'    => 'Two states, every month',
	'body_b'    => 'Oregon and Washington each have their own rules and calendars. We work with both continuously, not as an exception.',

	'rail_c'    => 'How we work',
	'head_c'    => 'What we tell you before you ask',
	'body_c'    => 'If we find something open from a prior year, you hear it in the first week. If a service isn’t right for you, you hear it on the intake call. It costs less than saying it later.',

	'values_l'  => 'What guides the work',
	'values'    => array( 'Continuous improvement', 'Real commitment', 'Guaranteed quality', 'Deep expertise' ),

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

	'rail_a'    => 'Idioma',
	'head_a'    => 'Atención en tu idioma',
	'body_a'    => 'Todo el equipo trabaja en español e inglés. No es un traductor de por medio: es la misma persona que hace tu nómina explicándote qué dice la carta que te llegó.',

	'rail_b'    => 'Cobertura',
	'head_b'    => 'Dos estados, todos los meses',
	'body_b'    => 'Oregon y Washington tienen reglas propias y calendarios propios. Trabajamos con los dos de forma continua, no como excepción.',

	'rail_c'    => 'Cómo trabajamos',
	'head_c'    => 'Lo que decimos antes de que preguntes',
	'body_c'    => 'Si encontramos algo abierto de un año anterior, te lo decimos en la primera semana. Si un servicio no te conviene, te lo decimos en la consulta inicial. Cuesta menos que decirlo después.',

	'values_l'  => 'Lo que guía el trabajo',
	'values'    => array( 'Mejora constante', 'Compromiso real', 'Calidad garantizada', 'Alto nivel de conocimiento' ),

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

/* Las tres secciones de prosa: etiqueta de raíl, encabezado y cuerpo. */
$sdn_sections = array(
	array( $c['rail_a'], $c['head_a'], $c['body_a'] ),
	array( $c['rail_b'], $c['head_b'], $c['body_b'] ),
	array( $c['rail_c'], $c['head_c'], $c['body_c'] ),
);
?>

<!-- ══════════════ Entrada ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-6 pb-16 pt-16 lg:px-12 lg:pb-20 lg:pt-24">
    <div data-reveal class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12">

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-3">
        <?php echo esc_html( $c['eyebrow'] ); ?>
      </p>

      <div class="mt-5 lg:mt-0">
        <h1 class="sdn-measure-sm font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-ink sm:text-[2.75rem] lg:text-5xl">
          <?php echo esc_html( $c['h1'] ); ?>
        </h1>

        <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

        <p class="sdn-measure-sm mt-8 text-[1.125rem] leading-[1.65] text-ink">
          <?php echo esc_html( $c['lede1'] ); ?>
        </p>
        <p class="sdn-measure-sm mt-5 text-[1.0625rem] leading-[1.65] text-ink-2">
          <?php echo esc_html( $c['lede2'] ); ?>
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Prosa con raíl de etiquetas ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">

    <?php foreach ( $sdn_sections as $i => $s ) : ?>
      <article data-reveal="<?php echo esc_attr( $i * 60 ); ?>"
               class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12 <?php echo $i ? 'mt-14 border-t border-rule-2 pt-14' : ''; ?>">

        <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-2">
          <?php echo esc_html( $s[0] ); ?>
        </p>

        <div class="mt-4 lg:mt-0">
          <h2 class="sdn-measure-sm font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
            <?php echo esc_html( $s[1] ); ?>
          </h2>
          <p class="sdn-measure-sm mt-4 text-[1.0625rem] leading-[1.65] text-ink-2">
            <?php echo esc_html( $s[2] ); ?>
          </p>
        </div>

      </article>
    <?php endforeach; ?>

  </div>
</section>

<!-- ══════════════ Datos en corto ══════════════ -->
<section class="border-b border-rule bg-paper-2">
  <div class="mx-auto max-w-[1200px] px-6 py-14 lg:px-12 lg:py-16">
    <div data-reveal class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12">

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-1">
        <?php echo esc_html( $c['facts_l'] ); ?>
      </p>

      <dl class="mt-5 grid gap-x-10 gap-y-5 sm:grid-cols-2 lg:mt-0 lg:grid-cols-4">
        <?php foreach ( $c['facts'] as $fact ) : ?>
          <div class="min-w-0 border-t border-rule pt-4">
            <dt class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
              <?php echo esc_html( $fact[0] ); ?>
            </dt>
            <dd class="mt-1.5 font-mono text-[0.9375rem] tabular-nums text-ink">
              <?php echo esc_html( $fact[1] ); ?>
            </dd>
          </div>
        <?php endforeach; ?>
      </dl>

    </div>
  </div>
</section>

<!--
  ══════════════ Valores ══════════════
  TODO (Pendiente 07): los cuatro valores vienen del sitio actual y son
  enunciados intercambiables con los de cualquier despacho. Propuesta:
  sustituirlos por cuatro compromisos verificables (tiempo de respuesta,
  plazo de traspaso de registros, qué pasa si un reporte se presenta
  tarde por nuestra causa, en qué idioma responde quién).
  Mientras tanto van como una fila de texto pequeño, NO como tarjetas:
  cuatro tarjetas con icono le darían un peso visual que el contenido
  todavía no sostiene.
-->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-6 py-12 lg:px-12 lg:py-14">
    <div data-reveal class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12">

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-0.5">
        <?php echo esc_html( $c['values_l'] ); ?>
      </p>

      <ul class="mt-4 flex flex-wrap items-center gap-x-3 gap-y-2 lg:mt-0">
        <?php foreach ( $c['values'] as $i => $value ) : ?>
          <li class="flex items-center gap-3 text-[0.9375rem] text-ink-2">
            <?php if ( $i ) : ?>
              <span aria-hidden="true" class="text-rule">·</span>
            <?php endif; ?>
            <?php echo esc_html( $value ); ?>
          </li>
        <?php endforeach; ?>
      </ul>

    </div>
  </div>
</section>

<!-- ══════════════ Cierre ══════════════ -->
<section class="bg-deep text-paper">
  <div class="mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">
    <div data-reveal class="lg:grid lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end lg:gap-16">

      <div>
        <h2 class="sdn-measure-sm font-display text-[1.75rem] font-semibold leading-[1.15] sm:text-[2.25rem]">
          <?php echo esc_html( $c['cta_h2'] ); ?>
        </h2>
        <p class="sdn-measure-sm mt-4 leading-relaxed text-rule">
          <?php echo esc_html( $c['cta_p'] ); ?>
        </p>
      </div>

      <div class="mt-8 flex flex-wrap items-center gap-3 lg:mt-0 lg:shrink-0">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           class="whitespace-nowrap rounded-sm bg-accent-2 px-6 py-3.5 font-body text-[0.9375rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px">
          <?php echo esc_html( $c['cta'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           class="whitespace-nowrap rounded-sm border border-paper/25 px-6 py-3.5 font-body text-[0.9375rem] text-paper transition-colors duration-150 hover:border-accent hover:bg-deep-2">
          <?php echo esc_html( $c['cta_alt'] ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();