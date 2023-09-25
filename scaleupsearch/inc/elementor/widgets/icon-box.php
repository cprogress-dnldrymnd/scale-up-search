<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Widget_Base;

/**
 * Elementor icon box widget.
 *
 * Elementor widget that displays an icon, a headline and a text.
 *
 * @since 1.0.0
 */
class Ogeko_Widget_Icon_Box extends Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve icon box widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'icon-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve icon box widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('Ogeko Icon Box', 'ogeko');
    }

    /**
     * Get widget icon.
     *
     * Retrieve icon box widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-icon-box';
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    /**
     * Register icon box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => __('Icon Box', 'ogeko'),
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'   => __('Choose Icon', 'ogeko'),
                'type'    => Controls_Manager::ICON,
                'default' => 'fa fa-star',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'        => __('View', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'default' => __('Default', 'ogeko'),
                    'stacked' => __('Stacked', 'ogeko'),
                    'framed'  => __('Framed', 'ogeko'),
                ],
                'default'      => 'default',
                'prefix_class' => 'elementor-view-',
                'condition'    => [
                    'icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'shape',
            [
                'label'        => __('Shape', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'circle'  => __('Circle', 'ogeko'),
                    'square'  => __('Square', 'ogeko'),
                    'hexagon' => __('Hexagon', 'ogeko'),
                ],
                'default'      => 'circle',
                'condition'    => [
                    'view!' => 'default',
                    'icon!' => '',
                ],
                'prefix_class' => 'elementor-shape-',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => __('Title, Sub Title & Description', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('This is the heading', 'ogeko'),
                'placeholder' => __('Enter your title', 'ogeko'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub_title_text',
            [
                'label'       => '',
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('', 'ogeko'),
                'placeholder' => __('Enter your sub title', 'ogeko'),
                'rows'        => 10,
                'separator'   => 'none',
                'show_label'  => false,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => '',
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => __('Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ogeko'),
                'placeholder' => __('Enter your description', 'ogeko'),
                'rows'        => 10,
                'separator'   => 'none',
                'show_label'  => false,
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => __('Link to', 'ogeko'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => __('https://your-link.com', 'ogeko'),
                'separator'   => 'before',
            ]
        );
        $this->add_control(
            'show_line',
            [
                'label' => __('Show Line', 'ogeko'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );
        $this->add_control(
            'link_download',
            [
                'label' => __('Donload Link ?', 'ogeko'),
                'type'  => Controls_Manager::SWITCHER,
            ]
        );

        $this->add_control(
            'icon_inside_title',
            [
                'label'         => __('Icon Inside title ?', 'ogeko'),
                'type'          => Controls_Manager::SWITCHER,
                'prefix_class'  => 'elementor-icon-inside-title-',
            ]
        );
        $this->add_control(
            'icon_inside',
            [
                'label'         => __('Icon Inside wrapper ?', 'ogeko'),
                'type'          => Controls_Manager::SWITCHER,
                'prefix_class'  => 'elementor-icon-inside-',
                'condition'     => [
                    'icon_inside_title!' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'position',
            [
                'label'        => __('Icon Position', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'default'      => 'top',
                'options'      => [
                    'left'  => [
                        'title' => __('Left', 'ogeko'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'top'   => [
                        'title' => __('Top', 'ogeko'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'ogeko'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                ],
                'prefix_class' => 'elementor%s-position-',
                'toggle'       => false,
                'condition'    => [
                    'icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label'   => __('Title HTML Tag', 'ogeko'),
                'type'    => Controls_Manager::SELECT,
                'options' => [
                    'h1'   => 'H1',
                    'h2'   => 'H2',
                    'h3'   => 'H3',
                    'h4'   => 'H4',
                    'h5'   => 'H5',
                    'h6'   => 'H6',
                    'div'  => 'div',
                    'span' => 'span',
                    'p'    => 'p',
                ],
                'default' => 'h3',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_icon',
            [
                'label'     => __('Icon', 'ogeko'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label'     => __('Primary Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked:not(:hover) .elementor-icon'                                                                => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed:not(:hover) .elementor-icon, {{WRAPPER}}.elementor-view-default:not(:hover) .elementor-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'secondary_color',
            [
                'label'     => __('Secondary Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed:not(:hover) .elementor-icon'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked:not(:hover) .elementor-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
            [
                'label'     => __('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 30,
                ],
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-position-right .elementor-icon-box-icon'          => 'margin-left: {{SIZE}}{{UNIT}};',
                    '(tablet) {{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                    '(mobile) {{WRAPPER}}.elementor-position-right .elementor-icon-box-icon' => 'margin-left: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.elementor-position-left .elementor-icon-box-icon'          => 'margin-right: {{SIZE}}{{UNIT}};',
                    '(tablet) {{WRAPPER}}.elementor-position-left .elementor-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '(mobile) {{WRAPPER}}.elementor-position-left .elementor-icon-box-icon' => 'margin-right: {{SIZE}}{{UNIT}};',

                    '{{WRAPPER}}.elementor-position-top .elementor-icon-box-icon'          => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(tablet) {{WRAPPER}}.elementor-position-top .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile) {{WRAPPER}}.elementor-position-top .elementor-icon-box-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                    '(mobile) {{WRAPPER}} .elementor-icon-box-icon'                        => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __('Size', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 30,
                ],
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'rotate',
            [
                'label'     => __('Rotate', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0,
                    'unit' => 'deg',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon i' => 'transform: rotate({{SIZE}}{{UNIT}});',
                ],
            ]
        );

        $this->add_control(
            'border_width',
            [
                'label'     => __('Border Width', 'ogeko'),
                'type'      => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition' => [
                    'view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'border_color',
            [
                'label'     => __('Border Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}:not(:hover) .elementor-icon' => 'border-color: {{VALUE}};',
                ],
                'condition' => [
                    'view' => 'framed',
                ],
            ]
        );

        $this->add_control(
            'border_radius',
            [
                'label'      => __('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'condition'  => [
                    'view!' => 'default',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'icon_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-icon',
            ]
        );

        $this->add_responsive_control(
            'icon_padding',
            [
                'label'      => __('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_hover',
            [
                'label'     => __('Icon Hover', 'ogeko'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'icon!' => '',
                ],
            ]
        );

        $this->add_control(
            'hover_primary_color',
            [
                'label'     => __('Primary Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon'                                                          => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed:hover .elementor-icon, {{WRAPPER}}.elementor-view-default:hover .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_secondary_color',
            [
                'label'     => __('Secondary Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'condition' => [
                    'view!' => 'default',
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-framed:hover .elementor-icon'  => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-stacked:hover .elementor-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => __('Hover Animation', 'ogeko'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => __('Alignment', 'ogeko'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'    => [
                        'title' => __('Left', 'ogeko'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => __('Center', 'ogeko'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => __('Right', 'ogeko'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => __('Justified', 'ogeko'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_vertical_alignment',
            [
                'label'        => __('Vertical Alignment', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'options'      => [
                    'top'    => __('Top', 'ogeko'),
                    'middle' => __('Middle', 'ogeko'),
                    'bottom' => __('Bottom', 'ogeko'),
                ],
                'default'      => 'top',
                'prefix_class' => 'elementor-vertical-align-',
            ]
        );

        $this->add_control(
            'heading_line',
            [
                'label'     => __('Line', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'show_line' => 'yes'
                ]
            ]
        );
        $this->add_control(
            'line_color',
            [
                'label'     => __('Line Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper .elementor-icon-box-line' => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'show_line' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'line_space',
            [
                'label'     => __('Spacing Line', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => -100,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper .elementor-icon-box-line' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_line' => 'yes'
                ]
            ]
        );

        $this->add_responsive_control(
            'line_width',
            [
                'label'     => __('Spacing width', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 1,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-wrapper .elementor-icon-box-line' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'show_line' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label'     => __('Title', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
            [
                'label'     => __('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-header' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => __('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-box:not(:hover) .elementor-icon-box-content .elementor-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => __('Hover Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-box:hover .elementor-icon-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-title',
            ]
        );

        $this->add_control(
            'heading_subtitle',
            [
                'label'     => __('Sub Title', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'subtitle_bottom_space',
            [
                'label'     => __('Spacing', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-subtitle' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label'     => __('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color_hover',
            [
                'label'     => __('Hover Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-box:hover .elementor-icon-box-subtitle' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-subtitle',
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label'     => __('Description', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => __('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'description_color_hover',
            [
                'label'     => __('Hover Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-icon-box:hover .elementor-icon-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-icon-box-content .elementor-icon-box-description',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_render_attribute('icon', 'class', [
            'elementor-icon',
            'elementor-animation-' . $settings['hover_animation']
        ]);
        $icon_tag = 'span';
        $has_icon = !empty($settings['icon']);

        if (!empty($settings['link']['url'])) {
            $this->add_render_attribute('link', 'href', $settings['link']['url']);
            $icon_tag = 'a';

            if ($settings['link']['is_external']) {
                $this->add_render_attribute('link', 'target', '_blank');
            }

            if ($settings['link']['nofollow']) {
                $this->add_render_attribute('link', 'rel', 'nofollow');
            }

            if ($settings['link_download'] === 'yes') {
                $this->add_render_attribute('link', 'download');
            }
        }

        if ($has_icon) {
            $this->add_render_attribute('i', 'class', $settings['icon']);
            $this->add_render_attribute('i', 'aria-hidden', 'true');
        }

        $this->add_render_attribute('description_text', 'class', 'elementor-icon-box-description');
        $this->add_render_attribute('sub_title_text', 'class', 'elementor-icon-box-subtitle');
        $this->add_render_attribute('title_text', 'class', 'elementor-icon-box-subtitle');

        $this->add_inline_editing_attributes('description_text');
        ?>
        <div class="elementor-icon-box-wrapper">
            <?php if ($has_icon && !$settings['icon_inside_title']) : ?>
                <div class="elementor-icon-box-icon">
                    <<?php Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'icon' ); ?> <?php $this->print_render_attribute_string( 'link' ); ?>>
                        <i <?php $this->print_render_attribute_string( 'i' ); ?>></i>
                    </<?php Utils::print_validated_html_tag( $icon_tag ); ?>>
                </div>
            <?php endif; ?>

            <div class="elementor-icon-box-content">
                <div class="elementor-icon-header">
                    <?php if ($has_icon && $settings['icon_inside_title']) : ?>
                        <div class="elementor-icon-box-icon">
                            <<?php Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'icon' ); ?> <?php $this->print_render_attribute_string( 'link' ); ?>>
                            <i <?php $this->print_render_attribute_string( 'i' ); ?>></i>
                        </<?php Utils::print_validated_html_tag( $icon_tag ); ?>>
                        </div>
                    <?php endif; ?>
                    <div class="elementor-icon-header-inner">
                        <?php if ( ! Utils::is_empty( $settings['sub_title_text'] ) ) : ?>
                            <span <?php $this->print_render_attribute_string( 'sub_title_text' ); ?>>
                             <?php $this->print_render_attribute_string( 'sub_title_text' ); ?>
                            </span>
                        <?php endif; ?>


                        <<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?> class="elementor-icon-box-title">
                            <<?php Utils::print_validated_html_tag( $icon_tag ); ?> <?php $this->print_render_attribute_string( 'link' ); ?> <?php $this->print_render_attribute_string( 'title_text' ); ?>>
                                <?php $this->print_unescaped_setting( 'title_text' ); ?>
                            </<?php Utils::print_validated_html_tag( $icon_tag ); ?>>
                        </<?php Utils::print_validated_html_tag( $settings['title_size'] ); ?>>
                    </div>
                </div>
                <?php if ( ! Utils::is_empty( $settings['description_text'] ) ) : ?>
                    <p <?php $this->print_render_attribute_string( 'description_text' ); ?>>
                        <?php $this->print_unescaped_setting( 'description_text' ); ?>
                    </p>
                <?php endif; ?>
            </div>
            <?php if (!empty($settings['show_line'])) : ?>
                <span class="elementor-icon-box-line"></span>
            <?php endif; ?>
        </div>
        <?php
    }

    /**
     * Render icon box widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function content_template() {
        ?>
        <#
        var link = settings.link.url ? 'href="' + settings.link.url + '"' : '',
        iconTag = link ? 'a' : 'span';

        view.addRenderAttribute( 'description_text', 'class', 'elementor-icon-box-description' );

        view.addInlineEditingAttributes( 'title_text', 'none' );
        view.addInlineEditingAttributes( 'description_text' );
        #>
        <div class="elementor-icon-box-wrapper">
            <# if ( settings.icon && !settings.icon_inside_title ) { #>
                <div class="elementor-icon-box-icon">
                    <{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
                        <i class="{{ settings.icon }}" aria-hidden="true"></i>
                    </{{{ iconTag }}}>
                </div>
            <# } #>
            <div class="elementor-icon-box-content">
                <div class="elementor-icon-header">
                    <# if ( settings.icon && settings.icon_inside_title ) { #>
                        <div class="elementor-icon-box-icon">
                            <{{{ iconTag + ' ' + link }}} class="elementor-icon elementor-animation-{{ settings.hover_animation }}">
                                <i class="{{ settings.icon }}" aria-hidden="true"></i>
                            </{{ iconTag }}}>
                        </div>
                    <# } #>
                <div class="elementor-icon-header-inner">
                    <span {{{ view.getRenderAttributeString( 'sub_title_text' ) }}}>{{{ settings.sub_title_text }}}</span>
                    <{{{ settings.title_size }}} class="elementor-icon-box-title">
                        <{{{ iconTag + ' ' + link }}}>
                            {{{ settings.title_text }}}
                        </{{{ iconTag }}}>
                    </{{{ settings.title_size }}}>
                </div>
            </div>
            <# if ( settings.description_text ) { #>
                <p {{{ view.getRenderAttributeString( 'description_text' ) }}}>{{{ settings.description_text }}}</p>
            <# } #>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new Ogeko_Widget_Icon_Box());