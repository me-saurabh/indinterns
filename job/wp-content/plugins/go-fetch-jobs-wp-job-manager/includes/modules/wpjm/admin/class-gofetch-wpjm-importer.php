<?php
/**
 * Specific import code for WP Job Manager.
 *
 * @package GoFetch/WPJM/Admin/Import
 */

 if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

require_once dirname( GOFT_WPJM_PLUGIN_FILE ) . '/includes/class-gofetch-importer.php';

/**
 * WPJM specific import functionality.
 */
class GoFetch_WPJM_Import extends GoFetch_Importer {

	/**
	 * @var The single instance of the class.
	 */
	protected static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __construct() {
		add_filter( 'goft_wpjm_update_meta', array( $this, 'maybe_skip_geo_field' ), 10, 4 );
		add_filter( 'wpjm_schema_ping_search_engines', array( $this, 'maybe_disable_wpjm_schema' ) );
	}

	/**
	 * Skip adding any geolocation fields if WPJM already geolocated the job.
	 */
	public function maybe_skip_geo_field( $update, $meta_key, $meta_value, $post_id ) {

		if ( ! apply_filters( 'job_manager_geolocation_enabled', true ) ) {
			return $update;
		}

		$geo_fields = GoFetch_Admin_Builder::get_geocomplete_hidden_fields();

		return isset( $geo_fields[ $meta_key ] ) && class_exists( 'WP_Job_Manager_Geocode' ) && WP_Job_Manager_Geocode::has_location_data( $post_id );
	}

	/**
	 * Disable WPJM schema.
	 */
	public function maybe_disable_wpjm_schema( $disable ) {

		if ( defined( 'GOFJ_IMPORTING' ) && GOFJ_IMPORTING ) {
			$disable = apply_filters( 'goft_wpjm_disable_wpjm_schema', GOFJ_IMPORTING );
		}
		return $disable;
	}

}

GoFetch_WPJM_Import::instance();
