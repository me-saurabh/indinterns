<?php  
$description = get_the_author_meta( 'description' );
?>
<?php if(!empty($description)){ ?>
<div class="author-info widget">
	<div class="about-container media">
		<div class="avatar-img media-left media-middle">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ),150 ); ?>
		</div>
		<!-- .author-avatar -->
		<div class="description media-body media-middle">
			<h4 class="author-title">
				<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
					<?php echo get_the_author(); ?>
				</a>
			</h4>
			<?php the_author_meta( 'description' ); ?>
		</div>
	</div>
</div>
<?php } ?>