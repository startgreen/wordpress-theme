<?php
/**
 * Block: Section
 *
 * $attributes  – block attributes (via block.json render)
 * $content     – gerenderde HTML van InnerBlocks
 */

$bg = $attributes['backgroundColor'] ?? 'white';

$bg_map = [
    'green'      => '#3ecc9d',
    'dark-green' => '#1a4a3a',
];
$bg_hex = $bg_map[$bg] ?? '#3ecc9d';

// Kleurenschema per achtergrond — alles automatisch, geen handmatige keuze nodig
$scheme = [
    'green' => [
        'h1'    => '#ffffff',
        'h2'    => '#113223',
        'intro' => '#ffffff',
        'slot1' => '#ffffff',
        'slot2' => '#0f3f34',
    ],
    'dark-green' => [
        'h1'    => '#ffffff',
        'h2'    => '#3ecc9d',
        'intro' => '#ffffff',
        'slot1' => '#ffffff',
        'slot2' => '#3ecc9d',
    ],
];
$c = $scheme[$bg] ?? $scheme['green'];

$heading1  = trim($attributes['headingRegel1'] ?? '');
$heading2  = trim($attributes['headingRegel2'] ?? '');
$intro_raw = trim($attributes['introTekst'] ?? '');
$slot1     = trim($attributes['slotzinDeel1'] ?? '');
$slot2     = trim($attributes['slotzinDeel2'] ?? '');
?>

<section
    class="section-block py-16"
    style="background-color: <?php echo esc_attr($bg_hex); ?>;"
>
    <div class="max-w-5xl mx-auto px-6 md:px-12">

        <?php if ($heading1 || $heading2) : ?>
            <div class="mb-10">
                <?php if ($heading1) : ?>
                    <p class="text-2xl md:text-3xl lg:text-4xl font-light leading-snug mb-1"
                       style="font-family: Georgia, 'Times New Roman', serif; font-style: italic; color: <?php echo esc_attr($c['h1']); ?>">
                        <?php echo esc_html($heading1); ?>
                    </p>
                <?php endif; ?>
                <?php if ($heading2) : ?>
                    <p class="text-3xl md:text-4xl lg:text-5xl font-bold leading-tight"
                       style="color: <?php echo esc_attr($c['h2']); ?>">
                        <?php echo esc_html($heading2); ?>
                    </p>
                <?php endif; ?>
            </div>
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

        <?php echo $content; ?>

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
