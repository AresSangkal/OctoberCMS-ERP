<?php namespace Horizonstack\Career\Components;

use Carbon\Carbon;
use Cms\Classes\ComponentBase;
use Horizonstack\Career\Models\Application;
use Horizonstack\Career\Models\Language;
use Horizonstack\Career\Models\Skill;
use Horizonstack\Career\Models\Vacancy;
use Illuminate\Support\Facades\Redirect;
use Flash;
use ValidationException;
use Validator;
use Mail;

class ApplicationForm extends ComponentBase
{
    public $vacancy;

    public function componentDetails()
    {
        return [
            'name'        => 'Application Form',
            'description' => 'Render Vacancy details & Application form...',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function init()
    {
        $slug           = $this->param('slug');
        $job_app_number = $this->param('job-app-number');

        if (empty($slug) || empty($job_app_number)) {
            return Redirect::to('404');
        }

        $vacancy       = Vacancy::where('slug', $slug)->where('job_app_no', $job_app_number)->first();
        $this->vacancy = $vacancy;
    }

    public function onRun()
    {
        if (empty($this->vacancy)) {
            return Redirect::to('404');
        }

        $this->page['vacancy'] = $this->vacancy;

        $this->prepareVars();
    }

    public function prepareVars()
    {
        $languages               = Language::isActive()->orderBy('name')->get();
        $this->page['languages'] = $languages;

        $skills               = Skill::isActive()->orderBy('name')->get();
        $this->page['skills'] = $skills;
    }

    public function onSubmitApplication()
    {
        try {
            $data = post();

            $rules = [
                'first_name' => 'required',
                'last_name'  => 'required',
                'email'      => 'required',
                'mobile'     => 'required',
                'location'   => 'required',
                'nat_id'     => 'required',
            ];

            $messages = [
                'city_id.required'       => 'The city field is required.',
                'date_of_birth.required' => 'Please select date of birth.',
            ];

            $validation = Validator::make($data, $rules, $messages);
            if ($validation->fails()) {
                throw new ValidationException($validation);
            }

            $existingApplication = Application::where('nat_id', $data['nat_id'])->where('email',
                $data['email'])->where('vacancy_id', $this->vacancy->id)->first();

            if ( ! empty($existingApplication)) {
                throw new ValidationException(['nat_id' => 'You have already applied for the vacancy!']);
            }

            $data['vacancy_id'] = $this->vacancy->id;
            $data['admin_approval'] = 1;

            if ( ! empty($data['educations'])) {
                if (count($data['educations']) > 0) {
                    foreach ($data['educations'] as $key => $education) {
                        $rules = [
                            'educations.'.$key.'.title'       => 'required',
                            'educations.'.$key.'.location'    => 'required',
                            'educations.'.$key.'.start_date'  => 'required',
                            'educations.'.$key.'.finish_date' => 'required',
                        ];

                        $messages = [
                            'educations.'.$key.'.title.required'       => 'Title field is required for Education -'.($key + 1),
                            'educations.'.$key.'.location.required'    => 'Location field is required for Education -'.($key + 1),
                            'educations.'.$key.'.start_date.required'  => 'Start Date field is required for Education -'.($key + 1),
                            'educations.'.$key.'.finish_date.required' => 'Finish Date field is required for Education -'.($key + 1),
                        ];

                        $validation = Validator::make($data, $rules, $messages);
                        if ($validation->fails()) {
                            throw new ValidationException($validation);
                        }

                        $data['educations'][$key]['start_date']  = Carbon::createFromFormat('m/d/Y',
                            $education['start_date']);
                        $data['educations'][$key]['finish_date'] = Carbon::createFromFormat('m/d/Y',
                            $education['finish_date']);
                    }
                }
            }

            if ( ! empty($data['experiences'])) {
                if (count($data['experiences']) > 0) {
                    foreach ($data['experiences'] as $key => $experience) {
                        $rules = [
                            'experiences.'.$key.'.title'       => 'required',
                            'experiences.'.$key.'.location'    => 'required',
                            'experiences.'.$key.'.start_date'  => 'required',
                            'experiences.'.$key.'.finish_date' => 'required',
                        ];

                        $messages = [
                            'experiences.'.$key.'.title.required'       => 'Title field is required for Experience -'.($key + 1),
                            'experiences.'.$key.'.location.required'    => 'Location field is required for Experience -'.($key + 1),
                            'experiences.'.$key.'.start_date.required'  => 'Start Date field is required for Experience -'.($key + 1),
                            'experiences.'.$key.'.finish_date.required' => 'Finish Date field is required for Experience -'.($key + 1),
                        ];

                        $validation = Validator::make($data, $rules, $messages);
                        if ($validation->fails()) {
                            throw new ValidationException($validation);
                        }

                        $data['experiences'][$key]['start_date']  = Carbon::createFromFormat('m/d/Y',
                            $experience['start_date']);
                        $data['experiences'][$key]['finish_date'] = Carbon::createFromFormat('m/d/Y',
                            $experience['finish_date']);
                    }
                }
            }

            if ( ! empty($data['certifications'])) {
                if (count($data['certifications']) > 0) {
                    foreach ($data['certifications'] as $key => $experience) {
                        $rules = [
                            'certifications.'.$key.'.title'          => 'required',
                            'certifications.'.$key.'.certified_from' => 'required',
                            'certifications.'.$key.'.year'           => 'required',
                        ];

                        $messages = [
                            'certifications.'.$key.'.title.required'          => 'Title field is required for Certification -'.($key + 1),
                            'certifications.'.$key.'.certified_from.required' => 'Certified From field is required for Certification -'.($key + 1),
                            'certifications.'.$key.'.year.required'           => 'Start Date field is required for Certification -'.($key + 1),
                        ];

                        $validation = Validator::make($data, $rules, $messages);
                        if ($validation->fails()) {
                            throw new ValidationException($validation);
                        }
                    }
                }
            }

            $application = new Application();
            $application->fill($data);
            $application->save(null, post('_session_key'));


            if ( ! empty($data['educations'])) {
                if (count($data['educations']) > 0) {
                    $educations = $data['educations'];
                    $application->educations()->createMany($educations);
                }
            }

            if ( ! empty($data['experiences'])) {
                if (count($data['experiences']) > 0) {
                    $experiences = $data['experiences'];
                    $application->experiences()->createMany($experiences);
                }
            }

            if ( ! empty($data['certifications'])) {
                if (count($data['certifications']) > 0) {
                    $certifications = $data['certifications'];
                    $application->certifications()->createMany($certifications);
                }
            }

            if ( ! empty($data['languages'])) {
                if (count($data['languages']) > 0) {
                    $languages = $data['languages'];
                    $application->languages()->sync($languages);
                }
            }

            if ( ! empty($data['skills'])) {
                if (count($data['skills']) > 0) {
                    $allSkills = [];
                    foreach ($data['skills'] as $skill) {
                        if (is_numeric($skill)) {
                            $allSkills[] = $skill;
                        } else {
                            $newSkill = new Skill();
                            $newSkill->fill(['name' => $skill]);
                            $newSkill->save();

                            $allSkills[] = $newSkill->id;
                        }
                    }

                    $application->skills()->sync($allSkills);
                }
            }

            $emailData = [
                'applicant' => $application,
                'vacancy'   => $this->vacancy,
            ];


            if ( ! empty($application->email)) {
                Mail::send('horizonstack.career::mail.application_submitted', $emailData,
                    function ($message) use ($application) {
                        $message->to($application->email);
                    });
            }

            Flash::success("Application submitted Successfully.");

            return Redirect::to('career');

        } catch (\Exception $exception) {
            if (\Illuminate\Support\Facades\Request::ajax()) {
                throw $exception;
            } else {
                Flash::error($exception->getMessage());
            }
        }
    }
}
