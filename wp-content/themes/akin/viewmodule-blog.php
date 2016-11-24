<?php $t =& peTheme(); ?>
<?php list($settings,$bid) = $t->template->data(); ?>

<section class="section-blog" id="section-<?php echo empty($settings->name) ? $bid : $settings->name; ?>">

	<?php if ( ! empty( $settings->title ) ) : ?>

		<div class="row">
			<div class="large-12 columns text-center blog-title">
				<div class="page-title">
					<h2 class="lowlight"><?php echo $settings->title; ?><span class="highlight">.</span></h2>
				</div>
			</div>
		</div>

	<?php endif; ?>

	<div class="row blog-main" id="sub-section-<?php echo $bid; ?>">

		<div class="large-9 columns blog-left">
			<?php $t->template->data($settings); ?>
			<?php $t->get_template_part("loop"); ?>
		</div>
		
		<div class="large-3 columns blog-right">
			<?php get_sidebar(); ?>
		</div>

	</div>
	
</section>