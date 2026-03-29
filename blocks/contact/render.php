<?php
/**
 * Block: Contact
 * Fully hardcoded — no ACF fields needed.
 * Gravity Form ID: 2
 */
?>

<section class="contact-block relative overflow-hidden flex flex-col justify-end"
         style="min-height: 100vh; background-color: var(--sg-medium-green);">

    <!-- Background image (optional: set via CSS or upload to /blocks/contact/) -->
    <div class="absolute inset-0 pointer-events-none" aria-hidden="true"
         style="background: linear-gradient(135deg, rgba(31,127,99,0.95) 0%, rgba(17,50,35,0.85) 100%);">
    </div>

    <div class="relative z-10 w-full max-w-7xl mx-auto px-6 md:px-12 pb-16 pt-32">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-10 items-end">

            <!-- Left: contact card -->
            <div class="rounded-2xl p-8" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(4px);">
                <p class="font-bold text-white text-lg mb-5">Contact</p>
                <div class="text-sm leading-relaxed mb-6" style="color: rgba(255,255,255,0.85);">
                    <p><a href="mailto:info@startgreen.nl" class="hover:underline text-white">info@startgreen.nl</a></p>
                    <p><a href="tel:+31205682060" class="hover:underline text-white">+31 (0)20 568 20 60</a></p>
                    <p class="mt-2">Mauritskade 64</p>
                    <p>1092 AD Amsterdam</p>
                </div>
                <div class="flex flex-col gap-1 text-sm" style="color: rgba(255,255,255,0.85);">
                    <a href="https://maps.google.com/?q=Mauritskade+64,+1092+AD+Amsterdam"
                       target="_blank" rel="noopener noreferrer"
                       class="underline hover:text-white transition-colors">Bekijk op de kaart</a>
                    <a href="https://maps.google.com/?q=Mauritskade+64,+1092+AD+Amsterdam"
                       target="_blank" rel="noopener noreferrer"
                       class="underline hover:text-white transition-colors">Route en parkeren</a>
                </div>
            </div>

            <!-- Right: newsletter form -->
            <div class="rounded-2xl p-8" style="background: rgba(255,255,255,0.12); backdrop-filter: blur(4px);">
                <h2 class="leading-tight mb-4">
                    <span class="block font-bold text-white"
                          style="font-size: var(--fs-heading);">
                        Schrijf u in voor
                    </span>
                    <span class="block font-normal"
                          style="font-size: var(--fs-heading); font-family: Georgia, 'Times New Roman', serif; font-style: italic; color: rgba(255,255,255,0.80);">
                        onze nieuwsbrief
                    </span>
                </h2>

                <p class="text-sm leading-relaxed mb-7" style="color: rgba(255,255,255,0.80);">
                    Wilt u als eerste op de hoogte zijn van nieuws uit onze fondsen en andere
                    belangrijke ontwikkelingen? Schrijf u dan in voor onze nieuwsbrief.
                    Deze versturen we eens per kwartaal.
                </p>

                <div class="contact-gform">
                    <?php
                    if (function_exists('gravity_form')) {
                        gravity_form(2, false, false, false, null, true);
                    } else {
                        echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]');
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>

<style>
/* ── Gravity Form overrides inside contact block ─────────────────────────── */
.contact-gform .gform_wrapper {
    margin: 0;
}
.contact-gform .gform_fields {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 0.75rem;
}
.contact-gform .gfield {
    margin: 0;
}
/* Full-width fields (email, checkbox, submit) */
.contact-gform .gfield--type-email,
.contact-gform .gfield--type-consent,
.contact-gform .gfield--type-checkbox,
.contact-gform .gfield_html,
.contact-gform .gform_footer {
    grid-column: 1 / -1;
}
/* Input styling */
.contact-gform input[type="text"],
.contact-gform input[type="email"] {
    width: 100%;
    background: rgba(255,255,255,0.92) !important;
    border: none !important;
    border-radius: 0.5rem !important;
    padding: 0.75rem 1rem !important;
    font-size: 0.9rem !important;
    color: #113223 !important;
    outline: none !important;
    box-shadow: none !important;
}
.contact-gform input[type="text"]::placeholder,
.contact-gform input[type="email"]::placeholder {
    color: #6b7280 !important;
}
.contact-gform input[type="text"]:focus,
.contact-gform input[type="email"]:focus {
    background: #ffffff !important;
}
/* Labels */
.contact-gform .gfield_label {
    display: none;
}
/* Submit button */
.contact-gform .gform_footer,
.contact-gform .gform_page_footer {
    margin: 0.75rem 0 0 0;
    padding: 0;
}
.contact-gform input[type="submit"],
.contact-gform button[type="submit"] {
    width: 100% !important;
    background-color: #5c6cf5 !important;
    color: #ffffff !important;
    border: none !important;
    border-radius: 9999px !important;
    padding: 0.85rem 2rem !important;
    font-size: 0.95rem !important;
    font-weight: 500 !important;
    cursor: pointer !important;
    transition: opacity 0.2s !important;
}
.contact-gform input[type="submit"]:hover,
.contact-gform button[type="submit"]:hover {
    opacity: 0.9 !important;
}
/* Checkbox */
.contact-gform .gfield--type-consent .gchoice,
.contact-gform .gfield--type-checkbox .gchoice {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}
.contact-gform .gfield--type-consent label,
.contact-gform .gfield--type-checkbox label {
    color: rgba(255,255,255,0.80) !important;
    font-size: 0.85rem !important;
}
.contact-gform .gfield_error input {
    border: 1px solid #f87171 !important;
}
.contact-gform .validation_message {
    color: #fca5a5 !important;
    font-size: 0.75rem !important;
    margin-top: 0.25rem !important;
}
.contact-gform .gform_confirmation_message {
    color: #ffffff;
    font-size: 1rem;
    padding: 1rem 0;
}
</style>
