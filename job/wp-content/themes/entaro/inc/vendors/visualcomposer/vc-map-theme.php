<?php
if ( function_exists('vc_map') && class_exists('WPBakeryShortCode') ) {
	// custom wp
	$attributes = array(
	    'type' => 'dropdown',
	    'heading' => "Style Element",
	    'param_name' => 'style',
	    'value' => array( "one", "two", "three" ),
	    'description' => esc_html__( "New style attribute", "entaro" )
	);
	vc_add_param( 'vc_facebook', $attributes ); // Note: 'vc_message' was used as a base for "Message box" element

	if ( !function_exists('entaro_load_load_theme_element')) {
		function entaro_load_load_theme_element() {
			$columns = array(1,2,3,4,6);
			// Heading Text Block
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Heading','entaro'),
				'base'        => 'apus_title_heading',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'entaro'),
				'description' => esc_html__( 'Create title for one Widget', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textarea',
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
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'entaro') => '', 
							esc_html__('White', 'entaro') => 'style_white',
							esc_html__('White Center', 'entaro') => 'style_white st_center',
							esc_html__('Dark Center', 'entaro') => 'st_dark st_center',
						),
						'std' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));
			
			// calltoaction
			vc_map( array(
				'name'        => esc_html__( 'Apus Widget Call To Action','entaro'),
				'base'        => 'apus_call_action',
				"class"       => "",
				"category" => esc_html__('Apus Elements', 'entaro'),
				'description' => esc_html__( 'Create title for one Widget', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Widget title', 'entaro' ),
						'param_name' => 'title',
						'value'       => esc_html__( 'Title', 'entaro' ),
						'description' => esc_html__( 'Enter heading title.', 'entaro' ),
						"admin_label" => true
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Sub title', 'entaro' ),
						'param_name' => 'subtitle',
						'description' => esc_html__( 'Enter Sub title.', 'entaro' ),
						"admin_label" => true
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'entaro' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'entaro' )
				    ),

				    array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button 1', 'entaro' ),
						'param_name' => 'textbutton1',
						'description' => esc_html__( 'Text Button', 'entaro' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button 1', 'entaro' ),
						'param_name' => 'linkbutton1',
						'description' => esc_html__( 'Link Button 1', 'entaro' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'entaro'),
						"param_name" => "buttons1",
						'value' 	=> array(
							esc_html__('Default ', 'entaro') => 'btn-default ', 
							esc_html__('Primary ', 'entaro') => 'btn-primary ', 
							esc_html__('Success ', 'entaro') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'entaro') => 'btn-info ', 
							esc_html__('Warning ', 'entaro') => 'btn-warning ', 
							esc_html__('Theme Color ', 'entaro') => 'btn-theme',
							esc_html__('Theme Gradient Color ', 'entaro') => 'btn-theme btn-gradient',
							esc_html__('Second Color ', 'entaro') => 'btn-theme-second',
							esc_html__('Danger ', 'entaro') => 'btn-danger ', 
							esc_html__('Pink ', 'entaro') => 'btn-pink ', 
							esc_html__('White Gradient ', 'entaro') => 'btn-white btn-gradient', 
							esc_html__('Primary Outline', 'entaro') => 'btn-primary btn-outline', 
							esc_html__('White Outline ', 'entaro') => 'btn-white btn-outline ',
							esc_html__('Theme Outline ', 'entaro') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Text Button 2', 'entaro' ),
						'param_name' => 'textbutton2',
						'description' => esc_html__( 'Text Button', 'entaro' ),
						"admin_label" => true
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( ' Link Button 2', 'entaro' ),
						'param_name' => 'linkbutton2',
						'description' => esc_html__( 'Link Button 2', 'entaro' ),
						"admin_label" => true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Button Style", 'entaro'),
						"param_name" => "buttons2",
						'value' 	=> array(
							esc_html__('Default ', 'entaro') => 'btn-default ', 
							esc_html__('Primary ', 'entaro') => 'btn-primary ', 
							esc_html__('Success ', 'entaro') => 'btn-success radius-0 ', 
							esc_html__('Info ', 'entaro') => 'btn-info ', 
							esc_html__('Warning ', 'entaro') => 'btn-warning ', 
							esc_html__('Theme Color ', 'entaro') => 'btn-theme',
							esc_html__('Second Color ', 'entaro') => 'btn-theme-second',
							esc_html__('Danger ', 'entaro') => 'btn-danger ', 
							esc_html__('Pink ', 'entaro') => 'btn-pink ', 
							esc_html__('White Gradient ', 'entaro') => 'btn-white btn-gradient',
							esc_html__('Primary Outline', 'entaro') => 'btn-primary btn-outline', 
							esc_html__('White Outline ', 'entaro') => 'btn-white btn-outline ',
							esc_html__('Theme Outline ', 'entaro') => 'btn-theme btn-outline ',
						),
						'std' => ''
					),
					
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'entaro') => 'default',
							esc_html__('Center', 'entaro') => 'default center',
						),
						'std' => ''
					),

					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					)
				),
			));
			
			// Apus Counter
			vc_map( array(
			    "name" => esc_html__("Apus Counter",'entaro'),
			    "base" => "apus_counter",
			    "class" => "",
			    "description"=> esc_html__('Counting number with your term', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
			    		'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'entaro' ),
						'param_name' => 'members',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "textfield",
								"heading" => esc_html__("Title", 'entaro'),
								"param_name" => "title",
								"value" => '',
								"admin_label"	=> true
							),
							array(
								"type" => "textfield",
								"heading" => esc_html__("Number", 'entaro'),
								"param_name" => "number",
								"value" => ''
							),
							array(
								"type" => "textfield",
								"heading" => esc_html__("Prefix Number", 'entaro'),
								"param_name" => "prefix",
								"value" => ''
							),
							array(
								"type" => "colorpicker",
								"heading" => esc_html__("Color Text", 'entaro'),
								"param_name" => "text_color",
								'value' 	=> '',
							),
							array(
								"type" => "colorpicker",
								"heading" => esc_html__("Background Color", 'entaro'),
								"param_name" => "bg_color",
								'value' 	=> '',
							),
						),
			    	),
			    	array(
		                "type" => "textfield",
		                "heading" => esc_html__('Columns','entaro'),
		                "param_name" => 'columns',
		                "value" => 1,
		            ),
		            array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'entaro') => '',
						),
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));
			// Banner CountDown
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner CountDown','entaro'),
				'base'        => 'apus_banner_countdown',
				"category" => esc_html__('Apus Elements', 'entaro'),
				'description' => esc_html__( 'Show CountDown with banner', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textarea_html',
						'heading' => esc_html__( 'Widget title', 'entaro' ),
						'param_name' => 'content',
					),
					array(
						"type" => "textarea",
						'heading' => esc_html__( 'Description', 'entaro' ),
						"param_name" => "descript",
						'description' => esc_html__( 'Enter description for title.', 'entaro' )
				    ),
					array(
					    'type' => 'textfield',
					    'heading' => esc_html__( 'Date Expired', 'entaro' ),
					    'param_name' => 'input_datetime'
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Url', 'entaro' ),
						'param_name' => 'btn_url',
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Button Text', 'entaro' ),
						'param_name' => 'btn_text',
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style_widget",
						'value' 	=> array(
							esc_html__('Light', 'entaro') => 'light',
							esc_html__('Dark', 'entaro') => 'dark',
						),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					),
				),
			));
			// Banner
			vc_map( array(
				'name'        => esc_html__( 'Apus Banner','entaro'),
				'base'        => 'apus_banner',
				"category" => esc_html__('Apus Elements', 'entaro'),
				'description' => esc_html__( 'Show banner in FrontEnd', 'entaro' ),
				"params"      => array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'title', 'entaro' ),
						'param_name' => 'title',
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Content', 'entaro' ),
						"param_name" => "content",
						'description' => esc_html__( 'Enter description for title.', 'entaro' )
				    ),
				    array(
						"type" => "attach_image",
						"heading" => esc_html__("Banner Image", 'entaro'),
						"param_name" => "image"
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Url', 'entaro' ),
						'param_name' => 'url',
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Button', 'entaro' ),
						'param_name' => 'show_btn',
						'value' => array( esc_html__( 'Yes, to show Button', 'entaro' ) => 'yes' ),
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
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Default', 'entaro') => '', 
							esc_html__('Medium', 'entaro') => ' medium', 
							esc_html__('Banner Big Center', 'entaro') => ' banner-big', 
							esc_html__('Banner Medium Center', 'entaro') => ' banner-medium', 
							esc_html__('Banner Dark', 'entaro') => ' banner-dark', 
						),
						'std' => ''
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Extra class name', 'entaro' ),
						'param_name' => 'el_class',
						'description' => esc_html__( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'entaro' )
					),
				),
			));
			// Apus Brands
			vc_map( array(
			    "name" => esc_html__("Apus Brands",'entaro'),
			    "base" => "apus_brands",
			    "class" => "",
			    "description"=> esc_html__('Display brands on front end', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Number", 'entaro'),
						"param_name" => "number",
						"value" => ''
					),
				 	array(
						"type" => "dropdown",
						"heading" => esc_html__("Layout Type", 'entaro'),
						"param_name" => "layout_type",
						'value' 	=> array(
							esc_html__('Carousel', 'entaro') => 'carousel', 
							esc_html__('Grid', 'entaro') => 'grid'
						),
						'std' => ''
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','entaro'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,6),
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));
			
			vc_map( array(
			    "name" => esc_html__("Apus Socials link",'entaro'),
			    "base" => "apus_socials_link",
			    "description"=> esc_html__('Show socials link', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'entaro'),
						"param_name" => "description",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Facebook Page URL", 'entaro'),
						"param_name" => "facebook_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Twitter Page URL", 'entaro'),
						"param_name" => "twitter_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Youtube Page URL", 'entaro'),
						"param_name" => "youtube_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Pinterest Page URL", 'entaro'),
						"param_name" => "pinterest_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Google Plus Page URL", 'entaro'),
						"param_name" => "google-plus_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Instagram Page URL", 'entaro'),
						"param_name" => "instagram_url",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Align", 'entaro'),
						"param_name" => "align",
						'value' 	=> array(
							esc_html__('Left', 'entaro') => 'left', 
							esc_html__('Right', 'entaro') => 'right'
						),
						'std' => ''
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Normal', 'entaro') => '', 
							esc_html__('Small', 'entaro') => 'st_small',
							esc_html__('White', 'entaro') => 'st_white'
						),
						'std' => ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));
			// newsletter
			vc_map( array(
			    "name" => esc_html__("Apus Newsletter",'entaro'),
			    "base" => "apus_newsletter",
			    "class" => "",
			    "description"=> esc_html__('Show newsletter form', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
						"type" => "textarea",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						"type" => "textarea",
						"heading" => esc_html__("Description", 'entaro'),
						"param_name" => "description",
						"value" => '',
					),
					array(
						"type" => "attach_image",
						"heading" => esc_html__("Image for Item", 'entaro'),
						"param_name" => "image",
					),
					array(
						"type" => "dropdown",
						"heading" => esc_html__("Style", 'entaro'),
						"param_name" => "style",
						'value' 	=> array(
							esc_html__('Style 1', 'entaro') => '', 
							esc_html__('Style 2', 'entaro') => 'st_2',
							esc_html__('Style 3', 'entaro') => 'st_3',
						),
						'std' => ''
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));
			// REGISTER Team  
			vc_map( array(
			    "name" => esc_html__("Apus Register Team",'entaro'),
			    "base" => "apus_register",
			    "class" => "",
			    "description"=> esc_html__('Show Register', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'entaro' ),
						'param_name' => 'members',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Image Background", 'entaro'),
								"param_name" => "image",
							),
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Image Icon", 'entaro'),
								"param_name" => "image_icon",
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','entaro'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Price','entaro'),
				                "param_name" => "price",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Short Description','entaro'),
				                "param_name" => "des",
				            ),
				            array(
								"type" => "textfield",
								"heading" => esc_html__("Text Button", 'entaro'),
								"param_name" => "text_link",
							),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Link Register Button','entaro'),
				                "param_name" => "link",
				            ),
				            array(
				                "type" => "dropdown",
				                "heading" => esc_html__('Style','entaro'),
				                "param_name" => 'style',
				                'value' 	=> array(
									esc_html__('Style1 ', 'entaro') => 'style1', 
									esc_html__('Style2 ', 'entaro') => 'style2', 
								),
								'std' => ''
				            ),
						),
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Text Space','entaro'),
		                "param_name" => "space",
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style','entaro'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Medium ', 'entaro') => '', 
							esc_html__('Large ', 'entaro') => 'large', 
						),
						'std' => ''
		            ),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Columns','entaro'),
		                "param_name" => "columns",
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));

			// Address
			vc_map( array(
			    "name" => esc_html__("Apus Service",'entaro'),
			    "base" => "apus_service",
			    "class" => "",
			    "description"=> esc_html__('Show Service', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'entaro' ),
						'param_name' => 'members',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Image for Item", 'entaro'),
								"param_name" => "image",
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','entaro'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Short Description','entaro'),
				                "param_name" => "des",
				            ),
						),
					),
					array(
		                "type" => "textfield",
		                "class" => "",
		                "heading" => esc_html__('Columns','entaro'),
		                "param_name" => "columns",
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style','entaro'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Vertical ', 'entaro') => '', 
							esc_html__('Horizontal', 'entaro') => 'horizontal',
							esc_html__('Horizontal white', 'entaro') => 'horizontal st-white',
						),
						'std' => ''
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));

			// Widget contact
			vc_map( array(
	            "name" => esc_html__("Apus Contact",'entaro'),
	            "base" => "apus_contact",
	            'description'=> esc_html__('Display Contact In FrontEnd', 'entaro'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'entaro'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Address Settings', 'entaro' ),
						'param_name' => 'address',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Icon','entaro'),
				                "param_name" => "icon",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','entaro'),
				                "param_name" => "des",
				            ),
						),
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Socials Settings', 'entaro' ),
						'param_name' => 'socials',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Icon','entaro'),
				                "param_name" => "icon",
				            ),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Link','entaro'),
				                "param_name" => "link",
				            ),
						),
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
	            )
	        ));

			// google map
			$map_styles = array( esc_html__('Choose a map style', 'entaro') => '' );
			if ( is_admin() && class_exists('Entaro_Google_Maps_Styles') ) {
				$styles = Entaro_Google_Maps_Styles::styles();
				foreach ($styles as $style) {
					$map_styles[$style['title']] = $style['slug'];
				}
			}
			vc_map( array(
			    "name" => esc_html__("Apus Google Map",'entaro'),
			    "base" => "apus_googlemap",
			    "description" => esc_html__('Diplay Google Map', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		                "type" => "textarea",
		                "class" => "",
		                "heading" => esc_html__('Description','entaro'),
		                "param_name" => "des",
		            ),
		            array(
		                'type' => 'googlemap',
		                'heading' => esc_html__( 'Location', 'entaro' ),
		                'param_name' => 'location',
		                'value' => ''
		            ),
		            array(
		                'type' => 'hidden',
		                'heading' => esc_html__( 'Latitude Longitude', 'entaro' ),
		                'param_name' => 'lat_lng',
		                'value' => '21.0173222,105.78405279999993'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Map height", 'entaro'),
						"param_name" => "height",
						"value" => '',
					),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Map Zoom", 'entaro'),
						"param_name" => "zoom",
						"value" => '13',
					),
		            array(
		                'type' => 'dropdown',
		                'heading' => esc_html__( 'Map Type', 'entaro' ),
		                'param_name' => 'type',
		                'value' => array(
		                    esc_html__( 'roadmap', 'entaro' ) 		=> 'ROADMAP',
		                    esc_html__( 'hybrid', 'entaro' ) 	=> 'HYBRID',
		                    esc_html__( 'satellite', 'entaro' ) 	=> 'SATELLITE',
		                    esc_html__( 'terrain', 'entaro' ) 	=> 'TERRAIN',
		                )
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
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));
			// Testimonial
			vc_map( array(
	            "name" => esc_html__("Apus Testimonials",'entaro'),
	            "base" => "apus_testimonials",
	            'description'=> esc_html__('Display Testimonials In FrontEnd', 'entaro'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'entaro'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Title Color','entaro'),
		                "param_name" => 'title_color',
		                'value' 	=> array(
							esc_html__('Dark ', 'entaro') => '', 
							esc_html__('White', 'entaro') => 'st_white',
						),
						'std' => ''
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Title Align','entaro'),
		                "param_name" => 'title_align',
		                'value' 	=> array(
							esc_html__('Inherit ', 'entaro') => '', 
							esc_html__('Center', 'entaro') => 'st_center',
						),
						'std' => ''
		            ),
	              	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'entaro'),
		              	"param_name" => "number",
		              	"value" => '4',
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','entaro'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout','entaro'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default ', 'entaro') => '', 
							esc_html__('White left', 'entaro') => 'v1',
							esc_html__('White Center', 'entaro') => 'v2',
							esc_html__('White Left Version 2', 'entaro') => 'v3',
							esc_html__('Box White', 'entaro') => 'v4',
						),
						'std' => ''
		            ),
		            array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Button Nav', 'entaro' ),
						'param_name' => 'show_nav',
						'value' => array( esc_html__( 'Yes, to show Button', 'entaro' ) => 'yes' ),
					),
					array(
						'type' => 'checkbox',
						'heading' => esc_html__( 'Show Button Pagination', 'entaro' ),
						'param_name' => 'show_pag',
						'value' => array( esc_html__( 'Yes, to show Button', 'entaro' ) => 'yes' ),
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
	            )
	        ));
	        // Our Team
			vc_map( array(
	            "name" => esc_html__("Apus Our Team",'entaro'),
	            "base" => "apus_ourteam",
	            'description'=> esc_html__('Display Our Team In FrontEnd', 'entaro'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'entaro'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
	              	array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'entaro' ),
						'param_name' => 'members',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Name','entaro'),
				                "param_name" => "name",
				            ),
				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Short Description','entaro'),
				                "param_name" => "des",
				            ),
							array(
								"type" => "attach_image",
								"heading" => esc_html__("Image", 'entaro'),
								"param_name" => "image"
							),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Facebook','entaro'),
				                "param_name" => "facebook",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Twitter Link','entaro'),
				                "param_name" => "twitter",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Google plus Link','entaro'),
				                "param_name" => "google",
				            ),

				            array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Linkin Link','entaro'),
				                "param_name" => "linkin",
				            ),

						),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','entaro'),
		                "param_name" => 'columns',
		                "value" => array(1,2,3,4,5,6),
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
	            )
	        ));

	        // Gallery Images
			vc_map( array(
	            "name" => esc_html__("Apus Gallery",'entaro'),
	            "base" => "apus_gallery",
	            'description'=> esc_html__('Display Gallery In FrontEnd', 'entaro'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'entaro'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__('Images', 'entaro'),
						'param_name' => 'images',
						'params' => array(
							array(
								"type" => "attach_image",
								"param_name" => "image",
								'heading'	=> esc_html__('Image', 'entaro')
							),
							array(
				                "type" => "textfield",
				                "heading" => esc_html__('Title','entaro'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "heading" => esc_html__('Description','entaro'),
				                "param_name" => "description",
				            ),
						),
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Columns','entaro'),
		                "param_name" => 'columns',
		                "value" => $columns,
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','entaro'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
							esc_html__('Grid', 'entaro') => 'grid', 
							esc_html__('Mansory 1', 'entaro') => 'mansory',
							esc_html__('Mansory 2', 'entaro') => 'mansory2',
						),
						'std' => 'grid'
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Gutter Elements','entaro'),
		                "param_name" => 'gutter',
		                'value' 	=> array(
							esc_html__('Default ', 'entaro') => '', 
							esc_html__('Gutter 30', 'entaro') => 'gutter30',
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("View More", 'entaro'),
						"param_name" => "link",
						"value" => '',
					),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
	            )
	        ));
	        // Gallery Video
			vc_map( array(
	            "name" => esc_html__("Apus Video",'entaro'),
	            "base" => "apus_video",
	            'description'=> esc_html__('Display Video In FrontEnd', 'entaro'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'entaro'),
	            "params" => array(
	              	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
						"type" => "textarea_html",
						'heading' => esc_html__( 'Description', 'entaro' ),
						"param_name" => "content",
						"value" => '',
						'description' => esc_html__( 'Enter description for title.', 'entaro' )
				    ),
	              	array(
						"type" => "attach_image",
						"heading" => esc_html__("Icon Play Image", 'entaro'),
						"param_name" => "image"
					),
					array(
		                "type" => "textfield",
		                "heading" => esc_html__('Youtube Video Link','entaro'),
		                "param_name" => 'video_link'
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
	            )
	        ));
	        // Features Box
			vc_map( array(
	            "name" => esc_html__("Apus Features Box",'entaro'),
	            "base" => "apus_features_box",
	            'description'=> esc_html__('Display Features In FrontEnd', 'entaro'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'entaro'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
					    "type" => "dropdown",
					    "heading" => esc_html__('Title Color','entaro'),
					    "param_name" => 'title_color',
					    'value' 	=> array(
							esc_html__('Dark ', 'entaro') => '', 
							esc_html__('White', 'entaro') => 'st_white',
						),
						'std' => ''
					),
					array(
					    "type" => "dropdown",
					    "heading" => esc_html__('Title Align','entaro'),
					    "param_name" => 'title_align',
					    'value' 	=> array(
							esc_html__('Inherit ', 'entaro') => '', 
							esc_html__('Center', 'entaro') => 'st_center',
						),
						'std' => ''
					),

					array(
						'type' => 'param_group',
						'heading' => esc_html__('Members Settings', 'entaro' ),
						'param_name' => 'items',
						'description' => '',
						'value' => '',
						'params' => array(
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image for box.", 'entaro'),
								"param_name" => "image",
								"value" => '',
								'heading'	=> esc_html__('Image', 'entaro' )
							),
							array(
								"type" => "attach_image",
								"description" => esc_html__("Image Hover for box.", 'entaro'),
								"param_name" => "image_hover",
								"value" => '',
								'heading'	=> esc_html__('Image Hover', 'entaro' )
							),
							array(
								"type" => "textfield",
								"heading" => esc_html__("Material Design Icon and Awesome Icon", 'entaro'),
								"param_name" => "icon",
								"value" => '',
								'description' => esc_html__( 'This support display icon from Awesome Icon, Please click', 'entaro' )
												. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fontawesome.io/" target="_blank">'
												. esc_html__( 'here to see the list', 'entaro' ) . '</a>'
							),
							array(
				                "type" => "textfield",
				                "class" => "",
				                "heading" => esc_html__('Title','entaro'),
				                "param_name" => "title",
				            ),
				            array(
				                "type" => "textarea",
				                "class" => "",
				                "heading" => esc_html__('Description','entaro'),
				                "param_name" => "description",
				            ),
						),
					),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'entaro'),
		              	"param_name" => "columns",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Style Layout','entaro'),
		                "param_name" => 'style',
		                'value' 	=> array(
							esc_html__('Default', 'entaro') => 'default', 
							esc_html__('Title Center', 'entaro') => 'title_center', 
							esc_html__('Left', 'entaro') => 'st_left', 
							esc_html__('White', 'entaro') => 'st_white', 
							esc_html__('Hover Bg Theme', 'entaro') => 'st_bg', 
						),
						'std' => ''
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
	            )
	        ));
			
			$custom_menus = array();
			if ( is_admin() ) {
				$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
				if ( is_array( $menus ) && ! empty( $menus ) ) {
					foreach ( $menus as $single_menu ) {
						if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
							$custom_menus[ $single_menu->name ] = $single_menu->slug;
						}
					}
				}
			}
			// Menu
			vc_map( array(
			    "name" => esc_html__("Apus Custom Menu",'entaro'),
			    "base" => "apus_custom_menu",
			    "class" => "",
			    "description"=> esc_html__('Show Custom Menu', 'entaro'),
			    "category" => esc_html__('Apus Elements', 'entaro'),
			    "params" => array(
			    	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"value" => '',
						"admin_label"	=> true
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__( 'Menu', 'entaro' ),
						'param_name' => 'nav_menu',
						'value' => $custom_menus,
						'description' => empty( $custom_menus ) ? esc_html__( 'Custom menus not found. Please visit Appearance > Menus page to create new menu.', 'entaro' ) : esc_html__( 'Select menu to display.', 'entaro' ),
						'admin_label' => true,
						'save_always' => true,
					),
					array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Align','entaro'),
		                "param_name" => 'align',
		                'value' 	=> array(
							esc_html__('Inherit', 'entaro') => '', 
							esc_html__('Left', 'entaro') => 'left', 
							esc_html__('Right', 'entaro') => 'right', 
							esc_html__('Center', 'entaro') => 'center', 
							esc_html__('Inline Right', 'entaro') => 'st_inline', 
						),
						'std' => ''
		            ),
					array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
			   	)
			));

			vc_map( array(
	            "name" => esc_html__("Apus Instagram",'entaro'),
	            "base" => "apus_instagram",
	            'description'=> esc_html__('Display Instagram In FrontEnd', 'entaro'),
	            "class" => "",
	            "category" => esc_html__('Apus Elements', 'entaro'),
	            "params" => array(
	            	array(
						"type" => "textfield",
						"heading" => esc_html__("Title", 'entaro'),
						"param_name" => "title",
						"admin_label" => true,
						"value" => '',
					),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Instagram Username", 'entaro'),
		              	"param_name" => "username",
		            ),
					array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number", 'entaro'),
		              	"param_name" => "number",
		              	'value' => '1',
		            ),
	             	array(
		              	"type" => "textfield",
		              	"heading" => esc_html__("Number Columns", 'entaro'),
		              	"param_name" => "columns",
		              	'value' => '1',
		            ),
		           	array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Layout Type','entaro'),
		                "param_name" => 'layout_type',
		                'value' 	=> array(
							esc_html__('Grid', 'entaro') => 'grid', 
							esc_html__('Carousel', 'entaro') => 'carousel', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Photo size','entaro'),
		                "param_name" => 'size',
		                'value' 	=> array(
							esc_html__('Thumbnail', 'entaro') => 'thumbnail', 
							esc_html__('Small', 'entaro') => 'small', 
							esc_html__('Large', 'entaro') => 'large', 
							esc_html__('Original', 'entaro') => 'original', 
						)
		            ),
		            array(
		                "type" => "dropdown",
		                "heading" => esc_html__('Open links in','entaro'),
		                "param_name" => 'target',
		                'value' 	=> array(
							esc_html__('Current window (_self)', 'entaro') => '_self', 
							esc_html__('New window (_blank)', 'entaro') => '_blank',
						)
		            ),
		            array(
						"type" => "textfield",
						"heading" => esc_html__("Extra class name", 'entaro'),
						"param_name" => "el_class",
						"description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'entaro')
					)
	            )
	        ));
		}
	}
	add_action( 'vc_after_set_mode', 'entaro_load_load_theme_element', 99 );

	class WPBakeryShortCode_apus_title_heading extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_call_action extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_brands extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_socials_link extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_newsletter extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_googlemap extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_testimonials extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner_countdown extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_banner extends WPBakeryShortCode {}

	class WPBakeryShortCode_apus_counter extends WPBakeryShortCode {
		public function __construct( $settings ) {
			parent::__construct( $settings );
			$this->load_scripts();
		}

		public function load_scripts() {
			wp_register_script('jquery-counterup', get_template_directory_uri().'/js/jquery.counterup.min.js', array('jquery'), false, true);
		}
	}
	class WPBakeryShortCode_apus_ourteam extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_gallery extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_video extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_features_box extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_contact extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_custom_menu extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_instagram extends WPBakeryShortCode {}
	class WPBakeryShortCode_apus_register extends WPBakeryShortCode {}
}