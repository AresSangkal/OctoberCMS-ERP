<?php namespace Horizonstack\Career\Components;

use Cms\Classes\ComponentBase;
use Horizonstack\Career\Models\Category;
use Horizonstack\Career\Models\Vacancy;
use RainLab\Translate\Classes\Translator;

class ListVacancies extends ComponentBase
{
    protected $activeLocale;

    public $vacancies;

    public function componentDetails()
    {
        return [
            'name'        => 'List Vacancies',
            'description' => 'Render table view of vacancies with this component...',
        ];
    }

    public function defineProperties()
    {
        return [
            'vacanciesPerPage' => [
                'title'             => 'Per Page',
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Numbers only.',
                'default'           => '15',
            ],
            'sortOrder'     => [
                'title'       => 'Vacancies Order',
                'description' => 'Attribute on which the Vacancies should be ordered',
                'type'        => 'dropdown',
                'default'     => 'title asc',
            ],
        ];
    }

    public function getSortOrderOptions()
    {
        return Vacancy::$allowedSortingOptions;
    }


    public function onRun()
    {
        $translator = Translator::instance();
        $this->activeLocale = $translator->getLocale();

        $categories               = Category::isActive()->orderBy('name')->get();
        $this->page['categories'] = $categories;

        $this->onLoadVacancies();
    }


    public function onLoadVacancies($page = null)
    {
        $data = post();

        $vacancies = Vacancy::with(['category'])->isActive();

        if ( ! empty($data['category'])) {
            $vacancies->where('category_id', $data['category']);
        }

        $parts = explode(' ', $this->property('sortOrder'));
        if (count($parts) < 2) {
            array_push($parts, 'desc');
        }
        list($sortField, $sortDirection) = $parts;

        $vacancies = $vacancies->orderBy($sortField, $sortDirection);

        if ( ! empty($page)) {
            $vacancies = $vacancies->paginate($this->property('vacanciesPerPage'), $page);
        } else {
            $vacancies = $vacancies->paginate($this->property('vacanciesPerPage'), 1);
        }

        $vacancies->each(function ($item, $key) {
            if ( ! empty($item)) {
                $item->title = $item->lang($this->activeLocale)->title;

                if ($item->category) {
                    $item->category->name = $item->category->lang($this->activeLocale)->name;
                }
            }

        });

        $this->page['vacancies'] = $this->vacancies = $vacancies;
    }

    public function onPageChangeFilter()
    {
        $page = post('page');
        $this->onLoadVacancies($page);
    }
}
