<?php
/**
 * Block: Formulier
 * Fields: form (Gravity Forms object)
 */

$form_id = get_field('form_id');
?>

<section class="form-block py-16 px-6 max-w-2xl mx-auto">
    <?php if ($form_id && function_exists('gravity_form')): ?>
        <?php gravity_form($form_id, true, true, false, null, true); ?>
    <?php endif; ?>
</section>
