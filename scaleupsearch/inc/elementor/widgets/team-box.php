<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Group_Control_Box_Shadow;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class Ogeko_Elementor_Team_Box extends Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve teambox widget name.
     *
     * @return string Widget name.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'ogeko-team-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve teambox widget title.
     *
     * @return string Widget title.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Team Box', 'ogeko');
    }

    /**
     * Get widget icon.
     *
     * Retrieve teambox widget icon.
     *
     * @return string Widget icon.
     * @since  1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-person';
    }

    public function get_script_depends() {
        return ['ogeko-elementor-team-box', 'slick'];
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    /**
     * Register teambox widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_team',
            [
                'label' => esc_html__('Team', 'ogeko'),
            ]
        );
        $repeater = new Repeater();


        $repeater->add_control(
            'teambox_image',
            [
                'label'      => esc_html__('Choose Image', 'ogeko'),
                'default'    => [
                    'url' => Elementor\Utils::get_placeholder_image_src(),
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );

        $repeater->add_control(
            'job',
            [
                'label'   => esc_html__('Job', 'ogeko'),
                'default' => 'Designer',
                'type'    => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'name',
            [
                'label'   => esc_html__('Name', 'ogeko'),
                'default' => 'John Doe',
                'type'    => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'link_to',
            [
                'label'       => esc_html__('Link to', 'ogeko'),
                'placeholder' => esc_html__('https://your-link.com', 'ogeko'),
                'type'        => Controls_Manager::URL,
            ]
        );


        $repeater->add_control(
            'mobile',
            [
                'label'       => esc_html__('Mobile', 'ogeko'),
                'placeholder' => esc_html__('+84 - 123 456 78', 'ogeko'),
                'default'     => '+84 - 123 456 78',
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'email',
            [
                'label'       => esc_html__('Email', 'ogeko'),
                'placeholder' => esc_html__('ogeko@example.com', 'ogeko'),
                'default'     => 'ogeko@example.com',
                'type'        => Controls_Manager::TEXT,
            ]
        );


        $repeater->add_control(
            'facebook',
            [
                'label'       => esc_html__('Facebook', 'ogeko'),
                'placeholder' => esc_html__('https://www.facebook.com/themelexus', 'ogeko'),
                'default'     => 'https://www.facebook.com/themelexus',
                'type'        => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'twitter',
            [
                'label'       => esc_html__('Twitter', 'ogeko'),
                'placeholder' => esc_html__('https://twitter.com/themelexus', 'ogeko'),
                'default'     => 'https://twitter.com/themelexus',
                'type'        => Controls_Manager::TEXT,
            ]
        );

        $repeater->add_control(
            'instagram',
            [
                'label'       => esc_html__('Instagram', 'ogeko'),
                'placeholder' => esc_html__('https://www.instagram.com/themelexus/', 'ogeko'),
                'default'     => 'https://www.instagram.com/themelexus/',
                'type'        => Controls_Manager::TEXT,
            ]
        );
        $this->add_control(
            'teambox',
            [
                'label'       => esc_html__('Items', 'ogeko'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'    => 'teambox_image', // Actually its `image_size`
                'label'   => esc_html__('Image Size', 'ogeko'),
                'default' => 'large',
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label'   => esc_html__('Columns', 'ogeko'),
                'type'    => \Elementor\Controls_Manager::SELECT,
                'default' => 1,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
            ]
        );


        $this->end_controls_section();

        $this->add_control_carousel();

    }

//  carousel
    protected function add_control_carousel($condition = array()) {
        $this->start_controls_section(
            'section_carousel_options',
            [
                'label'     => esc_html__('Carousel Options', 'ogeko'),
                'type'      => Controls_Manager::SECTION,
                'condition' => $condition,
            ]
        );
        $this->add_control(
            'enable_carousel',
            [
                'label' => esc_html__('Enable', 'ogeko'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'navigation',
            [
                'label'     => esc_html__('Navigation', 'ogeko'),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'dots',
                'options'   => [
                    'both'   => esc_html__('Arrows and Dots', 'ogeko'),
                    'arrows' => esc_html__('Arrows', 'ogeko'),
                    'dots'   => esc_html__('Dots', 'ogeko'),
                    'none'   => esc_html__('None', 'ogeko'),
                ],
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label'     => esc_html__('Pause on Hover', 'ogeko'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label'     => esc_html__('Autoplay', 'ogeko'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label'     => esc_html__('Autoplay Speed', 'ogeko'),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => [
                    'autoplay'        => 'yes',
                    'enable_carousel' => 'yes'
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-slide-bg' => 'animation-duration: calc({{VALUE}}ms*1.2); transition-duration: calc({{VALUE}}ms)',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label'     => esc_html__('Infinite Loop', 'ogeko'),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'condition' => [
                    'enable_carousel' => 'yes'
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_arrows',
            [
                'label'      => esc_html__('Carousel Arrows', 'ogeko'),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'dots',
                        ],
                    ],
                ],
            ]
        );

        //Style arrow
        $this->add_control(
            'style_arrow',
            [
                'label'        => esc_html__('Style Arrow', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'style-1' => esc_html__('Style 1', 'ogeko'),
                    'style-2' => esc_html__('Style 2', 'ogeko'),
                    'style-3' => esc_html__('Style 3', 'ogeko'),
                ],
                'default'      => 'style-1',
                'prefix_class' => 'arrow-'
            ]
        );

        //add icon next size
        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => esc_html__('Size', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-arrow:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_width',
            [
                'label'          => esc_html__('Width', 'ogeko'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'carousel_height',
            [
                'label'          => esc_html__('Height', 'ogeko'),
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%', 'px', 'vw'],
                'range'          => [
                    '%'  => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_button',
            [
                'label' => esc_html__('Color', 'ogeko'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->start_controls_tabs('tabs_carousel_arrow_style');

        $this->start_controls_tab(
            'tab_carousel_arrow_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'carousel_arrow_color_icon',
            [
                'label'     => esc_html__('Color icon', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_border',
            [
                'label'     => esc_html__('Color Border', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_background',
            [
                'label'     => esc_html__('Color background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_arrow_hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_control(
            'carousel_arrow_color_icon_hover',
            [
                'label'     => esc_html__('Color icon', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_border_hover',
            [
                'label'     => esc_html__('Color Border', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_arrow_color_background_hover',
            [
                'label'     => esc_html__('Color background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-slider button.slick-prev:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-slider button.slick-next:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'next_heading',
            [
                'label' => esc_html__('Next button', 'ogeko'),
                'type'  => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'next_vertical',
            [
                'label'       => esc_html__('Next Vertical', 'ogeko'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'ogeko'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'ogeko'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'next_vertical_value',
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
                    '{{WRAPPER}} .slick-next' => 'top: unset; bottom: unset; {{next_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'next_horizontal',
            [
                'label'       => esc_html__('Next Horizontal', 'ogeko'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'ogeko'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'ogeko'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'right'
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
                    '{{WRAPPER}} .slick-next' => 'left: unset; right: unset;{{next_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_control(
            'prev_heading',
            [
                'label'     => esc_html__('Prev button', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'prev_vertical',
            [
                'label'       => esc_html__('Prev Vertical', 'ogeko'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'top'    => [
                        'title' => esc_html__('Top', 'ogeko'),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'bottom' => [
                        'title' => esc_html__('Bottom', 'ogeko'),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ]
            ]
        );

        $this->add_responsive_control(
            'prev_vertical_value',
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
                    '{{WRAPPER}} .slick-prev' => 'top: unset; bottom: unset; {{prev_vertical.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );
        $this->add_control(
            'prev_horizontal',
            [
                'label'       => esc_html__('Prev Horizontal', 'ogeko'),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options'     => [
                    'left'  => [
                        'title' => esc_html__('Left', 'ogeko'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('Right', 'ogeko'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'defautl'     => 'left'
            ]
        );
        $this->add_responsive_control(
            'prev_horizontal_value',
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
                    '{{WRAPPER}} .slick-prev' => 'left: unset; right: unset; {{prev_horizontal.value}}: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'carousel_dots',
            [
                'label'      => esc_html__('Carousel Dots', 'ogeko'),
                'conditions' => [
                    'relation' => 'and',
                    'terms'    => [
                        [
                            'name'     => 'enable_carousel',
                            'operator' => '==',
                            'value'    => 'yes',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'none',
                        ],
                        [
                            'name'     => 'navigation',
                            'operator' => '!==',
                            'value'    => 'arrows',
                        ],
                    ],
                ],
            ]
        );

        $this->start_controls_tabs('tabs_carousel_dots_style');

        $this->start_controls_tab(
            'tab_carousel_dots_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'carousel_dots_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity',
            [
                'label'     => esc_html__('Opacity', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover'        => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:focus'        => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:hover:before' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li button:focus:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_hover',
            [
                'label'     => esc_html__('Opacity', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover' => 'opacity: {{SIZE}};',
                    '{{WRAPPER}} .slick-dots li button:focus' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_carousel_dots_activate',
            [
                'label' => esc_html__('Activate', 'ogeko'),
            ]
        );

        $this->add_control(
            'carousel_dots_color_activate',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button'        => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .slick-dots li.slick-active button:before' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'carousel_dots_opacity_activate',
            [
                'label'     => esc_html__('Opacity', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max'  => 1,
                        'min'  => 0.10,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li.slick-active button' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'dots_vertical_value',
            [
                'label'      => esc_html__('Spacing', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
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
                    'size' => '',
                ],
                'selectors'  => [
                    '{{WRAPPER}} .slick-dots'              => 'bottom: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.dots-style-2 .slick-dots' => 'margin-top: {{SIZE}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'Alignment_text',
            [
                'label'     => esc_html__('Alignment text', 'ogeko'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => esc_html__('Left', 'ogeko'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'ogeko'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'  => [
                        'title' => esc_html__('Right', 'ogeko'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'default'   => 'center',
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_section();
        // Wrapper.
        $this->start_controls_section(
            'section_style_team_wrapper',
            [
                'label' => esc_html__('Wrapper', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding_inner',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-teambox-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-teambox-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-teambox-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();


        // Image.
        $this->start_controls_section(
            'section_style_team_image',
            [
                'label' => esc_html__('Image', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'image_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .team-top' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'image_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .team-image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'image_margin',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .team-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name.
        $this->start_controls_section(
            'section_style_team_name',
            [
                'label' => esc_html__('Name', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teambox-item .team-name a' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-teambox-item .team-name'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_text_color_hover',
            [
                'label'     => esc_html__('Hover Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teambox-item:hover .team-name'   => 'color: {{VALUE}}',
                    '{{WRAPPER}} .elementor-teambox-item:hover .team-name a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .elementor-teambox-item .team-name',
            ]
        );

        $this->add_responsive_control(
            'name_space',
            [
                'label'     => esc_html__('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teambox-item .team-name' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Job.
        $this->start_controls_section(
            'section_style_team_job',
            [
                'label' => esc_html__('Job', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teambox-item .team-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'job_text_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-teambox-item:hover .team-job' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-teambox-item .team-job',
            ]
        );

        $this->add_responsive_control(
            'job_space',
            [
                'label'     => esc_html__('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-teambox-item .team-job' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Icon Social.
        $this->start_controls_section(
            'section_style_icon_social',
            [
                'label' => esc_html__('Icon Social', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_icon_social_style');

        $this->start_controls_tab(
            'tab_icon_social_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'color_icon_social',
            [
                'label'   => esc_html__('Color', 'ogeko'),
                'type'    => Controls_Manager::COLOR,
                'default' => '',

                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials ul a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color_social',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials ul a' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'icon_social_border',
                'selector'  => '{{WRAPPER}} .team-icon-socials ul a',
                'separator' => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_icon_social_hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_control(
            'color_icon_social_hover',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials li.social a:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_color_hover_social',
            [
                'label'     => esc_html__('Background Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials ul a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_color_hover_social',
            [
                'label'     => esc_html__('Border Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .team-icon-socials ul a:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * Render teambox widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!empty($settings['teambox']) && is_array($settings['teambox'])) {

            $this->add_render_attribute('wrapper', 'class', 'elementor-teambox-item-wrapper');
            // Row
            $this->add_render_attribute('row', 'class', 'row');

            // Carousel
            if ($settings['enable_carousel'] === 'yes') {
                $this->add_render_attribute('row', 'class', 'ogeko-carousel');
                $carousel_settings = $this->get_carousel_settings();
                $this->add_render_attribute('row', 'data-settings', wp_json_encode($carousel_settings));

            } else {

                if (!empty($settings['column_widescreen'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns-widescreen', $settings['column_widescreen']);
                }

                if (!empty($settings['column'])) {
                    $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
                } else {
                    $this->add_render_attribute('row', 'data-elementor-columns', 5);
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
        }

        // Item
        $this->add_render_attribute('item', 'class', 'column-item');
        $this->add_render_attribute('details', 'class', 'details');
        ?>

        <div <?php echo ogeko_elementor_get_render_attribute_string('wrapper', $this); // WPCS: XSS ok.
        ?>>
            <div <?php echo ogeko_elementor_get_render_attribute_string('row', $this); // WPCS: XSS ok.
            ?>>
                <?php foreach ($settings['teambox'] as $teambox): ?>
                    <div <?php echo ogeko_elementor_get_render_attribute_string('item', $this); // WPCS: XSS ok. ?>>
                        <div class="elementor-teambox-item">
                            <div class="team-top">
                                <?php $this->render_image($settings, $teambox); ?>
                            </div>
                            <div class="team-caption">
                                <div class="team-job"><?php echo esc_html($teambox['job']); ?></div>
                                <?php
                                $link = '#';
                                if ($teambox['link_to']['url']) {
                                    $link = $teambox['link_to']['url'];
                                } ?>
                                <?php if (!empty($teambox['name'])): ?>
                                    <a href="<?php echo esc_url($link); ?>">
                                        <div class="team-name"><?php echo esc_html($teambox['name']); ?></div>
                                    </a>
                                <?php endif; ?>

                                <div class="team-info">
                                    <ul>
                                        <li class="info-mobile">
                                            <i class="ogeko-icon-phone2"></i> <?php echo esc_html($teambox['mobile']); ?>
                                        </li>
                                        <li class="info-email">
                                            <i class="ogeko-icon-envelop2"></i> <?php echo esc_html($teambox['email']); ?>
                                        </li>
                                    </ul>
                                </div>

                                <div class="team-icon-socials">
                                    <ul>
                                        <?php foreach ($this->get_socials() as $key => $social): ?>
                                            <?php if (!empty($teambox[$key])) : ?>
                                                <li class="social">
                                                    <a href="<?php echo esc_url($teambox[$key]) ?>">
                                                        <i class="ogeko-icon-<?php echo esc_attr($social); ?>"></i>
                                                    </a>
                                                </li>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    <?php }

    private function render_image($settings, $teambox) {
        if (!empty($teambox['teambox_image']['url'])) :
            ?>
            <div class="team-image">
                <?php
                $teambox['teambox_image_size']             = $settings['teambox_image_size'];
                $teambox['teambox_image_custom_dimension'] = $settings['teambox_image_custom_dimension'];
                echo Group_Control_Image_Size::get_attachment_image_html($teambox, 'teambox_image');
                ?>
            </div>
        <?php
        endif;
    }

    private function get_socials() {
        return array(
            'facebook'  => 'facebook',
            'twitter'   => 'twitter',
            'instagram' => 'instagram',
        );
    }

    protected function get_carousel_settings() {
        $settings    = $this->get_settings_for_display();
        $breakpoints = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();
        $tablet      = isset($settings['column_tablet']) ? $settings['column_tablet'] : 2;
        return array(
            'navigation'              => $settings['navigation'],
            'autoplayHoverPause'      => $settings['pause_on_hover'] === 'yes' ? true : false,
            'autoplay'                => $settings['autoplay'] === 'yes' ? true : false,
            'autoplaySpeed'           => $settings['autoplay_speed'],
            'items'                   => $settings['column'],
            'items_laptop'            => isset($settings['column_laptop']) ? $settings['column_laptop'] : $settings['column'],
            'items_tablet_extra'      => isset($settings['column_tablet_extra']) ? $settings['column_tablet_extra'] : $settings['column'],
            'items_tablet'            => $tablet,
            'items_mobile_extra'      => isset($settings['column_mobile_extra']) ? $settings['column_mobile_extra'] : $tablet,
            'items_mobile'            => isset($settings['column_mobile']) ? $settings['column_mobile'] : 1,
            'loop'                    => $settings['infinite'] === 'yes' ? true : false,
            'breakpoint_laptop'       => $breakpoints['laptop']->get_value(),
            'breakpoint_tablet_extra' => $breakpoints['tablet_extra']->get_value(),
            'breakpoint_tablet'       => $breakpoints['tablet']->get_value(),
            'breakpoint_mobile_extra' => $breakpoints['mobile_extra']->get_value(),
            'breakpoint_mobile'       => $breakpoints['mobile']->get_value(),
        );
    }

}

$widgets_manager->register(new Ogeko_Elementor_Team_Box());
