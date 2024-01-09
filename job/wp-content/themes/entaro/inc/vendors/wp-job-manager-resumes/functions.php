<?php

// get jobs
function entaro_get_resumes( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'orderby' => 'title',
		'orderway' => 'DESC',
		'posts_per_page' => -1,
		'paged' => 1,
		'categories' => '',
		'includes' => '',
	));

	$query_args = array(
		'post_type' => 'resume',
		'post_status' => 'publish',
		'posts_per_page' => $args['posts_per_page'],
		'ignore_sticky_posts' => true,
		'paged' => $args['paged'],
		'orderby' => $args['orderby'],
		'order' => $args['orderway']
	);

	if ( !empty($args['categories']) && is_array($args['categories']) ) {
        $query_args['tax_query'][] = array(
            'taxonomy'      => 'job_listing_category',
            'field'         => 'slug',
            'terms'         => $args['categories'],
            'operator'      => 'IN'
        );
    }

    if ( !empty($args['includes']) && is_array($args['includes']) ) {
        $query_args['post_name__in'] = $args['includes'];
    }

	return new WP_Query( $query_args );
}

// layout class for woo page
if ( !function_exists('entaro_job_resume_content_class') ) {
    function entaro_job_resume_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'resume' ) ) {
            $page = 'single';
        }
        if( entaro_get_config('job_resumes_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'entaro_job_resume_content_class', 'entaro_job_resume_content_class' );

// get layout configs
if ( !function_exists('entaro_get_job_resume_layout_configs') ) {
    function entaro_get_job_resume_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'resume' ) ) {
            $page = 'single';
        }
        $left = entaro_get_config('job_resumes_'.$page.'_left_sidebar');
        $right = entaro_get_config('job_resumes_'.$page.'_right_sidebar');

        switch ( entaro_get_config('job_resumes_'.$page.'_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-3 col-sm-12 col-xs-12'  );
                $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-9 col-sm-12 col-xs-12' );
                break;
            case 'main':
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
            case 'left-main-right':
                $configs['left'] = array( 'sidebar' => $left,  'class' => 'col-md-3 col-sm-12 col-xs-12'  );
                $configs['right'] = array( 'sidebar' => $right, 'class' => 'col-md-3 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-6 col-sm-12 col-xs-12' );
                break;
            default:
                $configs['main'] = array( 'class' => 'col-md-12 col-sm-12 col-xs-12' );
                break;
        }

        return $configs; 
    }
}


function entaro_get_resume_display_mode() {
    if (isset($_COOKIE['entaro_resume_display_mode']) && in_array($_COOKIE['entaro_resume_display_mode'], array('grid', 'list'))) {
        return $_COOKIE['entaro_resume_display_mode'];
    }
    return entaro_get_config('job_resumes_display_mode', 'grid');
}

function entaro_get_resume_item_columns() {
    $display_mode = entaro_get_resume_display_mode();
    switch ($display_mode) {
        case 'list':
            $columns = 1;
            break;
        default:
            $columns = entaro_get_config('job_resumes_columns', 2);
            break;
    }
    return apply_filters( 'entaro_get_resume_item_columns', $columns );
}


// filter
function entaro_get_job_resume_query_args($query_args, $args) {
    global $wpdb, $wp_query;

    if (isset($_REQUEST['form_data'])) {
        $form_data = urldecode($_REQUEST['form_data']);
        parse_str($form_data, $datas);

        // posts_per_page
        $query_args['posts_per_page'] = isset( $_GET['posts_per_page'] ) ? absint( $_GET['posts_per_page'] ) : entaro_get_config('jobs_resumes_number_per_page', 10);
        // order by
        if ( isset( $datas['filter_order'] ) ) {
            if ( 'default' === $datas['filter_order'] ) { // Default show featured.
                $query_args['orderby'] = array(
                    'menu_order' => 'ASC',
                    'date'       => 'DESC',
                );
                $query_args['order'] = 'DESC';
            } else {
                $query_args['entaro_proximity_filter'] = false;
                $query_args = entaro_sort_resume_query( $query_args, $datas['filter_order'] );
            }
        }
        
        // location
        $use_distance = apply_filters( 'entaro_use_distance', 'on');
        $lat = isset( $datas[ 'search_lat' ] ) ? (float) $datas[ 'search_lat' ] : false;
        $lng = isset( $datas[ 'search_lng' ] ) ? (float) $datas[ 'search_lng' ] : false;
        $distance = apply_filters( 'entaro_distance', 50);
        $location = isset( $datas[ 'search_location' ] ) ? esc_attr( $datas[ 'search_location' ] ) : false;

        if ( !( $use_distance && $lat && $lng && $distance ) ) {
            return $query_args;
        }

        $distance_type = apply_filters( 'entaro_distance_type', 'miles');
        $earth_distance = $distance_type == 'miles' ? 3959 : 6371;

        $sql = $wpdb->prepare( "
            SELECT $wpdb->posts.ID, 
                ( %s * acos( 
                    cos( radians(%s) ) * 
                    cos( radians( latitude.meta_value ) ) * 
                    cos( radians( longitude.meta_value ) - radians(%s) ) + 
                    sin( radians(%s) ) * 
                    sin( radians( latitude.meta_value ) ) 
                ) ) 
                AS distance, latitude.meta_value AS latitude, longitude.meta_value AS longitude
                FROM $wpdb->posts
                INNER JOIN $wpdb->postmeta AS latitude ON $wpdb->posts.ID = latitude.post_id
                INNER JOIN $wpdb->postmeta AS longitude ON $wpdb->posts.ID = longitude.post_id
                WHERE 1=1 AND ($wpdb->posts.post_status = 'publish' ) AND latitude.meta_key='geolocation_lat' AND longitude.meta_key='geolocation_long'
                HAVING distance < %s
                ORDER BY $wpdb->posts.menu_order ASC, distance ASC",
            $earth_distance,
            $lat,
            $lng,
            $lat,
            $distance
        );

        $post_ids = $wpdb->get_results( $sql, OBJECT_K );

        if ( empty( $post_ids ) || ! $post_ids ) {
            $post_ids = array(0);
        }

        if ( $wp_query ) {
            $wp_query->locations = $post_ids;
        }

        $query_args[ 'post__in' ] = array_keys( (array) $post_ids );
        $query_args = entaro_resume_remove_location_meta_query( $query_args );
    }
    
    return $query_args;
}
add_filter( 'get_resumes_query_args', 'entaro_get_job_resume_query_args', 10, 2 );

function entaro_sort_resume_query( $query_args, $sort_option ) {
    if ( 'date-desc' === $sort_option ) { // Newest First (default).
        $query_args['orderby'] = 'date';
        $query_args['order'] = 'DESC';
    } elseif ( 'date-asc' === $sort_option ) { // Oldest First.
        $query_args['orderby'] = 'date';
        $query_args['order'] = 'ASC';
    } elseif ( 'random' === $sort_option ) { // Random.
        $query_args['orderby'] = 'rand';
    }

    return $query_args;
}

function entaro_resume_remove_location_meta_query( $query_args ) {
    $found = false;
    if ( ! isset( $query_args[ 'meta_query' ] ) ) {
        return $query_args;
    }
    foreach ( $query_args[ 'meta_query' ] as $query_key => $meta ) {
        foreach ( $meta as $key => $args ) {
            if ( ! is_int( $key ) ) {
                continue;
            }

            if ( 'geolocation_formatted_address' == $args[ 'key' ] ) {
                $found = true;
                unset( $query_args[ 'meta_query' ][ $query_key ] );
                break;
            }
        }

        if ( $found ) {
            break;
        }
    }

    return $query_args;
}