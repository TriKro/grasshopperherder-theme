<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package GHH
 * @since GHH 1.0
 */

if ( ! function_exists( 'ghh_content_nav' ) ):
/**
 * Display navigation to next/previous pages when applicable
 *
 * @since GHH 1.0
 */
function ghh_content_nav( $nav_id ) {
	global $wp_query;

	$nav_class = 'site-navigation paging-navigation';
	if ( is_single() )
		$nav_class = 'site-navigation post-navigation';

	?>
	<nav role="navigation" id="<?php echo $nav_id; ?>" class="<?php echo $nav_class; ?>">

	<?php if ( is_single() ) : // navigation links for single posts ?>

		<?php previous_post_link( '<div class="nav-previous">%link</div>', '<span class="meta-nav">' . _x( '&larr;', 'Previous post link', 'ghh' ) . '</span> %title' ); ?>
		<?php next_post_link( '<div class="nav-next">%link</div>', '%title <span class="meta-nav">' . _x( '&rarr;', 'Next post link', 'ghh' ) . '</span>' ); ?>

	<?php elseif ( $wp_query->max_num_pages > 1 && ( is_home() || is_archive() || is_search() ) ) : // navigation links for home, archive, and search pages ?>

		<?php if ( get_previous_posts_link() ) : ?>
		<div id="pagin-prev"><?php previous_posts_link( __( 'PREV', 'ghh' ) ); ?></div>
		<?php endif; ?>

        <ul>
        <?php global $wp_query; 
            $pages = $wp_query->max_num_pages;
            $count = 0;
            while($count < 5 && $count < $pages): 
                $count++;
                if($count == 1 && get_query_var('paged') == 0) {
                    $active = true;
                } else {
                    $active = get_query_var('paged') == $count ? true : false;
                } ?>
                <li <?php if($active) echo "class=active"; ?>><a href="<?php echo get_pagenum_link($count); ?>"><?php echo $count; ?></a></li>
            <?php endwhile; ?>
            <?php if($pages > 5) : ?>
                <li>...</li>
                <li><a href="<?php echo get_pagenum_link($pages); ?>"><?php echo $pages; ?></a></li>
            <?php endif; ?>
        </ul>
							
		<?php if ( get_next_posts_link() ) : ?>
		<div id="pagin-next"><?php next_posts_link( __( 'NEXT', 'ghh' ) ); ?></div>
		<?php endif; ?>

	<?php endif; ?>

	</nav><!-- #<?php echo $nav_id; ?> -->
	<?php
}
endif; // ghh_content_nav

if ( ! function_exists( 'ghh_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since GHH 1.0
 */
function ghh_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php _e( 'Pingback:', 'ghh' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(Edit)', 'ghh' ), ' ' ); ?></p>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<article id="comment-<?php comment_ID(); ?>" class="comment">
			<footer>
				<div class="comment-author vcard">
					<?php echo get_avatar( $comment, 40 ); ?>
					<?php printf( __( '%s <span class="says">says:</span>', 'ghh' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
				</div><!-- .comment-author .vcard -->
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em><?php _e( 'Your comment is awaiting moderation.', 'ghh' ); ?></em>
					<br />
				<?php endif; ?>

				<div class="comment-meta commentmetadata">
                    <time pubdate datetime="<?php comment_time( 'c' ); ?>">
					<?php
						/* translators: 1: date, 2: time */
						printf( __( '%1$s at %2$s', 'ghh' ), get_comment_date(), get_comment_time() ); ?>
					</time>
					<?php edit_comment_link( __( '(Edit)', 'ghh' ), ' ' );
					?>
				</div><!-- .comment-meta .commentmetadata -->
			</footer>

			<div class="comment-content"><?php comment_text(); ?></div>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->

	<?php
			break;
	endswitch;
}
endif; // ends check for ghh_comment()

if ( ! function_exists( 'ghh_posted_on_first' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 *
 * @since GHH 1.0
 */
function ghh_posted_on_first() {
    printf( __('%1$s <span>%2$s</span> %3$s', 'ghh' ),
        esc_attr( get_the_date( 'M' ) ),
        esc_attr( get_the_date( 'j' ) ),
        esc_attr( get_the_date( 'Y' ) )
    );
}
endif; //ghh_posted_on_first

if ( ! function_exists( 'ghh_posted_on' ) ) :
function ghh_posted_on() {
	printf( __( '<span class="%2$s"><time>%1$s</time>', 'ghh' ),
		esc_attr( get_the_date( 'F d, Y' ) ),
		(get_comments_number() == 0) ? "comments-no" : "comments-num"
	);
	if(get_comments_number() != 0 ) {
        printf( __(' | <a href="%2$s">%1$s Comments</a>', 'ghh'),
            esc_html( get_comments_number() ),
            esc_html( get_comments_link() )
        );
    }
    echo "</span>";
}
endif;

/**
 * Returns true if a blog has more than 1 category
 *
 * @since GHH 1.0
 */
function ghh_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'all_the_cool_cats' ) ) ) {
		// Create an array of all the categories that are attached to posts
		$all_the_cool_cats = get_categories( array(
			'hide_empty' => 1,
		) );

		// Count the number of categories that are attached to the posts
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'all_the_cool_cats', $all_the_cool_cats );
	}

	if ( '1' != $all_the_cool_cats ) {
		// This blog has more than 1 category so ghh_categorized_blog should return true
		return true;
	} else {
		// This blog has only 1 category so ghh_categorized_blog should return false
		return false;
	}
}

/**
 * Flush out the transients used in ghh_categorized_blog
 *
 * @since GHH 1.0
 */
function ghh_category_transient_flusher() {
	// Like, beat it. Dig?
	delete_transient( 'all_the_cool_cats' );
}
add_action( 'edit_category', 'ghh_category_transient_flusher' );
add_action( 'save_post', 'ghh_category_transient_flusher' );