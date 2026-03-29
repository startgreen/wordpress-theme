<?php
/**
 * Block: FAQ
 * Fields: faq_achtergrond, faq_heading_deel1, faq_heading_deel2, faq_intro,
 *         faqs (repeater: faq_item_icon, faq_item_question, faq_item_answer),
 *         faq_slotzin_deel1, faq_slotzin_deel2
 */

// ── Achtergrond & kleurschema ──────────────────────────────────────────────
$bg = get_field('faq_achtergrond') ?: 'white';

$bg_map = [
    'green'      => 'var(--sg-brand-green)',
    'dark-green' => 'var(--sg-dark-green)',
];
$bg_hex = $bg_map[$bg] ?? 'var(--sg-brand-green)';

$scheme = [
    'green' => [
        'h1'    => '#ffffff',
        'h2'    => 'var(--sg-dark-green)',
        'intro' => '#ffffff',
        'slot1' => '#ffffff',
        'slot2' => 'var(--sg-dark-green)',
    ],
    'dark-green' => [
        'h1'    => '#ffffff',
        'h2'    => 'var(--sg-brand-green)',
        'intro' => '#ffffff',
        'slot1' => '#ffffff',
        'slot2' => 'var(--sg-brand-green)',
    ],
];
$c = $scheme[$bg] ?? $scheme['green'];

// ── Velden ─────────────────────────────────────────────────────────────────
$h_deel1   = get_field('faq_heading_deel1');
$h_deel2   = get_field('faq_heading_deel2');
$intro_raw = get_field('faq_intro');
$slot1     = get_field('faq_slotzin_deel1');
$slot2     = get_field('faq_slotzin_deel2');

// ── SVG iconen (Heroicons 2.0 outline) ────────────────────────────────────
$icons = [
    'diploma' => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5"/></svg>',
    'chart'    => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18 9 11.25l4.306 4.306a11.95 11.95 0 0 1 5.814-5.518l2.74-1.22m0 0-5.94-2.281m5.94 2.28-2.28 5.941"/></svg>',
    'handshake'=> '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 0 0 3.741-.479 3 3 0 0 0-4.682-2.72m.94 3.198.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0 1 12 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 0 1 6 18.719m12 0a5.971 5.971 0 0 0-.941-3.197m0 0A5.995 5.995 0 0 0 12 12.75a5.995 5.995 0 0 0-5.058 2.772m0 0a3 3 0 0 0-4.681 2.72 8.986 8.986 0 0 0 3.74.477m.94-3.197a5.971 5.971 0 0 0-.94 3.197M15 6.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm6 3a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Zm-13.5 0a2.25 2.25 0 1 1-4.5 0 2.25 2.25 0 0 1 4.5 0Z"/></svg>',
    'shield'   => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z"/></svg>',
    'bank'     => '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0 0 12 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75Z"/></svg>',
];
?>

<section
    class="faq-block"
    style="background-color: <?php echo esc_attr($bg_hex); ?>;"
>
    <div class="max-w-7xl mx-auto px-6 md:px-12 py-16">

        <?php if ($h_deel1 || $h_deel2) : ?>
            <h2 class="mb-10 leading-tight">
                <?php if ($h_deel1) : ?>
                    <span class="block font-normal text-2xl md:text-3xl lg:text-4xl leading-snug mb-1"
                          style="font-family: Georgia, 'Times New Roman', serif; font-style: italic; color: <?php echo esc_attr($c['h1']); ?>">
                        <?php echo esc_html($h_deel1); ?>
                    </span>
                <?php endif; ?>
                <?php if ($h_deel2) : ?>
                    <span class="block font-bold text-3xl md:text-4xl lg:text-5xl"
                          style="color: <?php echo esc_attr($c['h2']); ?>">
                        <?php echo esc_html($h_deel2); ?>
                    </span>
                <?php endif; ?>
            </h2>
        <?php endif; ?>

        <?php if ($intro_raw) : ?>
            <div class="mb-10 space-y-4 max-w-xl">
                <?php
                foreach (preg_split('/\n{2,}/', $intro_raw) as $alinea) {
                    $alinea = trim($alinea);
                    if ($alinea) {
                        echo '<p class="text-base md:text-lg leading-relaxed" style="color:' . esc_attr($c['intro']) . '">'
                            . esc_html(str_replace("\n", ' ', $alinea))
                            . '</p>';
                    }
                }
                ?>
            </div>
        <?php endif; ?>

        <?php if (have_rows('faqs')) : ?>
            <div class="faq-list space-y-3" role="list">
                <?php
                $idx = 0;
                while (have_rows('faqs')) :
                    the_row();
                    $icon_key = get_sub_field('faq_item_icon') ?: 'diploma';
                    $question = get_sub_field('faq_item_question');
                    $answer   = get_sub_field('faq_item_answer');
                    $svg      = $icons[$icon_key] ?? $icons['diploma'];
                    $answer_id = 'faq-answer-' . get_the_ID() . '-' . $idx;
                    $idx++;
                ?>
                    <div class="faq-item bg-white rounded-2xl shadow-sm" role="listitem">
                        <button
                            type="button"
                            class="faq-toggle w-full flex items-center gap-4 px-5 py-4 text-left rounded-2xl focus:outline-none focus-visible:ring-2 focus-visible:ring-indigo-400 focus-visible:ring-inset"
                            aria-expanded="false"
                            aria-controls="<?php echo esc_attr($answer_id); ?>"
                        >
                            <?php if ($icon_key !== 'none') : ?>
                                <span class="flex-shrink-0 w-10 h-10 rounded-lg flex items-center justify-center text-[#5c6cf5]"
                                      style="background-color: #eef2ff;">
                                    <?php echo $svg; ?>
                                </span>
                            <?php endif; ?>

                            <span class="flex-1 text-sm md:text-base font-medium text-gray-900">
                                <?php echo esc_html($question); ?>
                            </span>

                            <span class="faq-icon flex-shrink-0 text-xl font-light select-none w-6 text-center"
                                  style="color: #5c6cf5;"
                                  aria-hidden="true">+</span>
                        </button>

                        <div
                            id="<?php echo esc_attr($answer_id); ?>"
                            class="faq-answer grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-out"
                            role="region"
                        >
                            <div class="overflow-hidden">
                                <div class="px-5 pb-5 pt-1 <?php echo ($icon_key !== 'none') ? 'pl-[76px]' : ''; ?> text-gray-600 text-sm leading-relaxed prose prose-sm max-w-none prose-a:text-indigo-600">
                                    <?php echo wp_kses_post($answer); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>

        <?php if ($slot1 || $slot2) : ?>
            <div class="mt-12 max-w-2xl">
                <p class="text-lg md:text-xl leading-relaxed">
                    <?php if ($slot1) : ?>
                        <strong class="font-bold" style="color: <?php echo esc_attr($c['slot1']); ?>">
                            <?php echo esc_html($slot1); ?>
                        </strong>
                    <?php endif; ?>
                    <?php if ($slot2) : ?>
                        <em style="font-family: Georgia, serif; font-style: italic; color: <?php echo esc_attr($c['slot2']); ?>">
                            <?php echo esc_html($slot2); ?>
                        </em>
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>

    </div>
</section>

<?php
// JSON-LD schema
if (have_rows('faqs')) :
    $items = [];
    while (have_rows('faqs')) :
        the_row();
        $q = get_sub_field('faq_item_question');
        $a = get_sub_field('faq_item_answer');
        if ($q && $a) {
            $items[] = [
                '@type'          => 'Question',
                'name'           => $q,
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => wp_strip_all_tags($a)],
            ];
        }
    endwhile;
    if ($items) :
?>
<script type="application/ld+json">
<?php echo wp_json_encode(['@context' => 'https://schema.org', '@type' => 'FAQPage', 'mainEntity' => $items], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES); ?>
</script>
<?php
    endif;
endif;
?>

<style>
.faq-item.open .faq-answer { grid-template-rows: 1fr; }
</style>
