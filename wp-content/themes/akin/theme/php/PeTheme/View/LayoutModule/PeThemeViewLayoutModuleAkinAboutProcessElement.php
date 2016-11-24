<?php

class PeThemeViewLayoutModuleAkinAboutProcessElement extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Item",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "icon" => 	
				  array(
						"label"=>__("Icon",'Pixelentity Theme/Plugin'),
						"type"=>"Icon",
						"description" => __("Element Icon.",'Pixelentity Theme/Plugin'),
						"default"=>"icon arrow_up",
						),
				  "title" => 	
				  array(
						"label"=>__("Title",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Element title.",'Pixelentity Theme/Plugin'),
						"default"=>__("Consult",'Pixelentity Theme/Plugin')
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
		return __("Element",'Pixelentity Theme/Plugin');
	}

	public function group() {
		return "about-process";
	}

	public function render() {	
	}

	public function tooltip() {
		return __("Add a new Element to the Process About subsection.",'Pixelentity Theme/Plugin');
	}

}

?>
