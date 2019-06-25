<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 *
 */
?>
	<div class="main-content-end"></div>
	
	</div><!-- #main -->

	<div id="footer" role="contentinfo">
		<div id="colophon">

			<div id="site-info">

				<?php echo '&copy; '.date_i18n(__('Y','blog-info')); ?>
                <span class="sep"> | </span>
				<?php printf( esc_html__( 'Blog info WordPress Theme ','blog-info')); ?>
                <span class="sep"> | </span>
				<?php printf( esc_html__( 'By Bharat Kambariya', 'blog-info' )); ?>


            <div class="social_icons">
                <?php
                $facebook =  get_option('facebook_url') ? get_option('facebook_url') : '#';
                $twitter =  get_option('twitter_url') ? get_option('twitter_url') : '#';
                $instagram =  get_option('instagram_url') ? get_option('instagram_url') : '#';
                ?>
                <ul>
                    <li>
                        <a href="<?php echo $facebook; ?>" target="_blank"></a>
                    </li>
                    <li>
                        <a href="<?php echo $twitter; ?>" target="_blank"></a>
                    </li>
                    <li>
                        <a href="<?php echo $instagram; ?>" target="_blank"></a>
                    </li>
                </ul>
                <!--Facebook icon-->
                <a href="<?php echo $facebook; ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/facebook.png">
                </a>
                <!--Twitter icon-->
                <a href="<?php echo $twitter; ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/twitter.png">
                </a>
                <!--Instagram icon-->
                <a href="<?php echo $instagram; ?>" target="_blank">
                    <img src="<?php echo get_template_directory_uri(); ?>/images/instagram.png">
                </a>
            </div>
		</div><!-- #colophon -->
        </div><!-- #site-info -->
	</div><!-- #footer -->

</div><!-- #wrapper -->

<?php
	/* Always have wp_footer() just before the closing </body>
	 * tag of your theme, or you will break many plugins, which
	 * generally use this hook to reference JavaScript files.
	 */

	wp_footer();
?>
</body>
</html>
