<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


use Elementor\Controls_Manager;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Class Project
 */
class Ogeko_Elementor_Project_Related extends Elementor\Widget_Base {

    public function get_name() {
        return 'ogeko-project-related';
    }

    public function get_title() {
        return esc_html__('Ogeko Project Related', 'ogeko');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return array('ogeko-addons');
    }


    protected function register_controls() {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Layout', 'ogeko'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'column',
            [
                'label' => esc_html__('Columns', 'ogeko'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 3,
                'options' => [1 => 1, 2 => 2, 3 => 3, 4 => 4, 6 => 6],
            ]
        );

        $this->add_control(
            'posts_per_page',
            [
                'label'   => esc_html__('Posts Per Page', 'ogeko'),
                'type'    => Controls_Manager::NUMBER,
                'default' => 6,
            ]
        );

        $this->add_responsive_control(
            'gutter',
            [
                'label'      => esc_html__('Gutter', 'ogeko'),
                'type'       => Controls_Manager::SLIDER,
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 60,
                    ],
                ],
                'size_units' => ['px'],
                'selectors'  => [
                    '{{WRAPPER}} .column-item' => 'padding-left: calc({{SIZE}}{{UNIT}} / 2); padding-right: calc({{SIZE}}{{UNIT}} / 2); margin-bottom: calc({{SIZE}}{{UNIT}})',
                    '{{WRAPPER}} .row'         => 'margin-left: calc({{SIZE}}{{UNIT}} / -2); margin-right: calc({{SIZE}}{{UNIT}} / -2);',
                ],
            ]
        );

        $this->add_control(
            'project_style',
            [
                'label' => esc_html__('Layout', 'ogeko'),
                'default' => '1',
                'type' => Controls_Manager::SELECT,
                'options' => [
                    '1' => esc_html__('Style 1', 'ogeko'),
                    '2' => esc_html__('Style 2', 'ogeko'),
                ],
                'prefix_class' => 'project-style-',
            ]
        );

        $this->end_controls_section();
    }


    public function render() {
        $settings = $this->get_settings_for_display();
        $this->ogeko_fnc_related_project();
    }

    public function ogeko_fnc_related_project($relate_count = 3, $posttype = 'ogeko_project', $taxonomy = 'ogeko_project_cat') {

        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('row', 'class', 'row');

        if (!empty($settings['column_widescreen'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-widescreen', $settings['column_widescreen']);
        }

        if (!empty($settings['column'])) {
            $this->add_render_attribute('row', 'data-elementor-columns', $settings['column']);
        } else {
            $this->add_render_attribute('row', 'data-elementor-columns', 5);
        }

        if (!empty($settings['column_laptop'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-laptop', $settings['column_laptop']);
        }

        if (!empty($settings['column_tablet_extra'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet-extra', $settings['column_tablet_extra']);
        }

        if (!empty($settings['column_tablet'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet', $settings['column_tablet']);
        } else {
            $this->add_render_attribute('row', 'data-elementor-columns-tablet', 2);
        }

        if (!empty($settings['column_mobile_extra'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile-extra', $settings['column_mobile_extra']);
        }

        if (!empty($settings['column_mobile'])) {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile', $settings['column_mobile']);
        } else {
            $this->add_render_attribute('row', 'data-elementor-columns-mobile', 1);
        }

        $terms   = get_the_terms(get_the_ID(), $taxonomy);

        $termids = array();

        if ($terms) {
            foreach ($terms as $term) {
                $termids[] = $term->term_id;
            }
        }

        $args = array(
            'post_type'      => $posttype,
            'posts_per_page' => $relate_count,
            'post__not_in'   => array(get_the_ID()),
            'tax_query'      => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => $taxonomy,
                    'field'    => 'id',
                    'terms'    => $termids,
                    'operator' => 'IN'
                )
            )
        );

        $related = new WP_Query($args);

        if ($related->have_posts()) {
            echo '<div class="related-project">'; ?>
            <div <?php echo ogeko_elementor_get_render_attribute_string('row', $this); // WPCS: XSS ok ?>>
            <?php while ($related->have_posts()) : $related->the_post();
                ?>
                <div class="column-item project-entries">
                    <?php get_template_part('template-parts/project/content'); ?>
                </div>
            <?php
            endwhile;
            echo '</div>';
            echo '</div>';

            wp_reset_postdata();
        }


    }
}

$widgets_manager->register(new Ogeko_Elementor_Project_Related());
