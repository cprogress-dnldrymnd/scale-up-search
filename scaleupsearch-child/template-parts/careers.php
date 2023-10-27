<?php
$terms = _get_terms_details('careers-category');
$main_query = get_queried_object();
?>
<main id="main">
    <section class="careers-archive background-light">
        <div class="container container wide w-960">
            <div class="head">
                <?= do_shortcode('[trx_sc_layouts layout="22454"]') ?>
            </div>
            <?php if ($terms) { ?>
                <div class="category-wrapper text-center">

                    <div class="inner d-inline-block">
                        <a class="<?= is_post_type_archive() ? 'selected' : '' ?>" href="<?= get_post_type_archive_link('careers') ?>">
                            All
                        </a>
                        <?php foreach ($terms as $key => $term) { ?>
                            <?php
                            if ($main_query->term_id == $key) {
                                $selected = 'selected';
                            } else {
                                $selected = '';
                            }
                            ?>
                            <a class="<?= $selected ?>" href="<?= get_term_link($key) ?>"> <?= $term['name'] ?> </a>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>
            <div id="results">
                <div class="results-holder">
                    <div class="career-wrapper">
                        <?php
                        while (have_posts()) {
                            the_post(); ?>
                            <?php
                            $postterms = get_the_terms(get_the_ID(), 'location');
                            $salary = carbon_get_the_post_meta('salary');
                            $accordion = carbon_get_the_post_meta('accordion');
                            ?>

                            <div class="career-holder background-white post-item">
                                <div class="inner">
                                    <div class="header">
                                        <div class="career-title w-100 align-center d-flex align-items-center justify-content-between">
                                            <h3><?php the_title() ?></h3>
                                            <span class="salary">£ <?= $salary ?></span>
                                        </div>
                                    </div>
                                    <div class="body">
                                        <div class="career-description d-none d-sm-block">
                                            <?php the_content() ?>
                                        </div>
                                        <?php if ($accordion) { ?>
                                            <div class="accordion-holder accordion-style-1">
                                                <div class="accordion" id="accordion-<?= get_the_ID() ?>">
                                                    <div class="accordion-item d-block d-sm-none">
                                                        <h2 class="accordion-header" id="heading<?= get_the_ID() . '-description'  ?>">
                                                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= get_the_ID() . '-description'  ?>" aria-expanded="false" aria-controls="collapse<?= get_the_ID() . '-description'  ?>">
                                                                <svg class="fa-plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                                </svg>
                                                                <svg class="fa-minus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                    <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                                                </svg>
                                                                <span> Job Description </span>
                                                            </button>
                                                        </h2>
                                                        <div id="collapse<?= get_the_ID() . '-description'  ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= get_the_ID() . '-description'  ?>" data-bs-parent="#accordion-<?= get_the_ID() ?>">
                                                            <div class="accordion-body">
                                                                <?php the_content() ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php foreach ($accordion as $key => $acc) { ?>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading<?= get_the_ID() . '-' . $key ?>">
                                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= get_the_ID() . '-' . $key ?>" aria-expanded="false" aria-controls="collapse<?= get_the_ID() . '-' . $key ?>">
                                                                    <svg class="fa-plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                                                    </svg>
                                                                    <svg class="fa-minus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                                                    </svg>
                                                                    <span> <?= $acc['accordion_title'] ?></span>
                                                                </button>
                                                            </h2>
                                                            <div id="collapse<?= get_the_ID() . '-' . $key ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= get_the_ID() . '-' . $key ?>" data-bs-parent="#accordion-<?= get_the_ID() ?>">
                                                                <div class="accordion-body">
                                                                    <?= wpautop($acc['accordion_content']) ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                    <div class="footer">
                                        <div class="sc_item_button sc_button_wrap">
                                            <button data-title="<?php the_title() ?>" data-bs-toggle="modal" data-bs-target="#applyModal" class="sc_button  sc_button_size_normal sc_button_icon_left color_style_link3">
                                                <span class="sc_button_text"><span class="sc_button_title">Apply Now</span></span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="load-more text-center">
                <a href="#" id="load-more-careers" class="d-none underline-link">
                    <span>Load more</span>
                    <i class="fa-solid fa-spinner"></i>
                </a>
            </div>
        </div>
    </section>
</main>
<!-- Modal -->
<div class="modal right fade" id="applyModal" tabindex="-1" aria-labelledby="applyModalLabel" aria-hidden="true">
    <div class="modal-dialog align-center">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mb-4" id="applyModalLabel">Apply for our <span></span> position</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body contact-form-v2">
                <?= do_shortcode('[contact-form-7 id="3e15b09" title="Careers Form"]') ?>
            </div>
        </div>
    </div>
</div>
<script>
    jQuery(document).ready(function($) {

        jQuery(document).on("click", '.apply-button', function(event) {
            $title = jQuery(this).attr('data-title');
            jQuery('input[name="position"]').val($title);
            jQuery('.modal-title span').text($title);
        });

        jQuery('.select-file').click(function(event) {
            jQuery('input[name="CV"]').click();
        });

        jQuery('input[name="CV"]').change(function(event) {
            jQuery('.fake-input').text(jQuery(this).val().replace(/C:\\fakepath\\/i, '')).addClass('active');
            jQuery('.form-file').addClass('focused');
        });
    });

    jQuery('#applyModal').on('show.bs.modal', function(e) {
        jQuery('html').addClass('overflow-hidden');
    })
    jQuery('#applyModal').on('hide.bs.modal', function(e) {
        jQuery('html').removeClass('overflow-hidden');
    })
</script>