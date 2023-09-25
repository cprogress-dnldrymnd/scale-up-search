<?php

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

class Ogeko_Elementor_Social_Share extends Elementor\Widget_Base {

    public function get_name() {
        return 'ogeko-social-share';
    }

    public function get_title() {
        return esc_html__('Ogeko Social Share', 'ogeko');
    }

    public function get_icon() {
        return 'eicon-share';
    }

    public function get_categories() {
        return array('ogeko-addons');
    }

    protected function register_controls() {
    }

    protected function render() {
        ogeko_social_share();
    }
}

$widgets_manager->register(new Ogeko_Elementor_Social_Share());
