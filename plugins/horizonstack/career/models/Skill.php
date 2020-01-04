<?php namespace Horizonstack\Career\Models;

use Model;
use October\Rain\Database\Traits\Sluggable;

/**
 * Model
 */
class Skill extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use Sluggable;

    protected $slugs = ['slug' => 'name'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'horizonstack_career_skills';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'name' => 'required',
    ];

    public $fillable = [
        'name',
        'slug',
    ];

    public function scopeIsActive($query)
    {
        return $query->where('is_active', true);
    }
}
