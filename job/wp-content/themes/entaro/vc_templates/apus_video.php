<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="widget-video">
	<?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo trim($title); ?></span>
        </h3>
    <?php endif; ?>
    <?php if(wpb_js_remove_wpautop( $content, true )){ ?>
        <div class="description">
            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
        </div>
    <?php } ?>
    <div class="video-wrapper-inner">
    	<div class="video">
    		<?php $img = wp_get_attachment_image_src($image,'full'); ?>
    		<?php if ( !empty($img) && isset($img[0]) ): ?>
    			<a class="popup-video" href="<?php echo esc_url_raw($video_link); ?>">
                    <span class="icon"><i class="fa fa-play" aria-hidden="true"></i></span>
            		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
            	</a>
            <?php endif; ?>
    	</div>
	</div>
</div>