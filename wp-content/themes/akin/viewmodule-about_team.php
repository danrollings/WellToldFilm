<?php $t =& peTheme(); ?>
<?php list($data,$items) = $t->template->data(); ?>

<?php if (!empty($items)): ?>
<div class="row">
	<div class="large-12 columns no-pad">
		<?php foreach ($items as $number => $item): ?>
		<?php $item = (object) $item; ?>
		<div class="large-4 columns">
			<div class="team-member">
				<?php if (!empty($item->image)): ?>
				<?php echo $t->image->resizedImg($item->image,940,0); ?>
				<?php endif; ?>
				<div class="title">
					<?php if (!empty($item->title)): ?>
					<span><?php echo $item->title; ?></span>
					<?php endif; ?>
					<?php if (!empty($item->position)): ?>
					<span class="position"><?php echo $item->position; ?></span>
					<?php endif; ?>
				</div>
				<?php echo $item->content; ?>
				<?php foreach ( $item->icons as $icon ) : ?>
				<?php $icon = (object) $icon; ?>
				<a href="<?php echo $icon->url; ?>">
					<div class="team-social <?php echo str_replace( 'icon ', 'color-icon-', esc_attr( $icon->icon ) ); ?>">
						<div class="<?php echo $icon->icon ?>"></div>
					</div>
				</a>
				<?php endforeach; ?>
			</div>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>