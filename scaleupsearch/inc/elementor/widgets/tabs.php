<?php

namespace Elementor;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Elementor tabs widget.
 *
 * Elementor widget that displays vertical or horizontal tabs with different
 * pieces of content.
 *
 * @since 1.0.0
 */
class Ogeko_Elementor_Tabs extends Widget_Base
{

    public function get_categories()
    {
        return array('ogeko-addons');
    }

    /**
     * Get widget name.
     *
     * Retrieve tabs widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'ogeko-tabs';
    }

    /**
     * Get widget title.
     *
     * Retrieve tabs widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return esc_html__('Ogeko Tabs', 'ogeko');
    }

    /**
     * Get widget icon.
     *
     * Retrieve tabs widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-tabs';
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
    public function get_keywords()
    {
        return ['tabs', 'accordion', 'toggle'];
    }

    /**
     * Get HTML wrapper class.
     *
     * Retrieve the widget container class. Can be used to override the
     * container class for specific widgets.
     *
     * @since 2.0.9
     * @access protected
     */

    public function get_css_config() {
        return $this->get_widget_css_config( 'tabs' );
    }

    protected function get_html_wrapper_class()
    {
        return 'elementor-widget-' . $this->get_name() . ' elementor-widget-tabs';
    }

    public function get_script_depends()
    {
        return ['ogeko-elementor-tabs'];
    }

    /**
     * Register tabs widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function register_controls()
    {

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
            'section_tabs',
            [
                'label' => esc_html__('Tabs', 'ogeko'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'tab_title',
            [
                'label' => esc_html__('Title', 'ogeko'),
                'type' => Controls_Manager::TEXT,
                'default' => esc_html__('Tab Title', 'ogeko'),
                'placeholder' => esc_html__('Tab Title', 'ogeko'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'tab_icon',
            [
                'label' => esc_html__('Tab Icon', 'ogeko'),
                'type' => Controls_Manager::ICONS,
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
                'label' => esc_html__('Content', 'ogeko'),
                'default' => esc_html__('Tab Content', 'ogeko'),
                'placeholder' => esc_html__('Tab Content', 'ogeko'),
                'type' => Controls_Manager::WYSIWYG,
                'show_label' => false,
                'condition' => [
                    'source' => 'html',
                ],
            ]
        );

        $this->add_control(
            'tabs',
            [
                'label' => esc_html__('Tabs Items', 'ogeko'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'tab_title' => esc_html__('Tab #1', 'ogeko'),
                        'tab_content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ogeko'),
                    ],
                    [
                        'tab_title' => esc_html__('Tab #2', 'ogeko'),
                        'tab_content' => esc_html__('Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'ogeko'),
                    ],
                ],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->add_control(
            'view',
            [
                'label' => esc_html__('View', 'ogeko'),
                'type' => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );

        $this->add_control(
            'type',
            [
                'label'        => esc_html__('Type', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'default'      => 'horizontal',
                'options'      => [
                    'horizontal' => esc_html__('Horizontal', 'ogeko'),
                    'vertical'   => esc_html__('Vertical', 'ogeko'),
                ],
                'prefix_class' => 'elementor-tabs-view-',
                'separator'    => 'before',
            ]
        );


        $this->add_control(
            'layout',
            [
                'label'        => esc_html__('Layout', 'ogeko'),
                'type'         => Controls_Manager::SELECT,
                'default'      => '1',
                'options'      => [
                    '1' => esc_html__('Layout 1', 'ogeko'),
                    '2'   => esc_html__('Layout 2', 'ogeko'),
                ],
                'prefix_class' => 'elementor-tabs-',
            ]
        );

        $this->add_responsive_control(
            'tabs_align_horizontal',
            [
                'label' => esc_html__('Alignment', 'ogeko'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__('Start', 'ogeko'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__('Center', 'ogeko'),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__('End', 'ogeko'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-tabs .elementor-tabs-wrapper' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_tabs_style',
            [
                'label' => esc_html__('Tabs', 'ogeko'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_title',
            [
                'label' => esc_html__('Title', 'ogeko'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_typography',
                'selector' => '{{WRAPPER}}.elementor-widget-tabs .elementor-tab-title',
            ]
        );

        $this->start_controls_tabs('tabs_carousel_dots_style');

        $this->start_controls_tab(
            'tab_title_color_normal',
            [
                'label' => esc_html__('Normal', 'ogeko'),
            ]
        );

        $this->add_control(
            'tab_color',
            [
                'label' => esc_html__('Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'tab_title_background_color',
            [
                'label' => esc_html__('Background Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tab_iconcolor',
            [
                'label' => esc_html__('Icon Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title i' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_color_active',
            [
                'label' => esc_html__('Active', 'ogeko'),
            ]
        );

        $this->add_control(
            'tab_active_color',
            [
                'label' => esc_html__('Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title.elementor-active' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_title_background_active_color',
            [
                'label' => esc_html__('Background Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title.elementor-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'tab_active_iconcolor',
            [
                'label' => esc_html__('Icon Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title.elementor-active i' => 'color: {{VALUE}};'
                ],
            ]
        );

        $this->add_control(
            'tab_border_color_active',
            [
                'label' => esc_html__('Border Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title.elementor-active' => 'border-color: {{VALUE}};'
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'ogeko'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'vh' => [
                        'min' => 10,
                        'max' => 100,
                    ],
                ],
                'size_units' => ['px', '%'],

                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title i' => 'font-size: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control('tab_title_padding',
            [
                'label' => esc_html__('Padding', 'ogeko'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_responsive_control('tab_title_margin',
            [
                'label' => esc_html__('Margin', 'ogeko'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs .elementor-tab-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_border',
                'selector' => '{{WRAPPER}}.elementor-widget-ogeko-tabs.elementor-widget-tabs.elementor-tabs-view-horizontal .elementor-tab-title',
                'separator' => 'before',
            ]
        );


        $this->add_control(
            'tab_border_radius',
            [
                'label' => esc_html__('Border Radius', 'ogeko'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'heading_content',
            [
                'label' => esc_html__('Content', 'ogeko'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label' => esc_html__('Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'content_typography',
                'selector' => '{{WRAPPER}} .elementor-tab-content',
            ]
        );


        $this->add_responsive_control('tab_content_padding',
            [
                'label' => esc_html__('Padding', 'ogeko'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );


        $this->add_responsive_control('tab_content_margin',
            [
                'label' => esc_html__('Margin', 'ogeko'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .elementor-tab-content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_content_border',
                'selector' => '{{WRAPPER}} .elementor-tabs-content-wrapper',
                'separator' => 'before',
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render tabs widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since 1.0.0
     * @access protected
     */
    protected function render()
    {
        $tabs = $this->get_settings_for_display('tabs');

        $id_int = substr($this->get_id_int(), 0, 3);
        ?>
        <div class="elementor-tabs" role="tablist">
            <div class="elementor-tabs-wrapper">
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class_content = ($index == 0) ? 'elementor-active' : '';
                    $tab_title_setting_key = $this->get_repeater_setting_key('tab_title', 'tabs', $index);

                    $this->add_render_attribute($tab_title_setting_key, [
                        'id' => 'elementor-tab-title-' . $id_int . $tab_count,
                        'class' => [
                            'elementor-tab-title',
                            'elementor-tab-desktop-title',
                            $class_content,
                            $class_item
                        ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ]);
                    ?>
                    <div <?php echo ogeko_elementor_get_render_attribute_string($tab_title_setting_key, $this); ?>>
                        <?php Icons_Manager::render_icon($item['tab_icon'], ['aria-hidden' => 'true']); ?>
                        <span class="title"><?php echo esc_html($item['tab_title']); ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="elementor-tabs-content-wrapper">
                <?php
                foreach ($tabs as $index => $item) :
                    $tab_count = $index + 1;
                    $class_item = 'elementor-repeater-item-' . $item['_id'];
                    $class_content = ($index == 0) ? 'elementor-active' : '';
                    $tab_content_setting_key = $this->get_repeater_setting_key('tab_content', 'tabs', $index);

                    $tab_title_mobile_setting_key = $this->get_repeater_setting_key('tab_title_mobile', 'tabs', $tab_count);

                    $this->add_render_attribute($tab_content_setting_key, [
                        'id' => 'elementor-tab-content-' . $id_int . $tab_count,
                        'class' => [
                            'elementor-tab-content',
                            'elementor-clearfix',
                            $class_content,
                            $class_item
                        ],
                        'data-tab' => $tab_count,
                        'role' => 'tabpanel',
                        'aria-labelledby' => 'elementor-tab-title-' . $id_int . $tab_count,
                    ]);

                    $this->add_render_attribute($tab_title_mobile_setting_key, [
                        'class' => [
                            'elementor-tab-title',
                            'elementor-tab-mobile-title',
                            $class_content,
                            $class_item
                        ],
                        'data-tab' => $tab_count,
                        'role' => 'tab',
                        'aria-controls' => 'elementor-tab-content-' . $id_int . $tab_count,
                    ]);

                    $this->add_inline_editing_attributes($tab_content_setting_key, 'advanced');
                    ?>
                    <div <?php echo ogeko_elementor_get_render_attribute_string($tab_title_mobile_setting_key, $this); // WPCS: XSS ok.
                    ?>>
                        <?php Icons_Manager::render_icon($item['tab_icon'], ['aria-hidden' => 'true']); ?>
                        <a href="#" class="title"><?php echo esc_html($item['tab_title']); ?></a>
                    </div>

                    <div <?php echo ogeko_elementor_get_render_attribute_string($tab_content_setting_key, $this); // WPCS: XSS ok.
                    ?>>
                        <?php if ('html' === $item['source']): ?>
                            <?php echo ogeko_elementor_parse_text_editor($item['tab_content'], $this); // WPCS: XSS ok. ?>
                        <?php else: ?>
                            <?php echo Plugin::instance()->frontend->get_builder_content_for_display($item['tab_template']); ?>
                        <?php endif; ?>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new Ogeko_Elementor_Tabs());
