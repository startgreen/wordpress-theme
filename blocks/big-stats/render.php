<?php
/**
 * Block: Big Stats
 * Fields: big_stats_items repeater (big_stats_item_getal, big_stats_item_omschrijving),
 *         big_stats_button_tekst, big_stats_button_url
 */

$btn_tekst = trim(get_field('big_stats_button_tekst') ?? '');
$btn_url   = trim(get_field('big_stats_button_url') ?? '');
?>

<section class="big-stats-block py-16 md:py-20" style="background-color-white;">
    <div class="max-w-[var(--max-width-site)] mx-auto px-6 md:px-12">

        <?php if (have_rows('big_stats_items')) : ?>
            <div>
                <?php
                $first = true;
                while (have_rows('big_stats_items')) : the_row();
                    $getal        = get_sub_field('big_stats_item_getal');
                    $omschrijving = get_sub_field('big_stats_item_omschrijving');
                ?>
                    <?php if (!$first) : ?>
                        <hr style="border: none; border-top: 1px solid var(--sg-light-grey); margin: 0;">
                    <?php endif; ?>
                    <div class="flex items-center justify-between py-6 md:py-8">
                        <span class="font-bold leading-none"
                              style="font-size: clamp(2.5rem, 6vw, 4.5rem); color: var(--sg-brand-green);">
                            <?php echo esc_html($getal); ?>
                        </span>
                        <span class="text-right leading-snug"
                              style="font-size: clamp(1rem, 2vw, 1.5rem); color: var(--sg-dark-green); max-width: 60%;">
                            <?php echo esc_html($omschrijving); ?>
                        </span>
                    </div>
                <?php
                    $first = false;
                endwhile;
                ?>
            </div>
        <?php endif; ?>

        <?php if ($btn_tekst) : ?>
            <div class="flex justify-end mt-8">
                <a href="<?php echo esc_url($btn_url ?: '#'); ?>"
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-full text-white text-sm font-medium transition-opacity hover:opacity-90"
                   style="background-color: #5c6cf5;">
                    → <?php echo esc_html($btn_tekst); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>
