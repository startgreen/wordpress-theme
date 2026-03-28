(() => {
    var el                = wp.element.createElement;
    var registerBlockType = wp.blocks.registerBlockType;
    var InnerBlocks       = wp.blockEditor.InnerBlocks;
    var useBlockProps     = wp.blockEditor.useBlockProps;
    var InspectorControls = wp.blockEditor.InspectorControls;
    var PanelBody         = wp.components.PanelBody;
    var SelectControl     = wp.components.SelectControl;
    var TextControl       = wp.components.TextControl;
    var TextareaControl   = wp.components.TextareaControl;

    var ALLOWED_BLOCKS = [
        'acf/hero',
        'acf/two-columns',
        'acf/faq',
        'acf/form',
        'core/heading',
        'core/paragraph',
    ];

    var BG_OPTIONS = [
        { label: 'Lichtgroen',  value: 'green',      hex: '#3ecc9d' },
        { label: 'Donkergroen', value: 'dark-green',  hex: '#1a4a3a' },
    ];

    // Zelfde schema als section.php — kleuren auto per achtergrond
    var SCHEMES = {
        'green':      { h1: '#ffffff', h2: '#113223', intro: '#ffffff', slot1: '#ffffff', slot2: '#0f3f34' },
        'dark-green': { h1: '#ffffff', h2: '#3ecc9d', intro: '#ffffff', slot1: '#ffffff', slot2: '#3ecc9d' },
    };

    function getBgHex(value) {
        var match = BG_OPTIONS.find((o) => o.value === value);
        return match ? match.hex : '#ffffff';
    }

    registerBlockType('startgreen/section', {
        edit: (props) => {
            var a  = props.attributes;
            var set = props.setAttributes;
            var c  = SCHEMES[a.backgroundColor] || SCHEMES['green'];

            var blockProps = useBlockProps({
                style: { backgroundColor: getBgHex(a.backgroundColor), padding: '2rem' },
            });

            return el('section', blockProps,

                // ── Sidebar ──────────────────────────────────────────────
                el(InspectorControls, null,

                    el(PanelBody, { title: 'Achtergrond', initialOpen: true },
                        el(SelectControl, {
                            label:    'Achtergrondkleur',
                            value:    a.backgroundColor,
                            options:  BG_OPTIONS.map((o) => ({ label: o.label, value: o.value })),
                            onChange: (v) => set({ backgroundColor: v }),
                        })
                    ),

                    el(PanelBody, { title: 'Heading', initialOpen: false },
                        el(TextControl, {
                            label:       'Regel 1 — italic',
                            value:       a.headingRegel1,
                            placeholder: 'bijv. Professioneel ingericht,',
                            onChange:    (v) => set({ headingRegel1: v }),
                        }),
                        el(TextControl, {
                            label:       'Regel 2 — bold',
                            value:       a.headingRegel2,
                            placeholder: 'bijv. Onafhankelijk gestuurd',
                            onChange:    (v) => set({ headingRegel2: v }),
                        }),
                        el('p', { style: { fontSize: '11px', color: '#757575', marginTop: '4px' } },
                            'Kleuren passen automatisch aan op de achtergrondkleur.')
                    ),

                    el(PanelBody, { title: 'Intro tekst', initialOpen: false },
                        el(TextareaControl, {
                            label:    'Intro (alinea\'s via dubbele enter)',
                            value:    a.introTekst,
                            rows:     5,
                            onChange: (v) => set({ introTekst: v }),
                        })
                    ),

                    el(PanelBody, { title: 'Slotzin (optioneel)', initialOpen: false },
                        el(TextControl, {
                            label:       'Deel 1 — bold',
                            value:       a.slotzinDeel1,
                            placeholder: 'bijv. Deze manier van werken...',
                            onChange:    (v) => set({ slotzinDeel1: v }),
                        }),
                        el(TextControl, {
                            label:       'Deel 2 — italic',
                            value:       a.slotzinDeel2,
                            placeholder: 'bijv. ...waarin financieringsvormen versterken.',
                            onChange:    (v) => set({ slotzinDeel2: v }),
                        })
                    )
                ),

                // ── Preview: heading ──────────────────────────────────────
                (a.headingRegel1 || a.headingRegel2) && el('div', { style: { marginBottom: '1.5rem' } },
                    a.headingRegel1 && el('p', {
                        style: { fontFamily: 'Georgia, serif', fontStyle: 'italic', fontSize: '1.75rem', color: c.h1, marginBottom: '0.2rem', fontWeight: '300' }
                    }, a.headingRegel1),
                    a.headingRegel2 && el('p', {
                        style: { fontWeight: '700', fontSize: '2.25rem', color: c.h2, lineHeight: '1.2' }
                    }, a.headingRegel2)
                ),

                // ── Preview: intro ────────────────────────────────────────
                a.introTekst && el('p', {
                    style: { color: c.intro, marginBottom: '1.5rem', fontSize: '1rem', maxWidth: '560px' }
                }, a.introTekst),

                // ── InnerBlocks ───────────────────────────────────────────
                el(InnerBlocks, { allowedBlocks: ALLOWED_BLOCKS }),

                // ── Preview: slotzin ──────────────────────────────────────
                (a.slotzinDeel1 || a.slotzinDeel2) && el('p', {
                    style: { marginTop: '2rem', fontSize: '1.1rem', lineHeight: '1.6' }
                },
                    a.slotzinDeel1 && el('strong', { style: { color: c.slot1 } }, a.slotzinDeel1 + ' '),
                    a.slotzinDeel2 && el('em', { style: { fontFamily: 'Georgia, serif', fontStyle: 'italic', color: c.slot2 } }, a.slotzinDeel2)
                )
            );
        },

        save: () => el(InnerBlocks.Content, null),
    });
})();
