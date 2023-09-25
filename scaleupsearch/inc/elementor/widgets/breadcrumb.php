<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ogeko_Elementor_Breadcrumb extends Elementor\Widget_Base {

    public function get_name() {
        return 'ogeko-breadcrumb';
    }

    public function get_title() {
        return esc_html__('Ogeko Breadcrumbs', 'ogeko');
    }

    public function get_icon() {
        return 'eicon-product-breadcrumbs';
    }

    public function get_keywords() {
        return ['breadcrumbs'];
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    protected function register_controls() {

        $this->start_controls_section(
            'section_product_rating_style',
            [
                'label' => esc_html__('Style Breadcrumbs', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'wc_style_warning',
            [
                'type'            => Controls_Manager::RAW_HTML,
                'raw'             => esc_html__('The style of this widget is often affected by your theme and plugins. If you experience any such issue, try to switch to a basic theme and deactivate related plugins.', 'ogeko'),
                'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label'     => esc_html__('Text Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-listItem' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'link_color',
            [
                'label'     => esc_html__('Link Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-listItem a' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'link_color_hover',
            [
                'label'     => esc_html__('Link Color Hover', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb-listItem a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'text_typography',
                'selector' => '{{WRAPPER}} .breadcrumb',
            ]
        );

        $this->add_responsive_control(
            'alignment',
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
                'selectors' => [
                    '{{WRAPPER}} .breadcrumb'    => 'text-align: {{VALUE}}',
                    '{{WRAPPER}} .ogeko-title' => 'text-align: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'display_list_item',
            [
                'label'        => esc_html__('Hidden List Item', 'ogeko'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-ogeko-list-item-',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_product_rating_style_title',
            [
                'label' => esc_html__('Style Title', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'text_color_title',
            [
                'label'     => esc_html__('Title Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .ogeko-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .ogeko-title',
            ]
        );

        $this->add_control(
            'display_title',
            [
                'label'        => esc_html__('Hidden Title', 'ogeko'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-ogeko-title-',
            ]
        );

        $this->add_control(
            'display_title_single',
            [
                'label'        => esc_html__('Hidden Title Single', 'ogeko'),
                'type'         => \Elementor\Controls_Manager::SWITCHER,
                'prefix_class' => 'hidden-ogeko-title-single-'
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%', 'em'],
                'selectors'  => [
                    '{{WRAPPER}} .ogeko-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();
    }

    protected function render() {
        ?>
        <div class="breadcrumb" typeof="BreadcrumbList" vocab="https://schema.org/">
            <h1 class="ogeko-title">
                <?php
                if (is_page() || is_single()) {
                    the_title();
                } elseif (is_archive() && is_tax() && !is_category() && !is_tag()) {
                    $tax_object = get_queried_object();
                    echo esc_html($tax_object->name);
                } elseif (is_category()) {
                    single_cat_title();
                } elseif (is_home()) {
                    echo esc_html__('Our Blog', 'ogeko');
                } elseif (is_post_type_archive()) {
                    $tax_object = get_queried_object();
                    echo esc_html($tax_object->label);
                } elseif (is_tag()) {
                    // Get tag information
                    $term_id  = get_query_var('tag_id');
                    $taxonomy = 'post_tag';
                    $args     = 'include=' . esc_attr($term_id);
                    $terms    = get_terms($taxonomy, $args);
                    // Display the tag name
                    if (isset($terms[0]->name)) {
                        echo esc_html($terms[0]->name);
                    }
                } elseif (is_day()) {
                    echo esc_html__('Day Archives', 'ogeko');
                } elseif (is_month()) {
                    echo get_the_time('F') . esc_html__(' Archives', 'ogeko');
                } elseif (is_year()) {
                    echo get_the_time('Y') . esc_html__(' Archives', 'ogeko');
                } elseif (is_search()) {
                    esc_html_e('Search Results', 'ogeko');
                } elseif (is_author()) {
                    global $author;
                    if (!empty($author)) {
                        $usermetadata = get_userdata($author);
                        echo esc_html__('Author', 'ogeko') . ': ' . $usermetadata->display_name;
                    }
                }
                ?>
            </h1>
            <?php
            if (ogeko_is_bcn_nav_activated()) {
                echo '<div class="breadcrumb-listItem">';
                bcn_display();
                echo '</div>';
            }
            ?>
        </div>
        <?php
    }
}

$widgets_manager->register(new Ogeko_Elementor_Breadcrumb());
