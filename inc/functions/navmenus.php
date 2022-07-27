<?php
/**
 * https://developer.wordpress.org/themes/functionality/navigation-menus/
 */
if ( ! function_exists( 'bv_navmenus' ) ) {
	function bv_navmenus() {
		register_nav_menus(
			array(
				'header'    => esc_html__( 'Header Menu', 'bv-thm' ),
				'main_menu'	=> esc_html__( 'Main Menu', 'bv-thm' ),
				'footer'    => esc_html__( 'Footer Menu', 'bv-thm' ),
				'menu_mob'	=> esc_html__( 'Menu Mobile', 'bv-thm' ),
			)
		);
	}
}
add_action( 'after_setup_theme', 'bv_navmenus' );