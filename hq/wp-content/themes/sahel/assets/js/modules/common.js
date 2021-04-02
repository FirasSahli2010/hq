(function($) {
	"use strict";

	var common = {};
	eltdf.modules.common = common;

	common.eltdfFluidVideo = eltdfFluidVideo;
	common.eltdfEnableScroll = eltdfEnableScroll;
	common.eltdfDisableScroll = eltdfDisableScroll;
	common.eltdfgetScrollX = eltdfgetScrollX;
	common.eltdfgetScrollY = eltdfgetScrollY;
	common.eltdfOwlSlider = eltdfOwlSlider;
	common.eltdfInitParallax = eltdfInitParallax;
	common.eltdfInitSelfHostedVideoPlayer = eltdfInitSelfHostedVideoPlayer;
	common.eltdfSelfHostedVideoSize = eltdfSelfHostedVideoSize;
	common.eltdfPrettyPhoto = eltdfPrettyPhoto;
	common.eltdfStickySidebarWidget = eltdfStickySidebarWidget;
	common.getLoadMoreData = getLoadMoreData;
	common.setLoadMoreAjaxData = setLoadMoreAjaxData;
	common.setFixedImageProportionSize = setFixedImageProportionSize;
	common.eltdfInitPerfectScrollbar = eltdfInitPerfectScrollbar;
	common.eltdfInitImageFX = eltdfInitImageFX;

	common.eltdfOnDocumentReady = eltdfOnDocumentReady;
	common.eltdfOnWindowLoad = eltdfOnWindowLoad;
	common.eltdfOnWindowResize = eltdfOnWindowResize;

	$(document).ready(eltdfOnDocumentReady);
	$(window).on('load', eltdfOnWindowLoad);
	$(window).resize(eltdfOnWindowResize);

	/*
		All functions to be called on $(document).ready() should be in this function
	*/
	function eltdfOnDocumentReady() {
		eltdfIconWithHover().init();
		eltdfDisableSmoothScrollForMac();
		eltdfInitAnchor().init();
		eltdfInitBackToTop();
		eltdfBackButtonShowHide();
		eltdfInitSelfHostedVideoPlayer();
		eltdfSelfHostedVideoSize();
		eltdfFluidVideo();
		eltdfOwlSlider();
		eltdfPreloadBackgrounds();
		eltdfPrettyPhoto();
		eltdfSearchPostTypeWidget();
		eltdfDashboardForm();
		eltdfInitGridMasonryListLayout();
		eltdfDynamicBackgroundColor();
		eltdfLoadingAppearFx();
		eltdfParallaxElements();
		eltdfInitialLoadingAnimation();
		eltdfSmoothTransition();
	}

	/*
		All functions to be called on $(window).load() should be in this function
	*/
	function eltdfOnWindowLoad() {
		eltdfInitParallax();
		eltdfStickySidebarWidget().init();
	}

	/*
		All functions to be called on $(window).resize() should be in this function
	*/
	function eltdfOnWindowResize() {
		eltdfInitGridMasonryListLayout();
		eltdfSelfHostedVideoSize();
	}

	/*
	 ** Disable smooth scroll for mac if smooth scroll is enabled
	 */
	function eltdfDisableSmoothScrollForMac() {
		var os = navigator.appVersion.toLowerCase();

		if (os.indexOf('mac') > -1 && eltdf.body.hasClass('eltdf-smooth-scroll')) {
			eltdf.body.removeClass('eltdf-smooth-scroll');
		}
	}

	function eltdfDisableScroll() {
		if (window.addEventListener) {
			window.addEventListener('wheel', eltdfWheel, {passive: false});
		}

		// window.onmousewheel = document.onmousewheel = eltdfWheel;
		document.onkeydown = eltdfKeydown;
	}

	function eltdfEnableScroll() {
		if (window.removeEventListener) {
			window.removeEventListener('wheel', eltdfWheel, {passive: false});
		}

		window.onmousewheel = document.onmousewheel = document.onkeydown = null;
	}

	function eltdfWheel(e) {
		eltdfPreventDefaultValue(e);
	}

	function eltdfKeydown(e) {
		var keys = [37, 38, 39, 40];

		for (var i = keys.length; i--;) {
			if (e.keyCode === keys[i]) {
				eltdfPreventDefaultValue(e);
				return;
			}
		}
	}

	function eltdfPreventDefaultValue(e) {
		e = e || window.event;
		if (e.preventDefault) {
			e.preventDefault();
		}
		e.returnValue = false;
	}

	/*
	 **	Anchor functionality
	 */
	var eltdfInitAnchor = function() {
		/**
		 * Set active state on clicked anchor
		 * @param anchor, clicked anchor
		 */
		var setActiveState = function(anchor){
			var headers = $('.eltdf-main-menu, .eltdf-mobile-nav, .eltdf-fullscreen-menu');

			headers.each(function(){
				var currentHeader = $(this);

				if (anchor.parents(currentHeader).length) {
					currentHeader.find('.eltdf-active-item').removeClass('eltdf-active-item');
					anchor.parent().addClass('eltdf-active-item');

					currentHeader.find('a').removeClass('current');
					anchor.addClass('current');
				}
			});
		};

		/**
		 * Check anchor active state on scroll
		 */
		var checkActiveStateOnScroll = function(){
			var anchorData = $('[data-eltdf-anchor]'),
				anchorElement,
				siteURL = window.location.href.split('#')[0];

			if (siteURL.substr(-1) !== '/') {
				siteURL += '/';
			}

			anchorData.waypoint( function(direction) {
				if(direction === 'down') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("eltdf-anchor");
					} else {
						anchorElement = $(this).data("eltdf-anchor");
					}

					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: '50%' });

			anchorData.waypoint( function(direction) {
				if(direction === 'up') {
					if ($(this.element).length > 0) {
						anchorElement = $(this.element).data("eltdf-anchor");
					} else {
						anchorElement = $(this).data("eltdf-anchor");
					}

					setActiveState($("a[href='"+siteURL+"#"+anchorElement+"']"));
				}
			}, { offset: function(){
					return -($(this.element).outerHeight() - 150);
				} });
		};

		/**
		 * Check anchor active state on load
		 */
		var checkActiveStateOnLoad = function(){
			var hash = window.location.hash.split('#')[1];

			if(hash !== "" && $('[data-eltdf-anchor="'+hash+'"]').length > 0){
				anchorClickOnLoad(hash);
			}
		};

		/**
		 * Handle anchor on load
		 */
		var anchorClickOnLoad = function ($this) {
			var scrollAmount,
				anchor = $('.eltdf-main-menu a, .eltdf-mobile-nav a, .eltdf-fullscreen-menu a'),
				hash = $this,
				anchorData = hash !== '' ? $('[data-eltdf-anchor="' + hash + '"]') : '';

			if (hash !== '' && anchorData.length > 0) {
				var anchoredElementOffset = anchorData.offset().top;
				scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;

				if(anchor.length) {
					anchor.each(function(){
						var thisAnchor = $(this);

						if(thisAnchor.attr('href').indexOf(hash) > -1) {
							setActiveState(thisAnchor);
						}
					});
				}

				eltdf.html.stop().animate({
					scrollTop: Math.round(scrollAmount)
				}, 1000, function () {
					//change hash tag in url
					if (history.pushState) {
						history.pushState(null, '', '#' + hash);
					}
				});

				return false;
			}
		};

		/**
		 * Calculate header height to be substract from scroll amount
		 * @param anchoredElementOffset, anchorded element offset
		 */
		var headerHeightToSubtract = function (anchoredElementOffset) {

			if (eltdf.modules.stickyHeader.behaviour === 'eltdf-sticky-header-on-scroll-down-up') {
				eltdf.modules.stickyHeader.isStickyVisible = (anchoredElementOffset > eltdf.modules.header.stickyAppearAmount);
			}

			if (eltdf.modules.stickyHeader.behaviour === 'eltdf-sticky-header-on-scroll-up') {
				if ((anchoredElementOffset > eltdf.scroll)) {
					eltdf.modules.stickyHeader.isStickyVisible = false;
				}
			}

			var headerHeight = eltdf.modules.stickyHeader.isStickyVisible ? eltdfGlobalVars.vars.eltdfStickyHeaderTransparencyHeight : eltdfPerPageVars.vars.eltdfHeaderTransparencyHeight;

			if (eltdf.windowWidth < 1025) {
				headerHeight = 0;
			}

			return headerHeight;
		};

		/**
		 * Handle anchor click
		 */
		var anchorClick = function () {
			eltdf.document.on("click", ".eltdf-main-menu a, .eltdf-fullscreen-menu a, .eltdf-btn, .eltdf-anchor, .eltdf-mobile-nav a", function () {
				var scrollAmount,
					anchor = $(this),
					hash = anchor.prop("hash").split('#')[1],
					anchorData = hash !== '' ? $('[data-eltdf-anchor="' + hash + '"]') : '';

				if (hash !== '' && anchorData.length > 0) {
					var anchoredElementOffset = anchorData.offset().top;
					scrollAmount = anchoredElementOffset - headerHeightToSubtract(anchoredElementOffset) - eltdfGlobalVars.vars.eltdfAddForAdminBar;

					setActiveState(anchor);

					eltdf.html.stop().animate({
						scrollTop: Math.round(scrollAmount)
					}, 1000, function () {
						//change hash tag in url
						if (history.pushState) {
							history.pushState(null, '', '#' + hash);
						}
					});

					return false;
				}
			});
		};

		return {
			init: function () {
				if ($('[data-eltdf-anchor]').length) {
					anchorClick();
					checkActiveStateOnScroll();

					$(window).on('load', function () {
						checkActiveStateOnLoad();
					});
				}
			}
		};
	};

	function eltdfInitBackToTop() {
		var backToTopButton = $('#eltdf-back-to-top');
		backToTopButton.on('click', function (e) {
			e.preventDefault();
			eltdf.html.animate({scrollTop: 0}, eltdf.window.scrollTop() / 5, 'easeOutQuad');
		});
	}

	function eltdfBackButtonShowHide() {
		eltdf.window.scroll(function () {
			var b = $(this).scrollTop(),
				c = $(this).height(),
				d;

			if (b > 0) {
				d = b + c / 2;
			} else {
				d = 1;
			}

			if (d < 1e3) {
				eltdfToTopButton('off');
			} else {
				eltdfToTopButton('on');
			}
		});
	}

	function eltdfToTopButton(a) {
		var b = $("#eltdf-back-to-top");
		b.removeClass('off on');
		if (a === 'on') {
			b.addClass('on');
		} else {
			b.addClass('off');
		}
	}

	function eltdfInitSelfHostedVideoPlayer() {
		var players = $('.eltdf-self-hosted-video');

		if (players.length) {
			players.mediaelementplayer({
				audioWidth: '100%'
			});
		}
	}

	function eltdfSelfHostedVideoSize(){
		var selfVideoHolder = $('.eltdf-self-hosted-video-holder .eltdf-video-wrap');

		if(selfVideoHolder.length) {
			selfVideoHolder.each(function(){
				var thisVideo = $(this),
					videoWidth = thisVideo.closest('.eltdf-self-hosted-video-holder').outerWidth(),
					videoHeight = videoWidth / eltdf.videoRatio;

				if(navigator.userAgent.match(/(Android|iPod|iPhone|iPad|IEMobile|Opera Mini)/)){
					thisVideo.parent().width(videoWidth);
					thisVideo.parent().height(videoHeight);
				}

				thisVideo.width(videoWidth);
				thisVideo.height(videoHeight);

				thisVideo.find('video, .mejs-overlay, .mejs-poster').width(videoWidth);
				thisVideo.find('video, .mejs-overlay, .mejs-poster').height(videoHeight);
			});
		}
	}

	function eltdfFluidVideo() {
		fluidvids.init({
			selector: ['iframe'],
			players: ['www.youtube.com', 'player.vimeo.com']
		});
	}

	function eltdfSmoothTransition() {

		if (eltdf.body.hasClass('eltdf-smooth-page-transitions')) {

			//check for preload animation
			if (eltdf.body.hasClass('eltdf-smooth-page-transitions-preloader')) {
				var loader = $('body > .eltdf-smooth-transition-loader.eltdf-mimic-ajax'),
					mainRevSlider = $('#eltdf-main-rev-holder'),
					textLoader = $('.eltdf-loader-title-spinner-text:first-child'),
					revTriggered = false;

				var removeLoader = function() {
					var delta = 1000;

					textLoader.parent().addClass('eltdf-done');

					if (mainRevSlider && !revTriggered && $('.eltdf-trigger-rev-before-load').length) {
						revTriggered = true;
						mainRevSlider.revstart();
						delta = 750;
						setTimeout(function() {
							eltdf.body.addClass('eltdf-rev-started');
						}, delta);
					}

					loader.delay(delta).fadeOut(500, 'easeOutSine', function(){
						if (mainRevSlider.length && !revTriggered) {
							revTriggered = true;
							mainRevSlider.find('rs-module').revstart();
						}

						$(document).trigger('eltdfLoaderRemoved');
					});

					$(window).on( 'pageshow', function (event) {
						if (event.originalEvent.persisted) {
							loader.fadeOut(500);
							if (mainRevSlider && !revTriggered) {
								revTriggered = true;
								mainRevSlider.revstart();
							}
						}
					});
				}

				var unblur = function() {
					var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
						window.webkitRequestAnimationFrame || window.msRequestAnimationFrame,
						cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

					var deviation = 0,
						temp,
						reversed = false;

					textLoader
						.css('filter', 'blur(4px)')
						.parent().addClass('eltdf-unblur');

					requestAnimationFrame(function effect() {
						var value = 4*(Math.sin(deviation+=0.1)+1);
						if (Math.round(temp) != 0) {
							textLoader.css({
								'filter': 'blur('+value+'px)'
							});
							requestAnimationFrame(effect);
							temp = value;
						} else {
							textLoader.css('filter', 'none');
							cancelAnimationFrame(effect);
							!reversed && textLoader.parent().addClass('eltdf-reverse');
							removeLoader();
							return false;
						}
					});

					$(window).on('load', function() {
						if (!reversed) {
							reversed = true;
							textLoader.parent().addClass('eltdf-reverse');
							removeLoader();
						}
					})
				}

				textLoader.length ? unblur() : $(document).waitForImages(function() { removeLoader(); });
			}

            // if back button is pressed, than reload page to avoid state where content is on display:none

            window.addEventListener( "pageshow", function ( event ) {
                var historyPath = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
                if ( historyPath ) {
                    $('.eltdf-wrapper-inner').show();
                }
            });

            //check for fade out animation
			if (eltdf.body.hasClass('eltdf-smooth-page-transitions-fadeout')) {
				var linkItem = $('a');

				linkItem.on('click', function (e) {
					var a = $(this);

					if ((a.parents('.eltdf-shopping-cart-dropdown').length || a.parent('.product-remove').length) && a.hasClass('remove')) {
						return;
					}

					if (
						e.which === 1 && // check if the left mouse button has been pressed
						a.attr('href').indexOf(window.location.host) >= 0 && // check if the link is to the same domain
						(typeof a.data('rel') === 'undefined') && //Not pretty photo link
						(typeof a.attr('rel') === 'undefined') && //Not VC pretty photo link
						(!a.hasClass('lightbox-active')) && //Not lightbox plugin active
						(typeof a.attr('target') === 'undefined' || a.attr('target') === '_self') && // check if the link opens in the same window
						(a.attr('href').split('#')[0] !== window.location.href.split('#')[0]) // check if it is an anchor aiming for a different page
					) {
						e.preventDefault();
						$('.eltdf-wrapper-inner').fadeOut(600, 'easeOutQuart', function () {
							window.location = a.attr('href');
						});
					}
				});
			}
		}
	}

	/*
	 *	Preload background images for elements that have 'eltdf-preload-background' class
	 */
	function eltdfPreloadBackgrounds(){
		var preloadBackHolder = $('.eltdf-preload-background');

		if(preloadBackHolder.length) {
			preloadBackHolder.each(function() {
				var preloadBackground = $(this);

				if(preloadBackground.css('background-image') !== '' && preloadBackground.css('background-image') !== 'none') {
					var bgUrl = preloadBackground.attr('style');

					bgUrl = bgUrl.match(/url\(["']?([^'")]+)['"]?\)/);
					bgUrl = bgUrl ? bgUrl[1] : "";

					if (bgUrl) {
						var backImg = new Image();
						backImg.src = bgUrl;
						$(backImg).on('load', function(){
							preloadBackground.removeClass('eltdf-preload-background');
						});
					}
				} else {
					$(window).on('load', function(){ preloadBackground.removeClass('eltdf-preload-background'); }); //make sure that eltdf-preload-background class is removed from elements with forced background none in css
				}
			});
		}
	}

	function eltdfPrettyPhoto() {
		/*jshint multistr: true */
		var markupWhole = '<div class="pp_pic_holder"> \
                        <div class="ppt">&nbsp;</div> \
                        <div class="pp_top"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                        <div class="pp_content_container"> \
                            <div class="pp_left"> \
                            <div class="pp_right"> \
                                <div class="pp_content"> \
                                    <div class="pp_loaderIcon"></div> \
                                    <div class="pp_fade"> \
                                        <a href="#" class="pp_expand" title="Expand the image">Expand</a> \
                                        <div class="pp_hoverContainer"> \
                                            <a class="pp_next" href="#"><span class="lnr lnr-arrow-right"></span></a> \
                                            <a class="pp_previous" href="#"><span class="lnr lnr-arrow-left"></span></a> \
                                        </div> \
                                        <div id="pp_full_res"></div> \
                                        <div class="pp_details"> \
                                            <div class="pp_nav"> \
                                                <a href="#" class="pp_arrow_previous">Previous</a> \
                                                <p class="currentTextHolder">0/0</p> \
                                                <a href="#" class="pp_arrow_next">Next</a> \
                                            </div> \
                                            <p class="pp_description"></p> \
                                            {pp_social} \
                                            <a class="pp_close" href="#">Close</a> \
                                        </div> \
                                    </div> \
                                </div> \
                            </div> \
                            </div> \
                        </div> \
                        <div class="pp_bottom"> \
                            <div class="pp_left"></div> \
                            <div class="pp_middle"></div> \
                            <div class="pp_right"></div> \
                        </div> \
                    </div> \
                    <div class="pp_overlay"></div>';

		$("a[data-rel^='prettyPhoto']").prettyPhoto({
			hook: 'data-rel',
			animation_speed: 'normal', /* fast/slow/normal */
			slideshow: false, /* false OR interval time in ms */
			autoplay_slideshow: false, /* true/false */
			opacity: 0.80, /* Value between 0 and 1 */
			show_title: true, /* true/false */
			allow_resize: true, /* Resize the photos bigger than viewport. true/false */
			horizontal_padding: 0,
			default_width: 960,
			default_height: 540,
			counter_separator_label: '/', /* The separator for the gallery counter 1 "of" 2 */
			theme: 'pp_default', /* light_rounded / dark_rounded / light_square / dark_square / facebook */
			hideflash: false, /* Hides all the flash object on a page, set to TRUE if flash appears over prettyPhoto */
			wmode: 'opaque', /* Set the flash wmode attribute */
			autoplay: true, /* Automatically start videos: True/False */
			modal: false, /* If set to true, only the close button will close the window */
			overlay_gallery: false, /* If set to true, a gallery will overlay the fullscreen image on mouse over */
			keyboard_shortcuts: true, /* Set to false if you open forms inside prettyPhoto */
			deeplinking: false,
			custom_markup: '',
			social_tools: false,
			markup: markupWhole
		});
	}

	function eltdfSearchPostTypeWidget() {
		var searchPostTypeHolder = $('.eltdf-search-post-type');

		if (searchPostTypeHolder.length) {
			searchPostTypeHolder.each(function () {
				var thisSearch = $(this),
					searchField = thisSearch.find('.eltdf-post-type-search-field'),
					resultsHolder = thisSearch.siblings('.eltdf-post-type-search-results'),
					searchLoading = thisSearch.find('.eltdf-search-loading'),
					searchIcon = thisSearch.find('.eltdf-search-icon');

				searchLoading.addClass('eltdf-hidden');

				var postType = thisSearch.data('post-type'),
					keyPressTimeout;

				searchField.on('keyup paste', function() {
					var field = $(this);
					field.attr('autocomplete','off');
					searchLoading.removeClass('eltdf-hidden');
					searchIcon.addClass('eltdf-hidden');
					clearTimeout(keyPressTimeout);

					keyPressTimeout = setTimeout( function() {
						var searchTerm = field.val();

						if(searchTerm.length < 3) {
							resultsHolder.html('');
							resultsHolder.fadeOut();
							searchLoading.addClass('eltdf-hidden');
							searchIcon.removeClass('eltdf-hidden');
						} else {
							var ajaxData = {
								action: 'sahel_elated_search_post_types',
								term: searchTerm,
								postType: postType
							};

							$.ajax({
								type: 'POST',
								data: ajaxData,
								url: eltdfGlobalVars.vars.eltdfAjaxUrl,
								success: function (data) {
									var response = JSON.parse(data);
									if (response.status === 'success') {
										searchLoading.addClass('eltdf-hidden');
										searchIcon.removeClass('eltdf-hidden');
										resultsHolder.html(response.data.html);
										resultsHolder.fadeIn();
									}
								},
								error: function(XMLHttpRequest, textStatus, errorThrown) {
									console.log("Status: " + textStatus);
									console.log("Error: " + errorThrown);
									searchLoading.addClass('eltdf-hidden');
									searchIcon.removeClass('eltdf-hidden');
									resultsHolder.fadeOut();
								}
							});
						}
					}, 500);
				});

				searchField.on('focusout', function () {
					searchLoading.addClass('eltdf-hidden');
					searchIcon.removeClass('eltdf-hidden');
					resultsHolder.fadeOut();
				});
			});
		}
	}

	/**
	 * Initializes load more data params
	 * @param container with defined data params
	 * return array
	 */
	function getLoadMoreData(container){
		var dataList = container.data(),
			returnValue = {};

		for (var property in dataList) {
			if (dataList.hasOwnProperty(property)) {
				if (typeof dataList[property] !== 'undefined' && dataList[property] !== false) {
					returnValue[property] = dataList[property];
				}
			}
		}

		return returnValue;
	}

	/**
	 * Sets load more data params for ajax function
	 * @param container with defined data params
	 * @param action with defined action name
	 * return array
	 */
	function setLoadMoreAjaxData(container, action) {
		var returnValue = {
			action: action
		};

		for (var property in container) {
			if (container.hasOwnProperty(property)) {

				if (typeof container[property] !== 'undefined' && container[property] !== false) {
					returnValue[property] = container[property];
				}
			}
		}

		return returnValue;
	}

	/*
	 ** Init Masonry List Layout
	 */
	function eltdfInitGridMasonryListLayout() {
		var holder = $('.eltdf-grid-masonry-list');

		if (holder.length) {
			holder.each(function () {
				var thisHolder = $(this),
					masonry = thisHolder.find('.eltdf-masonry-list-wrapper'),
					size = thisHolder.find('.eltdf-masonry-grid-sizer').width();

				masonry.waitForImages(function () {
					masonry.isotope({
						layoutMode: 'packery',
						itemSelector: '.eltdf-item-space',
						percentPosition: true,
						masonry: {
							columnWidth: '.eltdf-masonry-grid-sizer',
							gutter: '.eltdf-masonry-grid-gutter'
						}
					});

					if (thisHolder.find('.eltdf-fixed-masonry-item').length || thisHolder.hasClass('eltdf-fixed-masonry-items')) {
						setFixedImageProportionSize(masonry, masonry.find('.eltdf-item-space'), size, true);
					}

					setTimeout(function () {
						eltdfInitParallax();
					}, 600);

					masonry.isotope('layout').css('opacity', 1);
				});
			});
		}
	}

	/**
	 * Initializes size for fixed image proportion - masonry layout
	 */
	function setFixedImageProportionSize(container, item, size, isFixedEnabled) {
		if (container.hasClass('eltdf-masonry-images-fixed') || isFixedEnabled === true) {
			var padding = parseInt(item.css('paddingLeft'), 10),
				newSize = size - 2 * padding,
				defaultMasonryItem = container.find('.eltdf-masonry-size-small'),
				largeWidthMasonryItem = container.find('.eltdf-masonry-size-large-width'),
				largeHeightMasonryItem = container.find('.eltdf-masonry-size-large-height'),
				largeWidthHeightMasonryItem = container.find('.eltdf-masonry-size-large-width-height');

			defaultMasonryItem.css('height', newSize);
			largeHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));

			if (eltdf.windowWidth > 680) {
				largeWidthMasonryItem.css('height', newSize);
				largeWidthHeightMasonryItem.css('height', Math.round(2 * (newSize + padding)));
			} else {
				largeWidthMasonryItem.css('height', Math.round(newSize / 2));
				largeWidthHeightMasonryItem.css('height', newSize);
			}
		}
	}

	/**
	 * Object that represents icon with hover data
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var eltdfIconWithHover = function() {
		//get all icons on page
		var icons = $('.eltdf-icon-has-hover');

		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};

				var hoverColor = icon.data('hover-color'),
					originalColor = icon.css('color');

				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: icon, color: originalColor}, changeIconColor);
				}
			}
		};

		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconHoverColor($(this));
					});
				}
			}
		};
	};

	/*
	 ** Init parallax
	 */
	function eltdfInitParallax(){
		var parallaxHolder = $('.eltdf-parallax-row-holder');

		if(parallaxHolder.length){
			parallaxHolder.each(function() {
				var parallaxElement = $(this),
					image = parallaxElement.data('parallax-bg-image'),
					speed = parallaxElement.data('parallax-bg-speed') * 0.4,
					height = 0;

				if (typeof parallaxElement.data('parallax-bg-height') !== 'undefined' && parallaxElement.data('parallax-bg-height') !== false) {
					height = parseInt(parallaxElement.data('parallax-bg-height'));
				}

				parallaxElement.css({'background-image': 'url('+image+')'});

				if(height > 0) {
					parallaxElement.css({'min-height': height+'px', 'height': height+'px'});
				}

				parallaxElement.parallax('50%', speed);
			});
		}
	}

	/*
	 **  Init sticky sidebar widget
	 */
	function eltdfStickySidebarWidget(){
		var sswHolder = $('.eltdf-widget-sticky-sidebar'),
			headerHolder = $('.eltdf-page-header'),
			headerHeight = headerHolder.length ? headerHolder.outerHeight() : 0,
			widgetTopOffset = 0,
			widgetTopPosition = 0,
			sidebarHeight = 0,
			sidebarWidth = 0,
			objectsCollection = [];

		function addObjectItems() {
			if (sswHolder.length) {
				sswHolder.each(function () {
					var thisSswHolder = $(this),
						mainSidebarHolder = thisSswHolder.parents('aside.eltdf-sidebar'),
						widgetiseSidebarHolder = thisSswHolder.parents('.wpb_widgetised_column'),
						sidebarHolder = '',
						sidebarHolderHeight = 0;

					widgetTopOffset = thisSswHolder.offset().top;
					widgetTopPosition = thisSswHolder.position().top;
					sidebarHeight = 0;
					sidebarWidth = 0;

					if (mainSidebarHolder.length) {
						sidebarHeight = mainSidebarHolder.outerHeight();
						sidebarWidth = mainSidebarHolder.outerWidth();
						sidebarHolder = mainSidebarHolder;
						sidebarHolderHeight = mainSidebarHolder.parent().parent().outerHeight();

						var blogHolder = mainSidebarHolder.parent().parent().find('.eltdf-blog-holder');
						if (blogHolder.length) {
							sidebarHolderHeight -= parseInt(blogHolder.css('marginBottom'));
						}
					} else if (widgetiseSidebarHolder.length) {
						sidebarHeight = widgetiseSidebarHolder.outerHeight();
						sidebarWidth = widgetiseSidebarHolder.outerWidth();
						sidebarHolder = widgetiseSidebarHolder;
						sidebarHolderHeight = widgetiseSidebarHolder.parents('.vc_row').outerHeight();
					}

					objectsCollection.push({
						'object': thisSswHolder,
						'offset': widgetTopOffset,
						'position': widgetTopPosition,
						'height': sidebarHeight,
						'width': sidebarWidth,
						'sidebarHolder': sidebarHolder,
						'sidebarHolderHeight': sidebarHolderHeight
					});
				});
			}
		}

		function initStickySidebarWidget() {

			if (objectsCollection.length) {
				$.each(objectsCollection, function (i) {
					var thisSswHolder = objectsCollection[i]['object'],
						thisWidgetTopOffset = objectsCollection[i]['offset'],
						thisWidgetTopPosition = objectsCollection[i]['position'],
						thisSidebarHeight = objectsCollection[i]['height'],
						thisSidebarWidth = objectsCollection[i]['width'],
						thisSidebarHolder = objectsCollection[i]['sidebarHolder'],
						thisSidebarHolderHeight = objectsCollection[i]['sidebarHolderHeight'];

					if (eltdf.body.hasClass('eltdf-fixed-on-scroll')) {
						var fixedHeader = $('.eltdf-fixed-wrapper.fixed');

						if (fixedHeader.length) {
							headerHeight = fixedHeader.outerHeight() + eltdfGlobalVars.vars.eltdfAddForAdminBar;
						}
					} else if (eltdf.body.hasClass('eltdf-no-behavior')) {
						headerHeight = eltdfGlobalVars.vars.eltdfAddForAdminBar;
					}

					if (eltdf.windowWidth > 1024 && thisSidebarHolder.length) {
						var sidebarPosition = -(thisWidgetTopPosition - headerHeight),
							sidebarHeight = thisSidebarHeight - thisWidgetTopPosition - 40; // 40 is bottom margin of widget holder

						//move sidebar up when hits the end of section row
						var rowSectionEndInViewport = thisSidebarHolderHeight + thisWidgetTopOffset - headerHeight - thisWidgetTopPosition - eltdfGlobalVars.vars.eltdfTopBarHeight;

						if ((eltdf.scroll >= thisWidgetTopOffset - headerHeight) && thisSidebarHeight < thisSidebarHolderHeight) {
							if (thisSidebarHolder.hasClass('eltdf-sticky-sidebar-appeared')) {
								thisSidebarHolder.css({'top': sidebarPosition + 'px'});
							} else {
								thisSidebarHolder.addClass('eltdf-sticky-sidebar-appeared').css({
									'position': 'fixed',
									'top': sidebarPosition + 'px',
									'width': thisSidebarWidth,
									'margin-top': '-10px'
								}).animate({'margin-top': '0'}, 200);
							}

							if (eltdf.scroll + sidebarHeight >= rowSectionEndInViewport) {
								var absBottomPosition = thisSidebarHolderHeight - sidebarHeight + sidebarPosition - headerHeight;

								thisSidebarHolder.css({
									'position': 'absolute',
									'top': absBottomPosition + 'px'
								});
							} else {
								if (thisSidebarHolder.hasClass('eltdf-sticky-sidebar-appeared')) {
									thisSidebarHolder.css({
										'position': 'fixed',
										'top': sidebarPosition + 'px'
									});
								}
							}
						} else {
							thisSidebarHolder.removeClass('eltdf-sticky-sidebar-appeared').css({
								'position': 'relative',
								'top': '0',
								'width': 'auto'
							});
						}
					} else {
						thisSidebarHolder.removeClass('eltdf-sticky-sidebar-appeared').css({
							'position': 'relative',
							'top': '0',
							'width': 'auto'
						});
					}
				});
			}
		}

		return {
			init: function () {
				addObjectItems();
				initStickySidebarWidget();

				$(window).scroll(function () {
					initStickySidebarWidget();
				});
			},
			reInit: initStickySidebarWidget
		};
	}

	/**
	 * Init Owl Carousel
	 */
	function eltdfOwlSlider() {
		var sliders = $('.eltdf-owl-slider');

		if (sliders.length) {
			sliders.each(function(){
				var slider = $(this),
					owlSlider = $(this),
					slideItemsNumber = slider.children().length,
					numberOfItems = 1,
					loop = true,
					autoplay = true,
					autoplayHoverPause = false,
					sliderSpeed = 3800,
					sliderSpeedAnimation = 600,
					margin = 0,
					responsiveMargin = 0,
					responsiveMargin1 = 0,
					stagePadding = 0,
					stagePaddingEnabled = false,
					center = false,
					autoWidth = false,
					animateInClass = false, // keyframe css animation
					animateOutClass = false, // keyframe css animation
					navigation = true,
					pagination = false,
					paginationNames = false,
					thumbnail = false,
					thumbnailSlider,
					sliderIsCPTList = !!slider.hasClass('eltdf-list-is-slider'),
					sliderDataHolder = sliderIsCPTList ? slider.parent() : slider,  // this is condition for cpt to set list to be slider
					idle = true;

				if (typeof slider.data('number-of-items') !== 'undefined' && slider.data('number-of-items') !== false && ! sliderIsCPTList) {
					numberOfItems = slider.data('number-of-items');
				}
				if (typeof sliderDataHolder.data('number-of-columns') !== 'undefined' && sliderDataHolder.data('number-of-columns') !== false && sliderIsCPTList) {
					switch (sliderDataHolder.data('number-of-columns')) {
						case 'one':
							numberOfItems = 1;
							break;
						case 'two':
							numberOfItems = 2;
							break;
						case 'three':
							numberOfItems = 3;
							break;
						case 'four':
							numberOfItems = 4;
							break;
						case 'five':
							numberOfItems = 5;
							break;
						case 'six':
							numberOfItems = 6;
							break;
						default :
							numberOfItems = 4;
							break;
					}
				}

				if (sliderDataHolder.data('enable-loop') === 'no') {
					loop = false;
				}
				if (sliderDataHolder.data('enable-autoplay') === 'no') {
					autoplay = false;
				}
				if (sliderDataHolder.data('enable-autoplay-hover-pause') === 'no') {
					autoplayHoverPause = false;
				}
				if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
					sliderSpeed = sliderDataHolder.data('slider-speed');
				}
				if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
					sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
				}
				if (typeof sliderDataHolder.data('slider-margin') !== 'undefined' && sliderDataHolder.data('slider-margin') !== false) {
					if (sliderDataHolder.data('slider-margin') === 'no') {
						margin = 0;
					} else {
						margin = sliderDataHolder.data('slider-margin');
					}
				} else {
					if(slider.parent().hasClass('eltdf-huge-space')) {
						margin = 80;
					} else if (slider.parent().hasClass('eltdf-large-space')) {
						margin = 50;
					} else if (slider.parent().hasClass('eltdf-medium-space')) {
						margin = 40;
					} else if (slider.parent().hasClass('eltdf-normal-space')) {
						margin = 30;
					} else if (slider.parent().hasClass('eltdf-small-space')) {
						margin = 20;
					} else if (slider.parent().hasClass('eltdf-tiny-space')) {
						margin = 10;
					}
				}
				if (sliderDataHolder.data('slider-padding') === 'yes') {
					stagePaddingEnabled = true;
					stagePadding = parseInt(slider.outerWidth() * 0.28);
					margin = 50;
				}
				if (sliderDataHolder.data('enable-center') === 'yes') {
					center = true;
				}
				if (sliderDataHolder.data('enable-auto-width') === 'yes') {
					autoWidth = true;
				}
				if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
					animateInClass = sliderDataHolder.data('slider-animate-in');
				}
				if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
					animateOutClass = sliderDataHolder.data('slider-animate-out');
				}
				if (sliderDataHolder.data('enable-navigation') === 'no') {
					navigation = false;
				}
				if (sliderDataHolder.data('enable-pagination') === 'yes') {
					pagination = true;
				}

				if (sliderDataHolder.data('enable-pagination-names') === 'yes') {
					pagination = true;
					paginationNames = true;
				}

				if (sliderDataHolder.data('enable-thumbnail') === 'yes') {
					thumbnail = true;
				}

				if(thumbnail && !pagination) {
					/* page.index works only when pagination is enabled, so we add through html, but hide via css */
					pagination = true;
					owlSlider.addClass('eltdf-slider-hide-pagination');
				}

				if(navigation && pagination) {
					slider.addClass('eltdf-slider-has-both-nav');
				}

				if (slideItemsNumber <= 1) {
					loop       = false;
					autoplay   = false;
					navigation = false;
					pagination = false;
				}

				var responsiveNumberOfItems1 = 1,
					responsiveNumberOfItems2 = 2,
					responsiveNumberOfItems3 = 3,
					responsiveNumberOfItems4 = numberOfItems,
					responsiveNumberOfItems5 = numberOfItems;

				if (numberOfItems < 3) {
					responsiveNumberOfItems2 = numberOfItems;
					responsiveNumberOfItems3 = numberOfItems;
				}

				if (numberOfItems > 4) {
					responsiveNumberOfItems4 = 4;
				}

				if (numberOfItems > 5) {
					responsiveNumberOfItems5 = 5;
				}

				if (stagePaddingEnabled || margin > 30) {
					responsiveMargin = 20;
					responsiveMargin1 = 30;
				}

				if (margin > 0 && margin <= 30) {
					responsiveMargin = margin;
					responsiveMargin1 = margin;
				}

				slider.waitForImages(function () {
					owlSlider = slider.owlCarousel({
						items: numberOfItems,
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
						nav: navigation,
						navText: [
							'<span class="eltdf-prev-icon ' + eltdfGlobalVars.vars.sliderNavPrevArrow + '"></span>',
							'<span class="eltdf-next-icon ' + eltdfGlobalVars.vars.sliderNavNextArrow + '"></span>'
						],
						responsive: {
							0: {
								items: responsiveNumberOfItems1,
								margin: responsiveMargin,
								stagePadding: 0,
								center: false,
								autoWidth: false
							},
							681: {
								items: responsiveNumberOfItems2,
								margin: responsiveMargin1
							},
							769: {
								items: responsiveNumberOfItems3,
								margin: responsiveMargin1
							},
							1025: {
								items: responsiveNumberOfItems4
							},
							1281: {
								items: responsiveNumberOfItems5
							},
							1367: {
								items: numberOfItems
							}
						},
						onInitialize: function () {
							slider.css('visibility', 'visible');
							eltdfInitParallax();
							if (slider.find('iframe').length || slider.find('video').length) {
								setTimeout(function(){
									eltdfSelfHostedVideoSize();
									eltdfFluidVideo();
								}, 500);
							}
							if(thumbnail) {
								thumbnailSlider.find('.eltdf-slider-thumbnail-item:first-child').addClass('active');
							}
						},
						onInitialized: function () {
							if (paginationNames) {
								var itemsNames = slider.find('.owl-item:not(.cloned) .eltdf-pag-name');
								var bullets = slider.find('.owl-dots .owl-dot');

								bullets.each(function (e) {
									var thisBullet = $(this);
									var name = itemsNames.eq(e).html();

									thisBullet.html('<span class="eltdf-owl-pag-name">'+name+'</span>');
								});
							}

							if (slider.closest('#panel-admin').length) {
								$(document).on('mousewheel', function (e) {
									if (eltdf.body.hasClass('eltdf-toolbar-opened') ) {
										e.preventDefault();

										if (idle) {
											if (e.deltaY > 0) {
												owlSlider.trigger('prev.owl.carousel');
											} else {
												owlSlider.trigger('next.owl.carousel');
											}
										}
									}
								});
							}
						},
						onRefreshed: function() {
							if(autoWidth === true) {
								var oldSize = parseInt(slider.find('.owl-stage').css('width'));
								slider.find('.owl-stage').css('width', (oldSize + 1) + 'px');
							}
						},
						onTranslate: function(e) {
							idle = false;
							if(thumbnail) {
								var index = e.page.index + 1;
								thumbnailSlider.find('.eltdf-slider-thumbnail-item.active').removeClass('active');
								thumbnailSlider.find('.eltdf-slider-thumbnail-item:nth-child(' + index + ')').addClass('active');
							}
						},
						onTranslated: function(){
							idle = true;
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

				if(thumbnail) {
					thumbnailSlider = slider.parent().find('.eltdf-slider-thumbnail');

					var numberOfThumbnails = parseInt(thumbnailSlider.data('thumbnail-count'));
					var numberOfThumbnailsClass = '';

					switch (numberOfThumbnails % 6) {
						case 2 :
							numberOfThumbnailsClass = 'two';
							break;
						case 3 :
							numberOfThumbnailsClass = 'three';
							break;
						case 4 :
							numberOfThumbnailsClass = 'four';
							break;
						case 5 :
							numberOfThumbnailsClass = 'five';
							break;
						case 0 :
							numberOfThumbnailsClass = 'six';
							break;
						default :
							numberOfThumbnailsClass = 'six';
							break;
					}

					if(numberOfThumbnailsClass !== '') {
						thumbnailSlider.addClass('eltdf-slider-columns-' + numberOfThumbnailsClass)
					}

					thumbnailSlider.find('.eltdf-slider-thumbnail-item').on('click' ,function () {
						$(this).siblings('.active').removeClass('active');
						$(this).addClass('active');
						owlSlider.trigger('to.owl.carousel', [$(this).index(), sliderSpeedAnimation]);
					});
				}
			});
		}
	}

	function eltdfDashboardForm() {
		var forms = $('.eltdf-dashboard-form');

		if (forms.length) {
			forms.each(function () {
				var thisForm = $(this),
					btnText = thisForm.find('button'),
					updatingBtnText = btnText.data('updating-text'),
					updatedBtnText = btnText.data('updated-text'),
					actionName = thisForm.data('action');

				thisForm.on('submit', function (e) {
					e.preventDefault();
					var prevBtnText = btnText.html(),
						gallery = $(this).find('.eltdf-dashboard-gallery-upload-hidden'),
						namesArray = [];

					btnText.html(updatingBtnText);

					//get data
					var formData = new FormData();

					//get files
					gallery.each(function () {
						var thisGallery = $(this),
							thisName = thisGallery.attr('name'),
							thisRepeaterID = thisGallery.attr('id'),
							thisFiles = thisGallery[0].files,
							newName;

						//this part is needed for repeater with image uploads
						//adding specific names so they can be sorted in regular files and files in repeater
						if (thisName.indexOf("[") !== '-1') {
							newName = thisName.substring(0, thisName.indexOf("[")) + '_eltdf_regarray_';

							var firstIndex = thisRepeaterID.indexOf('['),
								lastIndex = thisRepeaterID.indexOf(']'),
								index = thisRepeaterID.substring(firstIndex + 1, lastIndex);

							namesArray.push(newName);
							newName = newName + index + '_';
						} else {
							newName = thisName + '_eltdf_reg_';
						}

						//if file not sent, send dummy file - so repeater fields are sent
						if (thisFiles.length === 0) {
							formData.append(newName, new File([""], "eltdf-dummy-file.txt", {
								type: "text/plain"
							}));
						}

						for (var i = 0; i < thisFiles.length; i++) {
							var allowedTypes = ['image/png','image/jpg','image/jpeg','application/pdf'];
							//security purposed - check if there is more than one dot in file name, also check whether the file type is in allowed types
							if (thisFiles[i].name.match(/\./g).length === 1 && $.inArray(thisFiles[i].type, allowedTypes) !== -1) {
								formData.append(newName + i, thisFiles[i]);
							}
						}
					});

					formData.append('action', actionName);

					//get data from form
					var otherData = $(this).serialize();
					formData.append('data', otherData);

					$.ajax({
						type: 'POST',
						data: formData,
						contentType: false,
						processData: false,
						url: eltdfGlobalVars.vars.eltdfAjaxUrl,
						success: function (data) {
							var response;
							response = JSON.parse(data);

							// append ajax response html
							eltdf.modules.socialLogin.eltdfRenderAjaxResponseMessage(response);
							if (response.status === 'success') {
								btnText.html(updatedBtnText);
								window.location = response.redirect;
							} else {
								btnText.html(prevBtnText);
							}
						}
					});

					return false;
				});
			});
		}
	}

	/**
	 * Init Perfect Scrollbar
	 */
	function eltdfInitPerfectScrollbar() {
		var defaultParams = {
			wheelSpeed: 0.6,
			suppressScrollX: true
		};

		var eltdfInitScroll = function (holder) {
			var ps = new PerfectScrollbar(holder.selector, defaultParams);
			$(window).resize(function () {
				ps.update();
			});
		};

		return {
			init: function (holder) {
				eltdfInitScroll(holder);
			}
		};
	}

	function eltdfgetScrollX() {
		return (window.pageXOffset != null) ? window.pageXOffset : (document.documentElement.scrollLeft != null) ? document.documentElement.scrollLeft : document.body.scrollLeft;
	}
	function eltdfgetScrollY() {
		return (window.pageYOffset != null) ? window.pageYOffset : (document.documentElement.scrollTop != null) ? document.documentElement.scrollTop : document.body.scrollTop;
	}

	/**
	 * Custom Image blur effect
	 *
	 * @param {string} trigger - holder element to be hovered
	 * @param {string} target - element to be effected
	 * @param {number} amount - effect amount
	 * @param {number} step - effect animation step
	 */
	function eltdfInitImageFX(trigger, target, amount, step) {
		var requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame ||
			window.webkitRequestAnimationFrame || window.msRequestAnimationFrame,
			cancelAnimationFrame = window.cancelAnimationFrame || window.mozCancelAnimationFrame;

		amount = amount ? amount : 3;
		step = step ? step : 0.1;

		$(trigger).on('mouseenter', function() {
			var item = $(this),
				temp,
				deviation = 0;

			requestAnimationFrame(function effect() {
				var value = amount*(Math.sin(deviation+=step)+1);
				if (Math.round(temp) != 0) {
					item.find(target).css({
						'filter': 'blur('+value+'px)'
					});
					requestAnimationFrame(effect);
					temp = value;
				} else {
					item.find(target).css('filter', 'none');
					cancelAnimationFrame(effect);
					return false;
				}
			});
		});
	}

	/*
    * Init Element in View
    */
	function eltdfElementInView(element) {
		var toggleClasses = function() {
			if (eltdf.scroll > element.offset().top - eltdf.windowHeight && eltdf.scroll < element.offset().top + element.height()) {
				if (!element.hasClass('eltdf-in-view')) {
					element.addClass('eltdf-in-view');
				}
			} else {
				if (element.hasClass('eltdf-in-view')) {
					element.removeClass('eltdf-in-view');
				}
			}
		}

		$(window).scroll(function(){
			toggleClasses();
		});

		toggleClasses();
	}

	/*
    * Custom Loading Animation for specific content
    */
	function eltdfLoadingAppearFx(element) {
		var elements = $('.eltdf-content-fade-in .eltdf-eh-item-content > div ');

		elements.each(function(){
			eltdfElementInView($(this));
		});
	}

	/**
	 * Dynamic Background Color
	 */
	function eltdfDynamicBackgroundColor() {
		var bgrndIntances = $("[data-dynamic-bgrnd]");

		if (eltdf.body.hasClass('eltdf-dynamic-background-color') && bgrndIntances.length) {
			$('.eltdf-content-inner').append('<div id="eltdf-dynamic-bgrnds"></div');
			var holder =  $('#eltdf-dynamic-bgrnds'),
				scrollBuffer = eltdf.scroll,
				scrollingDown = true,
				currentScroll, instancesInView, activeEl;

			//add bgrnd divs
			bgrndIntances.each(function(){
				eltdfElementInView($(this));
			});

			//calculate scroll direction
			var scrollDirection = function() {
				currentScroll = eltdf.scroll;

				if (currentScroll > scrollBuffer){
					scrollingDown = true;
				} else {
					scrollingDown = false;
				}
				scrollBuffer = currentScroll;
			};

			holder.css('background-color', bgrndIntances.first().attr('data-dynamic-bgrnd'));

			//colors change logic
			$(window).on('scroll', function() {
				scrollDirection();
				instancesInView = bgrndIntances.filter('.eltdf-in-view');

				if (instancesInView.length) {
					if (scrollingDown) {
						activeEl = instancesInView.last();
					} else {
						activeEl = instancesInView.first();
					}

					holder.css('background-color') !== activeEl.attr('data-dynamic-bgrnd') &&
					holder.css('background-color', activeEl.attr('data-dynamic-bgrnd'));
				}
			});
		}
	}


	/**
	 * Init Parallax Items
	 */
	function eltdfParallaxElements() {
		var parallaxIntances = $("[data-parallax]");

		if (parallaxIntances.length && !eltdf.htmlEl.hasClass('touch')) {
			ParallaxScroll.init(); //initialzation removed from plugin js file to have it run only on non-touch devices
		}
	}

	/**
	 * Initial Loading Animation
	 */
	function eltdfInitialLoadingAnimation() {
		if (eltdf.body.hasClass('eltdf-initial-loading-animation') && !eltdf.htmlEl.hasClass('touch')) {
			var mainRevSlider = $('#eltdf-main-rev-holder');

			mainRevSlider.length && eltdf.scroll <= mainRevSlider.offset().top + mainRevSlider.height() ?
				mainRevSlider.on('revolution.slide.onloaded', function() {eltdf.body.addClass('eltdf-animate')}) :
				$(document).waitForImages(function() {eltdf.body.addClass('eltdf-animate')});
		}
	}

})(jQuery);