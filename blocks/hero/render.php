<?php
/**
 * Block: Hero
 * Fields: hero_subheading, hero_heading_part1, hero_heading_part2, hero_intro,
 *         hero_button1_text, hero_button1_link, hero_button2_text, hero_button2_link
 */

$subheading = get_field('hero_subheading');
$heading1   = get_field('hero_heading_part1');
$heading2   = get_field('hero_heading_part2');
$intro      = get_field('hero_intro');
$btn1_text  = get_field('hero_button1_text');
$btn1_link  = get_field('hero_button1_link');
$btn2_text  = get_field('hero_button2_text');
$btn2_link  = get_field('hero_button2_link');

$aria_label = trim(($heading1 ?? '') . ' ' . ($heading2 ?? '')) ?: 'Hero sectie';
?>

<section
    class="relative flex flex-col min-h-screen overflow-hidden"
    style="background: radial-gradient(ellipse 55% 75% at 88% 45%, #4d8a6e 0%, transparent 65%), #2e5446;"
    aria-label="<?php echo esc_attr($aria_label); ?>"
>
    <!-- Main content -->
    <div class="relative z-10 flex-1 flex flex-col justify-center max-w-7xl mx-auto w-full px-6 md:px-12 pt-28 pb-12">

        <?php if ($subheading) : ?>
            <p class="text-white/60 text-xs tracking-[0.18em] uppercase font-medium mb-8">
                <?php echo esc_html($subheading); ?>
            </p>
        <?php endif; ?>

        <h1 class="mb-8 leading-none">
            <?php if ($heading1) : ?>
                <span class="block text-white text-5xl md:text-6xl lg:text-[4.5rem] font-bold leading-tight">
                    <?php echo esc_html($heading1); ?>
                </span>
            <?php endif; ?>
            <?php if ($heading2) : ?>
                <em class="block text-[#7ecfa0] text-5xl md:text-6xl lg:text-[4.5rem] font-normal leading-tight not-italic"
                    style="font-family: Georgia, 'Times New Roman', serif; font-style: italic;">
                    <?php echo esc_html($heading2); ?>
                </em>
            <?php endif; ?>
        </h1>

        <?php if ($intro) : ?>
            <p class="text-white/80 text-base md:text-lg leading-relaxed max-w-[560px] mb-12">
                <?php echo esc_html($intro); ?>
            </p>
        <?php endif; ?>

        <?php if ($btn1_text || $btn2_text) : ?>
            <div class="flex flex-wrap items-center gap-4" role="group" aria-label="Navigatie">
                <?php if ($btn1_text) : ?>
                    <a
                        href="<?php echo $btn1_link ? esc_url($btn1_link) : '#'; ?>"
                        class="inline-flex items-center px-7 py-3.5 rounded-full text-sm font-medium text-white transition-opacity hover:opacity-90 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2 focus:ring-offset-transparent"
                        style="background-color: #5c6cf5;"
                    >
                        <?php echo esc_html($btn1_text); ?>
                    </a>
                <?php endif; ?>
                <?php if ($btn2_text) : ?>
                    <a
                        href="<?php echo $btn2_link ? esc_url($btn2_link) : '#'; ?>"
                        class="inline-flex items-center px-4 py-3.5 rounded-full text-sm font-medium text-white transition-opacity hover:opacity-70 focus:outline-none focus:ring-2 focus:ring-white/60 focus:ring-offset-2"
                    >
                        <?php echo esc_html($btn2_text); ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <!-- Statistics -->
    <div class="relative z-10 max-w-7xl mx-auto w-full px-6 md:px-12 pb-16">
        <hr class="border-white/20 mb-10" aria-hidden="true">
        <dl class="grid grid-cols-1 sm:grid-cols-3 gap-8">

            <div>
                <dd class="text-white text-3xl md:text-4xl font-bold mb-1">
                    €670<span class="text-[#7ecfa0]" aria-hidden="true">M</span>
                    <span style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0">miljoen</span>
                </dd>
                <dt class="text-white/60 text-sm">Beheerd vermogen</dt>
            </div>

            <div>
                <dd class="text-white text-3xl md:text-4xl font-bold mb-1">
                    250<span class="text-[#7ecfa0]" aria-hidden="true">+</span>
                    <span style="position:absolute;width:1px;height:1px;padding:0;margin:-1px;overflow:hidden;clip:rect(0,0,0,0);white-space:nowrap;border:0">of meer</span>
                </dd>
                <dt class="text-white/60 text-sm">Gefinancierde projecten</dt>
            </div>

            <div>
                <dd class="text-white text-3xl md:text-4xl font-bold mb-1">
                    <span class="text-[#7ecfa0]">20</span> jaar
                </dd>
                <dt class="text-white/60 text-sm">Succesvol investeren</dt>
            </div>

        </dl>
    </div>

</section>
