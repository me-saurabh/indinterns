<?php

add_filter( 'cmb2_meta_boxes', 'entaro_resume_metaboxes' );
function entaro_resume_metaboxes( array $metaboxes ) {
    $prefix = 'entaro_resume_';

    $metaboxes[ $prefix . 'moreinfo' ] = array(
        'id'                        => $prefix . 'moreinfo',
        'title'                     => esc_html__( 'More Information', 'entaro' ),
        'object_types'              => array( 'resume' ),
        'context'                   => 'normal',
        'priority'                  => 'low',
        'show_names'                => true,
        'fields'                    => array(
            array(
                'id'          => $prefix . 'candidate_skills',
                'type'        => 'group',
                'description' => esc_html__( 'Skills', 'entaro' ),
                'fields' => array(
                    array(
                        'name'    => esc_html__( 'Label', 'entaro' ),
                        'id'      => 'label',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => esc_html__( 'Value', 'entaro' ),
                        'id'      => 'value',
                        'type'    => 'text',
                    )
                )
            ),
            array(
                'id'          => $prefix . 'candidate_awards',
                'type'        => 'group',
                'description' => esc_html__( 'Awards', 'entaro' ),
                'fields' => array(
                    array(
                        'name'    => esc_html__( 'Title', 'entaro' ),
                        'id'      => 'title',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => esc_html__( 'Date', 'entaro' ),
                        'id'      => 'date',
                        'type'    => 'text',
                    ),
                    array(
                        'name'    => esc_html__( 'Description', 'entaro' ),
                        'id'      => 'description',
                        'type'    => 'textarea',
                    )
                )
            ),
        )
    );

    return $metaboxes;
}


add_action( 'resume_manager_update_resume_data', 'entaro_resume_submit', 10, 2 );
function entaro_resume_submit( $id, $values ) {

    if ( isset($values['resume_fields']) && isset($values['resume_fields']['candidate_skills']) ) {
        $candidate_skills = $values['resume_fields']['candidate_skills'];
        
        update_post_meta( $id, 'entaro_resume_candidate_skills', $candidate_skills );
    }
    
    if ( isset($values['resume_fields']) && isset($values['resume_fields']['candidate_awards']) ) {
        $candidate_awards = $values['resume_fields']['candidate_awards'];
        
        update_post_meta( $id, 'entaro_resume_candidate_awards', $candidate_awards );
    }
}

add_filter( 'submit_resume_form_fields_get_resume_data', 'entaro_resume_get_job_data', 10, 2 );
function entaro_resume_get_job_data( $fields, $job ) {
    
    $candidate_skills = get_post_meta( $job->ID, 'entaro_resume_candidate_skills', true );

    if ( $candidate_skills ) {
        $fields['resume_fields'][ 'candidate_skills' ][ 'value' ] = $candidate_skills;
    }
    
    $candidate_awards = get_post_meta( $job->ID, 'entaro_resume_candidate_awards', true );

    if ( $candidate_awards ) {
        $fields['resume_fields'][ 'candidate_awards' ][ 'value' ] = $candidate_awards;
    }
    return $fields;
}


add_filter( 'resume_manager_resume_fields', 'entaro_resume_fields' );
function entaro_resume_fields($fields) {
    $fields['_candidate_portfolio'] = array(
        'label'       => esc_html__( 'Portfolio Images', 'entaro' ),
        'placeholder' => esc_html__( 'URL to the candidate Portfolio Images', 'entaro' ),
        'type'        => 'file',
        'multiple' => true,
    );
    return $fields;
}

add_filter( 'submit_resume_form_fields', 'entaro_resume_custom_submit_job_form_fields' );
function entaro_resume_custom_submit_job_form_fields( $fields ) {
    
    $fields['resume_fields']['candidate_portfolio'] = array(
        'label'       => esc_html__( 'Portfolio Images', 'entaro' ),
        'type'        => 'file',
        'required'    => false,
        'placeholder' => '',
        'priority'    => '12.1',
        'ajax'        => true,
        'multiple' => true,
        'allowed_mime_types' => array(
            'jpg'  => 'image/jpeg',
            'jpeg' => 'image/jpeg',
            'gif'  => 'image/gif',
            'png'  => 'image/png'
        )
    );

    $fields['resume_fields']['candidate_skills'] = array(
        'label'       => esc_html__( 'Skills', 'entaro' ),
        'add_row'     => esc_html__( 'Add Skill', 'entaro' ),
        'type'        => 'repeated', // repeated
        'required'    => false,
        'placeholder' => '',
        'priority'    => '12.2',
        'fields'      => array(
            'label' => array(
                'label'       => esc_html__( 'Label', 'entaro' ),
                'type'        => 'text',
                'required'    => true,
                'placeholder' => ''
            ),
            'value' => array(
                'label'       => esc_html__( 'Value', 'entaro' ),
                'type'        => 'text',
                'required'    => true,
                'placeholder' => ''
            ),
        )
    );
    $fields['resume_fields']['candidate_awards'] = array(
        'label'       => esc_html__( 'Awards', 'entaro' ),
        'add_row'     => esc_html__( 'Add Award', 'entaro' ),
        'type'        => 'repeated', // repeated
        'required'    => false,
        'placeholder' => '',
        'priority'    => '12.3',
        'fields'      => array(
            'title' => array(
                'label'       => esc_html__( 'Title', 'entaro' ),
                'type'        => 'text',
                'required'    => true,
                'placeholder' => ''
            ),
            'date' => array(
                'label'       => esc_html__( 'Date', 'entaro' ),
                'type'        => 'text',
                'required'    => true,
                'placeholder' => ''
            ),
            'description' => array(
                'label'       => esc_html__( 'Description', 'entaro' ),
                'type'        => 'textarea',
                'required'    => false,
                'placeholder' => ''
            )
        )
    );

    return $fields;
}
