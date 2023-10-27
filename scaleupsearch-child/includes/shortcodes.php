<?php

function breadcrumbs() {
    ob_start();
    ?>
    <div class="breadcrumbs">
        <ul>
            <li>
                <a href="<?= get_site_url() ?>">Home</a>
            </li>
            <li>
                <span href=""><?= get_the_title() ?></span>
            </li>
        </ul>
    </div>
    <?php
    return ob_get_clean();
}

add_shortcode('breadcrumbs', 'breadcrumbs');