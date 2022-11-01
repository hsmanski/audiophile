# audiophile
# Frontend Mentor - Audiophile e-commerce website solution

This is my solution to the [Audiophile e-commerce website challenge on Frontend Mentor](https://www.frontendmentor.io/challenges/audiophile-ecommerce-website-C8cuSd_wx). Frontend Mentor has helped me improve my coding skills by building realistic projects using Figma Design Files. I created a custom theme for this project in Wordpress using the understrap starter files as the base of my theme. 

## Table of contents

- [Overview](#overview)
  - [The challenge](#the-challenge)
  - [Screenshot](#screenshot)
  - [Links](#links)
- [My process](#my-process)
  - [Built with](#built-with)
  - [What I learned](#what-i-learned)
  - [Continued development](#continued-development)
- [Author](#author)

## Overview

### The challenge

Users should be able to:

- View the optimal layout for the app depending on their device's screen size
- See hover states for all interactive elements on the page
- Custom Go back button on some pages
- Mini Cart when cart button at header selected
- Add/Remove products from the cart and mini cart
- Remove all button in mini cart to clear all cart items
- Edit product quantities in the cart and mini cart
- Fill in all fields in the checkout
- See correct checkout totals depending on the products in the cart
  - Shipping always adds $50 to the order
- Advanced Custom Fields are added to product page so owner of site can add more products for the user to view and purchase

### Screenshot

![](./audiophile.png)

### Links

- Live Site URL: [Audiophile Live Site](https://audiophile.heathersmanski.com/)

## My process

### Built with

- HTML5
- CSS
- SASS
- Flexbox
- WordPress
- PHP
- WooCommerce
- Advanced Custom Feilds
- Desktop-first workflow

### What I learned

Creating this project I learned about WordPress, WooCommerce, and PHP. I learned how to create products and add Advanced Custom Fields so the owner of the site can add more products to be sold and they will be styled just like the other products. I learned how to create a custom theme and use WooCommerce to set up products for this site.

- I noticed in the design that there is an image with text right before the footer that is in every page except the checkout and cart pages.
  - In order to have dry code I created a file called footer-top.php. I created the html and styles for this section and now am able to add it to anyother page using php get footer('top') above the footer file that is one every page.

```php
get_footer('top');
get_footer();
```

- The menu links for the header and footer for each item the design has it linking to the category page. In the dashboard I changed to link to each category page. I edited the style for the category page in the content.php file so every category page would look the same.
  - The design has everyother product has an opposite design. For example the first product the image is on the left and description is on right. The next product the description is on the left and image is on the right. For every product it switches.
  - To accomplish this I created another file called content-reverse.php. In this file it was exactly the same as the content.php file only the layout was reversed with the description on the left and image on the right.
  - In the archive-product.php file i created and if statement in the while loop so it would do the reverse layout every other product.
  - The $left boolean starts off true and everytime it goes through the loop it toogles it to false and true. When it is true it use the template content and when it is false it uses the template reverse.
  - This way even if the owner adds more products it will continue to switch the template used no matter how many products are added.

```php
// Start the loop.
$left = true;
while ( have_posts() ) {
	the_post();

	if($left) {
		get_template_part( 'loop-templates/conteget_post_format() );
	} else{
		get_template_part( 'loop-templates/content-reverget_post_format() );
	}
	if($left) {
		$left = false;
	} else {
		$left = true;
	}
} else {
get_template_part( 'loop-templates/content', 'none' );}
```

- I learned how to create Advance Custom Fields and display them on the product page.
  - In the dashboard I created to custom field for each product that if the product is a new item New Product can be added to the product.
  - I created a div for it so I can style the text in css and used the php function the_field. I also used php on the title of the product and the button to see product so it will go to the item that was clicked on. This takes them to the single-product.php file.

```html
<div class="entry-content-wrapper">
	<div class="new-product"><?php the_field('new_product');?></div>
	<?php

	the_title(sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
	'</a></h2>'
	);
	?>
	<div class="desc"><?php the_field('description_under_title');?></div>
	<a href="<?php echo esc_url( get_permalink()) ?>" class="button">See Product</a>

</div>
```

- In the design at the top of certain pages there is a Go back text. To create this I used functions in php. Typically there is a breadcrumb at the top left of the page that shows all the pages to get to the current one.
  - In order to create a custom Go back button I first had to get rid of the breadcrumbs at the top of the page. The first function accomplishes that and it is in my functions.php file.
  - The next function adds the Go back button on the single product page and I was able to style it in css to make it look like the design.
  - Later in the project I wanted to add another Go back button to be on the checkout page. So I learned another way I can accomplish this by using html using the history.back()

```php
// Removes breadcrumbs
add_action( 'init', 'woo_remove_wc_breadcrumbs' );
function woo_remove_wc_breadcrumbs() {
    remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
}

// Creates Go Back Button on single product page
add_action( 'woocommerce_before_single_product', 'my_function_sample', 10);
function my_function_sample() {
  global $product;
  echo ' <button type="button" onclick="history.back();"> Go back </button>' ;
}
```

```html
<button class="button checkout-back-btn" onclick="history.back();">
  Go Back
</button>
```

- In the design there is a button for a mini cart in the header that can display the mini cart on any page. I wanted to learn how to accomplish this without using plugins. It took a lot of research but I was able to figure it out.
  - The first thing I need to do was in the functions.php file I added the following code
  - Next I called this code in the navigation bar where I had the image for the cart.
  - In the mini-cart.php file I was able to edit how the mini cart looked and add content I wanted to show in the mini cart.

```php
// Mini Cart Code
function custom_mini_cart() {
	echo '<a href="#" class="dropdown-back" data-toggle="dropdown"> ';
	echo '<i class="far fa-shopping-cart" aria-hidden="true"></i>';
	echo '<div class="basket-item-count" style="display: inline;">';
	echo '<span class="cart-items-count count">';
	echo WC()->cart->get_cart_contents_count();
	echo '</span>';
	echo '</div>';
	echo '</a>';
	echo '<ul class="dropdown-menu dropdown-menu-mini-cart">';
	echo '<li class="dropdown-menu-mini-cart-wrapper"> <div class="widget_shopping_cart_content">';
	woocommerce_mini_cart();
	echo '</div></li></ul>';

}
add_shortcode( 'quadlayers-mini-cart', 'custom_mini_cart' );
```

```html
<div class="navbar-cart">
  <?php echo do_shortcode('[quadlayers-mini-cart]'); ?>
</div>
```

- In the design for the mini cart there was a Remove all button that was supposed to clear the cart of all items added.
  - The way I learned to create this was first by creating a function in my function.php file.
  - Next in the mini-cart file I called it in the location that I wanted it to show up. I created an a tag and used php to call the function to clear the cart. I than styled it in css to make it look like the design.

```php
// Clear Cart Button
add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
  global $woocommerce;

	if ( isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart();
	}
}
```

```html
<a
  class="button"
  href="<?php echo $woocommerce->cart->get_cart_url(); ?>?empty-cart"
  ><?php _e( 'Remove all', 'woocommerce' ); ?></a
>
```

- In the mini cart the design showed that the title for each product is shortened not displaying the entire title.
  - I noticed that each title cut off the words headphones, speaker, and wireless. So I created a function that removes those words in the title in the mini cart and cart.

```php
// Adds Filter to mini cart product titles
function wpse_remove_shorts_from_cart_title( $product_name ) {
	$product_name = str_ireplace( 'headphones', '', $product_name ); // remove "Headphones";
	$product_name = str_ireplace( 'speaker', '', $product_name ); // remove "Speakers"
	$product_name = str_ireplace( 'wireless earphones', '', $product_name ); // remove "Wireless Earphones"

	return $product_name;
}
add_filter( 'woocommerce_cart_item_name', 'wpse_remove_shorts_from_cart_title' );
```

- The mini cart design shows the Total as the text but by default the title is subtotal.
  - I changed this by adding a function to my function.php file

```php
// Change mini cart subtotal text to Total
function woocommerce_widget_shopping_cart_subtotal() {
	echo '<strong>' . esc_html__( 'Total', 'woocommerce' ) . '</strong> ' . WC()->cart->get_cart_subtotal();
}
```

### Continued development

I learned a lot about PHP with this project and am going to continue to learn about form validation with php. This way I can make the checkout page even better.

I am also going to create a modal window that comes up if the form is validated and the user clicks on continue and pay.

## Author

- Website - [Heather Smanski](https://heathersmanski.com/)
- Frontend Mentor - [@hsmanski](https://www.frontendmentor.io/profile/hsmanski)
