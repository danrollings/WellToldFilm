<?php

class PeThemeViewLayoutModuleAkinClients extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Clients",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "name" =>
				  array(
						"label" => __("Link Name",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Used when linking to the section in a page (eg, from the menu).",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				  "id" =>
				  array(
						"label" => __("Gallery",'Pixelentity Theme/Plugin'),
						"description" => __("Select the gallery which includes logos.",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"options" => peTheme()->gallery->option(),
						"editable" => admin_url('post.php?post=%0&action=edit')
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
		return __("Clients",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function templateName() {
		return "clients";
	}

	public function group() {
		return "section";
	}

	public function setTemplateData() {
		$t =& peTheme();
		$loop = $t->gallery->getSliderLoop($this->data->id);
		peTheme()->template->data($this->data,$loop,$this->conf->bid);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule",$this->templateName());
	}

	public function tooltip() {
		return __("Add a Clients section.",'Pixelentity Theme/Plugin');
	}

}

?>
