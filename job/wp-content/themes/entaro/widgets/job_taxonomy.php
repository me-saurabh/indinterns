<?php
extract( $args );
extract( $instance );

$title = apply_filters('widget_title', $instance['title']);
global $wp_query;
$selected = isset( $wp_query->query_vars['term'] ) ? $wp_query->query_vars['term']: '';

$terms = get_terms(
	array(
		'taxonomy' => $taxonomy,
    	'hide_empty' => false,
	)
);

if ( $title ) {
    echo trim($before_title)  .trim( $title ) . $after_title;
}

?>
<div class="widget-job-taxonomy">
	<?php if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { ?>
		<ul>
			<?php foreach ($terms as $term) { ?>
				<li><a class="<?php echo esc_attr($selected == $term->slug ? 'active' : ''); ?>" href="<?php echo esc_url(get_term_link($term, $taxonomy)); ?>"><?php echo sprintf(__('%s', 'entaro'), $term->name); ?> <span class="text-theme"><?php echo sprintf(__('(%d)', 'entaro'), $term->count); ?></span></a></li>
			<?php } ?>
		</ul>
	<?php } ?>
</div>