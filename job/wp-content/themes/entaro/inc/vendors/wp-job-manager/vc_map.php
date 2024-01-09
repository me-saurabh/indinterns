<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

	if ( !function_exists('entaro_job_get_categories') ) {
	    function entaro_job_get_categories( $tax = 'job_listing_type', $text_default = '' ) {
	    	if ( empty($text_default) ) {
	    		$text_default = esc_html__( ' --- Choose a Type --- ', 'entaro' );
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
	        entaro_job_get_category_childs( $categories, 0, 0, $return );

	        return $return;
	    }
	}

	if ( !function_exists('entaro_job_get_category_childs') ) {
	    function entaro_job_get_category_childs( $categories, $id_parent, $level, &$dropdown ) {
	        foreach ( $categories as $key => $category ) {
	            if ( $category->category_parent == $id_parent ) {
	                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
	                unset($categories[$key]);
	                entaro_job_get_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
	            }
	        }
	    }
	}

	// autocomplete
	if ( !function_exists('entaro_vc_get_job_object')) {
		function entaro_vc_get_job_object($term) {
			$vc_taxonomies_types = vc_taxonomies_types();

			return array(
				'label' => $term->post_title,
				'value' => $term->post_name,
				'group_id' => $term->post_name,
				'group' => isset( $vc_taxonomies_types[ $term->taxonomy ], $vc_taxonomies_types[ $term->taxonomy ]->labels, $vc_taxonomies_types[ $term->taxonomy ]->labels->name ) ? $vc_taxonomies_types[ $term->taxonomy ]->labels->name : esc_html__( 'Taxonomies', 'entaro' ),
			);
		}
	}

	if ( !function_exists('entaro_job_field_search')) {
		function entaro_job_field_search( $search_string ) {
			$data = array();
			$loop = entaro_get_listings();

			if ( !empty($loop->posts) ) {

				foreach ( $loop->posts as $t ) {
					if ( is_object( $t ) ) {
						$data[] = entaro_vc_get_job_object( $t );
					}
				}
			}
			
			return $data;
		}
	}

	if ( !function_exists('entaro_job_render')) {
		function entaro_job_render( $query ) {
			$args = array(
			  'name'        => $query['value'],
			  'post_type'   => 'job_listing',
			  'post_status' => 'publish',
			  'numberposts' => 1
			);
			$jobs = get_posts($args);
			if ( ! empty( $query ) && $jobs ) {
				$job = $jobs[0];
				$data = array();
				$data['value'] = $job->post_name;
				$data['label'] = $job->post_title;
				return ! empty( $data ) ? $data : false;
			}
			return false;
		}
	}
	add_filter( 'vc_autocomplete_apus_jobs_spotlight_job_slugs_callback', 'entaro_job_field_search', 10, 1 );
	add_filter( 'vc_autocomplete_apus_jobs_spotlight_job_slugs_render', 'entaro_job_render', 10, 1 );
	

	if ( !function_exists('entaro_load_job_manager_element')) {

		function entaro_load_job_manager_element() {
			$columns = array(1,2,3,4,6);
			// Heading Text Block
			$types = array();
			if ( is_admin() ) {
				$types = entaro_job_get_categories();
			}
			$categories = array();
			if ( is_admin() ) {
				$categories = entaro_job_get_categories( 'job_listing_category', esc_html__(' --- Choose a Category --- ', 'entaro') );
			}
			$regions = array();
			if ( is_admin() ) {
				$regions = entaro_job_get_categories( 'job_listing_region', esc_html__(' --- Choose a Region --- ', 'entaro') );
			}
			vc_map( array(
				'name'        => esc_html__( 'Apus Jobs','entaro'),
				'base'        => 'apus_jobs',
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
		                "heading" => esc_html__('Get Jobs By', 'entaro'),
		                "param_name" => 'get_job_by',
		                "value" => array(
		                	esc_html__('Recent Jobs', 'entaro') => 'recent',
		                	esc_html__('Popular Jobs', 'entaro') => 'popular',
		                	esc_html__('Featured Jobs', 'entaro') => 'featured',
	                	),
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Job Type', 'entaro'),
		                "param_name" => 'types',
		                "value" => $types
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Job Category', 'entaro'),
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
						"heading" => esc_html__("Number Columns", 'entaro'),
						"param_name" => "columns",
						'value' => $columns
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'entaro'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Grid', 'entaro') => 'grid', 
							esc_html__('Carousel', 'entaro') => 'carousel', 
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
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus Jobs Spotlight','entaro'),
				'base'        => 'apus_jobs_spotlight',
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
					    'type' => 'autocomplete',
					    'heading' => esc_html__( 'Choose Jobs', 'entaro' ),
					    'param_name' => 'job_slugs',
					    'settings' => array(
					     	'multiple' => true,
					     	'unique_values' => true
					    ),
				   	),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Columns", 'entaro'),
						"param_name" => "columns",
						'value' => $columns
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'entaro'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Grid', 'entaro') => 'grid', 
							esc_html__('Carousel', 'entaro') => 'carousel', 
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
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus Jobs Tabs','entaro'),
				'base'        => 'apus_jobs_tabs',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show jobs tabs in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Tabs Settings', 'entaro' ),
						'param_name' => 'tabs',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Title', 'entaro' ),
								'param_name' => 'title',
							),
							array(
				                "type" => "dropdown",
				                "heading" => esc_html__('Get Jobs By', 'entaro'),
				                "param_name" => 'get_job_by',
				                "value" => array(
				                	esc_html__('Recent Jobs', 'entaro') => 'recent',
				                	esc_html__('Popular Jobs', 'entaro') => 'popular',
				                	esc_html__('Featured Jobs', 'entaro') => 'featured',
			                	),
				            ),
				            array(
				                "type" => "dropdown",
				                "heading" => esc_html__('Job Type', 'entaro'),
				                "param_name" => 'types',
				                "value" => $types
				            ),
				            array(
				                "type" => "dropdown",
				                "heading" => esc_html__('Job Category', 'entaro'),
				                "param_name" => 'category',
				                "value" => $categories
				            ),
						),
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
							esc_html__('Default', 'entaro') => 'default', 
							esc_html__('Layout 1', 'entaro') => 'layout1',
							esc_html__('Center', 'entaro') => 'st_center',
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Item Style", 'entaro'),
						"param_name" => "item_style",
						'value' 	=> array(
							esc_html__('Item 1', 'entaro') => 'list', 
							esc_html__('Item 2', 'entaro') => 'list_2',
						),
						'dependency' => array(
							'element' => 'layout_type',
							'value' => 'default',
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

			
			vc_map( array(
				'name'        => esc_html__( 'Apus Job Categories','entaro'),
				'base'        => 'apus_job_categories',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show jobs categories in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Category Settings', 'entaro' ),
						'param_name' => 'categories',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Title', 'entaro' ),
								'param_name' => 'title',
							),
				            array(
				                "type" => "dropdown",
				                "heading" => esc_html__('Job Category', 'entaro'),
				                "param_name" => 'category',
				                "value" => $categories
				            ),
				            array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Font Icon', 'entaro' ),
								'param_name' => 'font_icon',
							),
							array(
								"type" => "attach_image",
								"heading" => esc_html__('Image Icon', 'entaro'),
								"param_name" => "image_icon"
							),
							array(
								"type" => "attach_image",
								"heading" => esc_html__('Image Icon (Hover)', 'entaro'),
								"param_name" => "image_icon_hover"
							),
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Columns", 'entaro'),
						"param_name" => "columns",
						'value' => $columns
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default White', 'entaro') => 'default', 
							esc_html__('Style 1', 'entaro') => 'style1', 
							esc_html__('Style 2 (white)', 'entaro') => 'style2',
							esc_html__('Style 3 (circle)', 'entaro') => 'style3',
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

			// companies
			$companies = array();
			if ( is_admin() ) {
				$opts = Entaro_Job_Manager_Company::get_companies();
				if ( !empty($opts) && is_array($opts) ) {
					foreach ($opts as $opt) {
						$companies[$opt] = $opt;
					}
				}
			}
			vc_map( array(
				'name'        => esc_html__( 'Apus Job Companies','entaro'),
				'base'        => 'apus_job_companies',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show jobs companies in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Category Settings', 'entaro' ),
						'param_name' => 'companies',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Title', 'entaro' ),
								'param_name' => 'title',
							),
				            array(
				                "type" => "dropdown",
				                "heading" => esc_html__('Job Company', 'entaro'),
				                "param_name" => 'company',
				                "value" => $companies
				            ),
				            array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Location', 'entaro' ),
								'param_name' => 'location',
							),
							array(
								"type" => "attach_image",
								"heading" => esc_html__('Logo', 'entaro'),
								"param_name" => "logo"
							),
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Columns", 'entaro'),
						"param_name" => "columns",
						'value' => $columns
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'entaro'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Grid', 'entaro') => 'grid', 
							esc_html__('Carousel', 'entaro') => 'carousel', 
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Widget Style", 'entaro'),
						"param_name" => "widget_style",
						'value' 	=> array(
							esc_html__('Default', 'entaro') => 'default', 
							esc_html__('Style 1', 'entaro') => 'style1', 
							esc_html__('Style 2', 'entaro') => 'style2', 
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
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus List Companies','entaro'),
				'base'        => 'apus_job_list_companies',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show jobs list companies in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Filter By Alphabet', 'entaro' ),
						'param_name' => 'show_filter_alphabet',
						'value' => array( esc_html__( 'Yes, to show Filter By Alphabet', 'entaro' ) => 'yes' ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Number Columns", 'entaro'),
						"param_name" => "columns",
						'value' => $columns
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));

			vc_map( array(
				'name'        => esc_html__( 'Apus List Categories','entaro'),
				'base'        => 'apus_job_list_categories',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show list categories in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number Jobs', 'entaro' ),
						'param_name' => 'posts_per_page',
						'value' => 4
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

			vc_map( array(
				'name'        => esc_html__( 'Apus List Locations','entaro'),
				'base'        => 'apus_job_list_locations',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show list locations in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number Jobs', 'entaro' ),
						'param_name' => 'posts_per_page',
						'value' => 4
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Location Title Prefix', 'entaro' ),
						'param_name' => 'prefix_title',
						'value' => 'Jobs in'
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
			$menus = array( esc_html__('Choose a menu', 'entaro') => '' );
		    if ( is_admin() ) {
		        $list_menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
		        if ( is_array( $list_menus ) && ! empty( $list_menus ) ) {
		            foreach ( $list_menus as $single_menu ) {
		                if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
		                    $menus[ $single_menu->name ] = $single_menu->slug;
		                }
		            }
		        }
		    }
			vc_map( array(
				'name'        => esc_html__( 'Apus Search Form','entaro'),
				'base'        => 'apus_job_search_form',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show search form in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textarea',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'entaro' ),
						"param_name" => "des",
						'description' => esc_html__( 'Enter description for title.', 'entaro' )
				    ),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Keywords Field', 'entaro' ),
						'param_name' => 'search_keyword',
						'value' => array( esc_html__( 'Yes, to show keyword', 'entaro' ) => 'yes' ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Show Location Region Field", 'entaro'),
						"param_name" => "search_region_location",
						'value' 	=> array(
							esc_html__('Hidden', 'entaro') => 'hidden', 
							esc_html__('Location', 'entaro') => 'location', 
							esc_html__('Region', 'entaro') => 'region', 
						),
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Category Field', 'entaro' ),
						'param_name' => 'search_category',
						'value' => array( esc_html__( 'Yes, to show Category', 'entaro' ) => 'yes' ),
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Type Field', 'entaro' ),
						'param_name' => 'search_type',
						'value' => array( esc_html__( 'Yes, to show Type', 'entaro' ) => 'yes' ),
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Trending Keywords', 'entaro' ),
						'param_name' => 'search_trending_keyword',
						'value' => array( esc_html__( 'Yes, to show trending keyword', 'entaro' ) => 'yes' ),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Suggestion Menu", 'entaro'),
						"param_name" => "suggestion_menu",
						'value' 	=> $menus,
						'dependency' => array(
							'element' => 'search_trending_keyword',
							'value' => array('yes'),
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout", 'entaro'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Horizontal', 'entaro') => 'horizontal',
							esc_html__('Vertical', 'entaro') => 'vertical',
							esc_html__('Vertical Fix', 'entaro') => 'vertical p_fix',
							esc_html__('Half 1', 'entaro') => 'half',
							esc_html__('Half 2', 'entaro') => 'half style_2',
						),
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style Color", 'entaro'),
						"param_name" => "color_style",
						'value' 	=> array(
							esc_html__('Default', 'entaro') => '',
							esc_html__('White', 'entaro') => 'white',
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

			vc_map( array(
				'name'        => esc_html__( 'Apus Job Favorites','entaro'),
				'base'        => 'apus_job_favorites',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show job favorites in frontend', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'entaro' ),
						'param_name' => 'title',
						'admin_label' => true,
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));
			$map_styles = array( esc_html__('Choose a map style', 'entaro') => '' );
			if ( is_admin() && class_exists('Entaro_Google_Maps_Styles') ) {
				$styles = Entaro_Google_Maps_Styles::styles();
				foreach ($styles as $style) {
					$map_styles[$style['title']] = $style['slug'];
				}
			}
			vc_map( array(
				'name'        => esc_html__( 'Apus Jobs Map','entaro'),
				'base'        => 'apus_jobs_map',
				"category" => esc_html__('Apus Jobs', 'entaro'),
				'description' => esc_html__( 'Show jobs map in frontend', 'entaro' ),
				"params"      => array(
					
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Get Jobs By', 'entaro'),
		                "param_name" => 'get_job_by',
		                "value" => array(
		                	esc_html__('Recent Jobs', 'entaro') => 'recent',
		                	esc_html__('Popular Jobs', 'entaro') => 'popular',
		                	esc_html__('Featured Jobs', 'entaro') => 'featured',
	                	),
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Job Type', 'entaro'),
		                "param_name" => 'types',
		                "value" => $types
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Job Category', 'entaro'),
		                "param_name" => 'category',
		                "value" => $categories
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Job Region', 'entaro'),
		                "param_name" => 'region',
		                "value" => $regions
		            ),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Number Jobs', 'entaro' ),
						'param_name' => 'posts_per_page',
						'value' => 4
					),
					array(
						"type" => "attach_image",
						"heading" => esc_html__("Custom Marker Icon", 'entaro'),
						"param_name" => "marker_icon"
					),
					array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Custom Map Style', 'entaro' ),
		                'param_name' => 'map_style',
		                'value' => $map_styles
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
	add_action( 'vc_after_set_mode', 'entaro_load_job_manager_element', 99 );

	class WPBakeryShortCode_apus_jobs extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_jobs_spotlight extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_jobs_tabs extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_job_categories extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_job_companies extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_job_list_companies extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_job_list_categories extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_job_list_locations extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_job_search_form extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_job_favorites extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_jobs_map extends WPBakeryShortCode {}
}