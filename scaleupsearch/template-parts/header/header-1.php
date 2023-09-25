<header id="masthead" class="site-header header-1" role="banner">
    <div class="header-container">
        <div class="container header-main">
            <div class="header-left">
                <?php
                ogeko_site_branding();
                ?>
                <?php ogeko_mobile_nav_button(); ?>
            </div>
            <div class="header-center">
                <?php ogeko_primary_navigation(); ?>
            </div>
            <div class="header-right desktop-hide-down">
                <div class="header-group-action">
                    <?php
                    ogeko_header_account();
                    ?>
                </div>
            </div>
        </div>
    </div>
</header><!-- #masthead -->
