<?php
    $relate_count = entaro_get_config('number_job_releated', 3);
    $relate_rows = entaro_get_config('releated_job_rows', 3);
    $terms_type = get_the_terms( get_the_ID(), 'job_listing_type' );
    $terms_category = get_the_terms( get_the_ID(), 'job_listing_category' );
    $termids_type = array();
    $termids_category = array();

    if ($terms_type) {
        foreach($terms_type as $term) {
            $termids_type[] = $term->term_id;
        }
    }

    if ($terms_category) {
        foreach($terms_category as $term) {
            $termids_category[] = $term->term_id;
        }
    }

    $args = array(
        'post_type' => 'job_listing',
        'posts_per_page' => $relate_count,
        'post__not_in' => array( get_the_ID() ),
        'tax_query' => array(
            'relation' => 'AND',
            array(
                'taxonomy' => 'job_listing_type',
                'field' => 'id',
                'terms' => $termids_type,
                'operator' => 'IN'
            ),
            array(
                'taxonomy' => 'job_listing_category',
                'field' => 'id',
                'terms' => $termids_category,
                'operator' => 'IN'
            )
        )
    );

    $relates = new WP_Query( $args );
    if( $relates->have_posts() ):
?>
<div class="related-jobs widget">
    <h4 class="widget-title">
        <?php esc_html_e( 'Related Jobs', 'entaro' ); ?>
    </h4>
    <div class="related-jobs-content  widget-content">
        <div class="slick-carousel nav-top" data-carousel="slick" data-smallmedium="1" data-extrasmall="1" data-rows="<?php echo esc_attr($relate_rows); ?>" data-items="1" data-pagination="false" data-nav="true">
            <?php while ( $relates->have_posts() ) : $relates->the_post(); ?>
                <?php get_template_part( 'job_manager/loop/list'); ?>
            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>
</div>
<?php endif; ?>