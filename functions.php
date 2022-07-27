<?php
/**
 *  https://developer.wordpress.org/themes/basics/theme-functions/
 */

require_once get_template_directory() . '/inc/functions/setup.php'; // --- Theme setup ---

require_once get_template_directory() . '/inc/functions/enqueues.php'; // --- Include CSS & JavaScript ---

require_once get_template_directory() . '/inc/functions/images.php'; // --- Image settings ---

require_once get_template_directory() . '/inc/functions/navmenus.php'; // --- Register navmenus ---

// require_once get_template_directory() . '/inc/functions/sidebars.php'; // --- Register sidebars ---

require_once get_template_directory() . '/inc/helpers/class-wp-bootstrap-navwalker.php'; // --- Nav Walker ---

// foreach ( glob( get_template_directory() . '/inc/functions/cpt/*.php' ) as $cpt ) {
// 	require_once $cpt;
// }; // --- Register Custom Post Types & Taxonomies ---

require_once get_template_directory() . '/inc/functions/global.php'; // --- Various global functions ---

require_once get_template_directory() . '/inc/integrations/acf.php'; // --- ACF integration ---

// require_once get_template_directory() . '/inc/functions/integrations/cf7.php'; // --- Contact Form 7 integration ---

// require_once get_template_directory() . '/inc/functions/searchfilter.php'; // --- Search results filter ---

require_once get_template_directory() . '/inc/functions/cleanup.php'; // --- Cleanup ---

// require_once get_template_directory() . '/inc/functions/custom.php'; // --- Custom user functions ---