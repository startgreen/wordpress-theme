<?php
/**
 * Block: Hero
 * Fields: heading, intro, background_color
 */

$heading = get_field('hero_heading');
$intro   = get_field('hero_intro');
$bg      = get_field('hero_background_color');

$bg_color   = ($bg === 'black') ? '#000000' : '#ffffff';
$text_color = ($bg === 'black') ? '#ffffff' : '#000000';
?>

<section class="hero p-10 h-[50vh] flex flex-col justify-center items-center" style="background-color: <?php echo esc_attr($bg_color); ?>; color: <?php echo esc_attr($text_color); ?>">
    <?php if ($heading): ?>
        <h1 class="text-4xl font-bold mb-5"><?php echo esc_html($heading); ?></h1>
    <?php endif; ?>
    <?php if ($intro): ?>
        <p><?php echo esc_html($intro); ?></p>
    <?php endif; ?>
</section>
