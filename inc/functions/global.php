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

/**
 * It changes the length of the excerpt.
 * 
 * @param length The number of words to show in the excerpt.
 * 
 * @return The number of words to be displayed in the excerpt.
 */
function bv_excerpt_length( $length ) {
	return 40;
}
// add_filter( 'excerpt_length', 'bv_excerpt_length', 999 );



/**
 * It removes the #more- tag from the_content_more_link.
 * 
 * @param link The link to the full post.
 * 
 * @return The content of the post.
 */
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

//lang-switcher
/**
 * If the function icl_get_languages exists, then get the languages, create a string, loop through the
 * languages, create a variable for the active language, create a variable for the display language, if
 * the language is not active, then create a variable for the first language, then add the language to
 * the string, then return the string.
 * 
 * @return A string of HTML.
 */
function lang_switcher(){
	if (function_exists('icl_get_languages')) {
		$langs = icl_get_languages('skip_missing=0');
		$langString = '<ul class="lang-list">';
		foreach ($langs as $lang) {
			$activeLang = ($lang['active'] == 0) ? "lang": "active lang";
			$display_lang = $lang['native_name'] == 'English' ? "En" :"עב";
			if ( $lang['active'] == 0 ) {
				$f_lang = $display_lang;
				$langString .= '<li><a class="'. $activeLang .'" href="'. esc_url( $lang['url'] ) .'">'. $f_lang .'</a></li>';
			}
		}
		$langString .= '</ul>';
		return $langString ;
	}
}


// --- Breadcrumbs --- //
/**
 * If the Yoast SEO plugin is active, use its breadcrumbs, otherwise use Rank Math's breadcrumbs.
 * 
 * @return the value of the variable .
 */
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


/**
 * If the current menu item is active, return true
 * 
 * @param item The menu item object.
 * @param args (array) Arguments for displaying the item.
 * 
 * @return a boolean value.
 */
function bv_is_active_nav_item( $item, $args ) {
	if ( ! property_exists( $args, 'walker' ) || ! is_a( $args->walker, 'WP_Bootstrap_Navwalker' ) ) {
		return false;
	}
	if ( ! $item->current && ! $item->current_item_ancestor ) {
		return false;
	}

	return true;
}

/**
 * If the current menu item is active, add the class "active" to the anchor tag
 * 
 * @param atts The attributes for the anchor tag.
 * @param item The current menu item.
 * @param args (array) Arguments for the menu.
 * 
 * @return The attributes of the anchor tag.
 */
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


/**
 * If the current item is not active, return the classes as is. Otherwise, return the classes without
 * the active class
 * 
 * @param classes (array) CSS classes that are applied to the menu item's &lt;li&gt; element.
 * @param item The current menu item.
 * @param args (array) Arguments passed to wp_nav_menu() to retrieve menu items.
 * 
 * @return The classes for the menu item.
 */
function bv_remove_active_class_from_li( $classes, $item, $args ) {
	if ( false === bv_is_active_nav_item( $item, $args ) ) {
		return $classes;
	}

	return array_diff( $classes, array( 'active' ) );
}
add_filter( 'nav_menu_css_class', 'bv_remove_active_class_from_li', 10, 3 );


/**
 * It returns an array of the image URL and the image alt text for a given post ID and image size.
 * 
 * @param postID The ID of the post you want to get the featured image from.
 * @param size (string) (optional) Image size. Defaults to 'thumbnail'.
 * 
 * @return An array with two elements.
 */
function getSrcAltImage($postID,$size=false){
	$imgID  = get_post_thumbnail_id($postID);
	 $img    = wp_get_attachment_image_src($imgID,$size, false, '');
	 $imgAlt = get_post_meta($imgID,'_wp_attachment_image_alt', true);
	 return $imgAttr = array(
		 'url' => $img,
		 'alt' => $imgAlt
	 );
}


/**
 * It gets the first child page of the current page and returns the permalink of that page.
 * 
 * @param post The post object.
 * 
 * @return The permalink of the first child page.
 */
function frst_child_page_id( $post ){

	$child_args = array(
		'post_parent' => $post->ID, // The parent id.
		'post_type'   => 'page',
		'post_status' => 'publish'
	);
	$child_pages = get_children( $child_args );
	$frst_child_page_id = array_key_first ($child_pages);
	$link = get_the_permalink( $frst_child_page_id );

	return $link;
}
?>