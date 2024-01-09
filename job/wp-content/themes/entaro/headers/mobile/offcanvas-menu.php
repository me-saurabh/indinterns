<nav id="navbar-offcanvas" class="navbar hidden-lg hidden-md" role="navigation">
    <ul>
        <?php
            $args = array(
                'theme_location' => 'primary',
                'container' => false,
                'menu_class' => 'nav navbar-nav',
                'fallback_cb'     => false,
                'menu_id' => 'main-mobile-menu',
                'walker' => new Entaro_Mobile_Menu(),
                'items_wrap' => '%3$s',
            );
            wp_nav_menu($args);
        ?>

        <?php if( !is_user_logged_in() ){ ?>
            <li>
                <a class="register btn btn-white btn-outline" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign up','entaro'); ?>"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e('Sign up', 'entaro'); ?></a>
            </li>
            <li>
                <a class="login btn btn-second" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign in','entaro'); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i><?php esc_html_e('Login', 'entaro'); ?></a>
            </li>
                
        <?php } else { 

            $user_info = wp_get_current_user();
            $roles = $user_info->roles;
            if ( in_array('candidate', $roles) ) {
                if ( has_nav_menu( 'candidate-menu' ) ) {
                    $args = array(
                        'theme_location' => 'candidate-menu',
                        'container' => false,
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb'     => false,
                        'menu_id' => 'main-mobile-menu',
                        'walker' => new Entaro_Mobile_Menu(),
                        'items_wrap' => '%3$s',
                    );
                    wp_nav_menu($args);
                }
            } else {
                if ( has_nav_menu( 'top-menu' ) ) {
                    $args = array(
                        'theme_location' => 'top-menu',
                        'container' => false,
                        'menu_class' => 'nav navbar-nav',
                        'fallback_cb'     => false,
                        'menu_id' => 'main-mobile-menu',
                        'walker' => new Entaro_Mobile_Menu(),
                        'items_wrap' => '%3$s',
                    );
                    wp_nav_menu($args);
                }
            }
        } ?>
    </ul>
</nav>