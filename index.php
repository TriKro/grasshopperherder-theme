<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package GHH
 * @since GHH 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content content-inner">
			<div id="content" role="main" class="col1">

			<?php if ( have_posts() ) : ?>

				<?php /* ghh_content_nav( 'nav-above' ); */ ?>

                <?php /* first posts gets different layout */ ?>
                <?php
                    $pageNumber = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                    if(have_posts() && $pageNumber == 1) : the_post() ?>
                    <?php
                        get_template_part( 'content-first', get_post_format() );
                    ?>
                <?php endif; ?>

                <h3>RECENT POSTS</h3>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/* Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php ghh_content_nav( 'pagination' ); ?>

			<?php elseif ( current_user_can( 'edit_posts' ) ) : ?>

				<?php get_template_part( 'no-results', 'index' ); ?>

			<?php endif; ?>

			</div><!-- #content .col1-->

            <div class="col2">
            <?php get_sidebar(); ?>
            </div>            
		</div><!-- #primary .site-content .content-inner -->
<?php get_footer(); ?>