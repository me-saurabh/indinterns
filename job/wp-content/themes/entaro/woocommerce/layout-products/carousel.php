<?php
$product_item = isset($product_item) ? $product_item : 'inner';
$show_nav = isset($show_nav) ? $show_nav : false;
$show_smalldestop = isset($show_smalldestop) ? $show_smalldestop : false;
$show_pagination = isset($show_pagination) ? $show_pagination : false;
$rows = isset($rows) ? $rows : 1;
$columns = isset($columns) ? $columns : 4;
$small_cols = $columns <= 1 ? 1 : 2;
$products = isset($products) ? $products : '';
?>
<div class="slick-carousel slick-carousel-top products <?php echo esc_attr($products); ?>" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>"
	<?php echo trim($columns >= 8 ? 'data-large="6"' : ''); ?> 
    <?php echo trim($columns >= 5 ? 'data-medium="4" data-large="4" ' : ''); ?> 
	<?php echo trim(($columns >= 4 && $product_item == 'inner-list-small')? 'data-medium="3" data-large="3" ' : ''); ?> 
    <?php echo trim(($columns >= 2 && ($product_item != 'inner-list-small') ) ? 'data-smallest="2" data-extrasmall="2" ' : ''); ?>
    <?php echo trim(($columns <= 2 && !empty($show_smalldestop) && ($product_item == 'inner-deal') ) ? 'data-smalldesktop="2" data-medium="2" data-smallmedium="2" ' : ''); ?>
    <?php echo trim(($columns <= 2  && ($product_item == 'inner-deal') ) ? ' data-medium="2" data-smallmedium="2" ' : ''); ?>
	data-smallmedium="<?php echo esc_attr($small_cols); ?>"

	data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>">
    <?php while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
        <div class="item">
            <div class="products-grid product">
                <?php wc_get_template_part( 'item-product/'.$product_item ); ?>
            </div>
        </div>
    <?php endwhile; ?>
</div>
<?php wp_reset_postdata(); ?>