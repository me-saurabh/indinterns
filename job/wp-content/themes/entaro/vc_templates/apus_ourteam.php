<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$members = (array) vc_param_group_parse_atts( $members );
if ( !empty($members) ):
?>
	<div class="widget widget-ourteam <?php echo esc_attr($el_class); ?>">
	    <?php if ($title!='' || $subtitle != ''): ?>
	        <h3 class="widget-title">
	            <?php echo esc_attr( $title ); ?>
	            <?php if(isset($subtitle) && $subtitle != ''){ ?>
	            	<strong><?php echo trim($subtitle); ?></strong>
	            <?php } ?>
	        </h3>
	    <?php endif; ?>
	    <div class="widget-content">
	    	<div class="row">
				<?php foreach ($members as $item): ?>
					<div class="item ourteam-inner col-xs-12 col-sm-<?php echo esc_attr(12/$columns); ?>">
						<div class="avarta">
							<?php if ( isset($item['image']) && !empty($item['image']) ): ?>
								<?php $img = wp_get_attachment_image_src($item['image'],'full'); ?>
			                    <?php entaro_display_image($img); ?>
		                    <?php endif; ?>
	                    </div>
	                    <div class="info">
	                    <?php if ( isset($item['name']) && !empty($item['name']) ): ?>
	                    	<h3 class="name-team"><?php echo trim($item['name']); ?></h3>
	                    <?php endif; ?>

	                    <?php if ( isset($item['des']) && !empty($item['des']) ): ?>
	                    	<div class="des">
                    			<?php echo trim($item['des']); ?>
	                    	</div>
	                    <?php endif; ?>
	                    <ul class="social-team">
		                    <?php if ( isset($item['facebook']) && !empty($item['facebook']) ): ?>
		                    	<li><a href="<?php echo esc_url( $item['facebook'] ); ?>"><i class="fa fa-facebook"></i></a></li>
		                    <?php endif; ?>
		                    <?php if ( isset($item['twitter']) && !empty($item['twitter']) ): ?>
		                    	<li><a href="<?php echo esc_url( $item['twitter'] ); ?>"><i class="fa fa-twitter"></i></a></li>
		                    <?php endif; ?>
		                    <?php if ( isset($item['google']) && !empty($item['google']) ): ?>
		                    	<li><a href="<?php echo esc_url( $item['google'] ); ?>"><i class="fa fa-google-plus"></i></a></li>
		                    <?php endif; ?>
		                    <?php if ( isset($item['linkin']) && !empty($item['linkin']) ): ?>
		                    	<li><a href="<?php echo esc_url( $item['linkin'] ); ?>"><i class="fa fa-linkedin"></i></a></li>
		                    <?php endif; ?>
	                    </ul>
	                    </div>
					</div>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
<?php endif; ?>