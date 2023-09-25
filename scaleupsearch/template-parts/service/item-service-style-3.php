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
                        <span class="button-icon left">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.673" height="14.707">
                                <defs>
                                    <clipPath>
                                        <rect width="14.673" height="14.707" fill="#42c697" />
                                    </clipPath>
                                </defs>
                                <g transform="translate(0 0)" clip-path="url(#clip-path)">
                                    <path d="M12.43,0H0V3.652H8.355L6.513,5.489a1.684,1.684,0,0,0,0,2.382L7.991,9.352Q9.5,7.846,11.01,6.329c.007.147.018.265.018.382q.005,2.422,0,4.84c0,.945-.007,1.887.008,2.832V14.7c1.14.018,2.468,0,3.633,0V2.24A2.242,2.242,0,0,0,12.43,0" transform="translate(0 0)" fill="#42c697" />
                                    <path id="Path_19" d="M5.182,19.341l1.736,1.739a1.328,1.328,0,0,0,1.882,0l.007-.007a1.3,1.3,0,0,0,0-1.831L7.05,17.484c-1.405,1.4-.478.47-1.868,1.857" transform="translate(-2.865 -9.665)" fill="#42c697" />
                                </g>
                            </svg>
                        </span>
                        <span class="button-text"><?php echo esc_html__('Learn more', 'ogeko'); ?></span>
                        <span class="button-icon right">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="14.673" height="14.707">
                                <defs>
                                    <clipPath>
                                        <rect width="14.673" height="14.707" fill="#42c697" />
                                    </clipPath>
                                </defs>
                                <g transform="translate(0 0)" clip-path="url(#clip-path)">
                                    <path d="M12.43,0H0V3.652H8.355L6.513,5.489a1.684,1.684,0,0,0,0,2.382L7.991,9.352Q9.5,7.846,11.01,6.329c.007.147.018.265.018.382q.005,2.422,0,4.84c0,.945-.007,1.887.008,2.832V14.7c1.14.018,2.468,0,3.633,0V2.24A2.242,2.242,0,0,0,12.43,0" transform="translate(0 0)" fill="#42c697" />
                                    <path id="Path_19" d="M5.182,19.341l1.736,1.739a1.328,1.328,0,0,0,1.882,0l.007-.007a1.3,1.3,0,0,0,0-1.831L7.05,17.484c-1.405,1.4-.478.47-1.868,1.857" transform="translate(-2.865 -9.665)" fill="#42c697" />
                                </g>
                            </svg>
                        </span>
                    </span>
                </a>
            </div>
        </div>
    </article><!-- #post-## -->
</div>