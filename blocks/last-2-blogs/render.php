<?php
/**
 * Block: Last 2 Blogs
 * Haalt automatisch de 2 meest recente gepubliceerde posts op.
 * Geen ACF-velden — alles is dynamisch vanuit WordPress.
 */

$posts = get_posts([
    'numberposts' => 2,
    'post_status' => 'publish',
    'orderby'     => 'date',
    'order'       => 'DESC',
]);

if (empty($posts)) {
    return;
}
?>

<section class="last-2-blogs-block py-16 md:py-24" style="background-color: #f2f3f1;">
    <div class="max-w-[var(--max-width-site)] mx-auto px-6 md:px-12">

        <!-- Heading + intro -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 md:gap-16 mb-14">
            <div>
                <h2 class="leading-tight mb-0">
                    <span class="block font-bold"
                          style="font-size: var(--fs-heading); color: var(--sg-brand-green);">
                        Wat onze experts
                    </span>
                    <span class="block font-normal"
                          style="font-size: var(--fs-heading); font-family: var(--font-serif); font-style: italic; color: var(--sg-dark-green);">
                        bezighoudt
                    </span>
                </h2>
            </div>
            <div class="flex items-center">
                <p class="leading-relaxed" style="font-size: var(--fs-body); color: var(--sg-dark-green);">
                    StartGreen investeert niet alleen in transities, maar volgt ook hoe nieuwe markten ontstaan. In onze blogs delen onze experts inzichten over investeringskansen, financieringsstructuren en marktontwikkelingen binnen de energie- en circulaire transitie.
                </p>
            </div>
        </div>

        <!-- Post cards -->
        <div class="flex flex-col gap-6">
            <?php foreach ($posts as $i => $post) :
                $image_id  = get_post_thumbnail_id($post->ID);
                $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'large') : '';
                $date      = strtoupper(get_the_date('j F Y', $post));
                $title     = get_the_title($post);
                $excerpt   = get_the_excerpt($post) ?: wp_trim_words(get_the_content('', false, $post), 30);
                $url       = get_permalink($post->ID);
                $img_right = ($i % 2 !== 0);
            ?>
                <div class="grid grid-cols-1 md:grid-cols-2 rounded-2xl overflow-hidden bg-white">

                    <!-- Image -->
                    <div class="<?php echo $img_right ? 'md:order-last' : ''; ?> relative min-h-[300px] md:min-h-0">
                        <?php if ($image_url) : ?>
                            <img src="<?php echo esc_url($image_url); ?>"
                                 alt="<?php echo esc_attr($title); ?>"
                                 class="absolute inset-0 w-full h-full object-cover">
                        <?php else : ?>
                            <div class="absolute inset-0 w-full h-full"
                                 style="background-color: var(--sg-light-green);"></div>
                        <?php endif; ?>
                    </div>

                    <!-- Content -->
                    <div class="flex flex-col justify-center p-10 md:p-14">
                        <p class="text-xs font-semibold tracking-widest mb-4"
                           style="color: var(--sg-brand-green);">
                            <?php echo esc_html($date); ?>
                        </p>
                        <h3 class="font-bold mb-4 leading-snug"
                            style="font-size: 1.6rem; color: var(--sg-dark-green);">
                            <?php echo esc_html($title); ?>
                        </h3>
                        <p class="mb-8 leading-relaxed text-sm md:text-base"
                           style="color: var(--sg-dark-green);">
                            <?php echo esc_html($excerpt); ?>
                        </p>
                        <div>
                            <a href="<?php echo esc_url($url); ?>"
                               class="inline-flex items-center px-5 py-2 rounded-full text-sm font-medium transition-colors hover:opacity-80"
                               style="background-color: var(--sg-light-green); color: var(--sg-dark-green);">
                                Lees meer
                            </a>
                        </div>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
