<?php
/**
 * https://developer.wordpress.org/themes/basics/including-css-javascript/
 */
if ( ! function_exists( 'bv_styles_scripts' ) ) {
	function bv_styles_scripts() {

		$theme_version = wp_get_theme()->get( 'Version' );
		$template_url = get_template_directory_uri();

		// jQuery.
		wp_enqueue_script( 'jquery' );

		// Rubik fonts
		// wp_enqueue_style( 'google-fonts-Rubik', '//fonts.googleapis.com/css2?family=Rubik:wght@400;700&display=swap', false, $theme_version, 'all' );
		
		// Assistant fonts
		wp_enqueue_style( 'fonts-google-assistent', '//fonts.googleapis.com/css?family=Assistant:300,400,600,700' );

		// Bootstrap css
		wp_enqueue_style( 'bootstrap-style', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' );
		if( is_rtl() ):
			// wp_enqueue_style( 'bootstrap-style-rtl', $template_url . '/css/bootstrap-rtl.min.css' );
		endif;

		// Bootstrap js
		wp_enqueue_script( 'bootstrap-script', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js' );

		// Swiper css
		wp_enqueue_style( 'Swiper-style', '//cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css' );

		// Swiper js
		wp_enqueue_script( 'Swiper-script', '//cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css' );

		// Aos
		wp_enqueue_style( 'aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css' );
		wp_enqueue_script('aos-script', 'https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js');

		// Main Script
		wp_enqueue_script( 'script', $template_url . '/assets/js/script.js',false, $theme_version, true  );

		// Main Style
		wp_enqueue_style( 'main-style', get_stylesheet_uri() );
		
		// Load Thread comments WordPress script.
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
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
}
add_action( 'wp_enqueue_scripts', 'bv_styles_scripts' );

// Disable this action if not loading Google Fonts from their external server
function bv_google_fonts_preconnect() {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'bv_google_fonts_preconnect', 7 );