<?php get_header(); ?>

<?php if (have_rows('page_blocks')): ?>
    <?php while (have_rows('page_blocks')): the_row(); ?>
        <?php get_template_part('blocks/' . get_row_layout()); ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>