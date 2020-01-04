<?php namespace Horizonstack\Blogextend;

use Horizonstack\Blogextend\Components\HomepageBlogs;
use RainLab\Blog\Models\Post;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    /**
     * @var array Plugin dependencies
     */
    public $require = ['RainLab.Blog'];

    public function registerComponents()
    {
        return [
            HomepageBlogs::class => 'homepageBlogs'
        ];
    }

    public function registerSettings()
    {
    }

    public function boot()
    {
        Post::extend(function ($model) {
            $model->rules['featured_images'] = 'required';
        });
    }
}
