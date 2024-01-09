<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( defined('WPB_VC_VERSION') && version_compare( WPB_VC_VERSION, '6.0', '>=' ) ) {
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'orderby' => $orderby,
        'order' => $order,
        'posts_per_page' => $posts_per_page
    );
    if ( $category ) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $category,
            ),
        );
    }

    if ( get_query_var( 'paged' ) ) {
        $paged = get_query_var( 'paged' );
    } elseif ( get_query_var( 'page' ) ) {
        $paged = get_query_var( 'page' );
    } else {
        $paged = 1;
    }
    $args['paged'] = $paged;
    $loop = new WP_Query($args);
    
} else {
    if ( empty($loop) ) return;

    $this->getLoop($loop);
    $args = $this->loop_args;
    $posts_per_page = isset($args['posts_per_page']) ? $args['posts_per_page'] : 4;
    if ( get_query_var( 'paged' ) ) {
        $paged = get_query_var( 'paged' );
    } elseif ( get_query_var( 'page' ) ) {
        $paged = get_query_var( 'page' );
    } else {
        $paged = 1;
    }
    $args['paged'] = $paged;
    $loop = new WP_Query($args);
}
set_query_var( 'thumbsize', $thumbsize );
$style_item = (!empty($style_item)) ? $style_item : 'inner-grid-v2';
?>
<div class="widget widget-blogs <?php echo esc_attr($layout_type); ?> <?php echo esc_attr($el_class); ?>">
    <?php if ($title!=''): ?>
        <h3 class="widget-title <?php echo esc_attr(($style_item == 'inner-grid-v3')?'line-center':''); ?>">
            <span><?php echo esc_attr( $title ); ?></span>
        </h3>
    <?php endif; ?>
    <div class="content">
        <?php $columns = $grid_columns; ?>
        <?php $post_item = '_single'; ?>
        <?php if ( $layout_type == 'carousel' ): ?>
            <div class="slick-carousel <?php echo esc_attr(($style_item == 'inner-grid-v3')?'':'nav-top'); ?>" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
                <?php while ( $loop->have_posts() ): $loop->the_post(); global $product; ?>
                    <div class="item">
                        <?php get_template_part( 'template-posts/loop/'.$style_item); ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php elseif ( $layout_type == 'grid' ): ?>
            <?php $bcol = 12/$columns; ?>
            <div class="layout-blog style-grid">
                <div class="row">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                        <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-6 col-xs-12">
                            <?php get_template_part( 'template-posts/loop/'.$style_item ); ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php else: ?>
            <ul class="list-no">
                <?php while ( $loop->have_posts() ) : $loop->the_post(); ?>
                    <li>
                        <?php get_template_part( 'template-posts/loop/inner-list-short' ); ?>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
    </div>
    <?php if ( isset($show_pagination) && $show_pagination && $layout_type != 'carousel' ): ?>
        <?php entaro_pagination( $posts_per_page, $loop->found_posts, $loop->max_num_pages ); ?>
    <?php endif ; ?>
</div>
<?php wp_reset_postdata(); ?>