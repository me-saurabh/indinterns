<?php
get_header();

?>
	<section id="main-container" class="inner">
		<div id="primary" class="content-area">
			<div class="entry-content">
				<main id="main" class="site-main" role="main">
					<?php
						global $wp_query;

						$term =	$wp_query->queried_object;
						if ( isset( $term->term_id) ) {
							$shortcode = '[resumes categories="' . $term->term_id . '" show_categories="true" orderby="featured" order="DESC"]';

							echo do_shortcode( $shortcode );
						}
					?>
				</main><!-- #main -->
			</div>
		</div><!-- #primary -->
	</section>
	
<?php get_footer(); ?>