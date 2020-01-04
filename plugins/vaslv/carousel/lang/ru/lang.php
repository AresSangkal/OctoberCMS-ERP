<?php return [
    'plugin' => [
        'name' => 'Bootstrap 4 Carousel',
        'description' => 'Самый простой способ использовать слайдер для вашего сайта с Bootstrap 4.',
    ],
    'menu' => [
        'carousel' => [
            'label' => 'Слайдер',
            'side_menu' => [
                'carousels' => [
                    'label' => 'Слайдеры',
                ],
                'slides' => [
                    'label' => 'Слайды',
                ],
            ],
        ],
    ],
    'permissions' => [
        'tab' => 'Слайдер',
        'access_carousels' => 'Управление слайдерами',
        'access_slides' => 'Управление слайдами',
    ],
    'models' => [
        'carousel' => [
            'name' => 'Слайдер',
            'fields' => [
                'name' => [
                    'label' => 'Название',
                ],
                'do_resize' => [
                    'label' => 'Изменять размер изображений',
                    'comment' => 'Для изменения размера используется плагин ToughDeveloper.ImageResizer, его необходиму установить.',
                ],
                'image_width' => [
                    'label' => 'Ширина изображения',
                    'comment' => 'Если указано, изображение будет обрезано по ширине.',
                ],
                'image_height' => [
                    'label' => 'Высота изображения',
                    'comment' => 'Если указано, изображение будет обрезано по высоте.',
                ],
                'interval' => [
                    'label' => 'Интервал',
                    'comment' => 'Время задержки между автоматическим циклическим перемещением слайда.',
                ],
                'with_controls' => [
                    'label' => 'Элементы управления',
                    'comment' => 'Добавление переключателя предыдущего и следующего слайдов.',
                ],
                'with_indicators' => [
                    'label' => 'Индикаторы',
                    'comment' => 'Добавление индикаторов слайдов.',
                ],
                'has_keyboard_react' => [
                    'label' => 'Клавиатура',
                    'comment' => 'Должен ли слайдер реагировать на события клавиатуры.',
                ],
                'has_hover_pause' => [
                    'label' => 'Пауза',
                    'comment' => 'Приостановка цикла карусели при наведении курсора на слайдер.',
                ],
                'has_autoplays' => [
                    'label' => 'Автозапуск',
                    'comment' => 'Автозапуск слайдера при загрузке.',
                ],
                'has_continuously_cycle' => [
                    'label' => 'Зацикливать',
                    'comment' => 'Должен ли слайдер работать непрерывно.',
                ],
                'created_at' => [
                    'label' => 'Создано',
                ],
                'updated_at' => [
                    'label' => 'Обновлено',
                ],
            ],
        ],
        'slide' => [
            'name' => 'Слайд',
            'fields' => [
                'image' => [
                    'label' => 'Изображение',
                ],
                'carousel' => [
                    'label' => 'Слайдер',
                ],
                'caption' => [
                    'label' => 'Заголовок',
                ],
                'description' => [
                    'label' => 'Описание',
                ],
                'url' => [
                    'label' => 'URL',
                    'comment' => 'Если указано, слайд будет ссылкой.',
                ],
                'weight' => [
                    'label' => 'Вес слайда',
                    'comment' => 'Вес для сортировки слайдов.',
                ],
                'created_at' => [
                    'label' => 'Создано',
                ],
                'updated_at' => [
                    'label' => 'Обновлено',
                ],
            ],
        ],
    ],
    'components' => [
        'carousel' => [
            'name' => 'Слайдер',
            'description' => 'Отображение слайдера на странице.',
            'properties' => [
                'carousel' => [
                    'title' => 'Слайдер',
                    'description' => 'Название отображаемого слайдера.',
                ],
            ],
        ],
    ],
];