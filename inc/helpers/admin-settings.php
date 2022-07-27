<?php
/**
 * Load site scripts.
 */
function loadScript() {
	$template_url = get_template_directory_uri();
	// jQuery.
	wp_enqueue_script( 'jquery' );

	// fonts Assistant
	wp_enqueue_style( 'fonts-google-assistent', '//fonts.googleapis.com/css?family=Assistant:300,400,600,700' );

	// Bootstrap css
	wp_enqueue_style( 'bootstrap-style', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );
	if( is_rtl() ):
		// wp_enqueue_style( 'bootstrap-style-rtl', $template_url . '/css/bootstrap-rtl.min.css' );
	endif;

	// Bootstrap js
	wp_enqueue_script( 'bootstrap-script', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' );

	// aos
	wp_enqueue_style( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css' );
	wp_enqueue_script('aos-script', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js');

	//script
	wp_enqueue_script( 'script', $template_url . '/assets/js/script.js' );

	//Main Style
	wp_enqueue_style( 'main-style', get_stylesheet_uri() );

	// Load Thread comments WordPress script.
	if ( is_singular() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	// AJAX
	wp_localize_script( 'script', 'mAjax', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
	// Load AJAX
	if(!is_admin()) {
		wp_localize_script( 'script-js', 'CustomAjax', array(
			// URL to wp-admin/admin-ajax.php to process the request
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			// generate a nonce with a unique ID "myajax-post-comment-nonce"
			// so that you can check it later when an AJAX request is sent
			'security' => wp_create_nonce( 'my-special-string' )
		));
	}
	if(is_admin()) {
		wp_localize_script( 'script-js-admin', 'AdminAjax', array(
			// URL to wp-admin/admin-ajax.php to process the request
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			// generate a nonce with a unique ID "myajax-post-comment-nonce"
			// so that you can check it later when an AJAX request is sent
			'security' => wp_create_nonce( 'my-special-string' )
		));
	}
}
add_action( 'wp_enqueue_scripts', 'loadScript', 1 );


/**
 * Create the option page.
 */
if( function_exists('acf_add_options_page') ) {
	acf_add_options_page(
		array(
			'page_title' => 'Custom settings',
			'menu_title' => 'Custom settings',
			'menu_slug'  => 'custom-settings',
			'capability' => 'edit_posts',
			'redirect'	 => false
		)
	);
}

/**
 * General Theme Settings
 *
 * @since v1.0
 */
if ( ! function_exists( 'nvh_setup_theme' ) ) :
	function nvh_setup_theme() {

		// Make theme available for translation: Translations can be filed in the /languages/ directory
		load_theme_textdomain( 'nvh', get_template_directory() . '/languages' );

		// Theme Support
		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
			'script',
			'style',
			'navigation-widgets',
		) );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );
		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );
		// Add support for editor styles.
		add_theme_support( 'editor-styles' );
		// Enqueue editor styles.
		add_editor_style( 'assets/css/editor-style.css' );

		// Default Attachment Display Settings
		update_option( 'image_default_align', 'none' );
		update_option( 'image_default_link_type', 'none' );
		update_option( 'image_default_size', 'large' );

		// Custom CSS-Styles of Wordpress Gallery
		add_filter( 'use_default_gallery_style', '__return_false' );

		/* Thumbnails */
		if ( function_exists( 'add_theme_support' ) ) {
			// Custom image sizes
			// add_image_size( '350x280-film', 350, 280, true );
			// add_image_size( '255x280-cat', 255, 280, true );
			// add_image_size( '350x160-events', 350, 160,  array( 'left', 'top' )  );
			// add_image_size( 'banner', 1920, 730,  array( 'left', 'top' )  );
		}
	}
	add_action( 'after_setup_theme', 'nvh_setup_theme' );
endif;

add_filter('acf/settings/remove_wp_meta_box', '__return_false');

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
 * Add menu support and register main menu.
 */
if ( function_exists( 'register_nav_menus' ) ) {
	register_nav_menus(
		array(
			'top_menu'	=> 'Top Menu',
			'main_menu'	=> 'Main Menu',
			'menu_mob'	=> 'Menu Mobile',
		)
	);
}
function set_html_content_type() {
	return 'text/html';
}
/* Allow vcf Files */
add_filter('upload_mimes', 'custom_upload_mimes');
function custom_upload_mimes ( $existing_mimes=array() ) {
	$existing_mimes['vcf'] = 'text/x-vcard';
	return $existing_mimes;
}
/**
 * Removes some menus by page.
 */
function wpdocs_remove_menus(){
	// remove_menu_page( 'index.php' );                  //Dashboard
	// remove_menu_page( 'jetpack' );                    //Jetpack*
	remove_menu_page( 'edit.php' );                   //Posts
	// remove_menu_page( 'upload.php' );                 //Media
	// remove_menu_page( 'edit.php?post_type=page' );    //Pages
	remove_menu_page( 'edit-comments.php' );          //Comments
	// remove_menu_page( 'themes.php' );                 //Appearance
	// remove_menu_page( 'plugins.php' );                //Plugins
	// remove_menu_page( 'users.php' );                  //Users
	// remove_menu_page( 'tools.php' );                  //Tools
	// remove_menu_page( 'options-general.php' );        //Settings
	//if user is != admin
	if( !current_user_can( 'administrator' ) ):
		remove_menu_page( 'profile.php' );
		remove_menu_page( 'tools.php' );
		remove_menu_page( 'users.php' );
	endif;
}
add_action( 'admin_menu', 'wpdocs_remove_menus' );
//Duplicate Posts
function rd_duplicate_post_as_draft(){
	global $wpdb;
	if (! ( isset( $_GET['post']) || isset( $_POST['post'])  || ( isset($_REQUEST['action']) && 'rd_duplicate_post_as_draft' == $_REQUEST['action'] ) ) ) {
		wp_die('No post to duplicate has been supplied!');
	}
	$post_id = (isset($_GET['post']) ? $_GET['post'] : $_POST['post']);
	$post = get_post( $post_id );
	$current_user = wp_get_current_user();
	$new_post_author = $current_user->ID;
	if (isset( $post ) && $post != null) {
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order
		);
		$new_post_id = wp_insert_post( $args );
		$taxonomies = get_object_taxonomies($post->post_type);
		foreach ($taxonomies as $taxonomy) {
			$post_terms = wp_get_object_terms($post_id, $taxonomy, array('fields' => 'slugs'));
			wp_set_object_terms($new_post_id, $post_terms, $taxonomy, false);
		}
		$post_meta_infos = $wpdb->get_results("SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id");
		if (count($post_meta_infos)!=0) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ($post_meta_infos as $meta_info) {
				$meta_key = $meta_info->meta_key;
				$meta_value = addslashes($meta_info->meta_value);
				$sql_query_sel[]= "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query.= implode(" UNION ALL ", $sql_query_sel);
			$wpdb->query($sql_query);
		}
		wp_redirect( admin_url( 'post.php?action=edit&post=' . $new_post_id ) );
		exit;
	} else {
		wp_die('Post creation failed, could not find original post: ' . $post_id);
	}
}
add_action( 'admin_action_rd_duplicate_post_as_draft', 'rd_duplicate_post_as_draft' );
function rd_duplicate_post_link( $actions, $post ) {
	if (current_user_can('edit_posts')) {
		$actions['duplicate'] = '<a href="admin.php?action=rd_duplicate_post_as_draft&amp;post=' . $post->ID . '" title="Duplicate this item" rel="permalink">שכפול</a>';
	}
	return $actions;
}
add_filter('post_row_actions', 'rd_duplicate_post_link', 10, 2);
add_filter('page_row_actions', 'rd_duplicate_post_link', 10, 2);
// function get_the_content_with_formatting ($more_link_text = '(more...)', $stripteaser = 0, $more_file = '') {
// 	$content = get_the_content($more_link_text, $stripteaser, $more_file);
// 	$content = apply_filters('the_content', $content);
// 	$content = str_replace(']]>', ']]&gt;', $content);
// 	return $content;
// }
/**
 * Move option page to top menu order.
 *
 */
function custom_menu_order( $menu_ord ) {
	if (!$menu_ord){
		return true;
	}
	$menu = 'custom-settings';
	// remove from current menu
	$menu_ord = array_diff($menu_ord, array( $menu ));
	// append after index.php [0]
	array_splice( $menu_ord, 10, 0, array( $menu ) );
	return $menu_ord;
}
add_filter('custom_menu_order', 'custom_menu_order');
add_filter('menu_order', 'custom_menu_order');
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
add_filter('the_content_more_link', 'remove_more_link');


function tn_custom_excerpt_length( $length ) {
	return 15;
	}
	add_filter( 'excerpt_length', 'tn_custom_excerpt_length', 999 );
?>
