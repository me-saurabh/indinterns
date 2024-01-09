<?php

class Entaro_Job_Manager_Company {
	public static $slug;
	public static function init() {
		self::$slug = 'company';

		add_action( 'generate_rewrite_rules', array( __CLASS__, 'add_rewrite_rule' ) );
		add_filter( 'query_vars', array( __CLASS__, 'query_vars' ) );
		add_filter( 'pre_get_posts', array( __CLASS__, 'posts_filter' ) );
		//add_action( 'template_redirect', array( __CLASS__, 'template_loader' ) );
		add_action( 'template_include', array( __CLASS__, 'template_loader' ) );

		// display loop
		add_action( 'entaro_loop_listing_title_end', array( __CLASS__, 'loop_display' ) );
	}

	public static function add_rewrite_rule() {
		global $wp_rewrite;

		$wp_rewrite->add_rewrite_tag( '%company%', '(.+?)', self::$slug . '=' );

		$rewrite_keywords_structure = $wp_rewrite->root . self::$slug ."/%company%/";

		$new_rule = $wp_rewrite->generate_rewrite_rules( $rewrite_keywords_structure );

		$wp_rewrite->rules = $new_rule + $wp_rewrite->rules;

		return $wp_rewrite->rules;
	}

	public static function query_vars( $vars ) {
		$vars[] = self::$slug;

		return $vars;
	}

	public static function posts_filter( $query ) {
		if ( ! ( get_query_var( self::$slug ) && $query->is_main_query() && ! is_admin() ) )
			return;

		$meta_query = array(
			array(
				'key'   => '_company_name',
				'value' => urldecode( get_query_var( self::$slug ) )
			)
		);

		if ( get_option( 'job_manager_hide_filled_positions' ) == 1 ) {
			$meta_query[] = array(
				'key'     => '_filled',
				'value'   => '1',
				'compare' => '!='
			);
		}

		$query->set( 'post_type', 'job_listing' );
		$query->set( 'post_status', 'publish' );
		$query->set( 'meta_query', $meta_query );
	}

	public static function template_loader($template) {
		global $wp_query;

		if ( ! get_query_var(self::$slug) ) {
			return $template;
		}

		if ( 0 == $wp_query->found_posts ) {
			return get_template_directory() . '/404.php';
		} else {
			return get_template_directory() . '/single-company.php';
		}
		return $template;
	}

	public static function get_companies() {
		global $wpdb;
		
		$companies   = $wpdb->get_col(
			"SELECT pm.meta_value FROM {$wpdb->postmeta} pm
			 LEFT JOIN {$wpdb->posts} p ON p.ID = pm.post_id
			 WHERE pm.meta_key = '_company_name'
			 AND p.post_status = 'publish'
			 AND p.post_type = 'job_listing'
			 GROUP BY pm.meta_value
			 ORDER BY pm.meta_value"
		);
		
		return $companies;
	}

	public static function get_url( $company_name ) {
		global $wp_rewrite;

		$company_name = rawurlencode( $company_name );

		if ( $wp_rewrite->permalink_structure == '' ) {
			$url = home_url( 'index.php?'. self::$slug . '=' . $company_name );
		} else {
			$url = home_url( '/' . self::$slug . '/' . trailingslashit( $company_name ) );
		}

		return esc_url( $url );
	}

	public static function loop_display() {
		$company = get_the_company_name();
		if ( !empty($company) ) {
		?>
			<div class="company">
				<a href="<?php echo esc_url(self::get_url($company)); ?>">
					<?php the_company_name( '<strong class="text-theme">', '</strong> ' ); ?>
				</a>
			</div>
		<?php
		}
	}

}

Entaro_Job_Manager_Company::init();



// layout class for woo page
if ( !function_exists('entaro_company_content_class') ) {
    function entaro_company_content_class( $class ) {
        
        if( entaro_get_config('jobs_company_single_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'entaro_company_content_class', 'entaro_company_content_class' );

// get layout configs
if ( !function_exists('entaro_get_company_layout_configs') ) {
    function entaro_get_company_layout_configs() {
        
        $left = entaro_get_config('job_company_single_left_sidebar');
        $right = entaro_get_config('job_company_single_right_sidebar');

        switch ( entaro_get_config('job_company_single_layout') ) {
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