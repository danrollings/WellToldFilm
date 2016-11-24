<?php $t =& peTheme(); ?>
<?php list($data,$items,$bid) = $t->template->data(); ?>
<?php $bg = empty($data->image) ? "" : sprintf('style="background-image: url(%s);"',$data->image) ?>

<section class="services" id="section-<?php echo empty($data->name) ? $bid : $data->name; ?>">
	<div class="services-bg" <?php echo $bg; ?>></div>
	<div class="row pad-large">
		<div class="large-8 columns">
			<div class="page-title">
				<?php if (!empty($data->title)): ?>
				<h2 class="lowlight"><?php echo $data->title; ?><span class="highlight">.</span></h2>
				<?php endif; ?>
			</div>
			<?php echo empty($data->content) ? "" : str_replace('<p','<p class="lead"',$data->content); ?>
			
			<?php foreach ($items as $item): ?>
			<div class="service">
				<div class="service-icon">
					<div class="<?php echo $item->icon; ?>"></div>
				</div>
				<div class="service-text">
					<h6><?php echo $item->title; ?></h6>
					<?php echo $item->content; ?>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>