<?php $t =& peTheme();?>
<?php $content =& $t->content; ?>
<?php $meta = $t->content->meta(); ?>

<div id="the-navigation" <?php echo is_page() && ! empty( $meta->hero->splash ) && 'yes' === $meta->hero->splash ? '' : 'class="inner-nav"'?>>
	
	<div class="row">
		<div class="large-3 columns">
			<a href="<?php echo home_url(); ?>" class="nav-logo">

			<?php $logo = $t->options->get("logo"); ?>

			<?php if ( ! empty( $logo ) ) : ?>

				<?php $t->image->retina($logo); ?>

			<?php endif; ?>

			</a>
		</div>

		<div id="mobile-toggle" class="right"><div class="icon icon_menu-square_alt2"></div></div>

		<div class="large-9 columns">
			<div id="menu">
				<?php $t->menu->show("main"); ?>				
			</div>
		</div>
	</div>
	
</div><!--end of navigation-->