<?php namespace Vaslv\Carousel\Models;

use Model;

/**
 * Model
 */
class Carousel extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $hasMany = [
        'slides' => [
            'Vaslv\Carousel\Models\Slide',
            'table' => 'vaslv_carousel_slides',
        ]
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
        'image_width' => 'required|integer',
        'image_height' => 'required|integer',
        'interval' => 'required|integer|min:100',
        'with_controls' => 'boolean',
        'with_indicators' => 'boolean',
        'has_keyboard_react' => 'boolean',
        'has_hover_pause' => 'boolean',
        'has_autoplays' => 'boolean',
        'has_continuously_cycle' => 'boolean',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vaslv_carousel_carousels';
}
