<?php

// Shop Archive settings
function entaro_job_manager_redux_config($sections, $sidebars, $columns) {
    
    $sections[] = array(
        'title' => esc_html__('Job Settings', 'entaro'),
        'fields' => array(
            array (
                'id' => 'jobs_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Breadcrumbs Setting', 'entaro').'</h3>',
            ),
            array(
                'id' => 'show_jobs_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'entaro'),
                'default' => 1
            ),
            array (
                'title' => esc_html__('Breadcrumbs Background Color', 'entaro'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'entaro').'</em>',
                'id' => 'jobs_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'jobs_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'entaro'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'entaro'),
            ),
        )
    );
    // Archive settings
    $sections[] = array(
        'title' => esc_html__('Job Archives', 'entaro'),
        'subsection' => true,
        'fields' => array(
            array (
                'id' => 'jobs_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'entaro').'</h3>',
            ),
            array(
                'id' => 'jobs_display_mode',
                'type' => 'select',
                'title' => esc_html__('Display Mode', 'entaro'),
                'options' => array(
                    'grid' => esc_html__('Grid', 'entaro'),
                    'list' => esc_html__('List', 'entaro'),
                ),
                'default' => 'grid'
            ),
            array(
                'id' => 'jobs_columns',
                'type' => 'select',
                'title' => esc_html__('Jobs Columns', 'entaro'),
                'options' => $columns,
                'default' => 2,
                'required' => array('jobs_display_mode', '=', 'grid')
            ),
            array (
                'id' => 'jobs_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'entaro').'</h3>',
            ),
            array(
                'id' => 'jobs_archive_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'entaro'),
                'default' => false
            ),
            array(
                'id' => 'jobs_archive_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Archive Job Layout', 'entaro'),
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
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'jobs_archive_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Left Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            array(
                'id' => 'jobs_archive_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Archive Right Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entaro'),
                'options' => $sidebars
            ),
        )
    );
    $menus = array();
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
        
    $sections[] = array(
        'subsection' => true,
        'title' => esc_html__('Job Filter Settings', 'entaro'),
        'fields' => array(
            array(
                'id' => 'listing_filter_bg',
                'type' => 'media',
                'title' => esc_html__('Background Image', 'entaro'),
                'subtitle' => esc_html__('Upload a 1920px x 500px .jpg or .pg image.', 'entaro'),
            ),
            array(
                'id' => 'listing_filter_title',
                'type' => 'editor',
                'title' => esc_html__('Filter Title', 'entaro'),
            ),
            array(
                'id' => 'listing_filter_subtitle',
                'type' => 'editor',
                'title' => esc_html__('Filter SubTitle', 'entaro'),
            ),
            array(
                'id' => 'listing_filter_suggestion',
                'type' => 'select',
                'title' => esc_html__('Suggestion Menu', 'entaro'),
                'options' => $menus
            ),
            array(
                'id' => 'listing_filter_show_keyword',
                'type' => 'switch',
                'title' => esc_html__('Show keyword field', 'entaro'),
                'default' => 1,
            ),
            array(
                'id' => 'listing_filter_show_location_region',
                'type' => 'select',
                'title' => esc_html__('Show Location/Regions field', 'entaro'),
                'options' => array(
                    'hidden' => esc_html__('Hidden', 'entaro'),
                    'location' => esc_html__('Filter By Location', 'entaro'),
                    'region' => esc_html__('Filter By Region', 'entaro'),
                ),
                'default' => 'location',
            ),
            array(
                'id' => 'listing_filter_show_categories',
                'type' => 'switch',
                'title' => esc_html__('Show categories field', 'entaro'),
                'default' => 1,
            ),
            array(
                'id' => 'listing_filter_show_types',
                'type' => 'switch',
                'title' => esc_html__('Show types field', 'entaro'),
                'default' => 1,
            ),
        )
    );
    // Property Global Settings
    $pages = array();
    if ( is_admin() ) {
        $args = array(
            'sort_order' => 'asc',
            'sort_column' => 'post_title',
            'number' => '',
            'post_type' => 'page',
            'post_status' => 'publish'
        ); 
        $allpages = get_pages($args);
        if ( !empty($allpages) ) {
            foreach ($allpages as $page) {
                $pages[$page->post_name] = $page->post_title;
            }
        }
    }
    $sections[] = array(
        'title' => esc_html__('Job Favorite Setting', 'entaro'),
        'subsection' => true,
        'fields' => array(
            array (
                'id' => 'job_favorite_settings_favorite',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Favorite Settings', 'entaro').'</h3>',
            ),
            array(
                'id' => 'enable_job_favorite',
                'type' => 'switch',
                'title' => esc_html__('Enable Job Favorite?', 'entaro'),
                'default' => 1
            ),
            array(
                'id' => 'job_favorite_page_slug',
                'type' => 'select',
                'title' => esc_html__('Favorite Page', 'entaro'),
                'options' => $pages,
                'required' => array('enable_job_favorite', 'equals', 1),
            )
        )
    );
    // Job Page
    $sections[] = array(
        'title' => esc_html__('Single Job', 'entaro'),
        'subsection' => true,
        'fields' => array(
            array (
                'id' => 'job_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'entaro').'</h3>',
            ),
            array(
                'id'        => 'listing_single_sort_content',
                'type'      => 'sorter',
                'title'     => esc_html__( 'Job Content', 'entaro' ),
                'subtitle'  => esc_html__( 'Please drag and arrange the block', 'entaro' ),
                'options'   => array(
                    'enabled' => apply_filters( 'entaro_listing_single_sort_content', array(
                        'description' => esc_html__( 'Description', 'entaro' ),
                        'video' => esc_html__( 'Video', 'entaro' ),
                        'location' => esc_html__( 'Location', 'entaro' ),
                    )),
                    'disabled' => array()
                )
            ),
            array(
                'id' => 'show_job_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'entaro'),
                'default' => 1
            ),
            array(
                'id' => 'show_job_releated',
                'type' => 'switch',
                'title' => esc_html__('Show Releated Jobs', 'entaro'),
                'default' => 1
            ),
            array(
                'id' => 'number_job_releated',
                'type' => 'text',
                'title' => esc_html__('Number of related Jobs to show', 'entaro'),
                'required' => array('show_job_releated', '=', '1'),
                'default' => 3,
                'min' => '1',
                'step' => '1',
                'max' => '20',
                'type' => 'slider'
            ),
            array(
                'id' => 'releated_job_rows',
                'type' => 'select',
                'title' => esc_html__('Releated Jobs Rows', 'entaro'),
                'required' => array('show_job_releated', '=', '1'),
                'options' => array(
                    '1' => esc_html__('1 Rows', 'entaro'),
                    '2' => esc_html__('2 Rows', 'entaro'),
                    '3' => esc_html__('3 Rows', 'entaro'),
                    '4' => esc_html__('4 Rows', 'entaro'),
                    '5' => esc_html__('5 Rows', 'entaro'),
                    '6' => esc_html__('6 Rows', 'entaro'),
                ),
                'default' => 3
            ),
            array (
                'id' => 'job_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'entaro').'</h3>',
            ),
            array(
                'id' => 'job_single_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Job Sidebar Layout', 'entaro'),
                'subtitle' => esc_html__('Select the layout you want to apply on your Single Job Page.', 'entaro'),
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
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'job_single_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'entaro'),
                'default' => false
            ),
            array(
                'id' => 'job_single_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Job Left Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            array(
                'id' => 'job_single_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Job Right Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            
        )
    );
    
    $sections[] = array(
        'title' => esc_html__('Job Company Settings', 'entaro'),
        'fields' => array(
            array (
                'id' => 'jobs_company_breadcrumb_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Breadcrumbs Setting', 'entaro').'</h3>',
            ),
            array(
                'id' => 'show_jobs_company_breadcrumbs',
                'type' => 'switch',
                'title' => esc_html__('Breadcrumbs', 'entaro'),
                'default' => 1
            ),
            array (
                'title' => esc_html__('Breadcrumbs Background Color', 'entaro'),
                'subtitle' => '<em>'.esc_html__('The breadcrumbs background color of the site.', 'entaro').'</em>',
                'id' => 'jobs_company_breadcrumb_color',
                'type' => 'color',
                'transparent' => false,
            ),
            array(
                'id' => 'jobs_company_breadcrumb_image',
                'type' => 'media',
                'title' => esc_html__('Breadcrumbs Background', 'entaro'),
                'subtitle' => esc_html__('Upload a .jpg or .png image that will be your breadcrumbs.', 'entaro'),
            ),
        )
    );
    
    // Single Company
    $sections[] = array(
        'title' => esc_html__('Single Company', 'entaro'),
        'subsection' => true,
        'fields' => array(
            array (
                'id' => 'job_company_general_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('General Setting', 'entaro').'</h3>',
            ),
            array(
                'id' => 'show_job_company_social_share',
                'type' => 'switch',
                'title' => esc_html__('Show Social Share', 'entaro'),
                'default' => 1
            ),
            array (
                'id' => 'job_company_sidebar_setting',
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 style="margin: 0;"> '.esc_html__('Sidebar Setting', 'entaro').'</h3>',
            ),
            array(
                'id' => 'job_company_single_layout',
                'type' => 'image_select',
                'compiler' => true,
                'title' => esc_html__('Single Company Sidebar Layout', 'entaro'),
                'subtitle' => esc_html__('Select the layout you want to apply on your Single Company Page.', 'entaro'),
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
                ),
                'default' => 'left-main'
            ),
            array(
                'id' => 'job_company_single_fullwidth',
                'type' => 'switch',
                'title' => esc_html__('Is Full Width?', 'entaro'),
                'default' => false
            ),
            array(
                'id' => 'job_company_single_left_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Company Left Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for left sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            array(
                'id' => 'job_company_single_right_sidebar',
                'type' => 'select',
                'title' => esc_html__('Single Company Right Sidebar', 'entaro'),
                'subtitle' => esc_html__('Choose a sidebar for right sidebar.', 'entaro'),
                'options' => $sidebars
            ),
            

        )
    );

    // google map settings
    $sections[] = array(
        'title' => esc_html__('Google Map Settings', 'entaro'),
        'fields' => array(
            array(
                'id' => 'google_map_api_key',
                'type' => 'text',
                'title' => esc_html__('Google Map API Key', 'entaro'),
                'description'   => wp_kses(__('Browser API key. Read more <a href="//developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">here</a>.', 'entaro'), array('a' => array('href' => array()))),
            ),
            array(
                'id' => 'google_map_custom_style',
                'type' => 'textarea',
                'title' => esc_html__('Custom Style', 'entaro'),
                'description' => wp_kses(__('<a href="//snazzymaps.com/">Get custom style</a> and paste it below. If there is nothing added, we will fallback to the Google Maps service.', 'entaro'), array('a' => array('href' => array()))),
            ),
            array(
                'id' => 'google_map_zoom',
                'type' => 'text',
                'title' => esc_html__('Zoom', 'entaro'),
                'default' => 15
            ),
            array(
                'id' => 'google_map_marker_icon',
                'type' => 'media',
                'title' => esc_html__('Pin Icon', 'entaro'),
                'subtitle' => esc_html__('Upload a .jpg or .png image.', 'entaro'),
            ),
        )
    );
    return $sections;
}
add_filter( 'entaro_redux_framwork_configs', 'entaro_job_manager_redux_config', 10, 3 );