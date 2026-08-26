<?php
/**
 * Template Name: Servicio — Contabilidad
 *
 * Soluciones del Norte · Contabilidad
 * Macroestructura: Narrative Workflow (14) — cuatro etapas numeradas
 * ancladas a un raíl de 96 px. El orden es el mismo en las siete
 * páginas de servicio a propósito: quien compara dos servicios
 * encuentra la misma información en el mismo lugar. Lo que cambia es
 * el contenido, nunca el orden.
 *
 * La etapa 1.0 es «Qué necesitamos de ti» y va primero, no al final:
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
$sdn_key = 'bookkeeping';

$c = $is_en ? array(
	'crumb'   => 'Services',
	'name'    => 'Bookkeeping',
	'h1'      => 'Books kept current and a report you can actually read.',
	'deck'    => 'Recording, reconciliation and monthly close, so year-end brings no surprises and no scramble.',
	'cta'     => 'Book an intake call',

	'st1'     => 'What we need from you',
	'st2'     => 'What we do',
	'st3'     => 'What you get',
	'st4'     => 'Who it’s for',

	'need'    => 'Read access to your bank and card accounts, and the month’s invoices. If you keep everything on paper, we digitize it the first time.',
	'do'      => array(
		'Record income and expenses by category',
		'Reconcile each account against its statement',
		'Close the month and flag what’s still open',
		'Prepare the package the tax preparer uses',
	),
	'get'     => 'A monthly P&L and balance sheet, plus a short list of what needs a decision from you.',
	'who'     => 'Businesses invoicing consistently that keep their books in spreadsheets — or don’t keep them at all.',

	'more_l'  => 'The other six services',
	'end_h2'  => 'Start with the intake call.',
	'end_p'   => 'Tell us how many employees you have and which states you operate in. That’s enough for us to tell you what you need.',
	'end_alt' => 'See all seven services',
) : array(
	'crumb'   => 'Servicios',
	'name'    => 'Contabilidad',
	'h1'      => 'Libros al día y un reporte que sí se entiende.',
	'deck'    => 'Registro, conciliación y cierre mensual para que a fin de año no haya sorpresas ni carreras.',
	'cta'     => 'Agendar consulta inicial',

	'st1'     => 'Qué necesitamos de ti',
	'st2'     => 'Qué hacemos',
	'st3'     => 'Qué recibes',
	'st4'     => 'Para quién es',

	'need'    => 'Acceso de lectura a tus cuentas bancarias y de tarjeta, y las facturas del mes. Si llevas todo en papel, la primera vez lo digitalizamos nosotros.',
	'do'      => array(
		'Registramos ingresos y gastos por categoría',
		'Conciliamos cada cuenta contra el estado de cuenta',
		'Cerramos el mes y marcamos lo que quedó pendiente',
		'Preparamos el paquete que usa el preparador de impuestos',
	),
	'get'     => 'Estado de resultados y balance cada mes, más una lista corta de lo que necesita tu decisión.',
	'who'     => 'Negocios que ya facturan de forma constante y llevan los libros en hojas de cálculo o no los llevan.',

	'more_l'  => 'Los otros seis servicios',
	'end_h2'  => 'Empieza por la consulta inicial.',
	'end_p'   => 'Dinos cuántos empleados tienes y en qué estados operas. Con eso ya podemos decirte qué necesitas.',
	'end_alt' => 'Ver los siete servicios',
);

$sdn_contact  = sdn_route( 'contact' );
$sdn_services = sdn_route( 'services' );

/* Las cuatro etapas. La 2.0 es la única que va en lista: son acciones
   operativas y se leen mejor una debajo de otra que en prosa. */
$sdn_stages = array(
	array( '1.0', $c['st1'], $c['need'], null ),
	array( '2.0', $c['st2'], null, $c['do'] ),
	array( '3.0', $c['st3'], $c['get'], null ),
	array( '4.0', $c['st4'], $c['who'], null ),
);
?>

<!-- ══════════════ Hero ══════════════
     Sin imagen a sangre: fondo de papel y la regla gruesa en Cerulean
     bajo el H1. Un solo CTA — el sitio tiene un solo verbo.
     ═══════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 pb-16 pt-16 lg:px-12 lg:pb-20 lg:pt-24">
    <div data-reveal>

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           class="inline-block whitespace-nowrap transition-colors duration-150 hover:text-accent-2">
          <?php echo esc_html( $c['crumb'] ); ?>
        </a>
        <span aria-hidden="true" class="px-2 text-rule">/</span>
        <span class="text-ink-2"><?php echo esc_html( $c['name'] ); ?></span>
      </p>

      <h1 class="sdn-measure-sm mt-5 font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-ink sm:text-[2.75rem] lg:text-5xl">
        <?php echo esc_html( $c['h1'] ); ?>
      </h1>

      <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

      <p class="sdn-measure mt-8 text-[1.125rem] leading-[1.65] text-ink-2">
        <?php echo esc_html( $c['deck'] ); ?>
      </p>

      <a href="<?php echo esc_url( $sdn_contact ); ?>"
         class="mt-9 inline-block whitespace-nowrap rounded-sm bg-accent-2 px-6 py-3.5 font-body text-[0.9375rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px">
        <?php echo esc_html( $c['cta'] ); ?>
      </a>

    </div>
  </div>
</section>

<!-- ══════════════ Etapas 1.0 – 4.0 ══════════════
     El número se ancla al raíl de 6 rem y va en la regla, no en el
     acento: es una marca de posición, no un titular. En móvil sube
     encima del título en lugar de desaparecer.
     ══════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--paper border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-24">

    <?php foreach ( $sdn_stages as $i => $stage ) : ?>
      <article data-reveal="<?php echo esc_attr( $i * 60 ); ?>"
               class="lg:grid lg:grid-cols-[6rem_minmax(0,1fr)] lg:gap-8 <?php echo $i ? 'mt-12 border-t border-rule-2 pt-12 lg:mt-16 lg:pt-16' : ''; ?>">

        <p aria-hidden="true"
           class="font-mono text-[3rem] font-light leading-none tabular-nums text-rule lg:text-[4.5rem] lg:leading-[0.85]">
          <?php echo esc_html( $stage[0] ); ?>
        </p>

        <div class="mt-4 min-w-0 lg:mt-0">
          <h2 class="font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
            <?php echo esc_html( $stage[1] ); ?>
          </h2>

          <?php if ( $stage[2] ) : ?>
            <p class="sdn-measure-sm mt-4 text-[1.0625rem] leading-[1.65] text-ink-2">
              <?php echo esc_html( $stage[2] ); ?>
            </p>
          <?php endif; ?>

          <?php if ( $stage[3] ) : ?>
            <ul class="mt-5 space-y-3">
              <?php foreach ( $stage[3] as $line ) : ?>
                <li class="sdn-measure-sm flex gap-4 text-[1.0625rem] leading-[1.65] text-ink-2">
                  <span aria-hidden="true" class="mt-[0.8em] h-px w-4 shrink-0 bg-accent"></span>
                  <span class="min-w-0"><?php echo esc_html( $line ); ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>

      </article>
    <?php endforeach; ?>

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

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-1">
        <?php echo esc_html( $c['more_l'] ); ?>
      </p>

      <ul class="mt-4 flex flex-wrap gap-x-6 gap-y-3 lg:mt-0">
        <?php foreach ( sdn_services() as $key => $svc ) : ?>
          <?php if ( $key === $sdn_key ) { continue; } ?>
          <li>
            <a href="<?php echo esc_url( home_url( $svc['path'] ) ); ?>"
               class="whitespace-nowrap text-[0.9375rem] text-ink-2 underline decoration-rule underline-offset-4 transition-colors duration-150 hover:text-accent-2 hover:decoration-accent">
              <?php echo esc_html( $svc['name'] ); ?>
            </a>
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
          <?php echo esc_html( $c['end_h2'] ); ?>
        </h2>
        <p class="sdn-measure-sm mt-4 leading-relaxed text-rule">
          <?php echo esc_html( $c['end_p'] ); ?>
        </p>
      </div>

      <div class="mt-8 flex flex-wrap items-center gap-3 lg:mt-0 lg:shrink-0">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           class="whitespace-nowrap rounded-sm bg-accent-2 px-6 py-3.5 font-body text-[0.9375rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px">
          <?php echo esc_html( $c['cta'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           class="whitespace-nowrap rounded-sm border border-paper/25 px-6 py-3.5 font-body text-[0.9375rem] text-paper transition-colors duration-150 hover:border-accent hover:bg-deep-2">
          <?php echo esc_html( $c['end_alt'] ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();