<?php
/**
 * Polestar functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package polestar
 * @license GPL 2.0 
 */

define( 'PURO_THEME_VERSION', '' );
define( 'PURO_THEME_JS_PREFIX', '' );
define( 'PURO_THEME_CSS_PREFIX', '' );

if ( ! function_exists( 'polestar_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function polestar_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Polestar, use a find and replace
	 * to change 'polestar' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'polestar', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Block Editor Wide Alignment.
	 *
	 * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#wide-alignment
	 */
	add_theme_support( 'align-wide' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// Custom image sizes.
	add_image_size( 'polestar-247x164-crop', 247, 163, true );
	add_image_size( 'polestar-354x234-crop', 354, 234, true );
	add_image_size( 'polestar-720x480-crop', 720, 480, true );

	/*
	 * Enable support for the custom logo.
	 */
	add_theme_support( 'custom-logo' );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Header Menu', 'polestar' ),
		'menu-2' => esc_html__( 'Footer Menu', 'polestar' )
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * @link https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'gallery',
		'image',
		'video',
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'polestar_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

	/*
	 * Enable support for Gutenberg Editor Styles.
	 * https://wordpress.org/gutenberg/handbook/extensibility/theme-support/#editor-styles
	 */
	add_theme_support( 'editor-styles' );

	// Disable WP 5.8+ Widget Area.
	if ( apply_filters( 'polestar_disable_new_widget_area', true ) ) {
		remove_theme_support( 'widgets-block-editor' );
	}

}
endif;
// polestar_setup
add_action( 'after_setup_theme', 'polestar_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function polestar_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'polestar_content_width', 1140 );
}
add_action( 'after_setup_theme', 'polestar_content_width', 0 );

/**
 * Add the viewport tag.
 */
function polestar_viewport_tag() { ?>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<?php }
add_action( 'wp_head', 'polestar_viewport_tag' );

/**
 * Register widget areas.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function polestar_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'polestar' ),
		'id'            => 'sidebar-main',
		'description'   => esc_html__( 'Displays on posts and pages that use the default template.', 'polestar' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'polestar' ),
		'id'            => 'sidebar-footer',
		'description'   => esc_html__( 'A column will be automatically assigned to each widget inserted.', 'polestar' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	if ( function_exists( 'is_woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'polestar' ),
			'id'            => 'sidebar-shop',
			'description'   => esc_html__( 'Displays on WooCommerce pages.', 'polestar' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
	}
}
add_action( 'widgets_init', 'polestar_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function polestar_scripts() {

	// Theme stylesheet.
	wp_enqueue_style( 'polestar-style', get_template_directory_uri() . '/style' . PURO_THEME_CSS_PREFIX . '.css', array(), PURO_THEME_VERSION );

	// FitVids.
	wp_enqueue_script( 'jquery-fitvids', get_template_directory_uri() . '/js/jquery.fitvids' . PURO_THEME_JS_PREFIX . '.js', array( 'jquery' ), '1.1', true );

	// Flexslider.
	wp_register_script( 'jquery-flexslider', get_template_directory_uri() . '/js/jquery.flexslider' . PURO_THEME_JS_PREFIX . '.js', array( 'jquery' ), '2.6.3', true );

	if ( is_home() && polestar_has_featured_posts() ) {
		wp_enqueue_script( 'jquery-flexslider' );
	}

	// Theme JavaScript.
	wp_enqueue_script( 'polestar-script', get_template_directory_uri() . '/js/jquery.theme' . PURO_THEME_JS_PREFIX . '.js', array( 'jquery' ), PURO_THEME_VERSION, true );

	// Mobile Menu Collapse and Sticky Logo Scaling localisation.
	$logo_sticky_scale = apply_filters( 'polestar_logo_sticky_scale', 0.775 );
	wp_localize_script( 'polestar-script', 'polestar', array(
		'collapse' => get_theme_mod( 'mobile_menu_collapse', 768 ),
		'logoScale' => is_numeric( $logo_sticky_scale ) ? $logo_sticky_scale : 0.775,
	) );

	// Theme icons.
	wp_enqueue_style( 'polestar-icons', get_template_directory_uri() . '/css/polestar-icons' . PURO_THEME_CSS_PREFIX . '.css', array(), PURO_THEME_VERSION );

	// Comment reply.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// Skip link focus fix.
	wp_enqueue_script( 'polestar-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix' . PURO_THEME_JS_PREFIX . '.js', array(), PURO_THEME_VERSION, true );

}
add_action( 'wp_enqueue_scripts', 'polestar_scripts' );

/**
 * Enqueue FlexSlider.
 */
function polestar_enqueue_flexslider() {
	wp_enqueue_script( 'jquery-flexslider' );
}

/**
 * Enqueue Block Editor styles.
 */
function polestar_block_editor_styles() {
	wp_enqueue_style( 'polestar-block-editor-styles', get_template_directory_uri() . '/style-editor' . PURO_THEME_CSS_PREFIX . '.css', PURO_THEME_VERSION );
}
add_action( 'enqueue_block_editor_assets', 'polestar_block_editor_styles' );

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer-library/customizer-library.php';
require get_template_directory() . '/inc/customizer-options.php';
require get_template_directory() . '/inc/styles.php';
require get_template_directory() . '/inc/mods.php';

/**
 * Puro Extras.
 */
require get_template_directory() . '/inc/extras/extras.php';
require get_template_directory() . '/inc/extras-options.php';

/**
 * Recommended plugins.
 */
require get_template_directory() . '/inc/recommended-plugins.php';

/**
 * Custom template tags.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Jetpack compatibility.
 */
if ( class_exists( 'Jetpack' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Page Builder by SiteOrigin compatibility.
 */
if ( defined( 'SITEORIGIN_PANELS_VERSION' ) ) {
	require get_template_directory() . '/inc/siteorigin-panels.php';
}

/**
 * Deprecated functions.
 */
require get_template_directory() . '/inc/deprecated.php';

/**
 * WooCommerce compatibility.
 */
if ( function_exists( 'is_woocommerce' ) ) {
	require get_template_directory() . '/woocommerce/functions.php';
}

/* IMPORTANT NOTICE: Please don't edit this file; any changes made here will be lost during the theme update process. 
If you need to add custom functions, use the Code Snippets plugin (https://wordpress.org/plugins/code-snippets/) or a child theme. */
