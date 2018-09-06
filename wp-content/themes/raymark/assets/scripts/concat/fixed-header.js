(function (document, window, $) {

	'use strict';
    
    // Scroll up show header

	var $sticky =  $('.site-header');
            
    $sticky.each(function (i, element) {
        
        var $win = $(window), 
            $self = $(this),
            isShow = false,
            delta = 300, // distance from top where its active
            lastScrollTop = 0;
    
        $win.on('scroll', function () {
          
          // don't show below sticky menu
          if( $('.facetwp-template').hasClass('is-paging') ) {
              return;
          }
          
          var scrollTop = $win.scrollTop();
          var offset = scrollTop - lastScrollTop;
          lastScrollTop = scrollTop;
          
          console.log(scrollTop);
          
          // Have they scrolled past delta?
          if(scrollTop > delta) {
              $self.addClass('fixed');
              
              if (offset < 0 ) {
                if (!isShow ) {
                  $self.addClass('fixed-show');
                  isShow = true;
                }
              } else if (offset > 0 || offset < lastScrollTop ) {
                if (isShow) {
                  $self.removeClass('fixed fixed-show');
                  isShow = false;
                }
              }
          }
          else {
              $self.removeClass('fixed fixed-show');
          }

        });
    });
    

}(document, window, jQuery));