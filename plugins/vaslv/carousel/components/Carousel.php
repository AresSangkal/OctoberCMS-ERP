<?php namespace Vaslv\Carousel\Components;

use Cms\Classes\ComponentBase;

class Carousel extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'vaslv.carousel::lang.components.carousel.name',
            'description' => 'vaslv.carousel::lang.components.carousel.description'
        ];
    }

    public function defineProperties()
    {
        return [
            'carousel' => [
                'title' => 'vaslv.carousel::lang.components.carousel.properties.carousel.title',
                'description' => 'vaslv.carousel::lang.components.carousel.properties.carousel.description',
                'type' => 'dropdown',
                'required' => true,
            ]
        ];
    }

    public function getCarouselOptions()
    {
        return \Vaslv\Carousel\Models\Carousel::orderBy('name')
            ->get(['id', 'name'])
            ->lists('name', 'id');
    }

    public function carousel()
    {
        return \Vaslv\Carousel\Models\Carousel::with([
            'slides' => function ($query) {
                $query->orderBy('weight')
                    ->orderBy('id');
            }
        ])->find($this->property('carousel'));
    }
}
