<?php

if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {

    function entaro_get_post_categories() {
        $return = array( esc_html__(' --- Choose a Category --- ', 'entaro') => '' );

        $args = array(
            'type' => 'post',
            'child_of' => 0,
            'orderby' => 'name',
            'order' => 'ASC',
            'hide_empty' => false,
            'hierarchical' => 1,
            'taxonomy' => 'category'
        );

        $categories = get_categories( $args );
        entaro_get_post_category_childs( $categories, 0, 0, $return );

        return $return;
    }

    function entaro_get_post_category_childs( $categories, $id_parent, $level, &$dropdown ) {
        foreach ( $categories as $key => $category ) {
            if ( $category->category_parent == $id_parent ) {
                $dropdown = array_merge( $dropdown, array( str_repeat( "- ", $level ) . $category->name => $category->slug ) );
                unset($categories[$key]);
                entaro_get_post_category_childs( $categories, $category->term_id, $level + 1, $dropdown );
            }
        }
	}

	function entaro_load_post2_element() {
		$layouts = array(
			esc_html__('Grid', 'entaro') => 'grid',
			esc_html__('List', 'entaro') => 'list',
			esc_html__('Carousel', 'entaro') => 'carousel',
		);
		$columns = array(1,2,3,4,6);
		$categories = array();
		if ( is_admin() ) {
			$categories = entaro_get_post_categories();
		}
		vc_map( array(
			'name' => esc_html__( 'Apus Grid Posts', 'entaro' ),
			'base' => 'apus_gridposts',
			'icon' => 'icon-wpb-news-12',
			"category" => esc_html__('Apus Post', 'entaro'),
			'description' => esc_html__( 'Create Post having blog styles', 'entaro' ),
			'params' => array(
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Title', 'entaro' ),
					'param_name' => 'title',
					'description' => esc_html__( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'entaro' ),
					"admin_label" => true
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Category','entaro'),
	                "param_name" => 'category',
	                "value" => $categories
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Order By','entaro'),
	                "param_name" => 'orderby',
	                "value" => array(
	                	esc_html__('Date', 'entaro') => 'date',
	                	esc_html__('ID', 'entaro') => 'ID',
	                	esc_html__('Author', 'entaro') => 'author',
	                	esc_html__('Title', 'entaro') => 'title',
	                	esc_html__('Modified', 'entaro') => 'modified',
	                	esc_html__('Parent', 'entaro') => 'parent',
	                	esc_html__('Comment count', 'entaro') => 'comment_count',
	                	esc_html__('Menu order', 'entaro') => 'menu_order',
	                	esc_html__('Random', 'entaro') => 'rand',
	                )
	            ),
	            array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Sort order','entaro'),
	                "param_name" => 'order',
	                "value" => array(
	                	esc_html__('Descending', 'entaro') => 'DESC',
	                	esc_html__('Ascending', 'entaro') => 'ASC',
	                )
	            ),
	            array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Limit', 'entaro' ),
					'param_name' => 'posts_per_page',
					'description' => esc_html__( 'Enter limit posts.', 'entaro' ),
					'std' => 4,
					"admin_label" => true
				),
				array(
					'type' => 'checkbox',
					'heading' => esc_html__( 'Show Pagination?', 'entaro' ),
					'param_name' => 'show_pagination',
					'description' => esc_html__( 'Enables to show paginations to next new page.', 'entaro' ),
					'value' => array( esc_html__( 'Yes, to show pagination', 'entaro' ) => 'yes' )
				),
				array(
	                "type" => "dropdown",
	                "heading" => esc_html__('Grid Columns','entaro'),
	                "param_name" => 'grid_columns',
	                "value" => $columns
	            ),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Layout Type", 'entaro'),
					"param_name" => "layout_type",
					"value" => $layouts
				),
				array(
					"type" => "dropdown",
					"heading" => esc_html__("Item Style", 'entaro'),
					"param_name" => "style_item",
					'value' 	=> array(
						esc_html__('Grid 1', 'entaro') => '',
						esc_html__('Grid 2', 'entaro') => 'inner-grid-v3',
					),
					'dependency' => array(
						'element' => 'layout_type',
						'value' => array('grid','carousel'),
					),
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Thumbnail size', 'entaro' ),
					'param_name' => 'thumbsize',
					'description' => esc_html__( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'entaro' )
				),
				array(
					'type' => 'textfield',
					'heading' => esc_html__( 'Extra class name', 'entaro' ),
					'param_name' => 'el_class',
					'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
				)
			)
		) );
	}

	add_action( 'vc_after_set_mode', 'entaro_load_post2_element', 99 );

	class WPBakeryShortCode_apus_gridposts extends WPBakeryShortCode {}
}