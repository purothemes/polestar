<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package polestar
 * @license GPL 2.0
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'polestar' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2>

		<?php 
		$args = array(
			'prev_text' => '<span class="icon-long-arrow-left"></span> ' . esc_html__( 'Older comments', 'polestar' ),
			'next_text' => esc_html__( 'Newer comments', 'polestar' ) . ' <span class="icon-long-arrow-right"></span>',
		);
		the_comments_navigation( $args ); 
		?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
					'style'	=> 'ol',
					'callback' => 'polestar_comment',
					'short_ping' => true,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php 
			$args = array(
				'prev_text' => '<span class="icon-long-arrow-left"></span> ' . esc_html__( 'Older comments', 'polestar' ),
				'next_text' => esc_html__( 'Newer comments', 'polestar' ) . ' <span class="icon-long-arrow-right"></span>',
			);
			the_comments_navigation( $args ); 

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'polestar' ); ?></p>
	<?php
	endif;

	comment_form();
	?>

</div><!-- #comments -->
