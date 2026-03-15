<?php
/**
 * Hero Block — Render Template
 *
 * Available variables:
 *   $block   (array)  — Block settings and attributes from block.json.
 *   $content (string) — InnerBlocks content (empty unless jsx support is used).
 *   $is_preview (bool) — True when rendered inside the block editor preview.
 *   $post_id (int|string) — The post ID this block is associated with.
 *   $context (array)  — Block context.
 *
 * @package StartGreen
 */

// ---------------------------------------------------------------------------
// Field values
// ---------------------------------------------------------------------------

$heading               = get_field( 'heading' )               ?: '';
$subheading            = get_field( 'subheading' )            ?: '';
$background_image      = get_field( 'background_image' )      ?: null;
$primary_button_text   = get_field( 'primary_button_text' )   ?: '';
$primary_button_url    = get_field( 'primary_button_url' )    ?: '';
$secondary_button_text = get_field( 'secondary_button_text' ) ?: '';
$secondary_button_url  = get_field( 'secondary_button_url' )  ?: '';
$overlay_opacity       = get_field( 'overlay_opacity' );

// Default overlay opacity to 50 when not set.
if ( $overlay_opacity === '' || $overlay_opacity === null || $overlay_opacity === false ) {
	$overlay_opacity = 50;
}

$overlay_opacity = max( 0, min( 100, (int) $overlay_opacity ) );

// ---------------------------------------------------------------------------
// Block wrapper attributes
// ---------------------------------------------------------------------------

$block_id      = 'block-' . esc_attr( $block['id'] );
$extra_classes = isset( $block['className'] ) ? ' ' . esc_attr( $block['className'] ) : '';
$align_class   = isset( $block['align'] ) ? ' align' . esc_attr( $block['align'] ) : '';

// Build inline background image style.
$bg_image_style = '';
if ( ! empty( $background_image ) ) {
	$image_url = is_array( $background_image )
		? esc_url( $background_image['url'] )
		: esc_url( wp_get_attachment_url( (int) $background_image ) );

	if ( $image_url ) {
		$bg_image_style = ' style="background-image: url(\'' . $image_url . '\');"';
	}
}

// Translate the opacity integer (0–100) to a Tailwind-compatible decimal for
// inline styles, since arbitrary opacity values can't be tree-shaken.
$overlay_decimal = number_format( $overlay_opacity / 100, 2 );

// Show a placeholder message inside the editor when no content has been added.
$is_empty = empty( $heading ) && empty( $subheading );

?>
<section
	id="<?php echo $block_id; ?>"
	class="sg-hero relative flex items-center justify-center min-h-[85vh] overflow-hidden bg-gray-900 text-white<?php echo $extra_classes . $align_class; ?>"
	<?php echo $bg_image_style; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- already escaped above ?>
	aria-label="<?php esc_attr_e( 'Hero section', 'startgreen' ); ?>"
>

	<?php if ( ! empty( $bg_image_style ) ) : ?>
		<!-- Background image cover layer -->
		<div class="absolute inset-0 bg-cover bg-center bg-no-repeat pointer-events-none" aria-hidden="true"></div>
	<?php endif; ?>

	<!-- Colour overlay with configurable opacity -->
	<div
		class="absolute inset-0 bg-gray-900 pointer-events-none"
		style="opacity: <?php echo esc_attr( $overlay_decimal ); ?>;"
		aria-hidden="true"
	></div>

	<!-- Decorative green accent lines -->
	<div class="absolute top-0 left-0 w-1 h-full bg-gradient-to-b from-green-500 to-transparent opacity-60 pointer-events-none" aria-hidden="true"></div>
	<div class="absolute bottom-0 right-0 w-64 h-64 rounded-full bg-green-700 opacity-10 translate-x-1/2 translate-y-1/2 pointer-events-none" aria-hidden="true"></div>
	<div class="absolute top-8 right-16 w-32 h-32 rounded-full bg-green-400 opacity-10 pointer-events-none" aria-hidden="true"></div>

	<!-- Content -->
	<div class="relative z-10 container-custom section-padding text-center">

		<?php if ( $is_empty && $is_preview ) : ?>
			<!-- Editor placeholder -->
			<div class="flex flex-col items-center justify-center gap-4 py-24 opacity-60">
				<svg class="w-16 h-16 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
					<path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
				</svg>
				<p class="text-white text-lg font-medium">
					<?php esc_html_e( 'Hero Block — click to add content in the sidebar.', 'startgreen' ); ?>
				</p>
			</div>
		<?php else : ?>

			<div class="max-w-4xl mx-auto">

				<?php if ( ! empty( $heading ) ) : ?>
					<h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold leading-tight text-balance mb-6 animate-fade-in">
						<?php echo wp_kses_post( $heading ); ?>
					</h1>
				<?php endif; ?>

				<?php if ( ! empty( $subheading ) ) : ?>
					<p class="text-lg sm:text-xl text-gray-200 leading-relaxed max-w-2xl mx-auto mb-10 animate-fade-in" style="animation-delay: 0.1s;">
						<?php echo wp_kses_post( $subheading ); ?>
					</p>
				<?php endif; ?>

				<?php if ( ! empty( $primary_button_text ) || ! empty( $secondary_button_text ) ) : ?>
					<div class="flex flex-col sm:flex-row items-center justify-center gap-4 animate-fade-in" style="animation-delay: 0.2s;">

						<?php if ( ! empty( $primary_button_text ) ) : ?>
							<a
								href="<?php echo esc_url( $primary_button_url ?: '#' ); ?>"
								class="btn-primary text-base px-8 py-4 shadow-lg shadow-green-900/30"
							>
								<?php echo esc_html( $primary_button_text ); ?>
								<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" aria-hidden="true">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
								</svg>
							</a>
						<?php endif; ?>

						<?php if ( ! empty( $secondary_button_text ) ) : ?>
							<a
								href="<?php echo esc_url( $secondary_button_url ?: '#' ); ?>"
								class="inline-flex items-center justify-center gap-2 px-8 py-4 border-2 border-white/70 text-white font-semibold text-base rounded-lg hover:bg-white/10 hover:border-white transition-colors duration-200 no-underline"
							>
								<?php echo esc_html( $secondary_button_text ); ?>
							</a>
						<?php endif; ?>

					</div>
				<?php endif; ?>

			</div>

		<?php endif; ?>

	</div>

	<!-- Scroll indicator -->
	<?php if ( ! $is_preview ) : ?>
		<div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-1 text-white/50 text-xs pointer-events-none" aria-hidden="true">
			<span class="uppercase tracking-widest text-[10px]"><?php esc_html_e( 'Scroll', 'startgreen' ); ?></span>
			<svg class="w-5 h-5 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
				<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
			</svg>
		</div>
	<?php endif; ?>

</section>
