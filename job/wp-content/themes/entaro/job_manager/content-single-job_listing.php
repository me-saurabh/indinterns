<?php
/**
 * Single job listing.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/content-single-job_listing.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @since       1.0.0
 * @version     1.28.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post;
?>
<div class="single_job_listing">
	<?php if ( get_option( 'job_manager_hide_expired_content', 1 ) && 'expired' === $post->post_status ) : ?>
		<div class="job-manager-info"><?php esc_html_e( 'This listing has expired.', 'entaro' ); ?></div>
	<?php else : ?>
		<div class="job-content-wrapper">
			<?php
				do_action( 'job_content_start' );

				/**
				 * single_job_listing_start hook
				 *
				 * @hooked job_listing_meta_display - 20
				 * @hooked job_listing_company_display - 30
				 */
				remove_action( 'single_job_listing_start', 'job_listing_meta_display', 20 );
				remove_action( 'single_job_listing_start', 'job_listing_company_display', 30 );

				do_action( 'single_job_listing_start' );
			?>
			
			<?php
				$contents = entaro_get_single_content_sort();
				foreach ($contents as $content => $title) {
					get_template_part( 'job_manager/single/'.$content );
				}
			?>
			<?php
				/**
				 * single_job_listing_end hook
				 */
				do_action( 'single_job_listing_end' );

				do_action( 'job_content_end' );
			?>
		</div>
	<?php endif; ?>
</div>
<?php
	if ( entaro_get_config('show_job_releated', true) ) {
		get_template_part('template-parts/job-releated');
	}
?>