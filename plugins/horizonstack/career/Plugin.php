<?php namespace Horizonstack\Career;

use Horizonstack\Career\Components\ApplicationForm;
use Horizonstack\Career\Components\ContactUs;
use Horizonstack\Career\Components\ListVacancies;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            ContactUs::class       => 'contactUs',
            ListVacancies::class   => 'listVacancies',
            ApplicationForm::class => 'applicationForm',
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'GCC settings',
                'description' => 'Credentials and other settings for GCC.',
                'category'    => 'horizonstack.career::lang.plugin.name',
                'icon'        => 'icon-map-o',
                'class'       => 'Horizonstack\Career\Models\Setting',
                'order'       => 600,
            ],
        ];
    }

    public function registerMailTemplates()
    {
        return [
            'horizonstack.career::mail.contact_admin',
            'horizonstack.career::mail.application_approved',
            'horizonstack.career::mail.application_submitted',
            'horizonstack.career::mail.application_rejected',
        ];
    }
}
