<?php $t =& peTheme(); ?>
<?php $layout =& $t->layout; ?>

<section id="footer">
	<div class="row">
		<div class="large-12 columns text-center">
			<h6><?php echo $t->options->get("footerCopyright"); ?></h6>
		</div>
	</div>
</section>

<?php $t->footer->wp_footer(); ?>

</body>
</html>