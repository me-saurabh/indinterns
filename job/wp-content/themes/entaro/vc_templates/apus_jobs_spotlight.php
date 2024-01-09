<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( empty($job_slugs) ) {
	return;
}
$args = array(
	'includes' => explode(',', $job_slugs),
);
$loop = entaro_get_listings( $args );
?>
<div class="widget widget-jobs-spotlight <?php echo esc_attr($el_class); ?> <?php echo esc_attr($layout_type); ?>">
	<div class="widget-title-wrapper">
		<?php if ($title!=''): ?>
	        <h3 class="widget-title">
	            <span><?php echo esc_attr( $title ); ?></span>
		    </h3>
	    <?php endif; ?>
    </div>
    <div class="widget-content">
		<?php
		if ( $loop->have_posts() ) {
			if ( $layout_type == 'grid' ) {
				$bcol = $columns ? 12/(int)$columns : 4;
				?>
				<div class="row">
					<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
	                    <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-12 col-xs-12">
	                        <?php get_template_part( 'job_manager/loop/grid-spotlight'); ?>
	                    </div>
	                <?php endwhile; ?>
                </div>
                <?php
			} else {
				?>
				<div class="slick-carousel nav-top" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>"
					<?php if($columns > 2){ ?>
						data-medium="$columns" data-large="$columns"
					<?php }else{ ?>
						data-medium="1" data-large="1"
					<?php } ?>
				    data-extrasmall="1"
					data-smallmedium="1"
					data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>">
					<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
	                    <?php get_template_part( 'job_manager/loop/grid-spotlight'); ?>
	                <?php endwhile; ?>
	            </div>
                <?php
			}
			wp_reset_postdata();
		}
		?>
    </div>
</div>