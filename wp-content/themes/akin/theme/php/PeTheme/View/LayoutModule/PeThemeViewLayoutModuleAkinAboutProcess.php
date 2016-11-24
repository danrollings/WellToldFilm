<?php

class PeThemeViewLayoutModuleAkinAboutProcess extends PeThemeViewLayoutModuleAkinContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Process",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Process subsection title.",'Pixelentity Theme/Plugin'),
						"default"=>__("OUR PROCESS",'Pixelentity Theme/Plugin')
						),
				  "label1" =>
				  array(
						"label" => __("Button 1 label",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Button 1 label, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => __("See our Work",'Pixelentity Theme/Plugin'),
						),
				  "url1" =>
				  array(
						"label" => __("Button 1 link",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Button 1 url, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => "#"
						),
				  "text" =>
				  array(
						"label" => __("Text between buttons",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Text between the 2 buttons, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => __("OR",'Pixelentity Theme/Plugin'),
						),
				  "label2" =>
				  array(
						"label" => __("Button 2 label",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Button 2 label, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => __("Hire us now",'Pixelentity Theme/Plugin'),
						),
				  "url2" =>
				  array(
						"label" => __("Button 2 link",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Button 2 url, leave empty to hide.",'Pixelentity Theme/Plugin'),
						"default" => "#"
						),
				  );
		
	}

	public function name() {
		return __("Process",'Pixelentity Theme/Plugin');
	}

	public function group() {
		return "about";
	}

	public function create() {
		return "AkinAboutProcessElement";
	}

	public function force() {
		return "AkinAboutProcessElement";
	}
	
	public function allowed() {
		return "about-process";
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

		peTheme()->template->data($this->data,$items,$this->conf->bid);
	}
	
	public function render() {
		peTheme()->get_template_part("viewmodule","about_process");
	}

	public function tooltip() {
		return __("Add a Process subsection to About section.",'Pixelentity Theme/Plugin');
	}

}

?>
