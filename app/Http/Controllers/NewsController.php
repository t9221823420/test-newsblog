<?php

namespace App\Http\Controllers;

use App\Models\BaseModel as Model;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Nayjest\Grids\EloquentDataProvider;
use Nayjest\Grids\FilterConfig;
use Nayjest\Grids\Grid;
use Nayjest\Grids\ObjectDataRow;
use Nayjest\Builder\Builder as GridBuilder;

class NewsController extends CRUDController
{
    /*
    public function __construct()
    {
        
        $this->middleware( function( $request, $next ) {
            
            app()->bind( Model::class, News::class );
            
            return $next( $request );
        } );
        
    }
    */
    
    protected function _resourceId()
    {
        return 'news';
    }
    
    public function show( $news )
    {
        $model = News::findOrFail( (int)$news );
        
        return parent::show( $model );
    }
    
    public function edit( Request $request, FormBuilder $formBuilder, $news )
    {
        $model = News::findOrFail( (int)$news );
        
        return parent::edit( $request, $formBuilder, $model );
    }
    
    public function update( Request $request, FormBuilder $formBuilder, $news )
    {
        $model = News::findOrFail( (int)$news );
        
        return parent::update( $request, $formBuilder, $model );
    }
    
    public function store( Request $request, FormBuilder $formBuilder, News $model )
    {
        return parent::update( $request, $formBuilder, $model );
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $news
     * @return \Illuminate\Http\Response
     */
    public function destroy( $news )
    {
        $model = News::findOrFail( (int)$news );
    
        return parent::destroy( $model );
    }
    
    protected function _buildForm( FormBuilder $formBuilder, $fields = [], $options = [] ): Form
    {
        $options['model'] = $options['model'] ?? new News();
        
        $fields = array_merge( [
            [
                'name'  => 'title',
                'type'  => Field::TEXT,
                'rules' => 'required|min:3|max:255',
            ],
            [
                'name'        => 'category_id',
                'label'       => 'Category',
                'type'        => Field::ENTITY,
                'class'       => Category::class,
                'property'    => 'title',
                'empty_value' => 'Select Category',
                'rules'       => 'required|integer|min:1',
                //'selected'    => $model->category_id,
            ],
            [
                'name'  => 'text',
                'type'  => Field::TEXTAREA,
                'rules' => 'required|max:2000',
            ],
        ], $fields );
        
        $form = parent::_buildForm( $formBuilder, $fields, $options )
                      ->add( 'submit', 'submit', [ 'label' => 'Save', 'attr' => [ 'class' => 'btn btn-primary' ] ] )
        ;
        
        return $form;
    }
    
    protected function _buildGrid( array $config = [] ): Grid
    {
        $tableName_Category = Category::tableName();
        
        $config = [
            'src'     => News::with( 'Category' ),
            'columns' => [
                
                'title' => [
                    'name' => 'title',
                    /*
                    'filter' => [
                        'name'     => 'foo',
                        'operator' => FilterConfig::OPERATOR_LIKE,
                    ],
                    */
                ],
                
                'category' => [
                    'name'     => 'category',
                    'callback' => function( $val, ObjectDataRow $row ) {
                        return $row->getSrc()->Category->title;
                    },
                ],
                
                'created_at' => [
                    'name'     => 'created_at',
                    'label'    => 'Created',
                    'sortable' => true,
                ],
            
            ],
        
        ];
        
        return parent::_buildGrid( $config );
    }
}
