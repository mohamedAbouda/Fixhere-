<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AgentCreateRequest;
use App\Http\Requests\Dashboard\AgentUpdateRequest;
use App\User;
use App\Role;
use Auth;

class AgentController extends Controller
{
    protected $base_view_path = 'dashboard.agents.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * $this->paginate_by) - $this->paginate_by;
        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            $data['total_resources_count'] = User::where('parent_id',$center->id)->whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->count();
            $data['resources'] = User::where('parent_id',$center->id)->whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->paginate($this->paginate_by);
        }else{
            $data['total_resources_count'] = User::whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->count();
            $data['resources'] = User::whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->paginate($this->paginate_by);
        }
        return view($this->base_view_path . 'index',$data);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        $data = [];
        if (Auth::user()->hasRole(['superadmin','admin'])) {
            $data['centers'] = User::whereHas('roles', function ($query)  {
                $query->where('name','center');
            })->pluck('name','id');
        }
        return view($this->base_view_path . 'create' , $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(AgentCreateRequest $request)
    {
        $data = $request->all();

        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            $data['parent_id'] = $center->id;
        }

        $user = User::create($data);

        $role = Role::where('name', 'agent')->first();
        $user->attachRole($role);

        alert()->success('Agent created successfully.', 'Success');
        return redirect()->back();

    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(User $agent)
    {
        if (Auth::user()->hasRole(['superadmin','admin'])) {
            $data['centers'] = User::whereHas('roles', function ($query)  {
                $query->where('name','center');
            })->pluck('name','id');
        }
        $data['resource'] = $agent;

        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(AgentUpdateRequest $request, User $agent)
    {
        $data = $request->all();

        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            if ($agent->parent_id !== $center->id) {
                alert()->error('You aren\'t authorized to perform this action.', 'Error');
                return redirect()->route('dashboard.orders.index');
            }
            $data['parent_id'] = $center->id;
        }

        $agent->update($data);

        alert()->success('Agent updated successfully.', 'Success');
        return redirect()->route('dashboard.agents.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $agent)
    {
        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            if ($agent->parent_id !== $center->id) {
                alert()->error('You aren\'t authorized to perform this action.', 'Error');
                return redirect()->route('dashboard.orders.index');
            }
        }
        if ($agent->profile_image && file_exists(public_path($agent->upload_distination.$agent->profile_image))) {
            unlink(public_path($agent->upload_distination.$agent->profile_image));
        }
        $agent->delete();
        alert()->success('Agent deleted successfully.', 'Success');
        return redirect()->route('dashboard.agents.index');
    }
}
