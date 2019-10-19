<?php
/**
 * Compatibility with Page Builder by SiteOrigin.
 *
 * @link https://wordpress.org/plugins/siteorigin-panels/
 *
 * @package polestar
 * @license GPL 2.0
 */

/**
 * Register a custom layouts folder location.
 */
function polestar_layouts_folder( $layout_folders ) {
	$layout_folders[] = get_template_directory() . '/inc/layouts';
	return $layout_folders;
}
add_filter( 'siteorigin_panels_local_layouts_directories', 'polestar_layouts_folder' );

/**
 * Remove Post Loop widget templates that aren't complete loops.
 */
function polestar_filter_post_loop_widget( $templates ) {
	$disallowed_template_patterns = array(
		'template-parts/content.php',
		'template-parts/content-gallery.php',
		'template-parts/content-image.php',
		'template-parts/content-none.php',
		'template-parts/content-page.php',
		'template-parts/content-search.php',
		'template-parts/content-single.php',
		'template-parts/content-video.php'
	);
	foreach ( $templates as $template ) {
		if ( in_array( $template, $disallowed_template_patterns ) ) {
			$key = array_search( $template, $templates );
			if ( false !== $key ) {
				unset( $templates[$key] );
			}
		}
	}
	return $templates;
}
add_filter( 'siteorigin_panels_postloop_templates', 'polestar_filter_post_loop_widget', 10, 1 );
