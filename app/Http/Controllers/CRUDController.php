<?php
/**
 * Created by PhpStorm.
 * User: bw
 * Date: 22.03.2019
 * Time: 22:58
 */

namespace App\Http\Controllers;

use App\Models\BaseModel as Model;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
use Nayjest\Grids\Grid;
use Nayjest\Grids\ObjectDataRow;
use Illuminate\Http\Response;

abstract class CRUDController extends Controller
{
    protected function _resourceId()
    {
        return 'crud';
    }

    /**
     * @param $actionId
     * @return string
     */
    protected function _getViewId($actionId)
    {
        $viewId = "{$this->_resourceId()}.$actionId";

        return view()->exists($viewId)
            ? $viewId
            : self::_resourceId() . ".$actionId";
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view($this->_getViewId('index'), [
            'resourceId' => $this->_resourceId(),
            'title' => ucfirst($this->_resourceId()) . ' index',
            'grid' => $this->_buildGrid(),
        ]);
    }

    /**
     * @param BaseModel $model
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Model $model)
    {
        return view($this->_getViewId('show'), [
            'resourceId' => $this->_resourceId(),
            'title' => ucfirst($this->_resourceId()),
            'model' => $model,
        ]);
    }

    /**
     * @param $model
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($model)
    {
        $model->delete();
        return redirect()->route("{$this->_resourceId()}.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(FormBuilder $formBuilder)
    {
        $url = route("{$this->_resourceId()}.store");

        return view($this->_getViewId('create'), [
            'resourceId' => $this->_resourceId(),
            'title' => ucfirst($this->_resourceId()) . ' create',
            'form' => $this->_buildForm($formBuilder, [], ['url' => $url]),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Request $request
     * @param FormBuilder $formBuilder
     * @param \App\Models\BaseModel $model
     * @return Response
     */
    public function edit(FormBuilder $formBuilder, $model)
    {
        if (!$model instanceof Model) {
            throw new ModelNotFoundException();
        }

        $url = route("{$this->_resourceId()}.update", [$model->id]);

        return view($this->_getViewId('edit'), [
            'resourceId' => $this->_resourceId(),
            'title' => ucfirst($this->_resourceId()) . ' edit',
            'form' => $this->_buildForm($formBuilder, [], [
                'model' => $model,
                'method' => 'PUT',
                'url' => $url,
            ]),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\News $news
     * @return Response
     */
    public function update(FormBuilder $formBuilder, $model)
    {
        if (!$model instanceof Model) {
            throw new ModelNotFoundException();
        }

        $form = $this->_buildForm($formBuilder);
        $form->redirectIfNotValid();
        $model->fill($form->getFieldValues())->save();

        return redirect()->route("{$this->_resourceId()}.index");
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
            'method' => 'POST',
        ], $options);

        return $formBuilder->createByArray($fields, $options);
    }

    /**
     * @param array $config
     * @return Grid
     */
    protected function _buildGrid(array $config = []): Grid
    {
        if (!isset($config['columns']['_actions'])) {

            $config['columns']['_actions'] = [
                'name' => 'Actions',
                'callback' => function ($val, ObjectDataRow $row) {

                    /** @var BaseModel $model */
                    $model = $row->getSrc();
                    $resourceId = get_class($model)::resourceId();

                    return ''
                        . '<a href="' . route($resourceId . '.edit',
                            [$model->id]) . '" class="glyphicon glyphicon-pencil"></a>'
                        . '<a href="' . route($resourceId . '.show',
                            [$model->id]) . '" class="glyphicon glyphicon-eye-open"></a>';
                },
            ];
        }

        return \Grids::make($config);
    }
}
