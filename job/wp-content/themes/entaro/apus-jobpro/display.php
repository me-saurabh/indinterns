<?php
global $post;

if ( $terms = ApusJobpro_Taxonomy_Tags::get_job_tag_list( $post->ID ) ) {
	echo'<div class="job_tags"><i aria-hidden="true" class="fa fa-tags text-theme"></i><strong>' . esc_html__( 'Tagged as:', 'entaro' ) . '</strong>  ' . $terms . '</div>';
}