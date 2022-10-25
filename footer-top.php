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

<div class="wrapper" id="wrapper-footer-top">
  <div class="<?php echo esc_attr( $container ); ?>">
    <div class="footer-top-wrapper">
      <div class="text-wrapper">
        <p class="title">Bringing you the <span>best</span> audio gear</p>
        <p class="info">Located at the heart of New York City, Audiophile is the premier store for high end headphones, earphones, speakers, and audio accessories. We have a large showroom and luxury demonstration rooms available for you to browse and experience a wide range of our products. Stop by our store to meet some of the fantastic people who make Audiophile the best place to buy your portable audio equipment.</p>
      </div>
      <div class="img-wrapper">
        <div class="img"></div>
      </div>
    </div><!-- footer-bottom-wrapper -->
  </div><!-- container end -->
</div><!-- wrapper end -->