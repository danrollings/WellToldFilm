<?php

class PeThemeViewLayoutModuleAkinBlog extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Blog",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		$fields = peTheme()->data->customPostTypeMbox('post');

		$additional_fields = array(
			"title" => array(
				"label"       =>__("Title",'Pixelentity Theme/Plugin'),
				"type"        =>"Text",
				"description" => __("Section title.",'Pixelentity Theme/Plugin'),
				"default"     =>__("Our Blog",'Pixelentity Theme/Plugin'),
			),
			"name" =>
			  array(
					"label" => __("Link Name",'Pixelentity Theme/Plugin'),
					"type" => "Text",
					"description" => __("Used when linking to the section in a page (eg, from the menu).",'Pixelentity Theme/Plugin'),
					"default" => ""
					),
			"blog_layout" => array(
				"label"       =>__("Layout type",'Pixelentity Theme/Plugin'),
				"type"        =>"RadioUI",
				"description" => __("Select between two different blog section layouts.",'Pixelentity Theme/Plugin'),
				"options"     => array(
					__( 'Full' ,'Pixelentity Theme/Plugin')     => 'full',
					__( 'Overview' ,'Pixelentity Theme/Plugin') => 'overview',
				),
				"default" => __("overview",'Pixelentity Theme/Plugin'),
			),
			'subtitle' => array(
				"label"       => __("Section subtitle",'Pixelentity Theme/Plugin'),
				"type"        => "Text",
				"description" => __("Section subtitle (used only in 'overview' layout).",'Pixelentity Theme/Plugin'),
				"default"     => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum.',
			),
			'button_text' => array(
				"label"       => __("Button text",'Pixelentity Theme/Plugin'),
				"type"        => "Text",
				"description" => __("Text of the button pointing to the full blog page.",'Pixelentity Theme/Plugin'),
				"default"     => __("See all posts",'Pixelentity Theme/Plugin'),
			),
			'button_link' => array(
				"label"       => __("Button link",'Pixelentity Theme/Plugin'),
				"type"        => "Text",
				"description" => __("Link of the button pointing to the full blog page.",'Pixelentity Theme/Plugin'),
				"default"     => '#',
			),
			'image' => array(
				"label"       => __("Featured image",'Pixelentity Theme/Plugin'),
				"type"        => "Upload",
				"description" => __("Image will be displayed on the left side of the section.",'Pixelentity Theme/Plugin'),
				"default"     => PE_THEME_URL."/img/blog-bg-default.jpg",
			),
		);

		$fields = array_merge( $additional_fields, $fields["content"] );

		return $fields;
	}

	public function name() {
		return __("Blog",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function templateName() {
		if ( $this->data->blog_layout === 'overview' ) {
			return "blog-overview";
		}
		return 'blog';
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
		return __("Add a Blog section showing posts.",'Pixelentity Theme/Plugin');
	}

}

?>
