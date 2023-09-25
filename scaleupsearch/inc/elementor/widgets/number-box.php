<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Icons_Manager;
use Elementor\Repeater;

class Ogeko_Elementor_Number_Box extends Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve numberbox widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */


    public function get_name() {
        return 'ogeko-number-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve numberbox widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Number Box', 'ogeko');
    }

    /**
     * Get widget icon.
     *
     * Retrieve numberbox widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-number-field';
    }

    public function get_script_depends() {
        return ['ogeko-elementor-number-box', 'swiper'];
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    /**
     * Register numberbox widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_number',
            [
                'label' => esc_html__('Number', 'ogeko'),
            ]
        );
        $repeater = new Repeater();

        $repeater->add_control(
            'number',
            [
                'label'       => esc_html__('Number', 'ogeko'),
                'default'     => '01',
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'heading',
            [
                'label'       => esc_html__('Heading', 'ogeko'),
                'default'     => 'This is the heading',
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'ogeko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'ogeko'),
                'placeholder' => esc_html__('Enter your description', 'ogeko'),
                'separator'   => 'none',
                'rows'        => 5,
                'show_label'  => false,
            ]
        );

        $this->add_control(
            'numberbox',
            [
                'label'       => esc_html__('Item', 'ogeko'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ number }}}',
            ]
        );


        $column = range(1, 10);
        $column = array_combine($column, $column);

        $this->add_responsive_control(
            'column',
            [
                'label'              => esc_html__('Columns', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                                            '' => esc_html__('Default', 'ogeko'),
                                        ] + $column,
                'frontend_available' => true,
                'render_type'        => 'template',
                'selectors'          => [
                    '{{WRAPPER}}' => '--e-column-to-show: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'column_spacing',
            [
                'label'     => esc_html__('Column Spacing', 'ogeko'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''       => esc_html__('Default', 'ogeko'),
                    'custom' => esc_html__('Custom', 'ogeko'),
                ],
                'default'   => 30,
                'condition' => [
                    'column!' => '1',
                ],
            ]
        );

        $this->add_control(
            'column_spacing_custom',
            [
                'label'              => esc_html__('Column Spacing', 'ogeko'),
                'type'               => Controls_Manager::SLIDER,
                'range'              => [
                    'px' => [
                        'max' => 100,
                    ],
                ],
                'default'            => [
                    'size' => 30,
                ],
                'show_label'         => false,
                'condition'          => [
                    'column_spacing' => 'custom',
                    'column!'        => '1',
                ],
                'frontend_available' => true,
                'render_type'        => 'none',
                'separator'          => 'after',
            ]
        );

        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable Carousel', 'ogeko'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->end_controls_section();
        $this->add_control_style_wrapper();
        $this->add_control_style_number();
        $this->add_control_style_heading();
        $this->add_control_style_description();
        $this->add_control_swiperjs();
    }

    protected function add_control_style_wrapper() {
        // Wrapper.
        $this->start_controls_section(
            'section_style_wrapper',
            [
                'label' => esc_html__('Wrapper', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-numberbox-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_margin',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-numberbox-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'wrapper_box_shadow',
                'selector' => '{{WRAPPER}} .slick-slide.slick-active .elementor-numberbox-wrapper, {{WRAPPER}}  .ogeko-not-carousel .elementor-numberbox-wrapper',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'wrapper_border',
                'selector'  => '{{WRAPPER}} .elementor-numberbox-wrapper',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-numberbox-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function add_control_style_number() {
        // Number.
        $this->start_controls_section(
            'section_style_number',
            [
                'label' => esc_html__('Number', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'number_width',
            [
                'label'     => __('Width', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 30,
                        'max' => 500,
                    ],
                ],
                'default'   => [
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .number-number' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}; flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'number_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_bg_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .number-number' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'number_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .number-number' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'number_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .number-number',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'number_text_stroke',
                'selector' => '{{WRAPPER}} .number-number',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'number_text_shadow',
                'selector' => '{{WRAPPER}} .number-number',
            ]
        );

        $spacing = is_rtl() ? 'left: {{SIZE}}{{UNIT}};' : 'right: {{SIZE}}{{UNIT}};';

        $this->add_responsive_control(
            'number_spacing',
            [
                'label'     => __('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .number-number' => 'margin-' . $spacing,
                ],
                'separator' => 'before'
            ]
        );

        // Heading.
        $this->add_control(
            'section_style_number_decor',
            [
                'label'     => esc_html__('Decor', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            "decor_effect_x",
            [
                'label'      => esc_html__('Offset X', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range'      => [
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    "{{WRAPPER}} .number-decor" => 'right: {{SIZE}}{{UNIT}};',
                ],
                //                'frontend_available' => true,
            ]
        );

        $this->add_responsive_control(
            "decor_effect_y",
            [
                'label'      => esc_html__('Offset Y', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['%', 'px'],
                'range'      => [
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => -1000,
                        'max' => 1000,
                    ],
                ],
                'selectors'  => [
                    "{{WRAPPER}} .number-decor" => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'decor_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number-decor' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'decor_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .number-decor',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'decor_text_stroke',
                'selector' => '{{WRAPPER}} .number-decor',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'decor_text_shadow',
                'selector' => '{{WRAPPER}} .number-decor',
            ]
        );

        $this->end_controls_section();
    }

    protected function add_control_style_heading() {
        // Heading.
        $this->start_controls_section(
            'section_style_heading',
            [
                'label' => esc_html__('Heading', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'heading_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number-heading' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'heading_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .number-heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'heading_text_stroke',
                'selector' => '{{WRAPPER}} .number-heading',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'heading_text_shadow',
                'selector' => '{{WRAPPER}} .number-heading',
            ]
        );

        $this->end_controls_section();
    }

    protected function add_control_style_description() {
        // Description.
        $this->start_controls_section(
            'section_style_description',
            [
                'label' => esc_html__('Description', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .number-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .number-description',
            ]
        );

        $this->add_responsive_control(
            'description_spacing',
            [
                'label'     => __('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 60,
                ],
                'selectors' => [
                    '{{WRAPPER}} .number-description' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
    }

//    carousel
    protected function add_control_swiperjs() {
        $this->start_controls_section(
            'section_swiperjs_options',
            [
                'label'     => esc_html__('Caroseul Options', 'ogeko'),
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'swiper_overflow',
            [
                'label'              => esc_html__('Overflow', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'none',
                'options'            => [
                    'none'  => esc_html__('None', 'ogeko'),
                    'left'  => esc_html__('Overflow to the left', 'ogeko'),
                    'right' => esc_html__('Overflow to the right', 'ogeko'),
                ],
                'frontend_available' => true,
                'prefix_class'       => 'overflow-to-',
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label'              => esc_html__('Navigation', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'both',
                'options'            => [
                    'both'   => esc_html__('Arrows and Dots', 'ogeko'),
                    'arrows' => esc_html__('Arrows', 'ogeko'),
                    'dots'   => esc_html__('Dots', 'ogeko'),
                    'none'   => esc_html__('None', 'ogeko'),
                ],
                'frontend_available' => true,

            ]
        );

        $this->add_control(
            'navigation_previous_icon',
            [
                'label'            => esc_html__('Previous Arrow Icon', 'ogeko'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin'             => 'inline',
                'label_block'      => false,
                'skin_settings'    => [
                    'inline' => [
                        'none' => [
                            'label' => 'Default',
                            'icon'  => 'eicon-chevron-left',
                        ],
                        'icon' => [
                            'icon' => 'eicon-star',
                        ],
                    ],
                ],
                'recommended'      => [
                    'fa-regular' => [
                        'arrow-alt-circle-left',
                        'caret-square-left',
                    ],
                    'fa-solid'   => [
                        'angle-double-left',
                        'angle-left',
                        'arrow-alt-circle-left',
                        'arrow-circle-left',
                        'arrow-left',
                        'caret-left',
                        'caret-square-left',
                        'chevron-circle-left',
                        'chevron-left',
                        'long-arrow-alt-left',
                    ],
                ],
                'conditions'       => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'navigation',
                            'operator' => '=',
                            'value'    => 'both',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '=',
                            'value'    => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->add_control(
            'navigation_next_icon',
            [
                'label'            => esc_html__('Next Arrow Icon', 'ogeko'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'skin'             => 'inline',
                'label_block'      => false,
                'skin_settings'    => [
                    'inline' => [
                        'none' => [
                            'label' => 'Default',
                            'icon'  => 'eicon-chevron-right',
                        ],
                        'icon' => [
                            'icon' => 'eicon-star',
                        ],
                    ],
                ],
                'recommended'      => [
                    'fa-regular' => [
                        'arrow-alt-circle-right',
                        'caret-square-right',
                    ],
                    'fa-solid'   => [
                        'angle-double-right',
                        'angle-right',
                        'arrow-alt-circle-right',
                        'arrow-circle-right',
                        'arrow-right',
                        'caret-right',
                        'caret-square-right',
                        'chevron-circle-right',
                        'chevron-right',
                        'long-arrow-alt-right',
                    ],
                ],
                'conditions'       => [
                    'relation' => 'or',
                    'terms'    => [
                        [
                            'name'     => 'navigation',
                            'operator' => '=',
                            'value'    => 'both',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '=',
                            'value'    => 'arrows',
                        ],
                    ],
                ],
            ]
        );
        $this->end_controls_section();
        $this->start_controls_section(
            'section_additional_options',
            [
                'label'     => esc_html__('Additional Options', 'ogeko'),
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );


        $this->add_control(
            'lazyload',
            [
                'label'              => esc_html__('Lazyload', 'ogeko'),
                'type'               => Controls_Manager::SWITCHER,
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'              => esc_html__('Autoplay', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'yes',
                'options'            => [
                    'yes' => esc_html__('Yes', 'ogeko'),
                    'no'  => esc_html__('No', 'ogeko'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'              => esc_html__('Pause on Hover', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'yes',
                'options'            => [
                    'yes' => esc_html__('Yes', 'ogeko'),
                    'no'  => esc_html__('No', 'ogeko'),
                ],
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'pause_on_interaction',
            [
                'label'              => esc_html__('Pause on Interaction', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'yes',
                'options'            => [
                    'yes' => esc_html__('Yes', 'ogeko'),
                    'no'  => esc_html__('No', 'ogeko'),
                ],
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'              => esc_html__('Autoplay Speed', 'ogeko'),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 5000,
                'condition'          => [
                    'autoplay' => 'yes',
                ],
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        // Loop requires a re-render so no 'render_type = none'
        $this->add_control(
            'infinite',
            [
                'label'              => esc_html__('Infinite Loop', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'yes',
                'options'            => [
                    'yes' => esc_html__('Yes', 'ogeko'),
                    'no'  => esc_html__('No', 'ogeko'),
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'effect',
            [
                'label'              => esc_html__('Effect', 'ogeko'),
                'type'               => Controls_Manager::SELECT,
                'default'            => 'slide',
                'options'            => [
                    'slide' => esc_html__('Slide', 'ogeko'),
                    'fade'  => esc_html__('Fade', 'ogeko'),
                ],
                'condition'          => [
                    'slides_to_show' => '1',
                ],
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label'              => esc_html__('Animation Speed', 'ogeko'),
                'type'               => Controls_Manager::NUMBER,
                'default'            => 500,
                'render_type'        => 'none',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'direction',
            [
                'label'   => esc_html__('Direction', 'ogeko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'ltr',
                'options' => [
                    'ltr' => esc_html__('Left', 'ogeko'),
                    'rtl' => esc_html__('Right', 'ogeko'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_navigation',
            [
                'label'     => esc_html__('Navigation', 'ogeko'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'navigation'      => ['arrows', 'dots', 'both'],
                    'enable_carousel' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'heading_style_arrows',
            [
                'label'     => esc_html__('Arrows', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_size',
            [
                'label'     => esc_html__('Size', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 20,
                        'max' => 60,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_width',
            [
                'label'      => esc_html__('Width', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px', 'vw'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_height',
            [
                'label'      => esc_html__('Height', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
                'default'    => [
                    'unit' => 'px',
                ],
                'size_units' => ['%', 'px', 'vw'],
                'range'      => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 200,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(

            Group_Control_Border::get_type(),
            [
                'name'      => 'arrows_border',
                'selector'  => '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'arrows_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'arrows_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next',
            ]
        );

        $this->start_controls_tabs('arrows_tabs');

        $this->start_controls_tab('arrows_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'arrows_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next'         => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev svg, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_background_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('arrows_hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_control(
            'arrows_color_hover',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next:hover'         => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev:hover svg, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next:hover svg' => 'fill: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_background_color_hover',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next:hover' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_border_color_hover',
            [
                'label'     => esc_html__('Border Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev:hover, {{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next:hover' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'arrows_next_heading',
            [
                'label'     => esc_html__('Next button', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_next_vertical',
            [
                'label'        => esc_html__('Next Vertical', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'options'      => [
                    'top'    => [
                        'title' => esc_html__('Top', 'ogeko'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'ogeko'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'elementor-swiper-button-next-vertical-',
                'condition'    => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_next_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'top: unset; bottom: unset; {{arrows_next_vertical.value}}: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'navigation'           => ['arrows', 'both'],
                    'arrows_next_vertical' => ['top', 'bottom'],
                ],
            ]
        );

        $this->add_control(
            'arrows_next_horizontal',
            [
                'label'        => esc_html__('Next Horizontal', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'options'      => [
                    'left'  => [
                        'title' => esc_html__('Left', 'ogeko'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'ogeko'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-swiper-button-next-horizontal-',
                'condition'    => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );
        $this->add_responsive_control(
            'next_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => -45,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-next' => 'left: unset; right: unset;{{arrows_next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ],
                'condition'  => [
                    'navigation'             => ['arrows', 'both'],
                    'arrows_next_horizontal' => ['left', 'right'],
                ],

            ]
        );

        $this->add_control(
            'arrows_prev_heading',
            [
                'label'     => esc_html__('Prev button', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_control(
            'arrows_prev_vertical',
            [
                'label'        => esc_html__('Prev Vertical', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'render_type'  => 'ui',
                'options'      => [
                    'top'    => [
                        'title' => esc_html__('Top', 'ogeko'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'ogeko'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'prefix_class' => 'elementor-swiper-button-prev-vertical-',
                'condition'    => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );

        $this->add_responsive_control(
            'arrows_prev_vertical_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => '%',
                    'size' => 50,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev' => 'top: unset; bottom: unset; {{arrows_prev_vertical.value}}: {{SIZE}}{{UNIT}};',
                ],

                'condition' => [
                    'navigation'           => ['arrows', 'both'],
                    'arrows_prev_vertical' => ['top', 'bottom'],
                ],
            ]
        );

        $this->add_control(
            'arrows_prev_horizontal',
            [
                'label'        => esc_html__('Prev Horizontal', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'label_block'  => false,
                'options'      => [
                    'left'  => [
                        'title' => esc_html__('Left', 'ogeko'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'ogeko'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'prefix_class' => 'elementor-swiper-button-prev-horizontal-',
                'condition'    => [
                    'navigation' => ['arrows', 'both'],
                ],
            ]
        );
        $this->add_responsive_control(
            'arrows_prev_horizontal_value',
            [
                'type'       => Controls_Manager::SLIDER,
                'show_label' => false,
                'size_units' => ['px', 'em', '%'],
                'range'      => [
                    'px' => [
                        'min'  => -1000,
                        'max'  => 1000,
                        'step' => 1,
                    ],
                    '%'  => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'default'    => [
                    'unit' => 'px',
                    'size' => 0,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-swiper-button.elementor-swiper-button-prev' => 'left: unset; right: unset; {{arrows_prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ],

                'condition' => [
                    'navigation'             => ['arrows', 'both'],
                    'arrows_prev_horizontal' => ['left', 'right'],
                ],
            ]
        );

        $this->add_control(
            'heading_style_dots',
            [
                'label'     => esc_html__('Pagination', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'dots_position',
            [
                'label'        => esc_html__('Position', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'outside',
                'options'      => [
                    'outside' => esc_html__('Outside', 'ogeko'),
                    'inside'  => esc_html__('Inside', 'ogeko'),
                ],
                'prefix_class' => 'elementor-pagination-position-',
                'condition'    => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'dots_size',
            [
                'label'     => esc_html__('Size', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 5,
                        'max' => 10,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'dots_inactive_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    // The opacity property will override the default inactive dot color which is opacity 0.2.
                    '{{WRAPPER}} .swiper-pagination-bullet:not(.swiper-pagination-bullet-active)' => 'background: {{VALUE}}; opacity: 1',
                ],
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label'     => esc_html__('Active Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'navigation' => ['dots', 'both'],
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render numberbox widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (empty($settings['numberbox']) && !is_array($settings['numberbox'])) {
            return;
        }

        //Container
        $this->add_render_attribute('container', 'class', 'ogeko-container');

        // Row
        $this->add_render_attribute('row', 'class', 'ogeko-row');

        // Column
        $this->add_render_attribute('column', 'class', 'column-item');

        //Inner
        $this->add_render_attribute('inner', 'class', 'elementor-numberbox-inner');

        // Carousel
        if ($settings['enable_carousel'] === 'yes') {
            $this->add_render_attribute('container', 'class', 'swiper-container');
            $this->add_render_attribute('row', 'class', 'swiper-wrapper');
            $this->add_render_attribute('column', 'class', 'swiper-slide');
        } else {

            if (!empty($settings['column_widescreen'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-widescreen', $settings['column_widescreen']);
            }

            if (!empty($settings['column'])) {
                $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns', 4);
            }

            if (!empty($settings['column_laptop'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-laptop', $settings['column_laptop']);
            }

            if (!empty($settings['column_tablet_extra'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet-extra', $settings['column_tablet_extra']);
            }

            if (!empty($settings['column_tablet'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns-tablet', 2);
            }

            if (!empty($settings['column_mobile_extra'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile-extra', $settings['column_mobile_extra']);
            }

            if (!empty($settings['column_mobile'])) {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
            } else {
                $this->add_render_attribute('row', 'data-elementor-columns-mobile', 1);
            }
        }
        ?>
        <div <?php $this->print_render_attribute_string('container'); ?>>
            <div <?php $this->print_render_attribute_string('row'); ?>>
                <?php foreach ($settings['numberbox'] as $index => $numberbox): ?>
                    <div <?php $this->print_render_attribute_string('column'); ?>>
                        <div <?php $this->print_render_attribute_string('inner'); ?>>

                            <?php if ($numberbox['number']) : ?>
                                <div class="number-decor"><?php $this->print_unescaped_setting('number', 'numberbox', $index); ?></div>
                            <?php endif; ?>

                            <div class="number-header">
                                <?php if ($numberbox['number']) : ?>
                                    <div class="number-number"><?php $this->print_unescaped_setting('number', 'numberbox', $index); ?></div>
                                <?php endif; ?>

                                <?php if ($numberbox['heading']) : ?>
                                    <div class="number-heading"><?php $this->print_unescaped_setting('heading', 'numberbox', $index); ?></div>
                                <?php endif; ?>
                            </div>

                            <?php if ($numberbox['description']) : ?>
                                <div class="number-description">
                                    <?php $this->print_unescaped_setting('description', 'numberbox', $index); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <?php $this->get_swiper_navigation($settings); ?>
        </div>
    <?php }

    private function get_swiper_navigation($settings) {
        $show_dots    = (in_array($settings['navigation'], ['dots', 'both']));
        $show_arrows  = (in_array($settings['navigation'], ['arrows', 'both']));
        $slides_count = count($settings['numberbox']);
        if (1 < $slides_count) : ?>
            <?php if ($show_dots) : ?>
                <div class="swiper-pagination"></div>
            <?php endif; ?>
            <?php if ($show_arrows) : ?>
                <div class="elementor-swiper-button-wrapper">
                    <div class="elementor-swiper-button elementor-swiper-button-prev">
                        <?php $this->render_swiper_button('previous'); ?>
                        <span class="elementor-screen-only"><?php echo esc_html__('Previous', 'ogeko'); ?></span>
                    </div>
                    <div class="elementor-swiper-button elementor-swiper-button-next">
                        <?php $this->render_swiper_button('next'); ?>
                        <span class="elementor-screen-only"><?php echo esc_html__('Next', 'ogeko'); ?></span>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif;
    }

    private function render_swiper_button($type) {
        $direction     = 'next' === $type ? 'right' : 'left';
        $icon_settings = $this->get_settings_for_display('navigation_' . $type . '_icon');

        if (empty($icon_settings['value'])) {
            $icon_settings = [
                'library' => 'eicons',
                'value'   => 'eicon-chevron-' . $direction,
            ];
        }
        Icons_Manager::render_icon($icon_settings, ['aria-hidden' => 'true']);
    }

}

$widgets_manager->register(new Ogeko_Elementor_Number_Box());
