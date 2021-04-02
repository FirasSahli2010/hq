(function($) {
    'use strict';

    var expandingCarousel = {};
    eltdf.modules.expandingCarousel = expandingCarousel;

    expandingCarousel.eltdfInitexpandingCarousel = eltdfInitexpandingCarousel;

    expandingCarousel.eltdfOnDocumentReady = eltdfOnDocumentReady;

    $(document).ready(eltdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitexpandingCarousel();
    }

    /**
     * Init expanding Carousel shortcode
     */
    function eltdfInitexpandingCarousel() {
        var expandingCarousels = $('.eltdf-expanding-carousel-holder');

        if (expandingCarousels.length) {
            expandingCarousels.each(function(){
                var expandingCarousel = $(this),
                    items = expandingCarousel.find('.eltdf-esc-item'),
					itemsTitleHolder = items.find('.eltdf-esc-item-title-holder').first(),
					images = expandingCarousel.find('.eltdf-esc-item-image'),
					navHolder = expandingCarousel.find('.eltdf-esc-nav'),
                    prevTrigger = expandingCarousel.find('.eltdf-esc-prev-trigger, .eltdf-esc-nav-prev'),
                    nextTrigger = expandingCarousel.find('.eltdf-esc-next-trigger, .eltdf-esc-nav-next');

                //expanding calcs
                var expandingCalcs = function() {
					if ( expandingCarousel.hasClass('eltdf-expanding-fullscreen') ) {
						var heightVal = eltdf.windowHeight - expandingCarousel.offset().top;

						if (eltdf.body.hasClass('eltdf-paspartu-enabled')) {
							var passepartoutSize = parseInt($('.eltdf-wrapper').css('padding-top'));

							heightVal -= passepartoutSize;
						}

						expandingCarousel.css('height', heightVal);
					}

					images.each(function () {
						var thisImage = $(this);

						thisImage.width(expandingCarousel.width());
					});

					navHolder.css('bottom',itemsTitleHolder.outerHeight());
                }

                //item classes setup
                var prepItems = function() {
                    items.first().addClass('eltdf-active').find('> div').css('transition','none');
                    if (eltdf.body.hasClass('eltdf-smooth-page-transitions-preloader')) {
                        $(document).on('eltdfLoaderRemoved', function() {
                            expandingCarousel.css('opacity', 1);
                        });
                    } else {
                        expandingCarousel.css('opacity', 1);
                    }
                    setTimeout(function(){
                        items.filter('.eltdf-active').next().addClass('eltdf-next');
                        items.last().addClass('eltdf-prev');
                    }, 200);
                }

                //slideshow logic start
                var startAnimating = function() {
                    expandingCarousel.addClass('eltdf-animating');
                }

                var endAnimating = function(nextIndex) {
                    // expandingCarousel.find('.eltdf-remove').one(eltdf.transitionEnd,function(){
                    // 	console.log('hello');
                    //     expandingCarousel.removeClass('eltdf-animating');
						// items.removeClass('eltdf-peek-prev');
						// items.removeClass('eltdf-peek-next');
						// setTimeout(function() {
						// 	items.removeClass('eltdf-remove');
						// }, 200);
                    // });
					setTimeout(function(){
						expandingCarousel.removeClass('eltdf-animating');
						items.removeClass('eltdf-peek-prev');
						items.removeClass('eltdf-peek-next');
						items.removeClass('eltdf-prev');
						items.removeClass('eltdf-next');
						if (nextIndex < items.length - 1 && nextIndex > 0) {
							items.filter('.eltdf-active').next().addClass('eltdf-next');
							items.filter('.eltdf-active').prev().addClass('eltdf-prev');
						} else if (nextIndex == 0) {
							items.filter('.eltdf-active').next().addClass('eltdf-next');
							items.last().addClass('eltdf-prev');
						} else {
							items.first().addClass('eltdf-next');
							items.filter('.eltdf-active').prev().addClass('eltdf-prev');
						}
						setTimeout(function() {
							items.removeClass('eltdf-remove');
						}, 200);
					},700);
                }

                var changeItem = function(direction) {
                    startAnimating(); //before change

                    var nextIndex;

                    //direction forward - else backwards
                    if (direction) {
						//loop
						if (items.filter('.eltdf-active').data('index') < items.length) {
							nextIndex = items.filter('.eltdf-active').next().data('index') - 1;
						} else {
							nextIndex = 0;
						}
					} else {
						//loop
						if (items.filter('.eltdf-active').data('index') > 1) {
							nextIndex = items.filter('.eltdf-active').prev().data('index') - 1;
						} else {
							nextIndex = items.length - 1;
						}
					}

                    items.find('> div').removeAttr('style');
                    items.removeClass('eltdf-remove');
                    items.filter('.eltdf-active').addClass('eltdf-remove');
                    items.removeClass('eltdf-active');
                    items.eq(nextIndex).addClass('eltdf-active');

                    endAnimating(nextIndex); //after change
                }
                //slideshow logic end

                //change on click
                var slideshowTrigger = function() {
                    nextTrigger.on('click', function(e){
                        if (!expandingCarousel.hasClass('eltdf-animating')) {
                            changeItem(true);
                        }           
                    });

                    nextTrigger.on('mouseenter', function(){
                        expandingCarousel.addClass('eltdf-peek-next');
                    }).on('mouseleave', function(){
                        expandingCarousel.removeClass('eltdf-peek-next');
                    });

					prevTrigger.on('click', function(e){
						if (!expandingCarousel.hasClass('eltdf-animating')) {
							changeItem(false);
						}
					});

					prevTrigger.on('mouseenter', function(){
						expandingCarousel.addClass('eltdf-peek-prev');
					}).on('mouseleave', function(){
						expandingCarousel.removeClass('eltdf-peek-prev');
					});
                }

                //change on scroll
                var slideshowScroll = function() {
                    if (expandingCarousel.hasClass('eltdf-esc-slide-on-scroll') && !eltdf.htmlEl.hasClass('touch')) {
                        var delta = 0;

                        expandingCarousel.mousewheel(function(e) {
                            e.preventDefault();

                            if (!expandingCarousel.hasClass('eltdf-animating')) {
                                if (e.deltaY < 0) {
                                    delta = -1;
                                } else {
                                    delta = 1;
                                }

                                if (delta == -1 ) {
                                    changeItem();
                                }
                            }
                        });

                        expandingCarousel.on('wheel', function() { return false; });
                    }
                }

                //init
                expandingCarousel.waitForImages(function(){
                    expandingCalcs();
                    prepItems();
                    slideshowTrigger();
                    slideshowScroll();
                });

                $(window).resize(function(){
                    expandingCalcs();
                });
            });
        }
    }
})(jQuery);
