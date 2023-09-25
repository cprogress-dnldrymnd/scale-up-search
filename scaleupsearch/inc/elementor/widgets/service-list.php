<?php

use Elementor\Controls_Manager;
use Elementor\Repeater;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ogeko_Elementor_Service_List extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'ogeko-service-list';
    }

    public function get_title()
    {
        return esc_html__('Ogeko Service List', 'ogeko');
    }

    public function get_categories()
    {
        return array('ogeko-addons');
    }

    protected function register_controls()
    {
        $this->start_controls_section(
            'section_icon',
            [
                'label' => esc_html__('Service List', 'ogeko'),
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => esc_html__('Text', 'ogeko'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'placeholder' => esc_html__('Service Item', 'ogeko'),
                'default' => esc_html__('Service Item', 'ogeko'),
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'ogeko'),
                'type' => Controls_Manager::URL,
                'dynamic' => [
                    'active' => true,
                ],
                'placeholder' => esc_html__('https://your-link.com', 'ogeko'),
            ]
        );

        $repeater->add_control(
            'text_active',
            [
                'label' => esc_html__('Active', 'ogeko'),
                'type' => Controls_Manager::SWITCHER,
            ]
        );


        $this->add_control(
            'service_list',
            [
                'label' => esc_html__('Items', 'ogeko'),
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ text }}}',
            ]
        );


        $this->end_controls_section();


    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        $this->add_render_attribute('wrapper', 'class', 'elementor-service-item-wrapper');
        ?>
        <ul <?php echo ogeko_elementor_get_render_attribute_string('wrapper', $this); ?>>
            <?php
            foreach ($settings['service_list'] as $index => $item) :?>
                <?php
                    $active = '';
                    if ($item['text_active'] == 'yes'){
                        $active = 'active';
                    }
                ?>
                <li class="service-list <?php echo esc_attr($active); ?>">
                    <?php if (!empty($item['link']['url'])): ?>
                        <a href="<?php echo esc_url($item['link']['url']); ?>">
                    <?php endif; ?>
                        <span class="service-text">
                            <span><?php echo esc_html($item['text']); ?></span><i class="ogeko-icon-arrow-right"></i>
                        </span>
                <?php if ( ! empty( $item['link']['url'] ) ) : ?></a><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }

}

$widgets_manager->register(new Ogeko_Elementor_Service_List());
