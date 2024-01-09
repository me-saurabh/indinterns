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
$_featured_image = get_post_meta($post->ID, '_featured_image', true);
?>
<div <?php job_listing_class('job-grid-spotlight'); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	<?php if ( !empty($_featured_image) ) { ?>
		<div class="feature-img">
			<a href="<?php the_job_permalink(); ?>">
				<img src="<?php echo esc_url($_featured_image); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
			</a>
		</div>
	<?php } ?>
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
	<div class="listing-buttons text-center">
		<a class="btn btn-second" href="<?php the_job_permalink(); ?>"><i aria-hidden="true" class="fa fa-plus-circle"></i><?php esc_html_e('Apply Now', 'entaro'); ?></a>
	</div>
</div>