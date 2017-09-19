<?php
/**
 * The theme header.
 *
 * This is the template that displays all of the <head> section and everything up until <div class="polestar-container">.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package polestar
 * @license GPL 2.0 
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'polestar' ); ?></a>

		<?php if ( class_exists( 'Woocommerce' ) && is_store_notice_showing() ) : ?>
			<div id="topbar">
				<?php polestar_woocommerce_demo_store(); ?>
			</div><!-- #topbar -->
		<?php endif; ?>
		<header id="masthead" class="site-header<?php if ( get_theme_mod( 'header_layout' ) == 'centered' ) echo ' centered'; if ( get_theme_mod( 'sticky_header', true ) ) echo ' sticky'; if ( get_theme_mod( 'mobile_menu', true ) ) echo ' mobile-menu'; ?>" <?php if ( get_theme_mod( 'sticky_header_scaling', true ) ) echo 'data-scale-logo="true"' ?> >

			<div class="polestar-container">
		
				<div class="site-header-inner">
		
					<div class="site-branding">
						<?php polestar_display_logo(); ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">

						<?php if ( puro_page_setting( 'layout' ) !== 'stripped' ) : ?>

							<?php $mega_menu_active = function_exists( 'ubermenu' ) || function_exists( 'max_mega_menu_is_enabled' ) && max_mega_menu_is_enabled( 'menu-1' ); ?>

							<?php if ( get_theme_mod( 'mobile_menu', true ) && ! $mega_menu_active ) : ?>	
								<a href="#menu" id="mobile-menu-button">
									<?php polestar_display_icon( 'menu' ); ?>							
									<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'polestar' ); ?></span>
								</a>
							<?php endif; ?>
						
							<?php if ( get_theme_mod( 'header_menu', true ) ) : ?>
								<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'menu_id' => 'primary-menu' ) ); ?>
							<?php endif; ?>

							<?php if ( get_theme_mod( 'mini_cart', false ) && ! $mega_menu_active ) polestar_mini_cart(); ?>	

							<?php if ( get_theme_mod( 'menu_search', true ) && ! $mega_menu_active ) : ?>
								<a class="search-icon">
									<label class="screen-reader-text"><?php esc_html_e( 'Open search bar', 'polestar' ); ?></label>
									<?php polestar_display_icon( 'search' ); ?>
								</a>
							<?php endif; ?>

						<?php endif; ?>

						<?php if ( puro_page_setting( 'layout' ) == 'stripped' ) : ?>
							<ul>
								<li>
									<a href="" class="stripped-backlink" onclick="window.history.go( -1 ); return false;">
										<?php esc_html_e( 'Go back', 'polestar' ); ?>
									</a>
								</li>
							</ul>
						<?php endif; ?>						

					</nav><!-- #site-navigation -->

					<?php if ( get_theme_mod( 'menu_search', true ) ) : ?>	
						<div id="header-search">
							<div class="polestar-container">
								<label for='s' class='screen-reader-text'><?php esc_html_e( 'Search for:', 'polestar' ); ?></label>
								<?php get_search_form() ?>
								<a id="close-search">
									<span class="screen-reader-text"><?php esc_html_e( 'Close search bar', 'polestar' ); ?></span>
									<?php polestar_display_icon( 'close' ); ?>
								</a>
							</div>
						</div><!-- #header-search -->
					<?php endif; ?>

				</div><!-- .site-header-inner -->
		
			</div><!-- .polestar-container -->
		
		</header><!-- #masthead -->

		<?php do_action( 'polestar_content_before' ); ?>
		
		<div id="content" class="site-content">

			<div class="polestar-container">
	
				<?php do_action( 'polestar_content_top' ); ?>
