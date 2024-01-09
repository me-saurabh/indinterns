<?php 
$thumbsize = !isset($thumbsize) ? entaro_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;
$thumb = entaro_display_post_thumb($thumbsize);
?>
<article <?php post_class('post post-layout'); ?>>
    <div class="list-inner list-short table-visiable">
       <?php
            if ( !empty($thumb) ) {
                ?>
                <div class="image">
                    <?php echo trim($thumb); ?>
                </div>
                <?php
            }
        ?>
        <div class="info">
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                </h4>
            <?php } ?>
            <div class="entry-meta">
                <span class="date-post"><i class="fa fa-calendar-o text-second" aria-hidden="true"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
            </div>
        </div>
    </div>
</article>