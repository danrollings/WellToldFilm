<?php

class PeThemeViewLayoutModuleAkinAboutTeam extends PeThemeViewLayoutModuleAkinContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Team",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return 
			array(
				  "title" => 	
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Team subsection title.",'Pixelentity Theme/Plugin'),
						"default"=>__("OUR TEAM",'Pixelentity Theme/Plugin')
						),
				  );
	}

	public function name() {
		return __("Team",'Pixelentity Theme/Plugin');
	}

	public function group() {
		return "about";
	}

	public function create() {
		return "AkinAboutTeamElement";
	}

	public function force() {
		return "AkinAboutTeamElement";
	}
	
	public function allowed() {
		return "about-team";
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
													  'title' => '',
													  'image' => '',
													  'position' => '',
													  'content' => '',
													  'icons' => array()
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
		peTheme()->get_template_part("viewmodule","about_team");
	}

	public function tooltip() {
		return __("Add a Team subsection to About section.",'Pixelentity Theme/Plugin');
	}

}

?>
