<?php
/**
 * Block: Twee Kolommen
 * Fields: two_columns_heading, two_columns_image (URL), two_columns_content, two_columns_location_photo (left/right)
 */

$heading        = get_field('two_columns_heading');
$image          = get_field('two_columns_image');
$content        = get_field('two_columns_content');
$image_position = get_field('two_columns_location_photo');

$text_div = '<div class="w-full md:w-1/2">
    ' . ($heading ? '<h2 class="text-4xl font-bold mb-5">' . esc_html($heading) . '</h2>' : '') . '
    ' . ($content ? '<p>' . esc_html($content) . '</p>' : '') . '
</div>';

$image_div = '<div class="w-full md:w-1/2">
    ' . ($image ? '<img src="' . esc_url($image) . '" alt="' . esc_attr($heading) . '">' : '') . '
</div>';
?>

<section class="p-20 flex flex-col md:flex-row justify-center items-center gap-8">
    <?php if ($image_position === 'left'): ?>
        <?php echo $image_div; ?>
        <?php echo $text_div; ?>
    <?php else: ?>
        <?php echo $text_div; ?>
        <?php echo $image_div; ?>
    <?php endif; ?>
</section>
