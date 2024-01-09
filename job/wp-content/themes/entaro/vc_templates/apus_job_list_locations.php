<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$terms = get_terms(
	array(
	    'taxonomy' => 'job_listing_region',
	    'hide_empty' => false,
	    'number' => $posts_per_page
	)
);
?>
<div class="widget widget-list-locations <?php echo esc_attr($el_class); ?>">
	<div class="widget-title-wrapper">
		<?php if ($title!=''): ?>
	        <h3 class="widget-title">
	            <span><?php echo esc_attr( $title ); ?></span>
		    </h3>
	    <?php endif; ?>
    </div>
    <div class="widget-content">
		<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){ ?>
			<ul>
				<?php foreach ($terms as $term) { ?>
					<li><a href="<?php echo esc_url(get_term_link($term)); ?>"><?php echo sprintf(__('%s %s ', 'entaro'), $prefix_title, $term->name); ?></a><?php echo sprintf(__(' (%d)', 'entaro'), $term->count); ?></li>
	        	<?php } ?>
        	</ul>
        	<?php if ( $show_btn ) { ?>
	        	<div class="clear-bottom">
	        		<a class="btn-view-all link-more" href="<?php echo esc_url($url); ?>"><i class="fa fa-plus-circle" aria-hidden="true"></i> <?php echo esc_attr($btn_text); ?></a>
        		</div>
        	<?php } ?>
        <?php } ?>
    </div>
</div>