<?php

global $post, $product, $woocommerce;

$attachment_ids = $product->get_gallery_image_ids();
$_images =array();
if(has_post_thumbnail()){
	$_images[] = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ));
}else{
	$_images[] = '<img src="'.esc_url(wc_placeholder_img_src()).'" alt="Placeholder" />';
}
foreach ($attachment_ids as $attachment_id) {
	$_images[]       = wp_get_attachment_image( $attachment_id, 'shop_single' );
}
?>
<!-- Wrapper for slides -->
<div class="slick-carousel quickview-slick" data-items="1" data-smallmedium="1" data-extrasmall="1" data-pagination="true" data-nav="false" data-infinite="true">
	<?php foreach ($_images as $key => $image) { ?>
		<?php echo trim($image); ?>
	<?php } ?>
</div>