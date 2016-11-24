<?php

class PeThemeViewLayoutModuleAkinAbout extends PeThemeViewLayoutModuleContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("About",'Pixelentity Theme/Plugin')
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
						"default"=>__("Get to know us",'Pixelentity Theme/Plugin')
						),
				  "name" =>
				  array(
						"label" => __("Link Name",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Used when linking to the section in a page (eg, from the menu).",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  );
	}

	public function name() {
		return __("About",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function allowed() {
		return "about";
	}

	public function group() {
		return "section";
	}

	public function setTemplateData() {
		// override setTemplateData so to also pass the item array to the template file
		// this way the markup for the child blocks can also be generated in the container/parent template
		// We're not interested in builder related settings so we rebuild the array
		// to only include the data we going to use.
		
		/*
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
		*/

		peTheme()->template->data($this,$this->data,$this->conf->items,$this->conf->bid);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule","about");
	}

	public function tooltip() {
		return __("Add an About section.",'Pixelentity Theme/Plugin');
	}

}

?>
