<?php

class Entaro_Job_Taxonomy_Widget extends Apus_Widget {
    public function __construct() {
        parent::__construct(
            'apus_job_taxonomy_widget',
            esc_html__('Apus Job Taxonomy', 'entaro'),
            array( 'description' => esc_html__( 'Job Taxonomy for website.', 'entaro' ), )
        );
        $this->widgetName = 'job_taxonomy';
    }

    public function getTemplate() {
        $this->template = 'job_taxonomy.php';
    }

    public function widget( $args, $instance ) {
        $this->display($args, $instance);
    }
    
    public function form( $instance ) {
        
        $defaults = array( 'title' => 'Category' );
        $instance = wp_parse_args((array) $instance, $defaults);
        $taxonomies = array(
            'job_listing_category' => esc_html__( 'Categories', 'entaro' ),
            'job_listing_type' => esc_html__( 'Types', 'entaro' ),
            'job_listing_region' => esc_html__( 'Regions', 'entaro' ),
            'job_listing_tag' => esc_html__( 'Tags', 'entaro' ),
        );
    ?>
    <div class="apus_socials">

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'entaro'); ?></label>
            <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>">
                <?php echo esc_html__('Type:', 'entaro' ); ?>
            </label>
            <br>
            <select id="<?php echo esc_attr($this->get_field_id('taxonomy')); ?>" name="<?php echo esc_attr($this->get_field_name('taxonomy')); ?>">
                <?php foreach ($taxonomies as $key => $value) { ?>
                    <option value="<?php echo esc_attr( $key ); ?>" <?php selected($instance['taxonomy'],$key); ?> ><?php echo esc_html( $value ); ?></option>
                <?php } ?>
            </select>
        </p>
    </div>
<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
        $instance['taxonomy'] = ( ! empty( $new_instance['taxonomy'] ) ) ? $new_instance['taxonomy'] : 'job_listing_category';

        return $instance;

    }
}

register_widget( 'Entaro_Job_Taxonomy_Widget' );