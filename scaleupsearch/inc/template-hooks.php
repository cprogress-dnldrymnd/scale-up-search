<?php
/**
 * =================================================
 * Hook ogeko_page
 * =================================================
 */
add_action('ogeko_page', 'ogeko_page_header', 10);
add_action('ogeko_page', 'ogeko_page_content', 20);

/**
 * =================================================
 * Hook ogeko_single_post_top
 * =================================================
 */
add_action('ogeko_single_post_top', 'ogeko_post_header', 5);
add_action('ogeko_single_post_top', 'ogeko_post_thumbnail', 10);

/**
 * =================================================
 * Hook ogeko_single_post
 * =================================================
 */
add_action('ogeko_single_post', 'ogeko_post_content', 30);

/**
 * =================================================
 * Hook ogeko_single_post_bottom
 * =================================================
 */
add_action('ogeko_single_post_bottom', 'ogeko_post_taxonomy', 5);
add_action('ogeko_single_post_bottom', 'ogeko_post_nav', 10);
add_action('ogeko_single_post_bottom', 'ogeko_display_comments', 20);

/**
 * =================================================
 * Hook ogeko_loop_post
 * =================================================
 */
add_action('ogeko_loop_post', 'ogeko_post_header', 15);
add_action('ogeko_loop_post', 'ogeko_post_content', 30);

/**
 * =================================================
 * Hook ogeko_footer
 * =================================================
 */
add_action('ogeko_footer', 'ogeko_footer_default', 20);

/**
 * =================================================
 * Hook ogeko_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'ogeko_template_account_dropdown', 1);
add_action('wp_footer', 'ogeko_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'ogeko_pingback_header', 1);

/**
 * =================================================
 * Hook ogeko_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook ogeko_before_content
 * =================================================
 */

/**
 * =================================================
 * Hook ogeko_content_top
 * =================================================
 */

/**
 * =================================================
 * Hook ogeko_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook ogeko_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook ogeko_sidebar
 * =================================================
 */
add_action('ogeko_sidebar', 'ogeko_get_sidebar', 10);

/**
 * =================================================
 * Hook ogeko_loop_after
 * =================================================
 */
add_action('ogeko_loop_after', 'ogeko_paging_nav', 10);

/**
 * =================================================
 * Hook ogeko_page_after
 * =================================================
 */
add_action('ogeko_page_after', 'ogeko_display_comments', 10);
