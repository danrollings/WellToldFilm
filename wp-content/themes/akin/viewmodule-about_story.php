<?php $t =& peTheme(); ?>
<?php list($data) = $t->template->data(); ?>

<?php if (!empty($data->icons)): ?>
<div class="row">
	<div class="large-12 columns text-center">
		<div class="about-icons story-icons">
			<?php foreach ($data->icons as $icon): ?>
			<?php $icon = (object) $icon; ?>
			<div class="<?php echo $icon->icon ?>">
				<?php if (!empty($icon->url)): ?>
				<a href="<?php echo $icon->url; ?>"></a>
				<?php endif; ?>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
</div>
<?php endif; ?>

<div class="row">
	<div class="large-10 large-centered columns text-center">
		<?php echo $data->content; ?>
	</div>
</div>