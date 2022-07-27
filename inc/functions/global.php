<?php
/**
 * Custom global functions.
*/


/**
 * Fire the wp_body_open action.
 *
 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
 *
 * @since v2.2
 */
if ( ! function_exists( 'wp_body_open' ) ) :
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since v2.2
		 */
		do_action( 'wp_body_open' );
	}
endif;


// --- Excerpt lenght --- //
function bv_excerpt_length( $length ) {
	return 40;
}
// add_filter( 'excerpt_length', 'bv_excerpt_length', 999 );

function remove_more_link($link) {
    $offset = strpos($link, '#more-');
    if ($offset) {
        $end = strpos($link, '"',$offset);
    }
    if ($end) {
        $link = substr_replace($link, '', $offset, $end-$offset);
    }
    return $link;
}
// add_filter('the_content_more_link', 'remove_more_link');


// --- Thumbnail alt --- //
// Echoes the "alt" value of a post thumbnail as inserted in the media gallery
function bv_thumbnail_alt() {
	$bv_thumbnail_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true );
	echo esc_attr( $bv_thumbnail_alt );
}


// --- Breadcrumbs --- //
function bv_breadcrumbs() {
	if ( function_exists( 'yoast_breadcrumb' ) ) {
		// http://yoa.st/breadcrumbs
		yoast_breadcrumb( '<nav class="breadcrumb mt-3">', '</nav>' );
	} elseif ( function_exists( 'rank_math_the_breadcrumbs' ) ) {
		// https://s.rankmath.com/breadcrumbs
		add_filter(
			'rank_math/frontend/breadcrumb/args',
			function( $args ) {
				$args = array(
					'delimiter'   => '&nbsp;&#47;&nbsp;',
					'wrap_before' => '<nav class="breadcrumb mt-3"><span>',
					'wrap_after'  => '</span></nav>',
					'before'      => '',
					'after'       => '',
				);
				return $args;
			}
		);
		rank_math_the_breadcrumbs();
	}
}


// --- Nav Walker attributes fix for Bootstrap 5 --- //
function bv_bs5_toggle_fix( $atts ) {

	if ( array_key_exists( 'data-toggle', $atts ) ) {
		unset( $atts['data-toggle'] );
		$atts['data-bs-toggle'] = 'dropdown';
	}
	return $atts;

}
add_filter( 'nav_menu_link_attributes', 'bv_bs5_toggle_fix' );


function bv_is_active_nav_item( $item, $args ) {
	if ( ! property_exists( $args, 'walker' ) || ! is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
		return false;
	}
	if ( ! $item->current && ! $item->current_item_ancestor ) {
		return false;
	}

	return true;
}

function bv_add_active_class_to_anchor( $atts, $item, $args ) {
	if ( false === bv_is_active_nav_item( $item, $args ) ) {
		return $atts;
	}

	if ( isset( $atts['class'] ) ) {
		$atts['class'] .= ' active';
	} else {
		$atts['class'] = 'active';
	}
	return $atts;
}
add_filter( 'nav_menu_link_attributes', 'bv_add_active_class_to_anchor', 10, 3 );


function bv_remove_active_class_from_li( $classes, $item, $args ) {
	if ( false === bv_is_active_nav_item( $item, $args ) ) {
		return $classes;
	}

	return array_diff( $classes, array( 'active' ) );
}
add_filter( 'nav_menu_css_class', 'bv_remove_active_class_from_li', 10, 3 );
?>