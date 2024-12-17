<?php  
function uni_ux_builder_col(){
    add_ux_builder_shortcode( 'col', array(
        'type' => 'container',
        'name' => __( 'Column', 'ux-builder' ),
        'category' => __( 'Layout' ),
        'template' => uni_ux_builder_template( 'col.html' ),
        'tools' => 'shortcodes/col/col-tools.directive.html',
        'info' => '{{ span }}/12 {{ label }}',
        'require' => array( 'row' ),
        'wrap'   => false,
        'inline' => true,
        'nested' => true,
        'resize' => array( 'right' ),

        'presets' => array(
            array(
                'name' => __( 'Default' ),
                'content' => '[col span="4" span__sm="12"][/col]',
            ),
        ),

        'options' => array(
            'label' => array(
                'full_width'  => true,
                'type'        => 'textfield',
                'heading'     => 'Label',
                'placeholder' => 'Enter admin label here..',
            ),
            'span' => array(
                'type' => 'col-slider',
                'heading' => 'Width',
                'full_width' => true,
                'responsive' => true,
                'auto_focus' => true,
                'default' => 12,
                'max' => 12,
                'min' => 1,
            ),

            'force_first' => array(
                'type' => 'select',
                'heading' => 'Force First Position',
                'default' => '',
                'options' => array(
                    ''   => 'None',
                    'medium' => 'On Tablets',
                    'small'  => 'On Mobile'
                )
            ),

            'divider' => array(
                'type' => 'checkbox',
                'heading' => 'Divider',
            ),

            'padding' => array(
                'type' => 'margins',
                'heading' => 'Padding',
                'full_width' => true,
                'responsive' => true,
                'min' => 0,
                'max' => 200,
                'step' => 1,
            ),

            'margin' => array(
                'type' => 'margins',
                'heading' => 'Margin',
                'full_width' => true,
                'responsive' => true,
                'min' => -500,
                'max' => 500,
                'step' => 1,
            ),

            'align' => array(
                'type' => 'radio-buttons',
                'heading' => 'Text align',
                'default' => '',
                'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/align-radios.php' ),
            ),
            'bg' => array(
                'type' => 'image',
                'heading' => __( 'Image' ),
                'thumb_size' => 'bg_size',
                'bg_position' => 'bg_pos',
            ),
            'bg_size'=> array(
                'type' => 'select',
                'heading' => 'Size',
                'default' => 'large',
                'conditions' => 'bg',
                'options' => uni_ux_builder_image_sizes(),
            ),
            'bg_pos' => array(
                'conditions' => 'bg',
                'type' => 'textfield',
                'heading' => __('Position'),
            ),
            'bg_color' => array(
                'type' => 'colorpicker',
                'heading' => __('Bg Color'),
                'format' => 'rgb',
                'alpha' => true,
                'position' => 'bottom right',
                'helpers' => require( get_template_directory() . '/inc/builder/shortcodes/helpers/colors.php' ),
            ),
            'bg_radius' => array(
                'type'    => 'slider',
                'heading' => __( 'Bg Radius' ),
                'unit'    => 'px',
                'default' => 0,
                'max'     => 100,
                'min'     => 0,
            ),
            'color' => array(
                'type' => 'radio-buttons',
                'heading' => 'Color',
                'default' => '',
                'options' => array(
                    'light'   => array( 'title' => 'Light'),
                    ''  => array( 'title' => 'Dark'),
                ),
            ),
            'sticky' => array(
                'type'    => 'radio-buttons',
                'heading' => 'Sticky',
                'default' => '',
                'options' => array(
                    'true' => array( 'title' => 'On' ),
                    ''     => array( 'title' => 'Off' ),
                ),
            ),
            'sticky_mode' => array(
                'type'       => 'select',
                'heading'    => 'Sticky mode',
                'conditions' => 'sticky === "true"',
                'default'    => '',
                'options'    => array(
                    ''           => 'CSS (native)',
                    'javascript' => 'JavaScript (enhanced)',
                ),
            ),
            'text_depth' => array(
                  'type' => 'slider',
                  'heading' => __('Text Shadow'),
                  'default' => '0',
                  'unit' => '+',
                  'max' => '5',
                  'min' => '0',
            ),

            'max_width' => array(
                'type' => 'scrubfield',
                'heading' => 'Max Width',
                'responsive' => true,
                'default' => '',
                'min' => '0'
            ),

            'aos_animate_mode' => array(
                'type'    => 'radio-buttons',
                'heading' => 'AOS Animate Mode',
                'default' => '',
                'options' => array(
                    'true' => array( 'title' => 'On' ),
                    ''     => array( 'title' => 'Off' ),
                ),
            ),
            'aos_animate'=> array(
                'type' => 'select',
                'heading' => 'Choose AOS Animate',
                'default' => 'none',
                'conditions' => 'aos_animate_mode === "true"',
                'options' => array(
                    'none' => 'None',
                    'fade' => 'Fade',
                    'fade-up' => 'Fade Up',
                    'fade-down' => 'Fade Down',
                    'fade-left' => 'Fade Left',
                    'fade-right' => 'Fade Right',
                    'fade-up-right' => 'Fade Up Right',
                    'fade-up-left' => 'Fade Up Left',
                    'fade-down-right' => 'Fade Down Right',
                    'fade-down-left' => 'Fade Down Left',
                    'flip-up' => 'Flip Up',
                    'flip-down' => 'Flip Down',
                    'flip-left' => 'Flip Left',
                    'flip-right' => 'Flip Right',
                    'slide-up' => 'Slide Up',
                    'slide-down' => 'Slide Down',
                    'slide-left' => 'Slide Left',
                    'slide-right' => 'Slide Right',
                    'zoom-in' => 'Zoom In',
                    'zoom-in-up' => 'Zoom In Up',
                    'zoom-in-down' => 'Zoom In Down',
                    'zoom-in-left' => 'Zoom In Left',
                    'zoom-in-right' => 'Zoom In Right',
                    'zoom-out' => 'Zoom Out',
                    'zoom-out-up' => 'Zoom Out Up',
                    'zoom-out-down' => 'Zoom Out Down',
                    'zoom-out-left' => 'Zoom Out Left',
                    'zoom-out-right' => 'Zoom Out Right',
                ),
            ),
            'aos_animate_duration'=> array(
                'type' => 'select',
                'heading' => 'AOS Animate Duration',
                'default' => 'none',
                'conditions' => 'aos_animate_mode === "true"',
                'options' => array(
                    'none' => 'Default',
                    '500' => '500',
                    '1000' => '1000',
                    '1500' => '1500',
                    '2000' => '2000',
                    '2500' => '2500',
                    '3000' => '3000',
                ),
            ),
            'aos_animate_delay'=> array(
                'type' => 'select',
                'heading' => 'AOS Animate Delay',
                'default' => 'none',
                'conditions' => 'aos_animate_mode === "true"',
                'options' => array(
                    'none' => 'Default',
                    '500' => '500',
                    '1000' => '1000',
                    '1500' => '1500',
                    '2000' => '2000',
                    '2500' => '2500',
                    '3000' => '3000',
                ),
            ),

            'animate' => array(
                'type' => 'select',
                'heading' => 'Animate',
                'default' => 'none',
                'options' => require( get_template_directory() . '/inc/builder/shortcodes/values/animate.php' ),
            ),

            'hover' => array(
                'type' => 'select',
                'heading' => 'Hover effect',
                'options' => array(
                    '' => 'None',
                    'fade' => 'Fade In',
                    'focus' => 'Focus',
                    'blur' => 'Blur In',
                ),
            ),

            'tooltip' => array(
                'type' => 'textfield',
                'heading' => 'Tooltip',
            ),

            'parallax' => array(
                'type' => 'slider',
                'vertical' => true,
                'heading' => 'Parallax',
                'default' => 0,
                'max' => 10,
                'min' => -10,
            ),

            'depth' => array(
                'type' => 'slider',
                'vertical' => true,
                'heading' => 'Depth',
                'default' => 0,
                'max' => 5,
                'min' => 0,
            ),

            'depth_hover' => array(
                'type' => 'slider',
                'vertical' => true,
                'heading' => 'Hover Depth',
                'default' => 0,
                'max' => 5,
                'min' => 0,
            ),
            'border_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/border.php' ),
            'advanced_options' => require( get_template_directory() . '/inc/builder/shortcodes/commons/advanced.php'),
        ),
    ) );
}
add_action('ux_builder_setup', 'uni_ux_builder_col');

function rewrite_shortcode_col() {
    remove_shortcode('col', 'uni_ux_col');
    remove_shortcode('col_inner', 'ux_col');
    remove_shortcode('col_inner_1', 'ux_col');
    remove_shortcode('col_inner_2', 'ux_col');
    add_shortcode('col', 'uni_ux_col');
    add_shortcode('col_inner', 'uni_ux_col');
    add_shortcode('col_inner_1', 'uni_ux_col');
    add_shortcode('col_inner_2', 'uni_ux_col');
}
add_action( 'init', 'rewrite_shortcode_col', 99 );

function uni_ux_col($atts, $content = null) {
    extract( $atts = shortcode_atts( array(
    '_id' => 'col-'.rand(),
    'label' => '',
    'span' => '12',
    'span__md' => isset( $atts['span'] ) ? $atts['span'] : '',
    'span__sm' => '',
    'small' => '12',
    'visibility' => '',
    'divider' => '',
    'aos_animate_mode' => '',
    'aos_animate' => '',
    'aos_animate_duration' => '',
    'aos_animate_delay' => '',
    'padding' => '',
    'padding__md' => '',
    'padding__sm' => '',
    'margin' => '',
    'margin__md' => '',
    'margin__sm' => '',
    'tooltip' => '',
    'max_width' => '',
    'max_width__md' => '',
    'max_width__sm' => '',
    'hover' => '',
    'class' => '',
    'align' => '',
    'color' => '',
    'sticky' => '',
    'sticky_mode' => '',
    'parallax' => '',
    'force_first' => '',
    'bg' => '',
    'bg_size'          => '',
    'bg_pos'           => '',
    'bg_color' => '',
    'bg_radius' => '',
    'depth' => '',
    'depth_hover' => '',
    'text_depth' => '',
    // Border Control.
    'border'        => '',
    'border_margin' => '',
    'border_style'  => '',
    'border_radius' => '',
    'border_color'  => '',
    'border_hover'  => '',
  ), $atts ) );

  // Hide if visibility is hidden
  if($visibility == 'hidden') return;

  $classes[] = 'col';
  $classes_inner[] = 'col-inner';

  // Fix old cols
  if(strpos($span, '/')) $span = flatsome_fix_span($span);

  // add custom class
  if($class) $classes[] = $class;
  if($visibility) $classes[] = $visibility;

  if($span__md) $classes[] = 'medium-'.$span__md;
  if($span__sm) $classes[] = 'small-'.$span__sm;
  if($span) $classes[] = 'large-'.$span;
  if ( $border_hover ) $classes[] = 'has-hover';

  // Force first position
  if($force_first) $classes[] = $force_first.'-col-first';

  // Add divider
  if($divider) $classes[] = 'col-divided';

  // Add Aos Animate Class
  if($aos_animate) { $aos_animate = 'data-aos="'.$aos_animate.'"'; }
  if($aos_animate_duration) { $aos_animate_duration = 'data-aos-duration="'.$aos_animate_duration.'"'; }
  if($aos_animate_delay) { $aos_animate_delay = 'data-aos-delay="'.$aos_animate_delay.'"'; }

  // Add Animation Class
  if($animate) { $animate = 'data-animate="'.$animate.'"'; }

  // Add Align Class
  if($align) $classes_inner[] = 'text-'.$align;

  // Add Hover Class
  if($hover) $classes[] = 'col-hover-'.$hover;

  // Add Depth Class
  if($depth) $classes_inner[] = 'box-shadow-'.$depth;
  if($depth_hover) $classes_inner[] = 'box-shadow-'.$depth_hover.'-hover';
  if($text_depth) $classes_inner[] = 'text-shadow-'.$text_depth;

  // Add Color class
  if($color == 'light') $classes_inner[] = 'dark';

  // Add Toolip Html
  $tooltip_class = '';
  if($tooltip) {
    $tooltip = 'title="'.$tooltip.'"';
    $classes[] = 'tip-top';
  }

  // Parallax
  if($parallax) $parallax = 'data-parallax-fade="true" data-parallax="'.$parallax.'"';

    // Inline CSS
    $css_args = array(
        'bg_color' => array(
            'attribute' => 'background-color',
            'value'     => $bg_color,
        ),
    );

    $col_inner = $sticky ? '> .is-sticky-column > .is-sticky-column__inner > .col-inner' : '> .col-inner';

    $args = array(
        'padding'   => array(
            'selector' => $col_inner,
            'property' => 'padding',
        ),
        'margin'    => array(
            'selector' => $col_inner,
            'property' => 'margin',
        ),
        'bg_radius' => array(
            'selector' => $col_inner,
            'property' => 'border-radius',
            'unit'     => 'px',
        ),
        'max_width' => array(
            'selector' => $col_inner,
            'property' => 'max-width',
        ),
        'bg'         => array(
            'selector' => $col_inner,
            'property' => 'background-image',
            'size'     => $bg_size,
        ),
        'bg_pos'     => array(
            'selector' => $col_inner,
            'property' => 'background-position',
        ),
    );

    $classes          = implode( ' ', $classes );
    $classes_inner    = implode( ' ', $classes_inner );
    $attributes       = implode( ' ', array( $tooltip, $animate, $aos_animate, $aos_animate_duration, $aos_animate_delay ) );
    $attributes_inner = $parallax;

    ob_start();
    ?>

    <div id="<?php echo $_id; ?>" class="<?php echo esc_attr( $classes ); ?>" <?php echo $attributes; ?>>
        <?php if ( $sticky ) flatsome_sticky_column_open('', $sticky_mode ); ?>
        <div class="<?php echo esc_attr( $classes_inner ); ?>" <?php echo get_shortcode_inline_css( $css_args ); ?> <?php echo $attributes_inner; ?>>
            <?php require get_template_directory() . '/inc/shortcodes/commons/border.php'; ?>
            <?php echo do_shortcode( $content ); ?>
        </div>
        <?php if ( $sticky ) flatsome_sticky_column_close(); ?>
        <?php echo ux_builder_element_style_tag( $_id, $args, $atts ); ?>
    </div>

    <?php
    return ob_get_clean();
}
