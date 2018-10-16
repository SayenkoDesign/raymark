(function (document, window, $) {

	'use strict';

	// Load Foundation
	$(document).foundation();
        
    $(".nav-primary").accessibleDropDownMenu();
    
    $(window).on('load changed.zf.mediaquery', function(event, newSize, oldSize) {
        
        if( Foundation.MediaQuery.atLeast('large') ) {
          $('.sticky-header').css( 'height', $('.site-header').height() );
          $('.site-header').addClass('fixed');
        }
        else {
            $('.sticky-header').css( 'height', '' );
        }
        
        // need to reset sticky on resize. Otherwise it breaks
        if( ! Foundation.MediaQuery.atLeast('large') ) {
            $(document).foundation();
        }
                
    });
    
    
    // Toggle menu
    
    $('li.menu-item-has-children > a').on('click',function(e){
        
        var $toggle = $(this).parent().find('.sub-menu-toggle');
        
        if( $toggle.is(':visible') ) {
            $toggle.trigger('click');
        }
        
        e.preventDefault();

    });
    
   
   $(document).on('click', '.play-video', playVideo);
    
    function playVideo() {
                
        var $this = $(this);
        
        var url = $this.data('src');
                
        var $modal = $('#' + $this.data('open'));
        
        /*
        $.ajax(url)
          .done(function(resp){
            $modal.find('.flex-video').html(resp).foundation('open');
        });
        */
        
        var $iframe = $('<iframe>', {
            src: url,
            id:  'video',
            frameborder: 0,
            scrolling: 'no'
            });
        
        $iframe.appendTo('.video-placeholder', $modal );        
        
        
        
    }
    
    // Make sure videos don't play in background
    $(document).on(
      'closed.zf.reveal', '#modal-video', function () {
        $(this).find('.video-placeholder').html('');
      }
    );
    
    
    // Prevent reveal anchors from default behoaviour
    $('a[data-open]').on('click', function(e){
        e.preventDefault();
    });
    
    
    var hoverTimeout;
    var $img = $('.menu-item-column-icon img'),
    dsrc = $img.attr('src');
    $('.nav-primary .menu-item-object-service a').hover(function() {
        $img.attr('src', $(this).data('icon'));
        clearTimeout(hoverTimeout);
    }, function() {
        hoverTimeout = setTimeout(function() {
            $img.attr('src', dsrc);
        }, 3000);
        
    });
    
    
}(document, window, jQuery));
