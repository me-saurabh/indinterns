<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$companies = (array) vc_param_group_parse_atts( $companies );
if ( !empty($companies) ):
	$bcol = 12/$columns;
?>
	<div class="widget widget-job-companies <?php echo esc_attr($el_class); ?> <?php echo esc_attr($widget_style); ?>">
		<?php if($title!=''): ?>
	        <h3 class="widget-title" >
	           <span><?php echo esc_attr( $title ); ?></span>
	        </h3>
	    <?php endif; ?>
		<?php if ( $layout_type == 'grid' ) { ?>
			<div class="row row-list">
				<?php foreach ($companies as $item) { ?>
					<?php
					if ( empty($item['company']) ) {
						continue;
					}
					$args = array( 'company' => $item['company'] );
					$loop = entaro_get_listings($args);
					$url = Entaro_Job_Manager_Company::get_url($item['company']);
					?>
					<div class="item-list col-sm-<?php echo esc_attr($bcol); ?> col-xs-6">
						<a href="<?php echo esc_url($url); ?>">
							<div class="company-wrapper">
								<?php
									if ( !empty($item['image_icon']) ) {
										$img = wp_get_attachment_image_src($item['image_icon'], 'full');
									}
								?>
								<?php if ( !empty($img[0]) ) { ?>
									<div class="icon-wrapper">
										<img src="<?php echo esc_url_raw($img[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
									</div>
								<?php } ?>
								<div class="content-wrapper">
									<?php if ( !empty($item['title']) ) { ?>
							            <h3 class="company-title"><?php echo trim($item['title']); ?></h3>
							        <?php } else { ?>
							        	<h3 class="company-title"><?php echo trim($item['company']); ?></h3>
							        <?php } ?>
							        <?php if ( !empty($item['location']) ) { ?>
								        <div class="location"><?php echo sprintf(__('(%s)', 'entaro'), $item['location']); ?></div>
							        <?php } ?>
							        <div class="count ">
							        	<span class="btn-conpany">
							        		<?php echo sprintf(esc_html__('%d Opening', 'entaro'), $loop->found_posts); ?>
							        	</span>
							        </div>
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		<?php } else { ?>
			<div class="slick-carousel nav-top" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="2" data-pagination="false" data-nav="true" data-rows="<?php echo esc_attr($rows); ?>">
				<?php foreach ($companies as $item) { ?>
					<?php
					if ( empty($item['company']) ) {
						continue;
					}
					$args = array( 'company' => $item['company'] );
					$loop = entaro_get_listings($args);
					$url = Entaro_Job_Manager_Company::get_url($item['company']);
					?>
					<div class="col-sm-<?php echo esc_attr($bcol); ?> col-xs-6">
						<a href="<?php echo esc_url($url); ?>">
							<div class="company-wrapper">
								<?php
									if ( !empty($item['logo']) ) {
										$img = wp_get_attachment_image_src($item['logo'], 'full');
									}
								?>
								<?php if ( !empty($img[0]) ) { ?>
									<div class="icon-wrapper">
										<img src="<?php echo esc_url_raw($img[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
									</div>
								<?php } ?>
								<div class="content-wrapper">
									<?php if ( !empty($item['title']) ) { ?>
							            <h3 class="company-title"><?php echo trim($item['title']); ?></h3>
							        <?php } else { ?>
							        	<h3 class="company-title"><?php echo trim($item['company']); ?></h3>
							        <?php } ?>
							        <?php if ( !empty($item['location']) ) { ?>
								        <div class="location"><?php echo sprintf(__('(%s)', 'entaro'), $item['location']); ?></div>
							        <?php } ?>
							        <div class="count">
							        	<span class="btn-conpany">
							        		<?php echo sprintf(esc_html__('%d Opening', 'entaro'), $loop->found_posts); ?>
							        	</span>
							        </div>
								</div>
							</div>
						</a>
					</div>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
<?php endif; ?>