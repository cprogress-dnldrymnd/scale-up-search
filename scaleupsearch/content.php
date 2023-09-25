<article id="post-<?php the_ID(); ?>" <?php post_class('article-default'); ?>>
    <div class="entry-thumbnail">
        <?php ogeko_post_thumbnail('post-thumbnail'); ?>
        <?php
        $atts = array('show_date'    => false,
                      'show_cat'     => true,
                      'show_author'  => false,
                      'show_comment' => false,);
        ogeko_post_meta($atts);
        ?>
    </div>

    <div class="post-content">
        <?php
        /**
         * Functions hooked in to ogeko_loop_post action.
         *
         * @see ogeko_post_header          - 15
         * @see ogeko_post_content         - 30
         */
        do_action('ogeko_loop_post');
        ?>
    </div>

</article><!-- #post-## -->

