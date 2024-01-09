<?php

get_header();

$sidebar_configs = entaro_get_company_layout_configs();
entaro_render_breadcrumbs();
?>
<section id="main-container" class="main-content <?php echo apply_filters( 'entaro_company_content_class', 'container' ); ?> inner">
	<div class="row">
		<?php
            $class = '';
            if ( isset($sidebar_configs['left']) ) {
                $class = 'pull-right';
            }
        ?>
		<div id="main-content" class="col-xs-12 <?php echo esc_attr($sidebar_configs['main']['class'].' '.$class); ?>">
			<div id="primary" class="content-area detail-company">
				<div id="content" class="site-content" role="main">
						<div class="top-content">
							<?php the_post(); ?>
								<div class="job-content-wrapper ">
									<div class="top-info">
										<?php the_company_logo('full'); ?>
										<div class="info-company">
											<h3 class="title-company"><?php the_company_name( '<strong>', '</strong> ' ); ?></h3>
											<?php the_company_tagline( '<p class="tagline">', '</p>' ); ?>
											<div class="company">
												<i aria-hidden="true" class="text-second fa fa-map-marker"></i>
												<?php the_job_location( false ); ?>
											</div>
										</div>
									</div>
									<!-- social share -->
									<?php if ( entaro_get_config('show_job_company_social_share') ) { ?>
										<?php get_template_part('template-parts/sharebox'); ?>
									<?php } ?>
									<!-- company link -->
									<div class="link-more-company">
									<?php if ( $website = get_the_company_website() ) : ?>
										<a class="website" href="<?php echo esc_url( $website ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-link text-theme"></i> <?php echo trim($website); ?></a>
									<?php endif; ?>

									<?php
										$company_twitter = get_the_company_twitter( $post );
										if ( $company_twitter ) :
											$company_twitter = '//twitter.com/' . $company_twitter;
									?>
										<a class="twitter" href="<?php echo esc_url( $company_twitter ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-twitter text-theme"></i> <?php echo trim(get_the_company_twitter( $post )); ?></a>
									<?php endif; ?>


									<?php
										$facebook = get_post_meta( get_the_ID(), '_company_facebook', true);
										if ( $facebook ) :
											$company_facebook = '//facebook.com/' . $facebook;
									?>
										<a class="facebook" href="<?php echo esc_url( $company_facebook ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-facebook text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_facebook', true)); ?></a>
									<?php endif; ?>

									<?php
										$gplus = get_post_meta( get_the_ID(), '_company_gplus', true);
										if ( $gplus ) :
											$company_gplus = '//plus.google.com/' . $gplus;
									?>
										<a class="gplus" href="<?php echo esc_url( $company_gplus ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-google-plus text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_gplus', true)); ?></a>
									<?php endif; ?>
									
									<?php
										$linkedin = get_post_meta( get_the_ID(), '_company_linkedin', true);
										if ( $linkedin ) :
											$company_linkedin = '//linkedin.com/company/' . $linkedin;
									?>
										<a class="linkedin" href="<?php echo esc_url( $company_linkedin ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-linkedin text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_linkedin', true)); ?></a>
									<?php endif; ?>

									<?php
										$pinterest = get_post_meta( get_the_ID(), '_company_pinterest', true);
										if ( $pinterest ) :
											$company_pinterest = '//pinterest.com/' . $pinterest;
									?>
										<a class="pinterest" href="<?php echo esc_url( $company_pinterest ); ?>" target="_blank" rel="nofollow"> <i class="fa fa-pinterest text-theme"></i> <?php echo trim(get_post_meta( get_the_ID(), '_company_pinterest', true)); ?></a>
									<?php endif; ?>
									</div>
								</div>
								<div class="job-content-description-wrapper">
									<?php the_company_video(); ?>
									<?php $content = get_post_meta(get_the_ID(), '_company_description', true);
										if ( !empty($content) ) {
											echo wp_kses_post($content);
										}
									?>
								</div>
							<?php rewind_posts(); ?>
						</div>
						<?php while ( have_posts() ) : the_post(); ?>
							<div class="job_listings">
								<?php get_template_part( 'job_manager/loop/list'); ?>
							</div>
						<?php endwhile; ?>
				</div><!-- #content -->
			</div><!-- #primary -->
		</div>
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
</section>
<?php get_footer(); ?>