<?php
/**
 * Block: Impact
 * Fields: impact_heading_italic, impact_heading_bold, impact_subheading,
 *         impact_tekst (wysiwyg), impact_items repeater (impact_item_tekst),
 *         impact_button_tekst, impact_button_url
 */

$italic     = trim(get_field('impact_heading_italic') ?? '');
$bold       = trim(get_field('impact_heading_bold') ?? '');
$subheading = trim(get_field('impact_subheading') ?? '');
$tekst      = get_field('impact_tekst');
$btn_tekst  = trim(get_field('impact_button_tekst') ?? '');
$btn_url    = trim(get_field('impact_button_url') ?? '');
?>

<section class="impact-block py-16 md:py-20" style="background-color:#f7f7f7;">
    <div class="max-w-7xl mx-auto px-6 md:px-12">

        <!-- Top: heading left, text right -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 mb-12">

            <!-- Left: heading -->
            <div>
                <?php if ($italic || $bold) : ?>
                    <h2 class="leading-tight mb-0">
                        <?php if ($italic) : ?>
                            <span class="block font-normal leading-snug mb-1"
                                  style="font-size: var(--fs-heading-italic); font-family: var(--font-serif); font-style: italic; color: var(--sg-brand-green);">
                                <?php echo esc_html($italic); ?>
                            </span>
                        <?php endif; ?>
                        <?php if ($bold) : ?>
                            <span class="block font-bold leading-tight"
                                  style="font-size: var(--fs-heading); color: var(--sg-dark-green);">
                                <?php echo esc_html($bold); ?>
                            </span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>
            </div>

            <!-- Right: subheading + wysiwyg -->
            <div>
                <?php if ($subheading) : ?>
                    <p class="mb-4 leading-snug" style="font-size: var(--fs-subheading); color: var(--sg-dark-green);">
                        <?php echo esc_html($subheading); ?>
                    </p>
                <?php endif; ?>
                <?php if ($tekst) : ?>
                    <div class="prose prose-sm max-w-none leading-relaxed" style="color: var(--sg-dark-green);">
                        <?php echo wp_kses_post($tekst); ?>
                    </div>
                <?php endif; ?>
            </div>

        </div>

        <!-- Cards -->
        <?php if (have_rows('impact_items')) : ?>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <?php
                $i = 1;
                while (have_rows('impact_items')) : the_row();
                    $item_tekst = get_sub_field('impact_item_tekst');
                ?>
                    <div class="rounded-xl p-6 flex flex-col justify-between min-h-[160px]"
                         style="background-color: var(--sg-light-green);">
                        <p class="text-sm font-light" style="color: var(--sg-medium-green);">
                            <?php echo sprintf('%02d', $i); ?>
                        </p>
                        <p class="text-sm md:text-base leading-snug mt-4" style="color: var(--sg-dark-green);">
                            <?php echo esc_html($item_tekst); ?>
                        </p>
                    </div>
                <?php
                    $i++;
                endwhile;
                ?>
            </div>
        <?php endif; ?>

        <!-- Button -->
        <?php if ($btn_tekst) : ?>
            <div class="flex justify-end">
                <a href="<?php echo esc_url($btn_url ?: '#'); ?>"
                   class="inline-flex items-center gap-2 px-7 py-3 rounded-full text-white text-sm font-medium transition-opacity hover:opacity-90"
                   style="background-color: #5c6cf5;">
                    → <?php echo esc_html($btn_tekst); ?>
                </a>
            </div>
        <?php endif; ?>

    </div>
</section>
