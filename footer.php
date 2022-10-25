<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );
?>

<?php get_template_part( 'sidebar-templates/sidebar', 'footerfull' ); ?>

<div class="wrapper" id="wrapper-footer">
	<!-- <div class="footer-top-wrapper">
		<div class="container">
			top content goes here
		</div>
		
	</div> -->

	<div class="footer-bottom-wrapper">

		<div class="<?php echo esc_attr( $container ); ?>">

			<div class="row">

				<div class="col-md-12">

					<footer class="site-footer" id="colophon">

						<div class="site-info">
							<div class="footer-main">
								<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/logo.svg" alt="audiophile logo" class="navbar-logo"></a>
								<div class="footer-nav">
									<?php wp_nav_menu(array('theme_location'=> 'secondary')); ?>
								</div>
							</div><!-- .footer-main -->
							<div class="footer-info-wrapper">
								<div class="footer-info">
									<p class="footer-desc">Audiophile is an all in one stop to fulfill your audio needs. We're a small team of music lovers and sound specialists who are devoted to helping you get the most out of personal audio. Come and visit our demo facility - we're open 7 days a week.
									</p>
									<div class="copyright-wrapper">
										<p class="copyright">Copyright <?php echo date('Y'); ?>. All Rights Reserved</p>
										<div class="footer-social footer-social-tablet">
											<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/icon-facebook.svg" alt="facebook icon" class="social-icon"></a>
											<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/icon-twitter.svg" alt="twitter icon" class="social-icon"></a>
											<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/icon-instagram.svg" alt="instagram icon" class="social-icon"></a>
										</div>
									</div>
									
								</div>
								<div class="footer-social">
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/icon-facebook.svg" alt="facebook icon" class="social-icon"></a>
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/icon-twitter.svg" alt="twitter icon" class="social-icon"></a>
									<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/icon-instagram.svg" alt="instagram icon" class="social-icon"></a>
								</div>
							</div>
							

							

						</div><!-- .site-info -->

					</footer><!-- #colophon -->

				</div><!--col end -->

			</div><!-- row end -->

		</div><!-- container end -->
	</div><!-- footer-bottom-wrapper -->

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>

