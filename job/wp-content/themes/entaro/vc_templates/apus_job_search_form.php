<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="widget no-margin widget-search-form <?php echo esc_attr($el_class.' '.$layout_type.' '.$color_style); ?>">
	<?php if ($title!=''): ?>
        <h3 class="<?php echo esc_attr($layout_type == 'horizontal'?'title':'widget-title'); ?>">
            <span><?php echo trim( $title ); ?></span>
	    </h3>
    <?php endif; ?>
    <?php if ($des!=''): ?>
        <div class="des">
            <span><?php echo esc_attr( $des ); ?></span>
	    </div>
    <?php endif; ?>
    <div class="content">
		<?php get_job_manager_template( 'job-filters-simple.php', $atts ); ?>
    </div>
    <?php if($layout_type == 'vertical p_fix'){ ?>
        <span class="show-search">
            <i class="fa fa-angle-left" aria-hidden="true"></i>
        </span>
    <?php } ?>
</div>