<?php
/**
 * Introduction functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Blog info
 */

/** Tell WordPress to run blog_info_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'blog_info_setup' );

if ( ! function_exists( 'blog_info_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override blog_info_setup() in a child theme, add your own blog_info_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since Blog info 2.2
 */
function blog_info_setup() {

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style('editor-style.css?=' . time());

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );


    add_theme_support( "post-thumbnails" );
	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );
	
	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'blog_info_custom_background_args', array(
		'default-color' => 'f3f3f3',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'custom-header', apply_filters( 'blog_info_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1000,
		'height'                 => 250,
		'flex-height'            => true,
		'wp-head-callback'       => 'blog_info_header_style',
	) ) );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Navigation', 'blog-info' ),
        'social' => __( 'Social Links Menu', 'blog-info' ),
	) );

	// Don't support text inside the header image.
	//define( 'NO_HEADER_TEXT', true );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'berries' => array(
			'url' => '%s/images/headers/sample1.jpg',
			'thumbnail_url' => '%s/images/headers/sample1-thumbnail.jpg'
		),
		'cherryblossom' => array(
			'url' => '%s/images/headers/sample2.jpg',
			'thumbnail_url' => '%s/images/headers/sample2-thumbnail.jpg'
		),
		'concave' => array(
			'url' => '%s/images/headers/sample3.jpg',
			'thumbnail_url' => '%s/images/headers/sample3-thumbnail.jpg'
		),
		'fern' => array(
			'url' => '%s/images/headers/sample4.jpg',
			'thumbnail_url' => '%s/images/headers/sample4-thumbnail.jpg'
		),
		'forestfloor' => array(
			'url' => '%s/images/headers/sample5.jpg',
			'thumbnail_url' => '%s/images/headers/sample5-thumbnail.jpg'
		),
		'inkwell' => array(
			'url' => '%s/images/headers/sample6.jpg',
			'thumbnail_url' => '%s/images/headers/sample6-thumbnail.jpg'
		),
		'path' => array(
			'url' => '%s/images/headers/sample7.jpg',
			'thumbnail_url' => '%s/images/headers/sample7-thumbnail.jpg'
		),
		'sunset' => array(
			'url' => '%s/images/headers/sample8.jpg',
			'thumbnail_url' => '%s/images/headers/sample8-thumbnail.jpg'
		)
	) );
}
endif;

if ( ! function_exists( 'blog_info_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see blog_info_custom_header_setup().
 */
function blog_info_header_style() {
	$header_text_color = get_header_textcolor();
	// If we get this far, we have custom styles. Let's do this.
	?>
	<style id="custom-header-styles" type="text/css">
		<?php if( get_header_image() ) : ?>
			#header {
				background: url(<?php header_image(); ?>) no-repeat center bottom;
			}
		<?php endif; ?>
		<?php
			// Has the text been hidden?
			if ( 'blank' === $header_text_color ) :
		?>
			.site-title,
			.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
			}
		<?php
			// If the user has set a custom color for the text use that.
			else :
		?>
			.site-title a,
			.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
			}
	    <?php endif; ?>
	</style>
	<?php
}
endif;

if ( ! function_exists( 'blog_info_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own blog_info_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since Blog info 2.2
 */
function blog_info_comment( $comment, $args, $depth ) {
	switch ( $comment->comment_type ) :
		case '' :
	?>
	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
		<div id="comment-<?php comment_ID(); ?>">
		<div class="comment-author vcard">
			<?php echo get_avatar( $comment, 40 ); ?>
			<?php sprintf( __( '%s <span class="says">says:</span>', 'blog-info' ), sprintf( '<cite class="fn">%s</cite>', get_comment_author_link() ) ); ?>
		</div><!-- .comment-author .vcard -->
		<?php if ( $comment->comment_approved == '0' ) : ?>
			<em><?php esc_html_e( 'Your comment is awaiting moderation.', 'blog-info' ); ?></em>
			<br />
		<?php endif; ?>

		<div class="comment-meta commentmetadata"><a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
			<?php
				/* translators: 1: date, 2: time */
				printf( esc_html__( '%1$s at %2$s', 'blog-info' ), get_comment_date(),  get_comment_time() ); ?></a><?php edit_comment_link( esc_html__( '(Edit)','blog-info' ), ' ' );
			?>
		</div><!-- .comment-meta .commentmetadata -->

		<div class="comment-body"><?php comment_text(); ?></div>

		<div class="reply">
			<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
		</div><!-- .reply -->
	</div><!-- #comment-##  -->

	<?php
			break;
		case 'pingback'  :
		case 'trackback' :
	?>
	<li class="post pingback">
		<p><?php esc_html_e( 'Pingback:', 'blog-info' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( esc_html__('(Edit)','blog-info'), ' ' ); ?></p>
	<?php
			break;
	endswitch;
}
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override blog_info_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Blog info 2.2
 * @uses register_sidebar
 */
function blog_info_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => esc_html__( 'Primary Widget Area', 'blog-info' ),
		'id' => 'primary-widget-area',
		'description' => esc_html__( 'The primary widget area', 'blog-info' ),
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li><div class="widget-footer"></div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
/** Register sidebars by running blog_info_widgets_init() on the widgets_init hook. */
add_action( 'widgets_init', 'blog_info_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * @since Blog info 2.2
 */
function blog_info_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'blog_info_remove_recent_comments_style' );

if ( ! function_exists( 'blog_info_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 *
 * @since Blog info 2.2
 */
function blog_info_posted_on() {
	printf( __( '<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s', 'blog-info' ),
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			esc_url( get_permalink() ),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			sprintf( esc_attr__( 'View all posts by %s', 'blog-info' ), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'blog_info_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 *
 * @since Blog info 2.2
 */
function blog_info_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = esc_html__( 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'blog-info' );
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = esc_html__( 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'blog-info' );
	} else {
		$posted_in = esc_html__( 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'blog-info' );
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( esc_html__( ', ', 'blog-info' ) ),
		$tag_list,
		esc_url( get_permalink() ),
		the_title_attribute( 'echo=0' )
	);
}
endif;
if ( ! isset( $content_width ) ) $content_width = 900;
/**
 * Enqueue scripts and styles.
 */
function blog_info_scripts() {
	wp_enqueue_style( 'blog_info-style', get_stylesheet_uri() );

    $fonts_url='https://fonts.googleapis.com/css?family=Arimo|Armata';
           if(!empty($fonts_url)){
            wp_enqueue_style('blog_info-font-name',esc_url_raw($fonts_url),array(),null);
    }

}
add_action( 'wp_enqueue_scripts', 'blog_info_scripts' );

/**
 * Function for blog info page in admin side
 */

function blog_add_theme_menu_item()
{
    add_theme_page("Blog Info Panel", "Blog Info Panel", "manage_options", "blog-info-panel", "blog_theme_settings_page", null, 99);
}

add_action("admin_menu", "blog_add_theme_menu_item");

/**
 * Function for blog info page
 */

function blog_theme_settings_page()
{
    ?>
    <div class="wrap">
        <h1>Blog Info Panel</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields("section");
            do_settings_sections("theme-options");
            submit_button();
            ?>
        </form>
    </div>
    <?php
}


function display_twitter_element()
{
    ?>
    <input type="text" name="twitter_url" id="twitter_url" value="<?php echo get_option('twitter_url'); ?>" />
    <?php
}

function display_facebook_element()
{
    ?>
    <input type="text" name="facebook_url" id="facebook_url" value="<?php echo get_option('facebook_url'); ?>" />
    <?php
}

function display_instagram_element()
{
    ?>
    <input type="text" name="instagram_url" id="instagram_url" value="<?php echo get_option('instagram_url'); ?>" />
    <?php
}

/**
 * Function for social media fildes
 */
function display_theme_panel_fields()
{
    add_settings_section("section", "All Settings", null, "theme-options");

    add_settings_field("twitter_url", "Twitter Profile Url", "display_twitter_element", "theme-options", "section");
    add_settings_field("facebook_url", "Facebook Profile Url", "display_facebook_element", "theme-options", "section");
    add_settings_field("instagram_url", "Instagram Profile Url", "display_instagram_element", "theme-options", "section");

    register_setting("section", "twitter_url");
    register_setting("section", "facebook_url");
    register_setting("section", "instagram_url");
}

add_action("admin_init", "display_theme_panel_fields");

/**
 * Enqueue scripts and styles.
 */
function wpb_add_google_fonts() {

    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Open+Sans:400,600,700', false );
}

add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );