<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Category;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param null $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home($category = null)
    {
        $builder = News::orderBy('created_at', 'desc')->with('Category');

        if ($category) {
            $builder->where('category_id', (int)$category);
            $category = Category::find((int)$category);
        }

        return view('home', [
            'categories' => Category::get(),
            'news' => $builder->get(),
            'category' => $category ?? null,
        ]);
    }

    /**
     * @param News $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function news(News $news)
    {
        return view('news.view', [
            'categories' => Category::get(),
            'model' => $news,
        ]);
    }
}
