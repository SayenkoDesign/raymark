(function (document, window, $) {

	'use strict';
    
    var scrollnow = function(e) {
        
        var target;
                        
        // if scrollnow()-function was triggered by an event
        if (e) {
            e.preventDefault();
            target = this.hash;
        }
        // else it was called when page with a #hash was loaded
        else {
            target = location.hash;
        }

        // same page scroll
        // Hide/show site-header for fixed header jumps
        $.smoothScroll({
            scrollTarget: target,
            beforeScroll: function() {
                $('.site-header').hide();
            },
            afterScroll: function() {
                 $('.site-header').show();
            },
            
        });
    };
    
    if (location.hash) {
        $('html, body').scrollTop(0).show();

        $(window).load(function() {
            // if page has a #hash
            // smooth-scroll to hash
            scrollnow();
        });
    
    }

    // for each <a>-element that contains a "/" and a "#"
    $('a[href*="/"][href*=#]').each(function(){
        // if the pathname of the href references the same page
        if (this.pathname.replace(/^\//,'') === location.pathname.replace(/^\//,'') && this.hostname === location.hostname) {
            // only keep the hash, i.e. do not keep the pathname
            $(this).attr("href", this.hash);
        }
    });

    // select all href-elements that start with #
    // including the ones that were stripped by their pathname just above
    $('body').on('click', 'a[href^=#]:not([href=#])', scrollnow );

}(document, window, jQuery));

