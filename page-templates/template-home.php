<?php
/**
 * Template Name: Template: Home
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

get_header();
?>

<div class="home-banner-container">

  <div class="home-banner <?php echo esc_attr( $container ); ?>">
    <div class="text-container ">
      <div class="text-box">
        <p class="new-product">New Product</p>
        <h1 class="banner-title">XX99 Mark II
  HeadphoneS</h1>
        <p class="info">Experience natural, lifelike audio and exceptional build quality made for the passionate music enthusiast.</p>
        <a href="<?php echo site_url('/product/xx99-mark-ii-headphones'); ?>" class="button">See Product</a>
      </div>
    </div>
  </div><!-- .home-banner container -->
</div><!-- .home-banner-container -->

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

<div id="home-zx9-speaker">
  <div class="<?php echo esc_attr( $container ); ?>">
    <div class="background-wrapper">
      <div class="speaker-wrapper">
        <div class="img"></div>
        <div class="text-wrapper">
          <h2 class="title">ZX9 SPEAKER</h2>
          <p class="desc">Upgrade to premium speakers that are phenomenally built to deliver truly remarkable sound.</p>
          <a href="<?php echo site_url('/product/zx9-speaker'); ?>" class="button">See Product</a>
        </div>
      </div><!-- .speaker-wrapper -->
    </div><!-- .background-wrapper -->
  </div><!-- container -->
</div><!-- #home-zx9-speaker -->

<div id="zx7-speaker">
  <div class="<?php echo esc_attr( $container ); ?>">
    <div class="background-wrapper">
      <div class="text-wrapper">
        <h2 class="title">ZX7 SPEAKER</h2>
        <a href="<?php echo site_url('/product/zx7-speaker'); ?>" class="button">See Product</a>
      </div>
    </div><!-- .background-wrapper -->
  </div><!-- container -->
</div><!-- #zx7-speaker -->

<div id="yx1-earphones">
  <div class="<?php echo esc_attr( $container ); ?>">
    <div class="background-wrapper">
      <div class="img-wrapper"></div>
      <div class="text-container">
        <div class="text-wrapper">
          <h2 class="title">YX1 EARPHONES</h2>
          <a href="<?php echo site_url('/product/yx1-wireless-earphones'); ?>" class="button">See Product</a>
        </div>
      </div>
    </div><!-- .background-wrapper -->
  </div><!-- container -->
</div><!-- #yx1-earphones -->

<?php
get_footer('top');
get_footer();
