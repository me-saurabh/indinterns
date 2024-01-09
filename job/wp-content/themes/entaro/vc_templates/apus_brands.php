<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$bcol = 12/$columns;
$args = array(
	'post_type' => 'apus_brand',
	'posts_per_page' => $number
);
$loop = new WP_Query($args);
$count = 1;
?>
<div class="widget widget-brands <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title text-center">
            <?php echo esc_attr( $title ); ?>
        </h3>
    <?php endif; ?>
	<?php if ( $loop->have_posts() ): ?>
		<?php if ( $layout_type == 'carousel' ): ?>
			<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="3" data-extrasmall="2" data-pagination="false" data-nav="true">
	    		<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
	    			<div class="item">
		                <?php $link = get_post_meta( get_the_ID(), 'apus_brand_link', true); ?>
		                <?php $link = $link ? $link : '#'; ?>
						<a href="<?php echo esc_url($link); ?>" target="_blank">
							<?php the_post_thumbnail( 'full' ); ?>
						</a>
			        </div>
	    		<?php endwhile; ?>
    		</div>
    	<?php else: ?>
    		<div class="row">
	    		<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
	    			<div class="item col-md-<?php echo esc_attr($bcol); ?> col-xs-6 <?php if($count%$columns == 1) echo 'first-child'; if($count%$columns == 0) echo 'last-child'; ?>">
		                <?php $link = get_post_meta( get_the_ID(), 'apus_brand_link', true); ?>
		                <?php $link = $link ? $link : '#'; ?>
						<a href="<?php echo esc_url($link); ?>" target="_blank">
							<?php the_post_thumbnail( 'full' ); ?>
						</a>
			        </div>
	    		<?php $count++; endwhile; ?>
    		</div>
    	<?php endif; ?>
	<?php endif; ?>
	<?php wp_reset_postdata(); ?>
</div>