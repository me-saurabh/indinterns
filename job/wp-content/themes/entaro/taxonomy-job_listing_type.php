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
					if ( isset( $term->slug) ) {
						$shortcode = '[jobs job_types="' . $term->slug . '" show_types="true" show_more="false" orderby="featured" order="DESC"]';

						echo do_shortcode(  $shortcode );
					}
				?>
				</main><!-- #main -->
			</div>
		</div><!-- #primary -->
	</section>

<?php get_footer(); ?>