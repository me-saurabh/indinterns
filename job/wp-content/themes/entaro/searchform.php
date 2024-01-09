<?php
/**
 *
 * Search form.
 * @since 1.0.0
 * @version 1.0.0
 *
 */
?>
<div class="widget-search">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="input-group">
			<input type="text" placeholder="<?php echo esc_attr(esc_html__( 'Search', 'entaro' )); ?>" name="s" class="form-control"/>
			<span class="input-group-btn"> <button type="submit" class="btn"><i class="fa fa-search"></i></button> </span>
		</div>
		<input type="hidden" name="post_type" value="post" class="post_type" />
	</form>
</div>