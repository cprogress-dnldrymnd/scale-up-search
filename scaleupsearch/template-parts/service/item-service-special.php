<div class="column-item service-style-special">
    <article <?php post_class('service'); ?>>
        <div class="service-inner">
            <?php $image = get_post_meta(get_the_ID(), 'service_icon_image', true); ?>
            <?php if ($image):
                $image_id = attachment_url_to_postid( $image );
                $alt = '';
                if($image_id) {
                    $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', TRUE);
                    $image_title = get_the_title($image_id);
                    $alt = $image_alt ? $image_alt: $image_title;
                }
                ?>
                <div class="service-post-thumbnail">
                    <img src="<?php echo esc_attr($image); ?>" alt="<?php echo esc_attr($alt); ?>">
                </div>
            <?php endif; ?>
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
    </article><!-- #post-## -->
</div>