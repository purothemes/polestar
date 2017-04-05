<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date).
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<p class="meta"><em><?php esc_attr_e( 'Your comment is awaiting approval', 'polestar' ); ?></em></p>

<?php } else { ?>

	<p class="meta">
		<span itemprop="author"><?php comment_author(); ?></span> <?php

		if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
			echo '<em class="verified">(' . esc_attr__( 'verified owner', 'polestar' ) . ')</em> ';
		}

		?>
	</p>

	<p class="comment-date">
		<time itemprop="datePublished" datetime="<?php echo get_comment_date( 'c' ); ?>"><?php echo get_comment_date( wc_date_format() ); ?></time>
	</p>	

<?php }
