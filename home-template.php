<?php
/**
 * Template Name: Home — Landing principal
 *
 * Soluciones del Norte · Home
 * Macroestructura: Split Studio (15) — cada bloque parte la pantalla en
 * dos y la dirección se alterna al bajar. En móvil colapsa a una columna,
 * siempre texto primero.
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

/* ── Imágenes ──────────────────────────────────────────────
   TODO (Pendiente 08): las fotos actuales son capturas reescaladas.
   Sustituir por material propio antes de publicar.
   ───────────────────────────────────────────────────────── */
$sdn_img_certified = content_url( '/uploads/2026/08/nomina-certificada.webp' );
$sdn_img_team      = content_url( '/uploads/2026/08/equipo-oficina.webp' );

/* ── Copy ──────────────────────────────────────────────── */
$c = $is_en ? array(

	/* 01 · Hero */
	'hero_eyebrow'   => 'Oregon and Washington · Service in English and Spanish',
	'hero_h1'        => 'Your payroll goes out on time. So do your filings.',
	'hero_deck'      => 'We run payroll, keep your books and prepare your taxes for businesses in Oregon and Washington. We check each state’s rules before every run, not after.',
	'hero_cta1'      => 'Book an intake call',
	'hero_cta2'      => 'See the seven services',
	'hero_facts'     => array(
		array( 'Office', 'Hillsboro, OR' ),
		array( 'Coverage', 'Oregon + Washington' ),
		array( 'Languages', 'Spanish / English' ),
		array( 'Hours', 'Mon to Fri, 10:00–14:00' ),
	),

	/* 02 · Servicios */
	'svc_eyebrow'    => 'What we do',
	'svc_h2'         => 'Seven services. One point of contact.',
	'svc_deck'       => 'You don’t need to coordinate a bookkeeper, a tax preparer and a notary separately. It all runs through one office and one calendar.',
	'svc_link'       => 'See details',
	'svc_items'      => array(
		array( 'Payroll', 'Calculation, payments and withholdings on the cycle you already use: weekly, biweekly or monthly.', '/en/services/payroll' ),
		array( 'Certified payroll', 'Weekly reports for state and city contracts.', '/en/services/certified-payroll' ),
		array( 'Bookkeeping', 'Books kept current and a monthly report you can read without a translator.', '/en/services/bookkeeping' ),
		array( 'Taxes', 'Personal and business preparation, with deadlines flagged in advance.', '/en/services/taxes' ),
		array( 'Notary and documents', 'Certification of legal documents at the Hillsboro office.', '/en/services/notary' ),
		array( 'Time and attendance', 'Hours and attendance sorted before they hit payroll.', '/en/services/time-attendance' ),
		array( 'Payroll audits', 'Review of records and processes when something doesn’t add up.', '/en/services/payroll-audits' ),
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
	'how_h2'         => 'Three steps to your first run.',
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
	'ops_hours_v'    => 'Monday to Friday, 10:00–14:00',
	'ops_hours_n'    => 'Closed weekends and holidays',

	/* 08 · Cierre */
	'end_h2'         => 'How many employees do you have, and in which states?',
	'end_deck'       => 'With those two answers we can already tell you what you need. Write to us and we’ll set up the intake call.',
	'end_note'       => 'We reply during office hours, Monday to Friday.',
	'end_cta'        => 'Book an intake call',

) : array(

	/* 01 · Hero */
	'hero_eyebrow'   => 'Oregon y Washington · Atención en español e inglés',
	'hero_h1'        => 'Tu nómina sale a tiempo. Tus reportes también.',
	'hero_deck'      => 'Procesamos nómina, llevamos tus libros y preparamos tus impuestos para negocios de Oregon y Washington. Revisamos la regla de cada estado antes de cada corrida, no después.',
	'hero_cta1'      => 'Agendar consulta inicial',
	'hero_cta2'      => 'Ver los siete servicios',
	'hero_facts'     => array(
		array( 'Oficina', 'Hillsboro, OR' ),
		array( 'Cobertura', 'Oregon + Washington' ),
		array( 'Idiomas', 'Español / Inglés' ),
		array( 'Horario', 'Lun a Vie, 10:00–14:00' ),
	),

	/* 02 · Servicios */
	'svc_eyebrow'    => 'Qué hacemos',
	'svc_h2'         => 'Siete servicios. Un solo punto de contacto.',
	'svc_deck'       => 'No tienes que coordinar por separado a un contador, un preparador de impuestos y un notario. Todo pasa por la misma oficina y el mismo calendario.',
	'svc_link'       => 'Ver detalle',
	'svc_items'      => array(
		array( 'Nómina', 'Cálculo, pagos y retenciones en el ciclo que ya usas: semanal, quincenal o mensual.', '/servicios/nomina' ),
		array( 'Nómina certificada', 'Reportes semanales para contratos estatales y municipales.', '/servicios/nomina-certificada' ),
		array( 'Contabilidad', 'Libros al día y un reporte mensual que puedes leer sin traductor.', '/servicios/contabilidad' ),
		array( 'Impuestos', 'Preparación personal y de negocio, con las fechas marcadas por adelantado.', '/servicios/impuestos' ),
		array( 'Notaría y documentos', 'Certificación de documentos legales en la oficina de Hillsboro.', '/servicios/notaria' ),
		array( 'Tiempo y asistencia', 'Horas y asistencia ordenadas antes de que lleguen a la nómina.', '/servicios/tiempo-y-asistencia' ),
		array( 'Auditorías de nómina', 'Revisión de registros y procesos cuando algo no cuadra.', '/servicios/auditorias-de-nomina' ),
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
	'how_h2'         => 'Tres pasos hasta la primera corrida.',
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
	'ops_hours_v'    => 'Lunes a viernes, 10:00–14:00',
	'ops_hours_n'    => 'Cerrado fines de semana y días festivos',

	/* 08 · Cierre */
	'end_h2'         => '¿Cuántos empleados tienes y en qué estados?',
	'end_deck'       => 'Con esas dos respuestas ya podemos decirte qué necesitas. Escríbenos y coordinamos la consulta inicial.',
	'end_note'       => 'Respondemos en horario de oficina, de lunes a viernes.',
	'end_cta'        => 'Agendar consulta inicial',
);

$sdn_contact  = sdn_route( 'contact' );
$sdn_services = sdn_route( 'services' );
$sdn_tel      = 'tel:+1' . preg_replace( '/\D/', '', $sdn['phone1'] );
$sdn_tel2     = 'tel:+1' . preg_replace( '/\D/', '', $sdn['phone2'] );
?>

<!-- ══════════════ 01 · HERO — texto izquierda / datos derecha ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 pb-20 pt-16 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:pb-28 lg:pt-24">

    <div data-reveal>
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['hero_eyebrow'] ); ?>
      </p>

      <h1 class="mt-5 font-display text-[2.125rem] font-bold leading-[1.05] tracking-[-0.02em] text-ink sm:text-5xl lg:text-[3.5rem]">
        <?php echo esc_html( $c['hero_h1'] ); ?>
      </h1>

      <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

      <p class="sdn-measure mt-7 text-[1.0625rem] leading-relaxed text-ink-2">
        <?php echo esc_html( $c['hero_deck'] ); ?>
      </p>

      <div class="mt-9 flex flex-wrap items-center gap-3">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           class="whitespace-nowrap rounded-sm bg-accent-2 px-6 py-3.5 font-body text-[0.9375rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px">
          <?php echo esc_html( $c['hero_cta1'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_services ); ?>"
           class="whitespace-nowrap rounded-sm border border-rule px-6 py-3.5 font-body text-[0.9375rem] text-ink transition-colors duration-150 hover:border-accent hover:bg-paper-2">
          <?php echo esc_html( $c['hero_cta2'] ); ?>
        </a>
      </div>
    </div>

    <!-- Columna de datos: hechos verificables, no cifras sin fuente (ver Pendiente 04) -->
    <div data-reveal="80" class="lg:pt-2">
      <dl class="border-t border-rule">
        <?php foreach ( $c['hero_facts'] as $fact ) : ?>
          <div class="flex items-baseline justify-between gap-6 border-b border-rule py-4">
            <dt class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
              <?php echo esc_html( $fact[0] ); ?>
            </dt>
            <dd class="text-right font-mono text-[0.9375rem] tabular-nums text-ink">
              <?php echo esc_html( $fact[1] ); ?>
            </dd>
          </div>
        <?php endforeach; ?>
      </dl>
    </div>

  </div>
</section>

<!-- ══════════════ 02 · SERVICIOS — lista izquierda / texto derecha ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <!-- Texto: en desktop va a la derecha, en móvil siempre primero -->
    <div data-reveal class="lg:order-2 lg:pt-2">
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['svc_eyebrow'] ); ?>
      </p>
      <h2 class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl">
        <?php echo esc_html( $c['svc_h2'] ); ?>
      </h2>
      <p class="sdn-measure mt-5 leading-relaxed text-ink-2">
        <?php echo esc_html( $c['svc_deck'] ); ?>
      </p>
    </div>

    <ul data-reveal="80" class="lg:order-1">
      <?php foreach ( $c['svc_items'] as $i => $item ) : ?>
        <li>
          <a href="<?php echo esc_url( home_url( $item[2] ) ); ?>"
             class="group flex min-h-[4.5rem] items-center justify-between gap-6 border-b border-rule py-4 transition-colors duration-150 hover:bg-paper-3 <?php echo 0 === $i ? 'border-t' : ''; ?>">
            <span class="min-w-0">
              <span class="block font-display text-[1.0625rem] font-semibold text-ink group-hover:text-accent-2">
                <?php echo esc_html( $item[0] ); ?>
              </span>
              <span class="mt-1 block text-[0.875rem] leading-snug text-muted">
                <?php echo esc_html( $item[1] ); ?>
              </span>
            </span>
            <span class="flex shrink-0 items-center gap-2 whitespace-nowrap font-mono text-[0.6875rem] uppercase tracking-[0.12em] text-muted group-hover:text-accent-2">
              <span class="hidden sm:inline"><?php echo esc_html( $c['svc_link'] ); ?></span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-4 w-4 transition-transform duration-150 group-hover:translate-x-1" aria-hidden="true"><path d="M4 12h15"/><path d="m13 6 6 6-6 6"/></svg>
            </span>
          </a>
        </li>
      <?php endforeach; ?>
    </ul>

  </div>
</section>

<!-- ══════════════ 03 · NÓMINA CERTIFICADA — foto izquierda / texto derecha ══════════════ -->
<section class="border-b border-rule bg-paper-2">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <div data-reveal class="lg:order-2 lg:pt-2">
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-accent-2">
        <?php echo esc_html( $c['cert_eyebrow'] ); ?>
      </p>
      <h2 class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl">
        <?php echo esc_html( $c['cert_h2'] ); ?>
      </h2>
      <p class="sdn-measure mt-5 leading-relaxed text-ink-2"><?php echo esc_html( $c['cert_p1'] ); ?></p>
      <p class="sdn-measure mt-4 leading-relaxed text-ink-2"><?php echo esc_html( $c['cert_p2'] ); ?></p>

      <a href="<?php echo esc_url( home_url( $is_en ? '/en/services/certified-payroll' : '/servicios/nomina-certificada' ) ); ?>"
         class="mt-8 inline-flex items-center gap-2 whitespace-nowrap rounded-sm bg-accent-2 px-6 py-3.5 font-body text-[0.9375rem] font-medium text-paper transition-colors duration-150 hover:bg-accent active:translate-y-px">
        <?php echo esc_html( $c['cert_cta'] ); ?>
      </a>
    </div>

    <figure data-reveal="80" class="lg:order-1">
      <img src="<?php echo esc_url( $sdn_img_certified ); ?>"
           alt="<?php echo esc_attr( $c['cert_alt'] ); ?>"
           width="1200" height="900" loading="lazy" decoding="async"
           class="w-full rounded-sm border border-rule object-cover">
    </figure>

  </div>
</section>

<!-- ══════════════ 04 · CÓMO EMPIEZA — texto izquierda / pasos derecha ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <div data-reveal class="lg:pt-2">
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['how_eyebrow'] ); ?>
      </p>
      <h2 class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl">
        <?php echo esc_html( $c['how_h2'] ); ?>
      </h2>
    </div>

    <ol data-reveal="80" class="space-y-10">
      <?php foreach ( $c['how_steps'] as $step ) : ?>
        <li class="grid grid-cols-[3.5rem_minmax(0,1fr)] gap-5 lg:grid-cols-[5rem_minmax(0,1fr)] lg:gap-6">
          <span aria-hidden="true" class="font-mono text-[2.5rem] font-light leading-none text-rule lg:text-[3.25rem]">
            <?php echo esc_html( $step[0] ); ?>
          </span>
          <div class="min-w-0">
            <h3 class="font-display text-[1.125rem] font-semibold text-ink"><?php echo esc_html( $step[1] ); ?></h3>
            <p class="sdn-measure mt-2 text-[0.9375rem] leading-relaxed text-ink-2"><?php echo esc_html( $step[2] ); ?></p>
          </div>
        </li>
      <?php endforeach; ?>
    </ol>

  </div>
</section>

<!-- ══════════════ 05 · COBERTURA — mapa izquierda / texto derecha ══════════════ -->
<section class="border-b border-rule bg-paper-2">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <div data-reveal class="lg:order-2 lg:pt-2">
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['cov_eyebrow'] ); ?>
      </p>
      <h2 class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl">
        <?php echo esc_html( $c['cov_h2'] ); ?>
      </h2>
      <p class="sdn-measure mt-5 leading-relaxed text-ink-2"><?php echo esc_html( $c['cov_p'] ); ?></p>

      <div class="mt-8 border-l-2 border-accent pl-5">
        <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
          <?php echo esc_html( $c['cov_label'] ); ?>
        </p>
        <address class="mt-2 font-mono text-[0.9375rem] not-italic text-ink">
          <?php echo esc_html( $sdn['address'] ); ?>
        </address>
      </div>

      <p class="sdn-measure mt-6 text-[0.875rem] leading-relaxed text-muted">
        <?php echo esc_html( $c['cov_note'] ); ?>
      </p>
    </div>

    <div data-reveal="80" class="lg:order-1">
      <div class="overflow-hidden rounded-sm border border-rule">
        <iframe
          title="<?php echo esc_attr( $c['cov_maptitle'] ); ?>"
          src="https://www.google.com/maps?q=<?php echo rawurlencode( $sdn['address'] ); ?>&output=embed"
          width="600" height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          class="block h-[22rem] w-full lg:h-[26rem]"
          style="border:0"></iframe>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════ 06 · IDIOMA — texto izquierda / foto derecha ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <div data-reveal class="lg:pt-2">
      <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
        <?php echo esc_html( $c['lang_eyebrow'] ); ?>
      </p>
      <h2 class="mt-4 font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl">
        <?php echo esc_html( $c['lang_h2'] ); ?>
      </h2>
      <p class="sdn-measure-sm mt-5 leading-relaxed text-ink-2"><?php echo esc_html( $c['lang_p'] ); ?></p>
    </div>

    <figure data-reveal="80">
      <img src="<?php echo esc_url( $sdn_img_team ); ?>"
           alt="<?php echo esc_attr( $c['lang_alt'] ); ?>"
           width="1200" height="900" loading="lazy" decoding="async"
           class="w-full rounded-sm border border-rule object-cover">
    </figure>

  </div>
</section>

<!-- ══════════════ 07 · DATOS DE OPERACIÓN — banda a ancho completo ══════════════ -->
<section class="bg-deep text-paper">
  <div class="mx-auto max-w-[1200px] px-6 py-14 lg:px-12 lg:py-16">
    <div data-reveal class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">

      <div class="min-w-0">
        <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_phone'] ); ?></p>
        <p class="mt-3 space-y-1 font-mono text-[0.9375rem]">
          <a href="<?php echo esc_url( $sdn_tel ); ?>" class="block tabular-nums hover:text-accent"><?php echo esc_html( $sdn['phone1'] ); ?></a>
          <a href="<?php echo esc_url( $sdn_tel2 ); ?>" class="block tabular-nums hover:text-accent"><?php echo esc_html( $sdn['phone2'] ); ?></a>
        </p>
      </div>

      <div class="min-w-0">
        <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_email'] ); ?></p>
        <p class="mt-3 font-mono text-[0.9375rem]">
          <a href="mailto:<?php echo esc_attr( $sdn['email'] ); ?>" class="break-all hover:text-accent"><?php echo esc_html( $sdn['email'] ); ?></a>
        </p>
      </div>

      <div class="min-w-0">
        <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_office'] ); ?></p>
        <address class="mt-3 font-mono text-[0.9375rem] not-italic leading-relaxed"><?php echo esc_html( $sdn['address'] ); ?></address>
      </div>

      <div class="min-w-0">
        <p class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule"><?php echo esc_html( $c['ops_hours'] ); ?></p>
        <p class="mt-3 font-mono text-[0.9375rem] tabular-nums leading-relaxed"><?php echo esc_html( $c['ops_hours_v'] ); ?></p>
        <p class="mt-1 font-mono text-[0.8125rem] leading-relaxed text-rule"><?php echo esc_html( $c['ops_hours_n'] ); ?></p>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ 08 · CIERRE — texto izquierda / formulario derecha ══════════════ -->
<section id="contacto" class="border-t border-rule">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 py-20 lg:grid-cols-2 lg:gap-16 lg:px-12 lg:py-28">

    <div data-reveal class="lg:pt-2">
      <h2 class="font-display text-[1.75rem] font-semibold leading-[1.15] text-ink sm:text-4xl">
        <?php echo esc_html( $c['end_h2'] ); ?>
      </h2>
      <p class="sdn-measure mt-5 leading-relaxed text-ink-2"><?php echo esc_html( $c['end_deck'] ); ?></p>
      <p class="mt-6 font-mono text-[0.8125rem] text-muted"><?php echo esc_html( $c['end_note'] ); ?></p>
    </div>

    <!--
      Nodo de montaje del ContactForm (componente React, pendiente).
      El contenido interno es la reserva: si el JS no carga o el
      componente aún no existe, el visitante sigue teniendo una salida.
    -->
    <div data-reveal="80"
         id="sdn-contact-form"
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