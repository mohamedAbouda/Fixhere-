<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ModelCreateRequest;
use App\Http\Requests\Dashboard\ModelUpdateRequest;
use App\Model;
use App\Brand;

class ModelController extends Controller
{
    protected $base_view_path = 'dashboard.models.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = Model::orderBy('id', 'DESC')->paginate($this->paginate_by);
        $data['total_resources_count'] = Model::count();
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * $this->paginate_by) - $this->paginate_by;
        return view($this->base_view_path . 'index',$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $data['brands'] = Brand::pluck('name', 'id')->toArray();

        return view($this->base_view_path . 'create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(ModelCreateRequest $request)
    {
        $data = $request->all();

        $model = Model::create($data);

        alert()->success('Model created successfully.', 'Success');
        return redirect()->route('dashboard.models.index');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Model $model)
    {
        $data['resource'] = $model;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Model $model)
    {
        $data['resource'] = $model;
        $data['brands'] = Brand::pluck('name', 'id')->toArray();

        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(ModelUpdateRequest $request, Model $model)
    {
        $data = $request->all();

        $model->update($data);

        alert()->success('Model updated successfully.', 'Success');
        return redirect()->route('dashboard.models.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Model $model)
    {
        $model->delete();
        alert()->success('Model deleted successfully.', 'Success');
        return redirect()->route('dashboard.models.index');
    }
}
