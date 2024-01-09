<header id="apus-header" class="apus-header header-v1 hidden-sm hidden-xs clearfix" role="banner">
    <div class="<?php echo (entaro_get_config('keep_header') ? 'main-sticky-header-wrapper' : ''); ?>">
        <div class="<?php echo (entaro_get_config('keep_header') ? 'main-sticky-header' : ''); ?>">
            <div class="wrapper-large">
                <div class="header-middle">
                    <div class="row">
                        <div class="table-visiable-dk">
                            <div class="col-md-2">
                                <div class="logo-in-theme ">
                                    <?php get_template_part( 'template-parts/logo/logo' ); ?>
                                </div>
                            </div>
                            <div class="col-md-10">
                                <div class="pull-right">
                                    <div class="table-visiable-dk">
                                        <div class="left-content">
                                            <div class="table-visiable-dk">
                                                <?php if ( has_nav_menu( 'primary' ) ) : ?>
                                                    <div class="main-menu">
                                                        <nav data-duration="400" class="hidden-xs hidden-sm apus-megamenu slide animate navbar p-static" role="navigation">
                                                        <?php   $args = array(
                                                                'theme_location' => 'primary',
                                                                'container_class' => 'collapse navbar-collapse no-padding',
                                                                'menu_class' => 'nav navbar-nav megamenu',
                                                                'fallback_cb' => '',
                                                                'menu_id' => 'primary-menu',
                                                                'walker' => new Entaro_Nav_Menu()
                                                            );
                                                            wp_nav_menu($args);
                                                        ?>
                                                        </nav>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ( entaro_get_config('show_searchform') ): ?>
                                                    <div class="search-header">
                                                        <span class="icon-search"> <i class="fa fa-search"></i> </span>
                                                        <?php get_search_form(); ?>
                                                        <div class="over-click"></div>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ( defined('ENTARO_WOOCOMMERCE_ACTIVED') && ENTARO_WOOCOMMERCE_ACTIVED && entaro_get_config('show_cartbtn')): ?>
                                                    <?php get_template_part( 'woocommerce/cart/mini-cart-button' ); ?>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <?php if( !is_user_logged_in() ){ ?>
                                            <div class="right-content">
                                                <div class="login-topbar pull-right">
                                                    <a class="register btn btn-white btn-outline" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign up','entaro'); ?>"><i class="fa fa-user" aria-hidden="true"></i><?php esc_html_e('Sign up', 'entaro'); ?></a>
                                                    <a class="login btn btn-second" href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" title="<?php esc_html_e('Sign in','entaro'); ?>"><i class="fa fa-sign-in" aria-hidden="true"></i><?php esc_html_e('Login', 'entaro'); ?></a>
                                                </div>
                                            </div>
                                        <?php } else { ?>
                                            <div class="right-content">
                                                <div class="pull-right">
                                                    <?php entaro_account_menu(); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>   
                    </div> 
                </div>
            </div>
        </div>
    </div>
</header>