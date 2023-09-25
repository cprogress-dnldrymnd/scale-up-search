<?php

use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;

class Ogeko_Video_Popup extends Elementor\Widget_Base {

    public function get_name() {
        return 'ogeko-video-popup';
    }

    public function get_title() {
        return esc_html__('Ogeko Video Popup', 'ogeko');
    }

    public function get_icon() {
        return 'eicon-youtube';
    }

    public function get_script_depends() {
        return ['ogeko-elementor-video', 'magnific-popup'];
    }

    public function get_style_depends() {
        return ['magnific-popup'];
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_videos',
            [
                'label' => esc_html__('General', 'ogeko'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'video_link',
            [
                'label'       => esc_html__('Link to', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'description' => esc_html__('Support video from Youtube and Vimeo', 'ogeko'),
                'placeholder' => esc_html__('https://your-link.com', 'ogeko'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__('Tile', 'ogeko'),
                'default'     => '',
            ]
        );

        $this->add_responsive_control(
            'video_align',
            [
                'label'     => esc_html__('Alignment', 'ogeko'),
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
                    '{{WRAPPER}} .elementor-video-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_font',
            [
                'label'       => esc_html__('Icon Font', 'ogeko'),
                'type'        => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon',
                'default' => [
                    'value' => 'ogeko-icon-play-circle',
                    'library' => 'ogeko-icon',
                ],
            ]
        );

        $this->end_controls_section();

        //Wrapper
        $this->start_controls_section(
            'section_video_wrapper',
            [
                'label' => esc_html__('Wrapper', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->start_controls_tabs('tabs_wrapper_style');

        $this->start_controls_tab(
            'tab_wrapper_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'background_wrapper',
            [
                'label'     => esc_html__('Background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_wrapper_hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_control(
            'background_wrapper_hover',
            [
                'label'     => esc_html__('Background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'border_wrapper_hover',
            [
                'label'     => esc_html__('Border Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(

            Group_Control_Border::get_type(),
            [
                'name'        => 'border_wrapper',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-video-popup',
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'wrapper_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'wrapper_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .elementor-video-popup' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //Icon
        $this->start_controls_section(
            'section_video_style',
            [
                'label' => esc_html__('Icon', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'video_size',
            [
                'label'     => esc_html__('Font Size', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup .elementor-video-icon i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_width',
            [
                'label'     => esc_html__('Width', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-icon' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'video_height',
            [
                'label'     => esc_html__('Height', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-icon' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->start_controls_tabs('tabs_video_style');

        $this->start_controls_tab(
            'tab_video_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'video_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup .elementor-video-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_background_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup .elementor-video-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_video_hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_control(
            'video_hover_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup :hover .elementor-video-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'video_hover_background_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup :hover .elementor-video-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'video_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup :hover .elementor-video-icon' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'video_hover_box_shadow',
                'selector' => '{{WRAPPER}} .ogeko-video-popup :hover .elementor-video-icon',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'        => 'border_video',
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .elementor-video-popup:before',
                'separator'   => 'before',
            ]
        );


        $this->add_control(
            'video_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-video-popup:before' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'video_box_shadow',
                'selector' => '{{WRAPPER}} .ogeko-video-popup .elementor-video-icon',
            ]
        );

        $this->add_responsive_control(
            'video_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ogeko-video-popup .elementor-video-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'video_margin',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .ogeko-video-popup .elementor-video-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //title
        $this->start_controls_section(
            'section_video_title',
            [
                'label' => esc_html__('Title', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_hover_color',
            [
                'label'     => esc_html__('Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-video-popup:hover .elementor-video-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .ogeko-video-popup .elementor-video-title',
            ]
        );

        $this->add_control(
            'show_title_block',
            [
                'label'     => esc_html__('Style Block', 'ogeko'),
                'type'      => Controls_Manager::SWITCHER,
                'label_off' => esc_html__('Off', 'ogeko'),
                'label_on'  => esc_html__('On', 'ogeko'),
                'selectors' => [
                    '{{WRAPPER}} .ogeko-video-popup .elementor-video-popup' => 'flex-direction: column;',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        if (empty($settings['video_link'])) {
            return;
        }

        $this->add_render_attribute('wrapper', 'class', 'elementor-video-wrapper');
        $this->add_render_attribute('wrapper', 'class', 'ogeko-video-popup');

        $this->add_render_attribute('button', 'class', 'elementor-video-popup');
        $this->add_render_attribute('button', 'role', 'button');
        $this->add_render_attribute('button', 'href', esc_url($settings['video_link']));
        $this->add_render_attribute('button', 'data-effect', 'mfp-zoom-in');

        $titleHtml = !empty($settings['title']) ? '<span class="elementor-video-title">' . $settings['title'] . '</span>' : '';

        ?>
        <div <?php echo ogeko_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <a <?php echo ogeko_elementor_get_render_attribute_string('button', $this); ?>>
                <span class="elementor-video-icon"><?php Icons_Manager::render_icon( $settings['icon_font'], [ 'aria-hidden' => 'true' ] ); ?></span>
                <?php printf('%s', $titleHtml); ?>
            </a>
        </div>
        <?php
    }

}

$widgets_manager->register(new Ogeko_Video_Popup());
