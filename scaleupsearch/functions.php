<?php
$theme         = wp_get_theme('ogeko');
$ogeko_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 980; /* pixels */
}
require get_theme_file_path('inc/class-tgm-plugin-activation.php');
$ogeko = (object)array(
    'version' => $ogeko_version,
    /**
     * Initialize all the things.
     */
    'main'    => require 'inc/class-main.php',
);

require get_theme_file_path('inc/functions.php');
require get_theme_file_path('inc/template-hooks.php');
require get_theme_file_path('inc/template-functions.php');

require_once get_theme_file_path('inc/merlin/vendor/autoload.php');
require_once get_theme_file_path('inc/merlin/class-merlin.php');
require_once get_theme_file_path('inc/merlin-config.php');

require_once get_theme_file_path('inc/class-customize.php');

if (ogeko_is_elementor_activated()) {
    require get_theme_file_path('inc/elementor/functions-elementor.php');
    $ogeko->elementor = require get_theme_file_path('inc/elementor/class-elementor.php');
    $ogeko->megamenu  = require get_theme_file_path('inc/megamenu/megamenu.php');
    $ogeko->parallax  = require get_theme_file_path('inc/elementor/section-parallax.php');
    require get_theme_file_path('inc/merlin/includes/service.php');
    require get_theme_file_path('inc/merlin/includes/project.php');
    require get_theme_file_path('inc/merlin/includes/parallax.php');
    if (defined('ELEMENTOR_PRO_VERSION')) {
        require get_theme_file_path('inc/elementor/class-elementor-pro.php');
    }

    if (function_exists('hfe_init')) {
        require get_theme_file_path('inc/header-footer-elementor/class-hfe.php');
        require get_theme_file_path('inc/merlin/includes/breadcrumb.php');
    }

}

if (!is_user_logged_in()) {
    require get_theme_file_path('inc/modules/class-login.php');
}
