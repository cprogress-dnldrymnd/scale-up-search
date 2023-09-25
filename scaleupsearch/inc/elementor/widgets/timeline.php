<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Group_Control_Image_Size;
use Elementor\Control_Media;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Ogeko_Elementor_Timeline_Widget extends Elementor\Widget_Base {

    public function get_name() {
        return 'ogeko-timeline';
    }

    public function get_title() {
        return __('Ogeko Timeline', 'ogeko');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_script_depends() {
        return ['ogeko-elementor-timeline', 'slick'];
    }

    public function get_categories() {
        return ['ogeko-addons'];
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {

        $this->start_controls_section(
            'section_text_carousel',
            [
                'label' => __('Timeline', 'ogeko'),
            ]
        );

        $repeater = new Repeater();
        $repeater->add_control(
            'image',
            [
                'label'   => __('Choose Image', 'ogeko'),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => [
                    'active' => true,
                ],
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('Title', 'ogeko'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'year',
            [
                'label'       => __('Year', 'ogeko'),
                'type'        => Controls_Manager::TEXT,
                'default'     => __('2020', 'ogeko'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label'       => __('Description', 'ogeko'),
                'type'        => Controls_Manager::WYSIWYG,
                'default'     => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'ogeko'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'timelines',
            [
                'label'       => __('Timeline Item', 'ogeko'),
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '{{{ year }}}',
            ]
        );
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `thumbnail_size` and `thumbnail_custom_dimension`.
                'default'   => 'full',
                'separator' => 'none',
            ]
        );

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (empty($settings['timelines'])) {
            return;
        }
        $carousel_settings = $this->get_carousel_settings();
        $this->add_render_attribute('wrapper', 'class', ['timeline-wrapper']);
        $this->add_render_attribute('slider-nav', [
            'data-settings' => wp_json_encode($carousel_settings),
            'class'         => [
                'ogeko-carousel',
                'slider-nav',
                'timeline-title-wrapper',
            ],
        ]);

        $this->add_render_attribute('slider-for', [
            'class' => [
                'ogeko-carousel',
                'slider-for',
                'timeline-content-wrapper',
            ]
        ]);
        ?>
        <div <?php $this->print_render_attribute_string('wrapper'); ?>>

            <ul <?php $this->print_render_attribute_string('slider-nav'); ?>>
                <?php foreach ($settings['timelines'] as $index => $testimonial):
                    $repeater_setting_key = $this->get_repeater_setting_key('year', 'timelines', $index);
                    $this->add_render_attribute($repeater_setting_key, 'class', 'timeline-title');
                    ?>
                    <li <?php $this->print_render_attribute_string($repeater_setting_key); ?>>
                        <h5 class="timeline-title-year"><?php $this->print_unescaped_setting('year', 'timelines', $index); ?></h5>
                        <span class="timeline-title-dot"></span>

                    </li>
                <?php endforeach; ?>
            </ul>

            <div <?php $this->print_render_attribute_string('slider-for'); ?>>
                <?php foreach ($settings['timelines'] as $index => $testimonial):
                    $repeater_setting_key = $this->get_repeater_setting_key('description', 'timelines', $index);
                    $this->add_render_attribute($repeater_setting_key, 'class', 'timeline-content-item');
                    ?>
                    <div <?php $this->print_render_attribute_string($repeater_setting_key); ?>>
                        <div class="row" data-elementor-columns-tablet="2" data-elementor-columns-mobile="1">
                            <div class="column-item">
                                <?php $this->render_image($settings, $testimonial); ?>
                            </div>
                            <div class="column-item">
                                <div class="timeline-content">
                                    <h4 class="timeline_title"><?php $this->print_unescaped_setting('title', 'timelines', $index); ?></h4>
                                    <div class="timeline-description">
                                        <?php $this->print_unescaped_setting('description', 'timelines', $index); ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <?php
    }

    private function render_image($settings, $timeline) {
        if (!empty($timeline['image']['url'])) :
            ?>
            <div class="elementor-timeline-image">
                <?php
                $timeline['image_size']             = $settings['image_size'];
                $timeline['image_custom_dimension'] = $settings['image_custom_dimension'];
                echo Group_Control_Image_Size::get_attachment_image_html($timeline, 'image');
                ?>
            </div>
        <?php
        endif;
    }

    protected function get_carousel_settings() {
        $settings       = $this->get_settings_for_display();
        $breakpoints    = \Elementor\Plugin::$instance->breakpoints->get_breakpoints();
        $column         = isset($settings['column']) ? $settings['column'] : 5;
        $tablet         = isset($settings['column_tablet']) ? $settings['column_tablet'] : 3;
        $navigation     = isset($settings['navigation']) ? $settings['navigation'] : 'arrows';
        $autoplay_speed = isset($settings['autoplay_speed']) ? $settings['autoplay_speed'] : 5000;
        $pause_on_hover = (isset($settings['pause_on_hover']) && $settings['pause_on_hover'] === 'yes') ? true : false;
        $autoplay       = (isset($settings['autoplay']) && $settings['autoplay'] === 'yes') ? true : false;
        $infinite       = (isset($settings['infinite']) && $settings['infinite'] === 'yes') ? true : true;

        return array(
            'navigation'              => $navigation,
            'autoplayHoverPause'      => $pause_on_hover,
            'autoplay'                => $autoplay,
            'autoplaySpeed'           => $autoplay_speed,
            'items'                   => $column,
            'items_laptop'            => isset($settings['column_laptop']) ? $settings['column_laptop'] : $column,
            'items_tablet_extra'      => isset($settings['column_tablet_extra']) ? $settings['column_tablet_extra'] : $column,
            'items_tablet'            => $tablet,
            'items_mobile_extra'      => isset($settings['column_mobile_extra']) ? $settings['column_mobile_extra'] : $tablet,
            'items_mobile'            => isset($settings['column_mobile']) ? $settings['column_mobile'] : 3,
            'loop'                    => $infinite,
            'breakpoint_laptop'       => $breakpoints['laptop']->get_value(),
            'breakpoint_tablet_extra' => $breakpoints['tablet_extra']->get_value(),
            'breakpoint_tablet'       => $breakpoints['tablet']->get_value(),
            'breakpoint_mobile_extra' => $breakpoints['mobile_extra']->get_value(),
            'breakpoint_mobile'       => $breakpoints['mobile']->get_value(),
        );
    }

}

$widgets_manager->register(new Ogeko_Elementor_Timeline_Widget());