<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$container = get_theme_mod( 'understrap_container_type' );

get_header( 'shop' ); ?>

	<?php
		/**
		 * woocommerce_before_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>

		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>

			<?php wc_get_template_part( 'content', 'single-product' ); ?>

		<?php endwhile; // end of the loop. ?>

	<?php
		/**
		 * woocommerce_after_main_content hook.
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
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

<?php
get_footer('top');
get_footer();

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
