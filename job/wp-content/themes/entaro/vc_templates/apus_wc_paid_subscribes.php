<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$loop = entaro_get_products(array( 'product_type' => 'job_package' ));
$bcol = 12/$columns;
if($style == 'style2'){
	$subwoo = 'subwoo-inner2';
}elseif($style == 'style3'){
	$subwoo = 'subwoo-inner3';
} else{
	$subwoo = 'subwoo-inner';
}
?>
<div class="widget widget-subcribes <?php echo esc_attr($el_class); ?>">
	<div class="center">
		<?php if ($title!=''): ?>
	        <h3 class="widget-title line-center">
	            <?php echo wp_kses_post($title); ?>
	        </h3>
	    <?php endif; ?>
	    <?php if(wpb_js_remove_wpautop( $content, true )){ ?>
	        <div class="description">
	            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
	        </div>
	    <?php } ?>
    </div>
	<?php if ($loop->have_posts()): ?>
		<div class="row">
			<?php while ( $loop->have_posts() ) : $loop->the_post(); global $product;
			?>
					<div class="col-xs-12 col-sm-<?php echo esc_attr($bcol); ?> col-xs-12">
						<div class="<?php echo esc_attr($subwoo); ?> <?php echo esc_attr($product->is_featured() ? 'featured' : ''); ?>">
							<?php if($product->is_featured() && $style != 'style2' && $style != 'style3' ){ ?>
								<span class="armorial"><i class="fa fa-star" aria-hidden="true"></i></span>
							<?php } ?>
							<div class="header-sub <?php echo esc_attr(($style == 'style3') ? ($product->is_featured())?' bg-second':' bg-theme' : '');  ?> ">
								<div class="wdiget no-margin">
									<?php if($style == 'style2' || $style == 'style3' ) {?>
										<h3 class="title"><?php the_title(); ?></h3>
									<?php }else{ ?>
										<h3 class="widget-title line-center"><?php the_title(); ?></h3>
									<?php } ?>
									<div class="price <?php echo esc_attr(($style == 'style3') ? ( $product->is_featured()) ? 'text-second':'text-theme': '111');?>">
										<div class="price-inner <?php echo esc_attr(($style != 'style3') ? ( $product->is_featured())?' bg-second text-white':' bg-theme text-white' : '');?>">
											<div class="inner">
											<?php echo (!empty($product->get_price())) ? $product->get_price_html() : esc_html__('Free','entaro'); ?>
											</div>
										</div>	
									</div>
								</div>
							</div>
							<div class="bottom-sub clearfix">
								<div class="content"><?php the_excerpt(); ?></div>
									<div class="button-action text-center">
										<?php remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );?>
										<?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
									</div>
							</div>
						</div>
					</div>	
			<?php endwhile; ?>
		</div>
		<?php wp_reset_postdata(); ?>
	<?php endif; ?>
</div>