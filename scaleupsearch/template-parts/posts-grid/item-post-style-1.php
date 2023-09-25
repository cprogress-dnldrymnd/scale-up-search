<?php
$atts = array('show_date'    => false,
              'show_cat'     => true,
              'show_author'  => false,
              'show_comment' => false,)
?>

<div class="column-item post-style-1">
    <div class="post-inner">

        <div class="entry-thumbnail">
            <?php if (has_post_thumbnail()): ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('ogeko-post-grid'); ?>
                </div>
            <?php endif; ?>
            <?php ogeko_post_meta($atts); ?>
        </div>

        <div class="post-content">
            <div class="entry-header">
                <div class="entry-meta">
                    <?php ogeko_post_meta(); ?>
                </div>
                <?php the_title(sprintf('<h5 class="entry-title omega"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h5>'); ?>
            </div>
            <div class="entry-content">
                <p><?php echo wp_trim_words(wp_kses_post(get_the_excerpt()), 30); ?></p>
                <div>
                    <a class="more-link" href="<?php the_permalink() ?>">
                <span class="button-content-wrapper">
                    <span class="button-icon left"><i class="ogeko-icon-arrow-right"></i></span>
                    <span class="button-text"><?php echo esc_html__('Read more', 'ogeko'); ?></span>
                    <span class="button-icon right"><i class="ogeko-icon-arrow-right"></i></span>
                </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
