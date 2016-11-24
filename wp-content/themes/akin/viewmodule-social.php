<?php $t =& peTheme(); ?>
<?php list($data,$bid) = $t->template->data(); ?>

<section id="section-<?php echo empty($data->name) ? $bid : $data->name; ?>" class="social-bar">

	<?php $width = empty( $data->layout ) ? 'large-4' : esc_attr( $data->layout ); ?>
	
	<?php if ( ! empty( $data->icons ) ) : ?>

		<?php foreach ( $data->icons as $icon ) : ?>

				<div class="<?php echo $width; ?> text-center social-link <?php echo str_replace( 'icon ', 'color-icon-', esc_attr( $icon['icon'] ) ); ?>">
					<a href="<?php echo esc_attr( $icon['url'] ); ?>">
						<div class="<?php echo esc_attr( $icon['icon'] ); ?>"></div>
						<div class="link-hover">
							<h6 class="text-white"><?php echo $icon['text']; ?></h6>
						</div>
					</a>
				</div>

		<?php endforeach; ?>

	<?php endif; ?>

</section>