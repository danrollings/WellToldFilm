<form action="<?php echo esc_url(home_url("/")); ?>">
	<input name="s" id="s" type="text" class="left search" placeholder="<?php _e("Search..",'Pixelentity Theme/Plugin'); ?>" value="<?php echo get_search_query() ? get_search_query() : ""; ?>" />
	<input type="submit" class="btn left" value="<?php _e("GO",'Pixelentity Theme/Plugin'); ?>" />
</form>