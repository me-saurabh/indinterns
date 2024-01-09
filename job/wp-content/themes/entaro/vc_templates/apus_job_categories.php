<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$categories = (array) vc_param_group_parse_atts( $categories );
if ( !empty($categories) ):
	$bcol = 12/$columns;

?>
	<div class="no-margin widget widget-job-categories <?php echo esc_attr($el_class); ?> <?php echo esc_attr($style); ?>">
		<?php if ($title!=''): ?>
	        <h3 class="widget-title <?php if($style == 'style1' || $style == 'style3') echo 'line-center'; ?>">
	            <?php echo wp_kses_post( $title ); ?>
	        </h3>
	    <?php endif; ?>
		<div class="row row-item <?php if($style == 'default') echo 'table-visiable-lt'; ?>">
			<?php foreach ($categories as $item) { ?>
				<?php
				if ( empty($item['category']) ) {
					continue;
				}

				$term = get_term_by('slug', $item['category'], 'job_listing_category');
				if ( is_object($term) ) {
				?>
					<div class="col-sm-<?php echo esc_attr($bcol); ?> col-xs-6">
						<a href="<?php echo esc_url(get_term_link($term)); ?>" class="category-wrapper-item <?php echo esc_attr($style); ?>">
							<?php
								if ( !empty($item['image_icon']) ) {
									$img = wp_get_attachment_image_src($item['image_icon'], 'full');
								}
								if ( !empty($item['image_icon_hover']) ) {
									$img_hover = wp_get_attachment_image_src($item['image_icon_hover'], 'full');
								}
							?>
							<div class="icon-wrapper">
								<?php if ( !empty($img[0]) ) { ?>
									<div class="icon-ig">
										<img class="<?php echo esc_attr(!empty($img_hover[0]) ? 'has-image-hover' : ''); ?>" src="<?php echo esc_url_raw($img[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
										<?php if ( !empty($img_hover[0]) ) { ?>
											<img class="image-hover" src="<?php echo esc_url_raw($img_hover[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
										<?php } ?>
									</div>
								<?php } elseif ( !empty($item['font_icon']) ) { ?>
							           	<i class="<?php echo esc_attr($item['font_icon']); ?>"></i>
							    <?php } ?>
							</div>
							<div class="content-wrapper">
								<?php if ( !empty($item['title']) ) { ?>
						            <h3 class="category-title"><?php echo trim($item['title']); ?></h3>
						        <?php } else { ?>
						        	<div class="category-title"><?php echo trim($term->name); ?></div>
						        <?php } ?>
						        <div class="count">
						        	<?php echo sprintf(_n('%d Job', '%d Jobs', $term->count, 'entaro'), $term->count); ?>
						        </div>
							</div>
						</a>
					</div>
				<?php } ?>
			<?php } ?>
		</div>
	</div>
<?php endif; ?>