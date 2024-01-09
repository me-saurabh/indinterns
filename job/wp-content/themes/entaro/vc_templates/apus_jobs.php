<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
	'get_job_by' => $get_job_by,
	'posts_per_page' => $posts_per_page,
	'types' => !empty($types) ? array($types) : '',
	'categories' => !empty($category) ? array($category) : '',
);
$loop = entaro_get_listings( $args );
?>
<div class="widget widget-jobs table-visiable <?php echo esc_attr($el_class); ?> <?php echo esc_attr($layout_type); ?>">
	<?php if ($title!=''): ?>
		<div class="widget-title-wrapper">
	        <h3 class="title">
	            <?php echo esc_attr( $title ); ?>
		    </h3>
	    </div>
    <?php endif; ?>
    <div class="content">
		<?php
		if ( $loop->have_posts() ) {
			if ( $layout_type == 'grid' ) {
				$bcol = $columns ? 12/(int)$columns : 4;
				?>
				<div class="row">
					<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
	                    <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-12 col-xs-12">
	                        <?php get_template_part( 'job_manager/loop/list-small'); ?>
	                    </div>
	                <?php endwhile; ?>
                </div>
                <?php
			} else {
				?>
				<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>"
					data-medium="3" data-large="3"
				    data-smallest="2" data-extrasmall="2"
					data-smallmedium="2"
					data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>">
					<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
	                    <?php get_template_part( 'job_manager/loop/list-small'); ?>
	                <?php endwhile; ?>
	            </div>
                <?php
			}
			wp_reset_postdata();
		}
		?>
    </div>
</div>