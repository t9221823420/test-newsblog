<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\BaseModel as Model;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Nayjest\Grids\Grid;

class CategoryController extends CRUDController
{
    /*
    public function __construct()
    {
        
        $this->middleware( function( $request, $next ) {
            
            app()->bind( Model::class, Category::class );
            
            return $next( $request );
        } );
        
    }
    */
    
    protected function _resourceId()
    {
        return 'category';
    }
    
    public function show( $category )
    {
        $model = Category::findOrFail( (int)$category );
        
        return parent::show( $model );
    }
    
    public function edit( Request $request, FormBuilder $formBuilder, $category )
    {
        $model = Category::findOrFail( (int)$category );
        
        return parent::edit( $request, $formBuilder, $model );
    }
    
    public function update( Request $request, FormBuilder $formBuilder, $category )
    {
        $model = Category::findOrFail( (int)$category );
        
        return parent::update( $request, $formBuilder, $model );
    }
    
    public function store( Request $request, FormBuilder $formBuilder, Category $model )
    {
        return parent::update( $request, $formBuilder, $model );
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  integer $category
     * @return \Illuminate\Http\Response
     */
    public function destroy( $category )
    {
        $model = Category::findOrFail( (int)$category );
        
        return parent::destroy( $model );
    }
    
    protected function _buildForm( FormBuilder $formBuilder, $fields = [], $options = [] ): Form
    {
        $options = array_merge( [
            'model' => $Model ?? new Category(),
        ], $options );
        
        $fields = array_merge( [
            [
                'name'  => 'title',
                'type'  => Field::TEXT,
                'rules' => 'required|min:3|max:255',
            ],
        ], $fields );
        
        $form = parent::_buildForm( $formBuilder, $fields, $options )
                      ->add( 'submit', 'submit', [ 'label' => 'Save', 'attr' => [ 'class' => 'btn btn-primary' ] ] )
        ;
        
        return $form;
    }
    
    protected function _buildGrid( array $config = [] ): Grid
    {
        $config = [
            'src'     => Category::class,
            'columns' => [
                
                'title' => [
                    'name' => 'title',
                ],
                
            ],
        
        ];
        
        return parent::_buildGrid( $config );
    }
}
