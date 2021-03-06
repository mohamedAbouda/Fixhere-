<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Service;
use Alert;

class ServiceController extends Controller
{
    protected $mainUrl = 'dashboard.services.';

    public function index()
    {
        $services = Service::paginate(15);
        return view($this->mainUrl . 'index')->with('services',$services);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->mainUrl . 'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $store = Service::create($data);
        Alert::success('Service created successfully.', 'Success');
        return redirect()->route($this->mainUrl . 'index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service = Service::where('id',$id)->first();
        return view($this->mainUrl . 'edit')->with('service',$service);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $city = Service::where('id',$id)->first();
        $city->update($data);
        Alert::success('Service updated successfully.', 'Success');
        return redirect()->route($this->mainUrl . 'index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Service::where('id',$id)->first();
        $delete->delete();
        Alert::success('Service deleted successfully.', 'Success');
        return redirect()->route($this->mainUrl . 'index');
    }
}
