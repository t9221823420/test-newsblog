<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Field;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Nayjest\Grids\Grid;
use Nayjest\Grids\ObjectDataRow;

class NewsController extends CRUDController
{
    /**
     * @return string
     */
    protected function _resourceId()
    {
        return 'news';
    }

    /**
     * @param \App\Models\BaseModel $news
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($news)
    {
        $model = News::findOrFail((int)$news);

        return parent::show($model);
    }

    /**
     * @param FormBuilder $formBuilder
     * @param $news
     * @return \Illuminate\Http\Response
     */
    public function edit(FormBuilder $formBuilder, $news)
    {
        $model = News::findOrFail((int)$news);

        return parent::edit($formBuilder, $model);
    }

    /**
     * @param FormBuilder $formBuilder
     * @param $news
     * @return \Illuminate\Http\Response
     */
    public function update(FormBuilder $formBuilder, $news)
    {
        $model = News::findOrFail((int)$news);

        return parent::update($formBuilder, $model);
    }

    /**
     * @param FormBuilder $formBuilder
     * @param News $model
     * @return \Illuminate\Http\Response
     */
    public function store(FormBuilder $formBuilder, News $model)
    {
        return parent::update($formBuilder, $model);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param integer $news
     * @return \Illuminate\Http\Response
     */
    public function destroy($news)
    {
        $model = News::findOrFail((int)$news);

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
        $options['model'] = $options['model'] ?? new News();

        $fields = array_merge([
            [
                'name' => 'title',
                'type' => Field::TEXT,
                'rules' => 'required|min:3|max:255',
            ],
            [
                'name' => 'category_id',
                'label' => 'Category',
                'type' => Field::ENTITY,
                'class' => Category::class,
                'property' => 'title',
                'empty_value' => 'Select Category',
                'rules' => 'required|integer|min:1',
            ],
            [
                'name' => 'text',
                'type' => Field::TEXTAREA,
                'rules' => 'required|max:2000',
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
        $tableName_Category = Category::tableName();

        $config = [
            'src' => News::with('Category'),
            'columns' => [
                'title' => [
                    'name' => 'title',
                ],
                'category' => [
                    'name' => 'category',
                    'callback' => function ($val, ObjectDataRow $row) {
                        return $row->getSrc()->Category->title;
                    },
                ],

                'created_at' => [
                    'name' => 'created_at',
                    'label' => 'Created',
                    'sortable' => true,
                ],
            ],
        ];

        return parent::_buildGrid($config);
    }
}
