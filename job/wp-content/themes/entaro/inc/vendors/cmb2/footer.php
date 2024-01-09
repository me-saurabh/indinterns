<?php
if ( !function_exists( 'entaro_footer_metaboxes' ) ) {
	function entaro_footer_metaboxes(array $metaboxes) {
		$prefix = 'apus_footer_';
	    $fields = array(
			array(
				'name' => esc_html__( 'Footer Style', 'entaro' ),
				'id'   => $prefix.'style_class',
				'type' => 'select',
				'options' => array(
					'container' => esc_html__('Boxed', 'entaro'),
					'full' => esc_html__('Full', 'entaro'),
				)
			),
			array(
				'name' => esc_html__( 'Footer Background Color', 'entaro' ),
				'id'   => $prefix.'background_class',
				'type' => 'select',
				'options' => array(
					'' => esc_html__('Dark 1', 'entaro'),
					'dark2' => esc_html__('Dark 2', 'entaro'),
				)
			),
    	);
		
	    $metaboxes[$prefix . 'display_setting'] = array(
			'id'                        => $prefix . 'display_setting',
			'title'                     => esc_html__( 'Display Settings', 'entaro' ),
			'object_types'              => array( 'apus_footer' ),
			'context'                   => 'normal',
			'priority'                  => 'high',
			'show_names'                => true,
			'fields'                    => $fields
		);

	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'entaro_footer_metaboxes' );