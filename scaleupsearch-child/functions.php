<?php
add_action('wp_enqueue_scripts', 'scaleupsearch_child_enqueue_styles');
function scaleupsearch_child_enqueue_styles()
{
	wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');
	if (is_post_type_archive('joblistings')) {
		wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
		wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js');
	}
}

require_once('includes/shortcodes.php');
/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
	require_once('includes/post-meta.php');
}


require_once('includes/post-types.php');


function action_wp_footer()
{
	if (isset($_GET['form']) && $_GET['form'] == 'find-a-role') {
?>
		<script>
			jQuery(document).ready(function() {
				setTimeout(function() {
					jQuery('#elementor-tab-title-8222').click();
				}, 300);
			});
		</script>
<?php
	}
}

add_action('wp_footer', 'action_wp_footer');
