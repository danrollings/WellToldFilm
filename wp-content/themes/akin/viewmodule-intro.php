<?php $t =& peTheme(); ?>
<?php list($data,$bid) = $t->template->data(); ?>

<section id="section-<?php echo empty($data->name) ? $bid : $data->name; ?>" class="pad-large">

	<div class="row">
		<div class="large-12 columns text-center">
			<div class="page-title">
				<h1 class="lowlight"><?php echo $data->title; ?><span class="highlight">.</span></h1>
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="large-12 columns text-center">
			<?php echo empty($data->content) ? "" : str_replace('<p','<p class="lead"',$data->content); ?>
		</div>
	</div>

</section>
