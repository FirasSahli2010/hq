(function($) {
    'use strict';
    
    var team = {};
    eltdf.modules.team = team;
    
    team.eltdfInitTeamFX = eltdfInitTeamFX;
    team.eltdfOnDocumentReady = eltdfOnDocumentReady;
    
    $(document).ready(eltdfOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function eltdfOnDocumentReady() {
        eltdfInitTeamFX();
    }
    
    /**
     * Init Team loading animation fx
     */
    function eltdfInitTeamFX() {
        var items = $('.eltdf-team-with-loading-animation');

        if (items.length && !eltdf.htmlEl.hasClass('touch')) {
            var coeff = 6;

            items.appear(function() {
                var item = $(this),
                    delay = 100 * (Math.floor(Math.random() * coeff)) + 'ms';

                item
                    .addClass('eltdf-appeared')
                    .css('transition-delay', delay);
            })
        }
    }
})(jQuery);