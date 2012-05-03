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
    <?php if ( has_post_thumbnail() ) : ?>
        <a class="post-thumbnail" href="<?php the_permalink(); ?>">
        <?php the_post_thumbnail(array(276,176)); ?>
        </a>
    <?php endif; ?> 
	<h4 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permalink to %s', 'ghh' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h4>

	<?php if ( 'post' == get_post_type() ) : ?>
	<div class="entry-meta">
		<?php ghh_posted_on(); ?>
	</div><!-- .entry-meta -->
	<?php endif; ?>

    <a href="<?php the_permalink(); ?>">
	<?php if ( is_search() ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php echo preg_replace(
			"/\[caption .+?\[\/caption\]|\< *[img][^\>]*[.]*\>/i",
			"",
			get_the_content(__( 'Continue reading <span class="meta-nav">&rarr;</span>', 'ghh' ))
			); ?>

		<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'ghh' ), 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
	<?php endif; ?>
	</a>
</article><!-- #post-<?php the_ID(); ?> -->
<?php if($is_right_column) : ?>
    <div class="fix"></div>
<?php endif; ?>
