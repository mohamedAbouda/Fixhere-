<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ProductCreateRequest;
use App\Http\Requests\Dashboard\ProductUpdateRequest;
use App\Product;
use App\Model;
use App\Brand;

class ProductController extends Controller
{
    protected $base_view_path = 'dashboard.products.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = Product::orderBy('id', 'DESC')->paginate($this->paginate_by);
        $data['total_resources_count'] = Product::count();
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
        $data['models'] = Model::get();

        return view($this->base_view_path . 'create', $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(ProductCreateRequest $request)
    {
        $data = $request->all();

        $product = Product::create($data);

        alert()->success('Product created successfully.', 'Success');
        return redirect()->route('dashboard.products.index');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Product $product)
    {
        $data['resource'] = $product;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Product $product)
    {
        $data['resource'] = $product;
        $data['brands'] = Brand::pluck('name', 'id')->toArray();
        $data['models'] = Model::get();

        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(ProductUpdateRequest $request, Product $product)
    {
        $data = $request->all();

        $product->update($data);

        alert()->success('Product updated successfully.', 'Success');
        return redirect()->route('dashboard.products.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Product $product)
    {
        $product->delete();
        alert()->success('Product deleted successfully.', 'Success');
        return redirect()->route('dashboard.products.index');
    }
}
