<?php
global $post;
$location = get_the_job_location( $post );
$lat = get_post_meta($post->ID, 'geolocation_lat', true);
$lng = get_post_meta($post->ID, 'geolocation_long', true);
$marker_icon = entaro_get_config('google_map_marker_icon', 15);
$marker_icon_url = '';
if ( !empty($marker_icon['url']) ) {
	$marker_icon_url = $marker_icon['url'];
}
if ( $location ) {
?>
	<div id="job-location" class="job-location widget">
		<h3 class="widget-title"><span><?php esc_html_e('Location', 'entaro'); ?></span></h3>
		<div class="box-inner">
			<div id="apus-single-listing-map" class="apus-google-map" data-lat="<?php echo esc_attr($lat); ?>"
				data-lng="<?php echo esc_attr($lng); ?>"
				data-zoom="<?php echo esc_attr(entaro_get_config('google_map_zoom', 15)); ?>"
				data-marker_icon="<?php echo esc_attr($marker_icon_url); ?>"
				data-style="<?php echo esc_attr(entaro_get_config('google_map_custom_style', '')); ?>"></div>
		</div>
	</div>
<?php } ?>