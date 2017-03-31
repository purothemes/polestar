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

	// Header.
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
		'priority' => '10',
	);

	$options['tagline'] = array(
	    'id' => 'tagline',
	    'label' => esc_html__( 'Tagline', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the website tagline below the logo or site title.', 'polestar' ),
	    'default' => false,
	    'priority' => '20'
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
	    'priority' => '30'
	);	

	$options['sticky_header'] = array(
	    'id' => 'sticky_header',
	    'label' => esc_html__( 'Sticky Header', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Sticks the header to the top of the screen as the user scrolls down.', 'polestar' ),
	    'default' => true,
	    'priority' => '40'
	);

	$options['sticky_header_scaling'] = array(
	    'id' => 'sticky_header_scaling',
	    'label' => esc_html__( 'Sticky Header Scales Logo', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Scales the logo down as the header becomes sticky.', 'polestar' ),
	    'default' => false,
	    'priority' => '50'
	);

	// Colors.
	$section = 'polestar_colors';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Colors', 'polestar' ),
	    'priority' => '15',
	    'panel' => $panel
	);	

	$options['accent_color'] = array(
	    'id' => 'accent_color',
	    'label'   => esc_html__( 'Accent Color', 'polestar' ),
	    'section' => $section,
	    'type'    => 'color',
	    'default' => '#4d8ffb',
	);

	$options['heading_color'] = array(
	    'id' => 'heading_color',
	    'label'   => esc_html__( 'Heading Color', 'polestar' ),
	    'section' => $section,
	    'type'    => 'color',
	    'default' => '#2d2d2d',
	);

	$options['text_color'] = array(
	    'id' => 'text_color',
	    'label'   => esc_html__( 'Text Color', 'polestar' ),
	    'section' => $section,
	    'type'    => 'color',
	    'default' => '#626262',
	);

	// Fonts.
	$section = 'fonts';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Fonts', 'polestar' ),
	    'priority' => '18',
	    'panel' => $panel
	);	

	$options['heading_font'] = array(
		'id' => 'heading_font',
		'label'   => esc_html__( 'Heading Font', 'polestar' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => customizer_library_get_font_choices(),
		'default' => 'Montserrat'
	);	

	$options['body_font'] = array(
		'id' => 'body_font',
		'label'   => esc_html__( 'Body Font', 'polestar' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => customizer_library_get_font_choices(),
		'default' => 'Open Sans'
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
	    'description' => esc_html__( 'Use a mobile menu for small screen devices. Header Menu setting must be enabled.', 'polestar' ),
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

	$options['archive_post_content'] = array(
	    'id' => 'archive_post_content',
	    'label' => esc_html__( 'Archive Post Content', 'polestar' ),
	    'section' => $section,
	    'type' => 'select',
	    'choices' => array(
    		'full' => 'Full Post Content',
    		'excerpt' => 'Post Excerpt',
		),
	    'description' => esc_html__( 'Choose how to display your post content on blog and archive pages. Select Full Post Content if using the "more" quicktag.', 'polestar' ),
	    'default' => 'full',
	);

	$options['read_more_text'] = array(
	    'id' => 'read_more_text',
	    'label'   => esc_html__( 'Read More Text', 'polestar' ),
	    'section' => $section,
	    'type'    => 'text',
	    'description' => esc_html__( 'The link text displayed when posts are split using the "more" quicktag.', 'polestar' ),
	    'default' => esc_html__( 'Continue reading', 'polestar' ),
	);	

	$options['excerpt_length'] = array(
	    'id' => 'excerpt_length',
	    'label'   => esc_html__( 'Excerpt Length', 'polestar' ),
	    'section' => $section,
	    'type'    => 'number',
	    'description' => esc_html__( 'If no manual post excerpt is added one will be generated. How many words should it be?', 'polestar' ),
	    'default' => 55,
	);

	$options['excerpt_more'] = array(
	    'id' => 'excerpt_more',
	    'label' => esc_html__( 'Post Excerpt Read More Link', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the Read More text below the post excerpt.', 'polestar' ),
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

	$options['post_date'] = array(
	    'id' => 'post_date',
	    'label' => esc_html__( 'Post Date', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the post date on the archive and single post pages.', 'polestar' ),
	    'default' => true,
	);		

	$options['post_author'] = array(
	    'id' => 'post_author',
	    'label' => esc_html__( 'Post Author', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the post author on the archive and single post pages.', 'polestar' ),
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

	$options['post_comment_count'] = array(
	    'id' => 'post_comment_count',
	    'label' => esc_html__( 'Post Comment Count', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the post comment count on the archive and single post pages.', 'polestar' ),
	    'default' => true,
	);	

	$options['post_tags'] = array(
	    'id' => 'post_tags',
	    'label' => esc_html__( 'Post Tags', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the post tags on single post pages.', 'polestar' ),
	    'default' => true,
	);	

	$options['post_author_box'] = array(
	    'id' => 'post_author_box',
	    'label' => esc_html__( 'Post Author Box', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display the post author biographical info.', 'polestar' ),
	    'default' => true,
	);

	$options['related_posts'] = array(
	    'id' => 'related_posts',
	    'label' => esc_html__( 'Related Posts', 'polestar' ),
	    'section' => $section,
	    'type' => 'checkbox',
	    'description' => esc_html__( 'Display related posts on the single post page.', 'polestar' ),
	    'default' => true,
	);			

	// Sidebar.
	$section = 'sidebar';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Sidebar', 'polestar' ),
	    'priority' => '40',
	    'panel' => $panel
	);

	$options['sidebar_position'] = array(
	    'id' => 'sidebar_position',
	    'label' => esc_html__( 'Position', 'polestar' ),
	    'section' => $section,
	    'type' => 'select',
	    'choices' => array(
    		'right' => 'Right',
    		'left' => 'Left',
		),
	    'description' => esc_html__( 'Choose the sidebar position.', 'polestar' ),
	    'default' => 'right',
	    'priority' => '10'
	);	

	// Footer.
	$section = 'footer';

	$sections[] = array(
	    'id' => $section,
	    'title' => esc_html__( 'Footer', 'polestar' ),
	    'priority' => '50',
	    'panel' => $panel
	);

	$options['footer_layout'] = array(
	    'id' => 'footer_layout',
	    'label' => esc_html__( 'Footer Layout', 'polestar' ),
	    'section' => $section,
	    'type' => 'select',
	    'choices' => array(
    		'default' => 'Default',
    		'full-width' => 'Full-Width',
		),
	    'description' => esc_html__( 'Choose the footer layout.', 'polestar' ),
	    'default' => 'default',
	);

	$options['footer_text'] = array(
	    'id' => 'footer_text',
	    'label' => esc_html__( 'Footer Text', 'polestar' ),
	    'section' => $section,
	    'type' => 'text',
	    'description' => esc_html__( '{site-title} and {year} can be used to display your website title and the current year.', 'polestar' ),
	    'default' => esc_html__( 'Copyright &copy; {year} {sitename}', 'polestar' )
	);

	// WooCommerce.
	if ( function_exists( 'is_woocommerce' ) ) {
		$section = 'woocommerce';

		$sections[] = array(
		    'id' => $section,
		    'title' => esc_html__( 'WooCommerce', 'polestar' ),
		    'priority' => '60',
		    'panel' => $panel
		);

		$options['woocommerce_sidebar_position'] = array(
		    'id' => 'woocommerce_sidebar_position',
		    'label' => esc_html__( 'Shop Sidebar Position', 'polestar' ),
		    'section' => $section,
		    'type' => 'select',
		    'choices' => array(
	    		'left' => 'Left',
	    		'right' => 'Right',
			),
		    'description' => esc_html__( 'Choose the shop sidebar position.', 'polestar' ),
		    'default' => 'left',
		    'priority' => '10'
		);	
	}	

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
