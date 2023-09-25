<?php
get_header(); ?>

    <div id="primary" class="content">
        <main id="main" class="site-main">
            <div class="error-404 not-found">
                <div class="error-img404">
                    <img src="<?php echo get_theme_file_uri('assets/images/404/404.png') ?>" alt="<?php echo esc_attr__('404 Page', 'ogeko') ?>">
                </div>
                <div class="page-content">
                    <header class="page-header">
                        <h2 class="sub-title"><?php esc_html_e('Page is not found', 'ogeko'); ?></h2>
                    </header><!-- .page-header -->

                    <div class="error-text">
                        <span><?php esc_html_e("We're not being able to find the page you're looking for", 'ogeko') ?></span>

                    </div>
                    <div class="button-error">
                        <div class="button-error-content">
                            <a href="javascript: history.go(-1)" class="go-back"><?php esc_html_e('', 'ogeko'); ?>
                                <span class="elementor-button-icon left"><i aria-hidden="true" class="ogeko-icon- ogeko-icon-arrow-right"></i></span>
                                <span class="elementor-button-text">Back To Home</span>
                                <span class="elementor-button-icon right"><i aria-hidden="true" class="ogeko-icon- ogeko-icon-arrow-right"></i></span>
                            </a>
                        </div>
                    </div>
                </div><!-- .page-content -->
            </div><!-- .error-404 -->
        </main><!-- #main -->
    </div><!-- #primary -->
<?php
get_footer();
