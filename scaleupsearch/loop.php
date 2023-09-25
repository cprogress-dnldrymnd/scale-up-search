<?php
/**
 * The loop template file.
 *
 * Included on pages like index.php, archive.php and search.php to display a loop of posts
 * Learn more: https://codex.wordpress.org/The_Loop
 *
 * @package ogeko
 */

do_action('ogeko_loop_before');

$blog_style  = ogeko_get_theme_option('blog_style');
$columns     = ogeko_get_theme_option('blog_columns', 3);
$check_style = $blog_style && $blog_style !== 'standard';
if ($check_style) {
    echo '<div class="blog-style-grid blog-grid-' . $blog_style . '" data-elementor-columns="' . esc_attr($columns) . '" data-elementor-columns-tablet="2" data-elementor-columns-mobile="1">';
}
//var_dump($blog_style);
$mumber = 0;
while (have_posts()) :
    the_post();
    if ($mumber == ($columns + 2)) $mumber = 0;
    /**
     * Include the Post-Format-specific template for the content.
     * If you want to override this in a child theme, then include a file
     * called content-___.php (where ___ is the Post Format name) and that will be used instead.
     */
    if ($check_style) {
        if ($blog_style == 'modern') {
            if ($mumber < $columns) {
                get_template_part('template-parts/posts-grid/item-post-style-4');
            } else {
                get_template_part('template-parts/posts-grid/item-post-style-5');
            }
            $mumber++;

        } else {
            get_template_part('template-parts/posts-grid/item-post-' . $blog_style);
        }

    } else {
        get_template_part('content', get_post_format());
    }

endwhile;

if ($check_style) {
    echo '</div>';
}

/**
 * Functions hooked in to ogeko_loop_after action
 *
 * @see ogeko_paging_nav - 10
 */
do_action('ogeko_loop_after');
