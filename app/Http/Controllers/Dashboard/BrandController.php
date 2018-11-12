<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\BrandCreateRequest;
use App\Http\Requests\Dashboard\BrandUpdateRequest;
use App\Brand;

class BrandController extends Controller
{
    protected $base_view_path = 'dashboard.brands.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = Brand::orderBy('id', 'DESC')->paginate($this->paginate_by);
        $data['total_resources_count'] = Brand::count();
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
        return view($this->base_view_path . 'create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(BrandCreateRequest $request)
    {
        $data = $request->all();

        $brand = Brand::create($data);

        alert()->success('Brand created successfully.', 'Success');
        return redirect()->route('dashboard.brands.index');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Brand $brand)
    {
        $data['resource'] = $brand;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Brand $brand)
    {
        $data['resource'] = $brand;
        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $data = $request->all();

        $brand->update($data);

        alert()->success('Brand updated successfully.', 'Success');
        return redirect()->route('dashboard.brands.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        alert()->success('Brand deleted successfully.', 'Success');
        return redirect()->route('dashboard.brands.index');
    }
}
