<?php
add_action('wp_enqueue_scripts', 'scaleupsearch_child_enqueue_styles');
function scaleupsearch_child_enqueue_styles()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
}

require_once('includes/shortcodes.php');
