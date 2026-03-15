<?php 
$heading = get_sub_field('heading');
$image = get_sub_field('image');
$content = get_sub_field('content');
$image_position = get_sub_field('location_photo');

$classes_section = ($image_position === 'left') ? 'md:flex-row-reverse' : 'md:flex-row';
$classes_columns = ($image_position === 'left') ? 'justify-end' : 'justify-start';
?>

<section class="<?php echo esc_attr($classes_section); ?> p-20 flex flex-col-reverse justify-center items-start gap-8">
    <div class="w-full md:w-1/2">
        <h1 class="text-4xl font-bold mb-5"><?php echo esc_html($heading); ?></h1>
        <p class=""><?php echo esc_html($content); ?></p>
    </div>
    <div class="w-full md:w-1/2 flex <?php echo esc_attr($classes_columns); ?> items-center">
        <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($heading); ?>">
    </div>
</section>