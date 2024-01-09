<?php 
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$time = strtotime( $input_datetime );

?>
<div class="banner-countdown-widget <?php echo esc_attr($el_class.' '.$style_widget); ?>">

	<?php if (wpb_js_remove_wpautop( $content, true )) { ?>
		<div class="title"><?php echo wpb_js_remove_wpautop( $content, true ); ?></div>
	<?php } ?>

	<?php if( !empty($descript) ) { ?>
		<div class="des"><?php echo trim($descript); ?></div>
	<?php } ?>	

	<div class="countdown-wrapper">
	    <div class="apus-countdown" data-time="timmer"
	         data-date="<?php echo date('m',$time).'-'.date('d',$time).'-'.date('Y',$time).'-'. date('H',$time) . '-' . date('i',$time) . '-' .  date('s',$time) ; ?>">
	    </div>
	</div>

	<?php if ( !empty($btn_url) && !empty($btn_text) ) { ?>
	    <a class="btn btn-theme <?php if($style_widget == 'dark') echo 'btn-outline'; ?>" href="<?php echo esc_attr($btn_url); ?>" ><?php echo esc_attr($btn_text); ?> </a>
    <?php } ?>

</div>