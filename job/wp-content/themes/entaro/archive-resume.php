<?php
get_header();

?>
	<section id="main-container" class="inner">
		<div id="primary" class="content-area">
			<div class="entry-content">
				<main id="main" class="site-main" role="main">
				<?php
					global $wp_query;

					$shortcode = '[resumes]';
					
				?>
				</main><!-- #main -->
			</div>
		</div><!-- #primary -->
	</section>
	
<?php get_footer(); ?>