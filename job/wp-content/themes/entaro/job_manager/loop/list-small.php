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
<div <?php job_listing_class('job-list-small'); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	
	<div class="job-content-wrapper media">
		<div class="media-left media-middle">
			<a href="<?php the_job_permalink(); ?>">
				<?php the_company_logo(); ?>
			</a>
		</div>
		<div class="media-body media-middle">
			<div class="position">
				<?php do_action( 'entaro_loop_listing_title_before' ); ?>
				<h3 class="title-list-small"><a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a></h3>
				<?php do_action( 'entaro_loop_listing_title_end' ); ?>
			</div>
		</div>
	</div>
</div>