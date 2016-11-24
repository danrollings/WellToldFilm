<?php

class PeThemeAkinAsset extends PeThemeAsset  {

	public function __construct(&$master) {

		$this->minifiedJS = 'theme/compressed/theme.min.js';
		$this->minifiedCSS = 'theme/compressed/theme.min.css';

		//define( 'PE_THEME_LOCAL_VIDEO_SUPPORT',true);

		parent::__construct($master);
		
	}

	public function registerAssets() {

		add_filter( 'pe_theme_js_init_file',array(&$this, 'pe_theme_js_init_file_filter' ));
		add_filter( 'pe_theme_js_init_deps',array(&$this, 'pe_theme_js_init_deps_filter' ));
		add_filter( 'pe_theme_minified_js_deps',array(&$this, 'pe_theme_minified_js_deps_filter' ));
		
		parent::registerAssets();

		if ($this->minifyCSS) {

			$deps = array(
				'pe_theme_compressed',
			);

		} else {

			// theme styles
			$this->addStyle("css/foundation.css",array(),"pe_theme_akin-foundation");
			$this->addStyle("css/flexslider.css",array(),"pe_theme_akin-flexslider");
			$this->addStyle("css/icons.css",array(),"pe_theme_akin-icons");
			$this->addStyle("css/style.css",array(),"pe_theme_akin-style");
			$this->addStyle("css/animate.css",array(),"pe_theme_akin-animate");
			$this->addStyle("css/responsive.css",array(),"pe_theme_akin-responsive");
			$this->addStyle("css/custom.css",array(),"pe_theme_akin-custom");

			$deps = array(
				'pe_theme_akin-foundation',
				'pe_theme_akin-flexslider',
				'pe_theme_akin-icons',
				'pe_theme_akin-style',
				'pe_theme_akin-animate',
				'pe_theme_akin-responsive',
				'pe_theme_akin-custom',
			);

		}

		$this->addStyle( 'style.css',$deps, 'pe_theme_init' );

		$this->addScript( 'theme/js/pe/pixelentity.controller.js', array(
			//'pe_theme_mobile',
			'pe_theme_utils_browser',
			'pe_theme_selectivizr',
			'pe_theme_lazyload',
			//'pe_theme_flare',
			'pe_theme_widgets_contact',
			'pe_theme_akin-modernizer',
			'pe_theme_akin-fitvids',
			'pe_theme_akin-foundation',
			'pe_theme_akin-flexslider',
			'pe_theme_akin-smooth_scroll',
			'pe_theme_akin-scripts',
			'pe_theme_akin-custom'
		), 'pe_theme_controller' );

		$this->addScript("js/vendor/custom.modernizr.js",array(),"pe_theme_akin-modernizer");
		$this->addScript("js/vendor/jquery.fitvids.js",array('jquery'),"pe_theme_akin-fitvids");
		$this->addScript("js/foundation.min.js",array(),"pe_theme_akin-foundation");
		$this->addScript("js/jquery.flexslider-min.js",array(),"pe_theme_akin-flexslider");
		$this->addScript("js/smooth-scroll.js",array(),"pe_theme_akin-smooth_scroll");
		$this->addScript("js/scripts.js",array(),"pe_theme_akin-scripts");
		$this->addScript("js/custom.js",array(),"pe_theme_akin-custom");
		
	}

	public function pe_theme_js_init_file_filter( $js ) {

		return $js;
		//return 'js/custom.js';

	}

	public function pe_theme_js_init_deps_filter( $deps ) {

		return $deps;
		/*
		  return array(
		  'jquery',
		  );
		*/
	}

	public function pe_theme_minified_js_deps_filter( $deps ) {

		return $deps;
		//return array( 'jquery' );

	}

	public function style() {

		bloginfo( 'stylesheet_url' ); 

	}

	public function enqueueAssets() {

		$this->registerAssets();

		$t =& peTheme();

		if ( $this->minifyJS && file_exists( PE_THEME_PATH . '/preview/init.js' ) ) {

			$this->addScript( 'preview/init.js', array( 'jquery' ), 'pe_theme_preview_init' );
			
			wp_localize_script( 'pe_theme_preview_init', 'o', array(
			//'dark' => PE_THEME_URL.'/css/dark_skin.css',
				'css' => $this->master->color->customCSS( true, 'color1' )
			) );

			wp_enqueue_script( 'pe_theme_preview_init' );

		}	

		wp_enqueue_style( 'pe_theme_init' );
		wp_enqueue_script( 'pe_theme_init' );

		wp_localize_script( 'pe_theme_init', '_akin', array(
			'ajax-loading' => PE_THEME_URL . '/images/ajax-loader.gif',
			'home_url'     => home_url( '/' ),
		) );

		if ( $this->minifyJS && file_exists( PE_THEME_PATH . '/preview/preview.js' ) ) {

			$this->addScript( 'preview/preview.js',array( 'pe_theme_init' ), 'pe_theme_skin_chooser' );

			wp_localize_script( 'pe_theme_skin_chooser', 'pe_skin_chooser', array( 'url' => urlencode( PE_THEME_URL . '/' ) ) );
			wp_enqueue_script( 'pe_theme_skin_chooser' );

		}

		//wp_enqueue_script( 'pe_theme_akin_gmap', '//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false' );

	}


}