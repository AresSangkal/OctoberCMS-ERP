<?php namespace Vaslv\Carousel;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Vaslv\Carousel\Components\Carousel' => 'carousel',
        ];
    }

    public function registerSettings()
    {
    }

    public function registerListColumnTypes()
    {
        return [
            'vaslv_carousel_thumb' => function ($src) {
                return "<img src=\"$src\" alt=\"\">";
            },
        ];
    }
}
