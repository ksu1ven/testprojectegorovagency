<?php

use Harbinger_Marketing\PDF_Generator;
use Harbinger_Marketing\Instagram_Media;
use Harbinger_Marketing\Modal_Action;
use Harbinger_Marketing\GetFile;
require_once('lib/classes/Modal_Action.php');

add_action( 'acf/init', 'hm_enqueue_assets' );
function hm_enqueue_assets() {
	if ( is_admin() ) {
		# Admin assets
		hm_admin_styles();
	} else {
		# Front-end assets
		hm_frontend_assets();
	}

	remove_action( 'wp_enqueue_scripts', 'wp_enqueue_global_styles' );
}

function hm_admin_styles(): void {
	$template_dir = get_template_directory_uri();

	wp_enqueue_style( THEME_TEXTDOMAIN . '-admin', $template_dir . '/resources/css/admin-styles.css' );
}

function hm_frontend_assets(): void {
	$template_dir = get_template_directory_uri();

	# Enqueue Custom CSS files
	wp_enqueue_style( THEME_TEXTDOMAIN . '-bundle', $template_dir . hm_assets_bundle( 'css/bundle.css' ) );

	# The theme style.css file may contain overrides for the bundled styles
	wp_enqueue_style( THEME_TEXTDOMAIN . '-styles', $template_dir . '/style.css' );
}

# Enqueue JS and CSS assets on the front-end
add_action( 'wp_enqueue_scripts', 'hm_front_enqueue_assets' );
function hm_front_enqueue_assets() {
	$template_dir = get_template_directory_uri();
	$google_api_key = hm_get_google_maps_api_key();

	# Enqueue Custom JS files
	wp_enqueue_script( THEME_TEXTDOMAIN . '-lottie', $template_dir . '/resources/js/lottie-player.js', ['jquery'], false, true );
	wp_enqueue_script( THEME_TEXTDOMAIN . '-preloader', $template_dir . '/resources/js/preloader.js', [], false, true );
	wp_enqueue_script( THEME_TEXTDOMAIN . '-vendor', $template_dir . hm_assets_bundle( 'js/vendor.js' ), array( 'jquery' ), null, true );
	wp_enqueue_script( THEME_TEXTDOMAIN . '-bundle', $template_dir . hm_assets_bundle( 'js/main.js' ), [], null, true );

	wp_localize_script( THEME_TEXTDOMAIN . '-bundle', 'hm_global', [
		'ajax_url' => admin_url( 'admin-ajax.php' ),
		'ajaxurl' => '/wp-json/api/',
	] );

	if ( is_front_page() ) {
		wp_dequeue_style( 'wp-block-library' );
		wp_dequeue_style( 'wp-block-library-theme' );
		wp_dequeue_style( 'wc-block-style' );
	}

	# Enqueue Comments JS file
	if ( is_singular() ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

# Enqueue JS and CSS assets on admin pages
add_action( 'admin_enqueue_scripts', 'hm_admin_enqueue_scripts' );
function hm_admin_enqueue_scripts() {
	$template_dir = get_template_directory_uri();

	if ( hm_is_gutenberg_editor() ) {
		$google_api_key = hm_get_google_maps_api_key();

		wp_enqueue_script( THEME_TEXTDOMAIN . '-google-map', 'https://maps.googleapis.com/maps/api/js?key='. $google_api_key. '&callback=initMap&language=en', [], false, true );
		wp_enqueue_script( THEME_TEXTDOMAIN . '-vendor', $template_dir . hm_assets_bundle( 'js/vendor.js' ), ['jquery', 'acf'], null, true );
		wp_enqueue_style( THEME_TEXTDOMAIN . '-admin-css-bundle', $template_dir . '/dist/css/admin-styles.css' );
		wp_enqueue_script( THEME_TEXTDOMAIN . '-admin-js-bundle', $template_dir . '/resources/js/admin.js', ['jquery'], null, true );
	}
}

add_action( 'after_setup_theme', 'hm_load_theme_dependencies' );
function hm_load_theme_dependencies() {
	# Add theme constants
	require_once('config/constants.php');

	# Autoload dependencies
	$autoload_dir = THEME_DIR . 'vendor/autoload.php';
	if ( ! is_readable( $autoload_dir ) ) {
		wp_die( __( 'Please, run <code>composer install</code> to download and install the theme dependencies.', THEME_TEXTDOMAIN ) );
	}
	include_once( $autoload_dir );

	# Imagic extension check
	if ( ! extension_loaded( 'imagick' ) ) {
		wp_die( __( '<strong>Imagick</strong> needs to be installed for this theme to function properly.', THEME_TEXTDOMAIN ) );
	}

	$getter = new GetFile( THEME_DIST_PATH );

	# Add helper libs
	require_once( 'lib/helpers/generic.php' );
	require_once( 'lib/helpers/geolocation.php' );
	require_once( 'lib/helpers/media.php' );
	require_once( 'lib/helpers/svg.php' );
	require_once( 'lib/helpers/image.php' );
	require_once( 'lib/helpers/video.php' );
	require_once( 'lib/helpers/wp.php' );
	require_once( 'lib/helpers/admin.php' );
	require_once( 'lib/helpers/body.php' );
	require_once( 'lib/helpers/favicon.php' );
	require_once( 'lib/helpers/header-search.php' );
	require_once( 'lib/filters.php' );
	require_once( 'lib/blocks.php' );
	require_once( 'lib/branding.php' );
	require_once( 'lib/post-types.php' );
	require_once( 'lib/taxonomies.php' );
	require_once( 'lib/shortcodes.php' );
	require_once( 'lib/emails/emails.php' );
	require_once( 'lib/menus/menus.php' );
	require_once( 'lib/acf.php' );
	require_once( 'lib/disable-comments.php' );
	require_once( 'lib/routes.php' );
	require_once( 'config/constants-dependent.php' );

	# Load text domain
	load_theme_textdomain( THEME_TEXTDOMAIN, get_stylesheet_directory() . '/languages' );

	# Replace favicon
	add_action( 'wp_head', 'hm_replace_favicon' );
	add_action( 'admin_head', 'hm_replace_favicon' );
	function hm_replace_favicon() {
		$favicon_path = get_template_directory_uri() . '/resources/images/favicons/favicon.ico';

		echo '<link rel="shortcut icon" href="' . esc_url( $favicon_path ) . '" />';
	}

	# Add theme support
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'menus' );
	add_theme_support( 'html5', array( 'gallery' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'wp-block-styles' );
	add_post_type_support( 'page', 'excerpt' );

	# Add custom image sizes
	require_once('lib/image-sizes.php');

	# Add SVG support
	add_filter( 'upload_mimes', 'hm_mime_types' );
	function hm_mime_types( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	add_filter( 'wp_check_filetype_and_ext', 'hm_check_filetype', 10, 4 );
	function hm_check_filetype( $data, $file, $filename, $mimes ) {
		$filetype = wp_check_filetype( $filename, $mimes );
		return [
			'ext'       => $filetype['ext'],
			'type'      => $filetype['type'],
			'proper_filename' => $data['proper_filename']
		];
	}

	add_filter( 'wp_prepare_attachment_for_js', function( $response ) {
		if ( $response['mime'] === 'image/svg+xml') {
			$response['sizes'][ 'full' ] = array(
				'orientation' => 'portrait',
				'url'     => $response['url'],
				'width'    => 0,
				'height'   => 0,
			);
		}
		return $response;
	} );

	add_filter( 'image_downsize', 'hm_fix_svg_size_attributes', 10, 2 );
	function hm_fix_svg_size_attributes( $out, $id ) {
		$image_url = wp_get_attachment_url( $id );
		$file_ext  = pathinfo( $image_url, PATHINFO_EXTENSION );
		if ( 'svg' !== $file_ext ) {
			return false;
		}
		return array( $image_url, null, null, false );
	}

	# Excerpt settings
	add_filter( 'excerpt_more', '__return_false' );
	add_filter( 'excerpt_length', function() {
		return 8;
	});

	# Init classes
	PDF_Generator::init();

	if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
		$feed_enabled      = get_field( 'instagram_enabled', 'option' );
		$feed_app_id       = get_field( 'instagram_app_id', 'option' );
		$feed_secret       = get_field( 'instagram_app_secret', 'option' );
		$feed_access_token = get_field( 'instagram_access_token', 'option' );

		if ( $feed_enabled ) {
			Instagram_Media::init($feed_app_id, $feed_secret, $feed_access_token);
		}
	}

	# Registration of modal popups
	define( 'MODAL_VIDEO', 'modals-video' );
	define( 'MODAL_SUCCESS', 'modal-success' );
	define( 'MODAL_REQUEST_QUOTE', 'modals-request-quote' );

	Modal_Action::register_modal_action( MODAL_VIDEO, __( 'Modal Video', THEME_TEXTDOMAIN ), function () {
		get_template_part( 'template-parts/modals/modals-video' );
	} );

	Modal_Action::register_modal_action( MODAL_SUCCESS, __( 'Modal Success', THEME_TEXTDOMAIN ), function () {
		get_template_part( 'template-parts/modals/modal-success' );
	} );

	Modal_Action::add_modal_action_to_render_list( MODAL_SUCCESS );

	Modal_Action::register_modal_action( MODAL_REQUEST_QUOTE, __( 'Modal Request A Quote', THEME_TEXTDOMAIN ), function () {
		get_template_part( 'template-parts/modals/modals-quote' );
	} );

	Modal_Action::add_modal_action_to_render_list( MODAL_REQUEST_QUOTE );
}

add_action( 'init', 'hm_register_menus', 999 );
function hm_register_menus() {
	$menus = array(
		'main-menu'             => __( 'Main Menu', THEME_TEXTDOMAIN ),
		'header-menu'           => __( 'Header Menu', THEME_TEXTDOMAIN ),
		'footer-menu-primary'   => __( 'Primary Footer Menu', THEME_TEXTDOMAIN ),
		'footer-menu-secondary' => __( 'Secondary Footer Menu', THEME_TEXTDOMAIN ),
	);

	# Register Theme Menu Locations
	register_nav_menus( $menus );
}

/**
 * Helper function to check is the current page using Gutenberg Editor
 *
 * @return bool
 */
function hm_is_gutenberg_editor() {
	if ( function_exists( 'is_gutenberg_page' ) && is_gutenberg_page() ) {
		return true;
	}

	$current_screen = get_current_screen();

	if ( method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor() ) {
		return true;
	}

	return false;
}

/**
 * Get the path to a versioned bundle relative to the theme directory.
 *
 * @param  string $path
 * @return string
 */
function hm_assets_bundle( $path ) {
	static $manifest = null;

	if ( is_null( $manifest ) ) {
		$manifest_path = THEME_DIR . 'dist/manifest.json';

		if ( file_exists( $manifest_path ) ) {
			$manifest = json_decode( file_get_contents( $manifest_path ), true );
		} else {
			$manifest = array();
		}
	}

	$path = isset( $manifest[ $path ] ) ? $manifest[ $path ] : $path;

	return '/dist/' . $path;
}

add_action( 'wp_head', 'hm_include_meta_tags' );
function hm_include_meta_tags() {
	$favicons = hm_get_favicons();

	ob_start();
	?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
	<meta name="HandheldFriendly" content="true" />
	<meta name="format-detection" content="telephone=no" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="application-name" content="<?php bloginfo( 'name' ); ?>"/>
	<meta name="msapplication-TileColor" content="<?php echo THEME_BRAND_COLOR_MAIN ?>" />

	<?php foreach ( $favicons as $file_name => $favicon ) :
		// Output apple touch icon and favicon rel="icon" link tags
		if ( $favicon['html_tag'] && in_array( $favicon['html_tag']['type'], array( 'link', 'favicon' ) ) ) : ?>
			<link
				rel="<?php echo esc_attr( $favicon['html_tag']['name'] ); ?>"
				<?php echo ( $favicon['html_tag']['type'] === 'favicon' ) ? 'type="image/png"' : ''; ?>
				href="<?php bloginfo( 'stylesheet_directory' ); ?>/resources/images/favicons/<?php echo esc_attr( $file_name ); ?>"
				sizes="<?php echo sprintf( '%sx%s', $favicon['width'], $favicon['height'] ); ?>"
			/>
		<?php endif;

		// Output msapplication meta tags
		if ( $favicon['html_tag'] && $favicon['html_tag']['type'] === 'meta' ) : ?>
			<meta
				name="<?php echo esc_attr( $favicon['html_tag']['name'] ); ?>"
				content="<?php bloginfo( 'stylesheet_directory' ); ?>/resources/images/favicons/<?php echo esc_attr( $file_name ); ?>"
			/>
		<?php endif;
	endforeach;

	if ( @file_get_contents( get_bloginfo( 'template_directory' ) . '/resources/lottie/preloader.json' ) ) : ?>
		<link rel="preload" href="<?php bloginfo('template_directory'); ?>/resources/lottie/preloader.json" as="fetch" crossOrigin="anonymous">
	<?php endif;

	echo ob_get_clean();
}
