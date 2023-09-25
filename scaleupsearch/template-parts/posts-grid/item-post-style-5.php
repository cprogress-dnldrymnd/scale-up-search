<?php
$atts = array('show_date'    => false,
              'show_cat'     => true,
              'show_author'  => false,
              'show_comment' => false,)
?>

<div class="column-item post-style-5">
    <div class="post-inner">

        <div class="entry-thumbnail">
            <?php if (has_post_thumbnail()): ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('full'); ?>
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
        </div>
    </div>
</div>
