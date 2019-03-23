<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Models\BaseModel as Model;
use App\Models\News;
use App\Models\Category;

Route::get( '/', 'Controller@home' );
Route::get( '/news/{news?}', 'Controller@news' )->name( 'byNews' );
Route::get( '/cat/{category?}', 'Controller@home' )->name( 'byCategory' );

Route::prefix( 'manager' )->group( function() {
    
    Route::resource( \App\Models\Category::resourceId(), 'CategoryController' )->middleware( function( $request, $next ) {
        
        app()->bind( Model::class, Category::class );
        
        return $next( $request );
    } )
    ;
    
    Route::resource( News::resourceId(), 'NewsController' )->middleware( function( $request, $next ) {
        
        app()->bind( Model::class, News::class );
        
        return $next( $request );
    } )
    ;
    
} )
;
