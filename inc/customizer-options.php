<?php
/**
 * Defines Customizer options.
 *
 * @package polestar
 * @license GPL 2.0 
 */

function polestar_theme_options() {

	// Stores all the controls that will be added.
	$options = array();

	// Stores all the sections to be added.
	$sections = array();

	// Stores all the panels to be added.
	$panels = array();

	// Adds the sections to the $options array.
	$options['sections'] = $sections;

	// Theme Settings.
	$panel = 'theme_settings';

	$panels[] = array(
	    'id' => $panel,
	    'title' => esc_html__( 'Theme Settings', 'polestar' ),
	    'priority' => '10'
	);

	// Branding.
	$section = 'header';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Header', 'polestar' ),
	    'priority' => '10',
	    'panel' => $panel
	);	

	$options['logo'] = array(
		'id' => 'logo',
		'label' => esc_html__( 'Logo', 'polestar' ),
		'section' => $section,
		'type' => 'media',
		'description' => esc_html__( 'A custom logo to be displayed instead of the site title.', 'polestar' ),
		'default' => '',
		'mime_type' => 'image',
	);

	$options['tagline'] = array(
	    'id' => 'tagline',
	    'label' => esc_html__( 'Tagline', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the website tagline below the logo or site title.', 'polestar' ),
	    'default' => false,
	);

	$options['header_layout'] = array(
	    'id' => 'header_layout',
	    'label' => esc_html__( 'Header Layout', 'polestar' ),
	    'section' => $section,
	    'type' => 'select',
	    'choices' => array(
    		'default' => 'Default',
    		'centered' => 'Centered',
		),
	    'description' => esc_html__( 'Choose the header layout.', 'polestar' ),
	    'default' => 'default',
	);	

	$options['sticky_header'] = array(
	    'id' => 'sticky_header',
	    'label' => esc_html__( 'Sticky Header', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Sticks the header to the top of the screen as the user scrolls down.', 'polestar' ),
	    'default' => true,
	);

	$options['sticky_header_scaling'] = array(
	    'id' => 'sticky_header_scaling',
	    'label' => esc_html__( 'Sticky Header Scales Logo', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Scales the logo down as the header becomes sticky.', 'polestar' ),
	    'default' => false,
	);	

	// Navigation.
	$section = 'navigation';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Navigation', 'polestar' ),
	    'priority' => '20',
	    'panel' => $panel
	);

	$options['header_menu'] = array(
	    'id' => 'header_menu',
	    'label' => esc_html__( 'Header Menu', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the main menu in the header.', 'polestar' ),
	    'default' => true,
	);

	$options['mobile_menu'] = array(
	    'id' => 'mobile_menu',
	    'label' => esc_html__( 'Mobile Menu', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Use a mobile menu for small screen devices.', 'polestar' ),
	    'default' => true,
	);			

	$options['menu_search'] = array(
	    'id' => 'menu_search',
	    'label' => esc_html__( 'Menu Search', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display a search icon in the main menu.', 'polestar' ),
	    'default' => true,
	);		

	$options['post_navigation'] = array(
	    'id' => 'post_navigation',
	    'label' => esc_html__( 'Post Navigation', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the next/previous post navigation.', 'polestar' ),
	    'default' => true,
	);		


	$options['scroll_to_top'] = array(
	    'id' => 'scroll_to_top',
	    'label' => esc_html__( 'Scroll to Top', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the scroll to top button.', 'polestar' ),
	    'default' => true,
	);		

	// Blog.
	$section = 'blog';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Blog', 'polestar' ),
	    'priority' => '30',
	    'panel' => $panel
	);

	$options['archive_featured_image'] = array(
	    'id' => 'archive_featured_image',
	    'label' => esc_html__( 'Archive Featured Image', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the featured image on the archive and single post pages.', 'polestar' ),
	    'default' => true,
	);

	$options['post_featured_image'] = array(
	    'id' => 'post_featured_image',
	    'label' => esc_html__( 'Post Featured Image', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the featured image on the single post page.', 'polestar' ),
	    'default' => true,
	);		

	$options['post_categories'] = array(
	    'id' => 'post_categories',
	    'label' => esc_html__( 'Post Categories', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the post categories on the archive and single post pages.', 'polestar' ),
	    'default' => true,
	);		

	// Footer.
	$section = 'footer';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Footer', 'polestar' ),
	    'priority' => '40',
	    'panel' => $panel
	);

	$options['footer_text'] = array(
	    'id' => 'footer_text',
	    'label' => esc_html__( 'Footer Text', 'polestar' ),
	    'section' => $section,
	    'type' => 'text',
	    'description' => esc_html__( '{sitename} and {year} can be used to display your website title and the current year.', 'polestar' ),
	    'default' => esc_html__( 'Copyright &copy; {year} {sitename}', 'polestar' )
	);	

	// Adds the sections to the $options array.
	$options['sections'] = $sections;

	// Adds the panels to the $options array.
	$options['panels'] = $panels;

	// Adds a hook that can be used by child themes or plugins.
	$options = apply_filters( 'polestar_additional_options', $options );

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

}
add_action( 'init', 'polestar_theme_options' );
