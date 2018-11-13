<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\MaintenanceServiceCreateRequest;
use App\Http\Requests\Dashboard\MaintenanceServiceUpdateRequest;
use App\MaintenanceService;

class MaintenanceServiceController extends Controller
{
    protected $base_view_path = 'dashboard.maintenance_services.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = MaintenanceService::orderBy('id', 'DESC')->paginate($this->paginate_by);
        $data['total_resources_count'] = MaintenanceService::count();
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
    public function store(MaintenanceServiceCreateRequest $request)
    {
        $data = $request->all();

        $maintenance_service = MaintenanceService::create($data);

        alert()->success('Maintenance service created successfully.', 'Success');
        return redirect()->route('dashboard.maintenance-services.index');

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(MaintenanceService $maintenance_service)
    {
        $data['resource'] = $maintenance_service;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(MaintenanceService $maintenance_service)
    {
        $data['resource'] = $maintenance_service;

        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(MaintenanceServiceUpdateRequest $request, MaintenanceService $maintenance_service)
    {
        $data = $request->all();

        $maintenance_service->update($data);

        alert()->success('Maintenance service updated successfully.', 'Success');
        return redirect()->route('dashboard.maintenance-services.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(MaintenanceService $maintenance_service)
    {
        $maintenance_service->delete();
        alert()->success('Maintenance service deleted successfully.', 'Success');
        return redirect()->route('dashboard.maintenance-services.index');
    }
}
