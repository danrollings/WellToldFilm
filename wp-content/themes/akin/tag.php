<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php $t->layout->pageTitle = sprintf(__("Tag: %s",'Pixelentity Theme/Plugin'),single_tag_title("",false)); ?>
<?php get_header(); ?>

<div class="row">
	<div class="large-12 columns text-center blog-title">
		<div class="page-title">
			<h2 class="lowlight"><?php echo $t->layout->pageTitle; ?><span class="highlight">.</span></h2>
		</div>
	</div>
</div>

<div class="row blog-main">
	<div class="large-9 columns blog-left">
		<?php $t->content->loop(); ?>
	</div>
	
	<div class="large-3 columns blog-right">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>