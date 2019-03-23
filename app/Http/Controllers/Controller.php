<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function home( $category = null )
    {
        $builder = News::orderBy( 'created_at', 'desc' )->with( 'Category' );
        
        if( $category ) {
            
            $builder->where( 'category_id', (int)$category );
            $category = Category::find( (int)$category );
        }
        
        return view( 'home', [
            'categories' => Category::get(),
            'news'       => $builder->get(),
            'category'   => $category ?? null,
        ] );
    }
    
    public function news( News $news )
    {
        return view( 'news.view', [
            'categories' => Category::get(),
            'model' => $news,
        ] );
    }
}
