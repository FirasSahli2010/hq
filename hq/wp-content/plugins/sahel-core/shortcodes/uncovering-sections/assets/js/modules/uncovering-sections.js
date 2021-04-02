(function($) {
    'use strict';

    var uncoveringSections = {};
    eltdf.modules.uncoveringSections = uncoveringSections;

    uncoveringSections.eltdfInitUncoveringSections = eltdfInitUncoveringSections;


    uncoveringSections.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitUncoveringSections();
    }

    /*
     **	Init full screen sections shortcode
     */
    function eltdfInitUncoveringSections(){
        var uncoveringSections = $('.eltdf-uncovering-sections');

        if(uncoveringSections.length){
            uncoveringSections.each(function() {
                var thisUS = $(this),
                    thisCurtain = uncoveringSections.find('.curtains'),
                    curtainItems = thisCurtain.find('.eltdf-uss-item'),
                    curtainShadow = uncoveringSections.find('.eltdf-fss-shadow');
                var body = eltdf.body;
                var defaultHeaderStyle = '';
                if (body.hasClass('eltdf-light-header')) {
                    defaultHeaderStyle = 'light';
                } else if (body.hasClass('eltdf-dark-header')) {
                    defaultHeaderStyle = 'dark';
                }

                body.addClass('eltdf-uncovering-section-on-page');
                if(eltdfPerPageVars.vars.eltdfHeaderVerticalWidth > 0 && eltdf.windowWidth > 1024) {
                    curtainItems.css({
                        left : eltdfPerPageVars.vars.eltdfHeaderVerticalWidth,
                        width: 'calc(100% - ' + eltdfPerPageVars.vars.eltdfHeaderVerticalWidth + 'px)'
                    });

                    curtainShadow.css({
                        left : eltdfPerPageVars.vars.eltdfHeaderVerticalWidth,
                        width: 'calc(100% - ' + eltdfPerPageVars.vars.eltdfHeaderVerticalWidth + 'px)'
                    });
                }

                thisCurtain.curtain({
                    scrollSpeed: 400,
                    nextSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle); },
                    prevSlide: function() { checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);}
                });

                checkFullScreenSectionsItemForHeaderStyle(thisCurtain, defaultHeaderStyle);
                setResposniveData(thisCurtain);

                thisUS.addClass('eltdf-loaded');
            });
        }
    }

    function checkFullScreenSectionsItemForHeaderStyle(thisUncoveringSections, default_header_style) {
        var section_header_style = thisUncoveringSections.find('.current').data('header-style');
        if (section_header_style !== undefined && section_header_style !== '') {
            eltdf.body.removeClass('eltdf-light-header eltdf-dark-header').addClass('eltdf-' + section_header_style + '-header');
        } else if (default_header_style !== '') {
            eltdf.body.removeClass('eltdf-light-header eltdf-dark-header').addClass('eltdf-' + default_header_style + '-header');
        } else {
            eltdf.body.removeClass('eltdf-light-header eltdf-dark-header');
        }
    }

    function setResposniveData(thisUncoveringSections) {
        var uncoveringSections = thisUncoveringSections.find('.eltdf-uss-item'),
            responsiveStyle = '',
            style = '';

        uncoveringSections.each(function(){
            var thisSection = $(this),
                thisSectionImage = thisSection.find('.eltdf-uss-image-holder'),
                itemClass = '',
                imageLaptop = '',
                imageTablet = '',
                imagePortraitTablet = '',
                imageMobile = '';

            if (typeof thisSection.data('item-class') !== 'undefined' && thisSection.data('item-class') !== false) {
                itemClass = thisSection.data('item-class');
            }

            if (typeof thisSectionImage.data('laptop-image') !== 'undefined' && thisSectionImage.data('laptop-image') !== false) {
                imageLaptop = thisSectionImage.data('laptop-image');
            }
            if (typeof thisSectionImage.data('tablet-image') !== 'undefined' && thisSectionImage.data('tablet-image') !== false) {
                imageTablet = thisSectionImage.data('tablet-image');
            }
            if (typeof thisSectionImage.data('tablet-portrait-image') !== 'undefined' && thisSectionImage.data('tablet-portrait-image') !== false) {
                imagePortraitTablet = thisSectionImage.data('tablet-portrait-image');
            }
            if (typeof thisSectionImage.data('mobile-image') !== 'undefined' && thisSectionImage.data('mobile-image') !== false) {
                imageMobile = thisSectionImage.data('mobile-image');
            }


            if (imageLaptop.length || imageTablet.length || imagePortraitTablet.length || imageMobile.length) {

                if (imageLaptop.length) {
                    responsiveStyle += "@media only screen and (max-width: 1366px) {.eltdf-uss-item." + itemClass + " .eltdf-uss-image-holder { background-image: url(" + imageLaptop + ") !important; } }";
                }
                if (imageTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 1024px) {.eltdf-uss-item." + itemClass + " .eltdf-uss-image-holder { background-image: url( " + imageTablet + ") !important; } }";
                }
                if (imagePortraitTablet.length) {
                    responsiveStyle += "@media only screen and (max-width: 800px) {.eltdf-uss-item." + itemClass + " .eltdf-uss-image-holder { background-image: url( " + imagePortraitTablet + ") !important; } }";
                }
                if (imageMobile.length) {
                    responsiveStyle += "@media only screen and (max-width: 680px) {.eltdf-uss-item." + itemClass + " .eltdf-uss-image-holder { background-image: url( " + imageMobile + ") !important; } }";
                }
            }
        });

        if (responsiveStyle.length) {
            style = '<style type="text/css">' + responsiveStyle + '</style>';
        }

        if (style.length) {
            $('head').append(style);
        }
    }

})(jQuery);