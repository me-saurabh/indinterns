<?php
/**
 * Template for resume content inside a list of resumes.
 *
 * This template can be overridden by copying it to yourtheme/wp-job-manager-resumes/content-resume.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager - Resume Manager
 * @category    Template
 * @version     1.13.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


$columns = entaro_get_resume_item_columns();
$bcol = 12/$columns;
$item_stype = entaro_get_resume_display_mode();
$class = 'md-clear-'.$columns.' col-md-'.$bcol.' col-sm-6 col-xs-12 ';

?>
<div class="<?php echo esc_attr($class); ?>	">
	<?php get_template_part( 'wp-job-manager-resumes/loop/'.$item_stype ); ?>
</div>