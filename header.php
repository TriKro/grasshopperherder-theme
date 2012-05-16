<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package GHH
 * @since GHH 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		echo " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'ghh' ), max( $paged, $page ) );

	?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<!--[if lt IE 9]>
<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js" type="text/javascript"></script>
<![endif]-->

<?php wp_enqueue_script('jquery'); ?>
<?php wp_head(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/script.js" type="text/javascript"></script>
<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.dotdotdot-1.4.2-packed.js" type="text/javascript"></script>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site container">
	<?php do_action( 'before' ); ?>
	<header id="masthead" class="site-header header" role="banner">
		<!-- hgroup>
			<h1 class="site-title"><a href="<?php echo home_url( '/' ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
		</hgroup -->

		<nav role="navigation" class="site-navigation main-navigation">
<?php 
wp_nav_menu( array( 'theme_location' => 'primary',
                    'container' => false,
                    'walker' => new Nav_Walker ) );
                                      
class Nav_Walker extends Walker_Nav_Menu {
    var $count = 1;

    function start_el(&$output, $item, $depth, $args) {
        parent::start_el($output, $item, $depth, $args);
        if($depth == 0) {
            $output = $this->str_lreplace('href', "id='nav$this->count' href", $output);
            $this->count++;
        }
    }
    
    function str_lreplace($search, $replace, $subject) {
        $pos = strrpos($subject, $search);

        if($pos === false)
        {
            return $subject;
        }
        else
        {
            return substr_replace($subject, $replace, $pos, strlen($search));
        }
    }
}
?> 
		</nav>
	</header><!-- #masthead .site-header -->

	<div id="main" class="content-wrapper">
		<div class="content">
            <?php if(is_home()) : ?>
			<aside><?php bloginfo( 'description' ); ?></aside>
			<?php endif; ?>