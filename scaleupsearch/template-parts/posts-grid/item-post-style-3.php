<?php
$atts = array('show_date'    => true,
              'show_cat'     => false,
              'show_author'  => false,
              'show_comment' => false,)
?>
<div class="column-item post-style-3">
    <div class="post-inner">
        <div class="entry-thumbnail">
            <?php if (has_post_thumbnail()): ?>
                <div class="post-thumbnail">
                    <?php the_post_thumbnail('ogeko-post-grid'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="post-content">
            <div class="entry-header">
                <div class="entry-meta">
                    <?php ogeko_post_meta($atts); ?>
                </div>
                <?php the_title(sprintf('<h4 class="entry-title omega"><a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a></h4>'); ?>
            </div>
        </div>
    </div>
</div>
