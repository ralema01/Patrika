/* global patrikaScreenReaderText */
/**
 * Theme functions file.
 *
 * Contains handlers for navigation and widget area.
 */

(function( $ ) {
  var masthead, menuToggle, siteNavContain, siteNavigation;

  function initMainNavigation( container ) {

    // Add dropdown toggle that displays child menu items.
    var dropdownToggle = $( '<button />', { 'class': 'dropdown-toggle', 'aria-expanded': false })
      // .append( patrikaScreenReaderText.icon )
      .append( $( '<i />', { 'class': "fas fa-chevron-down", text: patrikaScreenReaderText.d }) );

    container.find( '.menu-item-has-children > a, .page_item_has_children > a' ).after( dropdownToggle );

    // Set the active submenu dropdown toggle button initial state.
    container.find( '.current-menu-ancestor > button' )
      .addClass( 'na' )
      .attr( 'aria-expanded', 'true' )
      .find( '.screen-reader-text' )
      .text( patrikaScreenReaderText.collapse );
    // Set the active submenu initial state.
    container.find( '.current-menu-ancestor > .sub-menu' ).addClass( 'na' );

    container.find( '.dropdown-toggle' ).click( function( e ) {
      var _this = $( this ),
        screenReaderSpan = _this.find( '.screen-reader-text' );

      e.preventDefault();
      _this.toggleClass( 'toggled-on' );
      _this.next( '.children, .sub-menu' ).toggleClass( 'toggled-on' );

      _this.attr( 'aria-expanded', _this.attr( 'aria-expanded' ) === 'false' ? 'true' : 'false' );

      screenReaderSpan.text( screenReaderSpan.text() === patrikaScreenReaderText.expand ? patrikaScreenReaderText.collapse : patrikaScreenReaderText.expand );
    });
  }

  initMainNavigation( $( '.main-navigation' ) );

  masthead       = $( '#masthead' );
  menuToggle     = masthead.find( '.menu-toggle' );
  siteNavContain = masthead.find( '.main-navigation' );
  siteNavigation = masthead.find( '.main-navigation > div > ul' );

  // Enable menuToggle.
  (function() {

    // Return early if menuToggle is missing.
    if ( ! menuToggle.length ) {
      return;
    }

    // Add an initial value for the attribute.
    menuToggle.attr( 'aria-expanded', 'false' );

    menuToggle.on( 'click.patrika', function() {
      siteNavContain.toggleClass( 'toggled-on' );

      $( this ).attr( 'aria-expanded', siteNavContain.hasClass( 'toggled-on' ) );
    });
  })();

  // Fix sub-menus for touch devices and better focus for hidden submenu items for accessibility.
  (function() {
    if ( ! siteNavigation.length || ! siteNavigation.children().length ) {
      return;
    }

    // Toggle `focus` class to allow submenu access on tablets.
    function toggleFocusClassTouchScreen() {
      if ( 'none' === $( '.menu-toggle' ).css( 'display' ) ) {

        $( document.body ).on( 'touchstart.patrika', function( e ) {
          if ( ! $( e.target ).closest( '.main-navigation li' ).length ) {
            $( '.main-navigation li' ).removeClass( 'focus' );
          }
        });

        siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' )
          .on( 'touchstart.patrika', function( e ) {
            var el = $( this ).parent( 'li' );

            if ( ! el.hasClass( 'focus' ) ) {
              e.preventDefault();
              el.toggleClass( 'focus' );
              el.siblings( '.focus' ).removeClass( 'focus' );
            }
          });

      } else {
        siteNavigation.find( '.menu-item-has-children > a, .page_item_has_children > a' ).unbind( 'touchstart.patrika' );
      }
    }

    if ( 'ontouchstart' in window ) {
      $( window ).on( 'resize.patrika', toggleFocusClassTouchScreen );
      toggleFocusClassTouchScreen();
    }

    siteNavigation.find( 'a' ).on( 'focus.patrika blur.patrika', function() {
      $( this ).parents( '.menu-item, .page_item' ).toggleClass( 'focus' );
    });
  })();
})( jQuery );


jQuery(document).ready(function($) {
    var navbar = $(".navbar");
    $(window).scroll(function() {    
        var scroll = $(window).scrollTop();
    
        if (scroll >= 10) {
            navbar.addClass("navbar-fixed");
        } else {
            navbar.removeClass("navbar-fixed");
        }
    });
});


/**
*
* To The Top
*
**/

jQuery(document).ready(function($){
    $(window).scroll(function(){
        if ($(this).scrollTop() > 50) {
            $('#up-btn').fadeIn('fast');
        } else {
            $('#up-btn').fadeOut('medium');
        }
    });
    $('#up-btn').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 1800);
        return false;
    });
});

/* Lazy Magic Scroll SLide */
(function( $ ) {
  
  var $animation_elements = $('');
  var $window = $(window);

  function check_if_in_view() {
    var window_height = $window.height();
    var window_top_position = $window.scrollTop();
    var window_bottom_position = (window_top_position + window_height);
   
    $.each($animation_elements, function() {
      var $element = $(this);
      var element_height = $element.outerHeight();
      var element_top_position = $element.offset().top;
      var element_bottom_position = (element_top_position + element_height);
   
      //check to see if this current container is within viewport
      if ((element_bottom_position >= window_top_position) &&
          (element_top_position <= window_bottom_position)) {
        $element.addClass('in-view');
      }
    });
  }

  $window.on('scroll resize', check_if_in_view);
  $window.trigger('scroll');

  $('.navbar-button, .wholebackgroundoverlay').click(function(){
      $('.wholebackgroundoverlay, body, .side-menu-open').toggleClass('is-open');
  });

})( jQuery );