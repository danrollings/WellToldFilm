<?php $t =& peTheme(); ?>
<?php $content =& $t->content; ?>
<?php $meta = $t->content->meta(); ?>

<section class="home-hero animate">

	<?php $loop = $t->gallery->getSliderLoop( $meta->hero->gallery ); ?>

	<?php if ( $loop ): ?>

		<div class="home-hero-slider">
			<ul class="slides">

				<?php while ($slide =& $loop->next()): ?>

					<li class="has-parallax">
						<div class="row slide-content">
							<div class="large-10 large-centered columns text-center">

								<?php if ( ! empty( $meta->hero->logo ) ) : ?>

									<img class="logo" alt="logo" src="<?php echo $meta->hero->logo;?>" />

								<?php endif; ?>

								<?php if ( ! empty( $slide->ititle ) || ! empty( $slide->caption ) ) : ?>

									<?php if ( ! empty( $slide->ititle ) ) : ?>

										<h1 class="text-white"><?php echo $slide->ititle; ?></h1>

									<?php endif; ?>

									<?php if ( ! empty( $slide->caption ) ) : ?>

										<span class="alt-h text-white"><?php echo $slide->caption; ?></span>

									<?php endif; ?>

								<?php endif; ?>

							</div>
						</div>

						<img class="slider-bg" alt="<?php echo esc_attr( $slide->alt ); ?>" src="<?php echo esc_attr( $slide->img ); ?>" />

					</li>

				<?php endwhile; ?>
		
			</ul>

		</div>

	<?php else: ?>

		<br>
		<br>
		<br>
		<p><?php _e("Gallery you selected as a Slider Gallery in page settings contains no slides, make sure to upload at least one image for selected gallery.",'Pixelentity Theme/Plugin'); ?></p>

	<?php endif; ?>

</section>