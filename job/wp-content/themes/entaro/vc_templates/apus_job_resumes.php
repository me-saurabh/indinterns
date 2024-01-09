<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$args = array(
	'orderby' => $orderby,
	'orderway' => $orderway,
	'posts_per_page' => $posts_per_page,
	'categories' => !empty($category) ? array($category) : '',
);
$loop = entaro_get_resumes( $args );
?>
<div class="widget widget-resumes <?php echo esc_attr($el_class); ?> <?php echo esc_attr($layout_type); ?>">
	<?php if ($title!=''): ?>
        <h3 class="widget-title line-center">
            <?php echo esc_attr( $title ); ?>
	    </h3>
    <?php endif; ?>
    <div class="widget-content">
		<?php
		if ( $loop->have_posts() ) {
			if ( $layout_type == 'grid' ) {
				$bcol = $columns ? 12/(int)$columns : 4;
				?>
				<div class="row">
					<?php while ( $loop->have_posts() ): $loop->the_post(); global $post; ?>
	                    <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12 item-list">
	                        <?php get_template_part( 'wp-job-manager-resumes/loop/list',$item_style); ?>
	                    </div>
	                <?php endwhile; ?>
                </div>
                <?php
			} elseif ( $layout_type == 'list' ) { ?>
					<?php while ( $loop->have_posts() ): $loop->the_post(); global $post; ?>
                        <?php get_template_part( 'wp-job-manager-resumes/loop/list',$item_style); ?>
	                <?php endwhile; ?>
                <?php
			} else {
				?>
				<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>"
					data-medium="2" data-large="2"
				    data-smallest="1" data-extrasmall="1"
					data-smallmedium="1"
					data-pagination="<?php echo esc_attr( $show_pagination ? 'true' : 'false' ); ?>" data-nav="<?php echo esc_attr( $show_nav ? 'true' : 'false' ); ?>" data-rows="<?php echo esc_attr( $rows ); ?>">
					<?php while ( $loop->have_posts() ): $loop->the_post(); global $post; ?>
	                    <?php get_template_part( 'wp-job-manager-resumes/loop/list',$item_style); ?>
	                <?php endwhile; ?>
	            </div>
                <?php
			}
			wp_reset_postdata();
		}
		?>
		<?php if ( $show_btn ) { ?>
			<?php if($layout_type != 'list') echo '<div class="text-center clear-bottom">'; ?>
	    		<a class="<?php echo esc_attr($item_style == 'v1'?'link-more':'btn btn-theme'); ?>" href="<?php echo esc_url($url); ?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> <?php echo trim($btn_text); ?></a>
	    	<?php if($layout_type != 'list') echo '</div>'; ?>
    	<?php } ?>
    </div>
</div>