<?php

use fluix\helper\svg_icons;
?>

<?php
/**
 * Desktop navigation
 */
?>

<header class="fls-main-navigation">
	<div class="wrapper fls-main-navigation__wrapper">
		<div class="fls-main-navigation__container">
			<div class="nav_logo fls-main-navigation__logo">
				<a href="<?php echo get_home_url(); ?>" class="fls-main-navigation__logo-link">
					<div class="nav_logo_image">
						<?php echo svg_icons::get('logo'); ?>
					</div>
					<div class="nav_logo_title">
						<?php echo svg_icons::get('logo_title'); ?>
					</div>
				</a>
			</div>
			<div class="fls-main-navigation__menu">
				<?php
				wp_nav_menu([
					'menu' => 'header_menu',
					'theme_location' => 'header_menu',
					'menu_class' => 'fls-main-navigation__menu-list fls-main-navigation--hide-on-tablet fls-main-navigation--hide-on-mobile',
					'container' => false
				]);
				?>
				<ul class="fls-main-navigation__menu-list fls-main-navigation--hide-on-desktop">
					<li class="fls-main-navigation__menu-item-container">
						<a class="fls-main-navigation__item fls-main-navigation__item--without-right-padding" data-mobile-trigger="open" href="#">
							Menu
						</a>
					</li>
				</ul>
				<div class="fls-main-navigation__divider fls-main-navigation--hide-on-tablet fls-main-navigation--hide-on-mobile"></div>
				<ul class="fls-main-navigation__right-menu-list fls-main-navigation--hide-on-tablet fls-main-navigation--hide-on-mobile">
					<li class="fls-main-navigation__menu-item-container">
						<a class="fls-main-navigation__item
                  fls-main-navigation__item--without-right-padding
                  data-ga-btn-ln" href="https://login.fluix.io" rel="nofollow">
							Log In
						</a>
					</li>
					<li class="fls-main-navigation__get-started-button fls-main-navigation--hide-on-tablet">
						<a class="btn-secondary fls-btn fls-btn--new fls-btn--new--dimmed data-ga-btn-gs" href="#">
							Get Started
						</a>
					</li>
					<li class="fls-main-navigation__menu-item-container fls-main-navigation__switcher-container">
						<a href="#" class="fls-main-navigation__item fls-main-navigation__switcher">
							EN
						</a>
					</li>
				</ul>

			</div>
		</div>
	</div>
</header>