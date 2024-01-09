<?php

function entaro_woocommerce_setup() {
    global $pagenow;
    if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
        $catalog = array(
            'width'     => '500',   // px
            'height'    => '500',   // px
            'crop'      => 1        // true
        );

        $single = array(
            'width'     => '1200',   // px
            'height'    => '1200',   // px
            'crop'      => 1        // true
        );

        $thumbnail = array(
            'width'     => '170',    // px
            'height'    => '170',   // px
            'crop'      => 1        // true
        );

        // Image sizes
        update_option( 'shop_catalog_image_size', $catalog );       // Product category thumbs
        update_option( 'shop_single_image_size', $single );         // Single product image
        update_option( 'shop_thumbnail_image_size', $thumbnail );   // Image gallery thumbs
    }

    if ( entaro_get_config('show_quickview', true) ) {
        add_action( 'wp_ajax_entaro_quickview_product', 'entaro_woocommerce_quickview' );
        add_action( 'wp_ajax_nopriv_entaro_quickview_product', 'entaro_woocommerce_quickview' );
    }
}

add_action( 'init', 'entaro_woocommerce_setup');

if ( !function_exists('entaro_get_products') ) {
    function entaro_get_products($args = array()) {
        $args = wp_parse_args( $args, array(
            'product_type' => '',
            'paged' => 1,
            'post_per_page' => -1,
            'orderby' => '',
            'order' => '',
        ));
        extract($args);
        
        $query_args = array(
            'post_type' => 'product',
            'posts_per_page' => $post_per_page,
            'post_status' => 'publish',
            'paged' => $paged,
            'orderby'   => $orderby,
            'order' => $order
        );

        if ( isset( $query_args['orderby'] ) ) {
            if ( 'price' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_price',
                    'orderby'   => 'meta_value_num'
                ) );
            }
            if ( 'featured' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_featured',
                    'orderby'   => 'meta_value'
                ) );
            }
            if ( 'sku' == $query_args['orderby'] ) {
                $query_args = array_merge( $query_args, array(
                    'meta_key'  => '_sku',
                    'orderby'   => 'meta_value'
                ) );
            }
        }
        if ($product_type == 'job_package') {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_type',
                'field'    => 'slug',
                'terms'    => array( 'job_package', 'job_package_subscription' )
            );
        } else {
            $query_args['orderby'] = 'date';
            $query_args['order'] = 'ASC';
        }
        
        return new WP_Query($query_args);
    }
}

// hooks
if ( !function_exists('entaro_woocommerce_enqueue_styles') ) {
    function entaro_woocommerce_enqueue_styles() {
        wp_enqueue_style( 'entaro-woocommerce', get_template_directory_uri() .'/css/woocommerce.css' , 'entaro-woocommerce-front' , ENTARO_THEME_VERSION, 'all' );
        wp_enqueue_script( 'entaro-woocommerce', get_template_directory_uri() . '/js/woocommerce.js', array( 'jquery' ), '20150330', true );
        $options = array(
            'ajaxurl' => admin_url( 'admin-ajax.php' ),
            'nonce' => wp_create_nonce( 'ajax-nonce' ),
        );
        wp_localize_script( 'entaro-woocommerce', 'entaro_woo_options', $options );
        wp_enqueue_script( 'wc-add-to-cart-variation' );
    }
}
add_action( 'wp_enqueue_scripts', 'entaro_woocommerce_enqueue_styles', 99 );

// cart
if ( !function_exists('entaro_woocommerce_header_add_to_cart_fragment') ) {
    function entaro_woocommerce_header_add_to_cart_fragment( $fragments ){
        global $woocommerce;
        $fragments['.cart .count'] =  sprintf(_n(' <span class="count"> %d  </span> ', ' <span class="count"> %d </span> ', $woocommerce->cart->cart_contents_count, 'entaro'), $woocommerce->cart->cart_contents_count);
        $fragments['.cart .mini-cart-total'] = trim( $woocommerce->cart->get_cart_total() );
        return $fragments;
    }
}
add_filter('woocommerce_add_to_cart_fragments', 'entaro_woocommerce_header_add_to_cart_fragment' );

// breadcrumb for woocommerce page
if ( !function_exists('entaro_woocommerce_breadcrumb_defaults') ) {
    function entaro_woocommerce_breadcrumb_defaults( $args ) {
        $breadcrumb_img = entaro_get_config('woo_breadcrumb_image');
        $breadcrumb_color = entaro_get_config('woo_breadcrumb_color');
        $style = array();
        $show_breadcrumbs = entaro_get_config('show_product_breadcrumbs');
        $has_img = '';
        if ( !$show_breadcrumbs ) {
            $style[] = 'display:none';
        }
        if( $breadcrumb_color  ){
            $style[] = 'background-color:'.$breadcrumb_color;
        }
        if ( isset($breadcrumb_img['url']) && !empty($breadcrumb_img['url']) ) {
            $style[] = 'background-image:url(\''.esc_url($breadcrumb_img['url']).'\')';
            $has_img = 1;
        }
        $estyle = !empty($style)? ' style="'.implode(";", $style).'"':"";
        if($has_img) $has_img = 'has-img';
        if ( is_single() ) {
            $title = esc_html__('Product Detail', 'entaro');
        } else {
            $title = esc_html__('Products List', 'entaro');
        }
        $args['wrap_before'] = '<section id="apus-breadscrumb" class="apus-breadscrumb '.$has_img.'"'.$estyle.'><div class="container"><div class="wrapper-breads"><div class="breadscrumb-inner"><ol class="apus-woocommerce-breadcrumb breadcrumb" ' . ( is_single() ? 'itemprop="breadcrumb"' : '' ) . '>';
        $args['wrap_after'] = '</ol><h2 class="bread-title">'.$title.'</h2></div></div></div></section>';

        return $args;
    }
}
add_filter( 'woocommerce_breadcrumb_defaults', 'entaro_woocommerce_breadcrumb_defaults' );
add_action( 'entaro_woo_template_main_before', 'woocommerce_breadcrumb', 30, 0 );

// display woocommerce modes
if ( !function_exists('entaro_woocommerce_display_modes') ) {
    function entaro_woocommerce_display_modes(){
        global $wp;
        $current_url = entaro_shop_page_link(true);

        $url_grid = add_query_arg( 'display_mode', 'grid', remove_query_arg( 'display_mode', $current_url ) );
        $url_list = add_query_arg( 'display_mode', 'list', remove_query_arg( 'display_mode', $current_url ) );

        $woo_mode = entaro_woocommerce_get_display_mode();

        echo '<div class="display-mode">';
        echo '<a href="'.  $url_grid  .'" class=" change-view '.($woo_mode == 'grid' ? 'active' : '').'"><i class="fa fa-th"></i></a>';
        echo '<a href="'.  $url_list  .'" class=" change-view '.($woo_mode == 'list' ? 'active' : '').'"><i class="fa fa-th-list"></i></a>';
        echo '</div>'; 
    }
}
add_action( 'woocommerce_before_shop_loop', 'entaro_woocommerce_display_modes' , 2 );

if ( !function_exists('entaro_woocommerce_get_display_mode') ) {
    function entaro_woocommerce_get_display_mode() {
        $woo_mode = entaro_get_config('product_display_mode', 'grid');
        if ( isset($_COOKIE['entaro_woo_mode']) && ($_COOKIE['entaro_woo_mode'] == 'list' || $_COOKIE['entaro_woo_mode'] == 'grid') ) {
            $woo_mode = $_COOKIE['entaro_woo_mode'];
        }
        return $woo_mode;
    }
}

if(!function_exists('entaro_shop_page_link')) {
    function entaro_shop_page_link($keep_query = false ) {
        if ( defined( 'SHOP_IS_ON_FRONT' ) ) {
            $link = home_url();
        } elseif ( is_post_type_archive( 'product' ) || is_page( wc_get_page_id('shop') ) ) {
            $link = get_post_type_archive_link( 'product' );
        } else {
            $link = get_term_link( get_query_var('term'), get_query_var('taxonomy') );
        }

        if( $keep_query ) {
            // Keep query string vars intact
            foreach ( $_GET as $key => $val ) {
                if ( 'orderby' === $key || 'submit' === $key ) {
                    continue;
                }
                $link = add_query_arg( $key, $val, $link );

            }
        }
        return $link;
    }
}


if(!function_exists('entaro_filter_before')){
    function entaro_filter_before(){
        echo '<div class="apus-filter">';
    }
}
if(!function_exists('entaro_filter_after')){
    function entaro_filter_after(){
        echo '</div>';
    }
}
add_action( 'woocommerce_before_shop_loop', 'entaro_filter_before' , 1 );
add_action( 'woocommerce_before_shop_loop', 'entaro_filter_after' , 40 );

// set display mode to cookie
if ( !function_exists('entaro_before_woocommerce_init') ) {
    function entaro_before_woocommerce_init() {
        if( isset($_GET['display_mode']) && ($_GET['display_mode']=='list' || $_GET['display_mode']=='grid') ){  
            setcookie( 'entaro_woo_mode', trim($_GET['display_mode']) , time()+3600*24*100,'/' );
            $_COOKIE['entaro_woo_mode'] = trim($_GET['display_mode']);
        }
    }
}
add_action( 'init', 'entaro_before_woocommerce_init' );

// Number of products per page
if ( !function_exists('entaro_woocommerce_shop_per_page') ) {
    function entaro_woocommerce_shop_per_page($number) {
        $value = entaro_get_config('number_products_per_page');
        if ( is_numeric( $value ) && $value ) {
            $number = absint( $value );
        }
        return $number;
    }
}
add_filter( 'loop_shop_per_page', 'entaro_woocommerce_shop_per_page' );

// Number of products per row
if ( !function_exists('entaro_woocommerce_shop_columns') ) {
    function entaro_woocommerce_shop_columns($number) {
        $value = entaro_get_config('product_columns');
        if ( in_array( $value, array(2, 3, 4, 6) ) ) {
            $number = $value;
        }
        return $number;
    }
}
add_filter( 'loop_shop_columns', 'entaro_woocommerce_shop_columns' );

// share box
if ( !function_exists('entaro_woocommerce_share_box') ) {
    function entaro_woocommerce_share_box() {
        if ( entaro_get_config('show_product_social_share') ) {
            get_template_part( 'page-templates/parts/sharebox' );
        }
    }
}
add_filter( 'woocommerce_single_product_summary', 'entaro_woocommerce_share_box', 100 );


// quickview
if ( !function_exists('entaro_woocommerce_quickview') ) {
    function entaro_woocommerce_quickview() {
        if ( !empty($_GET['product_id']) ) {
            $args = array(
                'post_type' => 'product',
                'post__in' => array($_GET['product_id'])
            );
            $query = new WP_Query($args);
            if ( $query->have_posts() ) {
                while ($query->have_posts()): $query->the_post(); global $product;
                    wc_get_template_part( 'content', 'product-quickview' );
                endwhile;
            }
            wp_reset_postdata();
        }
        die;
    }
}


// layout class for woo page
if ( !function_exists('entaro_woocommerce_content_class') ) {
    function entaro_woocommerce_content_class( $class ) {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        if( entaro_get_config('product_'.$page.'_fullwidth') ) {
            return 'container-fluid';
        }
        return $class;
    }
}
add_filter( 'entaro_woocommerce_content_class', 'entaro_woocommerce_content_class' );

// get layout configs
if ( !function_exists('entaro_get_woocommerce_layout_configs') ) {
    function entaro_get_woocommerce_layout_configs() {
        $page = 'archive';
        if ( is_singular( 'product' ) ) {
            $page = 'single';
        }
        $left = entaro_get_config('product_'.$page.'_left_sidebar');
        $right = entaro_get_config('product_'.$page.'_right_sidebar');

        switch ( entaro_get_config('product_'.$page.'_layout') ) {
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


if ( !function_exists( 'entaro_product_review_tab' ) ) {
    function entaro_product_review_tab($tabs) {
        if ( !entaro_get_config('show_product_review_tab') && isset($tabs['reviews']) ) {
            unset( $tabs['reviews'] ); 
        }
        return $tabs;
    }
}
add_filter( 'woocommerce_product_tabs', 'entaro_product_review_tab', 100 );


function entaro_get_employer_candidate_roles() {
    global $wp_roles;

    $all_roles = $wp_roles->roles;
    $editable_roles = apply_filters('editable_roles', $all_roles);
    $roles = array();
    foreach ($editable_roles as $role => $details) {
        if ( $role == 'employer' || $role == 'candidate' ) {
            $roles[$role] = translate_user_role($details['name']);
        }
    }
    if ( empty($roles['candidate']) ) {
        $roles['subscriber'] = esc_html__('Candidate', 'entaro');
    }
    return $roles;
}

add_action( 'woocommerce_created_customer', 'entaro_wc_save_registration_form_fields' );
function entaro_wc_save_registration_form_fields( $customer_id ) {
    if ( isset($_POST['role']) ) {
        if( $_POST['role'] == 'employer' || $_POST['role'] == 'candidate' || $_POST['role'] == 'subscriber' ){
            $user = new WP_User($customer_id);
            $user->add_role($_POST['role']);
        }
    }
}

function entaro_registration_form_fields() {
    $roles = entaro_get_employer_candidate_roles();
        if ( !empty($roles) ) {
            $selected = !empty($_POST['role']) ? $_POST['role'] : 'subscriber';
    ?>
            <p class="form-group form-row form-row-wide">
                <label for="reg_email"><?php esc_html_e( 'I want to register as', 'entaro' ); ?></label>
                <select name="role" class="input-text form-control">
                    <?php foreach ($roles as $key => $role) { ?>
                        <option value="<?php echo esc_attr($key); ?>" <?php selected($selected, $key); ?>><?php echo esc_html($role); ?></option>
                    <?php } ?>
                </select>
            </p>
    <?php }
}
add_action( 'woocommerce_register_form', 'entaro_registration_form_fields' );