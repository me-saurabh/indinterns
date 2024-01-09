<?php
$columns = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$items = (array) vc_param_group_parse_atts( $items );
if ( !empty($items) ):
$count = 1;
?>
	<div class="widget widget-features-box <?php echo esc_attr($el_class.' '.$style); ?>">
		<?php if ($title!=''): ?>
	        <h3 class="widget-title <?php echo esc_attr($title_color.' '.$title_align);?>">
	            <?php echo esc_attr( $title ); ?>
		    </h3>
		<?php endif; ?>
		<div class="content clearfix">
			<div class="row">
				<?php foreach ($items as $item): ?>

					<?php if($count%$columns == 1) echo '<div class="list-row clearfix">'; ?>

						<div class="col-xs-12 col-sm-<?php echo (12/$columns); ?>">
						<?php if ( isset($item['image']) && $item['image'] ) $image_bg = wp_get_attachment_image_src($item['image'],'full'); ?>
						<?php if ( isset($item['image_hover']) && $item['image_hover'] ) $image_hover_bg = wp_get_attachment_image_src($item['image_hover'],'full'); ?>
							<div class="feature-box-default clearfix">
								<div class="fbox-icon">
									<?php if(isset( $image_bg[0]) && $image_bg[0] ) { ?>
											<img class="img <?php if(isset( $image_hover_bg[0]) && $image_hover_bg[0] ) echo 'hidden-hover'; ?>" src="<?php echo esc_url_raw($image_bg[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
											<?php if(isset( $image_hover_bg[0]) && $image_hover_bg[0] ) { ?>
												<img class="img_hover" src="<?php echo esc_url_raw($image_hover_bg[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
											<?php } ?>
									<?php }elseif (isset($item['icon']) && $item['icon']) { ?>
								           	<i class="<?php echo esc_attr($item['icon']); ?>"></i>
								    <?php } ?>
								</div>
							    <div class="fbox-content ">  
							    	<?php if (isset($item['title']) && trim($item['title'])!='') { ?>
							            <h3 class="ourservice-heading"><?php echo trim($item['title']); ?></h3>
							        <?php } ?>
							         <?php if (isset($item['description']) && trim($item['description'])!='') { ?>
							            <div class="description"><?php echo trim( $item['description'] );?></div>  
							        <?php } ?>
							    </div> 
						    </div>
						</div>

					<?php if( $count%$columns == 0 || $count == count($items) ) echo '</div>'; ?>

				<?php $count++; endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>