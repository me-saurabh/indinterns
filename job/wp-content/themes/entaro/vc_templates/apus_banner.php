<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img = wp_get_attachment_image_src($image, 'full');
?>
<div class="widget widget-banner <?php echo esc_attr($el_class.$style);if(isset($img[0])) echo ' has-img'; ?>">
    <?php if ( $url ) { ?>
        <a href="<?php echo esc_url($url); ?>">
    <?php } ?>
        <?php if( isset($img[0]) ) { ?>
            <?php entaro_display_image($img); ?>
        <?php }  ?>
        <div class="infor">
            <?php if ($title!=''): ?>
                <h3 class="title text-theme">
                    <?php echo trim( $title ); ?>
                </h3>
            <?php endif; ?>
            <?php if (!empty($content)) { ?>
                <div class="info-inner">
                    <?php echo trim( $content ); ?>
                </div>
            <?php } ?>
            <?php if ( $show_btn && $btn_text && $url ) { ?>
                <div class="more">
        		  <a href="<?php echo esc_url($url); ?>" class="btn btn-theme btn-outline"><?php echo trim($btn_text); ?></a>
                </div>
        	<?php } ?>
        </div>
    <?php if ( $url ) { ?>
        </a>
    <?php } ?>
</div>