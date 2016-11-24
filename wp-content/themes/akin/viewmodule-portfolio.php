<?php $t =& peTheme(); ?>
<?php $project =& $t->project; ?>
<?php list($portfolio,$bid) = $t->template->data(); ?>
<?php $lightbox = !empty($portfolio->lightbox) && $portfolio->lightbox === 'yes'; ?>

<section class="pad-large section-portfolio" id="section-<?php echo empty($portfolio->name) ? $bid : $portfolio->name; ?>">

	<?php if (!empty($portfolio->title)): ?>

		<div class="row">
			<div class="large-12 columns text-center">
				<div class="page-title">

					<h2 class="lowlight"><?php echo $portfolio->title; ?><span class="highlight">.</span></h2>

				</div>
			</div>
		</div>

	<?php endif; ?>

	<div class="projects-wrapper">
		<div class="row">
			<div class="large-12 columns text-center">
				<ul class="filters">
					<?php $project->filter('',"filter","active"); ?>
				</ul>
			</div>
		</div>

		<div class="projects-container">

			<?php $content =& $t->content; ?>

			<?php while ($content->looping()): ?>

				<?php $meta =& $content->meta(); ?>
				<?php $href = get_permalink(); ?>
				<?php $format = get_post_format(); ?>

				<div class="large-4 <?php $project->filterClasses(); ?> project" data-project-file="<?php echo $href; ?>">
					<div class="project-hover">
						<div class="hover-inner">
							<h4 class="lowlight"><?php $content->title(); ?></h4>
							<h6 class="highlight"><?php 

								$terms = get_the_terms( get_the_id(), 'prj-category' );
								$output = '';

								if ( $terms && ! is_wp_error( $terms ) ) :

									foreach ( $terms as $term ) {
										$output .= $term->name . ' / ';
									}

									$output = substr( $output, 0, -3 );

									echo $output;

								endif;

								?></h6>
						</div>
					</div>
					<?php $content->img( 800, 600 ); ?>
				</div>

			<?php endwhile; ?>

		</div>

		<div class="ajax-container" data-container="container-<?php echo $bid; ?>"></div>

		<?php if ($portfolio->pager === "yes"): ?>

			<?php $t->content->pager(); ?>

		<?php endif; ?>

	</div>

	<?php if (!empty($portfolio->content)): ?>

		<div class="row">
			<div class="large-12 columns pad-top text-center">
				<div class="page-title">
					<?php echo $portfolio->content; ?>
				</div>
				
			</div>
		</div>

	<?php endif; ?>

</section>