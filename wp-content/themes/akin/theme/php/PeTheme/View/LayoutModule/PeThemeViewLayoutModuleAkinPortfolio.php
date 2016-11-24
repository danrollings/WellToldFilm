<?php

class PeThemeViewLayoutModuleAkinPortfolio extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Portfolio",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		$fields = peTheme()->data->customPostTypeMbox('project');
		$fields = $fields["content"];
		$fields = array_merge(
							  array(
									"title" => 	
									array(
										  "label"=>__("Title",'Pixelentity Theme/Plugin'),
										  "type"=>"Text",
										  "description" => __("Section title.",'Pixelentity Theme/Plugin'),
										  "default"=>__("Our Work",'Pixelentity Theme/Plugin')
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
										  "type" => "TextArea",
										  "noscript" => true,
										  "description" => __("Displayed after the projects grid.",'Pixelentity Theme/Plugin'),
										  "default" => '<h2 class="lowlight">Do you <i class="icon icon_heart red"></i> us yet<span class="highlight">?</span></h2>',
										  ),
									),
							  $fields
							  );
		return $fields;
	}

	public function name() {
		return __("Portfolio",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function templateName() {
		return "portfolio";
	}

	public function group() {
		return "section";
	}


	public function setTemplateData() {
		// we don't store template data here because we want to avoid it if the custom loop is empty
		// so we'll do it in render();
	}

	public function template() {
		$t =& peTheme();
		if ($loop = $t->data->customLoop($this->data)) {
			$t->template->data($this->data,$this->conf->bid);
			$t->get_template_part("viewmodule",$this->templateName());
			$t->content->resetLoop();
		}
	}

	public function tooltip() {
		return __("Add a Portfolio section showing projects.",'Pixelentity Theme/Plugin');
	}

}

?>
