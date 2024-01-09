<?php 
global $product;
$product_id = $product->get_id();
?>
<div class="product-block grid" data-product-id="<?php echo esc_attr($product_id); ?>">
    <div class="grid-inner">
        <div class="block-inner">
            <figure class="image">
                <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
                    <?php
                       /**
                         * woocommerce_before_shop_loop_item_title hook.
                         *
                         * @hooked woocommerce_show_product_loop_sale_flash - 10
                         * @hooked woocommerce_template_loop_product_thumbnail - 10
                         */
                        remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
                        do_action( 'woocommerce_before_shop_loop_item_title' );
                    ?>
                </a>
            </figure>
            <?php if (entaro_get_config('show_quickview', true)) { ?>
                <div class="quick-view">
                    <a href="#" class="quickview btn btn-dark btn-block radius-3x" data-product_id="<?php echo esc_attr($product_id); ?>" data-toggle="modal" data-target="#apus-quickview-modal">
                        <?php echo esc_html__('Quick View','entaro') ?>
                    </a>
                </div>
            <?php } ?>
        </div>
        <div class="metas clearfix">
            <h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            <?php
                /**
                * woocommerce_after_shop_loop_item_title hook
                *
                * @hooked woocommerce_template_loop_rating - 5
                * @hooked woocommerce_template_loop_price - 10
                */
                remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating', 5);
                do_action( 'woocommerce_after_shop_loop_item_title');
            ?>

            <div class="rating clearfix">
                <?php
                    $rating_html = wc_get_rating_html( $product->get_average_rating() );
                    if ( $rating_html ) {
                        echo trim( $rating_html );
                    }
                    
                ?>
            </div>
        </div>
    </div>
    <div class="groups-button clearfix">
        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
        <?php
            if ( class_exists( 'YITH_WCWL' ) ) {
                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
            }
        ?>
    </div> 
</div>