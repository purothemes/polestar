<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package polestar
 * @license GPL 2.0 
 */

if ( ! is_active_sidebar( 'sidebar-main' ) ) return;
if ( is_page() && puro_page_setting( 'layout' ) != 'default' ) return;
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'sidebar-main' ); ?>
</aside><!-- #secondary -->
