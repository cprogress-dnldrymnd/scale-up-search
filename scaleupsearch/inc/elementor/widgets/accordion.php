<?php
namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;

/**
 * Elementor accordion widget.
 *
 * Elementor widget that displays a collapsible display of content in an
 * accordion style, showing only one item at a time.
 *
 * @since 1.0.0
 */
class Ogeko_Elementor_Accordion extends Widget_Base {


    /**
     * Get widget name.
     *
     * Retrieve accordion widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name() {
        return 'accordion';
    }

    /**
     * Get widget title.
     *
     * Retrieve accordion widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title() {
        return esc_html__('Ogeko Accordion', 'ogeko');
    }

    /**
     * Get widget icon.
     *
     * Retrieve accordion widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_script_depends() {
        return ['ogeko-elementor-accordion', 'slick'];
    }

    public function get_categories() {
        return array('ogeko-addons');
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
        return ['accordion', 'tabs', 'toggle'];
    }

    /**
     * Register accordion widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 3.1.0
     * @access protected
     */
    protected function register_controls() {
        $templates = Plugin::instance()->templates_manager->get_source('local')->get_items();

        $options = [
            '0' => '— ' . esc_html__('Select', 'ogeko') . ' —',
        ];

        $types = [];

        foreach ($templates as $template) {
            $options[$template['template_id']] = $template['title'] . ' (' . $template['type'] . ')';
            $types[$template['template_id']] = $template['type'];
        }

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Accordion', 'ogeko'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label'       => esc_html__('Title & Description', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'default'     => esc_html__('Accordion Title', 'ogeko'),
                'dynamic'     => [
                    'active' => true,
                ],
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'source',
            [
                'label' => esc_html__('Source', 'ogeko'),
                'type' => Controls_Manager::SELECT,
                'default' => 'html',
                'options' => [
                    'html' => esc_html__('HTML', 'ogeko'),
                    'template' => esc_html__('Template', 'ogeko')
                ]
            ]
        );

        $repeater->add_control(
            'tab_template',
            [
                'label' => esc_html__('Choose Template', 'ogeko'),
                'default' => 0,
                'type' => Controls_Manager::SELECT,
                'options' => $options,
                'types' => $types,
                'label_block' => 'true',
                'condition' => [
                    'source' => 'template',
                ],
            ]
        );

        $repeater->add_control(
            'tab_content',
            [
                'label'      => esc_html__('Content', 'ogeko'),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => esc_html__('Accordion Content', 'ogeko'),
                'show_label' => false,
                'condition' => [
                    'source' => 'html',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label'       => esc_html__('Accordion Items', 'ogeko'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'default'     => [
                    [
                        'tab_title'   => esc_html__('Accordion #1', 'ogeko'),
                        'tab_content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ogeko'),
                    ],
                    [
                        'tab_title'   => esc_html__('Accordion #2', 'ogeko'),
                        'tab_content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ogeko'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
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

        $this->add_control(
            'selected_icon',
            [
                'label'            => esc_html__('Icon', 'ogeko'),
                'type'             => Controls_Manager::ICONS,
                'separator'        => 'before',
                'fa4compatibility' => 'icon',
                'default'          => [
                    'value'   => 'fas fa-plus',
                    'library' => 'fa-solid',
                ],
                'recommended'      => [
                    'fa-solid'   => [
                        'chevron-down',
                        'angle-down',
                        'angle-double-down',
                        'caret-down',
                        'caret-square-down',
                    ],
                    'fa-regular' => [
                        'caret-square-down',
                    ],
                ],
                'skin'             => 'inline',
                'label_block'      => false,
            ]
        );

        $this->add_control(
            'selected_active_icon',
            [
                'label'            => esc_html__('Active Icon', 'ogeko'),
                'type'             => Controls_Manager::ICONS,
                'fa4compatibility' => 'icon_active',
                'default'          => [
                    'value'   => 'fas fa-minus',
                    'library' => 'fa-solid',
                ],
                'recommended'      => [
                    'fa-solid'   => [
                        'chevron-up',
                        'angle-up',
                        'angle-double-up',
                        'caret-up',
                        'caret-square-up',
                    ],
                    'fa-regular' => [
                        'caret-square-up',
                    ],
                ],
                'skin'             => 'inline',
                'label_block'      => false,
                'condition'        => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'title_html_tag',
            [
                'label'     => esc_html__('Title HTML Tag', 'ogeko'),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    'h1'  => 'H1',
                    'h2'  => 'H2',
                    'h3'  => 'H3',
                    'h4'  => 'H4',
                    'h5'  => 'H5',
                    'h6'  => 'H6',
                    'div' => 'div',
                ],
                'default'   => 'div',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'faq_schema',
            [
                'label'     => esc_html__('FAQ Schema', 'ogeko'),
                'type'      => Controls_Manager::SWITCHER,
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title_style',
            [
                'label' => esc_html__('Accordion', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'accordion_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-accordion-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->start_controls_tabs('tabs_carousel_dots_style');

        $this->start_controls_tab(
            'tab_title_color_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_responsive_control(
            'accordion_margin',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-accordion-item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'accordion_background',
            [
                'label'     => __('Background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-accordion-item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'accordion_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-accordion-item',
            ]
        );

        $this->add_control(
            'accordion_border_radius',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-accordion-item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'accordion_box_shadow',
                'selector' => '{{WRAPPER}} .elementor-accordion-item',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_color_active',
            [
                'label' => esc_html__('Active', 'ogeko'),
            ]
        );

        $this->add_responsive_control(
            'accordion_margin_active',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-accordion-item:not(:first-child).active' => 'margin-top: {{TOP}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-accordion-item.active'                   => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'accordion_border_active',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-accordion-item.active',
            ]
        );

        $this->add_control(
            'accordion_background_active',
            [
                'label'     => __('Background Active', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-accordion-item.active' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accordion_border_radius_active',
            [
                'label'      => esc_html__('Border Radius', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-accordion-item.active' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'     => 'accordion_box_shadow_active',
                'selector' => '{{WRAPPER}} .elementor-accordion-item.active',
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();



        $this->start_controls_section(
            'section_toggle_style_title',
            [
                'label' => esc_html__('Title', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_background',
            [
                'label'     => esc_html__('Background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-accordion-icon, {{WRAPPER}} .elementor-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-accordion-icon svg'                                     => 'fill: {{VALUE}};',
                ],
                'global'    => [
                    'default' => Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label'     => esc_html__('Active Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-active .elementor-accordion-icon, {{WRAPPER}} .elementor-active .elementor-accordion-title' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-active .elementor-accordion-icon svg'                                                       => 'fill: {{VALUE}};',
                ],
                'global'    => [
                    'default' => Global_Colors::COLOR_ACCENT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .elementor-accordion-title',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Stroke::get_type(),
            [
                'name'     => 'text_stroke',
                'selector' => '{{WRAPPER}} .elementor-accordion-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title_shadow',
                'selector' => '{{WRAPPER}} .elementor-accordion-title',
            ]
        );


        $this->add_responsive_control(
            'title_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'accordion_title_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-tab-title',
            ]
        );

        $this->add_control(
            'accordion_title_border_active',
            [
                'label'     => esc_html__('Active Border Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}};',
                ],
                'global'    => [

                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_icon',
            [
                'label'     => esc_html__('Icon', 'ogeko'),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'selected_icon[value]!' => '',
                ],
            ]
        );

        $this->add_control(
            'icon_align',
            [
                'label'   => esc_html__('Alignment', 'ogeko'),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'left'  => [
                        'title' => esc_html__('Start', 'ogeko'),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'right' => [
                        'title' => esc_html__('End', 'ogeko'),
                        'icon'  => 'eicon-h-align-right',
                    ],
                ],
                'default' => is_rtl() ? 'right' : 'left',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label'     => __('Size', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'default'   => [
                    'size' => 20,
                ],
                'range'     => [
                    'px' => [
                        'min' => 6,
                        'max' => 300,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon i:before' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
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
                'default'   => [
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'width: {{SIZE}}{{UNIT}}; height:{{SIZE}}{{UNIT}}; text-align:center; flex: 0 0 {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_line_height',
            [
                'label'     => __('Line Height', 'ogeko'),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size' => 50,
                ],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'line-height:{{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon svg'      => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_active_color',
            [
                'label'     => esc_html__('Active Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active .elementor-accordion-icon i:before' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .elementor-tab-title.elementor-active .elementor-accordion-icon svg'      => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_icon_color',
            [
                'label'     => esc_html__('Background Color Icon', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'background_icon_color_active',
            [
                'label'     => esc_html__('Background Active Color Icon ', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active .elementor-accordion-icon' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'placeholder' => '1px',
                'default' => '1px',
                'selector' => '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon',
            ]
        );

        $this->add_control(
            'border_icon_active_color',
            [
                'label'     => esc_html__('Border Active Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active .elementor-accordion-icon' => 'border-color: {{VALUE}};',
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
                    '{{WRAPPER}} .elementor-tab-title .elementor-accordion-icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_space',
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
                    '{{WRAPPER}} .elementor-accordion-icon-left .elementor-tab-title .elementor-accordion-icon'  => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .elementor-accordion-icon-right .elementor-tab-title .elementor-accordion-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style_content',
            [
                'label' => esc_html__('Content', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_background_color',
            [
                'label'     => esc_html__('Background', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'color: {{VALUE}};',
                ],
                'global'    => [
                    'default' => Global_Colors::COLOR_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-tab-content',
                'global'   => [
                    'default' => Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'content_shadow',
                'selector' => '{{WRAPPER}} .elementor-tab-content',
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label'      => esc_html__('Padding', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'content_margin',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render accordion widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        $migrated = isset($settings['__fa4_migrated']['selected_icon']);

        if (!isset($settings['icon']) && !Icons_Manager::is_migration_allowed()) {
            // @todo: remove when deprecated
            // added as bc in 2.6
            // add old default
            $settings['icon']        = 'fa fa-plus';
            $settings['icon_active'] = 'fa fa-minus';
            $settings['icon_align']  = $this->get_settings('icon_align');
        }

        $is_new   = empty($settings['icon']) && Icons_Manager::is_migration_allowed();
        $has_icon = (!$is_new || !empty($settings['selected_icon']['value']));
        $id_int   = substr($this->get_id_int(), 0, 3);
        ?>
        <div class="elementor-accordion" role="tablist">
            <?php
            foreach ($settings['tabs'] as $index => $item) :
            $tab_count = $index + 1;

            $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

            $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

            $this->add_render_attribute($tab_title_setting_key, [
                'id'            => 'elementor-tab-title-' . $id_int . $tab_count,
                'class'         => ['elementor-tab-title'],
                'data-tab'      => $tab_count,
                'role'          => 'tab',
                'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                'aria-expanded' => 'false',
            ]);

            $this->add_render_attribute($tab_content_setting_key, [
                'id'              => 'elementor-tab-content-' . $id_int . $tab_count,
                'class'           => ['elementor-tab-content', 'elementor-clearfix'],
                'data-tab'        => $tab_count,
                'role'            => 'tabpanel',
                'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
            ]);

            $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');
            ?>
            <div class="elementor-accordion-item elementor-accordion-icon-<?php echo esc_attr($settings['icon_align']); ?>">
                <<?php Utils::print_validated_html_tag($settings['title_html_tag']); ?> <?php $this->print_render_attribute_string($tab_title_setting_key); ?>
                >
                <?php if ($has_icon) : ?>
                    <span class="elementor-accordion-icon" aria-hidden="true">
							<?php
                            if ($is_new || $migrated) { ?>
                                <span class="elementor-accordion-icon-closed"><?php Icons_Manager::render_icon($settings['selected_icon']); ?></span>
                                <span class="elementor-accordion-icon-opened"><?php Icons_Manager::render_icon($settings['selected_active_icon']); ?></span>
                            <?php } else { ?>
                                <i class="elementor-accordion-icon-closed <?php echo esc_attr($settings['icon']); ?>"></i>
                                <i class="elementor-accordion-icon-opened <?php echo esc_attr($settings['icon_active']); ?>"></i>
                            <?php } ?>
							</span>
                <?php endif; ?>
                <a class="elementor-accordion-title" href=""><?php
                    $this->print_unescaped_setting('tab_title', 'tabs', $index);
                    ?></a>
            </<?php Utils::print_validated_html_tag($settings['title_html_tag']); ?>>


            <div <?php echo ogeko_elementor_get_render_attribute_string($tab_content_setting_key, $this); // WPCS: XSS ok.?>>
                <?php if ('html' === $item['source']): ?>
                    <?php $this->print_text_editor($item['tab_content']); ?>
                <?php else: ?>
                    <?php echo Plugin::instance()->frontend->get_builder_content_for_display($item['tab_template']); ?>
                <?php endif; ?>
            </div>

        </div>
    <?php endforeach; ?>
        <?php
        if (isset($settings['faq_schema']) && 'yes' === $settings['faq_schema']) {
            $json = [
                '@context'   => 'https://schema.org',
                '@type'      => 'FAQPage',
                'mainEntity' => [],
            ];

            foreach ($settings['tabs'] as $index => $item) {
                $json['mainEntity'][] = [
                    '@type'          => 'Question',
                    'name'           => wp_strip_all_tags($item['tab_title']),
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => $this->parse_text_editor($item['tab_content']),
                    ],
                ];
            }
            ?>
            <script type="application/ld+json"><?php echo wp_json_encode($json); ?></script>
        <?php } ?>
        </div>
        <?php
    }
}

$widgets_manager->register(new Ogeko_Elementor_Accordion());