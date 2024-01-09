<?php
/**
 *
 * If no content, include the "No posts found" template.
 * @since 1.0
 * @version 1.0.0
 *
 */
?>
<article id="post-0" class="post no-results not-found">
	<div class="entry-content e-entry-content">
		<h2 class="title-content-no">
			<span><?php esc_html_e( 'Oops!', 'entaro' ) ?></span> <?php esc_html_e( 'Sorry, but your search returned no results!', 'entaro' ) ?>
		</h2>
		<p><?php esc_html_e( 'Try again please, use the search form below.', 'entaro' ); ?></p>
		<?php get_search_form(); ?>
	</div>
	<!-- entry-content -->
</article><!-- /article -->