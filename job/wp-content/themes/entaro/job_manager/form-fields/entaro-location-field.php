<?php
/**
 * Shows the `text` form field on job listing forms.
 *
 * This template can be overridden by copying it to yourtheme/job_manager/form-fields/text-field.php.
 *
 * @see         https://wpjobmanager.com/document/template-overrides/
 * @author      Automattic
 * @package     WP Job Manager
 * @category    Template
 * @version     1.27.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
global $post;
global $thepostid;
if ( $thepostid ) {
	$job_id = $thepostid;
} else {
	$job_id = ! empty( $_REQUEST['job_id'] ) ? absint( $_REQUEST['job_id'] ) : 0;
}

$geo_latitude = get_post_meta( $job_id, 'geolocation_lat', true );
$geo_longitude = get_post_meta( $job_id, 'geolocation_long', true );
?>
<div class="entaro-location-field">
	<div class="entaro-location-field-inner wrapper-location">
		<input type="text" class="input-text input-location-field" name="<?php echo esc_attr( isset( $field['name'] ) ? $field['name'] : $key ); ?>"<?php if ( isset( $field['autocomplete'] ) && false === $field['autocomplete'] ) { echo ' autocomplete="off"'; } ?> id="<?php echo esc_attr( $key ); ?>" placeholder="<?php echo esc_attr( $field['placeholder'] ); ?>" value="<?php echo isset( $field['value'] ) ? esc_attr( $field['value'] ) : ''; ?>" maxlength="<?php echo ! empty( $field['maxlength'] ) ? $field['maxlength'] : ''; ?>" <?php if ( ! empty( $field['required'] ) ) echo 'required'; ?> />
		<?php if ( !is_admin() ) { ?>
			<span class="find-me-location">
				<?php get_template_part( 'template-parts/location' ); ?>
			</span>
		<?php } ?>
	</div>
	<div class="row hidden">
		<div class="col-sm-6">
			<fieldset>
				<label><?php esc_html_e( 'Latitude', 'entaro' ); ?></label>
				<div class="field">
					<input class="geo_latitude"  name="geo_latitude" value="<?php echo esc_attr( $geo_latitude); ?>" type="text">
				</div>
			</fieldset>
		</div>
		<div class="col-sm-6">
			<fieldset>
				<label><?php esc_html_e( 'Longitude', 'entaro' ); ?></label>
				<div class="field">
					<input class="geo_longitude"  name="geo_longitude" value="<?php echo esc_attr( $geo_longitude ); ?>" type="text">
				</div>
			</fieldset>
		</div>
	</div>
</div>
<?php if ( ! empty( $field['description'] ) ) : ?><small class="description"><?php echo wp_kses_post($field['description']); ?></small><?php endif; ?>