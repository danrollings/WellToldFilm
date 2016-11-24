<?php

class PeThemeViewLayoutModuleAkinSocial extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Social",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		
		return array(
			"icons" => array(
				"label"=>__("Social Profile Links",'Pixelentity Theme/Plugin'),
				"type"=>"Items",
				"description" => __("Add one or more links to social section.",'Pixelentity Theme/Plugin'),
				"button_label" => __("Add Social Link",'Pixelentity Theme/Plugin'),
				"sortable" => true,
				"auto" => __("Layer",'Pixelentity Theme/Plugin'),
				"unique" => false,
				"editable" => false,
				"legend" => false,
				"fields" => array(
					array(
						"label" => __("Social Network",'Pixelentity Theme/Plugin'),
						"name" => "icon",
						"type" => "select",
						"options" => apply_filters('pe_theme_social_icons',array()),
						"width" => 185,
						"default" => "",
					),
					array(
						"name" => "url",
						"type" => "text",
						"width" => 300, 
						"default" => "#",
					),
					array(
						"name" => "text",
						"type" => "text",
						"width" => 300,
						"default" => "Like Us",
					),
				),
				"default" => "",
			),
			'layout' => array(
				'label' => __( 'Width of one social icon' ,'Pixelentity Theme/Plugin'),
				'type'  => 'Select',
				'description' => __( 'Choose between different widths of each social icon, adjust based on the number of icons you will have/layout you are trying to achieve.' ,'Pixelentity Theme/Plugin'),
				'options' => array(
					__( '1/1' ,'Pixelentity Theme/Plugin') => 'large-12',
					__( '1/2' ,'Pixelentity Theme/Plugin') => 'large-6',
					__( '1/3' ,'Pixelentity Theme/Plugin') => 'large-4',
					__( '1/4' ,'Pixelentity Theme/Plugin') => 'large-3',
					__( '1/6' ,'Pixelentity Theme/Plugin') => 'large-2',
				),
				'default' => 'large-3',
			),
		);
	}

	public function name() {
		return __("Social",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function templateName() {
		return "social";
	}

	public function group() {
		return "section";
	}

	public function setTemplateData() {
		$t =& peTheme();
		// we also render (parent) shortcodes here to keep template file clean;
		$this->data->content = empty($this->data->content) ? "" : do_shortcode(apply_filters("the_content",$this->data->content));

		peTheme()->template->data($this->data,$this->conf->bid);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule",$this->templateName());
	}

	public function tooltip() {
		return __("Add a Social section.",'Pixelentity Theme/Plugin');
	}

}

?>
