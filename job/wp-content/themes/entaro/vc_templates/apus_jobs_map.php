<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
	'get_job_by' => $get_job_by,
	'posts_per_page' => $posts_per_page,
	'types' => !empty($types) ? array($types) : '',
	'categories' => !empty($category) ? array($category) : '',
	'regions' => !empty($region) ? array($region) : '',
);
$loop = entaro_get_listings( $args );

$pin_icon = '';
if ( $marker_icon ) {
	$img = wp_get_attachment_image_src($marker_icon,'full');
	if ( !empty($img) && isset($img[0]) ) {
		$pin_icon = $img[0];
	}
}
$gstyle = '';
if ($map_style) {
	$gstyle = Entaro_Google_Maps_Styles::get_style($map_style);
}

wp_enqueue_style( 'leaflet', get_template_directory_uri() . '/css/leaflet.css', array(), '1.8.0' );
wp_enqueue_script( 'leaflet', get_template_directory_uri() . '/js/leaflet.js', array( 'jquery' ), '1.8.0', true );
wp_register_script( 'entaro-maps', get_template_directory_uri() . '/js/maps.js', array( 'jquery' ), '1.8.0', true );
wp_localize_script( 'entaro-maps', 'entaro_listing_opts', array(
	'custom_style' => $gstyle,
	'pin_img' => !empty($pin_icon) ? $pin_icon : get_template_directory_uri() . '/images/pin.png',
));
wp_enqueue_script( 'entaro-maps' );


?>
<div class="widget widget-jobs-map <?php echo esc_attr($el_class); ?>">
	<div id="apus-listing-map"></div>
    <div class="content hidden">
		<?php
		if ( $loop->have_posts() ) {
			?>
			<div class="row job_listings_cards">
				<?php while ( $loop->have_posts() ): $loop->the_post(); global $post; ?>
                    <div <?php job_listing_class('jobs-listing-card'); ?> data-latitude="<?php echo esc_attr( $post->geolocation_lat ); ?>" data-longitude="<?php echo esc_attr( $post->geolocation_long ); ?>">
                    	<div class="listing-title">
							<h3 class="title-list-small"><a href="<?php the_job_permalink(); ?>"><?php wpjm_the_job_title(); ?></a></h3>
						</div>
						<div class="listing-address">
							<div class="location">
								<i class="text-second fa fa-map-marker" aria-hidden="true"></i>
								<?php the_job_location( false ); ?>
							</div>
						</div>
					</div>
                <?php endwhile; ?>
            </div>
            <?php
			wp_reset_postdata();
		}
		?>
    </div>
</div>