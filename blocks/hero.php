<?php 
$heading = get_sub_field('heading');
$intro = get_sub_field('intro');
$bg = get_sub_field('background_color');

$classes = ($bg === 'black') ? 'bg-black text-white' : 'bg-white text-black';
?>

<section class="hero p-10 h-[50vh] flex flex-col justify-center items-center <?php echo esc_attr($classes); ?>">
    <h1 class="text-4xl font-bold mb-5"><?php echo esc_html($heading); ?></h1>
    <p class=""><?php echo esc_html($intro); ?></p>
</section>