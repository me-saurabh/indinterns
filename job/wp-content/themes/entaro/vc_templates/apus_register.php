<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$style_box = '';
$items = (array) vc_param_group_parse_atts( $members );
$count = 1;
if ( !empty($items) ):
?>
	<div class="apus-register <?php echo esc_attr($el_class.' '.$style); ?>">	
		<div class="row no-margin <?php echo esc_attr(($columns == 1)?'st_full':'table-visiable-lt'); ?>">
			<?php foreach ($items as $item): ?>
				<?php if ( isset($item['image_icon']) && $item['image_icon'] ) $image_icon = wp_get_attachment_image_src($item['image_icon'],'full'); ?>
				<?php if ( isset($item['image']) && $item['image'] ) {
					$image = wp_get_attachment_image_src($item['image'],'full');
					$style_box = 'style="background-image:url('.$image[0].')"';
				}
				?>
				<div class="no-padding col-xs-12 col-sm-<?php echo 12/$columns; ?> col-xs-12">	
					<div class="item <?php echo esc_attr($item['style']); ?>" <?php echo trim($style_box); ?>>
						<?php if (isset($item['price']) && trim($item['price'])!='') { ?>
				            <span class="price"><?php echo trim($item['price']); ?></span>
				        <?php } ?>
						<?php if(isset( $image_icon[0]) && $image_icon[0] ) { ?>
							<div class="icon-mg">
								<img class="img" src="<?php echo esc_url_raw($image_icon[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
							</div>
						<?php } ?>
				        <?php if (isset($item['title']) && trim($item['title'])!='') { ?>
				            <h3 class="title"><?php echo trim($item['title']); ?></h3>
				        <?php } ?>
				        <div class="line-under"></div>
				        <?php if (isset($item['des']) && trim($item['des'])!='') { ?>
				            <div class="description"><?php echo trim( $item['des'] );?></div>  
				        <?php } ?>

	 					<?php if (isset($item['link']) && trim($item['link'])!='' && ($item['text_link']) ) { ?>
				            <a class="btn <?php echo esc_attr($item['style'] == 'style2'? 'btn-second':'btn-theme'); ?>" href="<?php echo esc_url($item['link']); ?>"><i aria-hidden="true" class="fa fa-plus-circle"></i> <?php echo trim($item['text_link']); ?></a>  
				        <?php } ?>
				        <?php if ($space!='' && count($items) > 1 && $count<count($items) ): ?>
					        <div class="space"><span><?php echo trim( $space ); ?></span></div>
						<?php endif; ?>
			        </div>
			    </div>
			<?php $count++; endforeach; ?>
		</div>
	</div>
<?php endif; ?>