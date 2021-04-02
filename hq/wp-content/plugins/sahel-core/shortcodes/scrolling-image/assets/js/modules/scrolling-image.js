(function ($) {
    'use strict';

    var scrollingImage = {};
    eltdf.modules.scrollingImage = scrollingImage;

    scrollingImage.eltdfInitScrollingImage = eltdfInitScrollingImage;
    scrollingImage.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

	/*
	 All functions to be called on $(document).on('ready') should be in this function
	 */
    function eltdfOnDocumentReady() {
        eltdfInitScrollingImage();
    }

    /*
    * Scrolling Image shortcode
    */
    function eltdfInitScrollingImage() {
        var shortcodes = $('.eltdf-scrolling-image-holder');

        if (shortcodes.length) {
            var setImageSize = function(image, frame) {
                var coeff = (image.prop('naturalWidth') / image.prop('naturalHeight')).toFixed(2);
                image.height(frame.height()*0.944);  //0.944 -> (100-5.6)% due to frame top bar 
                image.width(frame.height()*0.944*coeff);  //0.944 -> (100-5.6)% due to frame top bar 
            }

            var scrollImage = function(shortcode, image, frame, coeff, directionY) {
                if (directionY) {
                    shortcode
                        .on('mouseenter', function(){
                            image.css({
                                'transform': 'translate3d(0px, -'+Math.round(image.height() - frame.height()*0.944)+'px, 0px)', //0.944 -> (100-5.6)% due to frame top bar 
                                'transition': 'transform '+coeff*2+'s linear'
                            });
                        });
                } else {
                    shortcode
                        .on('mouseenter', function(){
                            image.css({
                                'transform': 'translate3d(-'+Math.round(image.width() - frame.width())+'px, 0px, 0px)',
                                'transition': 'transform '+coeff*2+'s linear'
                            });
                        });
                }

                shortcode
                    .on('mouseleave', function() {
                        image.css({
                            'transform': 'translate3d(0px, 0px, 0px)',
                            'transition': 'transform 3s cubic-bezier(0.215, 0.61, 0.355, 1)'
                        });
                    });
            }

            shortcodes.each(function () {
                var shortcode = $(this),
                    scrollingImage = shortcode.find('.eltdf-scrolling-image'),
                    imageFrame = shortcode.find('.eltdf-si-frame'),
                    y = shortcode.hasClass('eltdf-scrolling-vertical');
                
                shortcode.waitForImages(function(){
                    if (y) {
                        var siH = scrollingImage.height(),
                            ifH = imageFrame.height(),
                            t = Math.round(siH/ifH);
                    } else {
                        $(window).on('resize', function() {
                            setImageSize(scrollingImage, imageFrame);
                        });
                        setImageSize(scrollingImage, imageFrame);
                        
                        var siW = scrollingImage.width(),
                            ifW = imageFrame.width(),
                            t = Math.round(siW/ifW);
                    }

                    scrollingImage.parent().animate({opacity: 1}, 300);
                    t > 1 && scrollImage(shortcode, scrollingImage, imageFrame, t, y);
                });
            });
        }
    }
})(jQuery);