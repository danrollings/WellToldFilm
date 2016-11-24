<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php 

if ( is_day() ) {
        $date = get_the_date();
} elseif ( is_month() ) {
        $date = get_the_date('F Y');
} elseif ( is_year() ) {
        $date = get_the_date('Y');
} else {
        $date = __("Archives",'Pixelentity Theme/Plugin');
}

?>
<?php $t->layout->pageTitle = $date; ?>
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