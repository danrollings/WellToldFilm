<?php

class PeThemeViewLayoutModuleAkinColumns extends PeThemeViewLayoutModuleAkinContainer {

	public static $translate = 
		array(
			  "1/1" => "large-12",
			  "1/2" => "large-6",
			  "1/3" => "large-4",
			  "1/4" => "large-3",
			  "1/6" => "large-2",
			  "2/4" => "large-6",
			  "2/3" => "large-8",
			  "3/4" => "large-9",
			  "5/6" => "large-10",
			  "last" => ""
			  );

	public function messages() {
		return
			array(
				  "title" => "",
				  "type" => __("Columns",'Pixelentity Theme/Plugin')
				  );
	}

	public function fields() {
		return
			array(
				  "columns" => 
				  array(
						"label" => __("Layout",'Pixelentity Theme/Plugin'),
						"description" => __("Select the columns layout",'Pixelentity Theme/Plugin'),
						"type" => "Select",
						"groups" => true,
						"options" => apply_filters('pe_theme_shortcode_columns_options',PeGlobal::$config["columns"]),
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
		return __("Columns",'Pixelentity Theme/Plugin');
	}

	public function create() {
		return "AkinText";
	}

	public function force() {
		return "AkinText";
	}

	public function allowed() {
		return "column";
	}

	public function group() {
		return "section";
	}
	
	public function type() {
		return __("Section",'Pixelentity Theme/Plugin');
	}


	public function template() {
		
		if (empty($this->conf->items) || !is_array($this->conf->items)) {
			return;
		}

		$translate = PeThemeViewLayoutModuleAkinColumns::$translate;

		if (empty($this->data->columns)) {
			$cols = count($this->conf->items);
		} else {
			$layout = explode(" ",strtr($this->data->columns,$translate));
			$cols = count($layout);
		}
		

		$idx = 0;
		$last = count($this->conf->items)-1;

		$open = '<div class="row">';
		$close = '</div>';

		printf('<section class="pad-large" id="section-%s">',empty($this->data->name) ? $this->conf->bid : $this->data->name );
		foreach ($this->conf->items as $item) {
			if (($idx % $cols) === 0) echo $open;
			printf('<div class="%s columns">',empty($layout[$idx % $cols]) ? '' : $layout[$idx % $cols],$idx,$cols);
			$this->outputModule($item);
			echo "</div>";
			if ($idx === $last || ($idx % $cols) === ($cols-1)) echo $close;
			$idx++;
		}
		print '</section>';

	}

	public function tooltip() {
		return __("Use this block to add columns of content to your layout.",'Pixelentity Theme/Plugin');
	}

}

?>
