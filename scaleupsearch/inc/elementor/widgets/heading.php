<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Elementor\Utils;


class Ogeko_Elementor_Heading extends Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve heading widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'ogeko-heading';
    }

    /**
     * Get widget title.
     *
     * Retrieve heading widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Ogeko Heading', 'ogeko');
    }

    /**
     * Get widget icon.
     *
     * Retrieve heading widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-t-letter';
    }

    /**
     * Get widget categories.
     *
     * Retrieve the list of categories the heading widget belongs to.
     *
     * Used to determine where to display the widget in the editor.
     *
     * @return array Widget categories.
     * @since 2.0.0
     * @access public
     *
     */
    public function get_categories() {
        return ['basic'];
    }

    /**
     * Get widget keywords.
     *
     * Retrieve the list of keywords the widget belongs to.
     *
     * @return array Widget keywords.
     * @since 2.1.0
     * @access public
     *
     */
    public function get_keywords() {
        return ['heading', 'title', 'text'];
    }

    /**
     * Register heading widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'ogeko'),
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => esc_html__('Title', 'ogeko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your title', 'ogeko'),
                'default'     => esc_html__('Add Your Heading Text Here', 'ogeko'),
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => esc_html__('Sub Title', 'ogeko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('Enter your subtitle', 'ogeko'),
                'default'     => esc_html__('Add Your Sub Title Text Here', 'ogeko'),
            ]
        );


        $this->add_control(
            'sub_title_position',
            [
                'label'        => __('Position', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'below',
                'options'      => [
                    'above' => __('Above', 'ogeko'),
                    'below' => __('Below', 'ogeko'),
                ],
                'prefix_class' => 'subtitle-position-',
            ]
        );

        $this->add_control(
            'heading_theme_style',
            [
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'label'        => __('Theme style', 'ogeko'),
                'default'      => '',
                'prefix_class' => 'heading-theme-style-',
            ]
        );


        $this->add_control(
            'link',
            [
                'label'     => esc_html__('Link', 'ogeko'),
                'type'      => Controls_Manager::URL,
                'dynamic'   => [
                    'active' => true,
                ],
                'default'   => [
                    'url' => '',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'size',
            [
                'label'   => esc_html__('Size', 'ogeko'),
                'type'    => Controls_Manager::SELECT,
                'default' => 'default',
                'options' => [
                    'default' => esc_html__('Default', 'ogeko'),
                    'small'   => esc_html__('Small', 'ogeko'),
                    'medium'  => esc_html__('Medium', 'ogeko'),
                    'large'   => esc_html__('Large', 'ogeko'),
                    'xl'      => esc_html__('XL', 'ogeko'),
                    'xxl'     => esc_html__('XXL', 'ogeko'),
                ],
            ]
        );

        $this->add_control(
            'header_size',
            [
                'label'   => esc_html__('HTML Tag', 'ogeko'),
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
                'default' => 'h2',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'        => esc_html__('Alignment', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
                    'left'    => [
                        'title' => esc_html__('Left', 'ogeko'),
                        'icon'  => 'eicon-text-align-left',
                    ],
                    'center'  => [
                        'title' => esc_html__('Center', 'ogeko'),
                        'icon'  => 'eicon-text-align-center',
                    ],
                    'right'   => [
                        'title' => esc_html__('Right', 'ogeko'),
                        'icon'  => 'eicon-text-align-right',
                    ],
                    'justify' => [
                        'title' => esc_html__('Justified', 'ogeko'),
                        'icon'  => 'eicon-text-align-justify',
                    ],
                ],
                'default'      => '',
                'selectors'    => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
                'prefix_class' => 'elementor%s-align-',
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => esc_html__('View', 'ogeko'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Title', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title'   => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_SECONDARY,
                ],
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'text_stroke',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'text_shadow',
                'selector' => '{{WRAPPER}} .elementor-heading-title',
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label'     => esc_html__('Blend Mode', 'ogeko'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''            => esc_html__('Normal', 'ogeko'),
                    'multiply'    => 'Multiply',
                    'screen'      => 'Screen',
                    'overlay'     => 'Overlay',
                    'darken'      => 'Darken',
                    'lighten'     => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation'  => 'Saturation',
                    'color'       => 'Color',
                    'difference'  => 'Difference',
                    'exclusion'   => 'Exclusion',
                    'hue'         => 'Hue',
                    'luminosity'  => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-heading-title' => 'mix-blend-mode: {{VALUE}}',
                ],
                'separator' => 'none',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_sub_title_style',
            [
                'label' => __('Sub Title', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => __('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle_typography',
                'selector' => '{{WRAPPER}} .elementor-sub-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'label'    => __('Text shadow subtitle', 'ogeko'),
                'name'     => 'text_shadow_subtitle',
                'selector' => '{{WRAPPER}} .elementor-sub-title',
            ]
        );

        $this->add_responsive_control(
            'sub_title_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-sub-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'sub_title_spacing',
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
                    '{{WRAPPER}}.subtitle-position-below .elementor-sub-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}}.subtitle-position-above .elementor-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'background_color_rectangle',
            [
                'label'     => esc_html__('Background Color Rectangle ', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}}.heading-theme-style-yes .elementor-sub-title:before'   => 'background-color: {{VALUE}};',
                ],
                'condition' => [
                    'heading_theme_style' => 'yes'
                ],
                'separator'    => 'before'
            ]
        );

        $this->add_responsive_control(
            'rectangle_width',
            [
                'label'     => esc_html__('Rectangle Width', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.heading-theme-style-yes .elementor-sub-title:before' => 'width: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'heading_theme_style' => 'yes'
                ],
            ]
        );
        $this->add_responsive_control(
            'rectangle_height',
            [
                'label'     => esc_html__('Rectangle Height', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.heading-theme-style-yes .elementor-sub-title:before' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render heading widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */

    protected function render() {
        $settings = $this->get_settings_for_display();


        $this->add_render_attribute('title', 'class', 'elementor-heading-title');

        if (!empty($settings['size'])) {
            $this->add_render_attribute('title', 'class', 'elementor-size-' . $settings['size']);
        }

        $this->add_inline_editing_attributes('title');

        $title = $settings['title'];

        $title_html = '';

        $title_html .= '<div class="elementor-heading-wrapper-inner">';

            if($title) {
                if (!empty($settings['link']['url'])) {
                    $this->add_render_attribute('url', 'href', $settings['link']['url']);

                    if ($settings['link']['is_external']) {
                        $this->add_render_attribute('url', 'target', '_blank');
                    }

                    if (!empty($settings['link']['nofollow'])) {
                        $this->add_render_attribute('url', 'rel', 'nofollow');
                    }

                    $title = sprintf('<a %1$s>%2$s</a>', $this->get_render_attribute_string('url'), $title);
                }

                $title_html .= sprintf('<%1$s %2$s>%3$s</%1$s>', $settings['header_size'], $this->get_render_attribute_string('title'), $title);
            }

            if ($settings['sub_title']) {
                $title_html .= '<div class="elementor-sub-title">' . $settings['sub_title'] . '</div>';
            }

        $title_html .= '</div>';

        echo wp_kses_post($title_html);
    }
}

$widgets_manager->register(new Ogeko_Elementor_Heading());