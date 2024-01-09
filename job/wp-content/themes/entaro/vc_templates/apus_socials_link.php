<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$socials = array('facebook' => esc_html__('Facebook', 'entaro'), 'twitter' => esc_html__('Twitter', 'entaro'),
	'youtube' => esc_html__('Youtube', 'entaro'), 'pinterest' => esc_html__('Pinterest', 'entaro'),
	'google-plus' => esc_html__('Google Plus', 'entaro'), 'instagram' => esc_html__('Instagram', 'entaro'));
?>
<div class="widget widget-social <?php echo esc_attr($el_class.' '.$align.' '.$style); ?>">
    <?php if ($title!=''): ?>
        <h3 class="title">
            <?php echo esc_attr( $title ); ?>
        </h3>
    <?php endif; ?>
    <div class="widget-des">
    	<?php if ($description != ''): ?>
	        <?php echo trim($description); ?>
	    <?php endif; ?>
		<ul class="social">
		    <?php foreach( $socials as $key=>$social):
		            if( isset($atts[$key.'_url']) && !empty($atts[$key.'_url']) ): ?>
		                <li>
		                    <a href="<?php echo esc_url($atts[$key.'_url']);?>" class="<?php echo esc_attr($key); ?>">
		                        <i class="fa fa-<?php echo esc_attr($key); ?> "></i>
		                    </a>
		                </li>
		    <?php
		            endif;
		        endforeach;
		    ?>
		</ul>
	</div>
</div>