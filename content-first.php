<?php

/**

 * @package GHH

 * @since GHH 1.0

 */

?>



<article id="post-<?php the_ID(); ?>" <?php /* post_class("featured-post"); */ ?> class="featured-post">

	<header class="entry-header post-header">

		<?php if ( 'post' == get_post_type() ) : ?>

		<time class="entry-meta date">

			<!-- <?php ghh_posted_on_first(); ?> -->

		</time><!-- .entry-meta -->

		<?php endif; ?>



		<h1 class="entry-title"><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h1>



        <?php if(get_comments_number() != 0) : ?>

        <div class="comments-num"><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>

        <?php endif; ?>

	</header><!-- .entry-header -->



    <a href="<?php the_permalink(); ?>">

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>

	<div class="entry-summary post-content">

		<?php the_excerpt(); ?>

	</div><!-- .entry-summary -->

	<?php else : ?>

	<div class="entry-content post-content">
        <?php the_post_thumbnail(array(560,200)); ?>
		<?php echo strip_tags(

                do_shortcode(wpautop(get_the_content('', FALSE, ''))),

                 '<strong><script><blockquote><p><br><div><h1><h2><h3><h4><h5><h6>'); ?>

		<?php /* wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ghh' ), 'after' => '</div>' ) ); */ ?>

	</div><!-- .entry-content -->

	<?php endif; ?>

	</a>



	<footer class="entry-meta post-footer">

		<ul>
			<li><?php dd_twitter_generate('Compact','trikro') ?></li>
    		<li><?php dd_linkedin_generate('NoCount') ?></li>
			<li><?php dd_fblike_generate('Like Button Count') ?></li>
			<li><?php dd_google1_generate('Compact (20px)') ?></li>
			<li><?php dd_pinterest_generate('Compact') ?></li>
		</ul>

		<a href="<?php the_permalink(); ?>" class="continue-reading">CONTINUE READING</a>

	</footer><!-- #entry-meta -->

</article><!-- #post-<?php the_ID(); ?> -->

