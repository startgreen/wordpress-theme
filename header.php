<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
    tailwind.config = {
        theme: {
            extend: {
                colors: {
                    'sg-brand-green':  'var(--sg-brand-green)',
                    'sg-dark-green':   'var(--sg-dark-green)',
                    'sg-medium-green': 'var(--sg-medium-green)',
                    'sg-light-green':  'var(--sg-light-green)',
                    'sg-light-grey':   'var(--sg-light-grey)',
                },
                fontFamily: {
                    sans:  ['var(--font-sans)'],
                    serif: ['var(--font-serif)'],
                },
            },
        },
    }
    </script>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header class="absolute top-16 left-0 right-0 z-50">
    <nav class="max-w-7xl mx-auto px-6 md:px-12 flex items-center justify-between bg-white/10 backdrop-blur-sm rounded-3xl py-2">

        <!-- Logo -->
        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="flex items-center gap-2 no-underline">
            <?php if ( has_custom_logo() ) : ?>
                <?php the_custom_logo(); ?>
            <?php else : ?>
                <span class="text-sm font-semibold">
                    <span style="color: #3ecc9d;">startgreen</span>
                    <span class="text-white">capital</span>
                </span>
            <?php endif; ?>
        </a>

        <!-- Main menu (menu name: "Main") -->
        <?php wp_nav_menu( [
            'theme_location' => 'primary',
            'menu'           => 'Main',
            'container'      => false,
            'menu_class'     => 'flex items-center gap-1 list-none m-0 p-0',
            'walker'         => new SG_Nav_Walker(),
            'fallback_cb'    => false,
        ] ); ?>

    </nav>
</header>

<script>
// Dropdown toggle
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('[data-dropdown-toggle]').forEach(function (btn) {
        btn.addEventListener('click', function (e) {
            e.stopPropagation();
            var li = btn.closest('li');
            var isOpen = li.classList.contains('is-open');
            document.querySelectorAll('li.is-open').forEach(function (el) {
                el.classList.remove('is-open');
            });
            if (!isOpen) li.classList.add('is-open');
        });
    });
    document.addEventListener('click', function () {
        document.querySelectorAll('li.is-open').forEach(function (el) {
            el.classList.remove('is-open');
        });
    });
});
</script>
