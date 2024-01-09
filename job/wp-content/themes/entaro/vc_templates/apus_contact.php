<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$address = (array) vc_param_group_parse_atts( $address );
$socials = (array) vc_param_group_parse_atts( $socials );
?>
<div class="widget widget-contact-info <?php echo esc_attr($el_class); ?>" >
    <?php if ($title!=''): ?>
        <h3 class="widget-title">
            <span><?php echo esc_attr( $title ); ?></span>
        </h3>
    <?php endif; ?>
    <div class="content">
	    <?php if ( !empty($address) ): ?>
	    	<div class="info">
		    	<?php foreach ($address as $item): ?>
				    <div class="info-item">
				    	<?php if (isset($item['icon']) && trim($item['icon'])!='') { ?>
				            <div class="icon"> <i class="<?php echo trim( $item['icon'] );?>"></i> </div>  
				        <?php } ?>
				    	<?php if (isset($item['des']) && trim($item['des'])!='') { ?>
				            <div class="des"><?php echo trim( $item['des'] );?></div>  
				        <?php } ?>
				    </div>
			    <?php endforeach; ?>
		    </div>
		<?php endif; ?>
	   	<?php if ( !empty($socials) ): ?>
	    	<div class="socials">
		    	<?php foreach ($socials as $item): ?>
			    	<?php if (isset($item['icon']) && trim($item['icon'])!='') { ?>
			            <a class="icon" href="<?php echo (isset($item['link']) && trim($item['link'])!='') ? $item['link'] : '#'; ?>"> <i class="<?php echo esc_attr( $item['icon'] );?>"></i> </a>  
			        <?php } ?>
			    <?php endforeach; ?>
		    </div>
		<?php endif; ?>
	</div>
</div>