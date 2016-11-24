<?php

class PeThemeViewLayoutModuleAkinContact extends PeThemeViewLayoutModule {

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Contact",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		
		$contactMbox = array(
			"type"     => "",
			"title"    => __("Contact Options",'Pixelentity Theme/Plugin'),
			"priority" => "core",
			"where"    => array(
				"page" => "page_contact",
			),
			"content" => array(
				"name" =>
				  array(
						"label" => __("Link Name",'Pixelentity Theme/Plugin'),
						"type" => "Text",
						"description" => __("Used when linking to the section in a page (eg, from the menu).",'Pixelentity Theme/Plugin'),
						"default" => ""
						),
				'background' => array(
					'label'       => __( 'Section Background' ,'Pixelentity Theme/Plugin'),
					'type'        => 'Upload',
					'description' => __( 'Background image.' ,'Pixelentity Theme/Plugin'),
					'default'     => PE_THEME_URL . '/img/contact-bg-default.jpg',
				),
				"details_title" => array(
					"label"       => __("Contact Details Title",'Pixelentity Theme/Plugin'),
					"type"        => "Text",
					"description" => __("Displayed above contact details.",'Pixelentity Theme/Plugin'),
					"default"     => '<span class="highlight">Contact</span> get in touch.',
				),
				"details_address" => array(
					"label"       => __("Contact Details Address",'Pixelentity Theme/Plugin'),
					"type"        => "TextArea",
					"description" => __("Displayed next to the location icon.",'Pixelentity Theme/Plugin'),
					"default"     => '<h6>200 Collins Street</h6><span>Melbourne, 3000</span>',
				),
				"details_phone" => array(
					"label"       => __("Contact Details Phone",'Pixelentity Theme/Plugin'),
					"type"        => "TextArea",
					"description" => __("Displayed next to the phone icon.",'Pixelentity Theme/Plugin'),
					"default"     => '<h6>+61 3928 3492</h6><span>8am - 6pm Mon - Fri</span>',
				),
				"details_email" => array(
					"label"       => __("Contact Details Email",'Pixelentity Theme/Plugin'),
					"type"        => "TextArea",
					"description" => __("Displayed next to the envelope icon.",'Pixelentity Theme/Plugin'),
					"default"     => '<h6>hello@oursite.net</h6><span>Start the conversation</span>',
				),
				"form_title" => array(
					"label"       => __("Form Title",'Pixelentity Theme/Plugin'),
					"type"        => "Text",
					"description" => __("Title displayed above the contact form.",'Pixelentity Theme/Plugin'),
					"default"     => '<span class="highlight">Communicate</span> say hello.',
				),
				"msgOK" => array(
					"label"       => __("Mail Sent Message",'Pixelentity Theme/Plugin'),
					"type"        => "TextArea",
					"description" => __("Message shown when form message has been sent without errors",'Pixelentity Theme/Plugin'),
					"default"     => 'Thanks for your enquiry!',
				),
				"msgKO" => array(
					"label"       => __("Akin Error Message",'Pixelentity Theme/Plugin'),
					"type"        => "TextArea",
					"description" => __("Message shown when form message encountered errors",'Pixelentity Theme/Plugin'),
					"default"     => '* Please fill all fields correctly.',
				),
			),
		);

		$fields = $contactMbox["content"];

		return $fields;
	}

	public function name() {
		return __("Contact",'Pixelentity Theme/Plugin');
	}

	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}

	public function templateName() {
		return "contact";
	}

	public function group() {
		return "section";
	}


	public function setTemplateData() {
		$t =& peTheme();
		peTheme()->template->data($this->data,$this->conf->bid);
	}

	public function template() {
		peTheme()->get_template_part("viewmodule",$this->templateName());
	}

	public function tooltip() {
		return __("Add a Contact section showing posts.",'Pixelentity Theme/Plugin');
	}

}

?>
