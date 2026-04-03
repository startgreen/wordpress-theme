<?php
/**
 * Block: CTA Verder Bouwen
 * Fields: cta_verder_heading_bold, cta_verder_heading_italic, cta_verder_tekst,
 *         cta_verder_button_1_tekst, cta_verder_button_1_url,
 *         cta_verder_button_2_tekst, cta_verder_button_2_url,
 *         cta_verder_achtergrond (image)
 */

$heading_bold   = trim(get_field('cta_verder_heading_bold') ?? '');
$heading_italic = trim(get_field('cta_verder_heading_italic') ?? '');
$tekst          = trim(get_field('cta_verder_tekst') ?? '');
$btn1_tekst     = trim(get_field('cta_verder_button_1_tekst') ?? '');
$btn1_url       = trim(get_field('cta_verder_button_1_url') ?? '');
$btn2_tekst     = trim(get_field('cta_verder_button_2_tekst') ?? '');
$btn2_url       = trim(get_field('cta_verder_button_2_url') ?? '');
$bg_image       = get_field('cta_verder_achtergrond');
$bg_url         = is_array($bg_image) ? esc_url($bg_image['url']) : '';

$bg_style = $bg_url
    ? "background-image: linear-gradient(rgba(30,80,55,0.72), rgba(30,80,55,0.72)), url('{$bg_url}'); background-size: cover; background-position: center;"
    : "background-color: var(--sg-medium-green);";
?>

<section class="cta-verder-block py-24 md:py-36" style="<?php echo $bg_style; ?>">
    <div class="max-w-[var(--max-width-site)] mx-auto px-6 md:px-12">

        <div class="flex flex-col items-center text-center max-w-2xl mx-auto">

            <!-- Heading -->
            <?php if ($heading_bold || $heading_italic) : ?>
                <h2 class="mb-6 leading-tight">
                    <?php if ($heading_bold) : ?>
                        <span class="block font-bold text-sg-dark-green"
                              style="font-size: var(--fs-heading);">
                            <?php echo esc_html($heading_bold); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($heading_italic) : ?>
                        <span class="block font-normal"
                              style="font-size: var(--fs-heading); font-family: var(--font-serif); font-style: italic; color: var(--sg-brand-green);">
                            <?php echo esc_html($heading_italic); ?>
                        </span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>

            <!-- Tekst -->
            <?php if ($tekst) : ?>
                <p class="mb-10 leading-relaxed" style="font-size: var(--fs-subheading); color: rgba(255,255,255,0.85);">
                    <?php echo esc_html($tekst); ?>
                </p>
            <?php endif; ?>

            <!-- Buttons -->
            <?php if ($btn1_tekst || $btn2_tekst) : ?>
                <div class="flex flex-wrap items-center justify-center gap-6">
                    <?php if ($btn1_tekst) : ?>
                        <a href="<?php echo esc_url($btn1_url ?: '#'); ?>"
                           class="inline-flex items-center gap-2 px-7 py-3 rounded-full text-white text-sm font-medium transition-opacity hover:opacity-90"
                           style="background-color: #5c6cf5;">
                            → <?php echo esc_html($btn1_tekst); ?>
                        </a>
                    <?php endif; ?>
                    <?php if ($btn2_tekst) : ?>
                        <a href="<?php echo esc_url($btn2_url ?: '#'); ?>"
                           class="text-sm font-medium text-white hover:underline">
                            <?php echo esc_html($btn2_tekst); ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
