(function (document, window, $) {

	'use strict';

	// Load Foundation
	$(document).foundation();
        
    $(".nav-primary").accessibleDropDownMenu();
    
    
    // Toggle menu
    
    $('li.menu-item-has-children > a').on('click',function(e){
        
        var $toggle = $(this).parent().find('.sub-menu-toggle');
        
        if( $toggle.is(':visible') ) {
            $toggle.trigger('click');
        }
        
        e.preventDefault();

    });
    
   
    
}(document, window, jQuery));
