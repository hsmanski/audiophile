<?php
/**
 * Post rendering content according to caller of get_template_part
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

global $product;
?>

<div class="<?php echo esc_attr( $container ); ?>">
	<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

		<div class="category-product-container category-product-container-reverse">
			<!-- <?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?> -->
      <div class="entry-content">
				<div class="entry-content-wrapper">
					<div class="new-product"><?php
					the_field('new_product');?></div>
					<?php
					
					the_title(
						sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
					'</a></h2>'
					);
					?>
					<div class="desc"><?php the_field('description_under_title');?></div>
					<a href="<?php echo esc_url( get_permalink()) ?>" class="button">See Product</a>

					<?php
					understrap_link_pages();
					
					?>
				</div>
				
				
			</div><!-- .entry-content -->

			<div class="product-thumbnail-container">
				<div class="product-thumbnail-web">
					<?php

					$image = get_field('web_product_image');

					if( !empty($image) ): ?>

						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

					<?php endif; ?>
				
				</div><!-- .product-thumbnail-web -->

				<div class="product-thumbnail-tablet">
					<?php

					$image = get_field('tablet_product_image');

					if( !empty($image) ): ?>

						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

					<?php endif; ?>
				
				</div><!-- .product-thumbnail-tablet -->

				<div class="product-thumbnail-mobile">
					<?php

					$image = get_field('mobile_product_image');

					if( !empty($image) ): ?>

						<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

					<?php endif; ?>
				
				</div><!-- .product-thumbnail-mobile -->
			</div><!-- .product-thumbnail-container -->

		</div><!-- .category-product-container -->

		

		

		<footer class="entry-footer">

			

		</footer><!-- .entry-footer -->

	</article><!-- #post-## -->
</div>

