<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$args = array(
	'post_type' => 'apus_testimonial',
	'posts_per_page' => $number,
	'post_status' => 'publish',
);
$loop = new WP_Query($args);
$show_nav = ($show_nav == 'yes')?'true':'false';
$show_pag = ($show_pag == 'yes')?'true':'false';
?>
<div class="widget widget-testimonials <?php echo esc_attr($el_class.' '.$style); if(!empty($style)) echo ' white'; ?>">
    <?php if ( trim($title)!='' ) { ?>
        <h3 class="widget-title <?php echo esc_attr($title_color.' '.$title_align);?>">
            <?php echo wp_kses_post( $title ); ?>
        </h3>
    <?php } ?>
	<?php if ( $loop->have_posts() ): ?>
        <div class="content">
            <div class="owl-carousel-wrapper">
                <div class="slick-carousel <?php echo esc_attr(in_array($style,array('v1','v3')) ? 'nav-top':''); ?> <?php echo esc_attr($style == 'v2' ? 'nav-bottom-center':''); ?>" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" 
                    <?php if($columns < 2){ ?>
                        data-smallmedium="1" 
                    <?php }else{ ?>
                        data-smallmedium="2" 
                    <?php } ?>
                    data-extrasmall="1" 
                    data-pagination="<?php echo esc_attr($show_pag); ?>" data-nav="<?php echo esc_attr($show_nav); ?>">
                    <?php while ( $loop->have_posts() ): $loop->the_post(); ?>
                      <?php get_template_part( 'template-parts/testimonial/testimonial', $style ); ?>
                    <?php endwhile; ?>
                </div>
            </div>
        </div>
	<?php endif; ?>
</div>
<?php wp_reset_postdata(); ?>