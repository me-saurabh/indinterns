<?php
extract( $args );
extract( $instance );

$title = apply_filters('widget_title', $instance['title']);

global $post;

if ( is_object($post) && $post->post_type == 'job_listing' ) {
	if ( $title ) {
	    echo trim($before_title)  .trim( $title ) . $after_title;
	}

	?>
	<div class="widget-job-overview">
		<div class="company-info text-center">
			<?php the_company_logo(); ?>
			<?php the_company_name( '<h3 class="title-job-list">', '</h3>' ); ?>
			<?php the_company_tagline( '<div class="tagline text-theme">', '</div>' ); ?>
			<div class="actions">
				<!-- favorite -->
				<?php do_action( 'entaro_job_listing_meta_start' ); ?>

				<!-- listing types -->
				<?php Entaro_Job_Manager_Tax_Type::types_display(); ?>

				<?php do_action( 'entaro_job_listing_meta_end' ); ?>
			</div>
		</div>
		<div class="job-info">
			<ul class="job-listing-info">
				<li class="job-date">
					<span class="icon text-second"><i class="fa fa-calendar-o" aria-hidden="true"></i></span>
					<div class="info-content">
						<?php echo sprintf(__('Dated Posted: <span>%s</span>', 'entaro'), get_the_job_publish_date() ); ?>
					</div>
				</li>
				<?php
				$location = get_the_job_location();
				if ( $location ) {
				?>
					<li class="job-location">
						<span class="icon text-second"><i class="fa fa-location-arrow" aria-hidden="true"></i></span>
						<div class="info-content">
							<?php echo sprintf(__('Location: <span>%s</span>', 'entaro'), $location ); ?>
						</div>
					</li>
				<?php } ?>
				<li class="job-title">
					<span class="icon text-second"><i class="fa fa-info-circle" aria-hidden="true"></i></span>
					<div class="info-content">
						<?php echo sprintf(__('Title: <span>%s</span>', 'entaro'), $post->post_title ); ?>
					</div>
				</li>
				<?php
				$salary = get_post_meta($post->ID, '_job_salary', true);
				if ( $salary ) {
				?>
					<li class="job-salary">
						<span class="icon text-second"><i class="fa fa-money" aria-hidden="true"></i></span>
						<div class="info-content">
							<?php echo sprintf(__('Salary: <span>%s</span>', 'entaro'), $salary ); ?>
						</div>
					</li>
				<?php } ?>

				<?php
				if ( get_option( 'job_manager_enable_categories' ) ) {
					$categories = get_the_terms( $post->ID, 'job_listing_category' );
					if ( $categories ) {
					?>
						<li class="job-category">
							<span class="icon text-second"><i class="fa fa-th-large" aria-hidden="true"></i></span>
							<div class="info-content">
								<?php echo esc_html__('Category:', 'entaro'); ?>
								<?php if ( ! empty( $categories ) ) : foreach ( $categories as $category ) : ?>
									<span class="job-category">
										<a href="<?php echo esc_url(get_term_link($category->term_id)); ?>">
											<?php echo esc_html( $category->name ); ?>
										</a>
									</span>
								<?php endforeach; endif; ?>

							</div>
						</li>
				<?php }
				} ?>

				<?php
				$experience = get_post_meta($post->ID, '_job_experience', true);
				if ( $experience ) {
				?>
					<li class="job-experience">
						<span class="icon text-second"><i class="fa fa-star" aria-hidden="true"></i></span>
						<div class="info-content">
							<?php echo sprintf(__('Experience: <span>%s</span>', 'entaro'), $experience ); ?>
						</div>
					</li>
				<?php } ?>

			</ul>

			<?php if ( candidates_can_apply() ) : ?>
				<?php get_job_manager_template( 'job-application.php' ); ?>
			<?php endif; ?>

		</div>
	</div>
<?php } ?>