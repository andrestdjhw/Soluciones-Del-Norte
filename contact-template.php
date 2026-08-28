<?php
/**
 * Template Name: Contacto
 *
 * Soluciones del Norte · Contacto
 * Sin macroestructura: es una página utilitaria. El visitante que llega
 * aquí ya decidió; lo único que importa es que encuentre el dato o el
 * campo sin buscarlo.
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
	'eyebrow'    => 'Contact',
	'h1'         => 'Write to us and we’ll set up the intake call.',
	'deck'       => 'If you already know what you need, say so in the message. If not, your employee count and the states you operate in are enough to start.',

	'l_phone'    => 'Phone',
	'l_email'    => 'Email',
	'l_office'   => 'Office',
	'l_hours'    => 'Hours',
	'hours_v'    => 'Monday to Friday, 10:00–14:00',
	'hours_n'    => 'Closed weekends and holidays',
	'directions' => 'Getting here',
	'map_title'  => 'Map of the Hillsboro office',
	'map_note'   => 'Notarizations and in-person appointments happen at this office. Everything else we handle remotely across Oregon and Washington.',

	'form_h2'    => 'Send us your details',
	'form_note'  => 'We reply during office hours, Monday to Friday.',
	'fb_intro'   => 'The form needs JavaScript. In the meantime, these work just as well:',
	'social'     => 'Social media',
) : array(
	'eyebrow'    => 'Contacto',
	'h1'         => 'Escríbenos y coordinamos la consulta inicial.',
	'deck'       => 'Si ya sabes qué necesitas, dínoslo en el mensaje. Si no, con el número de empleados y los estados donde operas es suficiente para empezar.',

	'l_phone'    => 'Teléfono',
	'l_email'    => 'Correo',
	'l_office'   => 'Oficina',
	'l_hours'    => 'Horario',
	'hours_v'    => 'Lunes a viernes, 10:00–14:00',
	'hours_n'    => 'Cerrado fines de semana y días festivos',
	'directions' => 'Cómo llegar',
	'map_title'  => 'Mapa de la oficina de Hillsboro',
	'map_note'   => 'Las notarizaciones y las citas presenciales son en esta oficina. Todo lo demás lo llevamos a distancia en Oregon y Washington.',

	'form_h2'    => 'Mándanos tus datos',
	'form_note'  => 'Respondemos en horario de oficina, de lunes a viernes.',
	'fb_intro'   => 'El formulario necesita JavaScript. Mientras tanto, esto funciona igual de bien:',
	'social'     => 'Redes sociales',
);

$sdn_tel  = 'tel:+1' . preg_replace( '/\D/', '', $sdn['phone1'] );
$sdn_tel2 = 'tel:+1' . preg_replace( '/\D/', '', $sdn['phone2'] );

/* Foto de fondo del encabezado — vertical (1024×1534), a diferencia
   de las fotos de fondo de las páginas de servicio, que son
   horizontales. Lo que tiene que verse son las manos sobre el
   teclado, y esa franja real cae más o menos a la mitad de la foto
   (el cuello/collar queda arriba, las piernas quedan abajo) — así
   que el recorte no puede anclarse a un extremo (0 % o 100 %):
   necesita un punto intermedio, afinado a ojo.

     · object-[center_55%]: en vez de las palabras clave `object-top`
       / `object-bottom` (0 % / 100 %), este es un valor intermedio
       elegido probando varios (40–70 %) contra el tamaño real de la
       franja del encabezado hasta encontrar el que deja las manos y
       el teclado enteros dentro del recorte, tanto en la banda ancha
       de escritorio (recorte muy angosto, ~17 % alto de la foto)
       como en la banda alta de móvil (recorte más generoso, ~50 %).
       El mismo 55 % sirvió para ambas.

     · En móvil la banda es más alta que ancha (el texto apila varias
       líneas), así que en la clase de abajo la imagen lleva
       `aspect-[4/3]` hasta el punto de quiebre lg: una banda de
       proporción fija que dejó de crecer con el texto. Lo que sobra
       de sección por encima de esa banda se ve en Space Indigo
       plano —el mismo color que ya pinta el velo— así que no hay
       costura visible.

   Ojo con `lg:h-full`: en un elemento reemplazado (`<img>`, a
   diferencia de un `<div>`) fijar `top` y `bottom` sin fijar `height`
   no lo estira entre los dos — el navegador calcula el alto desde la
   proporción intrínseca de la foto e ignora `bottom`. Es lo que pasó
   la primera vez: la imagen se salía por debajo del recorte sin
   importar el object-position, porque medía más de 2000 px de alto
   en vez de los ~360 px de la sección. `.sdn-veil`, al lado, es un
   `<div>` y con el mismo top/bottom sí se estira bien — la regla es
   distinta para elementos reemplazados. */
$sdn_img_hero = sdn_attachment_image( content_url( '/uploads/2026/08/SDN_Contact_Hero.jpg' ), 'large' );
?>

<!-- ══════════════ Encabezado — foto de fondo ══════════════
     Mismo tratamiento que el hero de las páginas de servicio: foto
     propia con el velo diagonal del cierre en video, el color de la
     superficie sigue debajo de la imagen para que el contraste del
     texto no dependa de que cargue.
     ═══════════════════════════════════════════════════════════════ -->
<section class="sdn-surface sdn-surface--video text-paper border-b border-paper/15">
  <?php if ( $sdn_img_hero ) : ?>
    <img src="<?php echo esc_url( $sdn_img_hero['src'] ); ?>"
         <?php if ( $sdn_img_hero['srcset'] ) : ?>srcset="<?php echo esc_attr( $sdn_img_hero['srcset'] ); ?>" sizes="100vw"<?php endif; ?>
         alt="" aria-hidden="true" fetchpriority="high"
         class="absolute inset-x-0 bottom-0 aspect-[4/3] w-full object-cover object-[center_55%] lg:top-0 lg:h-full lg:aspect-auto">
  <?php endif; ?>
  <div class="sdn-veil" aria-hidden="true"></div>

  <div class="sdn-layer mx-auto max-w-[1200px] px-6 pb-14 pt-16 lg:px-12 lg:pb-16 lg:pt-24">
    <div data-reveal>
      <p data-i18n="contact.eyebrow" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-rule">
        <?php echo esc_html( $c['eyebrow'] ); ?>
      </p>

      <h1 data-i18n="contact.h1" class="sdn-measure mt-5 font-display text-[2rem] font-bold leading-[1.05] tracking-[-0.02em] text-paper sm:text-[2.75rem] lg:text-5xl">
        <?php echo esc_html( $c['h1'] ); ?>
      </h1>

      <div class="mt-6 h-1 w-20 bg-accent" aria-hidden="true"></div>

      <p data-i18n="contact.deck" class="sdn-measure mt-7 text-[1.0625rem] leading-relaxed text-rule">
        <?php echo esc_html( $c['deck'] ); ?>
      </p>
    </div>
  </div>
</section>

<!-- ══════════════ Datos + formulario ══════════════ -->
<section class="border-b border-rule">
  <div class="mx-auto grid max-w-[1200px] gap-12 px-6 py-16 lg:grid-cols-[minmax(0,1fr)_minmax(0,1.15fr)] lg:gap-16 lg:px-12 lg:py-20">

    <!-- Columna de datos -->
    <div data-reveal>
      <dl class="border-t border-rule">

        <div class="border-b border-rule py-5">
          <dt data-i18n="contact.l_phone" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
            <?php echo esc_html( $c['l_phone'] ); ?>
          </dt>
          <dd class="mt-2 font-mono text-[1.0625rem] text-ink">
            <a href="<?php echo esc_url( $sdn_tel ); ?>" class="block tabular-nums hover:text-accent-2"><?php echo esc_html( $sdn['phone1'] ); ?></a>
            <a href="<?php echo esc_url( $sdn_tel2 ); ?>" class="mt-1 block tabular-nums hover:text-accent-2"><?php echo esc_html( $sdn['phone2'] ); ?></a>
          </dd>
        </div>

        <div class="border-b border-rule py-5">
          <dt data-i18n="contact.l_email" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
            <?php echo esc_html( $c['l_email'] ); ?>
          </dt>
          <dd class="mt-2 font-mono text-[1.0625rem] text-ink">
            <a href="mailto:<?php echo esc_attr( $sdn['email'] ); ?>" class="break-all hover:text-accent-2"><?php echo esc_html( $sdn['email'] ); ?></a>
          </dd>
        </div>

        <div class="border-b border-rule py-5">
          <dt data-i18n="contact.l_office" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
            <?php echo esc_html( $c['l_office'] ); ?>
          </dt>
          <dd class="mt-2">
            <address class="font-mono text-[1.0625rem] not-italic leading-relaxed text-ink">
              <?php echo esc_html( $sdn['address'] ); ?>
            </address>
            <a href="<?php echo esc_url( $sdn['map_url'] ); ?>" target="_blank" rel="noopener noreferrer"
               class="mt-2 inline-flex items-center gap-1.5 whitespace-nowrap font-mono text-[0.8125rem] text-accent-2 hover:text-accent">
              <span data-i18n="contact.directions"><?php echo esc_html( $c['directions'] ); ?></span>
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" class="h-3.5 w-3.5" aria-hidden="true"><path d="M4 12h15"/><path d="m13 6 6 6-6 6"/></svg>
            </a>
          </dd>
        </div>

        <div class="border-b border-rule py-5">
          <dt data-i18n="contact.l_hours" class="font-mono text-[0.6875rem] uppercase tracking-[0.14em] text-muted">
            <?php echo esc_html( $c['l_hours'] ); ?>
          </dt>
          <dd class="mt-2 font-mono text-[1.0625rem] tabular-nums text-ink">
            <span data-i18n="contact.hours_v"><?php echo esc_html( $c['hours_v'] ); ?></span>
            <span data-i18n="contact.hours_n" class="mt-1 block text-[0.8125rem] text-muted"><?php echo esc_html( $c['hours_n'] ); ?></span>
          </dd>
        </div>

      </dl>

      <!-- Redes -->
      <nav aria-label="<?php echo esc_attr( $c['social'] ); ?>" data-i18n-aria-label="contact.social" class="mt-8 flex items-center gap-2">
        <a href="<?php echo esc_url( $sdn['facebook'] ); ?>" target="_blank" rel="noopener noreferrer"
           class="flex h-10 w-10 items-center justify-center rounded-sm border border-rule text-muted transition-colors duration-150 hover:border-accent hover:text-accent-2">
          <svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4" aria-hidden="true"><path d="M13.5 21v-7.6h2.6l.4-3h-3V8.5c0-.9.25-1.5 1.5-1.5H16.6V4.3A20 20 0 0 0 14.3 4.2c-2.3 0-3.9 1.4-3.9 4v2.2H7.8v3h2.6V21h3.1Z"/></svg>
          <span class="sr-only">Facebook</span>
        </a>
        <a href="<?php echo esc_url( $sdn['instagram'] ); ?>" target="_blank" rel="noopener noreferrer"
           class="flex h-10 w-10 items-center justify-center rounded-sm border border-rule text-muted transition-colors duration-150 hover:border-accent hover:text-accent-2">
          <svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4" aria-hidden="true"><path d="M12 4.6c2.4 0 2.7 0 3.6.05.9.04 1.4.2 1.7.32.43.17.74.37 1.06.7.33.32.53.63.7 1.06.12.3.28.8.32 1.7.05.9.05 1.2.05 3.6s0 2.7-.05 3.6c-.04.9-.2 1.4-.32 1.7-.17.43-.37.74-.7 1.06-.32.33-.63.53-1.06.7-.3.12-.8.28-1.7.32-.9.05-1.2.05-3.6.05s-2.7 0-3.6-.05c-.9-.04-1.4-.2-1.7-.32a2.9 2.9 0 0 1-1.06-.7 2.9 2.9 0 0 1-.7-1.06c-.12-.3-.28-.8-.32-1.7C4.6 14.7 4.6 14.4 4.6 12s0-2.7.05-3.6c.04-.9.2-1.4.32-1.7.17-.43.37-.74.7-1.06a2.9 2.9 0 0 1 1.06-.7c.3-.12.8-.28 1.7-.32.9-.05 1.2-.05 3.6-.05Zm0 4a3.4 3.4 0 1 0 0 6.8 3.4 3.4 0 0 0 0-6.8Zm0 5.6a2.2 2.2 0 1 1 0-4.4 2.2 2.2 0 0 1 0 4.4Zm4.35-5.74a.8.8 0 1 1-1.6 0 .8.8 0 0 1 1.6 0Z"/></svg>
          <span class="sr-only">Instagram</span>
        </a>
        <a href="<?php echo esc_url( $sdn['tiktok'] ); ?>" target="_blank" rel="noopener noreferrer"
           class="flex h-10 w-10 items-center justify-center rounded-sm border border-rule text-muted transition-colors duration-150 hover:border-accent hover:text-accent-2">
          <svg viewBox="0 0 24 24" fill="currentColor" class="h-4 w-4" aria-hidden="true"><path d="M16.1 3h-2.7v11.4a2.1 2.1 0 1 1-1.75-2.07V9.6a4.9 4.9 0 1 0 4.45 4.88V9.06a5.9 5.9 0 0 0 3.4 1.07V7.4a3.3 3.3 0 0 1-3.4-3.2V3Z"/></svg>
          <span class="sr-only">TikTok</span>
        </a>
      </nav>
    </div>

    <!-- Formulario permanente -->
    <div data-reveal="80">
      <h2 data-i18n="contact.form_h2" class="font-display text-[1.5rem] font-semibold leading-tight text-ink sm:text-[1.75rem]">
        <?php echo esc_html( $c['form_h2'] ); ?>
      </h2>
      <p data-i18n="contact.form_note" class="mt-3 font-mono text-[0.8125rem] text-muted"><?php echo esc_html( $c['form_note'] ); ?></p>

      <!--
        Nodo de montaje del ContactForm (componente React, pendiente).
        `persistent` = siempre visible, sin modal. `density=comfortable`
        es la variante de página, más aireada que la del hero.
        El contenido interno es la reserva si el JS no carga.
      -->
      <div class="mt-6"
           id="sdn-contact-form-pagina"
           data-sdn-form
           data-density="comfortable"
           data-persistent="true"
           data-lang="<?php echo esc_attr( $sdn_lang ); ?>">
        <div class="rounded-sm border border-rule bg-paper-2 p-8">
          <p data-i18n="contact.fb_intro" class="text-[0.9375rem] leading-relaxed text-ink-2"><?php echo esc_html( $c['fb_intro'] ); ?></p>
          <p class="mt-4 font-mono text-[1.0625rem] leading-relaxed text-ink">
            <a href="<?php echo esc_url( $sdn_tel ); ?>" class="tabular-nums underline decoration-rule underline-offset-4 hover:decoration-accent"><?php echo esc_html( $sdn['phone1'] ); ?></a><br>
            <a href="mailto:<?php echo esc_attr( $sdn['email'] ); ?>" class="break-all underline decoration-rule underline-offset-4 hover:decoration-accent"><?php echo esc_html( $sdn['email'] ); ?></a>
          </p>
        </div>
      </div>
    </div>

  </div>
</section>

<!-- ══════════════ Cómo llegar ══════════════ -->
<section>
  <div class="mx-auto max-w-[1200px] px-6 py-16 lg:px-12 lg:py-20">
    <div data-reveal>
      <h2 data-i18n="contact.directions" class="font-display text-[1.5rem] font-semibold leading-tight text-ink sm:text-[1.75rem]">
        <?php echo esc_html( $c['directions'] ); ?>
      </h2>
      <p data-i18n="contact.map_note" class="sdn-measure mt-3 text-[0.9375rem] leading-relaxed text-ink-2">
        <?php echo esc_html( $c['map_note'] ); ?>
      </p>

      <div class="mt-8 overflow-hidden rounded-sm border border-rule">
        <iframe
          data-i18n-title="contact.map_title"
          title="<?php echo esc_attr( $c['map_title'] ); ?>"
          src="https://www.google.com/maps?q=<?php echo rawurlencode( $sdn['address'] ); ?>&output=embed"
          width="1200" height="450" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
          class="block h-[20rem] w-full lg:h-[26rem]"
          style="border:0"></iframe>
      </div>
    </div>
  </div>
</section>

<?php
get_footer();