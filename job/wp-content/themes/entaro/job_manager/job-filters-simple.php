<?php
/**
 * The template for displaying the WP Job Manager Filters on the front page hero
 *
 * @package Entaro
 */
$show_categories = true;
if ( ! get_option( 'job_manager_enable_categories' ) ) {
	$show_categories = false;
}
$atts = apply_filters( 'job_manager_ouput_jobs_defaut', array(
    'per_page' => get_option( 'job_manager_per_page' ),
    'orderby' => 'featured',
    'order' => 'DESC',
    'show_categories' => $show_categories,
    'show_tags' => false,
    'categories' => true,
    'selected_category' => false,
    'job_types' => false,
    'location' => false,
    'keywords' => false,
    'selected_job_types' => false,
    'show_category_multiselect' => false,
    'selected_region' => false
) );

?>

<?php do_action( 'job_manager_job_filters_before', $atts ); ?>
<form class="job_search_form  js-search-form job_filters" action="<?php echo entaro_get_listings_page_url(); ?>" method="get" role="search">
	<?php if ( ! get_option('permalink_structure') ) {
		//if the permalinks are not activated we need to put the listings page id in a hidden field so it gets passed
		$listings_page_id = get_option( 'job_manager_jobs_page_id', false );
		//only do this in case we do have a listings page selected
		if ( false !== $listings_page_id ) {
			echo '<input type="hidden" name="p" value="' . $listings_page_id . '">';
		}
	} ?>
	<?php do_action( 'job_manager_job_filters_start', $atts ); ?>

	<div class="search_jobs clearfix search_jobs--frontpage">

		<?php do_action( 'job_manager_job_filters_search_jobs_start', $atts ); ?>
		<div class="search_jobs_inner">

			<div class="table-visiable <?php echo esc_attr(($layout_type == 'half style_2')?'flex-middle-sm':''); ?>">
				<?php if($layout_type == 'half style_2'){ ?>
					<div class="left-inner">
				<?php } ?>
				<!-- keywords -->
				<?php if ( !empty($search_keyword) ) { ?>
					<div class="search-field-wrapper  search-filter-wrapper">
						<label for="search_keywords" class="hidden"><?php esc_html_e( 'Keywords', 'entaro' ); ?></label>
						<input class="search-field" autocomplete="off" type="text" name="search_keywords" id="search_keywords" placeholder="<?php echo esc_attr(esc_html__( 'What are you looking for?', 'entaro' )); ?>" value="<?php the_search_query(); ?>"/>
					</div>
				<?php } ?>

				<!-- location -->
				<?php if ( !empty($search_region_location) && $search_region_location == 'region' ) { ?>
					<div class="wrapper-location search-filter-wrapper">
						<?php
						$job_regions = get_terms( array( 'job_listing_region' ), array( 'hierarchical' => 1 ) );
						if ( ! is_wp_error( $job_regions ) && ! empty ( $job_regions ) ) { ?>
							<select class="regions-select <?php echo ( is_rtl() ? 'chosen-rtl' : '' ); ?>" placeholder="<?php esc_attr(esc_html__( 'Filter by regions', 'entaro' )); ?>" name="job_region_select">
								<option value=""><?php esc_html_e( 'All Regions', 'entaro' ); ?></option>
								<?php foreach ( $job_regions as $term ) : ?>
									<option value="<?php echo esc_attr($term->term_id); ?>"><?php echo wp_kses_post($term->name); ?></option>
								<?php endforeach; ?>
							</select>
						<?php } ?>
					</div>
				<?php } elseif ( !empty($search_region_location) && $search_region_location == 'location' ) { ?>
					<div class="wrapper-location search-filter-wrapper">
						<input type="text" name="search_location" id="search_location" placeholder="<?php echo esc_attr(esc_html__( 'Location', 'entaro' )); ?>" />
						<span class="find-me">
							<?php get_template_part( 'template-parts/location' ); ?>
						</span>
						<input type="hidden" name="search_lat" id="search_lat" />
						<input type="hidden" name="search_lng" id="search_lng" />
						<input type="hidden" name="use_search_distance" id="use_search_distance" value="on" checked="checked" />
						<input type="hidden" name="search_distance" id="search_distance" value="on" />
					</div>
				<?php } ?>

				<?php if ( !empty($search_type) ) { ?>
			        <div class="wrapper-types search-filter-wrapper">
			            <?php
						$job_types = get_terms( array( 'job_listing_type' ), array( 'hierarchical' => 1 ) );
						if ( ! is_wp_error( $job_types ) && ! empty ( $job_types ) ) { ?>
							<div class="select-types">
								<select class="types-select <?php echo ( is_rtl() ? 'chosen-rtl' : '' ); ?>" placeholder="<?php echo esc_attr(esc_html__( 'Filter by types', 'entaro' )); ?>" name="job_type_select">
									<option value=""><?php esc_html_e( 'All Types', 'entaro' ); ?></option>
									<?php foreach ( $job_types as $term ) : ?>
										<option value="<?php echo esc_attr($term->slug); ?>"><?php echo wp_kses_post($term->name); ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php } ?>
			        </div>
		        <?php } ?>

				<?php if ( !empty($search_category) && true === $show_categories ) { ?>
			        <div class="wrapper-categories search-filter-wrapper">
			            <?php job_manager_dropdown_categories( array( 'taxonomy' => 'job_listing_category', 'hierarchical' => 1, 'show_option_all' => esc_html__( 'All Categories', 'entaro' ), 'name' => 'search_categories', 'orderby' => 'name', 'multiple' => false ) ); ?>
			        </div>
		        <?php } ?>

		        <?php if($layout_type == 'half style_2'){ ?>
					</div>
				<?php } ?>

		        <div class="submit">
					<button class="search-submit btn btn-theme pull-right" name="submit">
						<?php if($layout_type == 'half style_2'){ ?>
							<span class="icon-search">
								<img src="<?php echo esc_url_raw( get_template_directory_uri().'/images/icon-search.png'); ?>">
							</span>
						<?php } ?>
						<i class="fa fa-search"></i> <?php esc_html_e( 'SEARCH', 'entaro' ); ?>
					</button>
				</div>
	        </div>
		</div>
		<?php do_action( 'job_manager_job_filters_search_jobs_end', $atts ); ?>
	</div>
</form>
<!-- suggestion -->
<?php if ( $search_trending_keyword && !empty($suggestion_menu) ) { ?>
	<div class="suggestion-menu-wrapper">
		<div class="keywords"><i aria-hidden="true" class="fa fa-tags text-theme"></i> <?php esc_html_e('Trending Keywords:', 'entaro'); ?> </div>
		<?php
            $args = array(
                'menu' => $suggestion_menu,
                'menu_class'      => 'suggestion-menu',
                'fallback_cb'     => ''
            );
            wp_nav_menu($args);
        ?>
	</div>
<?php } ?>
<?php do_action( 'job_manager_job_filters_after', $atts ); ?>