<?php
/**
 * Template Name: Servicio — Nómina certificada
 *
 * Soluciones del Norte · Nómina certificada
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
$sdn_key = 'certified-payroll';

$c = $is_en ? array(
	'crumb'   => 'Services',
	'name'    => 'Certified payroll',
	'h1'      => 'Certified payroll reports, on the cycle your project requires.',
	'deck'    => 'For contractors and subcontractors on state or city projects in Oregon and Washington. An incomplete report holds up payment; the goal is that it doesn’t.',
	'cta'     => 'Book an intake call',

	'st1'     => 'What we need from you',
	'st2'     => 'What we do',
	'st3'     => 'What you get',
	'st4'     => 'Who it’s for',

	'need'    => 'The contract number and awarding agency, the wage determination that applies to the project, and hours by worker and by classification.',
	'do'      => array(
		'Match hours against each worker’s classification',
		'Verify the rate against the project’s wage determination',
		'Prepare the report in the format the agency requires',
		'File it on the required cycle and keep the receipt',
	),
	'get'     => 'The certified report filed and archived by project, plus the submission log for when the agency asks.',
	'who'     => 'General contractors and subcontractors on public contracts. If your project is private, this doesn’t apply — you need standard payroll.',

	'more_l'  => 'The other six services',
	'end_h2'  => 'Start with the intake call.',
	'end_p'   => 'Tell us how many employees you have and which states you operate in. That’s enough for us to tell you what you need.',
	'end_alt' => 'See all seven services',
) : array(
	'crumb'   => 'Servicios',
	'name'    => 'Nómina certificada',
	'h1'      => 'Reportes de nómina certificada, en el ciclo que exige el proyecto.',
	'deck'    => 'Para contratistas y subcontratistas con obra estatal o municipal en Oregon y Washington. Un reporte incompleto detiene el pago; el objetivo es que no se detenga.',
	'cta'     => 'Agendar consulta inicial',

	'st1'     => 'Qué necesitamos de ti',
	'st2'     => 'Qué hacemos',
	'st3'     => 'Qué recibes',
	'st4'     => 'Para quién es',

	'need'    => 'El número y la agencia del contrato, la determinación de salario aplicable al proyecto, y las horas por trabajador y por clasificación.',
	'do'      => array(
		'Cotejamos las horas contra la clasificación de cada trabajador',
		'Verificamos la tarifa contra la determinación del proyecto',
		'Preparamos el reporte en el formato que pide la agencia',
		'Lo entregamos en el ciclo exigido y guardamos el acuse',
	),
	'get'     => 'El reporte certificado presentado y archivado por proyecto, más el registro de acuses para cuando la agencia pregunte.',
	'who'     => 'Contratistas generales y subcontratistas con contratos públicos. Si tu obra es privada, esto no aplica: lo tuyo es nómina estándar.',

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

<!-- ══════════════ Glosario · solo en español ══════════════
     Los términos técnicos se dejan en inglés en las dos versiones
     porque así los recibe el contratista de la agencia. La versión en
     español añade la explicación; la inglesa no la necesita, así que
     este bloque no se imprime en /en (copy deck §2.3.2, nota interna).

     TODO (Pendiente 03): validación técnica con el cliente. El
     vocabulario aquí es normativo y tiene que confirmarlo alguien que
     presente estos reportes todas las semanas.
     ═══════════════════════════════════════════════════════ -->
<?php if ( ! $is_en ) : ?>
<section class="sdn-surface sdn-surface--paper-2 border-b border-rule">
  <div class="sdn-grid" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 py-14 lg:px-12 lg:py-16">
    <div data-reveal class="lg:grid lg:grid-cols-[6rem_minmax(0,1fr)] lg:gap-8">

      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-1">
        Glosario
      </p>

      <div class="mt-5 lg:mt-0">
        <p class="sdn-measure-sm text-[0.9375rem] leading-relaxed text-ink-2">
          Estos tres términos aparecen en inglés en todos los documentos del proyecto.
          Los dejamos así para que los reconozcas cuando la agencia te los mande.
        </p>

        <dl class="mt-7 border-t border-rule">
          <div class="border-b border-rule py-5 sm:grid sm:grid-cols-[14rem_minmax(0,1fr)] sm:gap-8">
            <dt class="font-mono text-[0.9375rem] text-ink">Prevailing wage</dt>
            <dd class="sdn-measure-sm mt-2 text-[0.9375rem] leading-relaxed text-ink-2 sm:mt-0">
              El salario mínimo que el proyecto obliga a pagar por cada clasificación de
              trabajo. No es el salario mínimo del estado y no es el que tú acordaste:
              es el del contrato.
            </dd>
          </div>

          <div class="border-b border-rule py-5 sm:grid sm:grid-cols-[14rem_minmax(0,1fr)] sm:gap-8">
            <dt class="font-mono text-[0.9375rem] text-ink">Wage determination</dt>
            <dd class="sdn-measure-sm mt-2 text-[0.9375rem] leading-relaxed text-ink-2 sm:mt-0">
              El documento que fija esas tarifas para tu proyecto en concreto. Sale con
              el contrato y es contra lo que se coteja cada hora reportada.
            </dd>
          </div>

          <div class="border-b border-rule py-5 sm:grid sm:grid-cols-[14rem_minmax(0,1fr)] sm:gap-8">
            <dt class="font-mono text-[0.9375rem] text-ink">WH-347</dt>
            <dd class="sdn-measure-sm mt-2 text-[0.9375rem] leading-relaxed text-ink-2 sm:mt-0">
              La forma federal de nómina certificada. Algunas agencias estatales y
              municipales aceptan su propio formato en lugar de esta; por eso lo primero
              que preguntamos es qué agencia otorgó el contrato.
            </dd>
          </div>
        </dl>
      </div>

    </div>
  </div>
</section>
<?php endif; ?>

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