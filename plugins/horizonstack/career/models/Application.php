<?php namespace Horizonstack\Career\Models;

use Model;

/**
 * Model
 */
class Application extends Model
{
    use \October\Rain\Database\Traits\Validation;

    const APPLICATION_APPROVED = 2;
    const APPLICATION_REJECTED = 3;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'horizonstack_career_applications';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'first_name' => 'required',
        'nat_id'     => 'required',
        'email'      => 'required|email',
        'mobile'     => 'required',
        'location'   => 'required',
    ];

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'mobile',
        'location',
        'nat_id',
        'vacancy_id',
        'linkedin_link',
        'admin_approval',
    ];

    public $hasMany = [
        'educations'     => Education::class,
        'experiences'    => Experience::class,
        'certifications' => Certification::class,
    ];

    public $belongsTo = [
        'vacancy' => [Vacancy::class],
    ];

    public $belongsToMany = [
        'languages' => [Language::class, 'table' => 'horizonstack_career_application_language'],
        'skills'    => [Skill::class, 'table' => 'horizonstack_career_application_skill'],
    ];
}
