<?php
/*
Template Name: Full width
*/

get_header(); ?>

		<div id="primary" class="site-content content-inner">
			<div id="content" role="main" class="fullwidth">

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'page' ); ?>

					<?php comments_template( '', true ); ?>

				<?php endwhile; // end of the loop. ?>

			</div><!-- #content .col1-->

		</div><!-- #primary .site-content .content-inner -->
<?php get_footer(); ?>