(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ogeko-project.default', ($scope) => {

            let currentIsotope = $scope.find('.isotope-grid');
            if (currentIsotope.length) {
                let objisotope = {filter: '*'};
                currentIsotope.isotope(objisotope);
                $scope.find('.elementor-project__filters li').on('click', function () {
                    $(this).parents('ul.elementor-project__filters').find('li.elementor-project__filter').removeClass('elementor-active');
                    $(this).addClass('elementor-active');
                    let selector = $(this).attr('data-filter');
                    currentIsotope.isotope({filter: selector});
                });
                currentIsotope.imagesLoaded(function () {
                    currentIsotope.isotope('layout');
                });
            }

            let $carousel = $('.ogeko-carousel', $scope);
            if ($carousel.length > 0) {
                let data = $carousel.data('settings'),
                    rtl = $('body').hasClass('rtl');
                $carousel.slick(
                    {
                        rtl: rtl,
                        dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
                        arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
                        infinite: data.loop,
                        speed: 300,
                        slidesToShow: parseInt(data.items),
                        autoplay: false,
                        autoplaySpeed: 5000,
                        slidesToScroll: 1,
                        lazyLoad: 'ondemand',
                        responsive: [
                            {
                                breakpoint: parseInt(data.breakpoint_laptop),
                                settings: {
                                    slidesToShow: parseInt(data.items_laptop),
                                }
                            },
                            {
                                breakpoint: parseInt(data.breakpoint_tablet_extra),
                                settings: {
                                    slidesToShow: parseInt(data.items_tablet_extra),
                                }
                            },
                            {
                                breakpoint: parseInt(data.breakpoint_tablet),
                                settings: {
                                    slidesToShow: parseInt(data.items_tablet),
                                }
                            },
                            {
                                breakpoint: parseInt(data.breakpoint_mobile_extra),
                                settings: {
                                    slidesToShow: parseInt(data.items_mobile_extra),
                                }
                            },
                            {
                                breakpoint: parseInt(data.breakpoint_mobile),
                                settings: {
                                    slidesToShow: parseInt(data.items_mobile),
                                }
                            }
                        ]
                    }
                );
            }

            let $button = $scope.find('a.elementor-button-load-more');

            $button.on('click', function (e) {
                e.preventDefault();
                let data = $(this).data('settings');
                let paged = $(this).data('paged');
                $.ajax({
                    url: ogekoAjax.ajaxurl,
                    data: {
                        action: 'ogeko_ajax_loadmore_project',
                        data: data,
                        paged: paged
                    },
                    type: 'POST',
                    dataType: 'JSON',
                    beforeSend: function () {
                        $('body').addClass('loading');
                    },
                    success: function (response) {
                        for (let item of response.posts) {
                            let $newItems = $(item);
                            currentIsotope.append($newItems)
                                .isotope('appended', $newItems)

                            $newItems.imagesLoaded(function(){
                                currentIsotope.isotope('layout');
                            })
                        }
                        $button.data('paged', response.paged);
                        if (response.disable) {
                            $button.remove();

                        }
                        $('body').removeClass('loading');
                    }
                });
            });

            let $total = $scope.find('.elementor-project__filters .total').text();
            $scope.find('.elementor-project__filters .all .count').text($total);
        });
    });

})(jQuery);