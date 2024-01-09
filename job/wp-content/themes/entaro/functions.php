<?php
/**
 * entaro functions and definitions
 *
 * Set up the theme and provides some helper functions, which are used in the
 * theme as custom template tags. Others are attached to action and filter
 * hooks in WordPress to change core functionality.
 *
 * When using a child theme you can override certain functions (those wrapped
 * in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before
 * the parent theme's file, so the child theme functions would be used.
 *
 * @link https://codex.wordpress.org/Theme_Development
 * @link https://codex.wordpress.org/Child_Themes
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are
 * instead attached to a filter or action hook.
 *
 * For more information on hooks, actions, and filters,
 * {@link https://codex.wordpress.org/Plugin_API}
 *
 * @package WordPress
 * @subpackage Entaro
 * @since Entaro 3.25
 */

define( 'ENTARO_THEME_VERSION', '3.25' );
define( 'ENTARO_DEMO_MODE', false );

if ( ! isset( $content_width ) ) {
	$content_width = 660;
}

if ( ! function_exists( 'entaro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 *
 * @since Entaro 1.0
 */
function entaro_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on entaro, use a find and replace
	 * to change 'entaro' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'entaro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * See: https://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 1200, 750, true );
	add_image_size( 'entaro-special-lg', 770, 410, true );
	add_image_size( 'entaro-special-sm', 370, 150, true );
	add_image_size( 'entaro-shop-horizontal', 770, 370, true );
	add_image_size( 'entaro-shop-vertical', 585, 792, true );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'entaro' ),
		'top-menu' => esc_html__( 'Employer Menu Account', 'entaro' ),
		'candidate-menu' => esc_html__( 'Candidate Menu Account', 'entaro' ),
		//'vertical-menu' => esc_html__( 'Vertical Menu', 'entaro' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	add_theme_support( 'job-manager-templates' );
	add_theme_support( "woocommerce" );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link', 'gallery', 'status', 'audio', 'chat'
	) );

	$color_scheme  = entaro_get_color_scheme();
	$default_color = trim( $color_scheme[0], '#' );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'entaro_custom_background_args', array(
		'default-color'      => $default_color,
		'default-attachment' => 'fixed',
	) ) );

	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );

	// Add support for Block Styles.
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );
	
	// Add support for full and wide align images.
	add_theme_support( 'align-wide' );

	// Add support for editor styles.
	add_theme_support( 'editor-styles' );

	// Enqueue editor styles.
	add_editor_style( array( 'css/style-editor.css', entaro_get_fonts_url() ) );

	entaro_get_load_plugins();
}
endif; // entaro_setup
add_action( 'after_setup_theme', 'entaro_setup' );

/**
 * Load Google Front
 */
function entaro_get_fonts_url() {
    $fonts_url = '';

    /* Translators: If there are characters in your language that are not
    * supported by Montserrat, translate this to 'off'. Do not translate
    * into your own language.
    */
    $lato = _x( 'on', 'Lato font: on or off', 'entaro' );
    $montserrat = _x( 'on', 'Montserrat font: on or off', 'entaro' );

    if ( 'off' !== $lato || 'off' !== $montserrat  ) {
        $font_families = array();
        if ( 'off' !== $lato ) {
            $font_families[] = 'Lato:300,400,700,900';
        }
		if ( 'off' !== $montserrat ) {
            $font_families[] = 'Montserrat:400,500,600,700,800,900';
        }
 		$font_google_code = entaro_get_config('font_google_code');
 		if (!empty($font_google_code) ) {
 			$font_families[] = $font_google_code;
 		}
        $query_args = array(
            'family' => ( implode( '|', $font_families ) ),
            'subset' => urlencode( 'latin,latin-ext' ),
        );
 		
 		$protocol = is_ssl() ? 'https:' : 'http:';
        $fonts_url = add_query_arg( $query_args, $protocol .'//fonts.googleapis.com/css' );
    }
 
    return esc_url_raw( $fonts_url );
}

function entaro_fonts_url() {  
	$protocol = is_ssl() ? 'https:' : 'http:';
	wp_enqueue_style( 'entaro-theme-fonts', entaro_get_fonts_url(), array(), null );
}
add_action('wp_enqueue_scripts', 'entaro_fonts_url');

/**
 * Enqueue scripts and styles.
 *
 * @since Entaro 1.0
 */
function entaro_scripts() {
	// Load our main stylesheet.

	//load font awesome
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.css', array(), '4.5.0' );

	// load font themify icon
	wp_enqueue_style( 'font-themify', get_template_directory_uri() . '/css/themify-icons.css', array(), '1.0.0' );
	
	wp_enqueue_style( 'ionicons', get_template_directory_uri() . '/css/ionicons.css', array(), '2.0.0' );

	// load animate version 3.5.0
	wp_enqueue_style( 'animate', get_template_directory_uri() . '/css/animate.css', array(), '3.5.0' );

	// load bootstrap style
	if( is_rtl() ){
		wp_enqueue_style( 'bootstrap-rtl', get_template_directory_uri() . '/css/bootstrap-rtl.css', array(), '3.2.0' );
	} else {
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css', array(), '3.2.0' );
	}
	
	wp_enqueue_style( 'entaro-template', get_template_directory_uri() . '/css/template.css', array(), '3.2' );
	$footer_style = entaro_print_style_footer();
	if ( !empty($footer_style) ) {
		wp_add_inline_style( 'entaro-template', $footer_style );
	}
	$custom_style = entaro_custom_styles();
	if ( !empty($custom_style) ) {
		wp_add_inline_style( 'entaro-template', $custom_style );
	}
	wp_enqueue_style( 'entaro-style', get_template_directory_uri() . '/style.css', array(), '3.2' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), '20150330', true );

	wp_enqueue_script( 'slick', get_template_directory_uri() . '/js/slick.min.js', array( 'jquery' ), '1.8.0', true );
	wp_enqueue_style( 'slick', get_template_directory_uri() . '/css/slick.css', array(), '1.8.0' );
	
	wp_enqueue_script( 'countdown', get_template_directory_uri() . '/js/countdown.js', array( 'jquery' ), '20150315', true );

	wp_enqueue_style( 'select2' );
	wp_enqueue_script( 'select2');

	wp_enqueue_script( 'jquery-magnific-popup', get_template_directory_uri() . '/js/magnific/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
	wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/js/magnific/magnific-popup.css', array(), '1.1.0' );

	wp_enqueue_script( 'jquery-unveil', get_template_directory_uri() . '/js/jquery.unveil.js', array( 'jquery' ), '1.1.0', true );
	
	wp_enqueue_script( 'perfect-scrollbar', get_template_directory_uri() . '/js/perfect-scrollbar.jquery.min.js', array( 'jquery' ), '0.6.12', true );
	wp_enqueue_style( 'perfect-scrollbar', get_template_directory_uri() . '/css/perfect-scrollbar.css', array(), '0.6.12' );
	
	wp_enqueue_script( 'jquery-mmenu', get_template_directory_uri() . '/js/mmenu/jquery.mmenu.js', array( 'jquery' ), '0.6.12', true );
	wp_enqueue_style( 'jquery-mmenu', get_template_directory_uri() . '/js/mmenu/jquery.mmenu.css', array(), '0.6.12' );

	wp_register_script( 'entaro-script', get_template_directory_uri() . '/js/functions.js', array( 'jquery' ), '20150330', true );
	wp_localize_script( 'entaro-script', 'entaro_ajax', array(
		'ajaxurl' => admin_url( 'admin-ajax.php' ),
		'view_more_text' => esc_html__('View More', 'entaro'),
        'view_less_text' => esc_html__('View Less', 'entaro'),
	));
	wp_enqueue_script( 'entaro-script' );
	
	wp_add_inline_script( 'entaro-script', "(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);" );
}
add_action( 'wp_enqueue_scripts', 'entaro_scripts', 100 );

/**
 * Display descriptions in main navigation.
 *
 * @since Entaro 1.0
 *
 * @param string  $item_output The menu item output.
 * @param WP_Post $item        Menu item object.
 * @param int     $depth       Depth of the menu.
 * @param array   $args        wp_nav_menu() arguments.
 * @return string Menu item with possible description.
 */
function entaro_nav_description( $item_output, $item, $depth, $args ) {
	if ( 'primary' == $args->theme_location && $item->description ) {
		$item_output = str_replace( $args->link_after . '</a>', '<div class="menu-item-description">' . $item->description . '</div>' . $args->link_after . '</a>', $item_output );
	}

	return $item_output;
}
add_filter( 'walker_nav_menu_start_el', 'entaro_nav_description', 10, 4 );

/**
 * Add a `screen-reader-text` class to the search form's submit button.
 *
 * @since Entaro 1.0
 *
 * @param string $html Search form HTML.
 * @return string Modified search form HTML.
 */
function entaro_search_form_modify( $html ) {
	return str_replace( 'class="search-submit"', 'class="search-submit screen-reader-text"', $html );
}
add_filter( 'get_search_form', 'entaro_search_form_modify' );

/**
 * Function get opt_name
 *
 */
function entaro_get_opt_name() {
	return 'entaro_theme_options';
}
add_filter( 'apus_framework_get_opt_name', 'entaro_get_opt_name' );


function entaro_register_demo_mode() {
	if ( defined('ENTARO_DEMO_MODE') && ENTARO_DEMO_MODE ) {
		return true;
	}
	return false;
}
add_filter( 'apus_framework_register_demo_mode', 'entaro_register_demo_mode' );

function entaro_get_demo_preset() {
	$preset = '';
    if ( defined('ENTARO_DEMO_MODE') && ENTARO_DEMO_MODE ) {
        if ( isset($_GET['_preset']) && $_GET['_preset'] ) {
            $presets = get_option( 'apus_framework_presets' );
            if ( is_array($presets) && isset($presets[$_GET['_preset']]) ) {
                $preset = $_GET['_preset'];
            }
        } else {
            $preset = get_option( 'apus_framework_preset_default' );
        }
    }
    return $preset;
}

function entaro_set_exporter_first_settings_option_keys($option_keys) {
	return array_merge($option_keys, array(
		'job_manager_enable_categories',
		'job_manager_enable_default_category_multiselect',
		'job_manager_submit_job_form_page_id',
		'job_manager_job_dashboard_page_id',
		'job_manager_jobs_page_id',
		'job_manager_favorite_page_id',
	));
}
add_filter( 'apus_exporter_first_settings_option_keys', 'entaro_set_exporter_first_settings_option_keys' );

function entaro_get_config($name, $default = '') {
	global $apus_options;
    if ( isset($apus_options[$name]) ) {
        return $apus_options[$name];
    }
    return $default;
}

function entaro_get_global_config($name, $default = '') {
	$options = get_option( 'entaro_theme_options', array() );
	if ( isset($options[$name]) ) {
        return $options[$name];
    }
    return $default;
}

function entaro_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar Default', 'entaro' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear in your Sidebar.', 'entaro' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Topbar Left', 'entaro' ),
		'id'            => 'sidebar-topbar-left',
		'description'   => esc_html__( 'Add widgets here to appear in your Topbar.', 'entaro' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Blog sidebar', 'entaro' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'entaro' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Listings Sidebar', 'entaro' ),
		'id'            => 'listings-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'entaro' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Single Job Sidebar', 'entaro' ),
		'id'            => 'single-job-sidebar',
		'description'   => esc_html__( 'Add widgets here to appear in your sidebar.', 'entaro' ),
		'before_widget' => '<aside class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title"><span>',
		'after_title'   => '</span></h2>',
	) );
	
}
add_action( 'widgets_init', 'entaro_widgets_init' );

function entaro_get_load_plugins() {

	$plugins[] = array(
		'name'                     => esc_html__( 'Apus Framework For Themes', 'entaro' ),
        'slug'                     => 'apus-framework',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/apus-framework.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'WPBakery Visual Composer', 'entaro' ),
	    'slug'                     => 'js_composer',
	    'required'                 => true,
	    'source'				   => get_template_directory() . '/inc/plugins/js_composer.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Revolution Slider', 'entaro' ),
        'slug'                     => 'revslider',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/revslider.zip'
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Cmb2', 'entaro' ),
	    'slug'                     => 'cmb2',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'MailChimp for WordPress', 'entaro' ),
	    'slug'                     => 'mailchimp-for-wp',
	    'required'                 =>  true
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Contact Form 7', 'entaro' ),
	    'slug'                     => 'contact-form-7',
	    'required'                 => true,
	);

	// listing manager plugins
	$plugins[] = array(
		'name'                     => esc_html__( 'WP Job Manager', 'entaro' ),
	    'slug'                     => 'wp-job-manager',
	    'required'                 => true,
	);

	$plugins[] = array(
		'name'                     => esc_html__( 'Apus Jobpro', 'entaro' ),
        'slug'                     => 'apus-jobpro',
        'required'                 => true ,
        'source'				   => get_template_directory() . '/inc/plugins/apus-jobpro.zip'
	);

	// woo
	$plugins[] = array(
		'name'                     => esc_html__( 'Woocommerce', 'entaro' ),
	    'slug'                     => 'woocommerce',
	    'required'                 => true,
	);

	tgmpa( $plugins );
}

require get_template_directory() . '/inc/plugins/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/functions-helper.php';
require get_template_directory() . '/inc/functions-frontend.php';

/**
 * Implement the Custom Header feature.
 *
 */
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/classes/megamenu.php';
require get_template_directory() . '/inc/classes/mobilemenu.php';

/**
 * Custom template tags for this theme.
 *
 */
require get_template_directory() . '/inc/template-tags.php';

$active_plugins =  apply_filters( 'active_plugins', get_option( 'active_plugins' ) );
if ( defined( 'APUS_FRAMEWORK_REDUX_ACTIVED' ) ) {
	require get_template_directory() . '/inc/vendors/redux-framework/redux-config.php';
	define( 'ENTARO_REDUX_FRAMEWORK_ACTIVED', true );
}
if( entaro_is_cmb2_activated() ) {
	require get_template_directory() . '/inc/vendors/cmb2/page.php';
	require get_template_directory() . '/inc/vendors/cmb2/footer.php';
	require get_template_directory() . '/inc/vendors/cmb2/testimonial.php';
	define( 'ENTARO_CMB2_ACTIVED', true );
}
if( entaro_is_js_composer_activated() ) {
	require get_template_directory() . '/inc/vendors/visualcomposer/functions.php';
	require get_template_directory() . '/inc/vendors/visualcomposer/google-maps-styles.php';
	if ( defined('WPB_VC_VERSION') && version_compare( WPB_VC_VERSION, '6.0', '>=' ) ) {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts2.php';
	} else {
		require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-posts.php';
	}
	require get_template_directory() . '/inc/vendors/visualcomposer/vc-map-theme.php';
	define( 'ENTARO_VISUALCOMPOSER_ACTIVED', true );
}
if( entaro_is_wp_job_manager_activated() ) {
	require get_template_directory() . '/inc/vendors/wp-job-manager/functions.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager/functions-redux-configs.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager/functions-company.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager/functions-submit-form.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager/functions-favorite.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager/functions-tax-types.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager/vc_map.php';
	define( 'ENTARO_WP_JOB_MANAGER_ACTIVED', true );
}
if( entaro_is_woocommerce_activated() ) {
	require get_template_directory() . '/inc/vendors/woocommerce/functions.php';
	require get_template_directory() . '/inc/vendors/woocommerce/functions-redux-configs.php';
	define( 'ENTARO_WOOCOMMERCE_ACTIVED', true );
}
if( entaro_is_woocommerce_activated() && entaro_is_wc_paid_listings_activated() ) {
	require get_template_directory() . '/inc/vendors/wc-paid-listings/functions.php';
	require get_template_directory() . '/inc/vendors/wc-paid-listings/vc.php';
	define( 'ENTARO_WC_PAID_LISTINGS_ACTIVED', true );
}
if( entaro_is_wp_resume_manager_activated() ) {
	require get_template_directory() . '/inc/vendors/wp-job-manager-resumes/functions.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager-resumes/vc_map.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager-resumes/functions-redux-configs.php';
	require get_template_directory() . '/inc/vendors/wp-job-manager-resumes/functions-submit-form.php';
	define( 'ENTARO_WP_JOB_MANAGER_RESUMES_ACTIVED', true );
}
if( entaro_is_apus_framework_activated() ) {
	require get_template_directory() . '/inc/widgets/contact-info.php';
	require get_template_directory() . '/inc/widgets/custom_menu.php';
	require get_template_directory() . '/inc/widgets/recent_post.php';
	require get_template_directory() . '/inc/widgets/search.php';
	require get_template_directory() . '/inc/widgets/single_image.php';
	require get_template_directory() . '/inc/widgets/socials.php';
	require get_template_directory() . '/inc/widgets/job_overview.php';
	require get_template_directory() . '/inc/widgets/job_taxonomy.php';
	define( 'ENTARO_FRAMEWORK_ACTIVED', true );
}

/**
 * Customizer additions.
 *
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Custom Styles
 *
 */
require get_template_directory() . '/inc/custom-styles.php';