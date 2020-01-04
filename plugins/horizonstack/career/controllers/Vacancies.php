<?php namespace Horizonstack\Career\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Vacancies extends Controller
{
    public $implement = [        'Backend\Behaviors\ListController',        'Backend\Behaviors\FormController'    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'horizonstack.career.manage_vacancies' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Horizonstack.Career', 'careers', 'vacancies');
    }
}
