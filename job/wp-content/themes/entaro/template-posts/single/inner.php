<?php
$post_format = get_post_format();
global $post;
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="top-info">
        <?php if ( $post_format == 'gallery' ) {
            $gallery = entaro_post_gallery( get_the_content(), array( 'size' => 'full' ) );
        ?>
            <div class="entry-thumb <?php echo  (empty($gallery) ? 'no-thumb' : ''); ?>">
                <?php echo trim($gallery); ?>
            </div>
        <?php } elseif( $post_format == 'link' ) {
                $format = entaro_post_format_link_helper( get_the_content(), get_the_title() );
                $title = $format['title'];
                $link = entaro_get_link_attributes( $title );
                $thumb = entaro_post_thumbnail('', $link);
                echo trim($thumb);
            } else { ?>
            <div class="entry-thumb <?php echo  (!has_post_thumbnail() ? 'no-thumb' : ''); ?>">
                <?php
                    $thumb = entaro_post_thumbnail();
                    echo trim($thumb);
                ?>
            </div>
        <?php } ?>
    </div>
	<div class="entry-content-detail">
        <div class="post-layout">
            <div class="entry-meta">
                <span class="date-post"><i class="fa fa-calendar-o text-second" aria-hidden="true"></i><?php the_time( get_option('date_format', 'd M, Y') ); ?></span>
                <span class="categories"><i class="fa fa-folder-o text-second" aria-hidden="true"></i><?php entaro_post_categories($post); ?></span>
            </div>
            <?php if (get_the_title()) { ?>
                <h4 class="entry-title">
                    <?php the_title(); ?>
                </h4>
            <?php } ?>
        </div>
    	<div class="single-info info-bottom">
            <div class="entry-description">
                <?php
                    if ( $post_format == 'gallery' ) {
                        $gallery_filter = entaro_gallery_from_content( get_the_content() );
                        echo trim($gallery_filter['filtered_content']);
                    } else {
                        the_content();
                    }
                ?>
            </div><!-- /entry-content -->
    		<?php
    		wp_link_pages( array(
    			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'entaro' ) . '</span>',
    			'after'       => '</div>',
    			'link_before' => '<span>',
    			'link_after'  => '</span>',
    			'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'entaro' ) . ' </span>%',
    			'separator'   => '',
    		) );
    		?>
    		<div class="tag-social clearfix">
                <div class="pull-left">
    			 <?php entaro_post_tags(); ?>
                </div>
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
    	</div>
    </div>
</article>