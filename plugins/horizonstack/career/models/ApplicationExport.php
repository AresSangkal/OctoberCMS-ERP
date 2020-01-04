<?php namespace Horizonstack\Career\Models;

use Backend\Models\ExportModel;

class ApplicationExport extends ExportModel
{
    public function exportData($columns, $sessionKey = null)
    {
        $applications    = Application::with([
            'educations',
            'experiences',
            'certifications',
            'skills',
            'languages',
        ])->orderBy('created_at', 'desc')->get();
        $exportDataArray = [];

        foreach ($applications as $application) {
            $exportDataArray[] = [
                'first_name'                   => $application->first_name,
                'last_name'                    => $application->last_name,
                'nat_id'                       => $application->nat_id,
                'email'                        => $application->email,
                'mobile'                       => $application->mobile,
                'vacancy_title'                => ($application->vacancy) ? $application->vacancy->title : '',
                'location'                     => $application->location,
                'linkedin_link'                => $application->linkedin_link,
                'skill_set'                    => $this->getSkillSet($application),
                'languages_set'                => $this->getLanguagesSet($application),
                'education_title'              => null,
                'education_start_date'         => null,
                'education_finish_date'        => null,
                'education_location'           => null,
                'education_description'        => null,
                'experience_title'             => null,
                'experience_start_date'        => null,
                'experience_finish_date'       => null,
                'experience_location'          => null,
                'experience_description'       => null,
                'certification_title'          => null,
                'certification_certified_from' => null,
                'certification_year'           => null,
            ];

            if (count($application->educations) > 0) {
                foreach ($application->educations as $education) {
                    $exportDataArray[] = [
                        'first_name'                   => null,
                        'last_name'                    => null,
                        'nat_id'                       => null,
                        'email'                        => null,
                        'mobile'                       => null,
                        'vacancy_title'                => null,
                        'location'                     => null,
                        'linkedin_link'                => null,
                        'skill_set'                    => null,
                        'languages_set'                => null,
                        'education_title'              => $education->title,
                        'education_start_date'         => $education->start_date,
                        'education_finish_date'        => $education->finish_date,
                        'education_location'           => $education->location,
                        'education_description'        => $education->description,
                        'experience_title'             => null,
                        'experience_start_date'        => null,
                        'experience_finish_date'       => null,
                        'experience_location'          => null,
                        'experience_description'       => null,
                        'certification_title'          => null,
                        'certification_certified_from' => null,
                        'certification_year'           => null,
                    ];
                }
            }

            if (count($application->experiences) > 0) {
                foreach ($application->experiences as $experience) {
                    $exportDataArray[] = [
                        'first_name'                   => null,
                        'last_name'                    => null,
                        'nat_id'                       => null,
                        'email'                        => null,
                        'mobile'                       => null,
                        'vacancy_title'                => null,
                        'location'                     => null,
                        'linkedin_link'                => null,
                        'skill_set'                    => null,
                        'languages_set'                => null,
                        'education_title'              => null,
                        'education_start_date'         => null,
                        'education_finish_date'        => null,
                        'education_location'           => null,
                        'education_description'        => null,
                        'experience_title'             => $experience->title,
                        'experience_start_date'        => $experience->start_date,
                        'experience_finish_date'       => $experience->finish_date,
                        'experience_location'          => $experience->location,
                        'experience_description'       => $experience->description,
                        'certification_title'          => null,
                        'certification_certified_from' => null,
                        'certification_year'           => null,
                    ];
                }
            }

            if (count($application->certifications) > 0) {
                foreach ($application->certifications as $certification) {
                    $exportDataArray[] = [
                        'first_name'                   => null,
                        'last_name'                    => null,
                        'nat_id'                       => null,
                        'email'                        => null,
                        'mobile'                       => null,
                        'vacancy_title'                => null,
                        'location'                     => null,
                        'linkedin_link'                => null,
                        'skill_set'                    => null,
                        'languages_set'                => null,
                        'education_title'              => null,
                        'education_start_date'         => null,
                        'education_finish_date'        => null,
                        'education_location'           => null,
                        'education_description'        => null,
                        'experience_title'             => null,
                        'experience_start_date'        => null,
                        'experience_finish_date'       => null,
                        'experience_location'          => null,
                        'experience_description'       => null,
                        'certification_title'          => $certification->title,
                        'certification_certified_from' => $certification->certified_from,
                        'certification_year'           => $certification->year,
                    ];
                }
            }
        }

        return $exportDataArray;
    }

    public function getSkillSet($application)
    {
        $skills = [];
        if (count($application->skills) > 0) {
            $skills = $application->skills()->pluck('name')->toArray();
        }

        $skills = implode(", ", $skills);

        return $skills;
    }

    public function getLanguagesSet($application)
    {
        $languages = [];
        if (count($application->languages) > 0) {
            $languages = $application->languages()->pluck('name')->toArray();
        }

        $languages = implode(", ", $languages);

        return $languages;
    }
}