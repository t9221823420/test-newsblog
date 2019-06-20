<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Nayjest\Grids\Grid;

class CategoryController extends CRUDController
{
    protected function _resourceId()
    {
        return 'category';
    }

    /**
     * @param \App\Models\BaseModel $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($category)
    {
        $model = Category::findOrFail((int)$category);

        return parent::show($model);
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param \App\Models\BaseModel $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, FormBuilder $formBuilder, $category)
    {
        $model = Category::findOrFail((int)$category);

        return parent::edit($request, $formBuilder, $model);
    }

    /**
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FormBuilder $formBuilder, $category)
    {
        $model = Category::findOrFail((int)$category);

        return parent::update($request, $formBuilder, $model);
    }

    public function store(Request $request, FormBuilder $formBuilder, Category $model)
    {
        return parent::update($request, $formBuilder, $model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($category)
    {
        $model = Category::findOrFail((int)$category);

        return parent::destroy($model);
    }

    /**
     * @param FormBuilder $formBuilder
     * @param array $fields
     * @param array $options
     * @return Form
     */
    protected function _buildForm(FormBuilder $formBuilder, $fields = [], $options = []): Form
    {
        $options = array_merge([
            'model' => $Model ?? new Category(),
        ], $options);

        $fields = array_merge([
            [
                'name' => 'title',
                'type' => Field::TEXT,
                'rules' => 'required|min:3|max:255',
            ],
        ], $fields);

        $form = parent::_buildForm($formBuilder, $fields, $options)
            ->add('submit', 'submit', ['label' => 'Save', 'attr' => ['class' => 'btn btn-primary']]);

        return $form;
    }

    /**
     * @param array $config
     * @return Grid
     */
    protected function _buildGrid(array $config = []): Grid
    {
        $config = [
            'src' => Category::class,
            'columns' => [
                'title' => [
                    'name' => 'title',
                ],
            ],
        ];

        return parent::_buildGrid($config);
    }
}
