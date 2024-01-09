<?php

class Entaro_Widget_Contact_Info extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_contact_info',
            esc_html__('Apus Contact Info Widget', 'entaro'),
            array( 'description' => esc_html__( 'Show Contact Info', 'entaro' ), )
        );
        $this->widgetName = 'contact_info';
        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }
    
    public function scripts() {
        wp_enqueue_script( 'apus-upload-image', APUS_FRAMEWORK_URL . 'assets/upload.js', array( 'jquery', 'wp-pointer' ), APUS_FRAMEWORK_VERSION, true );
    }

    public function getTemplate() {
        $this->template = 'contact_info.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'address_icon' => '',
            'address_content' => '',
            'phone_icon' => '',
            'phone_content' => '',
            'email_icon' => '',
            'email_title' => '',
        );
        $instance = wp_parse_args( (array) $instance, $defaults );
        // Widget admin form
        ?>
        <div class="address-wrapper">
            <h3><?php echo esc_attr('Address Contact Info'); ?></h3>
            <label for="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>"><?php esc_html_e( 'Icon:', 'entaro' ); ?></label>
            <div class="screenshot">
                <?php if ( $instance['address_icon'] ) { ?>
                    <img src="<?php echo esc_url($instance['address_icon']); ?>" style="max-width:100%" alt="<?php esc_attr_e('Image', 'entaro'); ?>"/>
                <?php } ?>
            </div>
            <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'address_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_icon' )); ?>" type="hidden" value="<?php echo esc_attr($instance['address_icon']); ?>" />
            <div class="upload_image_action">
                <input type="button" class="button add-image" value="Add">
                <input type="button" class="button remove-image" value="Remove">
            </div>
            <!-- social -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'address_content' )); ?>"><strong><?php esc_html_e('Address Content:', 'entaro');?></strong></label>
                <textarea id="<?php echo esc_attr($this->get_field_id( 'address_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'address_content' )); ?>" class="widefat"><?php echo esc_attr( $instance['address_content'] ) ; ?></textarea>
            </p>
        </div>

        <div class="phone-wrapper">
            <h3><?php echo esc_attr('Phone Contact Info'); ?></h3>
            <label for="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>"><?php esc_html_e( 'Icon:', 'entaro' ); ?></label>
            <div class="screenshot">
                <?php if ( $instance['phone_icon'] ) { ?>
                    <img src="<?php echo esc_url($instance['phone_icon']); ?>" style="max-width:100%" alt="<?php esc_attr_e('Image', 'entaro'); ?>"/>
                <?php } ?>
            </div>
            <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'phone_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_icon' )); ?>" type="hidden" value="<?php echo esc_attr($instance['phone_icon']); ?>" />
            <div class="upload_image_action">
                <input type="button" class="button add-image" value="Add">
                <input type="button" class="button remove-image" value="Remove">
            </div>
            <!-- social -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'phone_content' )); ?>"><strong><?php esc_html_e('Phone Content:', 'entaro');?></strong></label>
                <textarea id="<?php echo esc_attr($this->get_field_id( 'phone_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'phone_content' )); ?>" class="widefat"><?php echo esc_attr( $instance['phone_content'] ) ; ?></textarea>
            </p>
        </div>



        <div class="email-wrapper">
            <h3><?php echo esc_attr('Email Contact Info'); ?></h3>
            <label for="<?php echo esc_attr($this->get_field_id( 'email_icon' )); ?>"><?php esc_html_e( 'Icon:', 'entaro' ); ?></label>
            <div class="screenshot">
                <?php if ( $instance['email_icon'] ) { ?>
                    <img src="<?php echo esc_url($instance['email_icon']); ?>" style="max-width:100%" alt="<?php esc_attr_e('Image', 'entaro'); ?>"/>
                <?php } ?>
            </div>
            <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'email_icon' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_icon' )); ?>" type="hidden" value="<?php echo esc_attr($instance['email_icon']); ?>" />
            <div class="upload_image_action">
                <input type="button" class="button add-image" value="Add">
                <input type="button" class="button remove-image" value="Remove">
            </div>
            <!-- social -->
            <p>
                <label for="<?php echo esc_attr($this->get_field_id( 'email_content' )); ?>"><strong><?php esc_html_e('Email Content:', 'entaro');?></strong></label>
                <textarea id="<?php echo esc_attr($this->get_field_id( 'email_content' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'email_content' )); ?>" class="widefat"><?php echo esc_attr( $instance['email_content'] ) ; ?></textarea>
            </p>
        </div>

<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['phone_icon'] = ( ! empty( $new_instance['phone_icon'] ) ) ? $new_instance['phone_icon'] : '';
        $instance['phone_content'] = ( ! empty( $new_instance['phone_content'] ) ) ? $new_instance['phone_content'] : '';

        $instance['address_icon'] = ( ! empty( $new_instance['address_icon'] ) ) ? $new_instance['address_icon'] : '';
        $instance['address_content'] = ( ! empty( $new_instance['address_content'] ) ) ? $new_instance['address_content'] : '';

        $instance['email_icon'] = ( ! empty( $new_instance['email_icon'] ) ) ? $new_instance['email_icon'] : '';
        $instance['email_content'] = ( ! empty( $new_instance['email_content'] ) ) ? $new_instance['email_content'] : '';

        return $instance;
    }
}

register_widget( 'Entaro_Widget_Contact_Info' );