<?php 
$form = get_sub_field('form');
?>

<section class="form-block py-16 px-6 max-w-2xl mx-auto">
    <?php 
    if ($form) {
        gravity_form($form['id'], true, true, false, null, true);
    }
    ?>
</section>