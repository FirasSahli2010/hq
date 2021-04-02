(function($) {
    'use strict';

    var swappingImageGallery = {};
    eltdf.modules.swappingImageGallery = swappingImageGallery;

    swappingImageGallery.eltdfOnWindowLoad = eltdfOnWindowLoad;

    $(window).on('load', eltdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function eltdfOnWindowLoad() {
        eltdfSwappingImageGallery();
    }

    /**
     * Init Owl Carousel
     */
    function eltdfSwappingImageGallery() {
        var sliders = $('.eltdf-sig-image-holder');

        if (sliders.length) {
            sliders.each(function() {
                var slider = $(this),
                    slideItemsNumber = 1,
                    loop = false,
                    autoplay = true,
                    autoplayHoverPause = false,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 700,
                    margin = 0,
                    stagePadding = 0,
                    center = false,
                    autoWidth = false,
                    animateInClass = false, // keyframe css animation
                    animateOutClass = false, // keyframe css animation
                    navigation = false,
                    pagination = true,
                    drag = true,
                    sliderDataHolder = slider;

                if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
                    animateInClass = sliderDataHolder.data('slider-animate-in');
                }
                if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
                }

                var dotsContainer = $('.eltdf-sig-thumbnails-holder');
                dotsContainer.find('.eltdf-sig-thumbnail').on('click', function () {
                    slider.trigger('to.owl.carousel', [$(this).index(), 700]);
                });

                slider.waitForImages(function () {
                    $(this).owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayHoverPause: autoplayHoverPause,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        margin: margin,
                        stagePadding: stagePadding,
                        center: center,
                        autoWidth: autoWidth,
                        animateIn: animateInClass,
                        animateOut: animateOutClass,
                        dots: pagination,
                        dotsContainer: dotsContainer,
                        nav: navigation,
                        drag: drag,
                        callbacks: true,
                        navText: [
                            '<span class="eltdf-prev-icon fa fa-chevron-left"></span>',
                            '<span class="eltdf-next-icon fa fa-chevron-right"></span>'
                        ],
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        },
                        onDrag: function (e) {
                            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
                                var sliderIsMoving = e.isTrigger > 0;

                                if (sliderIsMoving) {
                                    slider.addClass('eltdf-slider-is-moving');
                                }
                            }
                        },
                        onDragged: function () {
                            if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout') && slider.hasClass('eltdf-slider-is-moving')) {

                                setTimeout(function () {
                                    slider.removeClass('eltdf-slider-is-moving');
                                }, 500);
                            }
                        }
                    });

                });
            });
        }
    }
    
})(jQuery);