<?php

// get jobs
function entaro_get_listings( $args = array() ) {
	$args = wp_parse_args( $args, array(
		'get_job_by' => '',
		'posts_per_page' => -1,
		'paged' => 1,
		'types' => '',
		'categories' => '',
		'regions' => '',
		'company' => '',
        'includes' => '',
		'ids' => '',
	));

	$query_args = array(
		'post_type' => 'job_listing',
		'post_status' => 'publish',
		'posts_per_page' => $args['posts_per_page'],
		'ignore_sticky_posts' => true,
		'paged' => $args['paged']
	);

	if ( $args['get_job_by'] == 'popular' ) {
		$query_args['meta_key'] = '_views_count';
		$query_args['order'] = 'DESC';
	} elseif ( $args['get_job_by'] == 'featured' ) {
		$query_args['meta_query'] = array(
	       	array(
	           'key' => '_featured',
	           'value' => '1',
	           'compare' => '=',
	       	)
		);
	}

	if ( !empty($args['types']) && is_array($args['types']) ) {
        $query_args['tax_query'][] = array(
            'taxonomy'      => 'job_listing_type',
            'field'         => 'slug',
            'terms'         => $args['types'],
            'operator'      => 'IN'
        );
    }

	if ( !empty($args['categories']) && is_array($args['categories']) ) {
        $query_args['tax_query'][] = array(
            'taxonomy'      => 'job_listing_category',
            'field'         => 'slug',
            'terms'         => $args['categories'],
            'operator'      => 'IN'
        );
    }

    if ( !empty($args['regions']) && is_array($args['regions']) ) {
        $query_args['tax_query'][] = array(
            'taxonomy'      => 'job_listing_region',
            'field'         => 'slug',
            'terms'         => $args['regions'],
            'operator'      => 'IN'
        );
    }
    
    if ( !empty($args['company']) ) {
        $query_args['meta_query'][] = array(
           'key' => '_company_name',
           'value' => $args['company'],
           'compare' => '=',
       	);
    }

    if ( !empty($args['includes']) && is_array($args['includes']) ) {
        $query_args['post_name__in'] = $args['includes'];
    }

    if ( !empty($args['ids']) && is_array($args['ids']) ) {
        $query_args['post__in'] = $args['ids'];
    }
    
	return new WP_Query( $query_args );
}


// layout class for listing archive page
if ( !function_exists('entaro_listing_archive_content_class') ) {
    function entaro_listing_archive_content_class( $class ) {
        if( entaro_get_config('jobs_archive_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'entaro_listing_archive_content_class', 'entaro_listing_archive_content_class' );

// get layout configs
if ( !function_exists('entaro_get_listing_archive_layout_configs') ) {
    function entaro_get_listing_archive_layout_configs() {
        
        $left = entaro_get_config('jobs_archive_left_sidebar');
        $right = entaro_get_config('jobs_archive_right_sidebar');

        switch ( entaro_get_config('jobs_archive_layout') ) {
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

// layout class for listing archive page
if ( !function_exists('entaro_listing_single_content_class') ) {
    function entaro_listing_single_content_class( $class ) {
        if( entaro_get_config('job_single_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'entaro_listing_single_content_class', 'entaro_listing_single_content_class' );

// get layout configs
if ( !function_exists('entaro_get_listing_single_layout_configs') ) {
    function entaro_get_listing_single_layout_configs() {
        
        $left = entaro_get_config('job_single_left_sidebar');
        $right = entaro_get_config('job_single_right_sidebar');

        switch ( entaro_get_config('job_single_layout') ) {
            case 'left-main':
                $configs['left'] = array( 'sidebar' => $left, 'class' => 'col-md-4 col-sm-12 col-xs-12'  );
                $configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
                break;
            case 'main-right':
                $configs['right'] = array( 'sidebar' => $right,  'class' => 'col-md-4 col-sm-12 col-xs-12' ); 
                $configs['main'] = array( 'class' => 'col-md-8 col-sm-12 col-xs-12' );
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

// get listing content block
function entaro_get_single_content_sort() {
    $contents = entaro_get_config( 'listing_single_sort_content', array() );

    if ( isset( $contents['enabled'] ) ) {
        $contents = $contents['enabled'];
        if ( isset($contents['placebo']) ) {
            unset($contents['placebo']);
        }
        return $contents;
    }

    return array();
}

// get display mode
function entaro_get_listing_display_mode() {
	if (isset($_COOKIE['entaro_display_mode']) && in_array($_COOKIE['entaro_display_mode'], array('grid', 'list'))) {
		return $_COOKIE['entaro_display_mode'];
	}
	return entaro_get_config('jobs_display_mode', 'grid');
}

// get listing columns
function entaro_get_listing_item_columns() {
	$display_mode = entaro_get_listing_display_mode();
	switch ($display_mode) {
		case 'list':
			$columns = 1;
			break;
		default:
			$columns = entaro_get_config('jobs_columns', 2);
			break;
	}
	return apply_filters( 'entaro_get_listing_item_columns', $columns );
}

// loop layout
function entaro_wrap_the_listings( $html ) {
	$output = '';

	$layout_version = 'default';
	ob_start();
		set_query_var( 'html_content', $html );
		get_template_part( 'job_manager/loop-layout/'.$layout_version );
		$output = ob_get_contents();
	ob_end_clean();

	return $output;
}
add_filter( 'job_manager_job_listings_output', 'entaro_wrap_the_listings', 10, 1 );

// social share
function entaro_job_single_social_share() {
    $enable_social = entaro_get_config('show_job_company_social_share');
    if ( $enable_social ) {
        get_template_part( 'template-parts/sharebox' );
    }
}
add_action( 'single_job_listing_end', 'entaro_job_single_social_share', 100 );

function entaro_job_loop_apply_button() {
    ?>
    <a class="btn-sm-list btn-list-second" href="<?php the_job_permalink(); ?>"><?php esc_html_e('Apply', 'entaro'); ?></a>
    <?php
}
add_action( 'job_listing_meta_end', 'entaro_job_loop_apply_button', 100 );

// filter
function entaro_get_job_listings_query_args($query_args, $args) {
    global $wpdb, $wp_query;

    if (isset($_REQUEST['form_data'])) {
        $form_data = urldecode($_REQUEST['form_data']);
        parse_str($form_data, $datas);
        
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
                $query_args = entaro_sort_listings_query( $query_args, $datas['filter_order'] );
            }
        }

        $tax_querys = array();
        if (isset($datas['job_region_select']) && $datas['job_region_select']) {
            $tax_querys[] = array(
                'taxonomy'         => 'job_listing_region',
                'field'            => 'term_id',
                'terms'            => $datas['job_region_select'],
                'operator'         => 'IN'
            );
        }

        if (!empty($tax_querys)) {
            if ( isset($query_args['tax_query']) ) {
                $query_args['tax_query'] = array_merge($query_args['tax_query'], $tax_querys);
            } else {
                $query_args['tax_query'] = $tax_querys;
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
        $query_args = entaro_remove_location_meta_query( $query_args );
    }
    
    return $query_args;
}
add_filter( 'get_job_listings_query_args', 'entaro_get_job_listings_query_args', 10, 2 );

// sort
function entaro_sort_listings_query( $query_args, $sort_option ) {
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

// remove location search
function entaro_remove_location_meta_query( $query_args ) {
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

// add regions for default
function entaro_job_manager_output_jobs_defaults($args) {
    $args['regions'] = '';
    return $args;
}
add_filter('job_manager_output_jobs_defaults', 'entaro_job_manager_output_jobs_defaults');

// set job views
function entaro_set_job_views($content) {
    global $post;
    if ( $post->post_type != 'job_listing' ) {
        return $content;
    }
    $count_key = '_views_count';
    $count = get_post_meta($post->ID, $count_key, true);
    if ($count == '') {
        delete_post_meta($post->ID, $count_key);
        add_post_meta($post->ID, $count_key, 1);
    } else {
        $count++;
        $value = sanitize_text_field($count);
        update_post_meta($post->ID, $count_key, $value);
    }
    return $content;
}
//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
add_filter( 'the_content', 'entaro_set_job_views' );


function entaro_job_manager_loop_tags() {
    if ( class_exists('ApusJobpro_Taxonomy_Tags') ) {
        ApusJobpro_Taxonomy_Tags::display_tags();
    }
}

add_filter( 'entaro_loop_listing_end', 'entaro_job_manager_loop_tags' );

function entaro_get_listings_page_url( $default_link = null  ) {
    //if there is a page set in the Listings settings use that
    $listings_page_id = get_option( 'job_manager_jobs_page_id', false );
    if ( ! empty( $listings_page_id ) ) {
        return get_permalink( $listings_page_id );
    }

    if ( $default_link !== null ) {
        return $default_link;
    }
    return get_post_type_archive_link( 'job_listing' );
}


function entaro_job_manager_enhanced_select_enabled($return) {
    return true;
}
add_filter( 'job_manager_enhanced_select_enabled', 'entaro_job_manager_enhanced_select_enabled' );

function entaro_add_tax_to_api() {
    $tax = get_taxonomy( 'job_listing_region' );
    if ( is_object($tax) ) {
        $tax->show_in_rest = true;
    }
}
add_action( 'init', 'entaro_add_tax_to_api', 30 );