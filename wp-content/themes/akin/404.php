<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $t->layout->pageTitle = __("Not Found",'Pixelentity Theme/Plugin'); ?>
<?php get_header(); ?>

<div class="row">
	<div class="large-12 columns text-center blog-title">
		<div class="page-title">
			<h2 class="lowlight"><?php echo $t->layout->pageTitle; ?><span class="highlight">.</span></h2>
		</div>
	</div>
</div>

<div class="row">
	<div class="large-12 columns">
		<p class="text-center"><?php _e("The page you're looking for doesn't exist.",'Pixelentity Theme/Plugin'); ?></p>
		<br>
	</div>
</div>

<?php get_footer(); ?>