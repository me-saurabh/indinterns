<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);
?>
<div class="single-image">
	<?php
	if ( $title ) {
	    echo trim($before_title)  . trim( $title ) . $after_title;
	}
	?>
	<?php if ( $single_image ) { ?>
		<?php if ( $link ) { ?>
			<a href="<?php echo esc_url($link); ?>">
		<?php } ?>
		<img src="<?php echo esc_attr( $single_image ); ?>" alt="<?php echo esc_attr($alt); ?>">
		<?php if ( $link ) { ?>
			</a>
		<?php } ?>
	<?php } ?>
</div>