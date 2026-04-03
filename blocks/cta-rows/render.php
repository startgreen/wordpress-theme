<?php
/**
 * Block: CTA Rows
 * Fields: cta_heading_deel1, cta_heading_deel2, cta_items (repeater: label, tekst, url)
 */

$heading1 = trim(get_field('cta_heading_deel1') ?? '');
$heading2 = trim(get_field('cta_heading_deel2') ?? '');
?>

<section class="cta-rows-block relative overflow-hidden py-20 md:py-28" style="background-color:var(--sg-dark-green);">

    <!-- Decorative leaf (right side) -->
    <div class="absolute inset-y-0 right-0 w-1/2 pointer-events-none select-none" aria-hidden="true"
         style="opacity:0.25;">
        <svg viewBox="0 0 600 800" fill="none" xmlns="http://www.w3.org/2000/svg"
             class="absolute right-0 top-0 h-full w-auto" preserveAspectRatio="xMaxYMid meet">
            <path d="M580 0 C580 0 520 120 480 200 C420 320 380 360 320 440
                     C260 520 220 580 240 700 C250 760 280 800 280 800
                     C280 800 400 740 460 660 C520 580 560 500 570 400
                     C580 300 600 200 580 0 Z"
                  fill="var(--sg-brand-green)"/>
            <path d="M560 40 C560 40 400 100 340 200 C280 300 260 380 300 480
                     C320 530 360 560 360 560"
                  stroke="#2ebc8d" stroke-width="2" fill="none" opacity="0.5"/>
            <path d="M520 80 C480 140 420 200 380 300 C340 400 340 480 360 540"
                  stroke="#2ebc8d" stroke-width="1.5" fill="none" opacity="0.4"/>
        </svg>
    </div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12">

        <!-- Heading -->
        <?php if ($heading1 || $heading2) : ?>
            <h2 class="text-center mb-12 leading-tight">
                <?php if ($heading1) : ?>
                    <span class="block font-bold text-white text-4xl md:text-5xl">
                        <?php echo esc_html($heading1); ?>
                    </span>
                <?php endif; ?>
                <?php if ($heading2) : ?>
                    <span class="block font-normal text-4xl md:text-5xl mt-1"
                          style="font-family: var(--font-serif); font-style: italic; color: var(--sg-brand-green);">
                        <?php echo esc_html($heading2); ?>
                    </span>
                <?php endif; ?>
            </h2>
        <?php endif; ?>

        <!-- Rows -->
        <?php if (have_rows('cta_items')) : ?>
            <div class="max-w-2xl mx-auto flex flex-col gap-3">
                <?php while (have_rows('cta_items')) : the_row();
                    $label  = get_sub_field('cta_item_label');
                    $tekst  = get_sub_field('cta_item_tekst');
                    $link   = get_sub_field('cta_item_link');
                    $url    = is_array($link) ? ($link['url'] ?? '') : '';
                    $target = is_array($link) ? ($link['target'] ?: '_self') : '_self';
                    $tag    = $url ? 'a' : 'div';
                    $attrs  = $url ? 'href="' . esc_url($url) . '" target="' . esc_attr($target) . '"' : '';
                ?>
                    <<?php echo $tag; ?> <?php echo $attrs; ?>
                        class="cta-row flex items-center justify-between px-7 py-5 rounded-xl"
                        style="background: rgba(255,255,255,0.12);"
                        <?php if ($url) : ?>role="link"<?php endif; ?>>
                        <span class="font-bold text-white text-base md:text-lg">
                            <?php echo esc_html($label); ?>
                        </span>
                        <span class="text-sm md:text-base" style="color: rgba(255,255,255,0.65);">
                            <?php echo esc_html($tekst); ?>
                        </span>
                    </<?php echo $tag; ?>>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

    </div>
</section>

<style>
a.cta-row {
    text-decoration: none;
    transition: background 0.2s ease;
}
a.cta-row:hover {
    background: rgba(255,255,255,0.2) !important;
}
</style>
