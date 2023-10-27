<?php

function breadcrumbs() {
    ob_start();
    if(is_archive()) {
        $title = get_queried_object()->name;
    } else {
        $title = get_the_title();
    }
    ?>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="<?= get_site_url() ?>">Home</a>
            </li>
            <li>
                <span href=""><?= $title ?></span>
            </li>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('breadcrumbs', 'breadcrumbs');