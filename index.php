<?php
/**
 * The main template file.
 *
 * This is the fallback template used when no more specific template is found.
 * For a block theme, WordPress uses templates in /templates/ by default, but
 * this file is required by WordPress core as a minimum theme requirement.
 *
 * @package StartGreen
 */

get_header();
?>

<main id="main" class="site-main section-padding">
	<div class="container-custom">

		<?php if ( have_posts() ) : ?>

			<?php if ( is_home() && ! is_front_page() ) : ?>
				<header class="mb-10">
					<h1 class="text-4xl font-bold text-gray-900">
						<?php single_post_title(); ?>
					</h1>
				</header>
			<?php endif; ?>

			<div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-2xl shadow-sm overflow-hidden border border-gray-100 hover:shadow-md transition-shadow duration-200' ); ?>>

						<?php if ( has_post_thumbnail() ) : ?>
							<a href="<?php the_permalink(); ?>" class="block overflow-hidden aspect-video">
								<?php the_post_thumbnail( 'medium_large', [ 'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300' ] ); ?>
							</a>
						<?php endif; ?>

						<div class="p-6">
							<div class="flex items-center gap-2 text-sm text-gray-500 mb-3">
								<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>">
									<?php echo esc_html( get_the_date() ); ?>
								</time>
								<?php if ( has_category() ) : ?>
									<span>&middot;</span>
									<?php the_category( ', ' ); ?>
								<?php endif; ?>
							</div>

							<h2 class="text-xl font-bold text-gray-900 mb-3 leading-snug">
								<a href="<?php the_permalink(); ?>" class="hover:text-green-700 transition-colors duration-200">
									<?php the_title(); ?>
								</a>
							</h2>

							<div class="text-gray-600 text-sm leading-relaxed line-clamp-3">
								<?php the_excerpt(); ?>
							</div>

							<a href="<?php the_permalink(); ?>" class="inline-flex items-center mt-4 text-sm font-semibold text-green-700 hover:text-green-900 transition-colors duration-200">
								<?php esc_html_e( 'Read more', 'startgreen' ); ?>
								<svg class="ml-1 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
								</svg>
							</a>
						</div>
					</article>
				<?php endwhile; ?>
			</div>

			<?php the_posts_navigation( [ 'class' => 'mt-12' ] ); ?>

		<?php else : ?>

			<div class="text-center py-20">
				<h1 class="text-3xl font-bold text-gray-900 mb-4">
					<?php esc_html_e( 'Nothing found', 'startgreen' ); ?>
				</h1>
				<p class="text-gray-500 mb-8">
					<?php esc_html_e( 'It looks like nothing was found at this location.', 'startgreen' ); ?>
				</p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary">
					<?php esc_html_e( 'Back to Home', 'startgreen' ); ?>
				</a>
			</div>

		<?php endif; ?>

	</div>
</main>

<?php get_footer(); ?>
