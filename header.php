<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class( 'bg-white text-gray-900 antialiased' ); ?>>
<?php wp_body_open(); ?>

<div id="page" class="min-h-screen flex flex-col">

	<header id="masthead" class="site-header sticky top-0 z-50 bg-white/95 backdrop-blur-sm border-b border-gray-100 shadow-sm">
		<div class="container-custom">
			<nav class="flex items-center justify-between h-16 lg:h-20" aria-label="<?php esc_attr_e( 'Primary navigation', 'startgreen' ); ?>">

				<!-- Site Logo / Name -->
				<div class="site-branding flex-shrink-0">
					<?php if ( has_custom_logo() ) : ?>
						<div class="site-logo">
							<?php the_custom_logo(); ?>
						</div>
					<?php else : ?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 text-green-700 no-underline" rel="home">
							<svg class="w-8 h-8" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
								<circle cx="16" cy="16" r="16" fill="#1a7a4a"/>
								<path d="M16 8C11.582 8 8 11.582 8 16s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm0 2a6 6 0 110 12A6 6 0 0116 10z" fill="#2ecc71"/>
								<path d="M16 13a3 3 0 100 6 3 3 0 000-6z" fill="white"/>
							</svg>
							<span class="text-lg font-bold tracking-tight">
								<?php bloginfo( 'name' ); ?>
							</span>
						</a>
					<?php endif; ?>
				</div>

				<!-- Primary Navigation (desktop) -->
				<div class="hidden lg:flex items-center gap-8">
					<?php
					wp_nav_menu(
						[
							'theme_location' => 'primary',
							'menu_class'     => 'flex items-center gap-6 list-none m-0 p-0',
							'container'      => false,
							'depth'          => 2,
							'fallback_cb'    => false,
							'link_before'    => '<span class="text-sm font-medium text-gray-700 hover:text-green-700 transition-colors duration-200">',
							'link_after'     => '</span>',
						]
					);
					?>
					<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary text-sm">
						<?php esc_html_e( 'Get Started', 'startgreen' ); ?>
					</a>
				</div>

				<!-- Mobile menu button -->
				<button
					id="mobile-menu-toggle"
					type="button"
					class="lg:hidden inline-flex items-center justify-center p-2 rounded-md text-gray-700 hover:text-green-700 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-green-500 transition-colors duration-200"
					aria-controls="mobile-menu"
					aria-expanded="false"
				>
					<span class="sr-only"><?php esc_html_e( 'Open main menu', 'startgreen' ); ?></span>
					<!-- Hamburger icon -->
					<svg id="icon-menu" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
					</svg>
					<!-- Close icon -->
					<svg id="icon-close" class="w-6 h-6 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
						<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
					</svg>
				</button>

			</nav>

			<!-- Mobile Navigation -->
			<div id="mobile-menu" class="lg:hidden hidden border-t border-gray-100 py-4">
				<?php
				wp_nav_menu(
					[
						'theme_location' => 'primary',
						'menu_class'     => 'flex flex-col gap-1 list-none m-0 p-0',
						'container'      => false,
						'depth'          => 2,
						'fallback_cb'    => false,
						'link_before'    => '<span class="block px-3 py-2 text-sm font-medium text-gray-700 hover:text-green-700 hover:bg-gray-50 rounded-lg transition-colors duration-200">',
						'link_after'     => '</span>',
					]
				);
				?>
				<div class="pt-4 pb-2">
					<a href="<?php echo esc_url( home_url( '/contact' ) ); ?>" class="btn-primary text-sm w-full justify-center">
						<?php esc_html_e( 'Get Started', 'startgreen' ); ?>
					</a>
				</div>
			</div>

		</div><!-- .container-custom -->
	</header><!-- #masthead -->

	<div id="content" class="site-content flex-1">
