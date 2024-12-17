<?php
add_action('widgets_init', 'register_widget_top_view');

function register_widget_top_view() {
    register_widget('Uni_Post_Top_View_Widget');
}

class Uni_Post_Top_View_Widget extends WP_Widget {

    function __construct() {

        parent::__construct(
            'list_view_posts',
            __( 'Uni - Top view posts', 'shtheme' ),
            array(
                'description'  => __( 'Top list posts by views', 'shtheme' )
            )
        );
        
    }

    function widget($args, $instance) {
        extract($args);
        echo $before_widget;

        if ($instance['title']) echo $before_title . apply_filters('widget_title', $instance['title']) . $after_title;
        ?>
        <div class="widget_list_posts widget_list_posts__<?php echo $instance['image_alignment'];?>">
            <?php
            function filter_where( $where = '' ) {
                global $postdate;
                $where .= " AND post_date > '" . date('Y-m-d', strtotime('-'.$postdate.' days')) . "'";
                return $where;
            }
            add_filter( 'posts_where', 'filter_where' );

            // Create IDS
            $ids = array();
            $args = array(
                'post_type'             => 'post',
                'posts_per_page'        => $instance['numpro'],
                'meta_key'              => 'postview_number',
                'orderby'               => 'meta_value_num',
                'order'                 => 'DESC',
                'ignore_sticky_posts'   => -1,
            );
            $the_query = new WP_Query($args);
            remove_filter( 'posts_where', 'filter_where' );
            while($the_query->have_posts()):
            $the_query->the_post();
                array_push($ids, get_the_ID());
            endwhile;
            $ids = implode(',', $ids);
            wp_reset_postdata(); 
            ?>

            <?php
            $style = ( $instance['image_alignment'] == 'aligncenter' ) ? '' : 'vertical';
            $image_width = ( $instance['image_alignment'] == 'aligncenter' ) ? '' : '30';
            $excerpt = ( $instance['show_content'] == '' ) ? 'false' : 'visible';

            echo flatsome_apply_shortcode( 'blog_posts', array(
                'type'        => 'row',
                'image_size'  => $instance['image_size'],
                'image_hover' => 'zoom',
                'image_width' => $image_width,
                'image_height' => $instance['image_height'],
                'depth'       => get_theme_mod( 'blog_posts_depth', 0 ),
                'depth_hover' => get_theme_mod( 'blog_posts_depth_hover', 0 ),
                'text_align'  => get_theme_mod( 'blog_posts_title_align', 'center' ),
                'style'       => $style,
                'columns'     => '1',
                'columns__sm' => '1',
                'columns__md' => '1',
                'show_date'   => 'false', // badge, text
                'ids'         => $ids,
                'excerpt' => 'false',
                'show_category' => 'false',
                'excerpt' => $excerpt,
                'excerpt_length' => 6,
                // 'readmore' => __('Read more','shtheme'),
                // 'readmore_style' => 'link',
            ) );
            ?>
        </div>
 
        <?php
        echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    function form($instance) {
        $instance = wp_parse_args( 
        	(array)$instance, array( 
            		'title'             => '', 
                    'numpro'            => '3',  
                    'postdate'          => '30',
                    'cat'               => '',
                    'show_image'        => '',
                    'image_alignment'   => 'alignleft',
                    'image_size'        => 'medium_large',
                    'image_height'      => '56.25%',
                    'show_content'      => '',
        		) 
        	);
        ?>
        <p>
            <label for="<?php  echo $this->get_field_id('title'); ?>"><?php _e('Title', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
        </p>

        <p>
            <label for="<?php  echo $this->get_field_id('numpro'); ?>"><?php _e('Number of Posts to Show', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('numpro'); ?>" name="<?php echo $this->get_field_name('numpro'); ?>" value="<?php echo esc_attr( $instance['numpro'] ); ?>" />
        </p>
        
        <p>
            <label for="<?php echo $this-> get_field_id('postdate'); ?>"><?php _e('Post date','shtheme'); ?>:</label>
            <input class="widefat" type="number" id="<?php echo $this->get_field_id('postdate'); ?>" name="<?php echo $this->get_field_name('postdate'); ?>" value="<?php echo esc_attr( $instance['postdate'] ); ?>" />
        </p>

        <p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>" type="checkbox" name="<?php echo esc_attr( $this->get_field_name( 'show_image' ) ); ?>" value="1" <?php checked( $instance['show_image'] ); ?>/>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_image' ) ); ?>"><?php _e( 'Show Featured Image', 'shtheme' ); ?></label>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_alignment' ); ?>"><?php _e( 'Image Alignment', 'shtheme' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_alignment' ); ?>" name="<?php echo $this->get_field_name( 'image_alignment' ); ?>">
                <option value="alignleft" <?php selected( 'alignleft', $instance['image_alignment'] ); ?>><?php _e( 'Left', 'shtheme' ); ?></option>
                <option value="alignright" <?php selected( 'alignright', $instance['image_alignment'] ); ?>><?php _e( 'Right', 'shtheme' ); ?></option>
                <option value="aligncenter" <?php selected( 'aligncenter', $instance['image_alignment'] ); ?>><?php _e( 'Center', 'shtheme' ); ?></option>
            </select>
        </p>

        <p>
            <label for="<?php echo $this->get_field_id( 'image_size' ); ?>"><?php _e( 'Image Size', 'shtheme' ); ?>:</label>
            <select id="<?php echo $this->get_field_id( 'image_size' ); ?>" class="" name="<?php echo $this->get_field_name( 'image_size' ); ?>">
                <?php
                $sizes = uni_get_image_sizes();
                foreach( (array) $sizes as $name => $size )
                    echo '<option value="'.esc_attr( $name ).'" '.selected( $name, $instance['image_size'], FALSE ).'>'.esc_html( $name ).'</option>';
                ?>
            </select>
        </p>

        <p>
            <label for="<?php  echo $this->get_field_id('image_height'); ?>"><?php _e('Image Height', 'shtheme'); ?>:</label>
            <input type="text" class="widefat" id="<?php echo $this->get_field_id('image_height'); ?>" name="<?php  echo $this->get_field_name('image_height'); ?>" value="<?php  echo esc_attr( $instance['image_height'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>"><?php _e( 'Content Type', 'shtheme' ); ?>:</label>
            <select id="<?php echo esc_attr( $this->get_field_id( 'show_content' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_content' ) ); ?>">
                <option value="content-limit" <?php selected( 'content-limit', $instance['show_content'] ); ?>><?php _e( 'Show Content Limit', 'shtheme' ); ?></option>
                <option value="" <?php selected( '', $instance['show_content'] ); ?>><?php _e( 'No Content', 'shtheme' ); ?></option>
            </select>
        </p>
        
    <?php
    }
}
