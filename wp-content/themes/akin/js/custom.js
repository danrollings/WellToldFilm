jQuery( function( $ ) {
	'use strict';
	/*jslint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false */
	/*jshint undef: false, browser: true, devel: false, eqeqeq: false, bitwise: false, white: false, plusplus: false, regexp: false, nomen: false, validthis: true */
	/*global jQuery */

	var $window = $( window ),
		$body   = $( 'body' );

	// contact form
	if ( $( '.peThemeContactForm' ).length > 0 ) {

		$( '.peThemeContactForm' ).peThemeContactForm();

	}
	
	$('.sidebar > .widget').find('h3').replaceWith(function () {
		return '<h6>'+$(this).html()+'</h6>';
	}).end().each(function () {
		//this.className = this.className.replace(/_/g,'-');
	});

	// responsive videos
	$( '.vendor' ).fitVids();
	
});