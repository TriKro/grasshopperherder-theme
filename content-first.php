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
			<?php ghh_posted_on_first(); ?>
		</time><!-- .entry-meta -->
		<?php endif; ?>

		<h1 class="entry-title"><span><?php the_title(); ?></span></h1>

        <div class="<?php echo (get_comments_number() == 0) ? "comments-no" : "comments-num" ?>"><?php comments_number(); ?></div>
	</header><!-- .entry-header -->

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary post-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content post-content">
		<?php the_content('',FALSE,''); ?>
		<?php /* wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ghh' ), 'after' => '</div>' ) ); */ ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta post-footer">
		<ul>
			<li><a href="https://twitter.com/share" class="twitter-share-button" data-count="none">Tweet</a></li>
		
    		<li><script src="//platform.linkedin.com/in.js" type="text/javascript"></script><script type="IN/Share" data-counter="right"></script></li>
								
			<li><iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;send=false&amp;layout=button_count&amp;width=125&amp;show_faces=false&amp;action=like&amp;colorscheme=light&amp;font&amp;height=21" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:125px; height:21px; margin-top: 1px" allowTransparency="true"></iframe></li>
								
			<li><g:plusone size="medium"></g:plusone></li>
								
			<li><a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink(); ?>" class="pin-it-button" count-layout="none"><img border="0" src="//assets.pinterest.com/images/PinExt.png" title="Pin It" /></a></li>
						
		</ul>
		<a href="<?php the_permalink(); ?>" class="continue-reading">CONTINUE READING</a>
	</footer><!-- #entry-meta -->
</article><!-- #post-<?php the_ID(); ?> -->
