<?php
/**
 * The sidebar containing the main widget area
 *
 * @package WordPress
 * @subpackage Entaro
 * @since Entaro 1.0
 */

$sidebar = '';
$sidebar_class = '';
global $post;
if ( is_page() && is_object($post) ) {
	$sidebar_configs = entaro_get_page_layout_configs();
}
if (( (is_front_page() && is_home() ) || (is_home()) || (is_single()) || (is_archive()) || (is_sticky()) || (is_search())) && (function_exists('is_woocommerce') && !is_woocommerce()) ) {
	$sidebar_configs = entaro_get_blog_layout_configs();
}
if (  is_post_type_archive('job_listing') || is_tax('job_listing_category') || is_tax('job_listing_type') || is_tax('job_listing_region') || is_tax('job_listing_tag') ) {
	$sidebar_configs = entaro_get_listing_archive_layout_configs();
}
if ( is_singular('job_listing') ) {
	$sidebar_configs = entaro_get_listing_single_layout_configs();
}
if (  is_post_type_archive('resume') || is_tax('resume_category') || is_tax('resume_skill') || is_singular('resume') ) {
	$sidebar_configs = entaro_get_job_resume_layout_configs();
}

if ( isset($sidebar_configs) ) {
	if ( isset($sidebar_configs['left']) && is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ) {
		$sidebar = $sidebar_configs['left']['sidebar'];
		$sidebar_class = 'mobile-offcanvas-left';
	} elseif ( isset($sidebar_configs['right']) && is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ) {
		$sidebar = $sidebar_configs['right']['sidebar'];
		$sidebar_class = 'mobile-offcanvas-right';
    }
}

if (function_exists('is_woocommerce') && is_woocommerce()) {
	$sidebar_configs = entaro_get_woocommerce_layout_configs();
	if ( isset($sidebar_configs['left']) && is_active_sidebar( $sidebar_configs['left']['sidebar'] ) ) {
		$sidebar = $sidebar_configs['left']['sidebar'];
		$sidebar_class = 'mobile-offcanvas-left offcanvas-shop-sidebar';
	} elseif ( isset($sidebar_configs['right']) && is_active_sidebar( $sidebar_configs['right']['sidebar'] ) ) {
		$sidebar = $sidebar_configs['right']['sidebar'];
		$sidebar_class = 'mobile-offcanvas-right offcanvas-shop-sidebar';
    } 
}

if ( $sidebar_class ) {
	?>
	<div id="mobile-offcanvas-sidebar" class="widget-area <?php echo esc_attr($sidebar_class); ?> hidden-lg hidden-md">
		<div class="mobile-sidebar-wrapper"></div>
		<div class="mobile-sidebar-btn">
			<div class="open-text"> <i class="ion-levels" title="<?php esc_html_e( 'Sidebar', 'entaro' ); ?>"></i> </div>
		</div>
	</div><!-- .widget-area -->
	<div class="mobile-sidebar-panel-overlay"></div>
	<?php
}