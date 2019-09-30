<?php
/**
 * Options for Puro's Extras framework.
 *
 * @package polestar
 * @license GPL 2.0 
 */

/**
 * Page Settings options.
 *
 * @package polestar
 * @license GPL 2.0 
 */

/**
 * Setup Page Settings.
 */
function polestar_page_settings( $settings, $type, $id ) {

	$settings['layout'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Page Layout', 'polestar' ),
		'options' => array(
			'default'               => esc_html__( 'Default', 'polestar' ),
			'no-sidebar'            => esc_html__( 'No Sidebar', 'polestar' ),
			'full-width-no-sidebar' => esc_html__( 'Full Width, No Sidebar', 'polestar' ),
			'constrained'           => esc_html__( 'Constrained', 'polestar' ),
			'stripped'              => esc_html__( 'Stripped', 'polestar' ),
		),
	);

	$settings['overlap'] = array(
		'type'    => 'select',
		'label'   => esc_html__( 'Header Overlap', 'polestar' ),
		'options' => array(
			'disabled' => esc_html__( 'Disabled', 'polestar' ),
			'enabled'  => esc_html__( 'Enabled', 'polestar' ),
			'light'    => esc_html__( 'Enabled - Light Text', 'polestar' ),
			'dark'     => esc_html__( 'Enabled - Dark Text', 'polestar' ),
		),
	);

	$settings['header_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Header Bottom Margin', 'polestar' ),
		'checkbox_label' => esc_html__( 'Enable', 'polestar' ),
		'description'    => esc_html__( 'Display the margin below the header.', 'polestar' )
	);

	$settings['page_title'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Page Title', 'polestar' ),
		'checkbox_label' => esc_html__( 'Enable', 'polestar' ),
		'description'    => esc_html__( 'Display the page title.', 'polestar' )
	);

	$settings['footer_margin'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Top Margin', 'polestar' ),
		'checkbox_label' => esc_html__( 'Enable', 'polestar' ),
		'description'    => esc_html__( 'Display the margin above the footer.', 'polestar' )
	);

	$settings['footer_widgets'] = array(
		'type'           => 'checkbox',
		'label'          => esc_html__( 'Footer Widgets', 'polestar' ),
		'checkbox_label' => esc_html__( 'Enable', 'polestar' ),
		'description'    => esc_html__( 'Display the footer widgets.', 'polestar' )
	);

	return $settings;
}
add_action( 'puro_page_settings', 'polestar_page_settings', 10, 3 );

/**
 * Add the defaults.
 */
function polestar_setup_page_setting_defaults( $defaults, $type, $id ) {
	$defaults['layout']         = 'default';
	$defaults['overlap']        = 'disabled';
	$defaults['page_title']     = true;
	$defaults['header_margin']  = true;
	$defaults['footer_margin']  = true;
	$defaults['footer_widgets'] = true;

	return $defaults;
}
add_filter( 'puro_page_settings_defaults', 'polestar_setup_page_setting_defaults', 10, 3 );

/**
 * Adds the theme about page options.
 */
function polestar_about_page( $about ) {

	$about['documentation_url'] = 'https://purothemes.com/documentation/polestar-wordpress-theme/';

	$about['premium_url'] = 'https://purothemes.com/themes/polestar/';

	$about['review'] = true;

	$about['no_video'] = true;

	$about['video_url'] = 'https://purothemes.com/themes/polestar/';

	$about['description'] = esc_html__( 'Lead the way with Polestar. It\'s fast loading, responsive, lightweight and flexible design is perfectly suited for building dynamic pages with SiteOrigin\'s Page Builder and selling with WooCommerce.', 'polestar' );

	$about['sections'] = array(
		'customize',
		'woocommerce',
		'page-builder',
		'support',
		'github',
	);

	return $about;
}
add_filter( 'puro_about_page', 'polestar_about_page' );
