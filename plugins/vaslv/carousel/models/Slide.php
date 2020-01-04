<?php namespace Vaslv\Carousel\Models;

use Model;

/**
 * Model
 */
class Slide extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $belongsTo = [
        'carousel' => [
            'Vaslv\Carousel\Models\Carousel',
            'table' => 'vaslv_carousel_carousels',
        ]
    ];
    
    /**
     * @var array Validation rules
     */
    public $rules = [
        'carousel_id' => 'required',
        'image' => 'required|image',
        'weight' => 'required|integer',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'vaslv_carousel_slides';

    public $attachOne = [
        'image' => 'System\Models\File'
    ];

    public function getThumbAttribute()
    {
        return $this->image ? $this->image->getThumb(320, 115) : null;
    }

    public function getImagePathAttribute()
    {
        if (!$this->image) return null;

        if ($this->carousel->do_resize && class_exists('\ToughDeveloper\ImageResizer\Classes\Image')) {
            $image = new \ToughDeveloper\ImageResizer\Classes\Image($this->image->getPath());
            $image->resize($this->carousel->image_width, $this->carousel->image_height, ['mode' => 'crop']);

            return $image;
        } else {
            return $this->image->getPath();
        }
    }
}
