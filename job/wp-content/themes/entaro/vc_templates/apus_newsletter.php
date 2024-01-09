<?php
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );
$img = wp_get_attachment_image_src($image,'full');
?>
<div class="widget-newletter <?php echo esc_attr($el_class.' '.$style);?>">
	<div class="table-visiable-dk">
		<div class="left-content">
			<?php if ( !empty($img) && isset($img[0]) ): ?>
				<div class="icon-img">
	        		<img src="<?php echo esc_url_raw($img[0]); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>">
	        	</div>
	        <?php endif; ?>
	        <div class="right-content">
			    <?php if ($title!=''): ?>
			        <h3 class="title">
			            <?php echo trim( $title ); ?>
			        </h3>
			    <?php endif; ?>
			    <?php if (!empty($description)) { ?>
					<div class="description">
						<?php echo trim( $description ); ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<div class="content"> 
			<?php
				if ( function_exists( 'mc4wp_show_form' ) ) {
				  	try {
				  	    $form = mc4wp_get_form(); 
						mc4wp_show_form( $form->ID );
					} catch( Exception $e ) {
					 	esc_html_e( 'Please create a newsletter form from Mailchip plugins', 'entaro' );	
					}
				}
			?>
		</div>
	</div>
</div>