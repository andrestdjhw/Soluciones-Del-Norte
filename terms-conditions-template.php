<?php
/**
 * Template Name: Términos y condiciones
 *
 * Soluciones del Norte · Términos y condiciones
 * Macroestructura: Long Document (02), la misma que Nosotros y el
 * aviso de privacidad — prosa continua con raíl de etiquetas a la
 * izquierda, sin tarjetas.
 *
 * TODO: este texto lo redactó un asistente a partir de lo que el sitio
 * hace de verdad (formulario vía EmailJS, filtro de spam vía
 * reCAPTCHA v3, sin lista de precios pública, oficina en Hillsboro,
 * OR). Sirve para publicar algo honesto desde el día uno, pero no
 * reemplaza la revisión de un abogado.
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

/* Clase compartida por los enlaces dentro de párrafos de prosa —
   mismo tratamiento que ya usa el sitio en contact-template.php. */
$sdn_link_cls = 'underline decoration-rule underline-offset-4 hover:decoration-accent';

$sdn_contact = sdn_route( 'contact' );
$sdn_privacy = sdn_route( 'privacy' );

$c = $is_en ? array(
	'eyebrow' => 'Legal',
	'h1'      => 'Terms & conditions',
	'lede'    => 'The rules for using this site and its contact form.',
	'updated' => 'Last updated: August 26, 2026.',
	'cta_h2'  => 'Questions about these terms?',
	'cta_p'   => 'Write to us or call — we reply during office hours, Monday to Friday.',
	'cta'     => 'Contact us',
	'cta_alt' => 'Privacy notice',
) : array(
	'eyebrow' => 'Legal',
	'h1'      => 'Términos y condiciones',
	'lede'    => 'Las reglas de uso de este sitio y de su formulario de contacto.',
	'updated' => 'Última actualización: 26 de agosto de 2026.',
	'cta_h2'  => '¿Preguntas sobre estos términos?',
	'cta_p'   => 'Escríbenos o llama — respondemos en horario de oficina, de lunes a viernes.',
	'cta'     => 'Contáctanos',
	'cta_alt' => 'Aviso de privacidad',
);

/* Mismo formato que privacy-policy-template.php: [ raíl, encabezado,
   cuerpo, ¿el cuerpo trae HTML de confianza? ]. Solo la fila que
   enlaza al aviso de privacidad usa HTML — el resto se queda con
   esc_html(). */
$sdn_sections = $is_en ? array(
	array(
		'Acceptance',
		'By using this site',
		'Using this site means accepting these terms. If you don’t agree, the way to say so is not using it — you can always call or write to us directly by phone or email instead of the form.',
		false,
	),
	array(
		'The content',
		'What this site is, and what it isn’t',
		'What’s here is general information about our payroll, bookkeeping, tax and document services. It isn’t personalized advice or a service contract — that comes out of the intake call, with your actual situation on the table.',
		false,
	),
	array(
		'Pricing',
		'About pricing',
		'We don’t publish a price list because scope changes with your employee count and the states you operate in. The price comes out of the intake call, together with the scope, before you commit to anything.',
		false,
	),
	array(
		'The form',
		'Using the contact form',
		sprintf(
			'When you submit the form, your message is processed with EmailJS and checked with Google reCAPTCHA v3 to filter out automated submissions. What each of those services does with your information is spelled out in the <a href="%1$s" class="%2$s">privacy notice</a>.',
			esc_url( $sdn_privacy ),
			esc_attr( $sdn_link_cls )
		),
		true,
	),
	array(
		'Third parties',
		'Links and other people’s services',
		'This site links to or embeds services we don’t run: the office map (Google Maps), our social media (Facebook, Instagram, TikTok) and the typefaces (Google Fonts). We aren’t responsible for the content or the practices of those services.',
		false,
	),
	array(
		'Ownership',
		'The content is ours',
		'The text, photos and brand on this site belong to Soluciones del Norte, except where noted otherwise. Don’t use them without permission.',
		false,
	),
	array(
		'No guarantees',
		'The site is provided as-is',
		'We do our best to keep the site working and the information current, but we don’t guarantee it’s always available or error-free. If something doesn’t load or you see outdated information, tell us.',
		false,
	),
	array(
		'Governing law',
		'What law governs this',
		'These terms are governed by the laws of the State of Oregon, where our office is located.',
		false,
	),
	array(
		'Changes',
		'Changes to these terms',
		'We may update these terms when needed. The date at the top shows the last update.',
		false,
	),
) : array(
	array(
		'Aceptación',
		'Al usar este sitio',
		'Usar este sitio implica aceptar estos términos. Si no estás de acuerdo, la forma de decirlo es no usarlo — siempre puedes llamarnos o escribirnos directo por teléfono o correo en vez de usar el formulario.',
		false,
	),
	array(
		'El contenido',
		'Qué es este sitio, y qué no es',
		'Lo que hay aquí es información general sobre nuestros servicios de nómina, contabilidad, impuestos y documentos. No es asesoría personalizada ni un contrato de servicio — eso sale de la consulta inicial, con tu situación concreta sobre la mesa.',
		false,
	),
	array(
		'Precios',
		'Sobre los precios',
		'No publicamos lista de precios porque el alcance cambia con el número de empleados y los estados donde operas. El precio sale de la consulta inicial, junto con el alcance, antes de que contrates nada.',
		false,
	),
	array(
		'El formulario',
		'Uso del formulario de contacto',
		sprintf(
			'Al enviar el formulario, tu mensaje se procesa con EmailJS y se verifica con Google reCAPTCHA v3 para filtrar envíos automatizados. Qué hace cada uno con tu información está explicado en el <a href="%1$s" class="%2$s">aviso de privacidad</a>.',
			esc_url( $sdn_privacy ),
			esc_attr( $sdn_link_cls )
		),
		true,
	),
	array(
		'Terceros',
		'Enlaces y servicios de otros',
		'Este sitio enlaza o incrusta servicios que no operamos nosotros: el mapa de la oficina (Google Maps), nuestras redes sociales (Facebook, Instagram, TikTok) y las tipografías (Google Fonts). No respondemos por el contenido ni las prácticas de esos servicios.',
		false,
	),
	array(
		'Propiedad',
		'El contenido es nuestro',
		'El texto, las fotos y la marca de este sitio son de Soluciones del Norte, salvo donde se indique lo contrario. No los uses sin permiso.',
		false,
	),
	array(
		'Sin garantías',
		'El sitio se ofrece tal cual',
		'Hacemos lo posible para que el sitio funcione bien y la información esté al día, pero no garantizamos que esté siempre disponible ni libre de errores. Si algo no carga o ves un dato desactualizado, dínoslo.',
		false,
	),
	array(
		'Ley aplicable',
		'Bajo qué ley operamos',
		'Estos términos se rigen por las leyes del estado de Oregon, donde está nuestra oficina.',
		false,
	),
	array(
		'Cambios',
		'Cambios a estos términos',
		'Podemos actualizar estos términos cuando haga falta. La fecha de arriba indica la última actualización.',
		false,
	),
);
?>

<!-- ══════════════ Entrada ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-6 pb-16 pt-16 lg:px-12 lg:pb-20 lg:pt-24">
    <div data-reveal class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12">

      <p data-i18n="terms.eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-3">
        <?php echo esc_html( $c['eyebrow'] ); ?>
      </p>

      <div class="mt-5 lg:mt-0">
        <h1 data-i18n="terms.h1" class="sdn-measure-sm font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-ink sm:text-[2.75rem] lg:text-5xl">
          <?php echo esc_html( $c['h1'] ); ?>
        </h1>

        <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

        <p data-i18n="terms.lede" class="sdn-measure-sm mt-8 text-[1.125rem] leading-[1.65] text-ink">
          <?php echo esc_html( $c['lede'] ); ?>
        </p>
        <p data-i18n="terms.updated" class="mt-4 font-mono text-[0.8125rem] text-muted">
          <?php echo esc_html( $c['updated'] ); ?>
        </p>
      </div>

    </div>
  </div>
</section>

<!-- ══════════════ Prosa con raíl de etiquetas ══════════════
     Mismo patrón que about-template.php y el aviso de privacidad.
     ═══════════════════════════════════════════════════════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">

    <?php foreach ( $sdn_sections as $i => $s ) : ?>
      <article data-reveal="<?php echo esc_attr( min( $i * 40, 400 ) ); ?>"
               class="lg:grid lg:grid-cols-[10rem_minmax(0,1fr)] lg:gap-12 <?php echo $i ? 'mt-12 border-t border-rule-2 pt-12' : ''; ?>">

        <p data-i18n="terms.<?php echo esc_attr( $i ); ?>.rail" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted lg:pt-2">
          <?php echo esc_html( $s[0] ); ?>
        </p>

        <div class="mt-4 lg:mt-0">
          <h2 data-i18n="terms.<?php echo esc_attr( $i ); ?>.head" class="sdn-measure-sm font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
            <?php echo esc_html( $s[1] ); ?>
          </h2>
          <p data-i18n="terms.<?php echo esc_attr( $i ); ?>.body" class="sdn-measure mt-4 text-[1.0625rem] leading-[1.65] text-ink-2">
            <?php echo $s[3] ? wp_kses_post( $s[2] ) : esc_html( $s[2] ); ?>
          </p>
        </div>

      </article>
    <?php endforeach; ?>

  </div>
</section>

<!-- ══════════════ Cierre — sin video a propósito ══════════════
     Mismo criterio que privacy-policy-template.php: quien llega a
     unos términos y condiciones está verificando algo, no decidiendo
     si confía. El cierre de venta sobraría.
     ═══════════════════════════════════════════════════════════ -->
<section class="bg-paper-2">
  <div class="mx-auto max-w-[1200px] px-6 py-14 lg:px-12 lg:py-16">
    <div data-reveal class="lg:grid lg:grid-cols-[minmax(0,1fr)_auto] lg:items-end lg:gap-16">

      <div>
        <h2 data-i18n="terms.cta_h2" class="sdn-measure-sm font-display text-[1.375rem] font-semibold leading-tight text-ink sm:text-[1.625rem]">
          <?php echo esc_html( $c['cta_h2'] ); ?>
        </h2>
        <p data-i18n="terms.cta_p" class="sdn-measure-sm mt-3 leading-relaxed text-ink-2">
          <?php echo esc_html( $c['cta_p'] ); ?>
        </p>
      </div>

      <div class="mt-6 flex flex-wrap items-center gap-3 lg:mt-0 lg:shrink-0">
        <a href="<?php echo esc_url( $sdn_contact ); ?>"
           data-i18n="terms.cta" data-i18n-href="route.contact"
           class="sdn-cta">
          <?php echo esc_html( $c['cta'] ); ?>
        </a>
        <a href="<?php echo esc_url( $sdn_privacy ); ?>"
           data-i18n="terms.cta_alt" data-i18n-href="route.privacy"
           class="sdn-cta sdn-cta--ghost-ink">
          <?php echo esc_html( $c['cta_alt'] ); ?>
        </a>
      </div>

    </div>
  </div>
</section>

<?php
get_footer();
