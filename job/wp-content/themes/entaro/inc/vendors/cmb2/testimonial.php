<?php

if ( !function_exists( 'entaro_testimonial_metaboxes' ) ) {
	function entaro_testimonial_metaboxes(array $metaboxes) {
		
        $ratings = array(
            '1' => esc_html__( '1 Star', 'entaro' ),
            '2' => esc_html__( '2 Stars', 'entaro' ),
            '3' => esc_html__( '3 Stars', 'entaro' ),
            '4' => esc_html__( '4 Stars', 'entaro' ),
            '5' => esc_html__( '5 Stars', 'entaro' ),
        );

		if ( !empty($metaboxes['apus_testimonial_settings']['fields']) ) {
            $fields = $metaboxes['apus_testimonial_settings']['fields'];
            $fields[] = array(
                'id' => 'apus_testimonial_star',
                'type' => 'select',
                'name' => esc_html__('Rating Star', 'entaro'),
                'options' => $ratings
            );
            $metaboxes['apus_testimonial_settings']['fields'] = $fields;
        }
        
	    return $metaboxes;
	}
}
add_filter( 'cmb2_meta_boxes', 'entaro_testimonial_metaboxes', 100 );


