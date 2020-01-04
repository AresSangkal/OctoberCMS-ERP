<?php namespace Horizonstack\Career\Models;

use Model;
use October\Rain\Database\Traits\Sortable;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Sortable;

    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = [
        'name',
        ['slug', 'index' => true],
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'horizonstack_career_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
    ];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}
