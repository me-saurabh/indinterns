<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
?>
<div class="clearfix widget-action <?php echo esc_attr($el_class.' '.$style); ?>">
	<?php if($title!=''): ?>
        <h3 class="title" >
           <span><?php echo esc_attr( $title ); ?></span>
        </h3>
    <?php endif; ?>
    <?php if($subtitle!=''): ?>
        <h4 class="sub-title"><?php echo esc_attr( $subtitle ); ?></h4>
    <?php endif; ?>
    <?php if(wpb_js_remove_wpautop( $content, true )){ ?>
        <div class="description">
            <?php echo wpb_js_remove_wpautop( $content, true ); ?>
        </div>
    <?php } ?>
    <?php if(trim($linkbutton1)!='' || trim($linkbutton2)!='' ){ ?>
        <div class="action">
            <?php if(trim($linkbutton1)!=''){ ?>
            <a class="btn <?php echo esc_attr( $buttons1 ); ?>" href="<?php echo esc_attr( $linkbutton1 ); ?>"> <span><?php echo trim( $textbutton1 ); ?></span> </a>
            <?php } ?>
            <?php if(trim($linkbutton2)!=''){ ?>
            <a class="btn <?php echo esc_attr( $buttons2 ); ?>" href="<?php echo esc_attr( $linkbutton2 ); ?>"> <span><?php echo trim( $textbutton2 ); ?></span> </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>