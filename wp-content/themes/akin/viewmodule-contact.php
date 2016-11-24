<?php $t =& peTheme(); ?>
<?php list($data,$bid) = $t->template->data(); ?>

<?php $style = empty( $data->background ) ? '' : 'style="background-image: url( ' . $data->background . ');"' ; ?>

<section class="section-contact" id="section-<?php echo empty($data->name) ? $bid : $data->name; ?>" <?php echo $style; ?>>

	<div class="row">

		<?php if ( ! empty( $data->details_title ) || ! empty( $data->details_address ) || ! empty( $data->details_phone ) || ! empty( $data->details_email ) ) : ?>
	
			<div class="large-5 columns">

				<?php if ( ! empty( $data->details_title ) ) : ?>

					<h4><?php echo $data->details_title; ?></h4>

				<?php endif; ?>

				<ul class="contact-methods">

					<?php if ( ! empty( $data->details_address ) ) : ?>

						<li>
							<div class="highlight icon icon icon_pin_alt"></div>
							<div class="method-text">
								<?php echo $data->details_address; ?>
							</div>
						</li>

					<?php endif; ?>

					<?php if ( ! empty( $data->details_phone ) ) : ?>
					
						<li>
							<div class="highlight icon icon icon_mobile"></div>
							<div class="method-text">
								<?php echo $data->details_phone; ?>
							</div>
						</li>

					<?php endif; ?>
					
					<?php if ( ! empty( $data->details_email ) ) : ?>

						<li>
							<div class="highlight icon icon icon_mail_alt"></div>
							<div class="method-text">
								<?php echo $data->details_email; ?>
							</div>
						</li>

					<?php endif; ?>

				</ul>
			</div>

		<?php endif; ?>
		
		<div class="large-7 columns">

			<?php if ( ! empty( $data->form_title ) ) : ?>

				<h4><?php echo $data->form_title; ?></h4>

			<?php endif; ?>

			<form method="post" class="peThemeContactForm" id="contactform-<?php echo $bid; ?>">

				<div class="contact-form">
					<input type="text" class="highlight form-input-left" name="author" placeholder="<?php _e("Name:",'Pixelentity Theme/Plugin'); ?>" />
					<input type="text" class="highlight form-input-right" name="email" placeholder="<?php _e("Email:",'Pixelentity Theme/Plugin'); ?>" />
					<input type="text" class="highlight form-message" name="message" placeholder="<?php _e("Message:",'Pixelentity Theme/Plugin'); ?>" />
				</div>
				<div class="btn send-btn form-button"><?php _e("Send",'Pixelentity Theme/Plugin'); ?> <div class="icon arrow_right">&nbsp;</div> </div>
				<div class="btn reset-btn form-button"><?php _e("Reset",'Pixelentity Theme/Plugin'); ?> <div class="icon icon_close">&nbsp;</div> </div>
				
				<div id="contactFormSent" class="notification-wrap"><p><?php echo $data->msgOK; ?></p></div>
				<div id="contactFormError" class="notification-wrap"><p>* Please fill all fields correctly.</p></div>

			</form>

		</div>

	</div>

</section>