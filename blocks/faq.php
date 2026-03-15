<?php 
$title = get_sub_field('faq_heading');
?>

<section class="faq py-16 px-6 max-w-3xl mx-auto">
    <?php if ($title): ?>
        <h2 class="text-3xl font-bold mb-8"><?php echo esc_html($title); ?></h2>
    <?php endif; ?>

    <?php if (have_rows('faq_item')): ?>
        <div class="faq-list">
            <?php while (have_rows('faq_item')): the_row(); 
                $question = get_sub_field('faq_item_question');
                $answer = get_sub_field('faq_item_answer');
            ?>
                <div class="faq-item border-b border-gray-300 py-6">
                    <button type="button" class="faq-toggle w-full flex justify-between items-center text-left gap-4" aria-expanded="false">
                        <h3 class="text-lg font-semibold"><?php echo esc_html($question); ?></h3>
                        <span class="faq-icon w-8 h-8 flex-shrink-0 rounded-full border-2 border-current flex items-center justify-center transition-transform duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                    </button>
                    <div class="faq-answer grid grid-rows-[0fr] transition-[grid-template-rows] duration-300 ease-out">
                        <div class="overflow-hidden">
                            <div class="pt-4 prose prose-a:text-blue-600 prose-a:underline">
                                <?php echo $answer; ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
    <?php if (have_rows('faq_item')): ?>
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "FAQPage",
    "mainEntity": [
        <?php $first = true; while (have_rows('faq_item')): the_row(); ?>
        <?php if (!$first) echo ','; $first = false; ?>
        {
            "@type": "Question",
            "name": <?php echo json_encode(get_sub_field('faq_item_question')); ?>,
            "acceptedAnswer": {
                "@type": "Answer",
                "text": <?php echo json_encode(strip_tags(get_sub_field('faq_item_answer'))); ?>
            }
        }
        <?php endwhile; ?>
    ]
}
</script>
<?php endif; ?>
</section>

<style>
.faq-item.open .faq-answer {
    grid-template-rows: 1fr;
}
.faq-item.open .faq-icon {
    transform: rotate(45deg);
}
</style>

<script>
document.querySelectorAll('.faq-toggle').forEach(button => {
    button.addEventListener('click', () => {
        const item = button.closest('.faq-item');
        const isOpen = item.classList.contains('open');
        
        item.classList.toggle('open');
        button.setAttribute('aria-expanded', !isOpen);
    });
});
</script>