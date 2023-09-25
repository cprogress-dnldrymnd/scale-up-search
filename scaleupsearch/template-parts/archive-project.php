<main class="site-main">
    <div class="container clearfix">
        <?php if (apply_filters('ogeko_page_title', true)) : ?>
            <header class="page-header text-center">
                <?php
                the_archive_title('<h1 class="entry-title">', '</h1>');
                the_archive_description('<p class="archive-description">', '</p>');
                ?>
            </header>
        <?php endif; ?>
        <div id="primary" class="content-area">

            <?php
            $column = ogeko_get_theme_option('project_archive_column', 3);
            echo '<div class="row" data-elementor-columns="' . esc_attr($column) . '" data-elementor-columns-tablet="2" data-elementor-columns-mobile="1">';

            while (have_posts()) : the_post();
                ?>
                <div class="column-item project-entries">
                    <?php get_template_part('template-parts/project/content'); ?>
                </div>
                <?php
            endwhile;
            echo '</div>';
            $args = array(
                'type'      => 'list',
                'next_text' => '<i class="ogeko-icon-angle-right"></i>',
                'prev_text' => '<i class="ogeko-icon-angle-left"></i>',
            );

            the_posts_pagination($args);
            ?>
        </div>
    </div>
</main>
