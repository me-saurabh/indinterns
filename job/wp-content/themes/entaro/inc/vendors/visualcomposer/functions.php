<?php

if ( function_exists('apus_framework_add_param') ) {
	apus_framework_add_param();
}

function entaro_admin_init_scripts(){
	$key = get_option( 'job_manager_google_maps_api_key' );
	wp_enqueue_script('google-maps-api', '//maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key=' . $key );
	wp_enqueue_script('jquery-geocomplete', get_template_directory_uri().'/js/admin/jquery.geocomplete.min.js');

	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_style('jquery-ui', get_template_directory_uri() . '/css/jquery-ui.css' );
	wp_enqueue_script( 'entaro-admin-scripts', get_template_directory_uri() . '/js/admin/custom.js', array( 'jquery'  ), '20131022', true );
}
add_action( 'admin_enqueue_scripts', 'entaro_admin_init_scripts' );

function entaro_map_init_scripts() {
	$key = get_option( 'job_manager_google_maps_api_key' );
	wp_enqueue_script('google-maps-api', '//maps.googleapis.com/maps/api/js?sensor=false&libraries=places&key='. $key );
	wp_enqueue_script('gmap3', get_template_directory_uri().'/js/gmap3.js', array( 'jquery' ), '6.0.0', true);
}
add_action('wp_enqueue_scripts', 'entaro_map_init_scripts');
