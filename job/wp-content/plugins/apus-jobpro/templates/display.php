<?php
global $post;

if ( $terms = ApusJobpro_Taxonomy_Tags::get_job_tag_list( $post->ID ) ) {
	echo'<p class="job_tags">' . esc_html__( 'Tagged as:', 'jobpro' ) . ' ' . $terms . '</p>';
}