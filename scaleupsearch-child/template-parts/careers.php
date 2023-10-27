<?php
$main_query = get_queried_object();
?>
<main id="main">
    <section class="careers-archive background-light">
        <div class="container container wide w-960">

            <div id="results">
                <div class="results-holder">
                    <div class="career-wrapper">
                        <div class="accordion accordion-careers" id="accordion-Careers">
                            <?php
                            while (have_posts()) {
                                $key = 0;
                                the_post(); ?>
                                <?php
                                $location = carbon_get_the_post_meta('location');
                                ?>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="heading<?= get_the_ID() . '-description'  ?>">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?= get_the_ID() . '-description'  ?>" aria-expanded="<?= $key == 0 ? 'true ': 'false' ?>" aria-controls="collapse<?= get_the_ID() . '-description'  ?>">
                                            <svg class="fa-plus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                                            </svg>
                                            <svg class="fa-minus" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z" />
                                            </svg>
                                            <span> <?php the_title() ?></span>
                                        </button>
                                    </h2>
                                    <div id="collapse<?= get_the_ID() . '-description'  ?>" class="accordion-collapse collapse <?= $key == 0 ? 'show ': '' ?>" aria-labelledby="heading<?= get_the_ID() . '-description'  ?>" data-bs-parent="#accordion-Careers">
                                        <div class="accordion-body">

                                            <p class="work-location">
                                                <strong>Work Location: </strong> <?= $location ?>
                                            </p>

                                            <?php the_content() ?>

                                            <div class="elementor-button-wrapper">
                                                <a href="#" class="apply-button elementor-button-link elementor-button elementor-size-sm" role="button" data-title="<?php the_title() ?>" data-bs-toggle="modal" data-bs-target="#applyModal">
                                                    <span class="elementor-button-content-wrapper">
                                                        <span class="elementor-button-icon left">
                                                            <i aria-hidden="true" class="ogeko-icon- ogeko-icon-arrow-right"></i> </span>
                                                        <span class="elementor-button-text">APPLY NOW</span>
                                                        <span class="elementor-button-icon right">
                                                            <i aria-hidden="true" class="ogeko-icon- ogeko-icon-arrow-right"></i> </span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            <?php }
                            $key++ ?>
                            

                        </div>

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
                <?= do_shortcode('[contact-form-7 id="7909d0f" title="Careers"]') ?>
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