<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

	if ( !function_exists('entaro_job_resume_get_categories') ) {
	    function entaro_job_resume_get_categories( $tax = 'resume_category', $text_default = '' ) {
	    	if ( empty($text_default) ) {
	    		$text_default = esc_html__( ' --- Choose a Category --- ', 'entaro' );
	    	}
	        $return = array( $text_default => '' );

	        $args = array(
	            'type' => 'post',
	            'child_of' => 0,
	            'orderby' => 'name',
	            'order' => 'ASC',
	            'hide_empty' => false,
	            'hierarchical' => 1,
	            'taxonomy' => $tax
	        );

	        $categories = get_categories( $args );
	        entaro_job_resume_get_category_childs( $categories, 0, 0, $return );

	        return $return;
	    }
	}

	if ( !function_exists('entaro_job_resume_get_category_childs') ) {
	    function entaro_job_resume_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
	        foreach ( $categories as $key => $category ) {
	            if ( $category->category_parent == $id_parent ) {
	                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
	                unset($categories[$key]);
	                entaro_job_resume_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
	            }
	        }
	    }
	}

	if ( !function_exists('entaro_load_job_resume_manager_element')) {

		function entaro_load_job_resume_manager_element() {
			$columns = array(1,2,3,4,6);

			$categories = array();
			if ( is_admin() ) {
				$categories = entaro_job_resume_get_categories();
			}

			vc_map( array(
				'name'        => esc_html__( 'Apus Resumes','entaro'),
				'base'        => 'apus_job_resumes',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show jobs in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Order By', 'entaro'),
		                "param_name" => 'orderby',
		                "value" => array(
		                	esc_html__('Title', 'entaro') => 'title',
		                	esc_html__('Date', 'entaro') => 'date',
		                	esc_html__('ID', 'entaro') => 'ID',
		                	esc_html__('Random', 'entaro') => 'random',
	                	),
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Order Way', 'entaro'),
		                "param_name" => 'orderway',
		                "value" => array(
		                	esc_html__('Descending', 'entaro') => 'DESC',
		                	esc_html__('Ascending', 'entaro') => 'ASC',
	                	),
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Resume Category', 'entaro'),
		                "param_name" => 'category',
		                "value" => $categories
		            ),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number Jobs', 'entaro' ),
						'param_name' => 'posts_per_page',
						'value' => 4
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'entaro'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Grid', 'entaro') => 'grid', 
							esc_html__('List', 'entaro') => 'list', 
							esc_html__('Carousel', 'entaro') => 'carousel', 
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Columns", 'entaro'),
						"param_name" => "columns",
						'value' => $columns,
						'dependency' => array(
							'element' => 'layout_type',
							'value' => array('carousel', 'grid'),
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Item Style", 'entaro'),
						"param_name" => "item_style",
						'value' 	=> array(
							esc_html__('Normal', 'entaro') => 'v1', 
							esc_html__('Large', 'entaro') => 'v2', 
							esc_html__('Large with Information', 'entaro') => 'v3', 
						),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Rows', 'entaro'),
		                "param_name" => 'rows',
		                "value" => array(1,2,3,4,5),
		                'dependency' => array(
							'element' => 'layout_type',
							'value' => array('carousel'),
						),
		            ),
		            array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Navigation', 'entaro' ),
						'param_name' => 'show_nav',
						'value' => array( esc_html__( 'Yes, to show navigation', 'entaro' ) => 'yes' ),
						'dependency' => array(
							'element' => 'layout_type',
							'value' => array('carousel'),
						),
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Pagination', 'entaro' ),
						'param_name' => 'show_pagination',
						'value' => array( esc_html__( 'Yes, to show Pagination', 'entaro' ) => 'yes' ),
						'dependency' => array(
							'element' => 'layout_type',
							'value' => array('carousel'),
						),
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Button View All', 'entaro' ),
						'param_name' => 'show_btn',
						'value' => array( esc_html__( 'Yes, to show Button', 'entaro' ) => 'yes' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Url', 'entaro' ),
						'param_name' => 'url',
						'dependency' => array(
							'element' => 'show_btn',
							'value' => array('yes'),
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Text', 'entaro' ),
						'param_name' => 'btn_text',
						'dependency' => array(
							'element' => 'show_btn',
							'value' => array('yes'),
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));

		}
	}
	add_action( 'vc_after_set_mode', 'entaro_load_job_resume_manager_element', 99 );

	class WPBakeryShortCode_apus_job_resumes extends WPBakeryShortCode {}
}