<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php get_header(); ?>
<?php while ($content->looping() ) : ?>


<section class="about-detail pad-large">

	<div class="row">
		<div class="large-12 columns text-center">
			<div class="page-title">
				<h2 class="lowlight"><?php $content->title(); ?><span class="highlight">.</span></h2>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="large-12 columns">
			<div class="page-title">
				<?php $content->content(); ?>
			</div>
		</div>
	</div>

<?php endwhile; ?>
<?php get_footer(); ?>
