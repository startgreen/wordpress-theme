<?php
/**
 * Block: Tekst
 * Fields: tekst_achtergrond, tekst_heading_italic, tekst_heading_bold,
 *         tekst_subheading, tekst_body
 */

$bg = get_field('tekst_achtergrond') ?: 'white';

$scheme = [
    'white' => [
        'bg'     => '#ffffff',
        'italic' => 'var(--sg-brand-green)',
        'bold'   => 'var(--sg-dark-green)',
        'sub'    => 'var(--sg-dark-green)',
        'body'   => 'var(--sg-dark-green)',
    ],
    'dark-green' => [
        'bg'     => 'var(--sg-dark-green)',
        'italic' => 'var(--sg-brand-green)',
        'bold'   => '#ffffff',
        'sub'    => 'rgba(255,255,255,0.80)',
        'body'   => 'rgba(255,255,255,0.80)',
    ],
];

$c = $scheme[$bg] ?? $scheme['white'];

$italic     = trim(get_field('tekst_heading_italic') ?? '');
$bold       = trim(get_field('tekst_heading_bold') ?? '');
$subheading = trim(get_field('tekst_subheading') ?? '');
$body_raw   = trim(get_field('tekst_body') ?? '');
?>

<section class="tekst-block py-16 md:py-20"
         style="background-color: <?php echo esc_attr($c['bg']); ?>;">
    <div class="max-w-7xl mx-auto px-6 md:px-12">
        <div style="max-width: 50%;">

            <?php if ($italic || $bold) : ?>
                <h2 class="mb-6 leading-tight">
                    <?php if ($italic) : ?>
                        <span class="block mb-1"
                              style="font-size: var(--fs-heading-italic); font-family: var(--font-serif); font-style: italic; font-weight: 400; color: <?php echo esc_attr($c['italic']); ?>;">
                            <?php echo esc_html($italic); ?>
                        </span>
                    <?php endif; ?>
                    <?php if ($bold) : ?>
                        <span class="block font-bold"
                              style="font-size: var(--fs-heading); color: <?php echo esc_attr($c['bold']); ?>;">
                            <?php echo esc_html($bold); ?>
                        </span>
                    <?php endif; ?>
                </h2>
            <?php endif; ?>

            <?php if ($subheading) : ?>
                <p class="mb-4 leading-snug"
                   style="font-size: var(--fs-subheading); color: <?php echo esc_attr($c['sub']); ?>;">
                    <?php echo esc_html($subheading); ?>
                </p>
            <?php endif; ?>

            <?php if ($body_raw) : ?>
                <div class="space-y-4">
                    <?php foreach (preg_split('/\n{2,}/', $body_raw) as $alinea) :
                        $alinea = trim($alinea);
                        if (!$alinea) continue;
                    ?>
                        <p class="leading-relaxed"
                           style="font-size: var(--fs-body); color: <?php echo esc_attr($c['body']); ?>;">
                            <?php echo esc_html(str_replace("\n", ' ', $alinea)); ?>
                        </p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

        </div>
    </div>
</section>
