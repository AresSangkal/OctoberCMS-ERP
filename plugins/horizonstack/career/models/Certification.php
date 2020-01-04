<?php namespace Horizonstack\Career\Models;

use Carbon\Carbon;
use Model;

/**
 * Model
 */
class Certification extends Model
{
    use \October\Rain\Database\Traits\Validation;


    /**
     * @var string The database table used by the model.
     */
    public $table = 'horizonstack_career_application_certifications';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title'          => 'required',
        'certified_from' => 'required',
        'year'           => 'required',
    ];

    public $fillable = [
        'title',
        'certified_from',
        'year',
        'application_id',
    ];

    public function getYearOptions()
    {
        $years = [];

        for ($n = 1901; $n <= Carbon::now()->year; $n++) {
            $years[$n] = $n;
        }

        return $years;
    }
}
