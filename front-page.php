<?php
/**
 * Front page template.
 *
 * WordPress uses this template for the static front page when one is set in
 * Settings > Reading.  It calls get_header() / get_footer() so the standard
 * site chrome wraps the block content rendered by the_content().
 *
 * @package StartGreen
 */

get_header();
?>

<main id="main" class="site-main">
	<?php while ( have_posts() ) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
