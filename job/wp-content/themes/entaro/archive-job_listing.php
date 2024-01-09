<?php
get_header();

?>
	<section id="main-container" class="inner">
		<div id="primary" class="content-area">
			<div class="entry-content">
				<main id="main" class="site-main" role="main">
				<?php
					global $wp_query;
					$selected_job_types = '';
					if ( !empty($_REQUEST['job_type_select']) ) {
						$selected_job_types = $_REQUEST['job_type_select'];
					}
					$shortcode = '[jobs show_tags="true" show_more="false" orderby="featured" order="DESC" '.($selected_job_types ? 'selected_job_types="'.$selected_job_types.'"' : '').']';
					echo do_shortcode(  $shortcode );
				?>
				</main><!-- #main -->
			</div>
		</div><!-- #primary -->
	</section>
	
<?php get_footer(); ?>