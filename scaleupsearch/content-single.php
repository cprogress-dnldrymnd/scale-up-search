<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="single-content">
            <?php
            /**
             * Functions hooked in to ogeko_single_post_top action
             * @see ogeko_post_header           - 5
             * @see ogeko_post_thumbnail        - 10
             */
            do_action('ogeko_single_post_top');

            /**
             * Functions hooked in to ogeko_single_post action
             *
             * @see ogeko_post_content         - 30
             */
            do_action('ogeko_single_post');

            /**
             * Functions hooked in to ogeko_single_post_bottom action
             *
             * @see ogeko_post_taxonomy         - 5
             * @see ogeko_post_nav              - 10
             * @see ogeko_display_comments      - 20
             */
            do_action('ogeko_single_post_bottom');
            ?>

    </div>

</article><!-- #post-## -->
