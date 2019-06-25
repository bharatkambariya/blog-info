<?php
/**
 * The template for displaying Search Results pages.
 *
 *
 */

get_header(); ?>
<div id="wrapper">
			<div id="content" role="main">

<?php if ( have_posts() ) : ?>
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'blog-info' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php
				/* Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called loop-search.php and that will be used instead.
				 */
				 get_template_part( 'loop', 'search' );
				?>
<?php else : ?>
				<div id="post-0" class="post no-results not-found">
					<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'blog-info' ); ?></h2>
					<div class="entry-content">
						<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'blog-info' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
					<div class="entry-footer"></div>
				</div><!-- #post-0 -->
<?php endif; ?>
			</div><!-- #content -->
</div>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
