<?php
/**
 * @package GHH
 * @since GHH 1.0
 */
?>

<?php
global $wp_query;
$is_right_column = !($wp_query->current_post%2);
$extra_class = $is_right_column ? "fr" : "";
if($wp_query->current_post == count($posts)-1) {
    $extra_class .= " last";
}
 ?>
<article id="post-<?php the_ID(); ?>" <?php post_class($extra_class); ?>>
    <?php if ( has_post_thumbnail() ) {
	   the_post_thumbnail();
    } ?> 
	<h5 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'ghh' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h5>

	<?php if ( 'post' == get_post_type() ) : ?>
	<div class="entry-meta">
		<?php ghh_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>

	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ghh' ) ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ghh' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
</article><!-- #post-<?php the_ID(); ?> -->
<?php if($is_right_column) : ?>
    <div class="fix"></div>
<?php endif; ?>
