<?php
/**
 * Block: Stats
 * Fields: stats_heading_deel1, stats_heading_deel2, stats_intro,
 *         stats_button_tekst, stats_button_url,
 *         stats_items repeater (stats_item_getal, stats_item_omschrijving)
 */

$heading1   = trim(get_field('stats_heading_deel1') ?? '');
$heading2   = trim(get_field('stats_heading_deel2') ?? '');
$intro      = trim(get_field('stats_intro') ?? '');
$btn_tekst  = trim(get_field('stats_button_tekst') ?? '');
$btn_url    = trim(get_field('stats_button_url') ?? '');

// Checkerboard: positions 0,3 = dark card; positions 1,2 = light card
$card_colors = [
    'rgba(255,255,255,0.10)',  // 1 — dark
    'var(--sg-brand-green)',                  // 2 — light mint
    'var(--sg-brand-green)',                  // 3 — light mint
    'rgba(255,255,255,0.10)',  // 4 — dark
];
?>

<section class="stats-block py-16 md:py-24" style="background-color:var(--sg-dark-green);">
    <div class="max-w-7xl mx-auto px-6 md:px-12">

        <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16 items-center">

            <!-- Left: text -->
            <div>
                <?php if ($heading1 || $heading2) : ?>
                    <h2 class="mb-6 leading-tight">
                        <?php if ($heading1) : ?>
                            <span class="block font-bold text-white text-3xl md:text-4xl lg:text-5xl">
                                <?php echo esc_html($heading1); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($heading2) : ?>
                            <span class="block font-normal text-3xl md:text-4xl lg:text-5xl"
                                  style="font-family: var(--font-serif); font-style: italic; color: var(--sg-brand-green);">
                                <?php echo esc_html($heading2); ?>
                            </span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>

                <?php if ($intro) : ?>
                    <p class="text-sm md:text-base leading-relaxed mb-8 max-w-sm"
                       style="color: rgba(255,255,255,0.75);">
                        <?php echo esc_html($intro); ?>
                    </p>
                <?php endif; ?>

                <?php if ($btn_tekst) : ?>
                    <a href="<?php echo esc_url($btn_url ?: '#'); ?>"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-full text-white text-sm font-medium transition-opacity hover:opacity-90"
                       style="background-color:#5c6cf5;">
                        → <?php echo esc_html($btn_tekst); ?>
                    </a>
                <?php endif; ?>
            </div>

            <!-- Right: 2×2 stat grid -->
            <?php if (have_rows('stats_items')) : ?>
                <div class="grid grid-cols-2 gap-4">
                    <?php
                    $i = 0;
                    while (have_rows('stats_items')) : the_row();
                        $getal        = get_sub_field('stats_item_getal');
                        $omschrijving = get_sub_field('stats_item_omschrijving');
                        $bg           = $card_colors[$i % 4];
                    ?>
                        <div class="rounded-2xl p-6 flex flex-col justify-between min-h-[160px]"
                             style="background-color: <?php echo esc_attr($bg); ?>;">
                            <p class="text-3xl md:text-4xl font-light text-white leading-none">
                                <?php echo esc_html($getal); ?>
                            </p>
                            <p class="text-sm md:text-base leading-snug mt-4"
                               style="color: rgba(255,255,255,0.85);">
                                <?php echo esc_html($omschrijving); ?>
                            </p>
                        </div>
                    <?php
                        $i++;
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
