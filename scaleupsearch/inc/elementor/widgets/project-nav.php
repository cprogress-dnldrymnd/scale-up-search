<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Class Project
 */
class Ogeko_Elementor_Project_Nav extends Elementor\Widget_Base
{

    public function get_name()
    {
        return 'ogeko-project-nav';
    }

    public function get_title()
    {
        return esc_html__('Ogeko Single Project Navigation', 'ogeko');
    }

    public function get_icon()
    {
        return 'eicon-gallery-grid';
    }

    public function get_categories()
    {
        return array('ogeko-addons');
    }


    protected function register_controls()
    {
        $this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Label', 'ogeko'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .button-project-nav .icon',
            ]
        );

        $this->add_control(
            'nav_color',
            [
                'label' => esc_html__('Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button-project-nav .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'nav_color_hover',
            [
                'label' => esc_html__('Color Hover', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button-project-nav:hover .icon' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_title',
            [
                'label' => esc_html__('Title', 'ogeko'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .button-project-nav .title',
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Color', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button-project-nav .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'title_color_hover',
            [
                'label' => esc_html__('Color Hover', 'ogeko'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .button-project-nav:hover .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->end_controls_section();
    }


    public function render()
    {

        $obj = $this->ogeko_get_post_link();
        $prev_link = $obj->previous_post;
        $next_link = $obj->next_post;
        $prev_title = $obj->previous_title;
        $next_title = $obj->next_title;

        if (!empty($prev_link) || !empty($next_link)):
            ?>
            <div class="single-project-navigation">
                <?php if (!empty($prev_link)): ?>
                    <div class="prev">
                        <a class="button-project-nav" href="<?php echo esc_url($prev_link); ?>">
                            <span class="icon">
                                <i class="ogeko-icon-angle-left"></i>
                            </span>
                            <span class="content">
                                <span class="reader-text"><?php echo esc_html__('Previous', 'ogeko') ?></span>
                                <span class="title"><?php echo esc_html($prev_title) ?></span>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (!empty($next_link)): ?>
                    <div class="next">
                        <a class="button-project-nav" href="<?php echo esc_url($next_link); ?>">
                            <span class="content">
                                <span class="reader-text"><?php echo esc_html__('Next', 'ogeko') ?></span>
                                <span class="title"><?php echo esc_html($next_title) ?></span>
                            </span>
                            <span class="icon">
                                <i class="ogeko-icon-angle-right"></i>
                            </span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif;
    }

    public function ogeko_get_post_link($taxonomy = 'ogeko_project_cat', $post_type = 'ogeko_project')
    {

        $id = get_queried_object_id(); // Get the current post ID
        $links = [
            'previous_post' => null,
            'previous_title' => null,
            'next_post' => null,
            'next_title' => null,
            'previous' => null,
            'next' => null
        ];

        // Use a tax_query to get all posts from the given term
        // Just retrieve the ids to speed up the query
        $post_args = [
            'post_type' => $post_type,
            'fields' => 'ids',
            'posts_per_page' => -1,
        ];

        // Get all the posts having the given term from all post types
        $q = get_posts($post_args);

        //Get the current post position. Will be used to determine next/previous post
        $current_post_position = array_search($id, $q);

        // Get the previous/older post ID
        if (array_key_exists($current_post_position + 1, $q)) {
            $previous = $q[$current_post_position + 1];
        }
        // Get post title link to the previous post
        if (isset($previous)) {
            $previous_post_link = get_permalink($previous);
        }
        if (isset($previous)) {
            $previous_post = get_post($previous);
            $previous_title = $previous_post->post_title;
        }

        // Get the next/newer post ID
        if (array_key_exists($current_post_position - 1, $q)) {
            $next = $q[$current_post_position - 1];
        }

        // Get post title link to the next post
        if (isset($next)) {
            $next_post_link = get_permalink($next);
        }
        if (isset($next)) {
            $next_post = get_post($next);
            $next_title = $next_post->post_title;
        }

        if (isset($previous_post_link)) {
            $links['previous_post'] = $previous_post_link;

        }
        if (isset($previous_post_link)) {
            $links['previous_title'] = $previous_title;

        }

        if (isset($next_post_link)) {
            $links['next_post'] = $next_post_link;
        }
        if (isset($next_post_link)) {
            $links['next_title'] = $next_title;
        }

        return (object)$links;
    }


}

$widgets_manager->register(new Ogeko_Elementor_Project_Nav());
