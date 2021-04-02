(function($) {
    'use strict';

    var portfolio = {};
    eltdf.modules.portfolio = portfolio;
	
    portfolio.eltdfOnWindowLoad = eltdfOnWindowLoad;
    portfolio.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
    $(window).on('load', eltdfOnWindowLoad);
    $(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function eltdfOnWindowLoad() {
		eltdfPortfolioSingleFollow().init();
		eltdfInitFeaturedProject();
	}

	function eltdfOnDocumentReady(){
        eltdfSingleNavigationShowHide();
	}
	
	var eltdfPortfolioSingleFollow = function () {
		var info = $('.eltdf-follow-portfolio-info .eltdf-portfolio-single-holder .eltdf-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.eltdf-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .eltdf-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0,
				constant = 30; //30 to prevent mispositioned
		}
		
		var infoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				if (eltdf.scroll >= infoHolderOffset - headerHeight - eltdfGlobalVars.vars.eltdfAddForAdminBar - constant) {
					var marginTop = eltdf.scroll - infoHolderOffset + eltdfGlobalVars.vars.eltdfAddForAdminBar + headerHeight + constant;
					// if scroll is initially positioned below mediaHolderHeight
					if (marginTop + infoHolderHeight > mediaHolderHeight) {
						marginTop = mediaHolderHeight - infoHolderHeight + constant;
					}
					info.stop().animate({
						marginTop: marginTop
					});
				}
			}
		};
		
		var recalculateInfoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				//Calculate header height if header appears
				if (eltdf.scroll > 0 && header.length) {
					headerHeight = header.height();
				}
				
				var headerMixin = headerHeight + eltdfGlobalVars.vars.eltdfAddForAdminBar + constant;
				if (eltdf.scroll >= infoHolderOffset - headerMixin) {
					if (eltdf.scroll + infoHolderHeight + headerMixin + 2 * constant < infoHolderOffset + mediaHolderHeight) {
						info.stop().animate({
							marginTop: (eltdf.scroll - infoHolderOffset + headerMixin + 2 * constant)
						});
						//Reset header height
						headerHeight = 0;
					} else {
						info.stop().animate({
							marginTop: mediaHolderHeight - infoHolderHeight
						});
					}
				} else {
					info.stop().animate({
						marginTop: 0
					});
				}
			}
		};
		
		return {
			init: function () {
				infoHolderPosition();
				$(window).scroll(function () {
					recalculateInfoHolderPosition();
				});
			}
		};
	};

	function eltdfInitFeaturedProject(){
		var featuredProject = $('.eltdf-featured-projects-widget');

		if (featuredProject.length) {
			featuredProject.each(function(){
				var thisWidget = $(this),
					opener = thisWidget.find('.eltdf-featured-project-opener'),
					holder = thisWidget.find('.eltdf-featured-project-holder'),
					close = holder.find('.eltdf-featured-project-close');

				opener.on('click', function (){
					if (!thisWidget.hasClass('eltdf-opened')) {
						thisWidget.removeClass('eltdf-fp-fade-out').addClass('eltdf-opened eltdf-fp-fade-in');
						eltdf.body.addClass('eltdf-fp-opened');
						eltdf.modules.common.eltdfDisableScroll();
					}
				});

				close.on('click', function(){
					if (thisWidget.hasClass('eltdf-opened')) {
						thisWidget.removeClass('eltdf-opened eltdf-fp-fade-in').addClass('eltdf-fp-fade-out');
						eltdf.body.removeClass('eltdf-fp-opened');
						eltdf.modules.common.eltdfEnableScroll();
					}
				});
			});
		}
	}

    function eltdfSingleNavigationShowHide() {
        eltdf.window.scroll(function () {
            var content = $('.eltdf-content').height(),
                contentSpace = content - 100,
				b = $(this).scrollTop(),
                c = $(this).height(),
                d;

            if (b > 0) {
                d = b + c / 2;
            } else {
                d = 1;
            }

            if (d > contentSpace) {
                eltdfSingleNavigationLink('off');
            } else {
                eltdfSingleNavigationLink('on');
            }
        });
    }
    function eltdfSingleNavigationLink(a) {
        var b = $(".eltdf-ps-navigation-floated a");
        b.removeClass('off on');
        if (a === 'on') {
            b.addClass('on');
        } else {
            b.addClass('off');
        }
    }


})(jQuery);