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
<div <?php job_listing_class('job-list job-list_3'); ?> data-longitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-latitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
	
	<div class="job-content-wrapper text-center">
		<?php do_action( 'job_listing_meta_start' ); ?>
		<div class="logo-job">
			<a href="<?php the_job_permalink(); ?>">
				<?php the_company_logo(); ?>
			</a>
		</div>
		<div class="info">
			<?php do_action( 'entaro_loop_listing_title_before' ); ?>
			<div class="line-top">
				<h3 class="title-job-list"><a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a></h3>
				<div class="nam-company"><?php do_action( 'entaro_loop_listing_title_end' ); ?></div>
			</div>
		</div>

		<div class="left-content">
			<?php Entaro_Job_Manager_Tax_Type::types_display(); ?>
			<?php do_action( 'job_listing_meta_end' ); ?>
		</div>
	</div>
	<?php 
		remove_filter( 'entaro_loop_listing_end', 'entaro_job_manager_loop_tags' );
		do_action( 'entaro_loop_listing_end' );
	?>
</div>