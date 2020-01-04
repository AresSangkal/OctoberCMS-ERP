<?php namespace Horizonstack\Career\Models;

use Model;

/**
 * Model
 */
class Experience extends Model
{
    use \October\Rain\Database\Traits\Validation;
    

    /**
     * @var string The database table used by the model.
     */
    public $table = 'horizonstack_career_application_experiences';

    public $fillable = [
        'title',
        'start_date',
        'finish_date',
        'location',
        'application_id',
        'description',
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];
}
