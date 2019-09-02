<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package polestar
 * @license GPL 2.0 
 */

$footer_widgets = is_active_sidebar( 'sidebar-footer' ) == true;
$footer_widgets_page_setting = puro_page_setting( 'footer_widgets', true );

?>

		</div><!-- .polestar-container -->
	</div><!-- #content -->

	<?php do_action( 'polestar_footer_before' ); ?>

	<footer id="colophon" class="site-footer <?php if ( ! is_page() && $footer_widgets || is_page() && ( $footer_widgets && $footer_widgets_page_setting ) ) echo 'footer-active-sidebar'; if ( get_theme_mod( 'footer_layout' ) == 'full-width' ) echo ' full-width';  ?>">

		<?php do_action( 'polestar_footer_top' ); ?>

		<?php if ( $footer_widgets_page_setting ) : ?>
			<div class="polestar-container">
				<?php
					if ( is_active_sidebar( 'sidebar-footer' ) ) {
						$polestar_footer_sidebars = wp_get_sidebars_widgets();
						?>
						<div class="widgets widgets-<?php echo count( $polestar_footer_sidebars['sidebar-footer'] ) ?>" aria-label="<?php esc_attr_e( 'Footer Widgets', 'polestar' ); ?>">
							<?php dynamic_sidebar( 'sidebar-footer' ); ?>
						</div>
						<?php
					}
				?>
			</div><!-- .polestar-container -->
		<?php endif; ?>	

		<div class="bottom-bar">
			<div class="polestar-container">
				<div class="site-info">
					<?php
					polestar_footer_text();

					$credit_text = apply_filters(
						'polestar_footer_credits',
						'<span>' . sprintf( esc_html__( 'Theme by %s', 'polestar' ), '<a href="https://purothemes.com/">Puro</a>' ) . '</span>'
					);

					if ( function_exists( 'the_privacy_policy_link' ) && get_theme_mod( 'footer_privacy_policy_link', true ) ) {
						the_privacy_policy_link( '<span>', '</span>' );
					}

					if ( ! empty( $credit_text ) ) {
						echo wp_kses_post( $credit_text );
					}
					?>
				</div><!-- .site-info -->
				<?php wp_nav_menu( array( 'theme_location' => 'menu-2', 'container_class' => 'footer-menu', 'depth' => 1, 'fallback_cb' => '' ) ); ?>
			</div><!-- .polestar-container -->
		</div><!-- .bottom-bar -->

		<?php do_action( 'polestar_footer_bottom' ); ?>

	</footer><!-- #colophon -->
</div><!-- #page -->

<?php if ( get_theme_mod( 'scroll_to_top', true ) ) : ?>
	<div id="scroll-to-top">
		<span class="screen-reader-text"><?php esc_html_e( 'Scroll to top', 'polestar' ); ?></span>
		<?php polestar_display_icon( 'up-arrow' ); ?>
	</div>
<?php endif; ?>

<?php wp_footer(); ?>
<?php do_action( 'polestar_footer_after' ); ?>

</body>
</html>
