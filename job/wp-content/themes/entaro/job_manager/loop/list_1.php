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
<div <?php job_listing_class('job-list job-list_1'); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	
	<div class="job-content-wrapper media">
		<div class="media-left media-middle">
			<a href="<?php the_job_permalink(); ?>">
				<?php the_company_logo(); ?>
			</a>
		</div>
		<div class="media-body media-middle">
			<div class="position">
				<?php do_action( 'entaro_loop_listing_title_before' ); ?>

				<h3 class="title-job-list"><a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a></h3>
				
				<?php do_action( 'entaro_loop_listing_title_end' ); ?>
			</div>
			<div class="job-metas">
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
			</div>
		</div>
		<div class="media-right media-middle">

			<?php do_action( 'job_listing_meta_start' ); ?>
			<div class="left-content">
				<?php Entaro_Job_Manager_Tax_Type::types_display(); ?>

				<?php do_action( 'job_listing_meta_end' ); ?>
			</div>
		</div>
	</div>
	<?php do_action( 'entaro_loop_listing_end' ); ?>
</div>