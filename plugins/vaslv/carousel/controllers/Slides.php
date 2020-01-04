<?php namespace Vaslv\Carousel\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class Slides extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';

    public $requiredPermissions = [
        'vaslv.carousel.access_slides' 
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Vaslv.Carousel', 'carousel', 'slides');
    }
}
