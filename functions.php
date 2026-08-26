<?php
/**
 * Soluciones del Norte — tema custom
 * 828 Marketing Solutions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Versión basada en la fecha del archivo: el caché se invalida solo
 * en cada build, sin tocar números de versión a mano.
 */
function sdn_asset_version( $relative_path ) {
	$file = get_theme_file_path( $relative_path );
	return file_exists( $file ) ? (string) filemtime( $file ) : '1.0';
}

function sdn_load_assets() {
	// Space Grotesk (display) · IBM Plex Sans (cuerpo) · IBM Plex Mono (cifras)
	wp_enqueue_style(
		'sdn-fonts',
		'https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@300;400;500&family=IBM+Plex+Sans:wght@400;500;600&family=Space+Grotesk:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style(
		'sdn-main',
		get_theme_file_uri( '/build/index.css' ),
		array( 'sdn-fonts' ),
		sdn_asset_version( '/build/index.css' )
	);

	// Fondo animado del hero. El script se descarga desde
	// finisher.co/lab/header y se deja en /assets/. Si no está, el hero
	// usa la reserva en CSS: no hay error ni hueco.
	$sdn_deps     = array( 'wp-element', 'react-jsx-runtime' );
	$sdn_finisher = '/assets/finisher-header.es5.min.js';

	if ( file_exists( get_theme_file_path( $sdn_finisher ) ) ) {
		wp_enqueue_script(
			'sdn-finisher',
			get_theme_file_uri( $sdn_finisher ),
			array(),
			sdn_asset_version( $sdn_finisher ),
			true
		);

		// El bundle se carga después: al inicializar, FinisherHeader ya existe.
		$sdn_deps[] = 'sdn-finisher';
	}

	wp_enqueue_script(
		'sdn-main',
		get_theme_file_uri( '/build/index.js' ),
		$sdn_deps,
		sdn_asset_version( '/build/index.js' ),
		true
	);

	// Configuración del front-end. Las tres claves de EmailJS son públicas
	// por diseño, pero viven en wp-config.php para no quedar escritas en el
	// bundle ni en el repositorio.
	$sdn = sdn_site_data();

	wp_localize_script(
		'sdn-main',
		'sdnConfig',
		array(
			'emailjs' => array(
				'publicKey'  => defined( 'SDN_EMAILJS_PUBLIC_KEY' ) ? SDN_EMAILJS_PUBLIC_KEY : '',
				'serviceId'  => defined( 'SDN_EMAILJS_SERVICE_ID' ) ? SDN_EMAILJS_SERVICE_ID : '',
				'templateId' => defined( 'SDN_EMAILJS_TEMPLATE_ID' ) ? SDN_EMAILJS_TEMPLATE_ID : '',
			),
			'phone'   => $sdn['phone1'],
			'email'   => $sdn['email'],
			'lang'    => $sdn['lang'],
		)
	);
}
add_action( 'wp_enqueue_scripts', 'sdn_load_assets' );

function sdn_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.gstatic.com', 'crossorigin' );
	}
	return $urls;
}
add_filter( 'wp_resource_hints', 'sdn_resource_hints', 10, 2 );

function sdn_add_support() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'responsive-embeds' );
}
add_action( 'after_setup_theme', 'sdn_add_support' );

/**
 * Datos de contacto y marca en un solo lugar.
 * El Navbar, el Footer y el ContactForm los reciben desde aquí, así que
 * cambiar un teléfono no obliga a reconstruir el bundle de JS.
 */
function sdn_site_data() {
	$address = '1915 NE Stucki Ave, Suite 400, Hillsboro, OR 97006';

	return array(
		'home'          => home_url( '/' ),
		// TODO: el archivo de la biblioteca tiene el nombre mal escrito ("dle").
		'logo'          => content_url( '/uploads/2026/08/soluciones-dle-norte-horizontal.png' ),
		'logo_white'    => content_url( '/uploads/2026/08/logo-blanco.png' ),
		'phone1'        => '971-477-8337',
		'phone2'        => '971-471-2600',
		'email'         => 'Admin@solucionesnorte.com',
		'address'       => $address,
		'address_short' => 'Hillsboro, OR',
		'map_url'       => 'https://maps.google.com/?q=' . rawurlencode( $address ),
		'facebook'      => 'https://facebook.com/solucionesdelnorte',
		'instagram'     => 'https://instagram.com/solucionesdelnorte',
		'tiktok'        => 'https://tiktok.com/@solucionesdelnorte',
		'agency_url'    => 'https://828marketingsolutions.com',
		'lang'          => sdn_current_lang(),
	);
}

/**
 * Idioma de la vista actual.
 * Provisional: lee el prefijo /en de la URL. Cuando se instale el plugin
 * de multilenguaje (Pendiente 01) esto pasa a `pll_current_language()`
 * o al equivalente de WPML y se borra la lectura del path.
 */
function sdn_current_lang() {
	if ( function_exists( 'pll_current_language' ) ) {
		return pll_current_language() === 'en' ? 'en' : 'es';
	}

	$path = trim( wp_parse_url( add_query_arg( array() ), PHP_URL_PATH ), '/' );
	return ( 'en' === $path || 0 === strpos( $path, 'en/' ) ) ? 'en' : 'es';
}

/**
 * Canonical propia. El sitio anterior apuntaba a un dominio ajeno;
 * esto lo corrige desde el primer despliegue.
 */
function sdn_canonical_url() {
	if ( is_singular() ) {
		return get_permalink();
	}
	if ( is_front_page() ) {
		return home_url( '/' );
	}
	return home_url( add_query_arg( array() ) );
}

/**
 * Rutas por idioma en un solo lugar. El Chatbot y el ContactForm las
 * reciben ya resueltas, así que no repiten el prefijo /en en JS.
 */
function sdn_route( $key ) {
	$routes = array(
		'es' => array(
			'home'     => '/',
			'services' => '/servicios',
			'about'    => '/nosotros',
			'contact'  => '/contacto',
			'privacy'  => '/aviso-de-privacidad',
		),
		'en' => array(
			'home'     => '/en',
			'services' => '/en/services',
			'about'    => '/en/about',
			'contact'  => '/en/contact',
			'privacy'  => '/en/privacy',
		),
	);

	$lang = sdn_current_lang();
	$path = isset( $routes[ $lang ][ $key ] ) ? $routes[ $lang ][ $key ] : '/';

	return home_url( $path );
}

/**
 * Los siete servicios: nombre, línea de alcance y ruta, en el idioma
 * de la vista actual. El orden del array es el orden del índice.
 *
 * Vive aquí y no en cada plantilla por la misma razón que sdn_site_data():
 * es infraestructura compartida, no copy. El hub lo usa para pintar el
 * índice y cada página de servicio para la fila de "los otros seis".
 * Renombrar un servicio o mover una ruta se hace una vez, no nueve.
 *
 * El copy propio de cada página —H1, deck, las cuatro etapas— sigue
 * viviendo dentro de su plantilla, que es lo que la hace autocontenida.
 *
 * Las claves son estables y no se traducen: las plantillas las usan
 * para excluirse a sí mismas de la fila de cierre.
 */
function sdn_services() {
	$es = array(
		'payroll'           => array(
			'name' => 'Nómina',
			'desc' => 'Cálculo, pagos y retenciones en el ciclo que ya usas: semanal, quincenal o mensual.',
			'path' => '/servicios/nomina',
		),
		'certified-payroll' => array(
			'name' => 'Nómina certificada',
			'desc' => 'Reportes semanales para contratos estatales y municipales.',
			'path' => '/servicios/nomina-certificada',
		),
		'bookkeeping'       => array(
			'name' => 'Contabilidad',
			'desc' => 'Libros al día y un reporte mensual que puedes leer sin traductor.',
			'path' => '/servicios/contabilidad',
		),
		'taxes'             => array(
			'name' => 'Impuestos',
			'desc' => 'Preparación personal y de negocio, con las fechas marcadas por adelantado.',
			'path' => '/servicios/impuestos',
		),
		'notary'            => array(
			'name' => 'Notaría y documentos',
			'desc' => 'Certificación de documentos legales en la oficina de Hillsboro.',
			'path' => '/servicios/notaria',
		),
		'time-attendance'   => array(
			'name' => 'Tiempo y asistencia',
			'desc' => 'Horas y asistencia ordenadas antes de que lleguen a la nómina.',
			'path' => '/servicios/tiempo-y-asistencia',
		),
		'payroll-audits'    => array(
			'name' => 'Auditorías de nómina',
			'desc' => 'Revisión de registros y procesos cuando algo no cuadra.',
			'path' => '/servicios/auditorias-de-nomina',
		),
	);

	$en = array(
		'payroll'           => array(
			'name' => 'Payroll',
			'desc' => 'Calculation, payments and withholdings on the cycle you already use: weekly, biweekly or monthly.',
			'path' => '/en/services/payroll',
		),
		'certified-payroll' => array(
			'name' => 'Certified payroll',
			'desc' => 'Weekly reports for state and city contracts.',
			'path' => '/en/services/certified-payroll',
		),
		'bookkeeping'       => array(
			'name' => 'Bookkeeping',
			'desc' => 'Books kept current and a monthly report you can read without a translator.',
			'path' => '/en/services/bookkeeping',
		),
		'taxes'             => array(
			'name' => 'Taxes',
			'desc' => 'Personal and business preparation, with deadlines flagged in advance.',
			'path' => '/en/services/taxes',
		),
		'notary'            => array(
			'name' => 'Notary and documents',
			'desc' => 'Certification of legal documents at the Hillsboro office.',
			'path' => '/en/services/notary',
		),
		'time-attendance'   => array(
			'name' => 'Time and attendance',
			'desc' => 'Hours and attendance sorted before they hit payroll.',
			'path' => '/en/services/time-attendance',
		),
		'payroll-audits'    => array(
			'name' => 'Payroll audits',
			'desc' => 'Review of records and processes when something doesn’t add up.',
			'path' => '/en/services/payroll-audits',
		),
	);

	return ( 'en' === sdn_current_lang() ) ? $en : $es;
}