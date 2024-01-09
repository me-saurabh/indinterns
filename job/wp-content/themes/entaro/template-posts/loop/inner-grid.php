<?php $thumbsize = !isset($thumbsize) ? entaro_get_config( 'blog_item_thumbsize', 'full' ) : $thumbsize;?>
<?php $cat = wp_get_post_categories( $post->ID ); ?>
<article <?php post_class('post post-layout post-grid-v1'); ?>>
    <?php
        $thumb = entaro_display_post_thumb($thumbsize);
        echo trim($thumb);
    ?>
    <div class="entry-content <?php if(empty($thumb)) echo 'no-img'; ?>">
        <div class="entry-meta">
            <span class="date-post"><i class="fa fa-calendar-o text-second" aria-hidden="true"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
            <?php if($cat && !empty($cat)) { ?>
                <span class="categories"><i class="fa fa-folder-o text-second" aria-hidden="true"></i><?php entaro_post_categories($post); ?></span>
            <?php } ?>
        </div>
        <?php if (get_the_title()) { ?>
            <h4 class="entry-title">
                <a href="<?php the_permalink(); ?>">
                    <?php the_title(); ?>
                </a>
            </h4>
        <?php } ?>
        <?php if (! has_excerpt()) { ?>
            <div class="description"><?php echo entaro_substring( get_the_content(), 40, '...' ); ?></div>
        <?php } else { ?>
            <div class="description"><?php echo entaro_substring( get_the_excerpt(), 40, '...' ); ?></div>
        <?php } ?>
    </div>
    <div class="author-share clearfix">
        <div class="pull-left">
            <div class="clearfix media info-author">
                <div class="avatar-img media-left media-middle">
                    <?php echo get_avatar( get_the_author_meta( 'user_email' ),120 ); ?>
                </div>
                <div class="media-body media-middle">
                    <a class="name-author" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <?php echo get_the_author(); ?>
                    </a>
                </div>
            </div>          
        </div>
        <div class="pull-right right-social">
            <?php if( entaro_get_config('show_blog_social_share', false) ) {
                get_template_part( 'template-parts/sharebox' );
            } ?>
            <div class="comment-icon">
                <img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/img_comment.png'); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
                <span class="icon-com">
                    <?php comments_number( '0', '1', '%' ); ?>
                </span>
            </div>
        </div>
    </div>
</article>