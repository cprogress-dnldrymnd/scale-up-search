<?php
// Icon List
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;

add_action( 'elementor/element/icon-list/section_text_style/after_section_end', function ($element, $args ) {
    /** @var \Elementor\Element_Base $element */
    // Remove Schema
    $element->update_control( 'icon_color', [
        'scheme' => [],
    ] );

    $element->update_control( 'text_color', [
        'scheme'    => [],
        'selectors' => [
            '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item .elementor-icon-list-text' => 'color: {{VALUE}};',
        ],
    ] );

    $element->update_control( 'text_color_hover', [
        'scheme'    => [],
        'selectors' => [
            '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text' => 'color: {{VALUE}};',
        ],
    ] );

    $element->update_control( 'icon_typography', [
        'scheme'    => [],
        'selectors' => '{{WRAPPER}} .elementor-icon-list-items .elementor-icon-list-item:hover .elementor-icon-list-text',
    ] );

    $element->update_control( 'divider_color', [
        'scheme'  => [],
        'default' => ''
    ] );

}, 10, 2 );

add_action( 'elementor/element/icon-list/section_icon_style/before_section_end', function ( $element, $args ) {
    $element->add_control(
        'icon_vertical_position',
        [
            'label' => esc_html__( 'Vertical Position', 'ogeko' ),
            'type' => Controls_Manager::CHOOSE,
            'options' => [
                'flex-start' => [
                    'title' => esc_html__( 'Top', 'ogeko' ),
                    'icon' => 'eicon-v-align-top',
                ],
                'center' => [
                    'title' => esc_html__( 'Middle', 'ogeko' ),
                    'icon' => 'eicon-v-align-middle',
                ],
                'flex-end' => [
                    'title' => esc_html__( 'Bottom', 'ogeko' ),
                    'icon' => 'eicon-v-align-bottom',
                ],
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'align-items: {{VALUE}}',
            ],
        ]
    );

    $element->add_group_control(
        Group_Control_Border::get_type(),
        [
            'name' => 'icon_border',
            'placeholder' => '1px',
            'default' => '1px',
            'selector' => '{{WRAPPER}} .elementor-icon-list-icon i',
        ]
    );

    $element->add_control(
        'icon_border_radius',
        [
            'label' => esc_html__( 'Border Radius', 'ogeko' ),
            'type' => Controls_Manager::DIMENSIONS,
            'size_units' => [ 'px', '%' ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon i' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
            ],
        ]
    );

    $element->add_responsive_control(
        'icon_width',
        [
            'label'     => __('width', 'ogeko'),
            'type'      => Controls_Manager::SLIDER,
            'range'     => [
                'px' => [
                    'min' => 0,
                    'max' => 100,
                ],
            ],
            'default'   => [],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon i' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; text-align:center; flex: 0 0 {{SIZE}}{{UNIT}};',
            ],
        ]
    );

    $element->add_control(
        'icon_height',
        [
            'label' => esc_html__( 'Line Height', 'ogeko' ),
            'type' => Controls_Manager::SLIDER,
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon i' => 'line-height: {{SIZE}}{{UNIT}};',
            ],
        ]
    );
    $element->add_responsive_control(
        'rotate',
        [
            'label' => esc_html__ ('Rotate', 'ogeko' ),
            'type' => Controls_Manager::SLIDER,
            'size_units' => [ 'deg' ],
            'default' => [
                'size' => 0,
                'unit' => 'deg',
            ],
            'tablet_default' => [
                'unit' => 'deg',
            ],
            'mobile_default' => [
                'unit' => 'deg',
            ],
            'selectors' => [
                '{{WRAPPER}} .elementor-icon-list-icon' => 'transform: rotate({{SIZE}}{{UNIT}});',
            ],
        ]
    );

}, 10, 2 );
add_action( 'elementor/element/icon-list/section_text_style/before_section_end', function ( $element, $args ) {
    $element->add_control(
        'text_hover',
        [
            'label' => esc_html__( 'Hover style', 'ogeko' ),
            'type' => Controls_Manager::SWITCHER,
            'prefix_class' => 'hover-style-',
        ]
    );
}, 10, 2 );