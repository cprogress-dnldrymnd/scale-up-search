<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

class Ogeko_Elementor_Search extends Elementor\Widget_Base {
    public function get_name() {
        return 'ogeko-search';
    }

    public function get_title() {
        return esc_html__('Ogeko Search Form', 'ogeko');
    }

    public function get_icon() {
        return 'eicon-site-search';
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    protected function register_controls() {
        $this->start_controls_section(
            'search-form-style',
            [
                'label' => esc_html__('Style', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'layout_style',
            [
                'label'   => esc_html__('Layout Style', 'ogeko'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'layout-1' => esc_html__('Layout 1', 'ogeko'),
                    'layout-2' => esc_html__('Layout 2', 'ogeko'),
                ],
                'default' => 'layout-1',
            ]
        );

        $this->add_control(
            'show_custom_button',
            [
                'label'     => __('Custom Button', 'ogeko'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'ogeko'),
                'label_on'  => __('On', 'ogeko'),
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup .content' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                    'layout_style' => 'layout-2',
                ]
            ]
        );

        $this->add_control(
            'text_color_hover',
            [
                'label'     => esc_html__('Text Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup:hover .content' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                    'layout_style' => 'layout-2',
                ]
            ]
        );

        $this->add_responsive_control(
            'width_button',
            [
                'label' => esc_html__( 'Width Button', 'ogeko' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%'],

                'selectors' => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                    'layout_style' => 'layout-1',
                ]
            ]
        );

        $this->add_responsive_control(
            'height_button',
            [
                'label' => esc_html__( 'Height Button', 'ogeko' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 1000,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => [ 'px', '%'],

                'selectors' => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'height: {{SIZE}}{{UNIT}}',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                    'layout_style' => 'layout-1',
                ]
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'ogeko' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'icon_line_height',
            [
                'label' => esc_html__( 'Icon Line Height', 'ogeko' ),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'icon_color_form',
            [
                'label'     => esc_html__('Color Icon', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'icon_color_form_hover',
            [
                'label'     => esc_html__('Icon Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup:hover .ogeko-icon-search' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .button-search-popup .ogeko-icon-search',
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'border_color_focus',
            [
                'label'     => esc_html__('Border Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup:hover .ogeko-icon-search' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .button-search-popup:focus .ogeko-icon-search' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'border_radius_input',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'background_form',
            [
                'label'     => esc_html__('Background Button', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup .ogeko-icon-search' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                    'layout_style' => 'layout-1',
                ],
                'separator' => 'before',
            ]
        );
        $this->add_control(
            'background_form_hover',
            [
                'label'     => esc_html__('Background Button Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .button-search-popup:hover .ogeko-icon-search' => 'background: {{VALUE}};',
                ],
                'condition' => [
                    'show_custom_button' => 'yes',
                    'layout_style' => 'layout-1',
                ]
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        wp_enqueue_script('ogeko-search-popup');
        add_action('wp_footer', 'ogeko_header_search_popup', 1);
        if ($settings['layout_style'] === 'layout-2'):
            ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup layout-2">
                    <i class="ogeko-icon-search"></i>
                    <span class="content"><?php echo esc_html__('Search...', 'ogeko'); ?></span>
                </a>
            </div>
        <?php else: ?>
            <div class="site-header-search">
                <a href="#" class="button-search-popup layout-1">
                    <i class="ogeko-icon-search"></i>
                    <span class="content"><?php echo esc_html__('Search', 'ogeko'); ?></span>
                </a>
            </div>
        <?php
        endif;
    }
}

$widgets_manager->register(new Ogeko_Elementor_Search());
