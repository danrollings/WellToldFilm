<?php

class PeThemeViewLayoutModuleAkinAboutTeamElement extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Member",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "title" => 	
				  array(
						"label"=>__("Name",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Team member name.",'Pixelentity Theme/Plugin'),
						"default"=>__("Jon Doe",'Pixelentity Theme/Plugin')
						),
				  "image" => 	
				  array(
						"label"=>__("Picture",'Pixelentity Theme/Plugin'),
						"type"=>"Upload",
						"description" => __("Team member picture.",'Pixelentity Theme/Plugin'),
						"default"=>"",
						),				  
				  "position" => 	
				  array(
						"label"=>__("Position",'Pixelentity Theme/Plugin'),
						"type"=>"Text",
						"description" => __("Team member position.",'Pixelentity Theme/Plugin'),
						"default"=>__("CEO",'Pixelentity Theme/Plugin')
						),
				  "content" =>
				  array(
						"label" => __("Description",'Pixelentity Theme/Plugin'),
						"type" => "Editor",
						"description" => __("Team member description.",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  "icons" => 
				  array(
						"label"=>__("Social Profile Links",'Pixelentity Theme/Plugin'),
						"type"=>"Items",
						"description" => __("Add one or more links to social section.",'Pixelentity Theme/Plugin'),
						"button_label" => __("Add Social Link",'Pixelentity Theme/Plugin'),
						"sortable" => true,
						"auto" => __("Layer",'Pixelentity Theme/Plugin'),
						"unique" => false,
						"editable" => false,
						"legend" => false,
						"fields" => 
						array(
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
									)
							  ),
						"default" => "",
						),
				  );
		
	}

	public function name() {
		return __("Team Member",'Pixelentity Theme/Plugin');
	}

	public function group() {
		return "about-team";
	}

	public function render() {	
	}

	public function tooltip() {
		return __("Add a new team member to the Team About subsection.",'Pixelentity Theme/Plugin');
	}

}

?>
