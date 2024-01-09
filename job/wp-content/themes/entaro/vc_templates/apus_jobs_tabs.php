<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$tabs = (array) vc_param_group_parse_atts( $tabs );
if ( !empty($tabs) ):
$_id = entaro_random_key();
$item_style = (isset($item_style))? $item_style: 'list';
?>
	<div class="widget widget-jobs-tabs <?php echo esc_attr($el_class); ?> <?php echo esc_attr($layout_type); ?>">
		<div class="widget-title-wrapper">
			<?php if ($title!=''): ?>
		        <h3 class="widget-title <?php echo esc_attr($layout_type == 'st_center'?'line-center':''); ?>">
		            <span><?php echo esc_attr( $title ); ?></span>
			    </h3>
		    <?php endif; ?>

		    <ul class="nav nav-tabs tab-jobs">
				<?php $i = 0; foreach ($tabs as $item) { ?>
					<li <?php echo trim($i == 0 ? 'class="active"' : ''); ?>>
						<a data-toggle="tab" href="#<?php echo sprintf('jobstab-%s-%s', $i, $_id); ?>"><?php echo trim($item['title']); ?></a>
					</li>
				<?php $i++;} ?>
			</ul>

	    </div>
		<div class="widget-content">
			<div class="tab-content">
				<?php $i = 0; foreach ($tabs as $item) { ?>
					<div id="<?php echo sprintf('jobstab-%s-%s', $i, $_id ); ?>" class="tab-pane <?php echo esc_attr($i == 0 ? 'active' : ''); ?>">
						<?php
							$args = array(
								'get_job_by' => $item['get_job_by'],
								'posts_per_page' => $posts_per_page,
								'types' => !empty($item['types']) ? array($item['types']) : '',
								'categories' => !empty($item['category']) ? array($item['category']) : '',
							);
							$loop = entaro_get_listings( $args );
							$count = 1;
							if ( $loop->have_posts() ) {
								if ( $layout_type == 'layout1' ) {
									$bcol = 6;
									?>
									<div class="row">
										<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
						                    <div class="col-md-<?php echo esc_attr($bcol); ?> col-sm-12 col-xs-12 <?php echo esc_attr(($count % 2 == 1) ?'md-clearfix':'');?>">
						                        <?php get_template_part( 'job_manager/loop/list_1'); ?>
						                    </div>
						                <?php $count++; endwhile; ?>
					                </div>
					                <?php
								} elseif($layout_type == 'default') {
									while ( $loop->have_posts() ): $loop->the_post(); ?>
				                        <?php get_template_part( 'job_manager/loop/'.$item_style); ?>
					                <?php endwhile;
								} elseif($layout_type == 'st_center'){
									?>
										<div class="row">
											<?php while ( $loop->have_posts() ): $loop->the_post(); ?>
							                    <div class="col-md-4 col-sm-6 col-xs-12 <?php echo esc_attr(($count % 2 == 1) ?'sm-clearfix':'');?> <?php echo esc_attr(($count % 3 == 1) ?'md-clearfix lg-clearfix':'');?>">
							                        <?php get_template_part( 'job_manager/loop/list_3'); ?>
							                    </div>
							                <?php $count++; endwhile; ?>
						                </div>
									<?php 
								}
								wp_reset_postdata();
							}
						?>
					</div>
				<?php $i++;} ?>
			</div>
		</div>
	</div>
<?php endif; ?>