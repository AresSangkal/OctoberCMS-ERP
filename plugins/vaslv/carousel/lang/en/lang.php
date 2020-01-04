<?php return [
    'plugin' => [
        'name' => 'Bootstrap 4 Carousel',
        'description' => 'The easiest way to use a Carousel to your site with Bootstrap 4.',
    ],
    'menu' => [
        'carousel' => [
            'label' => 'Carousel',
            'side_menu' => [
                'carousels' => [
                    'label' => 'Carousels',
                ],
                'slides' => [
                    'label' => 'Slides',
                ],
            ],
        ],
    ],
    'permissions' => [
        'tab' => 'Carousel',
        'access_carousels' => 'Access carousels',
        'access_slides' => 'Access slides',
    ],
    'models' => [
        'carousel' => [
            'name' => 'Carousel',
            'fields' => [
                'name' => [
                    'label' => 'Name',
                ],
                'do_resize' => [
                    'label' => 'Resize images',
                    'comment' => 'For resize use the plugin ToughDeveloper.ImageResizer, it needs to be installed.',
                ],
                'image_width' => [
                    'label' => 'Image width',
                    'comment' => 'If defined, the image will be cropped in width.',
                ],
                'image_height' => [
                    'label' => 'Image height',
                    'comment' => 'If defined, the image will be cropped in height.',
                ],
                'interval' => [
                    'label' => 'Interval',
                    'comment' => 'The amount of time to delay between automatically cycling an item.',
                ],
                'with_controls' => [
                    'label' => 'With controls',
                    'comment' => 'Adding in the previous and next controls.',
                ],
                'with_indicators' => [
                    'label' => 'With indicators',
                    'comment' => 'Add the indicators to the carousel.',
                ],
                'has_keyboard_react' => [
                    'label' => 'Keyboard',
                    'comment' => 'Whether the carousel should react to keyboard events.',
                ],
                'has_hover_pause' => [
                    'label' => 'Pause',
                    'comment' => 'Pauses the cycling of the carousel on hover.',
                ],
                'has_autoplays' => [
                    'label' => 'Ride',
                    'comment' => 'Autoplays the carousel on load.',
                ],
                'has_continuously_cycle' => [
                    'label' => 'Wrap',
                    'comment' => 'Whether the carousel should cycle continuously.',
                ],
                'created_at' => [
                    'label' => 'Created',
                ],
                'updated_at' => [
                    'label' => 'Updated',
                ],
            ],
        ],
        'slide' => [
            'name' => 'Slide',
            'fields' => [
                'image' => [
                    'label' => 'Image',
                ],
                'carousel' => [
                    'label' => 'Carousel',
                ],
                'caption' => [
                    'label' => 'Caption',
                ],
                'description' => [
                    'label' => 'Description',
                ],
                'url' => [
                    'label' => 'URL',
                    'comment' => 'If defined, the slide will be a link.',
                ],
                'weight' => [
                    'label' => 'Slide weight',
                    'comment' => 'Weight for sorting slides.',
                ],
                'created_at' => [
                    'label' => 'Created',
                ],
                'updated_at' => [
                    'label' => 'Updated',
                ],
            ],
        ],
    ],
    'components' => [
        'carousel' => [
            'name' => 'Carousel',
            'description' => 'Display carousel on the page.',
            'properties' => [
                'carousel' => [
                    'title' => 'Carousel',
                    'description' => 'Name of the carousel to display.',
                ],
            ],
        ],
    ],
];