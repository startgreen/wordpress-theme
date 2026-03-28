(function () {
    'use strict';

    var PLUS  = '+';
    var MINUS = '\u2212'; // echte minteken (−), geen koppelteken

    function initFaqAccordions() {
        // :not([data-faq-init]) voorkomt dubbele event listeners
        // bij meerdere FAQ-blokken of herhaald inladen
        document.querySelectorAll('.faq-toggle:not([data-faq-init])').forEach(function (button) {
            button.setAttribute('data-faq-init', '1');

            button.addEventListener('click', function () {
                var item   = button.closest('.faq-item');
                var isOpen = item.classList.contains('open');

                item.classList.toggle('open');
                button.setAttribute('aria-expanded', String(!isOpen));

                var icon = item.querySelector('.faq-icon');
                if (icon) {
                    icon.textContent = isOpen ? PLUS : MINUS;
                }
            });
        });
    }

    // Init bij DOMContentLoaded of direct als DOM al geladen is
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initFaqAccordions);
    } else {
        initFaqAccordions();
    }
})();
