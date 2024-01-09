<?php

function entaro_job_add_custom_fields( $fields ) {
	$fields['_job_location']['type'] = 'entaro-location';
	// job fields
	$fields['_job_salary'] = array(
		'label' => esc_html__('Salary', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('$12k - $15k USD', 'entaro'),
		'priority' => '6.1'
	);

	$fields['_job_experience'] = array(
		'label' => esc_html__('Experience', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('1+ Years Experience', 'entaro'),
		'priority' => '6.2'
	);

	$fields['_featured_image'] = array(
		'label'       => esc_html__( 'Featured Image', 'entaro' ),
		'description' => esc_html__( 'Used for the Job Spotlight display', 'entaro' ),
		'type'        => 'file',
		'priority'    => 7,
	);

	// company fields
	$fields['_company_description'] = array(
		'label' => esc_html__('Company Description', 'entaro'),
		'type' => 'textarea',
		'required' => false,
		'placeholder' => '',
	);

	$fields['_company_facebook'] = array(
		'label' => esc_html__('Facebook Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 2.7
	);
	$fields['_company_gplus'] = array(
		'label' => esc_html__('Google plus Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 2.8
	);
	$fields['_company_linkedin'] = array(
		'label' => esc_html__('Linkedin Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 2.9
	);
	$fields['_company_pinterest'] = array(
		'label' => esc_html__('Pinterest Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 3.0
	);
	
	
	return $fields;
}
add_filter( 'job_manager_job_listing_data_fields', 'entaro_job_add_custom_fields', 1 );


function entaro_job_custom_submit_job_form_fields( $fields ) {
	// job fields
	$fields['job']['application']['priority'] = '1.1';

	$fields['job']['job_location']['type']    = 'entaro-location';
	$fields['job']['job_location']['priority']    = 2.3;
	$fields['job']['job_location']['placeholder'] = esc_html__( 'e.g 34 Wigmore Street, London', 'entaro' );
	$fields['job']['job_location']['description'] = esc_html__( 'Leave this blank if the location is not important.', 'entaro' );

	$fields['job']['job_salary'] = array(
		'label' => esc_html__('Salary', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('$12k - $15k USD', 'entaro'),
		'priority' => '6.1'
	);

	$fields['job']['job_experience'] = array(
		'label' => esc_html__('Experience', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('1+ Years Experience', 'entaro'),
		'priority' => '6.2'
	);

	$fields['job']['featured_image'] = array(
		'label' => esc_html__('Featured Image', 'entaro'),
		'type' => 'file',
		'required' => false,
		'placeholder' => '',
		'priority' => 7,
		'ajax' => true,
		'multiple' => false,
		'allowed_mime_types' => array( 'jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'gif' => 'image/gif', 'png' => 'image/png'),
		'description' => esc_html__('Used for the Job Spotlight display', 'entaro'),
	);

	// company fields
	$fields['company']['company_tagline']['priority'] = '1.1';
	$fields['company']['company_description'] = array(
		'label' => esc_html__('Description', 'entaro'),
		'type' => 'wp-editor',
		'required' => false,
		'placeholder' => '',
		'priority' => 1.2
	);

	$fields['company']['company_facebook'] = array(
		'label' => esc_html__('Facebook Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 5.1
	);
	$fields['company']['company_linkedin'] = array(
		'label' => esc_html__('Linkedin Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 5.2
	);
	$fields['company']['company_pinterest'] = array(
		'label' => esc_html__('Pinterest Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 5.3
	);
	$fields['company']['company_instagram'] = array(
		'label' => esc_html__('Instagram Username', 'entaro'),
		'type' => 'text',
		'required' => false,
		'placeholder' => esc_html__('yourcompany', 'entaro'),
		'priority' => 5.4
	);
	
	return $fields;
}
add_filter( 'submit_job_form_fields', 'entaro_job_custom_submit_job_form_fields' );


// job location function
function entaro_input_location_fields($key, $field) {
	global $wp_locale, $post, $thepostid;

	$thepostid = $post->ID;
	?>

	<div class="form-field" style="position: relative;">

		<?php if ( ! is_admin() ) : ?>
		<label for="<?php echo esc_attr( $key ); ?>"><?php echo esc_html( $field['label'] ) ; ?>:</label>
		<?php endif; ?>

		<?php
		if ( empty( $field[ 'value' ] ) ) {
			$field[ 'value' ] = get_post_meta( $thepostid, '_job_location', true );
		}
		
		get_job_manager_template( 'form-fields/entaro-location-field.php', array('key' => $key, 'field' => $field) );
		?>
	</div>

	<?php
}
add_action( 'job_manager_input_entaro-location', 'entaro_input_location_fields', 10, 2 );


add_action( 'job_manager_save_job_listing', 'entaro_listing_update_job_data', 100, 2 );
function entaro_listing_update_job_data( $id, $values ) {
	
	if ( isset( $_POST[ 'geo_latitude' ] ) ) {
		update_post_meta( $id, 'geolocation_lat', stripslashes_deep( $_POST[ 'geo_latitude' ] ) );
	}

	if ( isset( $_POST[ 'geo_longitude' ] ) ) {
		update_post_meta( $id, 'geolocation_long', stripslashes_deep( $_POST[ 'geo_longitude' ] ) );
	}
}