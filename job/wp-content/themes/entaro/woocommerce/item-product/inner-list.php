<?php 
global $product;
$product_id = $product->get_id();
?>
<div class="product-block product-block-list" data-product-id="<?php echo esc_attr($product_id); ?>">
		<div class="wrapper-image">
			<div class="inner">
		    <figure class="image">

		        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>" class="product-image">
		            <?php
		                /**
		                * woocommerce_before_shop_loop_item_title hook
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
                       <span><?php esc_html_e('Quick view','entaro'); ?></span>
                    </a>
                </div>
            <?php } ?> 
			</div>    
		</div>    
	    <div class="wrapper-info">
	    	<div class="inner">
		    <div class="caption-list">
	        	<div class="cate-wrapper clearfix">
	        		<div class="pull-right">
		        		<?php
				            if ( class_exists( 'YITH_WCWL' ) ) {
				                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
				            }
				        ?>
			        </div>
	        	</div>
    			
	         	<h3 class="name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
	            <div class="rating clearfix">
	                <?php
	                    $rating_html = wc_get_rating_html( $product->get_average_rating() );
	                    if ( $rating_html ) {
	                        echo trim( $rating_html );
	                    } else {
	                        echo '<div class="star-rating"></div>';
	                    }
	                ?>
	            </div>
		        
		        <div class="product-excerpt">
		            <?php the_excerpt(); ?>
		        </div>
		    </div>
		    </div>
		</div>  
		<div class="caption-buttons">
			<div class="inner">
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

	        <?php
                // Availability
	        	$availability      = $product->get_availability();
                $availability_html = empty( $availability['availability'] ) ? '' : '<div class="avaibility-wrapper">'.esc_html__('Avaibility:', 'entaro').' <span class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</span></div>';
                echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
            ?>

	        <?php
	        	/**
				 * woocommerce_after_shop_loop_item hook.
				 *
				 * @hooked woocommerce_template_loop_product_link_close - 5
				 * @hooked woocommerce_template_loop_add_to_cart - 10
				 */
	        	do_action( 'woocommerce_after_shop_loop_item' );
        	?>

	    	</div>      
	    </div>      
</div>