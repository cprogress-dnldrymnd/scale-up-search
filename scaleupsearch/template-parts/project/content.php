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
            <a class="button-icon project-content-right" href="<?php the_permalink(); ?>"><i class="ogeko-icon-arrow-right"></i></a>
        </div>
    </div>
</article><!-- #post-## -->
