(function($) {
	'use strict';
	
	var imageHighlight = {};
	eltdf.modules.imageHighlight = imageHighlight;
	
	imageHighlight.eltdfIHAppear = eltdfIHAppear;
	imageHighlight.eltdfOnDocumentReady = eltdfOnDocumentReady;
	
	$(document).ready(eltdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function eltdfOnDocumentReady() {
		eltdfIHAppear();
	}
    
    /**
     * Loading animation
     */
	function eltdfIHAppear() {
        var ihs = $('.eltdf-ih-with-animation');

        (ihs.length && !eltdf.htmlEl.hasClass('touch')) && ihs.appear(function(){$(this).addClass('eltdf-appeared')});
	};
	
})(jQuery);