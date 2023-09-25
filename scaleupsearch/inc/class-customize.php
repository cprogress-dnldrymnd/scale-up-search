<?php
if (!defined('ABSPATH')) {
    exit;
}
if (!class_exists('Ogeko_Customize')) {

    class Ogeko_Customize {


        public function __construct() {
            add_action('customize_register', array($this, 'customize_register'));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         */
        public function customize_register($wp_customize) {

            /**
             * Theme options.
             */
            require_once get_theme_file_path('inc/customize-control/editor.php');
            $this->init_ogeko_blog($wp_customize);

            $this->init_ogeko_social($wp_customize);

            if (ogeko_is_elementor_activated()) {
                $this->init_ogeko_service($wp_customize);
                $this->init_ogeko_project($wp_customize);
            }

            do_action('ogeko_customize_register', $wp_customize);
        }


        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_ogeko_blog($wp_customize) {

            $wp_customize->add_section('ogeko_blog_archive', array(
                'title' => esc_html__('Blog', 'ogeko'),
            ));

            // =========================================
            // Select Style
            // =========================================

            $wp_customize->add_setting('ogeko_options_blog_sidebar', array(
                'type'              => 'option',
                'default'           => 'left',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_blog_sidebar', array(
                'section' => 'ogeko_blog_archive',
                'label'   => esc_html__('Sidebar Position', 'ogeko'),
                'type'    => 'select',
                'choices' => array(
                    'none'  => esc_html__('None', 'ogeko'),
                    'left'  => esc_html__('Left', 'ogeko'),
                    'right' => esc_html__('Right', 'ogeko'),
                ),
            ));

            $wp_customize->add_setting('ogeko_options_blog_style', array(
                'type'              => 'option',
                'default'           => 'standard',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_blog_style', array(
                'section' => 'ogeko_blog_archive',
                'label'   => esc_html__('Blog style', 'ogeko'),
                'type'    => 'select',
                'choices' => array(
                    'standard' => esc_html__('Blog Standard', 'ogeko'),
                    'modern'    => esc_html__('Blog Modern', 'ogeko'),
                    'style-1'  => esc_html__('Blog Grid 1', 'ogeko'),
                    'style-2'  => esc_html__('Blog Grid 2', 'ogeko'),
                    'style-3'  => esc_html__('Blog Grid 3', 'ogeko'),
                ),
            ));

            $wp_customize->add_setting('ogeko_options_blog_columns', array(
                'type'              => 'option',
                'default'           => 1,
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_blog_columns', array(
                'section' => 'ogeko_blog_archive',
                'label'   => esc_html__('Colunms', 'ogeko'),
                'type'    => 'select',
                'choices' => array(
                    1 => 1,
                    2 => 2,
                    3 => 3,
                    4 => 4,
                ),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */
        public function init_ogeko_social($wp_customize) {

            $wp_customize->add_section('ogeko_social', array(
                'title' => esc_html__('Socials', 'ogeko'),
            ));
            $wp_customize->add_setting('ogeko_options_social_share', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_social_share', array(
                'type'    => 'checkbox',
                'section' => 'ogeko_social',
                'label'   => esc_html__('Show Social Share', 'ogeko'),
            ));
            $wp_customize->add_setting('ogeko_options_social_share_facebook', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_social_share_facebook', array(
                'type'    => 'checkbox',
                'section' => 'ogeko_social',
                'label'   => esc_html__('Share on Facebook', 'ogeko'),
            ));
            $wp_customize->add_setting('ogeko_options_social_share_twitter', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_social_share_twitter', array(
                'type'    => 'checkbox',
                'section' => 'ogeko_social',
                'label'   => esc_html__('Share on Twitter', 'ogeko'),
            ));
            $wp_customize->add_setting('ogeko_options_social_share_linkedin', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_social_share_linkedin', array(
                'type'    => 'checkbox',
                'section' => 'ogeko_social',
                'label'   => esc_html__('Share on Linkedin', 'ogeko'),
            ));
            $wp_customize->add_setting('ogeko_options_social_share_google-plus', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_social_share_google-plus', array(
                'type'    => 'checkbox',
                'section' => 'ogeko_social',
                'label'   => esc_html__('Share on Google+', 'ogeko'),
            ));

            $wp_customize->add_setting('ogeko_options_social_share_pinterest', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_social_share_pinterest', array(
                'type'    => 'checkbox',
                'section' => 'ogeko_social',
                'label'   => esc_html__('Share on Pinterest', 'ogeko'),
            ));
            $wp_customize->add_setting('ogeko_options_social_share_email', array(
                'type'              => 'option',
                'capability'        => 'edit_theme_options',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_social_share_email', array(
                'type'    => 'checkbox',
                'section' => 'ogeko_social',
                'label'   => esc_html__('Share on Email', 'ogeko'),
            ));
        }

        /**
         * @param $wp_customize WP_Customize_Manager
         *
         * @return void
         */

        public function init_ogeko_service($wp_customize) {

            $wp_customize->add_section('ogeko_service_archive', array(
                'title' => esc_html__('Services', 'ogeko'),
            ));

            $wp_customize->add_setting('ogeko_options_service_archive_column', array(
                'type'              => 'option',
                'default'           => '3',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_setting('ogeko_options_service_archive_style', array(
                'type'              => 'option',
                'default'           => 'style-1',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_service_archive_column', array(
                'section' => 'ogeko_service_archive',
                'label'   => esc_html__('Columns', 'ogeko'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('1', 'ogeko'),
                    '2' => esc_html__('2', 'ogeko'),
                    '3' => esc_html__('3', 'ogeko'),
                    '4' => esc_html__('4', 'ogeko'),
                ),
            ));

            $wp_customize->add_control('ogeko_options_service_archive_style', array(
                'section' => 'ogeko_service_archive',
                'label'   => esc_html__('Style', 'ogeko'),
                'type'    => 'select',
                'choices' => array(
                    'style-1' => esc_html__('Style 1', 'ogeko'),
                    'style-2' => esc_html__('Style 2', 'ogeko'),
                    'style-3' => esc_html__('Style 3', 'ogeko'),
                ),
            ));
        }

        public function init_ogeko_project($wp_customize) {

            $wp_customize->add_section('ogeko_project_archive', array(
                'title' => esc_html__('Project', 'ogeko'),
            ));

            $wp_customize->add_setting('ogeko_options_project_archive_column', array(
                'type'              => 'option',
                'default'           => '3',
                'sanitize_callback' => 'sanitize_text_field',
            ));

            $wp_customize->add_control('ogeko_options_project_archive_column', array(
                'section' => 'ogeko_project_archive',
                'label'   => esc_html__('Columns', 'ogeko'),
                'type'    => 'select',
                'choices' => array(
                    '1' => esc_html__('1', 'ogeko'),
                    '2' => esc_html__('2', 'ogeko'),
                    '3' => esc_html__('3', 'ogeko'),
                    '4' => esc_html__('4', 'ogeko'),
                ),
            ));

        }


    }
}
return new Ogeko_Customize();
