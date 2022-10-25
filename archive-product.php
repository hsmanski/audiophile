<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

	<!-- <div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1"> -->
		<!-- <div class="row"> -->

			<main class="site-main" id="main">

				<?php
				if ( have_posts() ) {
					?>
					<div class="banner-wrapper">
						<div class="<?php echo esc_attr( $container ); ?>">
							<header class="page-header">
								
								<?php
								the_archive_title( '<h1 class="page-title">', '</h1>' );
								the_archive_description( '<div class="taxonomy-description">', '</div>' );
								?>
							</header><!-- .page-header -->
						</div><!-- container -->
					</div><!-- .banner-wrapper -->
					<?php
					// Start the loop.
					$left = true;
					while ( have_posts() ) {
						the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						if($left) {
							get_template_part( 'loop-templates/content', get_post_format() );
						} else{
							get_template_part( 'loop-templates/content-reverse', get_post_format() );
						}
						if($left) {
							$left = false;
						} else {
							$left = true;
						}
						
						
					}
				} else {
					get_template_part( 'loop-templates/content', 'none' );
				}
				?>

				<div id="categories-container">
					<div class="<?php echo esc_attr( $container ); ?>">
						<div class="categories-wrapper">
							<div class="category-wrapper">
								<div class="content-wrapper">
									<img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/image-category-thumbnail-headphones.png" alt="">
									<div class="title-container">
										<p class="category-title">Headphones</p>
										<a href="<?php echo site_url('/product-category/headphones'); ?>" class="shop-btn">Shop <i class="fa fa-chevron-right"></i></a>
									</div>
								</div><!-- .content-wrapper -->
							</div><!-- .category-wrapper -->

							<div class="category-wrapper category-wrapper-speakers">
								<div class="content-wrapper ">
									<img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/image-category-thumbnail-speakers.png" alt="">
									<div class="title-container">
										<p class="category-title">Speakers</p>
										<a href="<?php echo site_url('/product-category/speakers'); ?>" class="shop-btn">Shop <i class="fa fa-chevron-right"></i></a>
									</div>
								</div><!-- .content-wrapper -->
							</div><!-- .category-wrapper -->

							<div class="category-wrapper">
								<div class="content-wrapper">
									<img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/image-category-thumbnail-earphones.png" alt="">
									<div class="title-container">
										<p class="category-title">Earphones</p>
										<a href="<?php echo site_url('/product-category/earphones'); ?>" class="shop-btn">Shop <i class="fa fa-chevron-right"></i></a>
									</div>
								</div><!-- .content-wrapper -->
							</div><!-- .category-wrapper -->
						</div><!-- .categories-wrapper -->
					</div><!-- container -->
				</div><!-- #categories-container -->

			</main><!-- #main -->

			<?php
			// Display the pagination component.
			understrap_pagination();
			// Do the right sidebar check.
			// get_template_part( 'global-templates/right-sidebar-check' );
			// ?>

		<!-- </div>.row -->

	<!-- </div>#content -->

</div><!-- #archive-wrapper -->

<?php
get_footer('top');
get_footer();
