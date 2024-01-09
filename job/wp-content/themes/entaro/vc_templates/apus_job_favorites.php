<?php 

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="widget widget-job-favorite <?php echo esc_attr($el_class); ?>">
	<?php
	if ( is_user_logged_in() ) {
		if ( class_exists('Entaro_Job_Favorite') ) {
			$ids = Entaro_Job_Favorite::get_favorite();
			if ( !empty($ids) ) {

				$loop = entaro_get_listings( array('ids' => $ids) );
				if ( $loop->have_posts() ) {
				?>	
					<?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
						<?php get_template_part( 'job_manager/loop/list-favorite'); ?>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
				<?php }
			} else {
				?>
				<div class="alert alert-warning"><?php esc_html_e('Do not have any item in your favorite.', 'entaro'); ?></div>
				<?php
			}
		}
	} else {
		?>
		<a href="#">
	        <?php esc_html_e( 'Please login to view this page', 'entaro' ); ?>
	    </a>
		<?php
	}
	?>
</div>