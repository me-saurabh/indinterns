<?php

class Entaro_Single_Image extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_single_image',
            esc_html__('Apus Single Image Widget', 'entaro'),
            array( 'description' => esc_html__( 'Show single image', 'entaro' ), )
        );
        $this->widgetName = 'single_image';

        add_action('admin_enqueue_scripts', array($this, 'scripts'));
    }

    public function scripts() {
        wp_enqueue_media();
        wp_enqueue_script( 'apus-upload-image', APUS_FRAMEWORK_URL . 'assets/upload.js', array( 'jquery', 'wp-pointer' ), APUS_FRAMEWORK_VERSION, true );
    }

    public function getTemplate() {
        $this->template = 'single-image.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        $defaults = array(
            'title' => 'Single Image',
            'alt' => '',
            'single_image' => '',
            'link' => ''
        );
        $instance = wp_parse_args((array) $instance, $defaults);
        // Widget admin form
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'entaro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'link' )); ?>"><?php esc_html_e( 'Link:', 'entaro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'link' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'link' )); ?>" type="text" value="<?php echo esc_attr( $instance['link'] ); ?>" />
        </p>
        
        <label for="<?php echo esc_attr($this->get_field_id( 'single_image' )); ?>"><?php esc_html_e( 'Image:', 'entaro' ); ?></label>
        <div class="screenshot">
            <?php if ( $instance['single_image'] ) { ?>
                <img src="<?php echo esc_url($instance['single_image']); ?>" alt="<?php esc_attr_e('Image', 'entaro'); ?>"/>
            <?php } ?>
        </div>
        <input class="widefat upload_image" id="<?php echo esc_attr($this->get_field_id( 'single_image' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'single_image' )); ?>" type="hidden" value="<?php echo esc_attr($instance['single_image']); ?>" />
        <div class="upload_image_action">
            <input type="button" class="button add-image" value="Add">
            <input type="button" class="button remove-image" value="Remove">
        </div>
        
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'alt' )); ?>"><?php esc_html_e( 'Alt:', 'entaro' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'alt' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'alt' )); ?>" type="text" value="<?php echo esc_attr($instance['alt']); ?>" />
        </p>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
        $instance['alt'] = ( ! empty( $new_instance['alt'] ) ) ? strip_tags( $new_instance['alt'] ) : '';
        $instance['link'] = ( ! empty( $new_instance['link'] ) ) ? strip_tags( $new_instance['link'] ) : '';
        $instance['single_image'] = ( ! empty( $new_instance['single_image'] ) ) ? strip_tags( $new_instance['single_image'] ) : '';
        return $instance;

    }
}

register_widget( 'Entaro_Single_Image' );