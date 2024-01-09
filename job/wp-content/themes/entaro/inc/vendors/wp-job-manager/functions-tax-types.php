<?php

class Entaro_Job_Manager_Tax_Type {

	public static function init() {
		add_action( 'cmb2_init', array( __CLASS__, 'metaboxes' ) );
		add_filter( 'apus_framework_enable_tax_fields', array( __CLASS__, 'enable_tax_custom_field' ) );
	}

	public static function enable_tax_custom_field($return) {
		return true;
	}

	public static function metaboxes() {
		if ( !class_exists('Taxonomy_MetaData_CMB2') ) {
			return;
		}
	    $metabox_id = 'entaro_type_options';

	    $cmb = new_cmb2_box( array(
			'id'           => $metabox_id,
			'title'        => '',
			'object_types' => array( 'page' ),
		) );

	    $cmb->add_field( array(
		    'name'    => esc_html__( 'Background Color', 'entaro' ),
		    'id'      => 'bg_color',
		    'type'    => 'colorpicker'
		) );

	    $cmb->add_field( array(
		    'name'    => esc_html__( 'Text Color', 'entaro' ),
		    'id'      => 'text_color',
		    'type'    => 'colorpicker'
		) );

	    $cats = new Taxonomy_MetaData_CMB2( 'job_listing_type', $metabox_id );
	}

	public static function display_color($term) {
		$return = '';
		if ( !class_exists('Taxonomy_MetaData_CMB2') ) {
			return $return;
		}
		$bg_color = Taxonomy_MetaData_CMB2::get('job_listing_type', $term->term_id, 'bg_color');
		$text_color = Taxonomy_MetaData_CMB2::get('job_listing_type', $term->term_id, 'text_color');
		$style = array();

		if ( !empty($bg_color) ) {
			$style[] = 'background-color: '.$bg_color;
			$style[] = 'border-color: '.$bg_color;
		}
		if ( !empty($text_color) ) {
			$style[] = 'color: '.$text_color;
		}
		if ( !empty($style) ) {
			$return = 'style="'.implode(';', $style).'"';
		}
		return $return;
	}

	public static function types_display() {
		if ( get_option( 'job_manager_enable_types' ) ) { ?>
			<?php $types = wpjm_get_the_job_types(); ?>
			<?php if ( ! empty( $types ) ) : foreach ( $types as $type ) : ?>
				<a class="job-type btn-sm-list btn-list-green" href="<?php echo esc_url(get_term_link($type)); ?>" <?php echo trim(self::display_color($type)); ?>><?php echo esc_html( $type->name ); ?></a>
			<?php endforeach; endif; ?>
		<?php }
	}
}

Entaro_Job_Manager_Tax_Type::init();