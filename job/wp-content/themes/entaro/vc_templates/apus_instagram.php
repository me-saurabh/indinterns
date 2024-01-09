<?php

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if ( function_exists('apus_framework_scrape_instagram') && function_exists('apus_framework_images_only') ) {
?>
	<div class="clearfix widget-instagram <?php echo esc_attr($el_class); ?>">
		<?php if($title!=''): ?>
	        <h3 class="widget-title" >
	           <span><?php echo esc_attr( $title ); ?></span>
	        </h3>
	    <?php endif; ?>
	    <div class="widget-content">
		<?php
			$bcol = 12/(int)$columns;
			if ($columns == 5) {
			    $bcol = 'cus-5';
			}

		    if ( $username != '' ) {
		        $media_array = apus_framework_scrape_instagram( $username );

		        if ( is_wp_error( $media_array ) ) {
		            echo wp_kses_post( $media_array->get_error_message() );
		        } else {
		            // filter for images only?
		            if ( $images_only = apply_filters( 'entaro_instagram_element_images_only', false ) ) {
		                $media_array = array_filter( $media_array, 'apus_framework_images_only' );
		            }

		            // slice list down to required number
		            $media_array = array_slice( $media_array, 0, $number );
		            if ( $layout_type == 'grid' ) {
			            ?>
			            <div class="row instagram-pics">
			                <?php
			                foreach ( $media_array as $item ) {
			                    echo '<div class="col-xs-'.esc_attr($bcol).'">';
			                    echo '<a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"><img src="'. esc_url( $item[$size] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"/></a>';
			                    echo '</div>';
			                }
			                ?>
			            </div>
			            <?php
		        	} else {
		        		?>
	        			<div class="slick-carousel" data-carousel="slick" data-items="<?php echo esc_attr($columns); ?>" data-smallmedium="2" data-extrasmall="1" data-pagination="false" data-nav="true">
			                <?php
			                foreach ( $media_array as $item ) {
			                    echo '<div class="item">';
			                    echo '<a href="'. esc_url( $item['link'] ) .'" target="'. esc_attr( $target ) .'"><img src="'. esc_url( $item[$size] ) .'"  alt="'. esc_attr( $item['description'] ) .'" title="'. esc_attr( $item['description'] ).'"/></a>';
			                    echo '</div>';
			                }
			                ?>
			            </div>
		        		<?php
		        	}
		        }
		    }
		?>
		</div>
	</div>
<?php } ?>