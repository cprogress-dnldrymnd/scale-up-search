<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Css_Filter;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Control_Media;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Ogeko_Image_Box extends Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * Retrieve image box widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'image-box';
    }

    /**
     * Get widget title.
     *
     * Retrieve image box widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Ogeko Image Box', 'ogeko');
    }

    /**
     * Get widget icon.
     *
     * Retrieve image box widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-image-box';
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
        return ['image', 'photo', 'visual', 'box'];
    }

    /**
     * Register image box widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_image',
            [
                'label' => esc_html__('Image Box', 'ogeko'),
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => esc_html__('Choose Image', 'ogeko'),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

        $this->add_control(
            'title_text',
            [
                'label'       => esc_html__('Title Heading', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the heading', 'ogeko'),
                'placeholder' => esc_html__('Enter your title', 'ogeko'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => esc_html__('Sub title', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('This is the sub title', 'ogeko'),
                'placeholder' => esc_html__('Enter your sub title', 'ogeko'),
                'label_block' => true,
            ]
        );
        $this->add_control(
            'sub_title_position',
            [
                'label'        => __('Position Sub Title', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'below',
                'options'      => [
                    'above' => __('Above', 'ogeko'),
                    'below' => __('Below', 'ogeko'),
                ],
                'prefix_class' => 'elementor-position-',
            ]
        );

        $this->add_control(
            'description_text',
            [
                'label'       => esc_html__('Content', 'ogeko'),
                'type'        => Controls_Manager::TEXTAREA,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ogeko'),
                'placeholder' => esc_html__('Enter your description', 'ogeko'),
                'separator'   => 'none',
                'rows'        => 10,
                'show_label'  => false,
            ]
        );

        $this->add_control(
            'link',
            [
                'label'       => esc_html__('Link', 'ogeko'),
                'type'        => Controls_Manager::URL,
                'dynamic'     => [
                    'active' => true,
                ],
                'default'     => [
                    'url' => '#',
                ],
                'placeholder' => esc_html__('https://your-link.com', 'ogeko'),
                'separator'   => 'before',
            ]
        );

        $this->add_control(
            'image_button_text',
            [
                'label'   => esc_html__('Button Text', 'ogeko'),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => esc_html__('Click Here', 'ogeko'),
            ]
        );

        $this->add_control(
            'title_size',
            [
                'label'     => esc_html__('Title HTML Tag', 'ogeko'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
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
                'default'   => 'h3',
                'separator' => 'before',
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
            'section_style_wrapper',
            [
                'label' => esc_html__('Wrapper', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_wrapper_border_radius',
            [
                'label'      => __('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}}' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_wrapper_background_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}'              => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_image',
            [
                'label' => esc_html__('Image', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'image_space',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}!important',
                ]
            ]
        );

        $this->add_responsive_control(
            'image_size',
            [
                'label'          => esc_html__('Width', 'ogeko') . ' (%)',
                'type'           => Controls_Manager::SLIDER,
                'default'        => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units'     => ['%'],
                'range'          => [
                    '%' => [
                        'min' => 15,
                        'max' => 100,
                    ],
                ],
                'selectors'      => [
                    '{{WRAPPER}} .elementor-image-box-img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'image_effect_theme',
            [
                'label'        => esc_html__('Image Effects Theme', 'ogeko'),
                'type'         => Controls_Manager::SWITCHER,
                'prefix_class' => 'image-effects-',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .elementor-image-box-img img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-img img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hover_animation',
            [
                'label' => esc_html__('Hover Animation', 'ogeko'),
                'type'  => Controls_Manager::HOVER_ANIMATION,
            ]
        );

        $this->start_controls_tabs('image_effects');

        $this->start_controls_tab('normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters',
                'selector' => '{{WRAPPER}} .elementor-image-box-img img',
            ]
        );

        $this->add_control(
            'image_opacity',
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
                    '{{WRAPPER}} .elementor-image-box-img img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->add_control(
            'background_hover_transition',
            [
                'label'     => esc_html__('Transition Duration', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 0.3,
                ],
                'range'     => [
                    'px' => [
                        'max'  => 3,
                        'step' => 0.1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-img img' => 'transition-duration: {{SIZE}}s',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab('hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_group_control(
            Group_Control_Css_Filter::get_type(),
            [
                'name'     => 'css_filters_hover',
                'selector' => '{{WRAPPER}}:hover .elementor-image-box-img img',
            ]
        );

        $this->add_control(
            'image_opacity_hover',
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
                    '{{WRAPPER}}:hover .elementor-image-box-img img' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__('Content', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'text_align',
            [
                'label'     => esc_html__('Alignment', 'ogeko'),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
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
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-wrapper' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Content Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ]
            ]
        );

        $this->add_control(
            'content_background_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-content'  => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label'     => esc_html__('Title', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_bottom_space',
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
                    '{{WRAPPER}} .elementor-image-box-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label'     => esc_html__('Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-image-box-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-image-box-title',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_shadow',
                'selector' => '{{WRAPPER}} .elementor-image-box-title',
            ]
        );

        $this->add_control(
            'sub_title_lable',
            [
                'label'     => esc_html__('Sub Title', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'sub_title_bottom_space',
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
                    '{{WRAPPER}} .elementor-image-box-sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'sub_title_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-sub-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'sub_title_typography',
                'selector' => '{{WRAPPER}} .elementor-image-box-sub-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'sub_title_shadow',
                'selector' => '{{WRAPPER}} .elementor-image-box-sub-title',
            ]
        );

        $this->add_control(
            'heading_description',
            [
                'label'     => esc_html__('Description', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'description_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'description_typography',
                'selector' => '{{WRAPPER}} .elementor-image-box-description',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'description_shadow',
                'selector' => '{{WRAPPER}} .elementor-image-box-description',
            ]
        );

        $this->add_control(
            'button_lable',
            [
                'label'     => esc_html__('Button', 'ogeko'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'button_typography',
                'selector' => '{{WRAPPER}} .elementor-cta__button',
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-image-box-button-wrapper a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}',
                ],
            ]
        );

        $this->start_controls_tabs('button_tabs');

        $this->start_controls_tab('button_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-button-wrapper a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_border_color',
            [
                'label'     => esc_html__('Border Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-button-wrapper a' => 'border-color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'button-hover',
            [
                'label' => esc_html__('Hover', 'ogeko'),
            ]
        );

        $this->add_control(
            'button_hover_text_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-image-box-button' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-image-box-button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_background_color',
            [
                'label'     => esc_html__('Background Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}:hover .elementor-image-box-button-wrapper a' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-image-box-button-wrapper a:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label'     => esc_html__('Border Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-image-box-button-wrapper:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();


        $this->end_controls_section();
    }

    public static function render_icon($icon, $attributes = [], $tag = 'i') {
        if (empty($icon['library'])) {
            return false;
        }

        $output = '';

        /**
         * When the library value is svg it means that it's a SVG media attachment uploaded by the user.
         * Otherwise, it's the name of the font family that the icon belongs to.
         */
        if ('svg' === $icon['library']) {
            $output = \Elementor\Icons_Manager::render_uploaded_svg_icon($icon['value']);
        } else {
            $output = \Elementor\Icons_Manager::render_font_icon($icon, $attributes, $tag);
        }

        return $output;

    }

    /**
     * Render image box widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();

        $has_content = !Utils::is_empty($settings['title_text']) || !Utils::is_empty($settings['sub_title']) || !Utils::is_empty($settings['description_text']);

        $html = '<div class="elementor-image-box-wrapper">';

        if (!empty($settings['link']['url'])) {
            $this->add_link_attributes('link', $settings['link']);
        }

        if (!empty($settings['image']['url'])) {
            $this->add_render_attribute('image', 'src', $settings['image']['url']);
            $this->add_render_attribute('image', 'alt', Control_Media::get_image_alt($settings['image']));
            $this->add_render_attribute('image', 'title', Control_Media::get_image_title($settings['image']));

            if ($settings['hover_animation']) {
                $this->add_render_attribute('image', 'class', 'elementor-animation-' . $settings['hover_animation']);
            }

            $image_html = wp_kses_post(Group_Control_Image_Size::get_attachment_image_html($settings, 'thumbnail', 'image'));

            if (!empty($settings['link']['url'])) {
                $image_html = '<a ' . $this->get_render_attribute_string('link') . '>' . $image_html . '</a>';
            }

            $html .= '<figure class="elementor-image-box-img">' . $image_html . '</figure>';
        }
        if ($has_content) {
            $html .= '<div class="elementor-image-box-content">';

            if (!Utils::is_empty($settings['title_text'])) {
                $this->add_render_attribute('title_text', 'class', 'elementor-image-box-title');

                $this->add_inline_editing_attributes('title_text', 'none');

                $title_html = $settings['title_text'];

                if (!empty($settings['link']['url'])) {
                    $title_html = '<a ' . $this->get_render_attribute_string('link') . '>' . $title_html . '</a>';
                }

                $html .= sprintf('<%1$s %2$s>%3$s</%1$s>', Utils::validate_html_tag($settings['title_size']), $this->get_render_attribute_string('title_text'), $title_html);
            }

            if (!Utils::is_empty($settings['sub_title'])) {
                $this->add_render_attribute('sub_title', 'class', 'elementor-image-box-sub-title');

                $this->add_inline_editing_attributes('sub_title', 'none');

                $title_html = $settings['sub_title'];
                $html       .= sprintf('<div %1$s>%2$s</div>', $this->get_render_attribute_string('sub_title'), $settings['sub_title']);
            }

            if (!Utils::is_empty($settings['description_text'])) {
                $this->add_render_attribute('description_text', 'class', 'elementor-image-box-description');

                $this->add_inline_editing_attributes('description_text');

                $html .= sprintf('<p %1$s>%2$s</p>', $this->get_render_attribute_string('description_text'), $settings['description_text']);
            }


            if (!empty($settings['link']['url']) && $settings['image_button_text']) {
                $this->add_link_attributes('link_button', $settings['link']);
                $this->add_render_attribute('link_button', 'class', 'elementor-image-box-button');
                $html .= sprintf('<div class="elementor-image-box-button-wrapper">
                        <a %1$s> 
                        <i aria-hidden="true" class="icon-before left ogeko-icon-arrow-right"></i> 
                        <span class="elementor-image-box-button-text"> %2$s</span>
                        <i aria-hidden="true" class="icon-before right ogeko-icon-arrow-right"></i>
                        </a>
                        </div>',
                    $this->get_render_attribute_string('link_button'),
                    $settings['image_button_text']);
            }

            $html .= '</div>';
        }

        $html .= '</div>';

        Utils::print_unescaped_internal_string($html);
    }
}

$widgets_manager->register(new Ogeko_Image_Box());
