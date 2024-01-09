<?php

if ( !class_exists("Entaro_Mobile_Menu") ) {
    class Entaro_Mobile_Menu extends Walker_Nav_Menu {
        
       /**
         * __construct function.
         * 
         * @access public
         * @return void
         */
        public function __construct() {
            add_filter('nav_menu_css_class' , array($this, 'add_nav_class'), 10 , 2);
        }
        
        /**
         * special_nav_class function.
         * 
         * @access public
         * @param mixed $classes
         * @param mixed $item
         * @return void
         */
        public function add_nav_class($classes, $item){
            if(in_array('current-menu-item', $classes)){
                $classes[] = 'active ';
            }
            return $classes;
        }
        
        /**
         * start_lvl function.
         * 
         * @access public
         * @param mixed &$output
         * @param mixed $depth
         * @return void
         */
        public function start_lvl( &$output, $depth=0 ,$args = array() ) {
            $indent = str_repeat( "\t", $depth );
            $output .= "\n$indent<ul class=\"sub-menu\">\n";

        }

        /**
         * Ends the list of after the elements are added.
         *
         * @see Walker::end_lvl()
         *
         * @since 3.0.0
         *
         * @param string $output Passed by reference. Used to append additional content.
         * @param int    $depth  Depth of menu item. Used for padding.
         * @param array  $args   An array of arguments. @see wp_nav_menu()
         */
        public function end_lvl( &$output, $depth = 0, $args = array() ) {
            $indent = str_repeat("\t", $depth);
            $output .= "$indent</ul>\n";
        }

        /**
         * start_el function.
         * 
         * @access public
         * @param mixed &$output
         * @param mixed $item
         * @param int $depth (default: 0)
         * @param array $args (default: array())
         * @param int $id (default: 0)
         * @return void
         */
        public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

            $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

            $li_attributes = '';
            $class_names = $value = '';

            $apus_mega_profile = $this->getSubMegaMenuProfile($item, $depth);
            if ( $apus_mega_profile ) {
                $args->has_children = true; 
            }
            $classes[] = ($args->has_children) ? 'has-submenu' : '';
            $classes[] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
            $classes[] = 'menu-item-' . $item->ID;

            $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
            
            $class_names = ' class="' . esc_attr( $class_names ) . '"';

            $id = apply_filters( 'nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args );
            $id = strlen( $id ) ? ' id="' . esc_attr( $id ) . '"' : '';

            $output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';

            $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
            $attributes .= ! empty( $item->target ) ? ' target="' . esc_attr( $item->target ) .'"' : '';
            $attributes .= ! empty( $item->xfn ) ? ' rel="'    . esc_attr( $item->xfn ) .'"' : '';
            $attributes .= ! empty( $item->url ) ? ' href="'   . esc_url( $item->url ) .'"' : '';
            

            $text_label = '';
            if ( isset($item->apus_text_label) && !empty($item->apus_text_label) ) {
                switch ( $item->apus_text_label ) {
                    case 'label_new':
                        $text_label  = esc_html__('New', 'entaro');
                        break;

                    case 'label_hot':
                        $text_label  = esc_html__('Hot', 'entaro');
                        break;

                    case 'label_featured':
                        $text_label  = esc_html__('Featured', 'entaro');
                        break;

                    default:
                        $text_label  = '';
                        break;
                }
                $text_label  = ! empty( $item->apus_text_label ) ? '<span class="text-label ' . str_replace( '_', '-', $item->apus_text_label )  . '">'.$text_label.'</span>' : '';
            }

            $item_output = $args->before;
            $item_output .= '<a'. $attributes .'>';
            $item_output .= $text_label;
            $item_output .= $args->link_before . $this->display_icon($item) . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
            $item_output .= '</a>';
            $item_output .= $args->after;
            $item_output .= $this->generateSubMegaMenu( $item , $apus_mega_profile );
            
            $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
        }

        /**
         * display_element function.
         * 
         * @access public
         * @param mixed $element
         * @param mixed &$children_elements
         * @param mixed $max_depth
         * @param int $depth (default: 0)
         * @param mixed $args
         * @param mixed &$output
         * @return void
         */
        public function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

            if ( !$element )
                return;

            $id_field = $this->db_fields['id'];


            if( $this->getSubMegaMenuProfile($element, $depth) ) {
                $children_elements[$element->$id_field] = array();
            }

            if ( is_array( $args[0] ) ) 
                $args[0]['has_children'] = ! empty( $children_elements[$element->$id_field] );
            else if ( is_object( $args[0] ) ) 
                $args[0]->has_children = ! empty( $children_elements[$element->$id_field] ); 
            $cb_args = array_merge( array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'start_el'), $cb_args);

            $id = $element->$id_field;

            if ( ($max_depth == 0 || $max_depth > $depth+1 ) && isset( $children_elements[$id]) ) {

                foreach( $children_elements[ $id ] as $child ){

                    if ( !isset($newlevel) ) {
                        $newlevel = true;
                        $cb_args = array_merge( array(&$output, $depth), $args);
                        call_user_func_array(array(&$this, 'start_lvl'), $cb_args);
                    }
                    $this->display_element( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
                }
                unset( $children_elements[ $id ] );
            }

            if ( isset($newlevel) && $newlevel ){
                $cb_args = array_merge( array(&$output, $depth), $args);
                call_user_func_array(array(&$this, 'end_lvl'), $cb_args);
            }

            $cb_args = array_merge( array(&$output, $element, $depth), $args);
            call_user_func_array(array(&$this, 'end_el'), $cb_args);
        }

        /**
         *
         */
        public function getSubMegaMenuProfile($item, $depth ) {
            return isset($item->apus_mega_profile) && $item->apus_mega_profile ? $item->apus_mega_profile : false;
        }

        /**
         *
         */
        public function generateSubMegaMenu( $item, $apus_mega_profile ) {
            if ( $apus_mega_profile ) {

                $args = array(
                    'name'        => $apus_mega_profile,
                    'post_type'   => 'apus_megamenu',
                    'post_status' => 'publish',
                    'numberposts' => 1
                );
                $posts = get_posts($args);
                if ( $posts && isset($posts[0]) ) {
                    $post = $posts[0];
                    $content = do_shortcode( $post->post_content );
                    $width  = $item->apus_width ? 'style="width:'.$item->apus_width.'px"':"";
                    return '<div class="sub-menu" '.$width.'><div class="dropdown-menu-inner">'.$content.'</div></div>';
                }
            }
            return '';
        }

        public function display_icon($item) {
            if ( $item->apus_icon_image ) {
                return '<img src="'.esc_url($item->apus_icon_image).'" alt="'.esc_attr($item->title).'"/>';
            } elseif ( $item->apus_icon_font ) {
                return '<i class="fa '.esc_attr($item->apus_icon_font).'"></i>';
            }
        }
    }
}