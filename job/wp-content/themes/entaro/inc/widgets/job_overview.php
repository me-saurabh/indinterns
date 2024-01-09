<?php

class Entaro_Job_Overview_Widget extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_job_overview_widget',
            esc_html__('Apus Job Overview', 'entaro'),
            array( 'description' => esc_html__( 'Job Overview for website.', 'entaro' ), )
        );
        $this->widgetName = 'job_overview';
    }

    public function getTemplate() {
        $this->template = 'job_overview.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        
        $defaults = array( 'title' => 'Job Overview' );
        $instance = wp_parse_args((array) $instance, $defaults);
    ?>
    <div class="apus_socials">

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'entaro'); ?></label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        
    </div>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        return $instance;

    }
}

register_widget( 'Entaro_Job_Overview_Widget' );