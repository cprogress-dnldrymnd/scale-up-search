<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

class Ogeko_Elementor_Progress_Bar extends Elementor\Widget_Base {


    public function get_name() {
        return 'ogeko-progress-bar';
    }

    public function get_title() {
        return esc_html__('Ogeko Progress Bar', 'ogeko');
    }

    public function get_categories() {
        return ['opal-addons'];
    }

    public function get_script_depends() {
        return ['ogeko-elementor-progress-bar'];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'value_progress',
            [
                'label' => esc_html__('Progress', 'ogeko'),
            ]
        );

        $this->add_control(
            'percent',
            [
                'label'   => esc_html__('Percentage', 'ogeko'),
                'type'    => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 50,
                    'unit' => '%',
                ],
            ]
        );

        $this->add_control(
            'size',
            [
                'label'     => esc_html__('Size', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 300,
                    ],
                ],
                'default'   => [
                    'size' => 80,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .circlechart' => 'width: {{size}}{{unit}}; height: {{size}}{{unit}}; flex: 0 0 {{size}}{{unit}}',
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => esc_html__('Description', 'ogeko'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => esc_html__('Lorem ipsum dolor sit amet consectetur adipiscing elit dolor', 'ogeko'),
                'placeholder' => esc_html__('Enter your description', 'ogeko'),
                'separator'   => 'none',
                'rows'        => 5,
                'show_label'  => false,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'value_progress_style',
            [
                'label' => esc_html__('Progress', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_control(
            'progress_background',
            [
                'label'     => esc_html__('Progress Background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .circle-chart__background' => 'stroke: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'progress_color',
            [
                'label'     => esc_html__('Color Progress', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .danger-stroke' => 'stroke: {{VALUE}}',
                ],
            ]
        );


        $this->add_control(
            'progress_color_text',
            [
                'label'     => esc_html__('Progress Text', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-progress-bar .text' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'progress_text',
                'selector' => '{{WRAPPER}} .circle-chart__percent',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'value_description_style',
            [
                'label' => esc_html__('Description', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Color Description', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .description' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'description_typography',
                'selector'  => '{{WRAPPER}} .description',
                'condition' => [
                    'description!' => '',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings            = $this->get_settings_for_display();
        $progress_percentage = is_numeric($settings['percent']['size']) ? $settings['percent']['size'] : '0';
        ?>
        <div class="circle-wrap">
            <div class="circlechart" data-percentage="-<?php echo esc_attr($progress_percentage) ?>"></div>
            <div class="description">
                <?php $this->print_unescaped_setting('description'); ?>
            </div>
        </div>
        <?php
    }

}

$widgets_manager->register(new Ogeko_Elementor_Progress_Bar());
