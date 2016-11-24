<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta =& $content->meta(); ?>
<?php get_header(); ?>

<div class="row blog-single">

	<div class="large-9 columns blog-left">
		<?php if ( ! post_password_required( $post->ID ) ) : ?>

			<div class="post-media clearfix">
				<?php $t->media->w( 720 ); ?>
				<?php $t->media->h( 405 ); ?>
				<?php $t->gallery->output( get_the_id(), 'GalleryImages' ); ?>
			</div>

		<?php else : ?>

			<?php echo get_the_password_form(); ?>

		<?php endif; ?>
	</div>
	
	<div class="large-3 columns blog-right">
		<?php get_sidebar(); ?>
	</div>
</div>

<?php get_footer(); ?>