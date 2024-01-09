<?php
global $post;
$video = get_the_company_video( $post );
if ( $video ) {
?>
	<div id="job-video" class="job-video widget">
		<h3 class="widget-title"><span><?php esc_html_e('Video', 'entaro'); ?></span></h3>
		<div class="box-inner">
			<?php the_company_video(); ?>
		</div>
	</div>
<?php } ?>