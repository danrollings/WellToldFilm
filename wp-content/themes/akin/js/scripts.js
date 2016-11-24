jQuery(window).load(function () {

    "use strict";

    // Remove loader

    jQuery('#progress-bar').width('100%');
    jQuery('#loader').hide();

    var $navigation = jQuery( '#the-navigation' ),
        isLoggedIn = jQuery( '#wpadminbar' ).length;

    peThemeOffset = isLoggedIn ? $navigation.outerHeight() + jQuery( '#wpadminbar' ).height() : $navigation.outerHeight();

    if ( '' !== window.location.hash && jQuery( 'body' ).find( '#section-' + window.location.hash.substring(1) ).length ) {

        jQuery.smoothScroll({
            speed: 800,
            offset: -peThemeOffset,
            scrollTarget: '#section-' + window.location.hash.substring(1)
        });

    }

    jQuery('.home-hero-slider .slides li').each(function () {

        var slideHeight = jQuery(this).height();
        var contentHeight = jQuery(this).children('.slide-content').height();
        var padTop = (slideHeight / 3) - (contentHeight / 2);

        jQuery(this).children('.slide-content').css('padding-top', padTop);

    });

    jQuery( window ).trigger( 'resize' );

});

var peThemeOffset;

jQuery(document).ready(function () {

    "use strict";

    var $navigation = jQuery( '#the-navigation' ),
        isLoggedIn = jQuery( '#wpadminbar' ).length;

    peThemeOffset = isLoggedIn ? $navigation.outerHeight() + jQuery( '#wpadminbar' ).height() : $navigation.outerHeight();

    // Loader bar

    var count = 1;

    jQuery('img').load(function () {

        jQuery('#progress-bar').css('width', count * 170);
        count = count + 1;
    });

    jQuery('#loader').css('padding-top', jQuery(window).height() / 2);

    // Smooth Scroll to internal links

    jQuery('.smoothscroll a').on( 'click', function( e ) {

        var $this = jQuery( this ),
            target = '#section-' + $this.prop( 'hash' ).substring(1);

        if ( window.location.href.replace( window.location.hash, '' ) === $this.attr( 'href' ) ) {

            e.preventDefault();

            jQuery.smoothScroll(0);

            return;

        }

        if (  '' === $this.prop( 'hash' ) || ! jQuery( 'body' ).find( target ).length ) {

            return;

        }

        jQuery.smoothScroll({
            speed: 800,
            offset: -peThemeOffset,
            scrollTarget: target
        });

    });

    // Initialize Sliders

    jQuery('.home-hero-slider').flexslider({
        directionNav: false
    });

    jQuery('.testimonials-slider').flexslider({
        directionNav: false,
        animation: "slide",
        slideshow: false
    });

    jQuery('.client-slider').flexslider({
        directionNav: false,
        controlNav: false,
        maxItems: 4,
        minItems: 1,
        move: 1,
        animation: "slide",
        itemWidth: 250,
        slideshowSpeed: 7000
    });

    jQuery('.about-detail-slider').each( function() {

        var $this = jQuery( this );

        $this.flexslider({
            directionNav: false,
            manualControls: $this.closest( 'section' ).find(".about-toggle li"),
            animation: "slide",
            smoothHeight: true,
            slideshow: false,
            animationSpeed: 400,
            touch: false
        });

    });

    jQuery('.project-slider').flexslider({
        directionNav: false,
        smoothHeight: true
    });
    
    jQuery('.post-slider').flexslider({
        directionNav: false,
        smoothHeight: true
    });
    
    jQuery('.blog-left a').addClass('highlight');
    jQuery('.post h4 a').addClass('lowlight');
    jQuery('.blog-right a').addClass('highlight');

    // Mobile Menu

    jQuery('#mobile-toggle').click(function () {
        if (jQuery('#the-navigation').hasClass('open-nav')) {
            jQuery('#the-navigation').removeClass('open-nav');
        } else {
            jQuery('#the-navigation').addClass('open-nav');
        }
    });

    jQuery('#menu > ul li a').click(function () {
        if (jQuery('#the-navigation').hasClass('open-nav')) {
            jQuery('#the-navigation').removeClass('open-nav');
        }
    });

    // Adjust slide height for smaller screens

    jQuery('.home-hero-slider .slides li').css('height', jQuery(window).height());



    // Append HTML <img>'s as CSS Background for slides
    // also center the content of the slide

    jQuery('.home-hero-slider .slides li').each(function () {

        var imgSrc = jQuery(this).children('.slider-bg').attr('src');
        jQuery(this).css('background', 'url("' + imgSrc + '")');
        jQuery(this).children('.slider-bg').remove();

        var slideHeight = jQuery(this).height();
        var contentHeight = jQuery(this).children('.slide-content').height();
        var padTop = (slideHeight / 3) - (contentHeight / 2);

        jQuery(this).children('.slide-content').css('padding-top', padTop);

    });

    // Turn dynamic animations for iOS devices (because it doesn't look right)

    var iOS = false,
        p = navigator.platform;

    if (p === 'iPad' || p === 'iPhone' || p === 'iPod') {
        iOS = true;
    }

    // Sticky Nav

    jQuery(window).scroll(function () {

        if (jQuery(window).scrollTop() > 100) {
            jQuery('#the-navigation').addClass('sticky-nav');
        } else {
            jQuery('#the-navigation').removeClass('sticky-nav');
        }

        // Parallax

        if (iOS === false) {

            var scrollAmount = jQuery(window).scrollTop() / 5;
            scrollAmount = Math.round(scrollAmount);
            jQuery('.has-parallax').css('backgroundPosition', '50% ' + scrollAmount + 'px');

        }
    });

    // Append .divider <img> tags as CSS backgrounds

    jQuery('.divider').each(function () {
        var imgSrc = jQuery(this).children('.divider-bg').attr('src');
        jQuery(this).css('background', 'url("' + imgSrc + '")');
        jQuery(this).children('.divider-bg').remove();
    });

    
    // About slide clicks

    jQuery('.about-toggle li').click(function () {
        jQuery('.about-toggle li').removeClass('active');
        jQuery(this).addClass('active');
    });

    // Team Hovers

    jQuery('.team-member').hover(function () {
        jQuery('.team-member').addClass('team-focus');
        jQuery(this).removeClass('team-focus');
    }, function () {

        jQuery('.team-member').removeClass('team-focus');
    });


    // Portfolios

    jQuery('.filters li').click(function () {

        var $this = jQuery( this );

        $this
            .addClass('active')
            .siblings()
                .removeClass('active');

        var category = $this.attr('data-category');

        $this
            .closest('.projects-wrapper')
                .find('.project')
                    .removeClass('hide-project');

        if (category !== 'all') {
            $this
                .closest('.projects-wrapper')
                    .find('.project')
                    .each(function () {

                        if (!jQuery(this).hasClass(category)) {
                            jQuery(this).addClass('hide-project');
                        }

            });
        }

    });

    // Project Clicks with AJAX call
    jQuery('.project').click(function (event) {
        event.preventDefault();
        var projectContainer = jQuery(this).closest('.projects-wrapper').children('.ajax-container').attr('data-container');

        if (jQuery('.ajax-container[data-container="'+projectContainer+'"]').hasClass('open-container')) {
            jQuery('.ajax-container[data-container="'+projectContainer+'"]').addClass('closed-container');
            jQuery('.ajax-container[data-container="'+projectContainer+'"]').removeClass('open-container');
        }

        var fileID = jQuery(this).attr('data-project-file');

        if (fileID != null) {
            jQuery('html,body').animate({
                scrollTop: jQuery('.ajax-container[data-container="'+projectContainer+'"]').offset().top - peThemeOffset
            }, 500);

        }
        
        jQuery('.ajax-container[data-container="'+projectContainer+'"]').load(fileID+" .project-body", function(){
        	jQuery('.ajax-container[data-container="'+projectContainer+'"]').addClass('open-container');
        	jQuery('.project-slider').flexslider({
                directionNav: false
            });
            jQuery('.ajax-container[data-container="'+projectContainer+'"]').removeClass('closed-container');
            
            jQuery('.close-project').click(function () {
                jQuery('.ajax-container[data-container="'+projectContainer+'"]').addClass('closed-container');
                jQuery('.ajax-container[data-container="'+projectContainer+'"]').removeClass('open-container');
                jQuery('html,body').animate({
                    scrollTop: jQuery(this).closest('section').find('.projects-container').offset().top - peThemeOffset
                }, 500);
                setTimeout(function () {
                    jQuery('.ajax-container[data-container="'+projectContainer+'"]').html('');
                }, 1000);
            });
        });

    });

    // Reset form contents
    jQuery('.reset-btn').click(function () {
        jQuery(this).closest( 'form' ).find('input[type="text"], input[type="email"], textarea').val('');
    });

    jQuery('.send-btn').click(function () {
        jQuery(this).closest( 'form' ).submit();
    });




});