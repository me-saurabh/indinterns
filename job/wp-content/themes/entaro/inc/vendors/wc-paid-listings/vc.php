<?php
if ( class_exists("WPBakeryShortCode") ) {
    if ( !function_exists('entaro_load_wc_paid_listings_element')) {
        function entaro_load_wc_paid_listings_element() {
            
            vc_map( array(
                "name" => esc_html__("Apus WC Paid Subscribes", 'entaro'),
                "base" => "apus_wc_paid_subscribes",
                'description'=> esc_html__( 'Show Subscribes in frontend', 'entaro' ),
                'icon' => 'icon-wpb-woocommerce',
                "category" => esc_html__('Apus Jobs','entaro'),
                "params" => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__( 'Widget title', 'entaro' ),
                        'param_name' => 'title',
                        'description' => esc_html__( 'Enter heading title.', 'entaro' ),
                        "admin_label" => true,
                    ),
                    array(
                        "type" => "textarea_html",
                        'heading' => esc_html__( 'Description', 'entaro' ),
                        "param_name" => "content",
                        "value" => '',
                        'description' => esc_html__( 'Enter description for title.', 'entaro' )
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__("Columns",'entaro'),
                        "param_name" => "columns",
                        "value" => array(1,2,3,4,6)
                    ),
                    array(
                        "type" => "dropdown",
                        "heading" => esc_html__('Style','entaro'),
                        "param_name" => 'style',
                        'value'     => array(
                            esc_html__('Style 1 ', 'entaro') => '', 
                            esc_html__('Style 2 ', 'entaro') => 'style2', 
                            esc_html__('Style 3 ', 'entaro') => 'style3', 
                        ),
                        'std' => ''
                    ),
                    array(
                        "type" => "textfield",
                        "heading" => esc_html__("Extra class name",'entaro'),
                        "param_name" => "el_class",
                        "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'entaro')
                    )
                )
            ));
        }

        add_action( 'vc_after_set_mode', 'entaro_load_wc_paid_listings_element', 99 );

        class WPBakeryShortCode_apus_wc_paid_subscribes extends WPBakeryShortCode {}
    }
}
