<?php $t =& peTheme(); ?>
<?php list($data,$items,$bid) = $t->template->data(); ?>
<?php $bg = empty($data->image) ? "" : sprintf('style="background-image: url(%s);"',$data->image) ?>

<section class="testimonials pad-large" id="section-<?php echo empty($data->name) ? $bid : $data->name; ?>">
	<div class="row">
		<div class="large-12 columns text-center">
			<div class="page-title">
				<?php if (!empty($data->title)): ?>
				<h2 class="lowlight"><?php echo $data->title; ?><span class="highlight">.</span></h2>
				<?php endif; ?>
			</div>
			<?php echo empty($data->content) ? "" : str_replace('<p','<p class="lead"',$data->content); ?>
			
			<div class="row">
				<div class="testimonials-slider">
					<ul class="slides">
						<?php foreach ($items as $item): ?>
						<li>
							<div class="large-9 large-centered columns text-center">
								<?php echo $item->content; ?>
								<span class="quote-author"><?php echo $item->title; ?> <?php _e("via",'Pixelentity Theme/Plugin'); ?> <?php echo $item->via; ?></span>
							</div>
						</li>
			<?php endforeach; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
</section>