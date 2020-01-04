<?php namespace Horizonstack\Blogextend\Components;

use Cms\Classes\ComponentBase;
use RainLab\Blog\Models\Post;

class HomepageBlogs extends ComponentBase
{
    public function componentDetails()
    {
        return [
            'name'        => 'Homepage Blogs',
            'description' => 'Render recent blogs to homepage...',
        ];
    }

    public function defineProperties()
    {
        return [];
    }

    public function onRun()
    {
        $blogs = Post::isPublished()->orderBy('published_at', 'desc')->limit(4)->get();

        $this->page['homepagePosts'] = $blogs;
    }
}
