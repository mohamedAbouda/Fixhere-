<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\AdminCreateRequest;
use App\Http\Requests\Dashboard\AdminUpdateRequest;
use App\User;
use App\Role;

class AdminController extends Controller
{
    protected $base_view_path = 'dashboard.admins.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = User::whereHas('roles', function ($query)  {
            $query->where('name','admin');
        })->paginate($this->paginate_by);
        $data['total_resources_count'] = User::whereHas('roles', function ($query)  {
            $query->where('name','admin');
        })->count();
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
    public function store(AdminCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create($data);

        $role = Role::where('name', 'admin')->first();
        $user->attachRole($role);

        alert()->success('Admin created successfully.', 'Success');
        return redirect()->back();

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $admin)
    {
        $data['resource'] = $admin;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(User $admin)
    {
        $data['resource'] = $admin;
        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(AdminUpdateRequest $request, User $admin)
    {
        $data = $request->all();

        if (isset($data['password']) && !$data['password']) {
            unset($data['password']);
        }

        $admin->update($data);

        alert()->success('Admin updated successfully.', 'Success');
        return redirect()->route('dashboard.admins.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $admin)
    {
        $admin->delete();
        alert()->success('Admin deleted successfully.', 'Success');
        return redirect()->route('dashboard.admins.index');
    }
}
