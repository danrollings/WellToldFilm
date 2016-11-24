<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WellToldFilm
 */

get_header(); ?>
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text">	
						<?php single_post_title(); ?>
					</h1>
					<div class="video-wrapper">
						<!--<video autoplay poster ="" loop="loop" preload="metadata">
							<source src=" http://localhost:8888/wp-content/uploads/2016/11/The-Speech-Giver-DAN-LOGO-HD-1080p-FINAL-HD-1080p.webm" type="video/webm">
							<source src="http://localhost:8888/wp-content/uploads/2016/11/The-Speech-Giver-DAN-LOGO-HD-1080p-FINAL-HD-1080p.mp4" type="video/mp4">
						</video> -->
					</div>
				</header>

				<div id="intro-text">
					<h2 class="intro intro-title">What we do!</h2>
					<p class="intro intro-para">Bespoke pabst blog, small batch live-edge sustainable pitchfork pop-up. Paleo whatever thundercats kitsch four loko, fap chambray scenester pug banjo offal mustache prism shabby chic narwhal. Pork belly letterpress bicycle rights salvia tofu waistcoat. Tofu thundercats fingerstache, tumblr tbh knausgaard intelligentsia pickled shoreditch tacos health goth coloring book iPhone enamel pin chicharrones. Tumblr jianbing pickled, subway tile vape pork belly thundercats tofu gochujang shoreditch keytar. Kogi meggings hot chicken, four dollar toast ugh sustainable roof party direct trade migas green juice cray pinterest single-origin coffee scenester raclette. Migas poutine yr, chartreuse crucifix jean shorts pitchfork cornhole farm-to-table waistcoat affogato hoodie iPhone.</p>

				</div>
			<?php
			endif;?>
			<div class="col">
			<h1>Video</h1>
<?php
			/* Start the Loop */
			query_posts('post_type= video');
			$i = 1; while ( have_posts() && $i < 7) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'components/post/content', get_post_format() );

			$i++; endwhile;?>
			</div>
			<div class="col">
			<h1>Web</h1>

			<?php
			query_posts('post_type= web');
			$i = 1; while ( have_posts() && $i < 4) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'components/post/content', get_post_format() );

			$i++; endwhile;?>
			</div>
			<?php

			the_posts_navigation();

		else :

			get_template_part( 'components/post/content', 'none' );

		endif; ?>
			</div>
		</main>
	</div>
<?php
get_sidebar();
get_footer();
