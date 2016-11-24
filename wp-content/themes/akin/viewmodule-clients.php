<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($data,$loop,$bid) = $t->template->data(); ?>
<?php $bg = empty($data->image) ? "" : sprintf('style="background-image: url(%s);"',$data->image) ?>

<section class="clients" id="section-<?php echo empty($data->name) ? $bid : $data->name; ?>">

	<?php if ($loop): ?>
	<div class="row">
		<div class="client-slider">
			<ul class="slides">			
				<?php while ($slide =& $loop->next()): ?>
				<li><?php echo $t->image->resizedImg($slide->img,250,0); ?></li>
				<?php endwhile; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>

	<?php if (!empty($data->image)): ?>
	<div class="row">
		<div class="large-12 columns">
			<img alt="screens pic" class="hero-screens" src="<?php echo $data->image; ?>" />
		</div>
	</div>
	<?php endif; ?>

</section>