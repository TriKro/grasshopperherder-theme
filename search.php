<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package GHH
 * @since GHH 1.0
 */

get_header(); ?>

		<div id="primary" class="site-content content-inner">
			<div id="content" role="main" class="col1">

			<?php if ( have_posts() ) : ?>

				<header class="page-header">
					<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'ghh' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				</header>

                <?php /* first posts gets different layout */ ?>
                <?php
                    $pageNumber = (get_query_var('paged')) ? get_query_var('paged') : 1; 
                    if(have_posts() && $pageNumber == 1) : the_post() ?>
                    <?php
                        get_template_part( 'content-first', get_post_format() );
                    ?>
                <?php endif; ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'content', 'search' ); ?>

				<?php endwhile; ?>

				<?php ghh_content_nav( 'pagination' ); ?>

			<?php else : ?>

				<?php get_template_part( 'no-results', 'search' ); ?>

			<?php endif; ?>

			</div><!-- #content .col1-->

            <div class="col2">
            <?php get_sidebar(); ?>
            </div>            
		</div><!-- #primary .site-content .content-inner -->
<?php get_footer(); ?>