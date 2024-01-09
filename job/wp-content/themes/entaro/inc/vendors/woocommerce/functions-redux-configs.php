<?php

// Shop Archive settings
function entaro_woocommerce_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'icon' => 'el el-shopping-cart',
        'title' => esc_html__('Woocommerce', 'entaro'),
        'fields' => array(
            array(
                'id' => 'show_product_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'entaro'),
                'default' => 1
            ),
            array (
                'title' => esc_html__('Breadcrumbs Background Color', 'entaro'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'entaro').'</em>',
                'id' => 'woo_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'woo_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'entaro'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'entaro'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'subsection' => true,
        'title' => esc_html__('Product Archives', 'entaro'),
        'fields' => array(
            array(
                'id' => 'product_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Product Layout', 'entaro'),
                'subtitle' => esc_html__('Select the layout you want to apply on your archive product page.', 'entaro'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Content', 'entaro'),
                        'alt' => esc_html__('Main Content', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left Sidebar - Main Content', 'entaro'),
                        'alt' => esc_html__('Left Sidebar - Main Content', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main Content - Right Sidebar', 'entaro'),
                        'alt' => esc_html__('Main Content - Right Sidebar', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                    'left-main-right' => array(
                        'title' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'entaro'),
                        'alt' => esc_html__('Left Sidebar - Main Content - Right Sidebar', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                    ),
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'product_archive_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'entaro'),
                'default' => false
            ),
            array(
                'id' => 'product_archive_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            array(
                'id' => 'product_archive_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            array(
                'id' => 'product_display_mode',
                'type' => 'select',
                'title' => esc_html__('Display Mode', 'entaro'),
                'subtitle' => esc_html__('Choose a default layout archive product.', 'entaro'),
                'options' => array('grid' => esc_html__('Grid', 'entaro'), 'list' => esc_html__('List', 'entaro')),
                'default' => 'grid'
            ),
            array(
                'id' => 'number_products_per_page',
                'type' => 'text',
                'title' => esc_html__('Number of Products Per Page', 'entaro'),
                'default' => 12,
                'min' => '1',
                'step' => '1',
                'max' => '100',
                'type' => 'slider'
            ),
            array(
                'id' => 'product_columns',
                'type' => 'select',
                'title' => esc_html__('Product Columns', 'entaro'),
                'options' => $columns,
                'default' => 4
            ),
            array(
                'id' => 'show_quickview',
                'type' => 'switch',
                'title' => esc_html__('Show Quick View', 'entaro'),
                'default' => 1
            ),
            array(
                'id' => 'show_swap_image',
                'type' => 'switch',
                'title' => esc_html__('Show Second Image (Hover)', 'entaro'),
                'default' => 1
            ),
        )
    );
    
        
    $sections[] = array(
        'subsection' => true,
        'title' => esc_html__('Single Product', 'entaro'),
        'fields' => array(
            array(
                'id' => 'product_single_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Product Layout', 'entaro'),
                'subtitle' => esc_html__('Select the layout you want to apply on your Single Product Page.', 'entaro'),
                'options' => array(
                    'main' => array(
                        'title' => esc_html__('Main Only', 'entaro'),
                        'alt' => esc_html__('Main Only', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen1.png'
                    ),
                    'left-main' => array(
                        'title' => esc_html__('Left - Main Sidebar', 'entaro'),
                        'alt' => esc_html__('Left - Main Sidebar', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen2.png'
                    ),
                    'main-right' => array(
                        'title' => esc_html__('Main - Right Sidebar', 'entaro'),
                        'alt' => esc_html__('Main - Right Sidebar', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen3.png'
                    ),
                    'left-main-right' => array(
                        'title' => esc_html__('Left - Main - Right Sidebar', 'entaro'),
                        'alt' => esc_html__('Left - Main - Right Sidebar', 'entaro'),
                        'img' => get_template_directory_uri() . '/inc/assets/images/screen4.png'
                    ),
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'product_single_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'entaro'),
                'default' => false
            ),
            array(
                'id' => 'product_single_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Product Left Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            array(
                'id' => 'product_single_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Product Right Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            array(
                'id' => 'show_product_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'entaro'),
                'default' => 1
            ),
            array(
                'id' => 'show_product_review_tab',
                'type' => 'switch',
                'title' => esc_html__('Show Product Review Tab', 'entaro'),
                'default' => 1
            ),
            array(
                'id' => 'number_product_releated',
                'title' => esc_html__('Number of related/upsells products to show', 'entaro'),
                'default' => 4,
                'min' => '1',
                'step' => '1',
                'max' => '20',
                'type' => 'slider'
            ),
            array(
                'id' => 'releated_product_columns',
                'type' => 'select',
                'title' => esc_html__('Releated Products Columns', 'entaro'),
                'options' => $columns,
                'default' => 4
            ),

        )
    );
    
    return $sections;
}
add_filter( 'entaro_redux_framwork_configs', 'entaro_woocommerce_redux_config', 20, 3 );