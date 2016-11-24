<?php

class PeThemeViewLayoutModuleAkinAboutStory extends PeThemeViewLayoutModuleText {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Story",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Story subsection title.",'Pixelentity Theme/Plugin'),
						"default"=>__("OUR STORY",'Pixelentity Theme/Plugin')
						),
				  
				  'icons' => 
				  array(
						"label"        =>__("Icons",'Pixelentity Theme/Plugin'),
						"type"         =>"Items",
						"description"  => __("Add one or more icons.",'Pixelentity Theme/Plugin'),
						"button_label" => __("Add Icon",'Pixelentity Theme/Plugin'),
						"sortable"     => true,
						"auto"         => 'icon icon_cloud_alt',
						"unique"       => false,
						"editable"     => false,
						"legend"       => false,
						"fields"       => 
						array(
							  array(
									"label"   => __("Icon",'Pixelentity Theme/Plugin'),
									"name"    => "icon",
									"type"    => "icon",
									"width"   => 185,
									"default" => "icon icon_cloud_alt",
									),
							  array(
									"label"    => __("Link",'Pixelentity Theme/Plugin'),
									"name"    => "url",
									"type"    => "text",
									"width"   => 300, 
									"default" => "",
									),
							  )
						),
				  "content" =>
				  array(
						"label" => "Content",
						"type" => "Editor",
						"noscript" => true,
						"description" => __("Content",'Pixelentity Theme/Plugin'),
						"default" => ""
						)
				  );
		
	}

	public function name() {
		return __("Story",'Pixelentity Theme/Plugin');
	}

	public function group() {
		return "about";
	}

	public function setTemplateData() {
		// we render (parent) shortcodes here to keep template file clean;
		$this->data->content = empty($this->data->content) ? "" : do_shortcode(apply_filters("the_content",$this->data->content));
		peTheme()->template->data($this->data,$this->conf->bid);
	}

	public function render() {
		peTheme()->get_template_part("viewmodule","about_story");
	}

	public function tooltip() {
		return __("Add a Story subsection to About section.",'Pixelentity Theme/Plugin');
	}

}

?>
