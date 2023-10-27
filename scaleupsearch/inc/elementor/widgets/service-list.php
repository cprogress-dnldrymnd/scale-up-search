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
                            <span><?php echo esc_html($item['text']); ?></span><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.673" height="14.707"> <defs> <clipPath> <rect width="14.673" height="14.707" fill="#42c697"></rect> </clipPath> </defs> <g transform="translate(0 0)" clip-path="url(#clip-path)"> <path d="M12.43,0H0V3.652H8.355L6.513,5.489a1.684,1.684,0,0,0,0,2.382L7.991,9.352Q9.5,7.846,11.01,6.329c.007.147.018.265.018.382q.005,2.422,0,4.84c0,.945-.007,1.887.008,2.832V14.7c1.14.018,2.468,0,3.633,0V2.24A2.242,2.242,0,0,0,12.43,0" transform="translate(0 0)" fill="#42c697"></path> <path id="Path_19" d="M5.182,19.341l1.736,1.739a1.328,1.328,0,0,0,1.882,0l.007-.007a1.3,1.3,0,0,0,0-1.831L7.05,17.484c-1.405,1.4-.478.47-1.868,1.857" transform="translate(-2.865 -9.665)" fill="#42c697"></path> </g> </svg>
                        </span>
                <?php if ( ! empty( $item['link']['url'] ) ) : ?></a><?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php
    }

}

$widgets_manager->register(new Ogeko_Elementor_Service_List());
