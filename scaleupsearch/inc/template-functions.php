<?php

if (!function_exists('ogeko_display_comments')) {
    /**
     * Ogeko display comments
     *
     * @since  1.0.0
     */
    function ogeko_display_comments() {
        // If comments are open or we have at least one comment, load up the comment template.
        if (comments_open() || 0 !== intval(get_comments_number())) :
            comments_template();
        endif;
    }
}

if (!function_exists('ogeko_comment')) {
    /**
     * Zourney comment template
     *
     * @param array $comment the comment array.
     * @param array $args the comment args.
     * @param int $depth the comment depth.
     *
     * @since 1.0.0
     */
    function ogeko_comment($comment, $args, $depth) {
        if ('div' === $args['style']) {
            $tag       = 'div';
            $add_below = 'comment';
        } else {
            $tag       = 'li';
            $add_below = 'div-comment';
        }
        ?>
        <<?php echo esc_attr($tag) . ' '; ?><?php comment_class(empty($args['has_children']) ? '' : 'parent'); ?> id="comment-<?php comment_ID(); ?>">

        <div class="comment-body">
            <div class="comment-author vcard">
                <?php echo get_avatar($comment, 50); ?>
            </div>
            <?php if ('div' !== $args['style']) : ?>
            <div id="div-comment-<?php comment_ID(); ?>" class="comment-content">
                <?php endif; ?>
                <div class="comment-head">
                    <div class="comment-meta commentmetadata">
                        <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
                        <?php if ('0' === $comment->comment_approved) : ?>
                            <em class="comment-awaiting-moderation"><?php esc_attr_e('Your comment is awaiting moderation.', 'ogeko'); ?></em>
                            <br/>
                        <?php endif; ?>

                        <a href="<?php echo esc_url(htmlspecialchars(get_comment_link($comment->comment_ID))); ?>"
                           class="comment-date">
                            <?php echo '<time datetime="' . get_comment_date('c') . '">' . get_comment_date() . '</time>'; ?>
                        </a>
                    </div>
                    <div class="reply">
                        <?php
                        comment_reply_link(
                            array_merge(
                                $args, array(
                                    'add_below' => $add_below,
                                    'depth'     => $depth,
                                    'max_depth' => $args['max_depth'],
                                )
                            )
                        );
                        ?>
                        <?php edit_comment_link(esc_html__('Edit', 'ogeko'), '  ', ''); ?>
                    </div>
                </div>
                <div class="comment-text">
                    <?php comment_text(); ?>
                </div>
                <?php if ('div' !== $args['style']) : ?>
            </div>
        <?php endif; ?>
        </div>
        <?php
    }
}

if (!function_exists('ogeko_credit')) {
    /**
     * Display the theme credit
     *
     * @return void
     * @since  1.0.0
     */
    function ogeko_credit() {
        ?>
        <div class="site-info">
            <?php echo apply_filters('ogeko_copyright_text', $content = '&copy; ' . date('Y') . ' ' . '<a class="site-url" href="' . esc_url(site_url()) . '">' . esc_html(get_bloginfo('name')) . '</a>' . esc_html__('. All Rights Reserved.', 'ogeko')); ?>
        </div><!-- .site-info -->
        <?php
    }
}

if (!function_exists('ogeko_social')) {
    function ogeko_social() {
        $social_list = ogeko_get_theme_option('social_text', []);
        if (empty($social_list)) {
            return;
        }
        ?>
        <div class="ogeko-social">
            <ul>
                <?php

                foreach ($social_list as $social_item) {
                    ?>
                    <li><a href="<?php echo esc_url($social_item); ?>"></a></li>
                    <?php
                }
                ?>

            </ul>
        </div>
        <?php
    }
}

if (!function_exists('ogeko_site_branding')) {
    /**
     * Site branding wrapper and display
     *
     * @return void
     * @since  1.0.0
     */
    function ogeko_site_branding() {
        ?>
        <div class="site-branding">
            <?php echo ogeko_site_title_or_logo(); ?>
        </div>
        <?php
    }
}

if (!function_exists('ogeko_site_title_or_logo')) {
    /**
     * Display the site title or logo
     *
     * @param bool $echo Echo the string or return it.
     *
     * @return string
     * @since 2.1.0
     */
    function ogeko_site_title_or_logo() {
        ob_start();
        the_custom_logo(); ?>
        <div class="site-branding-text">
            <?php if (is_front_page()) : ?>
                <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                          rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>"
                                         rel="home"><?php bloginfo('name'); ?></a></p>
            <?php endif; ?>

            <?php
            $description = get_bloginfo('description', 'display');

            if ($description || is_customize_preview()) :
                ?>
                <p class="site-description"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div><!-- .site-branding-text -->
        <?php
        $html = ob_get_clean();
        return $html;
    }
}

if (!function_exists('ogeko_primary_navigation')) {
    /**
     * Display Primary Navigation
     *
     * @return void
     * @since  1.0.0
     */
    function ogeko_primary_navigation() {
        ?>
        <nav class="main-navigation" aria-label="<?php esc_html_e('Primary Navigation', 'ogeko'); ?>">
            <?php
            $args = apply_filters('ogeko_nav_menu_args', [
                'fallback_cb'     => '__return_empty_string',
                'theme_location'  => 'primary',
                'container_class' => 'primary-navigation',
            ]);
            wp_nav_menu($args);
            ?>
        </nav>
        <?php
    }
}

if (!function_exists('ogeko_mobile_navigation')) {
    /**
     * Display Handheld Navigation
     *
     * @return void
     * @since  1.0.0
     */
    function ogeko_mobile_navigation() {
        ?>
        <div class="mobile-nav-tabs">
            <ul>
                <?php if (isset(get_nav_menu_locations()['handheld'])) { ?>
                    <li class="mobile-tab-title mobile-pages-title active" data-menu="pages">
                        <span><?php echo esc_html(get_term(get_nav_menu_locations()['handheld'], 'nav_menu')->name); ?></span>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <nav class="mobile-menu-tab mobile-navigation mobile-pages-menu active"
             aria-label="<?php esc_html_e('Mobile Navigation', 'ogeko'); ?>">
            <?php
            wp_nav_menu(
                array(
                    'theme_location'  => 'handheld',
                    'container_class' => 'handheld-navigation',
                )
            );
            ?>
        </nav>
        <?php
    }
}

if (!function_exists('ogeko_homepage_header')) {
    /**
     * Display the page header without the featured image
     *
     * @since 1.0.0
     */
    function ogeko_homepage_header() {
        edit_post_link(esc_html__('Edit this section', 'ogeko'), '', '', '', 'button ogeko-hero__button-edit');
        ?>
        <header class="entry-header">
            <?php
            the_title('<h1 class="entry-title">', '</h1>');
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('ogeko_page_header')) {
    /**
     * Display the page header
     *
     * @since 1.0.0
     */
    function ogeko_page_header() {

        if (is_front_page() || !is_page_template('default')) {
            return;
        }

        if (ogeko_is_elementor_activated()) {
            if (Ogeko_breadcrumb::get_template_id() !== '') {
                return;
            }
        }

        ?>
        <header class="entry-header">
            <?php
            if (has_post_thumbnail()) {
                ogeko_post_thumbnail('full');
            }
            the_title('<h1 class="entry-title">', '</h1>');
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('ogeko_page_content')) {
    /**
     * Display the post content
     *
     * @since 1.0.0
     */
    function ogeko_page_content() {
        ?>
        <div class="entry-content">
            <?php the_content(); ?>
            <?php
            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'ogeko'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if (!function_exists('ogeko_post_header')) {
    /**
     * Display the post header with a link to the single post
     *
     * @since 1.0.0
     */
    function ogeko_post_header() {


        ?>
        <header class="entry-header">
            <?php
            if (is_single()) {
                ?>
                <div class="entry-meta">
                    <?php ogeko_post_meta(['show_cat' => true]); ?>
                </div>
                <?php
                the_title('<h1 class="gamma entry-title">', '</h1>');
            } else {
                ?>
                <div class="entry-meta">
                    <?php
                    ogeko_post_meta();
                    ?>
                </div>
                <?php
                the_title('<h4 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h4>');
            }
            ?>
        </header><!-- .entry-header -->
        <?php
    }
}

if (!function_exists('ogeko_post_content')) {
    /**
     * Display the post content with a link to the single post
     *
     * @since 1.0.0
     */
    function ogeko_post_content() {
        ?>
        <div class="entry-content">
            <?php

            /**
             * Functions hooked in to ogeko_post_content_before action.
             *
             */
            do_action('ogeko_post_content_before');


            if (is_single()) {
                the_content(
                    sprintf(
                    /* translators: %s: post title */
                        esc_html__('Read More', 'ogeko') . ' %s',
                        '<span class="screen-reader-text">' . get_the_title() . '</span>'
                    )
                );
            } else {
                the_excerpt();
                ?>
                <div>
                    <a class="more-link" href="<?php the_permalink() ?>">
                <span class="button-content-wrapper">
                    <span class="button-icon left"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.673" height="14.707"> <defs> <clipPath> <rect width="14.673" height="14.707" fill="#42c697"></rect> </clipPath> </defs> <g transform="translate(0 0)" clip-path="url(#clip-path)"> <path d="M12.43,0H0V3.652H8.355L6.513,5.489a1.684,1.684,0,0,0,0,2.382L7.991,9.352Q9.5,7.846,11.01,6.329c.007.147.018.265.018.382q.005,2.422,0,4.84c0,.945-.007,1.887.008,2.832V14.7c1.14.018,2.468,0,3.633,0V2.24A2.242,2.242,0,0,0,12.43,0" transform="translate(0 0)" fill="#42c697"></path> <path id="Path_19" d="M5.182,19.341l1.736,1.739a1.328,1.328,0,0,0,1.882,0l.007-.007a1.3,1.3,0,0,0,0-1.831L7.05,17.484c-1.405,1.4-.478.47-1.868,1.857" transform="translate(-2.865 -9.665)" fill="#42c697"></path> </g> </svg></span>
                    <span class="button-text"><?php echo esc_html__('Read more', 'ogeko'); ?></span>
                    <span class="button-icon right"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.673" height="14.707"> <defs> <clipPath> <rect width="14.673" height="14.707" fill="#42c697"></rect> </clipPath> </defs> <g transform="translate(0 0)" clip-path="url(#clip-path)"> <path d="M12.43,0H0V3.652H8.355L6.513,5.489a1.684,1.684,0,0,0,0,2.382L7.991,9.352Q9.5,7.846,11.01,6.329c.007.147.018.265.018.382q.005,2.422,0,4.84c0,.945-.007,1.887.008,2.832V14.7c1.14.018,2.468,0,3.633,0V2.24A2.242,2.242,0,0,0,12.43,0" transform="translate(0 0)" fill="#42c697"></path> <path id="Path_19" d="M5.182,19.341l1.736,1.739a1.328,1.328,0,0,0,1.882,0l.007-.007a1.3,1.3,0,0,0,0-1.831L7.05,17.484c-1.405,1.4-.478.47-1.868,1.857" transform="translate(-2.865 -9.665)" fill="#42c697"></path> </g> </svg></span>
                </span>
                    </a>
                </div>
            <?php }

            /**
             * Functions hooked in to ogeko_post_content_after action.
             *
             */
            do_action('ogeko_post_content_after');

            wp_link_pages(
                array(
                    'before' => '<div class="page-links">' . esc_html__('Pages:', 'ogeko'),
                    'after'  => '</div>',
                )
            );
            ?>
        </div><!-- .entry-content -->
        <?php
    }
}

if (!function_exists('ogeko_post_meta')) {
    /**
     * Display the post meta
     *
     * @since 1.0.0
     */
    function ogeko_post_meta($atts = array()) {
        global $post;
        if ('post' !== get_post_type()) {
            return;
        }

        extract(
            shortcode_atts(
                array(
                    'show_date'    => true,
                    'show_cat'     => false,
                    'show_author'  => true,
                    'show_comment' => false,
                ),
                $atts
            )
        );

        $posted_on = '';
        // Posted on.
        if ($show_date) {
            $posted_on = '<div class="posted-on">' . sprintf('<a href="%1$s" rel="bookmark">%2$s</a>', esc_url(get_permalink()), get_the_date()) . '</div>';
        }

        $categories_list = get_the_category_list(', ');
        $categories      = '';
        if ($show_cat && $categories_list) {
            // Make sure there's more than one category before displaying.
            $categories = '<div class="categories-link"><span class="screen-reader-text">' . esc_html__('Categories', 'ogeko') . '</span>' . $categories_list . '</div>';
        }
        $author = '';
        // Author.
        if ($show_author == 1) {
            $author_id = $post->post_author;
            $author    = sprintf(
                '<div class="post-author"><a href="%1$s" class="url fn" rel="author">%2$s</a></div>',
                esc_url(get_author_posts_url(get_the_author_meta('ID'))),
                esc_html(get_the_author_meta('display_name', $author_id))
            );
        }

        echo wp_kses(
            sprintf('%1$s %2$s %3$s', $categories, $posted_on, $author), array(
                'div'  => array(
                    'class' => array(),
                ),
                'span' => array(
                    'class' => array(),
                ),
                'i'    => array(
                    'class' => array(),
                ),
                'a'    => array(
                    'href'  => array(),
                    'rel'   => array(),
                    'class' => array(),
                ),
                'time' => array(
                    'datetime' => array(),
                    'class'    => array(),
                )
            )
        );

        if ($show_comment) { ?>
            <div class="meta-reply">
                <?php
                comments_popup_link(esc_html__('0 comments', 'ogeko'), esc_html__('1 comment', 'ogeko'), esc_html__('% comments', 'ogeko'));
                ?>
            </div>
            <?php
        }

    }
}

if (!function_exists('ogeko_get_allowed_html')) {
    function ogeko_get_allowed_html() {
        return apply_filters(
            'ogeko_allowed_html',
            array(
                'br'     => array(),
                'i'      => array(),
                'b'      => array(),
                'u'      => array(),
                'em'     => array(),
                'del'    => array(),
                'a'      => array(
                    'href'  => true,
                    'class' => true,
                    'title' => true,
                    'rel'   => true,
                ),
                'strong' => array(),
                'span'   => array(
                    'style' => true,
                    'class' => true,
                ),
            )
        );
    }
}

if (!function_exists('ogeko_edit_post_link')) {
    /**
     * Display the edit link
     *
     * @since 2.5.0
     */
    function ogeko_edit_post_link() {
        edit_post_link(
            sprintf(
                wp_kses(__('Edit <span class="screen-reader-text">%s</span>', 'ogeko'),
                    array(
                        'span' => array(
                            'class' => array(),
                        ),
                    )
                ),
                get_the_title()
            ),
            '<div class="edit-link">',
            '</div>'
        );
    }
}

if (!function_exists('ogeko_categories_link')) {
    /**
     * Prints HTML with meta information for the current cateogries
     */
    function ogeko_categories_link() {

        // Get Categories for posts.
        $categories_list = get_the_category_list('');

        if ('post' === get_post_type() && $categories_list) {
            // Make sure there's more than one category before displaying.
            echo '<div class="categories-link"><span class="screen-reader-text">' . esc_html__('Categories', 'ogeko') . '</span>' . $categories_list . '</div>';
        }
    }
}

if (!function_exists('ogeko_post_taxonomy')) {
    /**
     * Display the post taxonomies
     *
     * @since 2.4.0
     */
    function ogeko_post_taxonomy() {
        /* translators: used between list items, there is a space after the comma */

        /* translators: used between list items, there is a space after the comma */
        $tags_list = get_the_tag_list('', ' ');
        ?>
        <aside class="entry-taxonomy">
            <?php if ($tags_list) : ?>
                <div class="tags-links">
                    <span class="screen-reader-text"><?php echo esc_html(_n('Tag:', 'Tags:', count(get_the_tags()), 'ogeko')); ?></span>
                    <?php printf('%s', $tags_list); ?>
                </div>
            <?php endif;
            if (ogeko_is_elementor_activated()) {
                ogeko_social_share();
            }
            ?>
        </aside>
        <?php
    }
}

if (!function_exists('ogeko_paging_nav')) {
    /**
     * Display navigation to next/previous set of posts when applicable.
     */
    function ogeko_paging_nav() {
        global $wp_query;

        $args = array(
            'type'      => 'list',
            'next_text' => '<span>' . esc_html__('Next', 'ogeko') . '</span><i class="ogeko-icon ogeko-icon-angle-right"></i>',
            'prev_text' => '<i class="ogeko-icon ogeko-icon-angle-left"></i><span>' . esc_html__('Prev', 'ogeko') . '</span>',
        );

        the_posts_pagination($args);
    }
}

if (!function_exists('ogeko_post_nav')) {
    /**
     * Display navigation to next/previous post when applicable.
     */
    function ogeko_post_nav() {

        $prev_post      = get_previous_post();
        $next_post      = get_next_post();
        $args           = [];
        $thumbnail_prev = '';
        $thumbnail_next = '';

        if ($prev_post) {
            $thumbnail_prev = get_the_post_thumbnail($prev_post->ID, array(60, 60));
        };

        if ($next_post) {
            $thumbnail_next = get_the_post_thumbnail($next_post->ID, array(60, 60));
        };
        if ($next_post) {
            $args['next_text'] = '<span class="nav-content"><span class="reader-text">' . esc_html__('Next', 'ogeko') . '</span><span class="title">%title</span></span>' . $thumbnail_next;
        }
        if ($prev_post) {
            $args['prev_text'] = $thumbnail_prev . '<span class="nav-content"><span class="reader-text">' . esc_html__('Prev', 'ogeko') . ' </span><span class="title">%title</span></span> ';
        }

        the_post_navigation($args);

    }
}

if (!function_exists('ogeko_posted_on')) {
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     *
     * @deprecated 2.4.0
     */
    function ogeko_posted_on() {
        _deprecated_function('ogeko_posted_on', '2.4.0');
    }
}

if (!function_exists('ogeko_homepage_content')) {
    /**
     * Display homepage content
     * Hooked into the `homepage` action in the homepage template
     *
     * @return  void
     * @since  1.0.0
     */
    function ogeko_homepage_content() {
        while (have_posts()) {
            the_post();

            get_template_part('content', 'homepage');

        } // end of the loop.
    }
}

if (!function_exists('ogeko_get_sidebar')) {
    /**
     * Display ogeko sidebar
     *
     * @uses get_sidebar()
     * @since 1.0.0
     */
    function ogeko_get_sidebar() {
        get_sidebar();
    }
}

if (!function_exists('ogeko_post_thumbnail')) {
    /**
     * Display post thumbnail
     *
     * @param string $size the post thumbnail size.
     *
     * @uses has_post_thumbnail()
     * @uses the_post_thumbnail
     * @var $size thumbnail size. thumbnail|medium|large|full|$custom
     * @since 1.5.0
     */
    function ogeko_post_thumbnail($size = 'post-thumbnail') {
        if (has_post_thumbnail()) {
            echo '<div class="post-thumbnail">';
            the_post_thumbnail($size ? $size : 'post-thumbnail');
            echo '</div>';
        }
    }
}

if (!function_exists('ogeko_primary_navigation_wrapper')) {
    /**
     * The primary navigation wrapper
     */
    function ogeko_primary_navigation_wrapper() {
        echo '<div class="ogeko-primary-navigation"><div class="col-full">';
    }
}

if (!function_exists('ogeko_primary_navigation_wrapper_close')) {
    /**
     * The primary navigation wrapper close
     */
    function ogeko_primary_navigation_wrapper_close() {
        echo '</div></div>';
    }
}

if (!function_exists('ogeko_header_container')) {
    /**
     * The header container
     */
    function ogeko_header_container() {
        echo '<div class="col-full">';
    }
}

if (!function_exists('ogeko_header_container_close')) {
    /**
     * The header container close
     */
    function ogeko_header_container_close() {
        echo '</div>';
    }
}

if (!function_exists('ogeko_header_custom_link')) {
    function ogeko_header_custom_link() {
        echo ogeko_get_theme_option('custom-link', '');
    }

}

if (!function_exists('ogeko_header_contact_info')) {
    function ogeko_header_contact_info() {
        echo ogeko_get_theme_option('contact-info', '');
    }

}

if (!function_exists('ogeko_header_account')) {
    function ogeko_header_account() {

        if (!ogeko_get_theme_option('show_header_account', true)) {
            return;
        }

        $account_link = wp_login_url();
        ?>
        <div class="site-header-account">
            <a href="<?php echo esc_url($account_link); ?>">
                <i class="ogeko-icon-account"></i>
                <span class="account-content">
                    <?php
                    if (!is_user_logged_in()) {
                        esc_attr_e('Sign in', 'ogeko');
                    } else {
                        $user = wp_get_current_user();
                        echo esc_html($user->display_name);
                    }

                    ?>
                </span>
            </a>
            <div class="account-dropdown">

            </div>
        </div>
        <?php
    }

}

if (!function_exists('ogeko_template_account_dropdown')) {
    function ogeko_template_account_dropdown() {
        if (!ogeko_get_theme_option('show_header_account', true)) {
            return;
        }
        ?>
        <div class="account-wrap d-none">
            <div class="account-inner <?php if (is_user_logged_in()): echo "dashboard"; endif; ?>">
                <?php if (!is_user_logged_in()) {
                    ogeko_form_login();
                } else {
                    ogeko_account_dropdown();
                }
                ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('ogeko_form_login')) {
    function ogeko_form_login() {
        ?>
        <div class="login-form-head">
            <span class="login-form-title"><?php esc_attr_e('Sign in', 'ogeko') ?></span>
            <span class="pull-right">
                <a class="register-link" href="<?php echo esc_url(wp_registration_url()); ?>"
                   title="<?php esc_attr_e('Register', 'ogeko'); ?>"><?php esc_attr_e('Create an Account', 'ogeko'); ?></a>
            </span>
        </div>
        <form class="ogeko-login-form-ajax" data-toggle="validator">
            <p>
                <label><?php esc_attr_e('Username or email', 'ogeko'); ?> <span class="required">*</span></label>
                <input name="username" type="text" required placeholder="<?php esc_attr_e('Username', 'ogeko') ?>">
            </p>
            <p>
                <label><?php esc_attr_e('Password', 'ogeko'); ?> <span class="required">*</span></label>
                <input name="password" type="password" required
                       placeholder="<?php esc_attr_e('Password', 'ogeko') ?>">
            </p>
            <button type="submit" data-button-action
                    class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e('Login', 'ogeko') ?></button>
            <input type="hidden" name="action" value="ogeko_login">
            <?php wp_nonce_field('ajax-ogeko-login-nonce', 'security-login'); ?>
        </form>
        <div class="login-form-bottom">
            <a href="<?php echo wp_lostpassword_url(get_permalink()); ?>" class="lostpass-link"
               title="<?php esc_attr_e('Lost your password?', 'ogeko'); ?>"><?php esc_attr_e('Lost your password?', 'ogeko'); ?></a>
        </div>
        <?php
    }
}

if (!function_exists('')) {
    function ogeko_account_dropdown() { ?>
        <?php if (has_nav_menu('my-account')) : ?>
            <nav class="social-navigation" aria-label="<?php esc_attr_e('Dashboard', 'ogeko'); ?>">
                <?php
                wp_nav_menu(array(
                    'theme_location' => 'my-account',
                    'menu_class'     => 'account-links-menu',
                    'depth'          => 1,
                ));
                ?>
            </nav><!-- .social-navigation -->
        <?php else: ?>
            <ul class="account-dashboard">
                <li>
                    <a href="<?php echo esc_url(get_dashboard_url(get_current_user_id())); ?>"
                       title="<?php esc_html_e('Dashboard', 'ogeko'); ?>"><?php esc_html_e('Dashboard', 'ogeko'); ?></a>
                </li>
                <li>
                    <a title="<?php esc_html_e('Log out', 'ogeko'); ?>" class="tips"
                       href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Log Out', 'ogeko'); ?></a>
                </li>
            </ul>
        <?php endif;

    }
}

if (!function_exists('ogeko_header_search_popup')) {
    function ogeko_header_search_popup() {
        ?>
        <div class="site-search-popup">
            <div class="site-search-popup-wrap">
                <a href="#" class="site-search-popup-close"><i class="ogeko-icon-times-circle"></i></a>
                <div class="site-search">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
        <div class="site-search-popup-overlay"></div>
        <?php
    }
}

if (!function_exists('ogeko_header_search_button')) {
    function ogeko_header_search_button() {

        add_action('wp_footer', 'ogeko_header_search_popup', 1);
        ?>
        <div class="site-header-search">
            <a href="#" class="button-search-popup"><i class="ogeko-icon-search-1"></i></a>
        </div>
        <?php
    }
}


if (!function_exists('ogeko_header_sticky')) {
    function ogeko_header_sticky() {
        get_template_part('template-parts/header', 'sticky');
    }
}

if (!function_exists('ogeko_mobile_nav')) {
    function ogeko_mobile_nav() {
        if (isset(get_nav_menu_locations()['handheld'])) {
            ?>
            <div class="ogeko-mobile-nav">
                <div class="menu-scroll-mobile">
                    <a href="#" class="mobile-nav-close"><i class="ogeko-icon-times"></i></a>
                    <?php
                    ogeko_mobile_navigation();
                    ogeko_social();
                    ?>
                </div>
            </div>
            <div class="ogeko-overlay"></div>
            <?php
        }
    }
}

if (!function_exists('ogeko_mobile_nav_button')) {
    function ogeko_mobile_nav_button() {
        if (isset(get_nav_menu_locations()['handheld'])) {
            ?>
            <a href="#" class="menu-mobile-nav-button">
				<span
                        class="toggle-text screen-reader-text"><?php echo esc_attr(apply_filters('ogeko_menu_toggle_text', esc_html__('Menu', 'ogeko'))); ?></span>
                <div class="ogeko-icon">
                    <span class="icon-1"></span>
                    <span class="icon-2"></span>
                    <span class="icon-3"></span>
                </div>
            </a>
            <?php
        }
    }
}

if (!function_exists('ogeko_footer_default')) {
    function ogeko_footer_default() {
        get_template_part('template-parts/copyright');
    }
}


if (!function_exists('ogeko_pingback_header')) {
    /**
     * Add a pingback url auto-discovery header for single posts, pages, or attachments.
     */
    function ogeko_pingback_header() {
        if (is_singular() && pings_open()) {
            echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
        }
    }
}

if (!function_exists('ogeko_social_share')) {
    function ogeko_social_share() {
        get_template_part('template-parts/socials');
    }
}

if (!function_exists('ogeko_update_comment_fields')) {
    function ogeko_update_comment_fields($fields) {

        $commenter = wp_get_current_commenter();
        $req       = get_option('require_name_email');
        $aria_req  = $req ? "aria-required='true'" : '';

        $fields['author']
            = '<p class="comment-form-author">
			<input id="author" name="author" type="text" placeholder="' . esc_attr__("Your Name *", "ogeko") . '" value="' . esc_attr($commenter['comment_author']) .
              '" size="30" ' . $aria_req . ' />
		</p>';

        $fields['email']
            = '<p class="comment-form-email">
			<input id="email" name="email" type="email" placeholder="' . esc_attr__("Email Address *", "ogeko") . '" value="' . esc_attr($commenter['comment_author_email']) .
              '" size="30" ' . $aria_req . ' />
		</p>';

        $fields['url']
            = '<p class="comment-form-url">
			<input id="url" name="url" type="url"  placeholder="' . esc_attr__("Your Website", "ogeko") . '" value="' . esc_attr($commenter['comment_author_url']) .
              '" size="30" />
			</p>';

        return $fields;
    }
}

add_filter('comment_form_default_fields', 'ogeko_update_comment_fields');


function ogeko_replace_categories_list($output, $args) {
    if ($args['show_count'] = 1) {
        $pattern     = '#<li([^>]*)><a([^>]*)>(.*?)<\/a>\s*\(([0-9]*)\)\s*#i';  // removed ( and )
        $replacement = '<li$1><a$2><span class="cat-name">$3</span> <span class="cat-count">($4)</span></a>';
        return preg_replace($pattern, $replacement, $output);
    }
    return $output;
}

add_filter('wp_list_categories', 'ogeko_replace_categories_list', 10, 2);

function ogeko_replace_archive_list($link_html, $url, $text, $format, $before, $after, $selected) {
    if ($format == 'html') {
        $pattern     = '#<li><a([^>]*)>(.*?)<\/a>&nbsp;\s*\(([0-9]*)\)\s*#i';  // removed ( and )
        $replacement = '<li><a$1><span class="archive-name">$2</span> <span class="archive-count">($3)</span></a>';
        return preg_replace($pattern, $replacement, $link_html);
    }
    return $link_html;
}

add_filter('get_archives_link', 'ogeko_replace_archive_list', 10, 7);


add_filter('bcn_breadcrumb_title', 'ogeko_breadcrumb_title_swapper', 3, 10);
function ogeko_breadcrumb_title_swapper($title, $type, $id) {
    if (in_array('home', $type)) {
        $title = esc_html__('Home', 'ogeko');
    }
    return $title;
}

function ogeko_get_icon_svg($path, $color = '', $width = '') {
    $content = ogeko_get_file_contents($path);
    if ($content) {
        $re = '/<svg(([^\n]*\n)+)<\/svg>/';
        preg_match_all($re, $content, $matches, PREG_SET_ORDER, 0);
        if (count($matches) > 0) {
            $content = $matches[0][0];
            $css     = '';
            if ($color) {
                $content = preg_replace('/stroke="[^"]*"/', 'stroke="' . $color . '"', $content);
                $css     .= 'fill:' . $color . ';';
            }
            if ($width) {
                $css .= 'width:' . $width . '; height: auto;';
            }
            $content = preg_replace("/(<svg[^>]*)(style=(\"|')([^(\"|')]*)('|\"))/m", '$1 style="' . $css . '$4"', $content);
        }
    }
    return $content;
}

function ogeko_get_file_contents($path) {
    if (is_file($path)) {
        $prifix = 'file_get_contents';
        return $prifix($path);
    }
    return false;
}