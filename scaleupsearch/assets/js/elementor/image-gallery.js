(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ogeko-image-gallery.default', ($scope) => {
            let $iso = $scope.find('.isotope-grid');
            if ($iso) {
                let currentIsotope = $iso.isotope({filter: '*'});
                $scope.find('.elementor-galerry__filters li').on('click', function () {
                    $(this).parents('ul.elementor-galerry__filters').find('li.elementor-galerry__filter').removeClass('elementor-active');
                    $(this).addClass('elementor-active');
                    let selector = $(this).attr('data-filter');
                    currentIsotope.isotope({filter: selector});
                });
            }
        });
    });

})(jQuery);
