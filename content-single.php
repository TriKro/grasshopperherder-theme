<?php
/**
 * @package GHH
 * @since GHH 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" class="featured-post">
	<header class="entry-header post-header">
		<?php if ( 'post' == get_post_type() ) : ?>
		<time class="entry-meta date">
			<?php ghh_posted_on_first(); ?>
		</time><!-- .entry-meta -->
		<?php endif; ?>

		<h1 class="entry-title"><span><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></span></h1>

        <?php if(get_comments_number() != 0) : ?>
        <div class="comments-num"><a href="<?php comments_link(); ?>"><?php comments_number(); ?></a></div>
        <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ghh' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->


	<footer class="entry-meta">
		Posted on 
		<time class="entry-meta date">
			<?php ghh_posted_on_first(); ?>
		</time>
		<?php
			/* translators: used between list items, there is a space after the comma */
			$category_list = get_the_category_list( __( ', ', 'ghh' ) );

			/* translators: used between list items, there is a space after the comma */
			$tag_list = get_the_tag_list( '', ', ' );

			$meta_text = __( 'in %1$s &#8226; <a href="%3$s" title="Permalink to %4$s" rel="bookmark">Permalink</a>', 'ghh' );
			printf(
				$meta_text,
				$category_list,
				$tag_list,
				get_permalink(),
				the_title_attribute( 'echo=0' )
			);
		?>

		
		<?php edit_post_link( __( '&#8226; Edit', 'ghh' ), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
