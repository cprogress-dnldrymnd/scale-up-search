<div class="column-item service-style-4">
    <article <?php post_class('service'); ?>>
        <div class="service-inner">
            <div class="service-post-thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('ogeko-service-grid'); ?>
                <?php endif; ?>
            </div><!-- .post-thumbnail -->
            <div class="service-content">
                <span class="service-date"><?php echo get_the_date( '', get_the_ID() ); ?> </span>
                <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
            </div>
        </div>
    </article><!-- #post-## -->
</div>