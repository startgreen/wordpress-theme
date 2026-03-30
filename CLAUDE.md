# StartGreen Capital — Theme

WordPress theme for startgreen-capital. Custom ACF blocks + Tailwind CSS. No block.json — blocks are registered entirely through PHP + ACF.

## Build system

```bash
npm run dev     # Tailwind watch + BrowserSync proxy (acf-blokken-test.local)
npm run build   # One-off Tailwind compile
```

Tailwind reads all `.php` files (`tailwind.config.js` → `content: ["./**/*.php"]`), compiles `src/input.css` → `style.css`. The compiled `style.css` is the only stylesheet — it is enqueued on the frontend and inside the block editor.

The editor also loads Tailwind via CDN (`enqueue_block_assets`) so Tailwind classes work in the block preview iframe without a separate build step.

## File structure

```
startgreen/
├── blocks/              # One folder per block
│   └── big-stats/
│       └── render.php   # Block output template
├── acf-json/            # ACF field groups (auto-synced JSON)
├── src/
│   └── input.css        # Tailwind entry point (base/components/utilities)
├── style.css            # Compiled output — also holds design tokens in :root
├── tailwind.config.js   # Tailwind config — extend colours to match CSS vars
├── functions.php        # Block registration + theme setup
├── header.php / footer.php / page.php / index.php
└── theme.json
```

## Design tokens

Defined as CSS custom properties in `style.css` → `:root`. Always reference these in block templates via `style="color: var(--sg-brand-green)"` etc.

| Variable | Value | Use |
|---|---|---|
| `--sg-brand-green` | `#3ecc9d` | Primary accent, numbers, highlights |
| `--sg-dark-green` | `#113223` | Body text, headings |
| `--sg-medium-green` | `#1f7f63` | Secondary text |
| `--sg-light-green` | `#cff7ea` | Card/section backgrounds |
| `--sg-light-grey` | `#e0e4e3` | Separators, dividers |
| `--max-width-site` | `82rem` | Max content width (use on every block wrapper) |
| `--radius-card` | `1rem` | Card border radius |
| `--fs-heading` | `2.75rem` | Bold heading size |
| `--fs-heading-italic` | `2rem` | Italic heading size |
| `--fs-subheading` | `1.25rem` | Subheading size |

**`style.css` is the single source of truth for colour values.** `tailwind.config.js` and `theme.json` both reference the CSS variables (`var(--sg-brand-green)`) — never duplicate the hex value. When adding a new colour: add the hex once to `:root` in `style.css`, then add a `var()` reference in `tailwind.config.js` and `theme.json`.

## How blocks work

Blocks are **ACF Blocks** (Advanced Custom Fields). There is no `block.json`. Each block has two parts:

### 1. PHP registration — `functions.php`

Every block is registered inside the `acf/init` hook:

```php
acf_register_block_type([
    'name'            => 'block-slug',        // becomes acf/block-slug
    'title'           => 'Display Name',
    'description'     => 'Short description.',
    'render_template' => get_template_directory() . '/blocks/block-slug/render.php',
    'category'        => 'startgreen',        // always use 'startgreen'
    'icon'            => 'dashicons-slug',
    'keywords'        => ['keyword1', 'keyword2'],
    'mode'            => 'auto',              // 'auto' | 'preview' | 'edit'
    'supports'        => ['align' => false],
    'example'         => ['attributes' => ['mode' => 'preview', 'data' => [
        'field_name' => 'Preview value',      // optional editor preview data
    ]]],
]);
```

### 2. Render template — `blocks/{slug}/render.php`

Plain PHP template. Use ACF functions to read fields:

```php
$value = get_field('field_name');           // top-level field
// Inside have_rows() / the_row() loop:
$sub   = get_sub_field('sub_field_name');   // repeater sub-field
```

Standard block wrapper pattern:

```php
<section class="block-slug py-16 md:py-20" style="background-color: var(--sg-light-green);">
    <div class="max-w-[var(--max-width-site)] mx-auto px-6 md:px-12">
        <!-- content -->
    </div>
</section>
```

### 3. ACF field group — `acf-json/{group_name}.json`

Field groups are stored as JSON in `acf-json/` for version control. The `location` rule must match the block slug:

```json
"location": [[{ "param": "block", "operator": "==", "value": "acf/block-slug" }]]
```

ACF auto-syncs these files — editing fields in the WP admin writes back to `acf-json/`. When adding a block manually (like here), write the JSON directly; ACF will pick it up on next page load.

Field key naming convention: `field_{block_slug}_{field_name}` (e.g. `field_big_stats_item_getal`).

## Adding a new block (checklist)

1. Create `blocks/{slug}/render.php`
2. Create `acf-json/group_{slug}_block.json` with fields + location rule
3. Add `acf_register_block_type([...])` entry in `functions.php` inside the `acf/init` hook
4. Run `npm run build` (or `dev`) so any new Tailwind classes are compiled into `style.css`

## Existing blocks

| Slug | Title | Description |
|---|---|---|
| `hero` | Hero | Full-width hero with heading and subheading |
| `tekst` | Tekst | Two-column text with italic/bold heading |
| `stats` | Stats | Dark green section: text left, 2×2 stat cards right |
| `big-stats` | Big Stats | Full-width stat rows: big number left, description right |
| `impact` | Impact | Two-column heading/text + numbered cards grid |
| `cta-rows` | CTA Rows | Dark green section with clickable rows |
| `faq` | FAQ | Accordion FAQ (has own `faq.js`) |
| `team` | Team | Team member grid with inline expand (has own `team.js`) |
| `form` | Formulier | Gravity Forms embed |
| `contact` | Contact | Full-screen contact/newsletter section |

## Button style

Reuse this pattern for all CTA buttons across blocks:

```php
<a href="<?php echo esc_url($url ?: '#'); ?>"
   class="inline-flex items-center gap-2 px-7 py-3 rounded-full text-white text-sm font-medium transition-opacity hover:opacity-90"
   style="background-color: #5c6cf5;">
    → <?php echo esc_html($tekst); ?>
</a>
```
