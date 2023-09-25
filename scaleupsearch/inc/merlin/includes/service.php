<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Case_Study
 */
class Ogeko_Service {
    public $post_type = 'ogeko_service';
    public $taxonomy  = 'ogeko_service_cat';
    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Ogeko_Service)) {
            self::$instance = new Ogeko_Service();
        }

        return self::$instance;
    }

    public function __construct() {
        add_action('init', [$this, 'create_post_type']);
        add_action('init', [$this, 'create_taxonomy']);
        if (ogeko_is_cmb2_activated()) {
            add_action('init', [$this, 'setup_metabox']);
        }
    }

    public function setup_metabox() {
        add_action('cmb2_admin_init', [$this, 'metabox_service']);
    }

    public function metabox_service(){
        $cmb2 = new_cmb2_box(array(
            'id'           => 'ogeko_service_setting',
            'title'        => esc_html__('Infomation', 'ogeko'),
            'object_types' => array('ogeko_service'),
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Icon Image', 'ogeko'),
            'id'   => 'service_icon_image',
            'type' => 'file',
            'preview_size' => 'thumbnail',
        ));

        $cmb2->add_field(array(
            'name' => esc_html__('Description', 'ogeko'),
            'id'   => 'service_description',
            'type' => 'textarea_small',
        ));
    }


    /**
     * @return void
     */
    public function create_post_type() {

        $labels = array(
            'name'               => esc_html__('Services', 'ogeko'),
            'singular_name'      => esc_html__('Service', 'ogeko'),
            'add_new'            => esc_html__('Add New Service', 'ogeko'),
            'add_new_item'       => esc_html__('Add New Service', 'ogeko'),
            'edit_item'          => esc_html__('Edit Service', 'ogeko'),
            'new_item'           => esc_html__('New Service', 'ogeko'),
            'view_item'          => esc_html__('View Service', 'ogeko'),
            'search_items'       => esc_html__('Search Services', 'ogeko'),
            'not_found'          => esc_html__('No Services found', 'ogeko'),
            'not_found_in_trash' => esc_html__('No Services found in Trash', 'ogeko'),
            'parent_item_colon'  => esc_html__('Parent Service:', 'ogeko'),
            'menu_name'          => esc_html__('Services', 'ogeko'),
        );

        $labels     = apply_filters('ogeko_service_labels', $labels);
        $slug_field = apply_filters('ogeko_service_slug', 'service');

        register_post_type($this->post_type,
            array(
                'labels'        => $labels,
                'supports'      => array('title', 'editor', 'thumbnail'),
                'public'        => true,
                'has_archive'   => true,
                'rewrite'       => array('slug' => $slug_field),
                'menu_position' => 5,
                'categories'    => array(),
            )
        );
    }

    /**
     * @return void
     */
    public function create_taxonomy() {
        $labels = array(
            'name'              => esc_html__('Categories', 'ogeko'),
            'singular_name'     => esc_html__('Category', 'ogeko'),
            'search_items'      => esc_html__('Search Category', 'ogeko'),
            'all_items'         => esc_html__('All Categories', 'ogeko'),
            'parent_item'       => esc_html__('Parent Category', 'ogeko'),
            'parent_item_colon' => esc_html__('Parent Category:', 'ogeko'),
            'edit_item'         => esc_html__('Edit Category', 'ogeko'),
            'update_item'       => esc_html__('Update Category', 'ogeko'),
            'add_new_item'      => esc_html__('Add New Category', 'ogeko'),
            'new_item_name'     => esc_html__('New Category Name', 'ogeko'),
            'menu_name'         => esc_html__('Categories', 'ogeko'),
        );
        $labels = apply_filters('ogeko_service_cat_labels', $labels);

        $slug_cat_field = apply_filters('ogeko_cat_service_slug', 'service-cat');

        $args = array(
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'show_in_nav_menus' => true,
            'rewrite'           => array('slug' => $slug_cat_field)
        );
        // Now register the taxonomy
        register_taxonomy($this->taxonomy, array($this->post_type), $args);
    }

    public function get_term_service($post_id) {
        $terms = get_the_terms($post_id, $this->taxonomy);
        $output = '';
        if (!is_wp_error($terms) && is_array($terms)) {
            foreach ($terms as $key => $term) {
                $term_link = get_term_link($term);
                if (is_wp_error($term_link)) {
                    continue;
                }
                $output .= '<a href="' . esc_url($term_link) . '">' . $term->name . '</a>';
                if ($key < count($terms) - 1) {
                    $output .= ', ';
                }
            }

        }
        return $output;
    }

}

Ogeko_Service::getInstance();
