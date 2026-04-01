<?php
/**
 * Block: Three Blocks
 * Fields: three_blocks_heading_bold, three_blocks_heading_italic, three_blocks_intro,
 *         three_blocks_block_{1|2|3}_subheading, three_blocks_block_{1|2|3}_tekst,
 *         three_blocks_block_{1|2|3}_button_tekst, three_blocks_block_{1|2|3}_button_url
 */

$heading_bold   = trim(get_field('three_blocks_heading_bold') ?? '');
$heading_italic = trim(get_field('three_blocks_heading_italic') ?? '');
$intro          = trim(get_field('three_blocks_intro') ?? '');

$cards = [
    1 => ['bg' => 'var(--sg-dark-green)'],
    2 => ['bg' => 'var(--sg-brand-green)'],
    3 => ['bg' => '#2a6b52'],
];

foreach ($cards as $n => &$card) {
    $card['subheading']   = trim(get_field("three_blocks_block_{$n}_subheading") ?? '');
    $card['tekst']        = trim(get_field("three_blocks_block_{$n}_tekst") ?? '');
    $card['button_tekst'] = trim(get_field("three_blocks_block_{$n}_button_tekst") ?? '');
    $card['button_url']   = trim(get_field("three_blocks_block_{$n}_button_url") ?? '');
}
unset($card);
?>

<section class="three-blocks-block py-16 md:py-24" style="background-color: #f2f3f1;">
    <div class="max-w-[var(--max-width-site)] mx-auto px-6 md:px-12">

        <!-- Top: heading left, intro right -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 mb-16">

            <div>
                <?php if ($heading_bold || $heading_italic) : ?>
                    <h2 class="leading-tight mb-0">
                        <?php if ($heading_bold) : ?>
                            <span class="block font-bold"
                                  style="font-size: var(--fs-heading); color: var(--sg-dark-green);">
                                <?php echo esc_html($heading_bold); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($heading_italic) : ?>
                            <span class="block font-normal"
                                  style="font-size: var(--fs-heading); font-family: Georgia, 'Times New Roman', serif; font-style: italic; color: var(--sg-brand-green);">
                                <?php echo esc_html($heading_italic); ?>
                            </span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>
            </div>

            <div class="flex items-center">
                <?php if ($intro) : ?>
                    <p class="leading-relaxed" style="font-size: var(--fs-subheading); color: var(--sg-dark-green);">
                        <?php echo esc_html($intro); ?>
                    </p>
                <?php endif; ?>
            </div>

        </div>

        <!-- Three cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
            <?php foreach ($cards as $n => $card) : ?>
                <div class="flex flex-col p-8 rounded-[var(--radius-card)]"
                     style="background-color: <?php echo esc_attr($card['bg']); ?>;">

                    <!-- Number -->
                    <div>
                        <p class="text-sm font-light mb-6" style="color: rgba(255,255,255,0.6);">
                            <?php echo sprintf('%02d', $n); ?>
                        </p>

                        <!-- Subheading -->
                        <?php if ($card['subheading']) : ?>
                            <h3 class="font-bold mb-4 leading-snug"
                                style="font-size: 1.35rem; color: #ffffff;">
                                <?php echo esc_html($card['subheading']); ?>
                            </h3>
                        <?php endif; ?>

                        <!-- Text -->
                        <?php if ($card['tekst']) : ?>
                            <p class="text-sm md:text-base leading-relaxed" style="color: rgba(255,255,255,0.85);">
                                <?php echo esc_html($card['tekst']); ?>
                            </p>
                        <?php endif; ?>
                    </div>

                    <!-- Button -->
                    <?php if ($card['button_tekst']) : ?>
                        <div class="mt-6">
                            <a href="<?php echo esc_url($card['button_url'] ?: '#'); ?>"
                               class="inline-flex items-center px-6 py-3 rounded-full text-white text-sm font-medium transition-opacity hover:opacity-90"
                               style="background-color: #5c6cf5;">
                                <?php echo esc_html($card['button_tekst']); ?>
                            </a>
                        </div>
                    <?php endif; ?>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
