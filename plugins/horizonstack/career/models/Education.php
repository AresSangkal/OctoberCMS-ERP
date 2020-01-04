<?php namespace Horizonstack\Career\Models;

use Model;

/**
 * Model
 */
class Education extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'horizonstack_career_application_educations';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title'       => 'required',
        'start_date'  => 'required',
        'finish_date' => 'required',
        'location'    => 'required',
    ];

    public $fillable = [
        'title',
        'start_date',
        'finish_date',
        'location',
        'application_id',
        'description',
    ];
}
