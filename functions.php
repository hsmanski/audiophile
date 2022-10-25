<?php
/**
 * UnderStrap functions and definitions
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// UnderStrap's includes directory.
$understrap_inc_dir = 'inc';

// Array of files to include.
$understrap_includes = array(
	'/theme-settings.php',                  // Initialize theme default settings.
	'/setup.php',                           // Theme setup and custom theme supports.
	'/widgets.php',                         // Register widget area.
	'/enqueue.php',                         // Enqueue scripts and styles.
	'/template-tags.php',                   // Custom template tags for this theme.
	'/pagination.php',                      // Custom pagination for this theme.
	'/hooks.php',                           // Custom hooks.
	'/extras.php',                          // Custom functions that act independently of the theme templates.
	'/customizer.php',                      // Customizer additions.
	'/custom-comments.php',                 // Custom Comments file.
	'/class-wp-bootstrap-navwalker.php',    // Load custom WordPress nav walker. Trying to get deeper navigation? Check out: https://github.com/understrap/understrap/issues/567.
	'/editor.php',                          // Load Editor functions.
	'/block-editor.php',                    // Load Block Editor functions.
	'/deprecated.php',                      // Load deprecated functions.
	
);

// Load WooCommerce functions if WooCommerce is activated.
if ( class_exists( 'WooCommerce' ) ) {
	$understrap_includes[] = '/woocommerce.php';
}

// Load Jetpack compatibility file if Jetpack is activiated.
if ( class_exists( 'Jetpack' ) ) {
	$understrap_includes[] = '/jetpack.php';
}

// Include files.
foreach ( $understrap_includes as $file ) {
	require_once get_theme_file_path( $understrap_inc_dir . $file );
}

// This theme uses wp_nav_menu() in two locations.
register_nav_menus( array (
	'primary' => __('Primary Navigation', 'audiophile-theme'),
	'secondary' => __('Secondary Navigation', 'audiophile-theme')
));

// Removes the Category: and just shows title
add_filter( 'get_the_archive_title', 'replaceCategoryName'); 
   function replaceCategoryName ($title) {

   $title =  single_cat_title( '', false );
   return $title; 
}

/** Remove product data tabs */
add_filter( 'woocommerce_product_tabs', 'my_remove_product_tabs', 98 );
 
function my_remove_product_tabs( $tabs ) {
  unset( $tabs['additional_information'] ); // To remove the additional information tab
  return $tabs;
}

/**
 * Remove the breadcrumbs 
 */
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

// Adds custom javascript file 
function audiophile_scripts() {
	wp_enqueue_script('extra js', get_stylesheet_directory_uri().'/src/js/custom-javascript.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'audiophile_scripts');

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

// Clear Cart Button
add_action( 'init', 'woocommerce_clear_cart_url' );
function woocommerce_clear_cart_url() {
  global $woocommerce;
	
	if ( isset( $_GET['empty-cart'] ) ) {
		$woocommerce->cart->empty_cart(); 
	}
}

// Change mini cart subtotal text to Total
function woocommerce_widget_shopping_cart_subtotal() {
	echo '<strong>' . esc_html__( 'Total', 'woocommerce' ) . '</strong> ' . WC()->cart->get_cart_subtotal(); 
}

// Adds Filter to mini cart product titles
function wpse_remove_shorts_from_cart_title( $product_name ) {
	$product_name = str_ireplace( 'headphones', '', $product_name ); // remove "Headphones";
	$product_name = str_ireplace( 'speaker', '', $product_name ); // remove "Speakers"
	$product_name = str_ireplace( 'wireless earphones', '', $product_name ); // remove "Wireless Earphones"

	return $product_name;
}
add_filter( 'woocommerce_cart_item_name', 'wpse_remove_shorts_from_cart_title' );

// 1. Show plus minus buttons
  
add_action( 'woocommerce_after_quantity_input_field', 'bbloomer_display_quantity_plus' );
  
function bbloomer_display_quantity_plus() {
   echo '<button type="button" class="plus">+</button>';
}
  
add_action( 'woocommerce_before_quantity_input_field', 'bbloomer_display_quantity_minus' );
  
function bbloomer_display_quantity_minus() {
   echo '<button type="button" class="minus">-</button>';
}
  
// -------------
// 2. Trigger update quantity script
  
add_action( 'wp_footer', 'bbloomer_add_cart_quantity_plus_minus' );
  
function bbloomer_add_cart_quantity_plus_minus() {
 
   if ( ! is_product() && ! is_cart() ) return;
    
   wc_enqueue_js( "   
           
      $(document).on( 'click', 'button.plus, button.minus', function() {
  
         var qty = $( this ).parent( '.quantity' ).find( '.qty' );
         var val = parseFloat(qty.val());
         var max = parseFloat(qty.attr( 'max' ));
         var min = parseFloat(qty.attr( 'min' ));
         var step = parseFloat(qty.attr( 'step' ));
 
         if ( $( this ).is( '.plus' ) ) {
            if ( max && ( max <= val ) ) {
               qty.val( max ).change();
            } else {
               qty.val( val + step ).change();
            }
         } else {
            if ( min && ( min >= val ) ) {
               qty.val( min ).change();
            } else if ( val > 1 ) {
               qty.val( val - step ).change();
            }
         }
 
      });
        
   " );
}

/**
 Remove all possible fields
 **/
function wc_remove_checkout_fields( $fields ) {

	// Billing fields
	unset( $fields['billing']['billing_company'] );
	unset( $fields['billing']['billing_state'] );
	unset( $fields['billing']['billing_last_name'] );
	unset( $fields['billing']['billing_address_1'] );
	unset( $fields['billing']['billing_address_2'] );
	unset( $fields['billing']['billing_city'] );
	unset( $fields['billing']['billing_postcode'] );
	unset( $fields['billing']['billing_first_name'] );
	unset( $fields['billing']['billing_email'] );
	unset( $fields['billing']['billing_phone'] );

	// Shipping fields
	unset( $fields['shipping']['shipping_company'] );
	unset( $fields['shipping']['shipping_phone'] );
	unset( $fields['shipping']['shipping_state'] );
	unset( $fields['shipping']['shipping_first_name'] );
	unset( $fields['shipping']['shipping_last_name'] );
	unset( $fields['shipping']['shipping_address_2'] );
	unset( $fields['shipping']['shipping_address_1'] );
	unset( $fields['shipping']['shipping_postcode'] );
	unset( $fields['shipping']['shipping_city'] );
	

	// Order fields
	unset( $fields['order']['order_comments'] );

	return $fields;
}
add_filter( 'woocommerce_checkout_fields', 'wc_remove_checkout_fields' );


// Billing details name and email added
add_action( 'woocommerce_after_checkout_billing_form', 'name_add_custom_checkout_field' );
  
function name_add_custom_checkout_field( $checkout ) { 
   
   ?><div class="row-wrapper name-wrapper">
   <?php
   $current_user = wp_get_current_user();
   $saved_name = $current_user->name;
   woocommerce_form_field( 'name', array(        
      'type' => 'text',        
      'class' => array( 'name-input' ),        
      'label' => 'Name',        
      'placeholder' => 'Alexel',        
      'required' => true,        
      'default' => $saved_name,        
   ), $checkout->get_value( 'name' ) ); 
   $current_user = wp_get_current_user();
   $saved_email = $current_user->email;
   woocommerce_form_field( 'email', array(        
      'type' => 'email',        
      'class' => array(  'email-input' ),        
      'label' => 'Email Address',        
      'placeholder' => 'Alexel@gmail.com',        
      'required' => true,        
      'default' => $saved_email,        
   ), $checkout->get_value( 'email' ) );  
   ?>
   </div>
   <?php
}

add_action( 'woocommerce_checkout_process', 'name_validate_new_checkout_field' );
  
function name_validate_new_checkout_field() {    
   if ( ! $_POST['name'] ) {
      wc_add_notice( 'Please enter your name', 'error' );
   }
}

add_action( 'woocommerce_checkout_process', 'email_validate_new_checkout_field' );
  
function email_validate_new_checkout_field() {    
   if ( ! $_POST['email'] ) {
      wc_add_notice( 'Please enter your email address', 'error' );
   }
}

// Billing details phone added
add_action( 'woocommerce_after_checkout_billing_form', 'phone_add_custom_checkout_field' );
  
function phone_add_custom_checkout_field( $checkout ) { 
   ?><div class="row-wrapper">
   <?php
   $current_user = wp_get_current_user();
   $saved_phone = $current_user->phone;
   woocommerce_form_field( 'phone', array(        
      'type' => 'tel',        
      'class' => array( 'phone-input' ),        
      'label' => 'Phone Number',        
      'placeholder' => '+1(202)555-0136',        
      'required' => true,        
      'default' => $saved_phone,        
   ), $checkout->get_value( 'phone' ) );  
   ?>
   </div>
   <?php
}

add_action( 'woocommerce_checkout_process', 'phone_validate_new_checkout_field' );
  
function phone_validate_new_checkout_field() {    
   if ( ! $_POST['phone'] ) {
      wc_add_notice( 'Please enter your phone number', 'error' );
   }
}

// Shipping Info address added
add_action( 'woocommerce_before_order_notes', 'address_add_custom_checkout_field' );
  
function address_add_custom_checkout_field( $checkout ) { 
   ?><div class="row-wrapper">
   <?php
   $current_user = wp_get_current_user();
   $saved_address = $current_user->address;
   woocommerce_form_field( 'address', array(        
      'type' => 'text',        
      'class' => array( 'address-input' ),        
      'label' => 'Address',        
      'placeholder' => '1137 Williams Avenue',        
      'required' => true,        
      'default' => $saved_address,        
   ), $checkout->get_value( 'address' ) ); 
   ?>
   </div>
   <?php
}

add_action( 'woocommerce_checkout_process', 'address_validate_new_checkout_field' );
  
function address_validate_new_checkout_field() {    
   if ( ! $_POST['address'] ) {
      wc_add_notice( 'Please enter your Address', 'error' );
   }
}

// Shipping Info zip code and city added
add_action( 'woocommerce_before_order_notes', 'zipcode_add_custom_checkout_field' );
  
function zipcode_add_custom_checkout_field( $checkout ) { 
   ?><div class="row-wrapper">
   <?php
   $current_user = wp_get_current_user();
   $saved_zipcode = $current_user->zipcode;
   woocommerce_form_field( 'zipcode', array(        
      'type' => 'text',        
      'class' => array(  'zipcode-input' ),        
      'label' => 'ZIP Code',        
      'placeholder' => '10001',        
      'required' => true,        
      'default' => $saved_zipcode,        
   ), $checkout->get_value( 'zipcode' ) ); 
   $current_user = wp_get_current_user();
   $saved_city = $current_user->city;
   woocommerce_form_field( 'city', array(        
      'type' => 'text',        
      'class' => array(  'city-input' ),        
      'label' => 'City',        
      'placeholder' => 'New York',        
      'required' => true,        
      'default' => $saved_city,        
   ), $checkout->get_value( 'city' ) );  
   ?>
   </div>
   <?php
    
}

add_action( 'woocommerce_checkout_process', 'zipcode_validate_new_checkout_field' );
  
function zipcode_validate_new_checkout_field() {    
   if ( ! $_POST['zipcode'] ) {
      wc_add_notice( 'Please enter your zipcode', 'error' );
   }
}

add_action( 'woocommerce_checkout_process', 'city_validate_new_checkout_field' );
  
function city_validate_new_checkout_field() {    
   if ( ! $_POST['city'] ) {
      wc_add_notice( 'Please enter your city', 'error' );
   }
}

// Shipping Info Country added
add_action( 'woocommerce_before_order_notes', 'country2_add_custom_checkout_field' );
  
function country2_add_custom_checkout_field( $checkout ) { 
   ?><div class="row-wrapper">
   <?php
   $current_user = wp_get_current_user();
   $saved_country2 = $current_user->country2;
   woocommerce_form_field( 'country2', array(        
      'type' => 'text',        
      'class' => array(  'country-input' ),        
      'label' => 'Country',        
      'placeholder' => 'United States',        
      'required' => true,        
      'default' => $saved_country2,        
   ), $checkout->get_value( 'country2' ) ); 
   ?>
   </div>
   <?php
}

add_action( 'woocommerce_checkout_process', 'country2_validate_new_checkout_field' );
  
function country2_validate_new_checkout_field() {    
   if ( ! $_POST['country2'] ) {
      wc_add_notice( 'Please enter your country2', 'error' );
   }
}

// Grand Total Function
