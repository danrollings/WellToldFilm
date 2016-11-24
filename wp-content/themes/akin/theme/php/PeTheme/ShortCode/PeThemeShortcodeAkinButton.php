<?php

class PeThemeShortcodeAkinButton extends PeThemeShortcode {

	public function __construct($master) {
		parent::__construct($master);
		$this->trigger = "pbutton";
		$this->group = __("UI",'Pixelentity Theme/Plugin');
		$this->name = __("Button",'Pixelentity Theme/Plugin');
		$this->description = __("Add a button",'Pixelentity Theme/Plugin');
		$this->fields = array(
			"url" => array(
				"label"       => __("Url",'Pixelentity Theme/Plugin'),
				"type"        => "Text",
				"description" => __("Enter the destination url of the button",'Pixelentity Theme/Plugin'),
			),
			"text" => array(
				"label"       => __("Text",'Pixelentity Theme/Plugin'),
				"type"        => "Text",
				"description" => __("Enter the button text here",'Pixelentity Theme/Plugin'),
			),
			"new_window" => array(
				"label"       => __("Open in new window",'Pixelentity Theme/Plugin'),
				"type"        => "Select",
				"description" => __("Should the url be opened in new window or not.",'Pixelentity Theme/Plugin'),
				"options"     => array(
					__("Yes",'Pixelentity Theme/Plugin') => "yes",
					__("No",'Pixelentity Theme/Plugin')  => "no",
				),
				"default"     =>"no",
			),
			"icon" => array(
				"label"       => __("Icon",'Pixelentity Theme/Plugin'),
				"type"        => "Select",
				"options"     => pe_theme_elegant_icons(),
				"description" => __('Select optional icon displayed inside button.','Pixelentity Theme/Plugin'),
				"default"     => '',
			),
		);
	}

	public function output($atts,$content=null,$code="") {
		extract($atts);
		if ( ! isset( $url ) ) $url = "#";

		$target = isset( $new_window ) && 'yes' === $new_window ? '_blank' : '_self';

		$icon = isset( $icon ) && '' !== $icon ? ' <div class="icon ' . $icon . '"></div>' : '';

		$html = <<< EOT
<a href="$url" target="$target"><div class="btn">$text$icon</div></a>
EOT;
        return trim($html);
	}

}