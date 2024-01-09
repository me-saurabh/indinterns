<?php
/**
 * Filter form to display above `[resumes]` shortcode.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/resume-filters.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.13.2
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

wp_enqueue_script( 'wp-resume-manager-ajax-filters' );
do_action( 'resume_manager_resume_filters_before', $atts );

$bg = entaro_get_config('resume_filter_bg');

if ( !empty($bg['url']) ) {
    if (is_ssl()) {
        $bg_image_img = str_replace("http://", "https://", $bg['url']);		
    } else {
        $bg_image_img = $bg['url'];
    }
}
?>

<div class="job_filters-wrapper" style="<?php if(!empty($bg_image_img)){ echo 'background: url('.$bg_image_img.');'; } ;?>">

	<div class="job_filters-inner widget-search-form  horizontal white <?php echo apply_filters('entaro_job_resume_content_class', 'container');?>">
		<?php
			do_action( 'job_manager_job_filters_before', $atts );
		?>
		<?php
			$title = entaro_get_config('resume_filter_title');
			$subtitle = entaro_get_config('resume_filter_subtitle');
		?>
		<?php if ( !empty($title) || !empty($subtitle) ) { ?>
			<div class="title-wrapper">
				<?php if ( !empty($title) ) { ?>
					<h3 class="title"><?php echo wp_kses_post($title); ?></h3>
				<?php } ?>
				<?php if ( !empty($subtitle) ) { ?>
					<div class="des"><?php echo wp_kses_post($subtitle); ?></div>
				<?php } ?>
			</div>
		<?php } ?>
		<form class="resume_filters job_filters">
			<?php
				$display_mode = entaro_get_resume_display_mode();
				$filter_order = isset($_COOKIE['entaro_resume_order']) ? $_COOKIE['entaro_resume_order'] : 'default';
			?>
			<input class="input_display_mode" type="hidden" name="display_mode" value="<?php echo esc_attr($display_mode); ?>">
			<input class="input_filter_oder" type="hidden" name="filter_order" value="<?php echo esc_attr($filter_order); ?>">
			
			<div class="search_resumes">
				<?php do_action( 'resume_manager_resume_filters_search_resumes_start', $atts ); ?>
				<div class="search_jobs_inner">
					<div class="table-visiable">
						<div class="search-field-wrappe resume-filter <?php if ( !entaro_get_config('resume_filter_show_keyword', true) ) { ?> hidden <?php } ?>">
							<label for="search_keywords"><?php esc_html_e( 'Keywords', 'entaro' ); ?></label>
							<input type="text" name="search_keywords" id="search_keywords" placeholder="<?php echo esc_attr(esc_html__( 'All Resumes', 'entaro' )); ?>" value="<?php echo esc_attr( $keywords ); ?>" />
						</div>

						<?php if ( entaro_get_config('resume_filter_show_location', true) ) { ?>
							<div class="wrapper-location">
								<?php
									$location = isset( $_REQUEST['search_location'] ) ? $_REQUEST['search_location'] : '';
									$search_lat = isset( $_REQUEST['search_lat'] ) ? $_REQUEST['search_lat'] : '';
									$search_lng = isset( $_REQUEST['search_lng'] ) ? $_REQUEST['search_lng'] : '';
								?>

								<label for="search_location" class="hidden"><?php esc_html_e( 'Location', 'entaro' ); ?></label>
								<input type="text" name="search_location" id="search_location" placeholder="<?php echo esc_attr(esc_html__( 'Any Location', 'entaro' )); ?>" value="<?php echo esc_attr( $location ); ?>" />
								<span class="find-me">
									<?php get_template_part( 'template-parts/location' ); ?>
								</span>
								<input type="hidden" name="search_lat" id="search_lat" value="<?php echo esc_attr($search_lat); ?>" />
								<input type="hidden" name="search_lng" id="search_lng" value="<?php echo esc_attr($search_lng); ?>" />
							</div>
						<?php } ?>

						<?php if ( entaro_get_config('resume_filter_show_categories', true) ) { ?>
							<?php if ( $categories ) : ?>
								<?php foreach ( $categories as $category ) : ?>
									<input type="hidden" name="search_categories[]" value="<?php echo esc_attr(sanitize_title( $category )); ?>" />
								<?php endforeach; ?>
							<?php elseif ( $show_categories && get_option( 'resume_manager_enable_categories' ) && ! is_tax( 'resume_category' ) && get_terms( 'resume_category' ) ) : ?>
								<div class="wrapper-categories resume-filter">
									<label for="search_categories" class="hidden"><?php esc_html_e( 'Category', 'entaro' ); ?></label>
									<?php if ( $show_category_multiselect ) : ?>
										<?php job_manager_dropdown_categories( array( 'taxonomy' => 'resume_category', 'hierarchical' => 1, 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category, 'hide_empty' => false ) ); ?>
									<?php else : ?>
										<?php wp_dropdown_categories( array( 'taxonomy' => 'resume_category', 'hierarchical' => 1, 'show_option_all' => esc_html__( 'Any category', 'entaro' ), 'name' => 'search_categories', 'orderby' => 'name', 'selected' => $selected_category ) ); ?>
									<?php endif; ?>
								</div>
							<?php endif; ?>
						<?php } ?>
					</div>
				</div>
				<?php do_action( 'resume_manager_resume_filters_search_resumes_end', $atts ); ?>
			</div>
			<div class="showing_resumes"></div>
		</form>
		<!-- suggestion -->
		<?php if ( entaro_get_config('resume_filter_suggestion') ) { ?>
			<div class="suggestion-menu-wrapper">
				<div class="keywords"><i aria-hidden="true" class="fa fa-tags text-theme"></i><?php esc_html_e('Trending Keywords:', 'entaro'); ?></div>
				<?php
		            $args = array(
		                'menu' => entaro_get_config('resume_filter_suggestion'),
		                'menu_class'      => 'suggestion-menu list-inline',
		                'fallback_cb'     => ''
		            );
		            wp_nav_menu($args);
		        ?>
			</div>
		<?php } ?>
		<?php do_action( 'resume_manager_resume_filters_after', $atts ); ?>
	</div>
</div>