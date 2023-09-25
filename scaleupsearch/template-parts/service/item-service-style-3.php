<div class="column-item service-style-3">
    <article <?php post_class('service'); ?>>
        <div class="service-inner">
            <div class="service-post-thumbnail">
                <?php if (has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('ogeko-service-grid'); ?>
                <?php endif; ?>
            </div><!-- .post-thumbnail -->
            <div class="service-content">
                <span class="count"><?php echo sprintf("%02d", $count); ?></span>
                <h6 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h6>
                <div class="description">
                    <?php echo get_post_meta(get_the_ID(), 'service_description', true); ?>
                </div>

                <a class="button-more-link" href="<?php the_permalink() ?>">
                    <span class="button-content-wrapper">
                        <span class="button-icon left"><i class="ogeko-icon-arrow-right"></i></span>
                        <span class="button-text"><?php echo esc_html__('Learn more', 'ogeko'); ?></span>
                        <span class="button-icon right"><i class="ogeko-icon-arrow-right"></i></span>
                    </span>
                </a>
            </div>
        </div>
    </article><!-- #post-## -->
</div>