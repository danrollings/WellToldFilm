<?php $t =& peTheme(); ?>
<?php list($settings,$bid) = $t->template->data(); ?>

<section class="blog-section" id="section-<?php echo empty($settings->name) ? $bid : $settings->name; ?>">

	<?php if ( ! empty( $settings->image ) ) : ?>

		<div class="blog-bg" style="background-image: url( '<?php echo esc_attr( $settings->image ); ?>' );"></div>

	<?php endif; ?>
	
	<div class="row pad-large">
		<div class="large-7 columns push-5">

			<?php if ( ! empty( $settings->title ) ) : ?>

				<div class="page-title">
					<h2 class="lowlight"><?php echo $settings->title; ?><span class="highlight">.</span></h2>
				</div>

			<?php endif; ?>

			<?php if ( ! empty( $settings->subtitle ) ) : ?>

				<p class="lead">
					<?php echo $settings->subtitle; ?>
				</p>

			<?php endif; ?>
			
			<ul class="blog-list">
			
				<?php $t->template->data($settings); ?>
				<?php $t->get_template_part("loop","overview"); ?>
			
			</ul>

			<?php if ( ! empty( $settings->button_text ) ) : ?>

			<?php $link = $settings->button_link; ?>
			<?php if (empty($link) || $link === '#'): ?>
			<?php $blog = get_posts(array('name' => 'blog','post_type' => 'page')); ?>
			<?php $link = empty($blog) ? '#' : get_permalink($blog[0]->ID); ?>
			<?php endif; ?>
			
				<a href="<?php echo esc_attr($link); ?>"><div class="btn"><?php echo $settings->button_text; ?> <div class="icon arrow_right">&nbsp;</div> </div></a>

			<?php endif; ?>

		</div>
		
		
	</div>

</section>