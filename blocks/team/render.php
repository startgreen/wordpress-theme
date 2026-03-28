<?php
/**
 * Block: Team
 * Queries the 'team' CPT and renders an interactive photo grid with inline expand.
 */

$block_id = 'team-grid-' . $block['id'];

$categories = get_terms([
    'taxonomy'   => 'team-category',
    'hide_empty' => true,
    'orderby'    => 'menu_order',
    'order'      => 'ASC',
]);

$members = get_posts([
    'post_type'      => 'team',
    'posts_per_page' => -1,
    'meta_key'       => 'team_volgorde',
    'orderby'        => 'meta_value_num',
    'order'          => 'ASC',
    'post_status'    => 'publish',
    'tax_query'      => [[
        'taxonomy' => 'team-category',
        'field'    => 'slug',
        'terms'    => 'team',
    ]],
]);

if (empty($members)) {
    if ($is_preview || is_admin()) {
        echo '<div style="padding:2rem;color:#666;background:#f9f9f9;border-radius:8px;">Nog geen teamleden toegevoegd.</div>';
    }
    return;
}
?>

<div class="team-block py-16" style="background-color:#f7f7f7;">
    <div class="max-w-5xl mx-auto px-6 md:px-12">

        <?php if (!empty($categories) && !is_wp_error($categories)) : ?>
            <nav class="team-filters flex flex-wrap gap-x-8 gap-y-2 mb-10 text-sm"
                 data-target="<?php echo esc_attr($block_id); ?>">
                <button class="team-filter active" data-cat="all">All</button>
                <?php foreach ($categories as $cat) : ?>
                    <button class="team-filter" data-cat="<?php echo esc_attr($cat->slug); ?>">
                        <?php echo esc_html($cat->name); ?>
                    </button>
                <?php endforeach; ?>
            </nav>
        <?php endif; ?>

        <div id="<?php echo esc_attr($block_id); ?>"
             class="team-grid grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-x-6 gap-y-10">
            <?php foreach ($members as $member) :
                $photo = get_the_post_thumbnail_url($member->ID, 'large');
                $name  = get_the_title($member->ID);
                $func  = get_field('team_functie', $member->ID);
                $terms = get_the_terms($member->ID, 'team-category');
                $cats  = (!empty($terms) && !is_wp_error($terms))
                         ? implode(' ', wp_list_pluck($terms, 'slug'))
                         : '';
            ?>
                <div class="team-card"
                     data-id="<?php echo esc_attr($member->ID); ?>"
                     data-cats="<?php echo esc_attr($cats); ?>">
                    <div class="team-card-photo overflow-hidden bg-gray-100 aspect-square" style="border-radius: var(--radius-card);">
                        <?php if ($photo) : ?>
                            <img src="<?php echo esc_url($photo); ?>"
                                 alt="<?php echo esc_attr($name); ?>"
                                 class="w-full h-full object-cover object-top">
                        <?php endif; ?>
                    </div>
                    <p class="mt-3 font-semibold leading-tight" style="color:#3ecc9d;"><?php echo esc_html($name); ?></p>
                    <p class="text-sm mt-0.5" style="color:#b6abab;"><?php echo esc_html($func); ?></p>
                </div>
            <?php endforeach; ?>
        </div>

    </div>
</div>

<!-- Expand data templates (outside grid, cloned into grid on click) -->
<?php foreach ($members as $member) :
    $photo    = get_the_post_thumbnail_url($member->ID, 'large');
    $name     = get_the_title($member->ID);
    $func     = get_field('team_functie', $member->ID);
    $bio      = get_field('team_omschrijving', $member->ID);
    $linkedin = get_field('team_linkedin', $member->ID);
    $first    = explode(' ', $name)[0];
?>
    <template id="team-expand-<?php echo esc_attr($member->ID); ?>">
        <div class="team-expand-inner" style="padding-bottom: 2rem;">
            <div class="grid grid-cols-1 md:grid-cols-2 overflow-hidden bg-white" style="border-radius: var(--radius-card); border: 1px solid #f0f0f0;">

                <!-- Left: bio + footer -->
                <div class="flex flex-col justify-between p-8 md:p-10">
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                        <?php echo wp_kses_post($bio); ?>
                    </div>
                    <div class="mt-8 flex items-end justify-between flex-wrap gap-4">
                        <div>
                            <p class="font-bold text-gray-900"><?php echo esc_html($name); ?></p>
                            <p class="text-sm text-gray-500"><?php echo esc_html($func); ?></p>
                        </div>
                        <?php if ($linkedin) : ?>
                            <div class="flex items-center gap-3 text-sm text-gray-500">
                                <span>volg <?php echo esc_html($first); ?></span>
                                <a href="<?php echo esc_url($linkedin); ?>"
                                   target="_blank" rel="noopener noreferrer"
                                   class="flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 transition-colors text-gray-600"
                                   aria-label="LinkedIn van <?php echo esc_attr($name); ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Right: large photo -->
                <?php if ($photo) : ?>
                    <div class="order-first md:order-last flex items-center p-4">
                        <img src="<?php echo esc_url($photo); ?>"
                             alt="<?php echo esc_attr($name); ?>"
                             class="w-full object-cover object-top"
                             style="border-radius: var(--radius-card);">
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </template>
<?php endforeach; ?>

<style>
/* Filter tabs */
.team-filter {
    color: #9ca3af;
    font-weight: 400;
    background: none;
    border: none;
    cursor: pointer;
    padding: 0;
    transition: color 0.15s;
}
.team-filter:hover { color: #374151; }
.team-filter.active { color: #111827; font-weight: 600; }

/* Cards */
.team-card {
    cursor: pointer;
}
.team-card-photo img {
    transition: transform 0.5s ease-out;
}
.team-card:hover .team-card-photo img {
    transform: scale(1.04);
}
.team-card[data-active] .team-card-photo {
    outline: 2px solid #3ecc9d;
    outline-offset: 2px;
    border-radius: var(--radius-card);
}

/* Expand panel */
.team-expand-panel {
    grid-column: 1 / -1;
    overflow: hidden;
    max-height: 0;
    transition: max-height 0.4s ease-out;
}
</style>
