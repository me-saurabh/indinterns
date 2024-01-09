<?php
/**
 * Job listing in the loop.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.27.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
?>
<div <?php job_listing_class('job-list job-list_2'); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	
	<div class="job-content-wrapper">
		<div class="flex-middle row">
			<div class="col-sm-3 hidden-xs text-center">
				<a href="<?php the_job_permalink(); ?>">
					<?php the_company_logo(); ?>
				</a>
			</div>
			<div class="col-sm-6 col-xs-7">
				<div class="content-middle">
					<div class="position">
						<?php do_action( 'entaro_loop_listing_title_before' ); ?>
						<div class="line-top">
							<h3 class="title-job-list"><a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a></h3>
							<?php do_action( 'entaro_loop_listing_title_end' ); ?>
						</div>
					</div>
					<div class="job-metas2">
						<?php
						$salary = get_post_meta($post->ID, '_job_salary', true);
						if ( $salary ) {
						?>
							<div class="job-salary">
								<i class="text-second fa fa-money" aria-hidden="true"></i>
								<?php echo esc_html( $salary ); ?>
							</div>
						<?php } ?>
						<div class="location">
							<i class="text-second fa fa-map-marker" aria-hidden="true"></i>
							<?php the_job_location( false ); ?>
						</div>
						<?php 
							if ( $terms = ApusJobpro_Taxonomy_Tags::get_job_tag_list( $post->ID ) ) {
								echo'<div class="job_tags_list"><i aria-hidden="true" class="fa fa-tags text-theme"></i><strong>' . esc_html__( 'Tagged as:', 'entaro' ) . '</strong>  ' . $terms . '</div>';
							}
						?>
					</div>
				</div>
			</div>
			<div class="col-sm-3 col-xs-5 text-center">
				<div class="right-content">
					<?php do_action( 'job_listing_meta_start' ); ?>
					<div class="left-content flex-column">
						<?php Entaro_Job_Manager_Tax_Type::types_display(); ?>

						<?php do_action( 'job_listing_meta_end' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php do_action( 'entaro_loop_listing_end' ); ?>
</div>