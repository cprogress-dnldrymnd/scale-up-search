<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class OSF_Custom_Post_Type_Case_Study
 */
class Ogeko_Project {
    public $post_type = 'ogeko_project';
    public $taxonomy  = 'ogeko_project_cat';
    static $instance;

    public static function getInstance() {
        if (!isset(self::$instance) && !(self::$instance instanceof Ogeko_Project)) {
            self::$instance = new Ogeko_Project();
        }

        return self::$instance;
    }

    public function __construct() {
        add_action('init', [$this, 'create_post_type']);
        add_action('init', [$this, 'create_taxonomy']);
        if (ogeko_is_cmb2_activated()) {
            add_action('init', [$this, 'setup_metabox']);
        }

        add_action('wp_ajax_ogeko_ajax_loadmore_project', array($this, 'ajax_get_more_post'));
        add_action('wp_ajax_nopriv_ogeko_ajax_loadmore_project', array($this, 'ajax_get_more_post'));
    }

    public function setup_metabox() {
        add_action('cmb2_admin_init', [$this, 'metabox_project']);
    }

    public function metabox_project() {
        $cmb2 = new_cmb2_box(array(
            'id'           => 'ogeko_project_setting',
            'title'        => esc_html__('Infomation', 'ogeko'),
            'object_types' => array('ogeko_project'),
        ));
        $cmb2->add_field(array(
            'name' => esc_html__('Client', 'ogeko'),
            'id'   => 'project_client',
            'type' => 'text',
        ));
        $cmb2->add_field(array(
            'name' => esc_html__('Location', 'ogeko'),
            'id'   => 'project_location',
            'type' => 'text',
        ));
        $cmb2->add_field(array(
            'name' => esc_html__('Website', 'ogeko'),
            'id'   => 'project_website',
            'type' => 'text_url',
        ));
    }

    /**
     * @return void
     */
    public function create_post_type() {

        $labels = array(
            'name'               => esc_html__('Projects', 'ogeko'),
            'singular_name'      => esc_html__('Project', 'ogeko'),
            'add_new'            => esc_html__('Add New Project', 'ogeko'),
            'add_new_item'       => esc_html__('Add New Project', 'ogeko'),
            'edit_item'          => esc_html__('Edit Project', 'ogeko'),
            'new_item'           => esc_html__('New Project', 'ogeko'),
            'view_item'          => esc_html__('View Project', 'ogeko'),
            'search_items'       => esc_html__('Search Projects', 'ogeko'),
            'not_found'          => esc_html__('No Projects found', 'ogeko'),
            'not_found_in_trash' => esc_html__('No Projects found in Trash', 'ogeko'),
            'parent_item_colon'  => esc_html__('Parent Project:', 'ogeko'),
            'menu_name'          => esc_html__('Projects', 'ogeko'),
        );

        $labels     = apply_filters('ogeko_project_labels', $labels);
        $slug_field = apply_filters('ogeko_project_slug', 'project');

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
        $labels = apply_filters('ogeko_project_cat_labels', $labels);

        $slug_cat_field = apply_filters('ogeko_cat_project_slug', 'project-cat');

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

    public function get_term_project($post_id) {
        $terms  = get_the_terms($post_id, $this->taxonomy);
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

    public function ajax_get_more_post() {
        $response            = [];
        $query_args          = $_POST['data'];
        $query_args['paged'] = $_POST['paged'] + 1;
        $posts               = new WP_Query($query_args);

        if ($posts->have_posts()) {
            while ($posts->have_posts()) {
                $posts->the_post();
                ob_start();
                $item_classes = '__all ';
                $item_cats    = get_the_terms(get_the_ID(), 'ogeko_project_cat');
                foreach ((array)$item_cats as $item_cat) {
                    if (!empty($item_cats) && !is_wp_error($item_cats)) {
                        $item_classes .= $item_cat->slug . ' ';
                    }
                }
                echo '<div class="column-item project-entries ' . esc_attr($item_classes) . '">';
                get_template_part('template-parts/project/content');
                echo '</div>';
                $response['posts'][] = ob_get_clean();
            }
            $response['disable']  = false;
            $response['settings'] = $query_args;
            $response['paged']    = $query_args['paged'];
            if ($query_args['paged'] == $posts->max_num_pages) {
                $response['disable'] = true;
            }
        }

        wp_send_json($response);
    }

}

Ogeko_Project::getInstance();
