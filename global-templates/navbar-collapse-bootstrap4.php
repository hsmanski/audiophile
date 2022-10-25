<?php
/**
 * Header Navbar (bootstrap4)
 *
 * @package Understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'understrap_container_type' );

?>

<nav id="main-nav" class="navbar navbar-expand-lg navbar-dark bg-primary " aria-labelledby="main-nav-label">
	<div class="nav-container <?php echo esc_attr( $container ); ?>">

		<div class="main-nav-container">
			<div class="mobile-menu-dropdown">
				<div class="mobile-dropdown-left">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="<?php esc_attr_e( 'Toggle navigation', 'understrap' ); ?>">
						<span></span><i class="fa fa-bars"></i>
					</button>
					<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/logo.svg" alt="audiophile logo" class="navbar-logo-tablet"></a>
				</div>
				<div class="mobile-dropdown-right">
				
					<div class="navbar-cart-tablet">
						<?php echo do_shortcode('[quadlayers-mini-cart]'); ?>
					</div>
				</div>
			</div>
			
			<div class="navbar-logo-wrapper">
				<a href="#"><img src="<?php echo get_template_directory_uri(); ?>/img/shared/desktop/logo.svg" alt="audiophile logo" class="navbar-logo"></a>
			</div>

			

		

			<!-- The WordPress Menu goes here -->
			<div class="main-nav-wp">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'navbarNavDropdown',
					'menu_class'      => 'navbar-nav ml-auto',
					'fallback_cb'     => '',
					'menu_id'         => 'main-menu',
					'depth'           => 2,
					'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>
			</div>

			<div class="navbar-cart-wrapper">
				<div class="navbar-cart">
					<?php echo do_shortcode('[quadlayers-mini-cart]'); ?>
				</div>
			</div>
			
		</div><!-- .main-nav-container -->
		
			<!-- The WordPress Menu goes here -->
			<div class="dropdown-nav-wp">
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => 'primary',
					'container_class' => 'collapse navbar-collapse',
					'container_id'    => 'navbarNavDropdown',
					'menu_class'      => 'navbar-nav ml-auto',
					'fallback_cb'     => '',
					'menu_id'         => 'main-menu',
					'depth'           => 2,
					'walker'          => new Understrap_WP_Bootstrap_Navwalker(),
				)
			);
			?>
			</div>
		
		
	</div><!-- .nav-container -->
</nav><!-- .site-navigation -->

