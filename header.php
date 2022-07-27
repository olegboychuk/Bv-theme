<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php 
$image = (is_front_page())? get_field('logo_home','option') : get_field('logo','option');
$header_class = is_front_page()? 'home':'';
?>
<?php wp_body_open(); ?>

<div id="wrapper">
	<header>
		<div class="header <?= $header_class; ?> ">
			<div class="container d-none d-sm-block">
				<div class="row">
					<div class="col-3 logo">
						<a href="<?= esc_url( home_url( '/' ) ); ?>">
							<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="img-fluid">
						</a>
					</div>
					<div class="col-7 menu" role="navigation">
						<?php $main_menu = array(
							'menu'           => 'Main Menu',
							'theme_location' => 'main_menu',
							'menu_class'     => 'main-menu list-inline',
							'depth'          => 3,
							'container'      => false,
							'fallback_cb'    => 'wp_page_menu',
							// 'walker'         => new BootstrapNavMenuWalker(),
							'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
							'walker'            => new WP_Bootstrap_Navwalker(),
						);
						wp_nav_menu( $main_menu ); ?>
					</div>
					<div class="col-2">

					</div>
				</div>
			</div>

			<!-- //mobile menu -->
			<div class="container mob-menu-cntr d-block d-sm-none">
				<div class="row mobheader-row py-2">
					<div class="col-3">
						<div class="mobile-menu-trigger menu-mob-icon">
							<span class="grad-main"></span>
							<span class="grad-main"></span>
							<span class="grad-main"></span>
						</div>
					</div>
					<div class="col-3"></div>
					<div class="col-6">
						<a href="<?= esc_url( home_url( '/' ) ); ?>">
							<img src="<?= $image['url']; ?>" alt="<?= $image['alt']; ?>" class="logo-mob">
						</a>
					</div>
				</div>
			</div>

			
		</div>
	</header>
			<div class="d-block d-sm-none the-mobile-menu">
				<?php $main_menu = array(
					'menu'           => 'Main Menu',
					'theme_location' => 'main_menu',
					'menu_class'     => 'main-menu list-inline',
					'depth'          => 3,
					'container'      => false,
					'fallback_cb'     => 'wp_page_menu',
					'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
					'walker'            => new WP_Bootstrap_Navwalker(),
				);
				wp_nav_menu( $main_menu ); ?>	
				<ul class="main-menu">
					<li>
						<a class="pl mainwebsite-link mt-4 d-block" href="https://goldfarb.com/" target="_blank">
							אתר גולדפרב 		
						</a>
					</li>
				</ul>
			</div>
	<main id="main">