<?php $t =& peTheme(); ?>
<?php list($data,$items) = $t->template->data(); ?>

<?php if (!empty($items)): ?>
<div class="row">
	<div class="large-12 large-centered columns nopad about-icons offix">
		<?php foreach ($items as $item): ?>
		<?php $item = (object) $item; ?>
		<div class="large-4 columns text-center">
			<div class="<?php echo $item->icon; ?>"></div>
		</div>
		<?php endforeach; ?>
		<div class="process-line"></div>
	</div>
</div>

<div class="row">				
	<div class="large-12 large-centered columns no-pad">
		<?php foreach ($items as $number => $item): ?>
		<?php $item = (object) $item; ?>
		<div class="large-4 columns">
			<div class="process">
				<div class="number lowlight">
					<?php echo $number+1; ?>.
				</div>
				<div class="process-text">
					<h6 class="lowlight"><?php echo $item->title; ?></h6>
					<?php echo $item->content; ?>
				</div>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>


<div class="row">
	<div class="large-12 columns text-center">
		<?php if (!empty($data->label1)): ?>
		<a href="<?php echo $data->url1; ?>" class="process-button"><div class="btn"><?php echo $data->label1; ?><div class="icon icon_camera_alt"></div></div></a>
		<?php endif; ?>
		<?php if (!empty($data->text)): ?>
		<span class="highlight ampersand process-separator"><?php echo $data->text; ?></span>
		<?php endif; ?>
		<?php if (!empty($data->label2)): ?>
		<a href="<?php echo $data->url2; ?>" class="process-button"><div class="btn"><?php echo $data->label2; ?><div class="icon arrow_right">&nbsp;</div></div></a>
		<?php endif; ?>
	</div>
</div>