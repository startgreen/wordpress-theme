<?php
/**
 * Hero Block — ACF Field Group Registration
 *
 * Registers all custom fields for the startgreen/hero block via
 * acf_add_local_field_group().  This approach keeps field definitions
 * in version control alongside the block code rather than in the database.
 *
 * @package StartGreen
 */

if ( ! function_exists( 'acf_add_local_field_group' ) ) {
	return;
}

acf_add_local_field_group(
	[
		'key'                   => 'group_startgreen_hero',
		'title'                 => __( 'Hero Block Fields', 'startgreen' ),
		'fields'                => [

			// ---------------------------------------------------------------
			// Heading
			// ---------------------------------------------------------------
			[
				'key'           => 'field_hero_heading',
				'label'         => __( 'Heading', 'startgreen' ),
				'name'          => 'heading',
				'type'          => 'text',
				'instructions'  => __( 'The main headline displayed in the hero section.', 'startgreen' ),
				'required'      => 0,
				'placeholder'   => __( 'Invest in a Greener Future', 'startgreen' ),
				'maxlength'     => 120,
				'wrapper'       => [ 'width' => '100' ],
			],

			// ---------------------------------------------------------------
			// Subheading
			// ---------------------------------------------------------------
			[
				'key'           => 'field_hero_subheading',
				'label'         => __( 'Subheading', 'startgreen' ),
				'name'          => 'subheading',
				'type'          => 'textarea',
				'instructions'  => __( 'Supporting text displayed beneath the heading.', 'startgreen' ),
				'required'      => 0,
				'placeholder'   => __( 'A short, compelling sentence about your mission.', 'startgreen' ),
				'rows'          => 3,
				'maxlength'     => 300,
				'new_lines'     => '',
				'wrapper'       => [ 'width' => '100' ],
			],

			// ---------------------------------------------------------------
			// Background Image
			// ---------------------------------------------------------------
			[
				'key'           => 'field_hero_background_image',
				'label'         => __( 'Background Image', 'startgreen' ),
				'name'          => 'background_image',
				'type'          => 'image',
				'instructions'  => __( 'Recommended size: 1920×1080 px (16:9). The image will be covered by a dark overlay.', 'startgreen' ),
				'required'      => 0,
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'library'       => 'all',
				'wrapper'       => [ 'width' => '100' ],
			],

			// ---------------------------------------------------------------
			// Overlay Opacity
			// ---------------------------------------------------------------
			[
				'key'           => 'field_hero_overlay_opacity',
				'label'         => __( 'Overlay Opacity', 'startgreen' ),
				'name'          => 'overlay_opacity',
				'type'          => 'range',
				'instructions'  => __( 'Controls the darkness of the overlay on top of the background image. 0 = transparent, 100 = fully opaque.', 'startgreen' ),
				'required'      => 0,
				'default_value' => 50,
				'min'           => 0,
				'max'           => 100,
				'step'          => 5,
				'wrapper'       => [ 'width' => '100' ],
				'conditional_logic' => [
					[
						[
							'field'    => 'field_hero_background_image',
							'operator' => '!=empty',
						],
					],
				],
			],

			// ---------------------------------------------------------------
			// CTA Buttons (tab divider)
			// ---------------------------------------------------------------
			[
				'key'           => 'field_hero_tab_buttons',
				'label'         => __( 'CTA Buttons', 'startgreen' ),
				'name'          => '',
				'type'          => 'tab',
				'placement'     => 'top',
				'endpoint'      => 0,
			],

			// Primary Button — Text
			[
				'key'           => 'field_hero_primary_button_text',
				'label'         => __( 'Primary Button — Label', 'startgreen' ),
				'name'          => 'primary_button_text',
				'type'          => 'text',
				'instructions'  => __( 'Leave empty to hide the primary button.', 'startgreen' ),
				'required'      => 0,
				'placeholder'   => __( 'View Portfolio', 'startgreen' ),
				'maxlength'     => 60,
				'wrapper'       => [ 'width' => '50' ],
			],

			// Primary Button — URL
			[
				'key'           => 'field_hero_primary_button_url',
				'label'         => __( 'Primary Button — URL', 'startgreen' ),
				'name'          => 'primary_button_url',
				'type'          => 'url',
				'instructions'  => __( 'Full URL including https://', 'startgreen' ),
				'required'      => 0,
				'placeholder'   => 'https://startgreencapital.com/portfolio',
				'wrapper'       => [ 'width' => '50' ],
			],

			// Secondary Button — Text
			[
				'key'           => 'field_hero_secondary_button_text',
				'label'         => __( 'Secondary Button — Label', 'startgreen' ),
				'name'          => 'secondary_button_text',
				'type'          => 'text',
				'instructions'  => __( 'Leave empty to hide the secondary button.', 'startgreen' ),
				'required'      => 0,
				'placeholder'   => __( 'Learn More', 'startgreen' ),
				'maxlength'     => 60,
				'wrapper'       => [ 'width' => '50' ],
			],

			// Secondary Button — URL
			[
				'key'           => 'field_hero_secondary_button_url',
				'label'         => __( 'Secondary Button — URL', 'startgreen' ),
				'name'          => 'secondary_button_url',
				'type'          => 'url',
				'instructions'  => __( 'Full URL including https://', 'startgreen' ),
				'required'      => 0,
				'placeholder'   => 'https://startgreencapital.com/about',
				'wrapper'       => [ 'width' => '50' ],
			],

		],
		'location'              => [
			[
				[
					'param'    => 'block',
					'operator' => '==',
					'value'    => 'startgreen/hero',
				],
			],
		],
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen'        => '',
		'active'                => true,
		'description'           => __( 'Fields for the StartGreen Hero block.', 'startgreen' ),
	]
);
