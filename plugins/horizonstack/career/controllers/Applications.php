<?php namespace Horizonstack\Career\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use Mail;
use Flash;
use Horizonstack\Career\Models\Application;

class Applications extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\RelationController',
        'Backend\Behaviors\ImportExportController',
    ];

    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $relationConfig = 'config_relation.yaml';
    public $importExportConfig = 'config_import_export.yaml';

    public $requiredPermissions = [
        'horizonstack.career.manage_applications',
    ];

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Horizonstack.Career', 'careers', 'applications');
    }

    public function onApproveApplication()
    {
        $applicationId             = post('applicationId');
        $applicant                 = Application::with('vacancy')->find($applicationId);
        $applicant->admin_approval = Application::APPLICATION_APPROVED;
        $applicant->save();

        if ( ! empty($applicant)) {
            $data = [
                'applicant' => $applicant,
                'vacancy'   => $applicant->vacancy,
            ];

            Mail::send(
                'horizonstack.career::mail.application_approved',
                $data,
                function ($message) use ($applicant) {
                    $message->to($applicant->email);
                }
            );

            Flash::success("Application approved.");
        }

        return $this->listRefresh();
    }

    public function onRejectedApplication()
    {
        $applicationId             = post('applicationId');
        $applicant                 = Application::with('vacancy')->find($applicationId);
        $applicant->admin_approval = Application::APPLICATION_REJECTED;
        $applicant->save();

        if ( ! empty($applicant)) {
            $data = [
                'applicant' => $applicant,
                'vacancy'   => $applicant->vacancy,
            ];

            Mail::send(
                'horizonstack.career::mail.application_rejected',
                $data,
                function ($message) use ($applicant) {
                    $message->to($applicant->email);
                }
            );

            Flash::success("Application rejected.");
        }

        return $this->listRefresh();
    }
}
