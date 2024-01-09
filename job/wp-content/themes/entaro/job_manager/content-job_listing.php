<?php
$columns = entaro_get_listing_item_columns();
$bcol = 12/$columns;
$item_stype = entaro_get_listing_display_mode();
$class = 'md-clear-'.$columns.' col-md-'.$bcol.' col-sm-6 col-xs-12 list-item-job';
?>
<div class="<?php echo esc_attr($class); ?>	">
	<?php get_template_part( 'job_manager/loop/'.$item_stype ); ?>
</div>