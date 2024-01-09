<?php
/**
 * Content that is shown at the beginning of a resume list.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/resumes-start.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$display_mode = entaro_get_resume_display_mode();

$sidebar_configs = entaro_get_job_resume_layout_configs();
$class = '';
if ( isset($sidebar_configs['left']) ) {
    $class = 'pull-right';
}
?>

<section class="main-listing-content <?php echo apply_filters('entaro_job_resume_content_class', 'container');?>">
	
	<div class="resume-search-result-filter"></div>

	<div class="row">
		<div class="col-sm-12 <?php echo esc_attr($sidebar_configs['main']['class'].' '.$class); ?>">
			<div class="listing-action clearfix">
				<div class="listing-display-mode pull-right">
					<div class="display-mode">
						<a href="#grid" class="change-view <?php echo esc_attr($display_mode == 'grid' ? 'active' : ''); ?>" data-mode="grid"><i class="fa fa-th" aria-hidden="true"></i></a>
						<a href="#list" class="change-view <?php echo esc_attr($display_mode == 'list' ? 'active' : ''); ?>" data-mode="list"><i class="fa fa-list" aria-hidden="true"></i></a>
					</div>
				</div>
				<?php
					$options = array(
						'default' => esc_html__( 'Default Order', 'entaro' ),
						'date-desc' => esc_html__( 'Newest First', 'entaro' ),
						'date-asc' => esc_html__( 'Oldest First', 'entaro' ),
						'random' => esc_html__( 'Random', 'entaro' ),
					);
					$default = isset($_COOKIE['entaro_resume_order']) ? $_COOKIE['entaro_resume_order'] : 'default';
				?>
				<div class="pull-left">
				<div class="listing-orderby">
					<select name="filter_order" autocomplete="off" class="select-orderby">
						<?php foreach ( $options as $id => $option ) : ?>
							<option value="<?php echo esc_attr( $id ); ?>" <?php echo trim($id == $default ? 'selected="selected"' : ''); ?>><?php echo esc_html( $option ); ?></option>
						<?php endforeach; ?>
					</select>
				</div>
				</div>
			</div>
			<div class="resumes clearfix row">