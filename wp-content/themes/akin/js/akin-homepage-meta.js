jQuery( window ).load( function() {

	'use strict';

	var showWhenSplash = jQuery( '#pe_theme_meta_hero__gallery_, #pe_theme_meta_hero__logo_' ).closest( '.option' );

	if ( jQuery( 'label[for="pe_theme_meta_hero__splash__0"]' ).hasClass( 'ui-state-active') ) { // image home

		showWhenSplash.fadeIn(0);

	} else if ( jQuery( 'label[for="pe_theme_meta_hero__splash__1"]' ).hasClass( 'ui-state-active') ) { // gallery homr

		showWhenSplash.fadeOut(0);

	}

	jQuery( 'label[for="pe_theme_meta_hero__splash__0"], label[for="pe_theme_meta_hero__splash__1"]' ).on( 'click', function(e) {

		if ( jQuery( 'label[for="pe_theme_meta_hero__splash__0"]' ).hasClass( 'ui-state-active') ) { // image home

			showWhenSplash.fadeIn(0);

		} else if ( jQuery( 'label[for="pe_theme_meta_hero__splash__1"]' ).hasClass( 'ui-state-active') ) { // gallery homr

			showWhenSplash.fadeOut(0);

		}

	});

	pe_theme_meta_blog_custom();

	jQuery( 'body' ).on( 'click', 'label[for$="_blog_layout_0"], label[for$="_blog_layout_1"]', pe_theme_meta_blog_custom );

});

function pe_theme_meta_blog_custom() {

	jQuery( 'label[for$="_blog_layout_0"]' ).each( function() {

	var $this = jQuery( this ),
		toControl = $this.closest( '.pe_block_settings' ).find( 'input[id$="_subtitle"], input[id$="_button_text"], input[id$="_button_link"], input[id$="_image"]' ).closest( '.option' );

	if ( $this.hasClass( 'ui-state-active' ) ) {
		toControl.hide();
	} else {
		toControl.show();
	}

	});

}

jQuery( document ).ready( pe_theme_meta_blog_custom );