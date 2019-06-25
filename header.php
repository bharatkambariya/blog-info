<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 *
 */
 
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php
	/* We add some JavaScript to pages with the comment form
	 * to support sites with threaded comments (when in use).
	 */
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	/* Always have wp_head() just before the closing </head>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to add elements to <head> such
	 * as styles, scripts, and meta tags.
	 */
	wp_head();
?>
</head>

<body <?php body_class(); ?>>
<div class="hfeed">
	<div id="header" role="banner">
		<div id="access" role="navigation">
            <div id="wrapper" class="hfeed">
			<?php /*  hidden div to preload the hover image */ ?>
			<div id="preloader"></div>
		  <?php /*  Allow screen readers / text browsers to skip the navigation menu and get right to the good stuff */ ?>
			<div class="skip-link screen-reader-text"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'blog-info' ); ?>"><?php esc_html_e( 'Skip to content', 'blog-info' ); ?></a></div>
			<?php /* Our navigation menu.  If one isn't filled out, wp_nav_menu falls back to wp_page_menu.  The menu assiged to the primary position is the one used.  If none is assigned, the menu with the lowest ID is used.  */ ?>
                <div class="H-logo"><a href="<?php echo esc_url( home_url('/') ); ?>" ><?php bloginfo( 'name' ); ?></a></div>
                <div class="right-blk">
                    <?php wp_nav_menu( array( 'container_class' => 'menu-header', 'theme_location' => 'primary' ) ); ?>
                <div class="search"><?php get_search_form(); ?></div>
            </div><!-- #right-->
		</div><!-- #wrapper -->
    </div><!-- #access -->

	</div><!-- #header -->
    <div id="banner" role="banner">

    </div>
	<div id="main">
