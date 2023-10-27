<article <?php post_class('project'); ?>>
    <div class="project-inner">
        <div class="project-post-thumbnail">
            <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('ogeko-project-grid'); ?>
            <?php endif; ?>
        </div><!-- .post-thumbnail -->
        <div class="project-content">
            <div class="project-content-left">
                <div class="entry-category"><?php echo Ogeko_Project::getInstance()->get_term_project(get_the_ID()); ?></div>
                <h5 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
            </div>
            <a class="button-icon project-content-right" href="<?php the_permalink(); ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.673" height="14.707"> <defs> <clipPath> <rect width="14.673" height="14.707" fill="#42c697"></rect> </clipPath> </defs> <g transform="translate(0 0)" clip-path="url(#clip-path)"> <path d="M12.43,0H0V3.652H8.355L6.513,5.489a1.684,1.684,0,0,0,0,2.382L7.991,9.352Q9.5,7.846,11.01,6.329c.007.147.018.265.018.382q.005,2.422,0,4.84c0,.945-.007,1.887.008,2.832V14.7c1.14.018,2.468,0,3.633,0V2.24A2.242,2.242,0,0,0,12.43,0" transform="translate(0 0)" fill="#42c697"></path> <path id="Path_19" d="M5.182,19.341l1.736,1.739a1.328,1.328,0,0,0,1.882,0l.007-.007a1.3,1.3,0,0,0,0-1.831L7.05,17.484c-1.405,1.4-.478.47-1.868,1.857" transform="translate(-2.865 -9.665)" fill="#42c697"></path> </g> </svg></a>
        </div>
    </div>
</article><!-- #post-## -->
