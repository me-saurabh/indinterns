<?php
extract( $args );
extract( $instance );
$title = apply_filters('widget_title', $instance['title']);

if ( $title ) {
    echo trim($before_title)  . trim( $title ) . $after_title;
}
$args = array(
	'post_type' => 'post',
	'posts_per_page' => $number_post
);

$query = new WP_Query($args);
if($query->have_posts()):
?>
<div class="post-widget">
<ul class="posts-list">
<?php
	while($query->have_posts()):$query->the_post();
?>
	<li>
		<article class="post post-list">
		    <div class="entry-content">
		    	<?php
					if(has_post_thumbnail()){
				?>
					<a href="<?php the_permalink(); ?>" class="image pull-left">
						<?php the_post_thumbnail( 'widget' ); ?>
					</a>
				<?php } ?>
				<div class="content-info">
			         <?php
			              if (get_the_title()) {
			              ?>
			                  <h4 class="entry-title">
			                      <a href="<?php the_permalink(); ?>"><?php echo entaro_substring( get_the_title(), 6, '...' ); ?></a>
			                  </h4>
			              <?php
			          }
			        ?>
			        <div class="date">
			        	<?php the_time( get_option('date_format', 'M d, Y') ); ?>
			        </div>
			    </div>
		    </div>
		</article>
	</li>
<?php endwhile; ?>
<?php wp_reset_postdata(); ?>
</ul>
</div>
<?php endif; ?>