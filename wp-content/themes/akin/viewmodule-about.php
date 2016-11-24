<?php $t =& peTheme(); ?>
<?php list($view,$data,$items,$bid) = $t->template->data(); ?>

<section class="about-detail pad-large" id="section-<?php echo empty($data->name) ? $bid : $data->name; ?>">

	<div class="row">
		<div class="large-12 columns text-center">
			<div class="page-title">
				<?php if (!empty($data->title)): ?>
				<h2 class="lowlight"><?php echo $data->title; ?><span class="highlight">.</span></h2>
				<?php endif; ?>
			</div>
		</div>
	</div>


	<?php if (!empty($items)): ?>
	<div class="row">
		<div class="large-12 columns text-center">
			<ul class="about-toggle">
				<?php foreach ($items as $pos => $item): ?>
				<?php $sub = (object) $item["data"]; ?>
				<li <?php echo $pos === 0 ? 'class="active"' : ''; ?>><h6><?php echo $sub->title; ?></h6></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>

	<div class="row">
		<div class="about-detail-slider">
			<ul class="slides">
				<?php foreach ($items as $item): ?>
				<li>
					<?php $view->outputModule($item); ?>
				</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
	<?php endif; ?>
</section>