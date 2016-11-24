<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php list($settings) = $t->template->data(); ?>
<?php $pager = empty( $settings->pager ) || $settings->pager === 'yes'; ?>
<?php $isSingle = is_single(); ?>

<?php while ($content->looping() ) : ?>

	<?php $meta =& $content->meta(); ?>
	<?php $link = get_permalink(); ?>

	<li>
		<div class="blog-icon">
			<?php switch($content->format()): case "gallery": ?>

				<div class="icon icon_images"></div>

			<?php break; case "video": ?>

				<div class="icon icon_film"></div>

			<?php break; default: ?>

				<div class="icon icon_document_alt"></div>

			<?php endswitch; ?>

		</div>
		<div class="blog-title-op">
			<h3><?php $content->title(); ?></h3>
			<span><?php the_time('F j, Y'); ?></span><span class="read-more"><a href="<?php echo $link ?>" class="highlight"><?php _e( 'Read More' ,'Pixelentity Theme/Plugin'); ?></a></span>
		</div>
	</li>

<?php endwhile; ?>