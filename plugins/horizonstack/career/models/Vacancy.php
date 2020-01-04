<?php namespace Horizonstack\Career\Models;

use Model;

/**
 * Model
 */
class Vacancy extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['RainLab.Translate.Behaviors.TranslatableModel'];

    public $translatable = [
        'title',
        ['slug', 'index' => true],
        'description',
    ];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'horizonstack_career_vacancies';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title'       => 'required',
        'category'    => 'required',
        'job_app_no'  => 'required|unique:horizonstack_career_vacancies',
        'date_posted' => 'required',
        'expiry_date' => 'required',
        'description' => 'required',
    ];

    public $belongsTo = [
        'category' => Category::class,
    ];

    /**
     * The attributes on which the post list can be ordered
     * @var array
     */
    public static $allowedSortingOptions = array(
        'title asc'       => 'Title (ascending)',
        'title desc'      => 'Title (descending)',
        'created_at asc'  => 'Created (ascending)',
        'created_at desc' => 'Created (descending)',
        'updated_at asc'  => 'Updated (ascending)',
        'updated_at desc' => 'Updated (descending)',
    );

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}
