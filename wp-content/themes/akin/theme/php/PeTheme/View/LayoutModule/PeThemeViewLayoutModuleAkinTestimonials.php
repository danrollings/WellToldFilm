<?php

class PeThemeViewLayoutModuleAkinTestimonials extends PeThemeViewLayoutModuleContainer {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Testimonials",'Pixelentity Theme/Plugin')
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
						"default"=>__("What people are saying",'Pixelentity Theme/Plugin')
						),
				  "name" =>
				  array(
						"label" => __("Link Name",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Used when linking to the section in a page (eg, from the menu).",'Pixelentity Theme/Plugin'),
						"default" => ""
						)
				  );
	}

	public function name() {
		return __("Testimonials",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function create() {
		return "AkinTestimonial";
	}

	public function force() {
		return "AkinTestimonial";
	}
	
	public function allowed() {
		return "testimonial";
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
													  'title' => '',
													  'via' => '',
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
		peTheme()->get_template_part("viewmodule","testimonials");
	}

	public function tooltip() {
		return __("Use this block to add a Testimonials section.",'Pixelentity Theme/Plugin');
	}

}

?>
