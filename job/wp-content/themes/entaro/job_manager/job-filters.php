<?php wp_enqueue_script( 'wp-job-manager-ajax-filters' ); ?>
<?php

$bg = entaro_get_config('listing_filter_bg');

if ( !empty($bg['url']) ) {
    if (is_ssl()) {
        $bg_image_img = str_replace("http://", "https://", $bg['url']);		
    } else {
        $bg_image_img = $bg['url'];
    }
}

?>

<div class="job_filters-wrapper" style="<?php if(!empty($bg_image_img)){ echo 'background: url('.$bg_image_img.');'; } ;?>">

	<div class="widget-search-form  horizontal white <?php echo apply_filters('entaro_listing_archive_content_class', 'container');?>">
		<?php
			do_action( 'job_manager_job_filters_before', $atts );
		?>
		<?php
			$title = entaro_get_config('listing_filter_title');
			$subtitle = entaro_get_config('listing_filter_subtitle');
		?>
		<?php if ( !empty($title) || !empty($subtitle) ) { ?>
			<?php if ( !empty($title) ) { ?>
				<h3 class="title"><?php echo wp_kses_post($title); ?></h3>
			<?php } ?>
			<?php if ( !empty($subtitle) ) { ?>
				<div class="des"><?php echo wp_kses_post($subtitle); ?></div>
			<?php } ?>
		<?php } ?>

		<form class="job_filters">
			<?php
				$display_mode = entaro_get_listing_display_mode();
				$filter_order = isset($_COOKIE['entaro_order']) ? $_COOKIE['entaro_order'] : 'default';
			?>
			<input class="input_display_mode" type="hidden" name="display_mode" value="<?php echo esc_attr($display_mode); ?>">
			<input class="input_filter_oder" type="hidden" name="filter_order" value="<?php echo esc_attr($filter_order); ?>">

			<div class="filter-inner clearfix">
			<?php do_action( 'job_manager_job_filters_start', $atts ); ?>
			<div class="search_jobs">
				<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>
				<div class="search_jobs_inner">
					<div class="table-visiable">
						<div class="search-field-wrappe <?php if ( !entaro_get_config('listing_filter_show_keyword', true) ) { ?> hidden <?php } ?>">
							<input type="text" name="search_keywords" id="search_keywords" placeholder="<?php echo esc_attr(esc_attr__( 'Keywords e.g. (Job Title, Description, Tags)', 'entaro' )); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
						</div>

						<?php if ( entaro_get_config('listing_filter_show_location_region', 'region') === 'region' ) { ?>

							<?php
							$job_regions = get_terms( array( 'job_listing_region' ), array( 'hierarchical' => 1 ) );
							if ( ! is_wp_error( $job_regions ) && ! empty ( $job_regions ) ) {

								$selected_region = '';
								//try to see if there is a search_categories (notice the plural form) GET param
								$search_regions = isset( $_REQUEST['job_region_select'] ) ? $_REQUEST['job_region_select'] : '';

								if ( ! empty( $search_regions ) && is_array( $search_regions ) ) {
									$search_regions = $search_regions[0];
								}
								$search_regions = sanitize_text_field( stripslashes( $search_regions ) );
								if ( ! empty( $search_regions ) ) {
									if ( is_numeric( $search_regions ) ) {
										$selected_region = intval( $search_regions );
									} else {
										$term = get_term_by( 'slug', $search_regions, 'job_listing_region' );
										$selected_region = $term->term_id;
									}
								} elseif (  ! empty( $atts['regions'] ) ) {
									$selected_region = intval( $atts['regions'] );
								}
								?>
								<div class="select-regions">
									<select class="regions-select <?php echo ( is_rtl() ? 'chosen-rtl' : '' ); ?>" placeholder="<?php echo esc_attr(esc_html__( 'Filter by regions', 'entaro' )); ?>" name="job_region_select">
										<option value=""><?php esc_html_e( 'All regions', 'entaro' ); ?></option>
										<?php foreach ( $job_regions as $term ) : ?>
											<option value="<?php echo esc_attr($term->term_id); ?>" <?php echo trim($term->term_id == $selected_region ? 'selected="selected"' : ''); ?>><?php echo wp_kses_post($term->name); ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							<?php } ?>

						<?php } elseif ( entaro_get_config('listing_filter_show_location_region', 'location') === 'location' ) { ?>

							<div class="wrapper-location">
								<?php
									$search_location = isset( $_REQUEST['search_location'] ) ? $_REQUEST['search_location'] : '';
									$search_lat = isset( $_REQUEST['search_lat'] ) ? $_REQUEST['search_lat'] : '';
									$search_lng = isset( $_REQUEST['search_lng'] ) ? $_REQUEST['search_lng'] : '';
								?>
								<input type="text" name="search_location" id="search_location" placeholder="<?php esc_html_e( 'Location', 'entaro' ); ?>" value="<?php echo esc_html($search_location); ?>" />
								<span class="find-me">
									<?php get_template_part( 'template-parts/location' ); ?>
								</span>
								<input type="hidden" name="search_lat" id="search_lat" value="<?php echo esc_attr($search_lat); ?>" />
								<input type="hidden" name="search_lng" id="search_lng" value="<?php echo esc_attr($search_lng); ?>" />
								<?php
								if ( is_tax('job_listing_region') ) {
									global $wp_query;
									$term =	$wp_query->queried_object;
									?>
									<input type="hidden" name="job_region_select" value="<?php echo esc_attr($term->term_id); ?>">
									<?php
								}
								?>
							</div>

						<?php } ?>

						<?php if ( entaro_get_config('listing_filter_show_categories', true) ) { ?>
							<div class="wrapper-categories">
								<?php
								if ( $show_categories && get_terms( 'job_listing_category' ) ) :

									//select the current category
									if ( empty( $selected_category ) ) {
										//try to see if there is a search_categories (notice the plural form) GET param
										$search_categories = isset( $_REQUEST['search_categories'] ) ? $_REQUEST['search_categories'] : '';
										if ( ! empty( $search_categories ) && is_array( $search_categories ) ) {
											$search_categories = $search_categories[0];
										}
										$search_categories = sanitize_text_field( stripslashes( $search_categories ) );
										if ( ! empty( $search_categories ) ) {
											if ( is_numeric( $search_categories ) ) {
												$selected_category = intval( $search_categories );
											} else {
												$term = get_term_by( 'slug', $search_categories, 'job_listing_category' );
												$selected_category = $term->term_id;
											}
										} elseif (  ! empty( $categories ) && isset( $categories[0] ) ) {
											if ( is_array($categories) ) {
												$selected_category = intval( $categories[0] );
											} else {
												$selected_category = intval( $categories );
											}
										}
									} ?>

										<?php job_manager_dropdown_categories( array(
											'taxonomy'        => 'job_listing_category',
				                            'hierarchical'    => 1,
				                            'show_option_all' => esc_html__( 'All categories', 'entaro' ),
				                            'name'            => 'search_categories',
				                            'orderby'         => 'name',
				                            'selected'        => $selected_category,
				                            'multiple'        => false
										) ); ?>

								<?php endif; ?>
							</div><!-- .select-categories -->
						<?php } ?>
					</div>
					<?php if ( entaro_get_config('listing_filter_show_types') ) { ?>
						<?php do_action( 'job_manager_job_filters_end', $atts ); ?>
					<?php } ?>
				</div>
				<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>
			</div>
			</div>
		</form>
		<!-- suggestion -->
		<?php if ( entaro_get_config('listing_filter_suggestion') ) { ?>
			<div class="suggestion-menu-wrapper">
				<div class="keywords"><i class="fa fa-tags text-theme" aria-hidden="true"></i><?php esc_html_e('Trending Keywords:', 'entaro'); ?></div>
				<?php
		            $args = array(
		                'menu' => entaro_get_config('listing_filter_suggestion'),
		                'menu_class'      => 'suggestion-menu list-inline',
		                'fallback_cb'     => ''
		            );
		            wp_nav_menu($args);
		        ?>
			</div>
		<?php } ?>

		<?php do_action( 'job_manager_job_filters_after', $atts ); ?>

		<noscript><?php esc_html_e( 'Your browser does not support JavaScript, or it is disabled. JavaScript must be enabled in order to view listings.', 'entaro' ); ?></noscript>
	</div>
</div>