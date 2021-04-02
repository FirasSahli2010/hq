(function ($) {
	'use strict';

	var horizontalyScrollingPortfolioList = {};
	eltdf.modules.horizontalyScrollingPortfolioList = horizontalyScrollingPortfolioList;

	horizontalyScrollingPortfolioList.eltdfOnDocumentReady = eltdfOnDocumentReady;

	$(document).ready(eltdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
	function eltdfOnDocumentReady() {
		eltdfInitHorizontalyScrollingPortfolioList();
	}

	function eltdfInitHorizontalyScrollingPortfolioList() {
		var list = $('.eltdf-horizontaly-scrolling-portfolio-holder');

		if (list.length && eltdf.windowWidth >= 768) {
			var listInner = list.find('.eltdf-hspl-inner'),
				items = list.find('.eltdf-hspl-item'),
				listWidth = 0,
				widthVal = 280,
				decreaseHeightHeader = list.data('header-decrease'),
				decreaseHeightContentBottom = list.data('content-bottom-decrease');

			var widthCalcs = function () {
				//custom sizing
				if (eltdf.windowWidth <= 1440 && eltdf.windowWidth > 1280) {
					if (eltdf.windowHeight <= 645) {
						widthVal = 200;
					} else {
						widthVal = 260;
					}
				} else if (eltdf.windowWidth <= 1280 && eltdf.windowWidth > 1024) {
					widthVal = 220;
				} else if (eltdf.windowWidth <= 1024 && eltdf.windowWidth > 768) {
					widthVal = 250;
				} else if (eltdf.windowWidth == 768) {
					widthVal = 320;
				} else { widthVal = 280; }

				listWidth = 0;
				items.each(function () {
					var item = $(this),
						itemWidth = item.hasClass('eltdf-hspl-featured') ? widthVal * 2 : widthVal;

					listWidth += itemWidth;
					item.width(itemWidth);
				});

				listInner.width(listWidth);
			}

			var heightCalcs = function () {
				var height = eltdf.windowHeight;

				if (decreaseHeightHeader == 'yes') {
					var header = $('.no-touch .eltdf-page-header'),
						mobileHeader = $('.touch .eltdf-mobile-header'),
						headerHeight = 0;

					if (header.length) {
						headerHeight = header.outerHeight();
					}

					if (mobileHeader.length) {
						headerHeight = mobileHeader.outerHeight();
					}
					height = height - headerHeight;
				}

				if (decreaseHeightContentBottom == 'yes') {
					var contentBottom = $('.eltdf-content-bottom'),
						contentBottomHeight = 0;

					if (contentBottom.length) {
						contentBottomHeight = contentBottom.outerHeight();
					}

					height = height - contentBottomHeight;
				}

				listInner.css({ 'height': height });
			}

			heightCalcs();
			widthCalcs();
			
			if (eltdf.body.hasClass('eltdf-smooth-page-transitions-preloader')) {
				$(document).on('eltdfLoaderRemoved', function() {
					listInner.addClass('eltdf-ready');
				});
			} else {
				listInner.addClass('eltdf-ready');
			}

			$(window).resize(function () {
				heightCalcs();
				widthCalcs();
			});

			if (eltdf.htmlEl.hasClass('touch')) {
				//custom horizontal touch nav using hammer
				var section = document.querySelector('.eltdf-hspl-inner'),
					$section = $('.eltdf-hspl-inner'),
					sectionH = new Hammer(section),
					transformVal = 0;

				var moveContent = function (delta) {
					$section.css('transform', 'translate3d(' + delta + 'px, 0, 0)')
				}

				sectionH.on("swipe", function (ev) {
					if (ev.deltaX > 0) {
						transformVal += ev.distance;
						transformVal = Math.min(0, transformVal);
					} else {
						transformVal -= ev.distance;
						transformVal = -Math.min(listWidth - $section.parent().width() - parseInt($section.find('article:last-child').css('margin-right')), Math.abs(transformVal));
					}

					moveContent(transformVal);
				});

				$(window).on('resize', function () {
					//prevent overscroll
					if (Math.abs(transformVal) >= listWidth - $section.parent().width() - parseInt($section.find('article:last-child').css('margin-right'))) {
						moveContent(-listWidth + $section.parent().width() + parseInt($section.find('article:last-child').css('margin-right')));
					}
				});
			} else {
				//custom smooth horizontal scroll using virtual scroll
				var section = document.querySelector('.eltdf-hspl-inner'),
					sectionWidth = section.getBoundingClientRect().width,
					targetX = 0,
					currentX = 0,
					ease = 0.08,
					coeff = parseInt(list.parent().css('paddingLeft')) * 2
						- parseInt(window.getComputedStyle(section.querySelector('article:last-child')).marginRight); //adj.

				eltdf.htmlEl
					.add(eltdf.body)
					.addClass('eltdf-overflow-hidden');

				eltdf.modules.common.eltdfDisableScroll();

				window.addEventListener('resize', function () {
					coeff = parseInt(list.parent().css('paddingLeft')) * 2
						- parseInt(window.getComputedStyle(section.querySelector('article:last-child')).marginRight);
					sectionWidth = section.getBoundingClientRect().width;
				})

				VirtualScroll.on(function (e) {
					targetX += e.deltaY;
					targetX = Math.max((sectionWidth - window.innerWidth + coeff) * -1, targetX);
					targetX = Math.min(0, targetX);
				});

				var performScroll = function () {
					requestAnimationFrame(performScroll);
					currentX += (targetX - currentX) * ease;
					var t = 'translate3d(' + currentX + 'px, 0px, 0px)';
					var s = section.style;
					s["transform"] = t;
					s["webkitTransform"] = t;
					s["mozTransform"] = t;
					s["msTransform"] = t;
				}

				performScroll();
			}
		}
	}
})(jQuery);