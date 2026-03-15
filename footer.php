	</div><!-- #content -->

	<footer id="colophon" class="site-footer bg-gray-900 text-gray-300">

		<!-- Footer Main -->
		<div class="container-custom section-padding">
			<div class="grid gap-12 md:grid-cols-2 lg:grid-cols-4">

				<!-- Brand column -->
				<div class="lg:col-span-2">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="inline-flex items-center gap-2 text-white no-underline mb-4" rel="home">
						<svg class="w-8 h-8" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
							<circle cx="16" cy="16" r="16" fill="#1a7a4a"/>
							<path d="M16 8C11.582 8 8 11.582 8 16s3.582 8 8 8 8-3.582 8-8-3.582-8-8-8zm0 2a6 6 0 110 12A6 6 0 0116 10z" fill="#2ecc71"/>
							<path d="M16 13a3 3 0 100 6 3 3 0 000-6z" fill="white"/>
						</svg>
						<span class="text-lg font-bold tracking-tight"><?php bloginfo( 'name' ); ?></span>
					</a>
					<p class="text-gray-400 text-sm leading-relaxed max-w-sm">
						<?php bloginfo( 'description' ); ?>
					</p>
				</div>

				<!-- Quick Links -->
				<div>
					<h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">
						<?php esc_html_e( 'Quick Links', 'startgreen' ); ?>
					</h3>
					<?php
					wp_nav_menu(
						[
							'theme_location' => 'footer',
							'menu_class'     => 'flex flex-col gap-2 list-none m-0 p-0',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
							'link_before'    => '<span class="text-sm text-gray-400 hover:text-white transition-colors duration-200">',
							'link_after'     => '</span>',
						]
					);
					?>
				</div>

				<!-- Contact -->
				<div>
					<h3 class="text-white font-semibold mb-4 text-sm uppercase tracking-wider">
						<?php esc_html_e( 'Contact', 'startgreen' ); ?>
					</h3>
					<address class="not-italic flex flex-col gap-3 text-sm text-gray-400">
						<a href="mailto:info@startgreencapital.com" class="hover:text-white transition-colors duration-200">
							info@startgreencapital.com
						</a>
					</address>
				</div>

			</div>
		</div>

		<!-- Footer Bottom -->
		<div class="border-t border-gray-800">
			<div class="container-custom py-6 flex flex-col sm:flex-row items-center justify-between gap-4 text-sm text-gray-500">
				<p>
					&copy; <?php echo esc_html( (string) gmdate( 'Y' ) ); ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="hover:text-white transition-colors duration-200">
						<?php bloginfo( 'name' ); ?>
					</a>.
					<?php esc_html_e( 'All rights reserved.', 'startgreen' ); ?>
				</p>
				<p>
					<?php
					printf(
						/* translators: %s: WordPress link */
						esc_html__( 'Proudly powered by %s', 'startgreen' ),
						'<a href="https://wordpress.org" class="hover:text-white transition-colors duration-200" target="_blank" rel="noopener noreferrer">WordPress</a>'
					);
					?>
				</p>
			</div>
		</div>

	</footer><!-- #colophon -->

</div><!-- #page -->

<script>
( function () {
	const toggle   = document.getElementById( 'mobile-menu-toggle' );
	const menu     = document.getElementById( 'mobile-menu' );
	const iconMenu  = document.getElementById( 'icon-menu' );
	const iconClose = document.getElementById( 'icon-close' );

	if ( ! toggle || ! menu ) return;

	toggle.addEventListener( 'click', function () {
		const isOpen = ! menu.classList.contains( 'hidden' );

		menu.classList.toggle( 'hidden', isOpen );
		iconMenu.classList.toggle( 'hidden', ! isOpen );
		iconClose.classList.toggle( 'hidden', isOpen );
		toggle.setAttribute( 'aria-expanded', String( ! isOpen ) );
	} );
} )();
</script>

<?php wp_footer(); ?>
</body>
</html>
