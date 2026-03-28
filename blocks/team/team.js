(() => {
    'use strict';

    function initTeamGrids() {
        document.querySelectorAll('.team-grid').forEach(grid => {
            const gridId  = grid.id;
            let activeId  = null;

            // ── Shared expand panel (inserted as a grid child) ──────────────
            const panel = document.createElement('div');
            panel.className = 'team-expand-panel';

            // ── Filter tabs ─────────────────────────────────────────────────
            const filterBar = document.querySelector(`.team-filters[data-target="${gridId}"]`);
            if (filterBar) {
                filterBar.addEventListener('click', e => {
                    const btn = e.target.closest('.team-filter');
                    if (!btn) return;

                    filterBar.querySelectorAll('.team-filter').forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');

                    const cat = btn.dataset.cat;
                    grid.querySelectorAll('.team-card').forEach(card => {
                        const cats = card.dataset.cats ? card.dataset.cats.split(' ') : [];
                        card.style.display = (cat === 'all' || cats.includes(cat)) ? '' : 'none';
                    });

                    collapsePanel();
                });
            }

            // ── Helpers ─────────────────────────────────────────────────────
            function visibleCards() {
                return [...grid.querySelectorAll('.team-card')].filter(c => c.style.display !== 'none');
            }

            function rowEndCard(clickedCard) {
                const clickedTop = Math.round(clickedCard.getBoundingClientRect().top);
                const row = visibleCards().filter(
                    c => Math.abs(Math.round(c.getBoundingClientRect().top) - clickedTop) < 5
                );
                return row[row.length - 1] || clickedCard;
            }

            function collapsePanel() {
                // Animate from current height → 0
                panel.style.maxHeight = panel.offsetHeight + 'px';
                panel.offsetHeight; // force reflow
                panel.style.maxHeight = '0';

                grid.querySelectorAll('.team-card[data-active]').forEach(c => c.removeAttribute('data-active'));
                activeId = null;
            }

            function expandPanel(card) {
                const id  = card.dataset.id;
                const tpl = document.getElementById('team-expand-' + id);
                if (!tpl) return;

                // Mark card as active
                grid.querySelectorAll('.team-card[data-active]').forEach(c => c.removeAttribute('data-active'));
                card.setAttribute('data-active', '1');
                activeId = id;

                // Move panel after last card in the same visual row
                rowEndCard(card).after(panel);

                // Fill content
                panel.innerHTML = '';
                panel.appendChild(tpl.content.cloneNode(true));

                // Animate open: 0 → natural height
                panel.style.maxHeight = '0';
                panel.offsetHeight; // force reflow
                panel.style.maxHeight = '800px'; // larger than any panel

                // After animation, scroll into view
                panel.addEventListener('transitionend', () => {
                    panel.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                }, { once: true });
            }

            // ── Card click ──────────────────────────────────────────────────
            grid.addEventListener('click', e => {
                const card = e.target.closest('.team-card');
                if (!card) return;

                if (card.dataset.id === activeId) {
                    collapsePanel();
                } else {
                    expandPanel(card);
                }
            });
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initTeamGrids);
    } else {
        initTeamGrids();
    }
})();
