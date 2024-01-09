<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
wp_enqueue_script( 'jquery-counter', get_template_directory_uri().'/js/jquery.counterup.min.js', array( 'jquery' ) );
wp_enqueue_script( 'waypoints', get_template_directory_uri().'/js/waypoints.min.js', array( 'jquery' ) );
$items = (array) vc_param_group_parse_atts( $members );
if ( !empty($items) ):
?>
	<div class="counters <?php echo esc_attr($el_class.' '.$style); ?>">	
		<div class="row no-margin">	
			<?php foreach ($items as $item): ?>
				<?php $text_color = $item['text_color'] ? $item['text_color'] : ""; ?>
				<?php $bg_color = $item['bg_color'] ? $item['bg_color']: ""; ?>
				<div class="no-padding col-xs-6 col-sm-<?php echo 12/$columns; ?>">			
					<div class="counter-item" <?php if($text_color || $bg_color) echo 'style="color:'.$text_color.'; background:'.$bg_color.'"'; ?>>
				        <?php if (isset($item['number']) && trim($item['number'])!='') { ?>
				        <div class="number">
				            <span class="counter counterUp"><?php echo (int)( $item['number'] );?></span> 
				            <?php if (isset($item['prefix']) && trim($item['prefix'])!='') { ?>
					            <span class="prefix"><?php echo trim($item['prefix']); ?></span>
					        <?php } ?> 
					    </div>
				        <?php } ?>
				        <div class="clearfix">
				       		<span class="line-center"></span>
				        </div>
				        <?php if (isset($item['title']) && trim($item['title'])!='') { ?>
				            <h3 class="title" <?php if($text_color)echo 'style="color:'.$text_color.'"'; ?> ><?php echo trim($item['title']); ?></h3>
				        <?php } ?>
				    </div>
			    </div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>