<?php
/**
 * Regions
 *
 * @package    apus-jobpro
 * @author     ApusTheme <apusthemes@gmail.com >
 * @license    GNU General Public License, version 3
 * @copyright  13/06/2016 ApusTheme
 */
 
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
class ApusJobpro_Taxonomy_Regions{

	/**
	 *
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'register_taxonomy' ), 1 );

		add_filter( 'submit_job_form_fields', array( __CLASS__, 'job_region_field' ) );
	}

	/**
	 *
	 */
	public static function register_taxonomy() {
		$labels = array(
			'name'              => esc_html__( 'Regions', 'apus-jobpro' ),
			'singular_name'     => esc_html__( 'Region', 'apus-jobpro' ),
			'search_items'      => esc_html__( 'Search Regions', 'apus-jobpro' ),
			'all_items'         => esc_html__( 'All Regions', 'apus-jobpro' ),
			'parent_item'       => esc_html__( 'Parent Region', 'apus-jobpro' ),
			'parent_item_colon' => esc_html__( 'Parent Region:', 'apus-jobpro' ),
			'edit_item'         => esc_html__( 'Edit', 'apus-jobpro' ),
			'update_item'       => esc_html__( 'Update', 'apus-jobpro' ),
			'add_new_item'      => esc_html__( 'Add New', 'apus-jobpro' ),
			'new_item_name'     => esc_html__( 'New Region', 'apus-jobpro' ),
			'menu_name'         => esc_html__( 'Regions', 'apus-jobpro' ),
		);

		register_taxonomy( 'job_listing_region', 'job_listing', array(
			'labels'            => apply_filters( 'apusjobpro_taxomony_listing_location_labels', $labels ),
			'hierarchical'      => true,
			'query_var'         => 'region',
			'rewrite'           => array( 'slug' => esc_html__( 'region', 'apus-jobpro' ) ),
			'public'            => true,
			'show_ui'           => true,
			'show_in_rest'		=> true
		) );
	}

	public static function job_region_field($fields) {
		$fields['job']['job_regions'] = array(
			'label'       => esc_html__( 'Job Region', 'apus-jobpro' ),
			'description' => '',
			'required'    => false,
			'placeholder' => esc_html__( 'Add Region', 'apus-jobpro' ),
			'priority'    => '2.5',
			'type'    => 'term-select',
			'taxonomy' => 'job_listing_region',
			'default' => ''
		);
		return $fields;
	}


}

ApusJobpro_Taxonomy_Regions::init();