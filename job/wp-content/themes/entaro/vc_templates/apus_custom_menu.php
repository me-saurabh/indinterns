<?php
$title = $nav_menu = $el_class = $align = '';
$output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
if ($nav_menu) {
	$term = get_term_by( 'slug', $nav_menu, 'nav_menu' );
	if ( !empty($term) ) {
		$atts['nav_menu'] = $term->term_id;
	}
}

$el_class = $this->getExtraClass( $el_class );

$output = '<div class="apus_custom_menu wpb_content_element' . esc_attr( $el_class.' '.$align ) . '">';
$type = 'WP_Nav_Menu_Widget';
$args = array();
global $wp_widget_factory;
// to avoid unwanted warnings let's check before using widget
if ( is_object( $wp_widget_factory ) && isset( $wp_widget_factory->widgets, $wp_widget_factory->widgets[ $type ] ) ) {
	ob_start();
	the_widget( $type, $atts, $args );
	$output .= ob_get_clean();

	$output .= '</div>';

	echo trim($output);
} else {
	echo trim($this->debugComment( 'Widget ' . esc_attr( $type ) . 'Not found in : apus_custom_menu' ));
}