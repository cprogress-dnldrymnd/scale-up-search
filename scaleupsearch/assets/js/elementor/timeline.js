(function ($) {
    "use strict";
    $(window).on('elementor/frontend/init', () => {
        elementorFrontend.hooks.addAction('frontend/element_ready/ogeko-timeline.default', ($scope) => {
            let $sliderNav = $('.slider-nav', $scope);
            let $sliderFor = $('.slider-for', $scope);
            let rtl = $('body').hasClass('rtl');
            if ($sliderFor.length > 0) {
                $sliderFor.slick({
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    fade: true,
                    asNavFor: $sliderNav,
                    rtl: rtl
                });
            }
            if ($sliderNav.length > 0) {

                let data = $sliderNav.data('settings');

                $sliderNav.slick({
                    rtl: rtl,
                    asNavFor: $sliderFor,
                    focusOnSelect: true,
                    centerMode: true,
                    centerPadding: '0px',
                    dots: data.navigation == 'both' || data.navigation == 'dots' ? true : false,
                    arrows: data.navigation == 'both' || data.navigation == 'arrows' ? true : false,
                    infinite: data.loop,
                    speed: 300,
                    slidesToShow: parseInt(data.items),
                    autoplay: data.autoplay,
                    autoplaySpeed: data.autoplaySpeed,
                    slidesToScroll: 1,
                    lazyLoad: 'ondemand',
                    responsive: [{
                        breakpoint: parseInt(data.breakpoint_laptop), settings: {
                            slidesToShow: parseInt(data.items_laptop),
                        }
                    }, {
                        breakpoint: parseInt(data.breakpoint_tablet_extra), settings: {
                            slidesToShow: parseInt(data.items_tablet_extra),
                        }
                    }, {
                        breakpoint: parseInt(data.breakpoint_tablet), settings: {
                            slidesToShow: parseInt(data.items_tablet),
                        }
                    }, {
                        breakpoint: parseInt(data.breakpoint_mobile_extra), settings: {
                            slidesToShow: parseInt(data.items_mobile_extra),
                        }
                    }, {
                        breakpoint: parseInt(data.breakpoint_mobile), settings: {
                            slidesToShow: parseInt(data.items_mobile),
                        }
                    }, {
                        breakpoint: 450, settings: {
                            slidesToShow: 1,
                        }
                    }]
                });
            }
        });
    });

})(jQuery);
