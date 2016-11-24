<?php

class PeThemeViewLayoutModuleAkinServices extends PeThemeViewLayoutModuleContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Services",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Section title.",'Pixelentity Theme/Plugin'),
						"default"=>__("Our Expertise",'Pixelentity Theme/Plugin')
						),
				  "name" =>
				  array(
						"label" => __("Link Name",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Used when linking to the section in a page (eg, from the menu).",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  "content" =>
				  array(
						"label" => "Content",
						"type" => "Editor",
						"noscript" => true,
						"description" => __("Content",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  "image" => 	
				  array(
						"label"=>__("Image",'Pixelentity Theme/Plugin'),
						"type"=>"Upload",
						"description" => __("Section image.",'Pixelentity Theme/Plugin'),
						"default"=>"",
						)
				  );
	}

	public function name() {
		return __("Services",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function create() {
		return "AkinService";
	}

	public function force() {
		return "AkinService";
	}
	
	public function allowed() {
		return "service";
	}

	public function group() {
		return "section";
	}

	public function setTemplateData() {
		// override setTemplateData so to also pass the item array to the template file
		// this way the markup for the child blocks can also be generated in the container/parent template
		// We're not interested in builder related settings so we rebuild the array
		// to only include the data we going to use.
		
		$items = array();
		if (!empty($this->conf->items)) {
			foreach($this->conf->items as $item) {
				$item = (object) shortcode_atts(
												array(
													  'icon' => '',
													  'title' => '',
													  'content' => ''
													  ),
												$item["data"]
												);
				
				$item->content = empty($item->content) ? "" : do_shortcode(apply_filters("the_content",$item->content));
				$items[] = $item;
			}
		}

		// we also render (parent) shortcodes here to keep template file clean;
		$this->data->content = empty($this->data->content) ? "" : do_shortcode(apply_filters("the_content",$this->data->content));

		peTheme()->template->data($this->data,$items,$this->conf->bid);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule",empty($this->data->layout) ? "services" : $this->data->layout);
	}

	public function tooltip() {
		return __("Use this block to add a Services section.",'Pixelentity Theme/Plugin');
	}

}

?>
