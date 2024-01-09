<?php $thumbsize = !isset($thumbsize) ? entaro_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<article <?php post_class('post post-layout post-grid-v3'); ?>>
    <?php
        $thumb = entaro_display_post_thumb($thumbsize);
        echo trim($thumb);
    ?>
    <div class="content_2">
         <div class="entry-content">
            <a class="name-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                <i class="fa fa-user" aria-hidden="true"></i><?php echo get_the_author(); ?>
            </a>
            <span class="date-post"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
        </div>
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>"><?php echo entaro_substring( get_the_title(),6, '' ); ?></a>
            </h4>
        <?php } ?>
        <?php if (! has_excerpt()) { ?>
            <div class="description"><?php echo entaro_substring( get_the_content(),12, '...' ); ?></div>
        <?php } else { ?>
            <div class="description"><?php echo entaro_substring( get_the_excerpt(), 12, '...' ); ?></div>
        <?php } ?>
    
        <div class=" clearfix">
            <a class="btn-v3" href="<?php the_permalink(); ?>"><?php echo esc_html__('Read Article','entaro'); ?><i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
        </div>
    </div>
</article>