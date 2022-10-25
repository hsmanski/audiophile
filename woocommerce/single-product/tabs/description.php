<?php
/**
 * Description tab
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/description.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.0.0
 */

defined( 'ABSPATH' ) || exit;

global $post;

?>
<div class="<?php echo esc_attr( $container ); ?>">
	<div class="features-box-wrapper">
		<div class="features">
			<h2 class="features-title">Features</h2>
			<div class="features-content"><?php the_content(); ?></div>
		</div>
		<div class="in-the-box">
			<h2 class="box-title">In the box</h2>
			<div class="list-items-wrapper">
				<div class="item">
					<div class="list-quanity"><?php the_field('in_the_box_quantity_1');?></div>
					<div class="list-product"><?php the_field('in_the_box_item_1');?></div>
				</div>
				<div class="item">
					<div class="list-quanity"><?php the_field('in_the_box_quantity_2');?></div>
					<div class="list-product"><?php the_field('in_the_box_item_2');?></div>
				</div>
				<div class="item">
					<div class="list-quanity"><?php the_field('in_the_box_quantity_3');?></div>
					<div class="list-product"><?php the_field('in_the_box_item_3');?></div>
				</div>
				<div class="item">
					<div class="list-quanity"><?php the_field('in_the_box_quantity_4');?></div>
					<div class="list-product"><?php the_field('in_the_box_item_4');?></div>
				</div>
				<div class="item">
					<div class="list-quanity"><?php the_field('in_the_box_quantity_5');?></div>
					<div class="list-product"><?php the_field('in_the_box_item_5');?></div>
				</div>
					
			</div><!-- .list-items-wrapper -->
		</div><!-- .in-the-box -->
	</div><!-- .features-box-wrapper -->
	

	<div class="features-img-container">
		<div class="small-img-wrapper">
			<div class="top-small-img">
			<?php

			$image = get_field('more_photos_small_1');

			if( !empty($image) ): ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

			<?php endif; ?>	
			</div>
			<div class="bottom-small-img">
			<?php

			$image = get_field('more_photos_small_2');

				if( !empty($image) ): ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

			<?php endif; ?>	
			</div>
		</div><!-- .small-img-wrapper -->
		<div class="large-img-wrapper">
			<div class="large-img">
			<?php

			$image = get_field('more_photos_large');

				if( !empty($image) ): ?>

				<img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />

			<?php endif; ?>	
			</div>
		</div><!-- .large-img-wrapper -->
	</div><!-- .features-img-container -->
</div><!-- .container -->