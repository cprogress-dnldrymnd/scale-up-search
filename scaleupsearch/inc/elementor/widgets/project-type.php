<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ogeko_Elementor_Project_Type extends Elementor\Widget_Base {

    public function get_name() {
        return 'ogeko-project-type';
    }

    public function get_title() {
        return esc_html__('Project Type', 'ogeko');
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    protected function register_controls() {

        //title
        $this->start_controls_section(
            'section_type_project_title',
            [
                'label' => esc_html__('Title', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography',
                'selector' => '{{WRAPPER}} .project-detail-wrapper .label',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .project-detail-wrapper .label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_margin',
            [
                'label'      => esc_html__('Margin', 'ogeko'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .project-detail-wrapper .label' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        //type
        $this->start_controls_section(
            'section_type_project_type',
            [
                'label' => esc_html__('Type', 'ogeko'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'typography_type',
                'selector' => '{{WRAPPER}} .project-detail-wrapper .type, {{WRAPPER}} .project-detail-wrapper .type a',
            ]
        );

        $this->add_control(
            'type_color',
            [
                'label'     => esc_html__('Color', 'ogeko'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .project-detail-wrapper .type, {{WRAPPER}} .project-detail-wrapper .type a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $id       = get_the_ID();
        if (get_post_type() !== 'ogeko_project') {
            return;
        }
        $categories_list = get_the_category_list('');
        $url             = get_post_meta($id, 'project_website', true);
        ?>
        <div class="project-detail-wrapper">
            <div class="project-type">
                <ul>
                    <li>
                        <span class="label"><?php echo esc_html__('Date:', 'ogeko') ?></span>
                        <span class="type"><?php echo get_the_date(); ?></span>
                    </li>
                    <li>
                        <span class="label"><?php echo esc_html__('Client:', 'ogeko') ?></span>
                        <span class="type"><?php echo get_post_meta($id, 'project_client', true); ?></span>
                    </li>
                    <li>
                        <span class="label"><?php echo esc_html__('Location:', 'ogeko') ?></span>
                        <span class="type"><?php echo get_post_meta($id, 'project_location', true); ?></span>
                    </li>
                    <li>
                        <span class="label"><?php echo esc_html__('Category:', 'ogeko') ?></span>
                        <span class="type"><?php echo Ogeko_Project::getInstance()->get_term_project($id); ?></span>
                    </li>
                    <li>
                        <?php
                        $removeChar = ["https://", "http://", "/"];
                        ?>
                        <span class="label"><?php echo esc_html__('Website:', 'ogeko') ?></span>
                        <span class="type"><a href="<?php echo esc_url($url) ?>"><?php echo parse_url(get_post_meta($id, 'project_website', true), PHP_URL_HOST); ?></a></span>
                    </li>
                </ul>
            </div>
        </div>
        <?php
    }
}

$widgets_manager->register(new Ogeko_Elementor_Project_Type());
