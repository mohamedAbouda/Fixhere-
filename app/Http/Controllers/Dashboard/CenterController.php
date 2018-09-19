<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CenterCreateRequest;
use App\Http\Requests\Dashboard\CenterUpdateRequest;
use App\User;
use App\Role;

class CenterController extends Controller
{
    protected $base_view_path = 'dashboard.centers.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = User::whereHas('roles', function ($query)  {
            $query->where('name','center');
        })->paginate($this->paginate_by);
        $data['total_resources_count'] = User::whereHas('roles', function ($query)  {
            $query->where('name','center');
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
    public function store(CenterCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create($data);

        $role = Role::where('name', 'center')->first();
        $user->attachRole($role);

        alert()->success('Center created successfully.', 'Success');
        return redirect()->back();

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $center)
    {
        $data['resource'] = $center;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(User $center)
    {
        $data['resource'] = $center;
        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(CenterUpdateRequest $request, User $center)
    {
        $data = $request->all();

        if (isset($data['password']) && !$data['password']) {
            unset($data['password']);
        }
        if (isset($data['cover_image']) && $data['cover_image'] && $center->cover_image && file_exists(public_path($center->upload_distination.$center->cover_image))) {
            unlink(public_path($center->upload_distination.$center->cover_image));
        }
        $center->update($data);

        alert()->success('Center updated successfully.', 'Success');
        return redirect()->route('dashboard.centers.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $center)
    {
        if ($center->cover_image && file_exists(public_path($center->upload_distination.$center->cover_image))) {
            unlink(public_path($center->upload_distination.$center->cover_image));
        }
        $center->delete();
        alert()->success('Center deleted successfully.', 'Success');
        return redirect()->route('dashboard.centers.index');
    }
}
