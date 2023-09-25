<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!ogeko_is_contactform_activated()) {
    return;
}

use Elementor\Controls_Manager;


class Ogeko_Elementor_ContactForm extends Elementor\Widget_Base {

    public function get_name() {
        return 'ogeko-contactform';
    }

    public function get_title() {
        return esc_html__('Ogeko Contact Form', 'ogeko');
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    protected function register_controls() {
        $this->start_controls_section(
            'contactform7',
            [
                'label' => esc_html__('General', 'ogeko'),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
        $cf7               = get_posts('post_type="wpcf7_contact_form"&numberposts=-1');
        $contact_forms[''] = esc_html__('Please select form', 'ogeko');
        if ($cf7) {
            foreach ($cf7 as $cform) {
                $contact_forms[$cform->ID] = $cform->post_title;
            }
        } else {
            $contact_forms[0] = esc_html__('No contact forms found', 'ogeko');
        }

        $this->add_control(
            'cf_id',
            [
                'label'   => esc_html__('Select contact form', 'ogeko'),
                'type'    => Controls_Manager::SELECT,
                'options' => $contact_forms,
                'default' => ''
            ]
        );

        $this->add_control(
            'form_name',
            [
                'label'   => esc_html__('Form name', 'ogeko'),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__('Contact form', 'ogeko'),
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'        => esc_html__('Alignment', 'ogeko'),
                'type'         => Controls_Manager::CHOOSE,
                'options'      => [
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
                'default'      => 'center',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-button' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'form-style',
            [
                'label' => __('Style Border', 'ogeko'),
                'type' => Controls_Manager::SWITCHER,
                'label_off' => __('Off', 'ogeko'),
                'label_on' => __('On', 'ogeko'),
                'prefix_class' => 'form-style-border-',
                'separator' => 'before',

            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (!$settings['cf_id']) {
            return;
        }
        $args['id']    = $settings['cf_id'];
        $args['title'] = $settings['form_name'];

        echo ogeko_do_shortcode('contact-form-7', $args);
    }
}

$widgets_manager->register(new Ogeko_Elementor_ContactForm());
