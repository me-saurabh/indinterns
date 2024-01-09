<?php

get_header();
$sidebar_configs = entaro_get_listing_single_layout_configs();

entaro_render_breadcrumbs();

?>
<section id="main-container" class="main-content <?php echo apply_filters('entaro_listing_single_content_class', 'container');?> inner">
	
	<?php
        $class = '';
        if ( isset($sidebar_configs['left']) ) {
            $class = 'pull-right';
        }
    ?>
	<div id="main-content">
		<main id="main" class="site-main layout-blog" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
				<div class="row">
					<div class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class'].' '.$class); ?>">
						<?php get_job_manager_template( 'content-single-job_listing.php' ); ?>
					</div>

					<!-- sidebar -->
					<?php if ( isset($sidebar_configs['left']) ) : ?>
						<div class="<?php echo esc_attr($sidebar_configs['left']['class']) ;?>">
						  	<aside class="sidebar sidebar-left" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						  		<?php if ( is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ): ?>
						   			<?php dynamic_sidebar( $sidebar_configs['left']['sidebar'] ); ?>
						   		<?php endif; ?>
						  	</aside>
						</div>
					<?php endif; ?>
					
					<?php if ( isset($sidebar_configs['right']) ) : ?>
						<div class="<?php echo esc_attr($sidebar_configs['right']['class']) ;?>">
						  	<aside class="sidebar sidebar-right" itemscope="itemscope" itemtype="http://schema.org/WPSideBar">
						   		<?php if ( is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ): ?>
							   		<?php dynamic_sidebar( $sidebar_configs['right']['sidebar'] ); ?>
							   	<?php endif; ?>
						  	</aside>
						</div>
					<?php endif; ?>

				</div>
			<?php endwhile; // End of the loop. ?>

		</main><!-- .site-main -->
	</div><!-- .content-area -->

</section>
<?php get_footer();