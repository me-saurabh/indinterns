<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
 
class Entaro_Job_Favorite {
    
    public static function init() {
        if ( !entaro_get_config('enable_job_favorite') ) {
            return '';
        }

        add_action( 'wp_ajax_entaro_add_favorite', array(__CLASS__, 'add_favorite') );
        add_action( 'wp_ajax_nopriv_entaro_add_favorite', array(__CLASS__, 'add_favorite') );
        add_action( 'wp_ajax_entaro_remove_favorite', array(__CLASS__, 'remove_favorite') );
        add_action( 'wp_ajax_nopriv_entaro_remove_favorite', array(__CLASS__, 'remove_favorite') );

        add_action( 'wp_footer', array(__CLASS__, 'favorite_login_require') );

        // display in loop
        add_action( 'job_listing_meta_start', array(__CLASS__, 'btn_display'), 10 );
        // display in job single
        add_action( 'entaro_job_listing_meta_start', array(__CLASS__, 'btn_display'), 100 );
    }

    public static function add_favorite() {
        if ( isset($_GET['post_id']) && $_GET['post_id'] ) {
            self::save_favorite($_GET['post_id']);
            $result['msg'] = esc_html__( 'View Your Favorite', 'entaro' );
            $result['status'] = 'success';
        } else {
            $result['msg'] = esc_html__( 'Add Favorite Error.', 'entaro' );
            $result['status'] = 'error';
        }
        echo json_encode($result);
        die();
    }

    public static function remove_favorite() {
        if ( isset($_GET['post_id']) && $_GET['post_id'] ) {
            $user_id = get_current_user_id();
            $data = get_user_meta($user_id, '_job_favorite', true);
            if (is_array($data)) {
                foreach ($data as $key => $value) {
                    if ( $_GET['post_id'] == $value ) {
                        unset($data[$key]);
                    }
                }
            }
            update_user_meta( $user_id, '_job_favorite', $data );
            
            $result['msg'] = esc_html__( 'Remove a listing to favorite successful', 'entaro' );
            $result['status'] = 1;
        } else {
            $result['msg'] = esc_html__( 'Remove a listing to favorite error', 'entaro' );
            $result['status'] = 0;
        }
        echo json_encode($result);
        die();
    }

    public static function get_favorite() {
        $user_id = get_current_user_id();
        $data = get_user_meta($user_id, '_job_favorite', true);
        return $data;
    }

    public static function save_favorite($post_id) {
        $user_id = get_current_user_id();
        $data = get_user_meta($user_id, '_job_favorite', true);
        if ( !empty($data) && is_array($data) ) {
            if ( !in_array($post_id, $data) ) {
                $data[] = $post_id;
                update_user_meta( $user_id, '_job_favorite', $data );
            }
        } else {
            $data = array($post_id);
            update_user_meta( $user_id, '_job_favorite', $data );
        }
    }

    public static function check_job_added($post_id) {
        $data = self::get_favorite();
        if ( !is_array($data) || !in_array($post_id, $data) ) {
            return false;
        }
        return true;
    }

    public static function btn_display( $post_id = null ) {
        if ( empty($post_id) ) {
            $post_id = get_the_ID();
        }
        ?>
        <div class="job-favorite">
            <?php if ( !is_user_logged_in() ) { ?>
                <a href="#apus-favorite-not-login" class="apus-favorite-not-login" data-id="<?php echo esc_attr($post_id); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__( 'favorite', 'entaro' ); ?>" >
                    <i class="fa fa-heart-o" aria-hidden="true"></i><span class="hidden"><?php echo esc_html__('Add to favorites', 'entaro') ?></span>
                </a>
            <?php } else {
                    $link = '';
                    if ( entaro_get_config('job_favorite_page_slug') ) {
                        $args = array(
                            'name'        => entaro_get_config('job_favorite_page_slug'),
                            'post_type'   => 'page',
                            'post_status' => 'publish',
                            'numberposts' => 1
                        );
                        $s_posts = get_posts($args);
                        if( $s_posts ) {
                            $link = get_permalink($s_posts[0]->ID);
                        }
                    }
                    $added = self::check_job_added($post_id);
                    if ($added) {
                        ?>
                        <a href="<?php echo esc_url($link); ?>" class="apus-favorite-added" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__( 'favorite', 'entaro' ); ?>">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                            <span class="hidden"><?php echo esc_html__('Favorites','entaro') ?></span>
                        </a>
                        <?php
                    } else {
                        ?>
                        <a href="<?php echo esc_url($link); ?>" class="apus-favorite-add" data-id="<?php echo esc_attr($post_id); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo esc_html__( 'favorite', 'entaro' ); ?>">
                            <i class="fa fa-heart-o" aria-hidden="true"></i>
                            <span class="hidden"><?php echo esc_html__('Add to favorites','entaro') ?></span>
                        </a>
                        <?php
                    }
                }
            ?>
        </div>

        <?php
    }

    public static function favorite_login_require() {
        if ( !entaro_get_config('enable_job_favorite') ) {
            return '';
        }
        if ( !is_user_logged_in() ) {
            $url = get_permalink( get_option('woocommerce_myaccount_page_id') );
        ?>
            <div class="hidden apus-favorite-login-info">
                <?php esc_html_e( 'Please login to add this job.', 'entaro' ); ?>
                <a class="login-button" href="<?php echo esc_url($url); ?>">
                    <?php esc_html_e( 'Click here to login', 'entaro' ); ?>
                </a>
            </div>
        <?php }
    }

}
add_action( 'init', array('Entaro_Job_Favorite', 'init') );
