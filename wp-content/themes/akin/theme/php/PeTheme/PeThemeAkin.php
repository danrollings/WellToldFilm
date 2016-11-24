<?php

class PeThemeAkin extends PeThemeController {

	public $preview = array();

	public function __construct() {

		// custom post types
		add_action("pe_theme_custom_post_type",array(&$this,"pe_theme_custom_post_type"));

		// wp_head stuff
		add_action("pe_theme_wp_head",array(&$this,"pe_theme_wp_head"));

		// google fonts
		add_filter("pe_theme_font_variants",array(&$this,"pe_theme_font_variants_filter"),10,2);

		// menu
		add_filter("wp_nav_menu_objects",array(&$this,"wp_nav_menu_objects_filter"),10,2);
		add_filter("pe_theme_menu_item_after",array(&$this,"pe_theme_menu_item_after_filter"),10,3);

		// custom menu fields
		add_filter("pe_theme_menu_custom_fields",array(&$this,"pe_theme_menu_custom_fields_filter"),10,3);

		// social links
		add_filter("pe_theme_social_icons",array(&$this,"pe_theme_social_icons_filter"));
		add_filter("pe_theme_content_get_social_link",array(&$this,"pe_theme_content_get_social_link_filter"),10,4);

		// comment submit button class
		add_filter("pe_theme_comment_submit_class",array(&$this,"pe_theme_comment_submit_class_filter"));

		// use prio 30 so gets executed after standard theme filter
		add_filter("the_content_more_link",array(&$this,"the_content_more_link_filter"),30);

		// remove junk from project screen
		add_action('pe_theme_metabox_config_project',array(&$this,'pe_theme_akin_metabox_config_project'),200);

		// add featured image to testimonial
		add_action('init',array(&$this,'pe_theme_akin_testimonial_supports'),200);

		// shortcodes
		add_filter("pe_theme_shortcode_columns_mapping",array(&$this,"pe_theme_shortcode_columns_mapping_filter"));
		add_filter("pe_theme_shortcode_columns_options",array(&$this,"pe_theme_shortcode_columns_options_filter"));
		add_filter("pe_theme_shortcode_columns_container",array(&$this,"pe_theme_shortcode_columns_container_filter"),10,2);

		// portfolio
		add_filter("pe_theme_filter_item",array(&$this,"pe_theme_project_filter_item_filter"),10,4);

		// remove staff meta
		add_action('pe_theme_metabox_config_staff',array(&$this,'pe_theme_metabox_config_staff_action'),11);

		// alter services meta
		add_action('pe_theme_metabox_config_service',array(&$this,'pe_theme_metabox_config_service_action'),11);

		// custom meta for gallery images
		add_filter( 'pe_theme_gallery_image_fields', array( $this, 'pe_theme_gallery_image_fields_filter' ) );

		// custom homepage meta js
		add_action( 'admin_enqueue_scripts', array( $this, 'pe_theme_akin_custom_meta_js' ) );

		// font awesome admin picker
		add_action( 'admin_enqueue_scripts', array( $this, 'pe_theme_font_awesome_icons' ) );

		// custom video metabox
		add_action('pe_theme_metabox_config_video',array(&$this,'pe_theme_metabox_config_video'),99);

		// builder
		add_filter('pe_theme_view_layout_open',array(&$this,'pe_theme_view_layout_no_parent'));
		add_filter('pe_theme_view_layout_close',array(&$this,'pe_theme_view_layout_no_parent'));
		add_filter('pe_theme_layoutmodule_open',array(&$this,'pe_theme_view_layout_no_parent'));
		add_filter('pe_theme_layoutmodule_close',array(&$this,'pe_theme_view_layout_no_parent'));

	}

	public function pe_theme_view_layout_no_parent($markup) {
		return "";
	}

	public function pe_theme_akin_custom_meta_js() {

		PeThemeAsset::addScript("js/akin-homepage-meta.js",array('jquery'),"pe_theme_akin_homepage_meta");

		$screen = get_current_screen();

		if ( is_admin() && ( 'page' === $screen->post_type || 'post' === $screen->post_type ) ) {
			wp_enqueue_script("pe_theme_akin_homepage_meta");
		}

	}

	public function pe_theme_font_awesome_icons() {

		PeThemeAsset::addStyle("css/icons.css",array(),"pe_theme_akin-icons");

		$screen = get_current_screen();

		if ( is_admin() && ( 'page' === $screen->post_type || 'post' === $screen->post_type || 'project' === $screen->post_type ) ) {
			wp_enqueue_style("pe_theme_akin-icons");
		}

	}

	public function the_content_more_link_filter($link) {
		return sprintf('<div class="read-more-wrap"><a class="read-more-link highlight" href="%s">%s</a></div>',get_permalink(),__("Continue Reading..",'Pixelentity Theme/Plugin'));
	}

	public function pe_theme_project_filter_item_filter( $html, $aclass, $slug, $name ) {
		return sprintf( '<li %s data-category="%s"><h6>%s</h6></li>', '' === $slug ? 'class="active"' : '','' === $slug ? 'all' : "filter-$slug", $name );
	}

	public function pe_theme_wp_head() {
		$this->font->apply();
		$this->color->apply();

		// custom CSS field
		if ($customCSS = $this->options->get("customCSS")) {
			printf('<style type="text/css">%s</style>',stripslashes($customCSS));
		}

		// custom JS field
		if ($customJS = $this->options->get("customJS")) {
			printf('<script type="text/javascript">%s</script>',stripslashes($customJS));
		}

	}

	public function pe_theme_font_variants_filter($variants,$font) {
		if ($font === "Open Sans") {
			$variants="$font:400italic,300,400,700,800";
		}
		else if ($font === "Lato") {
			$variants="$font:300,400,700";
		}
		else if ($font === "Montserrat") {
			$variants="$font:400,700";
		}
		else if ($font === "Volkhov") {
			$variants="$font:400italic,700italic,400,700";
		}

		return $variants;
	}

	public function wp_nav_menu_objects_filter( $items, $args ) {

		if ( is_array( $items ) && ! empty( $args->theme_location ) ) {

			foreach ($items as $id => $item) {
				
				$item->classes[] = 'smoothscroll';

			}
		}

		return $items;

	}

	public function pe_theme_menu_item_after_filter($after,$item,$depth) {
		if ($item->object == 'page' && !empty($item->pe_meta->name)) {
			$section = strtr($item->pe_meta->name,array('#' => ''));
			$item->url .= "#$section";
		}
		return $after;
	}

	public function pe_theme_menu_custom_fields_filter($options,$depth = false,$item = false) {

		if (!empty($item->object) && $item->object != "page") {
			// if menu item is not a page, no custom option
			return $options;
		}

		$options =
			array(
				  "name" => 
				  array(
						"label"=>__("Section",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Optional section link name.",'Pixelentity Theme/Plugin'),
						"default"=> ""
						)
				  );

	
		return $options;

	}

	public function pe_theme_social_icons_filter($icons = null) {
		return 
			array(
				  // label => icon | tooltip text
				  __("Blogger",'Pixelentity Theme/Plugin') => "icon social_blogger",
				  __("Delicious",'Pixelentity Theme/Plugin') => "icon social_delicious",
				  __("Dribbble",'Pixelentity Theme/Plugin') => "icon social_dribbble",
				  __("DeviantArt",'Pixelentity Theme/Plugin') => "icon social_deviantart",
				  __("Facebook",'Pixelentity Theme/Plugin') => "icon social_facebook",
				  __("Flickr",'Pixelentity Theme/Plugin') => "icon social_flickr",
				  __("Google Drive",'Pixelentity Theme/Plugin') => "icon social_googledrive",
				  __("Google+",'Pixelentity Theme/Plugin') => "icon social_googleplus",
				  __("Instagram",'Pixelentity Theme/Plugin') => "icon social_instagram",
				  __("Linkedin",'Pixelentity Theme/Plugin') => "icon social_linkedin",
				  __("MySpace",'Pixelentity Theme/Plugin') => "icon social_myspace",
				  __("Picassa",'Pixelentity Theme/Plugin') => "icon social_picassa",
				  __("Pinterest",'Pixelentity Theme/Plugin') => "icon social_pinterest",
				  __("Rss",'Pixelentity Theme/Plugin') => "icon social_rss",
				  __("Share",'Pixelentity Theme/Plugin') => "icon social_share",
				  __("Skype",'Pixelentity Theme/Plugin') => "icon social_skype",
				  __("Spotify",'Pixelentity Theme/Plugin') => "icon social_spotify",
				  __("StumbleUpon",'Pixelentity Theme/Plugin') => "icon social_tumbleupon",
				  __("Tumblr",'Pixelentity Theme/Plugin') => "icon social_tumblr",
				  __("Twitter",'Pixelentity Theme/Plugin') => "icon social_twitter",
				  __("Vimeo",'Pixelentity Theme/Plugin') => "icon social_vimeo",
				  __("WordPress",'Pixelentity Theme/Plugin') => "icon social_wordpress",
				  __("YouTube",'Pixelentity Theme/Plugin') => "icon social_youtube",
				  );
	}

	public function pe_theme_content_get_social_link_filter($html,$link,$tooltip,$icon) {
		return sprintf('<li><a href="%s" target="_blank" title="%s"><i class="%s"></i></a></li>',$link,$tooltip,$icon);
	}

	public function pe_theme_comment_submit_class_filter() {
		return "btn btn-success";
	}

	public function init() {
		parent::init();

		if (PE_THEME_PLUGIN_MODE) {
			return;
		}
		
		if ($this->options->get("retina") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_retina_filter"),10,5);
		} else if ($this->options->get("lazyImages") === "yes") {
			add_filter("pe_theme_resized_img",array(&$this,"pe_theme_resized_img_filter"),10,4);
		}
	}

	public function pe_theme_custom_post_type() {
		$this->gallery->cpt();
		$this->video->cpt();
		$this->project->cpt();
		//$this->ptable->cpt();
		//$this->staff->cpt();
		//$this->service->cpt();
		//$this->testimonial->cpt();
		//$this->logo->cpt();
		//$this->slide->cpt();
		//$this->view->cpt();

	}

	public function pe_theme_shortcode_columns_mapping_filter($array) {
			return array(
				'1/1' => 'col-sm-12',
				"1/3" => "col-sm-4",
				"1/2" => "col-sm-6",
				"1/4" => "col-sm-3",
				"2/3" => "col-sm-8",
				"1/6" => "col-sm-2",
				"last" => '',
			);
		}

	public function pe_theme_shortcode_columns_options_filter($array) {
		unset($array['2 Column layouts']['5/6 1/6']);
		unset($array['2 Column layouts']['1/6 5/6']);
		unset($array['2 Column layouts']['1/4 3/4']);
		unset($array['2 Column layouts']['3/4 1/4']);
		unset($array['3 Column layouts']['1/4 1/4 2/4']);
		unset($array['3 Column layouts']['2/4 1/4 1/4']);

		$single['Single column layout']['1/1'] = '1/1';

		$array = 
			array_merge(
						$single,
						$array
						);
		//unset($array['4 Column layouts']);
		//unset($array['6 Column layouts']);

		return $array;
	}

	public function pe_theme_shortcode_columns_container_filter( $template, $content ) {

		return sprintf('<div class="row">%s</div>',$content);

	}


	public function boot() {
		parent::boot();

		
		PeGlobal::$config["content-width"] = 990;
		PeGlobal::$config["post-formats"] = array("video","gallery");
		PeGlobal::$config["post-formats-project"] = array("video","gallery");

		PeGlobal::$config["image-sizes"]["thumbnail"] = array(120,90,true);
		PeGlobal::$config["image-sizes"]["post-thumbnail"] = array(260,200,false);
		

		// blog layouts
		PeGlobal::$config["blog"] =
			array(
				  __("Default",'Pixelentity Theme/Plugin') => "",
				  __("Search",'Pixelentity Theme/Plugin') => "search",
				  __("Alternate",'Pixelentity Theme/Plugin') => "project"
				  );

		PeGlobal::$config["shortcodes"] = 
			array(
				  //"BS_Badge",
				  //"BS_Label",
				  //"BS_Button",
				  //"AkinNumber",
				  "AkinButton",
				  //"AkinIcon",
				  //"AkinService",
				  //"AkinNewsletter",
				  "BS_Columns",
				  "BS_Video"
				  );

		PeGlobal::$config["views"] = array(
			"LayoutModuleAkinAbout",
			"LayoutModuleAkinAboutProcess",
			"LayoutModuleAkinAboutProcessElement",
			"LayoutModuleAkinAboutStory",
			"LayoutModuleAkinAboutTeam",
			"LayoutModuleAkinAboutTeamElement",
			"LayoutModuleAkinBlog",
			"LayoutModuleAkinClients",
			"LayoutModuleAkinColumns",
			"LayoutModuleAkinContact",
			"LayoutModuleAkinIntro",
			"LayoutModuleAkinPortfolio",
			"LayoutModuleAkinService",
			"LayoutModuleAkinServices",
			"LayoutModuleAkinSocial",
			"LayoutModuleAkinTestimonial",
			"LayoutModuleAkinTestimonials",
			"LayoutModuleAkinText",
		);

		PeGlobal::$config["sidebars"] =
			array(
				  "default" => __("Default post/page",'Pixelentity Theme/Plugin'),
				  //"footer" => __("Footer Widgets",'Pixelentity Theme/Plugin')
				  );

		PeGlobal::$config["colors"] = array(
			"color1" => array(
				"label"     => __("Primary Color",'Pixelentity Theme/Plugin'),
				"selectors" => array(
					".highlight" => "color",
					".post.sticky .post-title h4 a" => "color",

					".about-toggle .active, .filters .active" => "border-color",
				),
				"default" => "#d4a16b",
			),
			"color2" => array(
				"label"     => __("Header Color",'Pixelentity Theme/Plugin'),
				"selectors" => array(
					".inner-nav" => "background-color:0.9",
					".sticky-nav" => "background-color:0.9",
				),
				"default" => "#fff",
			),
			"color3" => array(
				"label"     => __("Footer Color",'Pixelentity Theme/Plugin'),
				"selectors" => array(
					".section-contact:before" => "background-color",
					"#footer" => "background-color",
				),
				"default" => "#222",
			),
		);
		

		PeGlobal::$config["fonts"] = array(
			"fontBody" => array(
				"label"     => __("General Font",'Pixelentity Theme/Plugin'),
				"selectors" => array(
					"body",
					".team-member .position",
				),
				"default" => "Lato",
			),
			"fontSecondary" => array(
				"label"     => __("Secondary Font",'Pixelentity Theme/Plugin'),
				"selectors" => array(
					".ampersand",
					"#menu li a",
					".process .number",
					".team-member .title span",
					".tags a",
					".comment-meta",
					".fn",
					".tagcloud a",
					"#wp-calendar",
				),
				"default" => "Montserrat",
			),
			"fontTertiary" => array(
				"label"     => __("Tertiary Font",'Pixelentity Theme/Plugin'),
				"selectors" => array(
					".alt-h",
				),
				"default" => "Vollkorn",
			),
		);		

		$options = array();

		$galleries = $this->gallery->option();

		$none = array( __("None",'Pixelentity Theme/Plugin') => '-1' );

		$galleries = array_merge( $none, $galleries );

		$options = array_merge( $options, array(
			"import_demo" => $this->defaultOptions["import_demo"],
			"logo" => array(
				"label"       => __("Logo",'Pixelentity Theme/Plugin'),
				"type"        => "Upload",
				"section"     => __("General",'Pixelentity Theme/Plugin'),
				"description" => __("This is the main site logo image. The image should be a .png file.",'Pixelentity Theme/Plugin'),
				"default"     => PE_THEME_URL."/img/logo-square.png",
			),
			"favicon" => array(
				"label"       => __("Favicon",'Pixelentity Theme/Plugin'),
				"type"        => "Upload",
				"section"     => __("General",'Pixelentity Theme/Plugin'),
				"description" => __("This is the favicon for your site. The image can be a .jpg, .ico or .png with dimensions of 16x16px ",'Pixelentity Theme/Plugin'),
				"default"     => PE_THEME_URL."/favicon.png",
			),
			"customCSS" => $this->defaultOptions["customCSS"],
			"customJS"  => $this->defaultOptions["customJS"],
			"colors"    => array(
				"label"       => __("Custom Colors",'Pixelentity Theme/Plugin'),
				"type"        => "Help",
				"section"     => __("Colors",'Pixelentity Theme/Plugin'),
				"description" => __("In this page you can set alternative colors for the main colored elements in this theme. Three color options have been provided. To change the color used on these elements simply write a new hex color reference number into the fields below or use the color picker which appears when each field obtains focus. Once you have selected your desired colors make sure to save them by clicking the <b>Save All Changes</b> button at the bottom of the page. Then just refresh your page to see the changes.<br/><br/><b>Please Note:</b> Some of the elements in this theme are made from images (Eg. Icons) and these items may have a color. It is not possible to change these elements via this page, instead such elements will need to be changed manually by opening the img/icons in an image editing program and manually changing their colors to match your theme's custom color scheme. <br/><br/>To return all colors to their default values at any time just hit the <b>Restore Default</b> link beneath each field.",'Pixelentity Theme/Plugin'),
			),
			"googleFonts" => array(
				"label"       => __("Custom Fonts",'Pixelentity Theme/Plugin'),
				"type"        => "Help",
				"section"     => __("Fonts",'Pixelentity Theme/Plugin'),
				"description" => __("In this page you can set the typefaces to be used throughout the theme. For each elements listed below you can choose any front from the Google Web Font library. Once you have chosen a font from the list, you will see a preview of this font immediately beneath the list box. The icons on the right hand side of the font preview, indicate what weights are available for that typeface.<br/><br/><strong>R</strong> -- Regular,<br/><strong>B</strong> -- Bold,<br/><strong>I</strong> -- Italics,<br/><strong>BI</strong> -- Bold Italics<br/><br/>When decideing what font to use, ensure that the chosen font contains the font weight required by the element. For example, main headings are bold, so you need to select a new font for these elements which supports a bold font weight. If you select a font which does not have a bold icon, the font will not be applied. <br/><br/>Browse the online <a href='http://www.google.com/webfonts'>Google Font Library</a><br/><br/><b>Custom fonts</b> (Advanced Users):<br/> Other then those available from Google fonts, custom fonts may also be applied to the elements listed below. To do this an additional field is provided below the google fonts list. Here you may enter the details of a font family, size, line-height etc. for a custom font. This information is entered in the form of the shorthand 'font:' CSS declaration, for example:<br/><br/><b>bold italic small-caps 1em/1.5em arial,sans-serif</b><br/><br/>If a font is specified in this field then the font listed in the Google font drop menu above will not be applied to the element in question. If you wish to use the Google font specified in the drop down list and just specify a new font size or line height, you can do so in this field also, however the name of the Google font <b>MUST</b> also be entered into this field. You may need to visit the Google fonts web page to find the exact CSS name for the font you have chosen.",'Pixelentity Theme/Plugin'),
			),
			"contactEmail" => $this->defaultOptions["contactEmail"],
			"contactSubject" => $this->defaultOptions["contactSubject"],
			"footerCopyright" => array(
				"label"       => __("Copyright",'Pixelentity Theme/Plugin'),
				"wpml"        =>  true,
				"type"        => "TextArea",
				"section"     => __("Footer",'Pixelentity Theme/Plugin'),
				"description" => __("This is the footer copyright message.",'Pixelentity Theme/Plugin'),
				"default"     => 'Made with &nbsp;<i class="icon icon_heart red"></i> in Melbourne',
			),
		));

		
		foreach( PeGlobal::$const->gmap->metabox["content"] as $key => $value ) {

			PeGlobal::$const->gmap->metabox["content"][ $key ]["section"] = __("Footer",'Pixelentity Theme/Plugin');

		}

		unset( PeGlobal::$const->gmap->metabox["content"]["title"] );
		unset( PeGlobal::$const->gmap->metabox["content"]["description"] );
		
		//$options = array_merge($options, PeGlobal::$const->gmap->metabox["content"]);

		$options = array_merge($options,$this->font->options());
		$options = array_merge($options,$this->color->options());

		//$options["retina"] =& $this->defaultOptions["retina"];
		//$options["lazyImages"] =& $this->defaultOptions["lazyImages"];
		$options["minifyJS"] =& $this->defaultOptions["minifyJS"];
		$options["minifyCSS"] =& $this->defaultOptions["minifyCSS"];

		$options["minifyJS"]['default'] = 'yes';

		$options["adminThumbs"] =& $this->defaultOptions["adminThumbs"];
		if (!empty($this->defaultOptions["mediaQuick"])) {
			$options["mediaQuick"] =& $this->defaultOptions["mediaQuick"];
			$options["mediaQuickDefault"] =& $this->defaultOptions["mediaQuickDefault"];
		}

		$options["adminLogo"] =& $this->defaultOptions["adminLogo"];
		$options["adminUrl"] =& $this->defaultOptions["adminUrl"];

		
		
		PeGlobal::$config["options"] = apply_filters("pe_theme_options",$options);

	}

	public function hero() {

		$galleries = $this->gallery->option();

		$galleries[__("Don't use gallery",'Pixelentity Theme/Plugin')] = 0;

		$hero = array(
			'type'     => '',
			'title'    => __( 'Header' ,'Pixelentity Theme/Plugin'),
			'priority' => 'core',
			'where'    => array(
				'post' => 'all',
			),
			'content' => array(),
		);

		$hero['content']['splash'] = array(
			'label' => __( 'Display splash area' ,'Pixelentity Theme/Plugin'),
			'type'  => 'RadioUI',
			'description' => __( 'If set to yes, splash section (slider) will be displayed at the top.' ,'Pixelentity Theme/Plugin'),
			'options' => array(
				__( 'Yes' ,'Pixelentity Theme/Plugin') => 'yes',
				__( 'No' ,'Pixelentity Theme/Plugin')  => 'no',
			),
			'default' => 'no',
		);

		$hero['content']['gallery'] = array(
			'label' => __( 'Splash gallery' ,'Pixelentity Theme/Plugin'),
			'type'  => 'Select',
			'description' => __( 'Gallery displayed in the background in form of a slider.' ,'Pixelentity Theme/Plugin'),
			'options' => $galleries,
		);

		$hero['content']['logo'] = array(
			"label"       => __("Logo",'Pixelentity Theme/Plugin'),
			"type"        => "Upload",
			"description" => __("Logo image displayed at the top of the splash.",'Pixelentity Theme/Plugin'),
			'default'     => PE_THEME_URL . '/img/logo.png',
		);

		return $hero;

	}


	public function pe_theme_metabox_config_video() {
		unset( PeGlobal::$config["metaboxes-video"]['video']['content']['fullscreen'] );
		unset( PeGlobal::$config["metaboxes-video"]['video']['content']['width'] );
	}

	public function pe_theme_metabox_config_post() {
		parent::pe_theme_metabox_config_post();

		unset( PeGlobal::$config["metaboxes-post"]['gallery']['content']['type'] );

	}

	public function pe_theme_metabox_config_page() {
		parent::pe_theme_metabox_config_page();

		$builder = isset(PeGlobal::$config["metaboxes-page"]["builder"]) ? PeGlobal::$config["metaboxes-page"]["builder"] : false;
		$builder = $builder ? array("builder"=> $builder) : array();

		if (PE_THEME_MODE && $builder) {
			// top level builder element can only member of the "section" group
			$builder["builder"]["content"]["builder"]["allowed"] = "section";
		}

		PeGlobal::$config["metaboxes-page"] = array_merge(
			$builder,
			array(
				'hero'           => $this->hero(),
			)
		);

	}

	public function pe_theme_metabox_config_project() {
		parent::pe_theme_metabox_config_project();

		$galleryMbox = array(
			"title"    => __("Slider",'Pixelentity Theme/Plugin'),
			"type"     => "GalleryPost",
			"priority" => "core",
			"where"    => array(
				"post" => "gallery"
			),
			"content" => array(
				"id" => PeGlobal::$const->gallery->id,
			),
		);

		PeGlobal::$config["metaboxes-project"] =  array(
			"gallery" => $galleryMbox,
			"video"   => PeGlobal::$const->video->metaboxPost,
		);

	}

	public function pe_theme_akin_testimonial_supports() {

		//add_post_type_support( 'service', 'thumbnail' );
		//add_post_type_support( 'testimonial', 'thumbnail' );

	}

	public function pe_theme_akin_metabox_config_project() {

		unset( PeGlobal::$config["metaboxes-project"]['portfolio'] );
		unset( PeGlobal::$config["metaboxes-project"]['info'] );

	}

	public function pe_theme_metabox_config_staff_action() {

		

	}

	public function pe_theme_metabox_config_service_action() {

		

	}

	public function pe_theme_gallery_image_fields_filter( $fields ) {

		unset( $fields['video'] );
		unset( $fields['link'] );

		return $fields;

	}

	protected function init_asset() {
		return new PeThemeAkinAsset($this);
	}

	protected function init_template() {
		return new PeThemeAkinTemplate($this);
	}

}

function pe_theme_elegant_icons() {

	$elegant_icons = array(
		"none" => '',
		"arrow_up" => "arrow_up",
		"arrow_down" => "arrow_down",
		"arrow_left" => "arrow_left",
		"arrow_right" => "arrow_right",
		"arrow_left-up" => "arrow_left-up",
		"arrow_right-up" => "arrow_right-up",
		"arrow_right-down" => "arrow_right-down",
		"arrow_left-down" => "arrow_left-down",
		"arrow-up-down" => "arrow-up-down",
		"arrow_up-down_alt" => "arrow_up-down_alt",
		"arrow_left-right_alt" => "arrow_left-right_alt",
		"arrow_left-right" => "arrow_left-right",
		"arrow_expand_alt2" => "arrow_expand_alt2",
		"arrow_expand_alt" => "arrow_expand_alt",
		"arrow_condense" => "arrow_condense",
		"arrow_expand" => "arrow_expand",
		"arrow_move" => "arrow_move",
		"arrow_carrot-up" => "arrow_carrot-up",
		"arrow_carrot-down" => "arrow_carrot-down",
		"arrow_carrot-left" => "arrow_carrot-left",
		"arrow_carrot-right" => "arrow_carrot-right",
		"arrow_carrot-2up" => "arrow_carrot-2up",
		"arrow_carrot-2down" => "arrow_carrot-2down",
		"arrow_carrot-2left" => "arrow_carrot-2left",
		"arrow_carrot-2right" => "arrow_carrot-2right",
		"arrow_carrot-up_alt2" => "arrow_carrot-up_alt2",
		"arrow_carrot-down_alt2" => "arrow_carrot-down_alt2",
		"arrow_carrot-left_alt2" => "arrow_carrot-left_alt2",
		"arrow_carrot-right_alt2" => "arrow_carrot-right_alt2",
		"arrow_carrot-2up_alt2" => "arrow_carrot-2up_alt2",
		"arrow_carrot-2down_alt2" => "arrow_carrot-2down_alt2",
		"arrow_carrot-2left_alt2" => "arrow_carrot-2left_alt2",
		"arrow_carrot-2right_alt2" => "arrow_carrot-2right_alt2",
		"arrow_triangle-up" => "arrow_triangle-up",
		"arrow_triangle-down" => "arrow_triangle-down",
		"arrow_triangle-left" => "arrow_triangle-left",
		"arrow_triangle-right" => "arrow_triangle-right",
		"arrow_triangle-up_alt2" => "arrow_triangle-up_alt2",
		"arrow_triangle-down_alt2" => "arrow_triangle-down_alt2",
		"arrow_triangle-left_alt2" => "arrow_triangle-left_alt2",
		"arrow_triangle-right_alt2" => "arrow_triangle-right_alt2",
		"arrow_back" => "arrow_back",
		"icon_minus-06" => "icon_minus-06",
		"icon_plus" => "icon_plus",
		"icon_close" => "icon_close",
		"icon_check" => "icon_check",
		"icon_minus_alt2" => "icon_minus_alt2",
		"icon_plus_alt2" => "icon_plus_alt2",
		"icon_close_alt2" => "icon_close_alt2",
		"icon_check_alt2" => "icon_check_alt2",
		"icon_zoom-out_alt" => "icon_zoom-out_alt",
		"icon_zoom-in_alt" => "icon_zoom-in_alt",
		"icon_search" => "icon_search",
		"icon_box-empty" => "icon_box-empty",
		"icon_box-selected" => "icon_box-selected",
		"icon_minus-box" => "icon_minus-box",
		"icon_plus-box" => "icon_plus-box",
		"icon_box-checked" => "icon_box-checked",
		"icon_circle-empty" => "icon_circle-empty",
		"icon_circle-slelected" => "icon_circle-slelected",
		"icon_stop_alt2" => "icon_stop_alt2",
		"icon_stop" => "icon_stop",
		"icon_pause_alt2" => "icon_pause_alt2",
		"icon_pause" => "icon_pause",
		"icon_menu" => "icon_menu",
		"icon_menu-square_alt2" => "icon_menu-square_alt2",
		"icon_menu-circle_alt2" => "icon_menu-circle_alt2",
		"icon_ul" => "icon_ul",
		"icon_ol" => "icon_ol",
		"icon_adjust-horiz" => "icon_adjust-horiz",
		"icon_adjust-vert" => "icon_adjust-vert",
		"icon_document_alt" => "icon_document_alt",
		"icon_documents_alt" => "icon_documents_alt",
		"icon_pencil" => "icon_pencil",
		"icon_pencil-edit_alt" => "icon_pencil-edit_alt",
		"icon_pencil-edit" => "icon_pencil-edit",
		"icon_folder-alt" => "icon_folder-alt",
		"icon_folder-open_alt" => "icon_folder-open_alt",
		"icon_folder-add_alt" => "icon_folder-add_alt",
		"icon_info_alt" => "icon_info_alt",
		"icon_error-oct_alt" => "icon_error-oct_alt",
		"icon_error-circle_alt" => "icon_error-circle_alt",
		"icon_error-triangle_alt" => "icon_error-triangle_alt",
		"icon_question_alt2" => "icon_question_alt2",
		"icon_question" => "icon_question",
		"icon_comment_alt" => "icon_comment_alt",
		"icon_chat_alt" => "icon_chat_alt",
		"icon_vol-mute_alt" => "icon_vol-mute_alt",
		"icon_volume-low_alt" => "icon_volume-low_alt",
		"icon_volume-high_alt" => "icon_volume-high_alt",
		"icon_quotations" => "icon_quotations",
		"icon_quotations_alt2" => "icon_quotations_alt2",
		"icon_clock_alt" => "icon_clock_alt",
		"icon_lock_alt" => "icon_lock_alt",
		"icon_lock-open_alt" => "icon_lock-open_alt",
		"icon_key_alt" => "icon_key_alt",
		"icon_cloud_alt" => "icon_cloud_alt",
		"icon_cloud-upload_alt" => "icon_cloud-upload_alt",
		"icon_cloud-download_alt" => "icon_cloud-download_alt",
		"icon_image" => "icon_image",
		"icon_images" => "icon_images",
		"icon_lightbulb_alt" => "icon_lightbulb_alt",
		"icon_gift_alt" => "icon_gift_alt",
		"icon_house_alt" => "icon_house_alt",
		"icon_genius" => "icon_genius",
		"icon_mobile" => "icon_mobile",
		"icon_tablet" => "icon_tablet",
		"icon_laptop" => "icon_laptop",
		"icon_desktop" => "icon_desktop",
		"icon_camera_alt" => "icon_camera_alt",
		"icon_mail_alt" => "icon_mail_alt",
		"icon_cone_alt" => "icon_cone_alt",
		"icon_ribbon_alt" => "icon_ribbon_alt",
		"icon_bag_alt" => "icon_bag_alt",
		"icon_creditcard" => "icon_creditcard",
		"icon_cart_alt" => "icon_cart_alt",
		"icon_paperclip" => "icon_paperclip",
		"icon_tag_alt" => "icon_tag_alt",
		"icon_tags_alt" => "icon_tags_alt",
		"icon_trash_alt" => "icon_trash_alt",
		"icon_cursor_alt" => "icon_cursor_alt",
		"icon_mic_alt" => "icon_mic_alt",
		"icon_compass_alt" => "icon_compass_alt",
		"icon_pin_alt" => "icon_pin_alt",
		"icon_pushpin_alt" => "icon_pushpin_alt",
		"icon_map_alt" => "icon_map_alt",
		"icon_drawer_alt" => "icon_drawer_alt",
		"icon_toolbox_alt" => "icon_toolbox_alt",
		"icon_book_alt" => "icon_book_alt",
		"icon_calendar" => "icon_calendar",
		"icon_film" => "icon_film",
		"icon_table" => "icon_table",
		"icon_contacts_alt" => "icon_contacts_alt",
		"icon_headphones" => "icon_headphones",
		"icon_lifesaver" => "icon_lifesaver",
		"icon_piechart" => "icon_piechart",
		"icon_refresh" => "icon_refresh",
		"icon_link_alt" => "icon_link_alt",
		"icon_link" => "icon_link",
		"icon_loading" => "icon_loading",
		"icon_blocked" => "icon_blocked",
		"icon_archive_alt" => "icon_archive_alt",
		"icon_heart_alt" => "icon_heart_alt",
		"icon_printer" => "icon_printer",
		"icon_calulator" => "icon_calulator",
		"icon_building" => "icon_building",
		"icon_floppy" => "icon_floppy",
		"icon_drive" => "icon_drive",
		"icon_search-2" => "icon_search-2",
		"icon_id" => "icon_id",
		"icon_id-2" => "icon_id-2",
		"icon_puzzle" => "icon_puzzle",
		"icon_like" => "icon_like",
		"icon_dislike" => "icon_dislike",
		"icon_mug" => "icon_mug",
		"icon_currency" => "icon_currency",
		"icon_wallet" => "icon_wallet",
		"icon_pens" => "icon_pens",
		"icon_easel" => "icon_easel",
		"icon_flowchart" => "icon_flowchart",
		"icon_datareport" => "icon_datareport",
		"icon_briefcase" => "icon_briefcase",
		"icon_shield" => "icon_shield",
		"icon_percent" => "icon_percent",
		"icon_globe" => "icon_globe",
		"icon_globe-2" => "icon_globe-2",
		"icon_target" => "icon_target",
		"icon_hourglass" => "icon_hourglass",
		"icon_balance" => "icon_balance",
		"icon_star_alt" => "icon_star_alt",
		"icon_star-half_alt" => "icon_star-half_alt",
		"icon_star" => "icon_star",
		"icon_star-half" => "icon_star-half",
		"icon_tools" => "icon_tools",
		"icon_tool" => "icon_tool",
		"icon_cog" => "icon_cog",
		"icon_cogs" => "icon_cogs",
		"arrow_up_alt" => "arrow_up_alt",
		"arrow_down_alt" => "arrow_down_alt",
		"arrow_left_alt" => "arrow_left_alt",
		"arrow_right_alt" => "arrow_right_alt",
		"arrow_left-up_alt" => "arrow_left-up_alt",
		"arrow_right-up_alt" => "arrow_right-up_alt",
		"arrow_right-down_alt" => "arrow_right-down_alt",
		"arrow_left-down_alt" => "arrow_left-down_alt",
		"arrow_condense_alt" => "arrow_condense_alt",
		"arrow_expand_alt3" => "arrow_expand_alt3",
		"arrow_carrot_up_alt" => "arrow_carrot_up_alt",
		"arrow_carrot-down_alt" => "arrow_carrot-down_alt",
		"arrow_carrot-left_alt" => "arrow_carrot-left_alt",
		"arrow_carrot-right_alt" => "arrow_carrot-right_alt",
		"arrow_carrot-2up_alt" => "arrow_carrot-2up_alt",
		"arrow_carrot-2dwnn_alt" => "arrow_carrot-2dwnn_alt",
		"arrow_carrot-2left_alt" => "arrow_carrot-2left_alt",
		"arrow_carrot-2right_alt" => "arrow_carrot-2right_alt",
		"arrow_triangle-up_alt" => "arrow_triangle-up_alt",
		"arrow_triangle-down_alt" => "arrow_triangle-down_alt",
		"arrow_triangle-left_alt" => "arrow_triangle-left_alt",
		"arrow_triangle-right_alt" => "arrow_triangle-right_alt",
		"icon_minus_alt" => "icon_minus_alt",
		"icon_plus_alt" => "icon_plus_alt",
		"icon_close_alt" => "icon_close_alt",
		"icon_check_alt" => "icon_check_alt",
		"icon_zoom-out" => "icon_zoom-out",
		"icon_zoom-in" => "icon_zoom-in",
		"icon_stop_alt" => "icon_stop_alt",
		"icon_menu-square_alt" => "icon_menu-square_alt",
		"icon_menu-circle_alt" => "icon_menu-circle_alt",
		"icon_document" => "icon_document",
		"icon_documents" => "icon_documents",
		"icon_pencil_alt" => "icon_pencil_alt",
		"icon_folder" => "icon_folder",
		"icon_folder-open" => "icon_folder-open",
		"icon_folder-add" => "icon_folder-add",
		"icon_folder_upload" => "icon_folder_upload",
		"icon_folder_download" => "icon_folder_download",
		"icon_info" => "icon_info",
		"icon_error-circle" => "icon_error-circle",
		"icon_error-oct" => "icon_error-oct",
		"icon_error-triangle" => "icon_error-triangle",
		"icon_question_alt" => "icon_question_alt",
		"icon_comment" => "icon_comment",
		"icon_chat" => "icon_chat",
		"icon_vol-mute" => "icon_vol-mute",
		"icon_volume-low" => "icon_volume-low",
		"icon_volume-high" => "icon_volume-high",
		"icon_quotations_alt" => "icon_quotations_alt",
		"icon_clock" => "icon_clock",
		"icon_lock" => "icon_lock",
		"icon_lock-open" => "icon_lock-open",
		"icon_key" => "icon_key",
		"icon_cloud" => "icon_cloud",
		"icon_cloud-upload" => "icon_cloud-upload",
		"icon_cloud-download" => "icon_cloud-download",
		"icon_lightbulb" => "icon_lightbulb",
		"icon_gift" => "icon_gift",
		"icon_house" => "icon_house",
		"icon_camera" => "icon_camera",
		"icon_mail" => "icon_mail",
		"icon_cone" => "icon_cone",
		"icon_ribbon" => "icon_ribbon",
		"icon_bag" => "icon_bag",
		"icon_cart" => "icon_cart",
		"icon_tag" => "icon_tag",
		"icon_tags" => "icon_tags",
		"icon_trash" => "icon_trash",
		"icon_cursor" => "icon_cursor",
		"icon_mic" => "icon_mic",
		"icon_compass" => "icon_compass",
		"icon_pin" => "icon_pin",
		"icon_pushpin" => "icon_pushpin",
		"icon_map" => "icon_map",
		"icon_drawer" => "icon_drawer",
		"icon_toolbox" => "icon_toolbox",
		"icon_book" => "icon_book",
		"icon_contacts" => "icon_contacts",
		"icon_archive" => "icon_archive",
		"icon_heart" => "icon_heart",
		"icon_profile" => "icon_profile",
		"icon_group" => "icon_group",
		"icon_grid-2x2" => "icon_grid-2x2",
		"icon_grid-3x3" => "icon_grid-3x3",
		"icon_music" => "icon_music",
		"icon_pause_alt" => "icon_pause_alt",
		"icon_phone" => "icon_phone",
		"icon_upload" => "icon_upload",
		"icon_download" => "icon_download",
		"icon_rook" => "icon_rook",
		"icon_printer-alt" => "icon_printer-alt",
		"icon_calculator_alt" => "icon_calculator_alt",
		"icon_building_alt" => "icon_building_alt",
		"icon_floppy_alt" => "icon_floppy_alt",
		"icon_drive_alt" => "icon_drive_alt",
		"icon_search_alt" => "icon_search_alt",
		"icon_id_alt" => "icon_id_alt",
		"icon_id-2_alt" => "icon_id-2_alt",
		"icon_puzzle_alt" => "icon_puzzle_alt",
		"icon_like_alt" => "icon_like_alt",
		"icon_dislike_alt" => "icon_dislike_alt",
		"icon_mug_alt" => "icon_mug_alt",
		"icon_currency_alt" => "icon_currency_alt",
		"icon_wallet_alt" => "icon_wallet_alt",
		"icon_pens_alt" => "icon_pens_alt",
		"icon_easel_alt" => "icon_easel_alt",
		"icon_flowchart_alt" => "icon_flowchart_alt",
		"icon_datareport_alt" => "icon_datareport_alt",
		"icon_briefcase_alt" => "icon_briefcase_alt",
		"icon_shield_alt" => "icon_shield_alt",
		"icon_percent_alt" => "icon_percent_alt",
		"icon_globe_alt" => "icon_globe_alt",
		"icon_clipboard" => "icon_clipboard",
		"social_facebook" => "social_facebook",
		"social_twitter" => "social_twitter",
		"social_pinterest" => "social_pinterest",
		"social_googleplus" => "social_googleplus",
		"social_tumblr" => "social_tumblr",
		"social_tumbleupon" => "social_tumbleupon",
		"social_wordpress" => "social_wordpress",
		"social_instagram" => "social_instagram",
		"social_dribbble" => "social_dribbble",
		"social_vimeo" => "social_vimeo",
		"social_linkedin" => "social_linkedin",
		"social_rss" => "social_rss",
		"social_deviantart" => "social_deviantart",
		"social_share" => "social_share",
		"social_myspace" => "social_myspace",
		"social_skype" => "social_skype",
		"social_youtube" => "social_youtube",
		"social_picassa" => "social_picassa",
		"social_googledrive" => "social_googledrive",
		"social_flickr" => "social_flickr",
		"social_blogger" => "social_blogger",
		"social_spotify" => "social_spotify",
		"social_delicious" => "social_delicious",
		"social_facebook_circle" => "social_facebook_circle",
		"social_twitter_circle" => "social_twitter_circle",
		"social_pinterest_circle" => "social_pinterest_circle",
		"social_googleplus_circle" => "social_googleplus_circle",
		"social_tumblr_circle" => "social_tumblr_circle",
		"social_stumbleupon_circle" => "social_stumbleupon_circle",
		"social_wordpress_circle" => "social_wordpress_circle",
		"social_instagram_circle" => "social_instagram_circle",
		"social_dribbble_circle" => "social_dribbble_circle",
		"social_vimeo_circle" => "social_vimeo_circle",
		"social_linkedin_circle" => "social_linkedin_circle",
		"social_rss_circle" => "social_rss_circle",
		"social_deviantart_circle" => "social_deviantart_circle",
		"social_share_circle" => "social_share_circle",
		"social_myspace_circle" => "social_myspace_circle",
		"social_skype_circle" => "social_skype_circle",
		"social_youtube_circle" => "social_youtube_circle",
		"social_picassa_circle" => "social_picassa_circle",
		"social_googledrive_alt2" => "social_googledrive_alt2",
		"social_flickr_circle" => "social_flickr_circle",
		"social_blogger_circle" => "social_blogger_circle",
		"social_spotify_circle" => "social_spotify_circle",
		"social_delicious_circle" => "social_delicious_circle",
		"social_facebook_square" => "social_facebook_square",
		"social_twitter_square" => "social_twitter_square",
		"social_pinterest_square" => "social_pinterest_square",
		"social_googleplus_square" => "social_googleplus_square",
		"social_tumblr_square" => "social_tumblr_square",
		"social_stumbleupon_square" => "social_stumbleupon_square",
		"social_wordpress_square" => "social_wordpress_square",
		"social_instagram_square" => "social_instagram_square",
		"social_dribbble_square" => "social_dribbble_square",
		"social_vimeo_square" => "social_vimeo_square",
		"social_linkedin_square" => "social_linkedin_square",
		"social_rss_square" => "social_rss_square",
		"social_deviantart_square" => "social_deviantart_square",
		"social_share_square" => "social_share_square",
		"social_myspace_square" => "social_myspace_square",
		"social_skype_square" => "social_skype_square",
		"social_youtube_square" => "social_youtube_square",
		"social_picassa_square" => "social_picassa_square",
		"social_googledrive_square" => "social_googledrive_square",
		"social_flickr_square" => "social_flickr_square",
		"social_blogger_square" => "social_blogger_square",
		"social_spotify_square" => "social_spotify_square",
		"social_delicious_square" => "social_delicious_square",
	);

	return $elegant_icons;

}