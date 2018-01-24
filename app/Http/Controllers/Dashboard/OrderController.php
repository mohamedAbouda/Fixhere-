<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OrderCreateRequest;
use App\Http\Requests\Dashboard\OrderUpdateRequest;
use App\Order;
use App\User;
use App\Role;
use Auth;

class OrderController extends Controller
{
    protected $base_view_path = 'dashboard.orders.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index(Request $request)
    {
        $index = $request->get('page' , 1);
        $data['counter_offset'] = ($index * $this->paginate_by) - $this->paginate_by;
        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            $data['resources'] = Order::where('center_id',$center->id)->orderBy('id','DESC')->paginate($this->paginate_by);
            $data['total_resources_count'] = Order::where('center_id',$center->id)->count();
        }else {
            $data['resources'] = Order::orderBy('id','DESC')->paginate($this->paginate_by);
            $data['total_resources_count'] = Order::count();
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
        $data['clients'] = User::whereHas('roles', function ($query)  {
            $query->where('name','client');
        })->pluck('name','id');

        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            $data['agents'] = User::where('parent_id',$center->id)->whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->get(['id','name','parent_id']);
        }else{
            $data['centers'] = User::whereHas('roles', function ($query)  {
                $query->where('name','center');
            })->pluck('name','id');
            $data['agents'] = User::whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->get(['id','name','parent_id']);
        }

        return view($this->base_view_path . 'create' , $data);
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(OrderCreateRequest $request)
    {
        $data = $request->all();

        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            $data['center_id'] = $center->id;
        }

        $user = Order::create($data);

        alert()->success('Order created successfully.', 'Success');
        return redirect()->back();

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(Order $order)
    {
        $data['resource'] = $order;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(Order $order)
    {
        $data['clients'] = User::whereHas('roles', function ($query)  {
            $query->where('name','client');
        })->pluck('name','id');
        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            if ($order->center_id !== $center->id) {
                alert()->error('You aren\'t authorized to perform this action.', 'Error');
                return redirect()->route('dashboard.orders.index');
            }
            $data['agents'] = User::where('parent_id',$center->id)->whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->get(['id','name','parent_id']);
        }else{
            $data['centers'] = User::whereHas('roles', function ($query)  {
                $query->where('name','center');
            })->pluck('name','id');
            $data['agents'] = User::whereHas('roles', function ($query)  {
                $query->where('name','agent');
            })->get(['id','name','parent_id']);
        }
        $data['resource'] = $order;

        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(OrderUpdateRequest $request, Order $order)
    {
        $data = $request->all();

        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            if ($order->center_id !== $center->id) {
                alert()->error('You aren\'t authorized to perform this action.', 'Error');
                return redirect()->route('dashboard.orders.index');
            }
            $data['center_id'] = $center->id;
        }

        $order->update($data);

        alert()->success('Order updated successfully.', 'Success');
        return redirect()->route('dashboard.orders.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(Order $order)
    {
        if (Auth::user()->hasRole('center')) {
            $center = Auth::user();
            if ($order->center_id !== $center->id) {
                alert()->error('You aren\'t authorized to perform this action.', 'Error');
                return redirect()->route('dashboard.orders.index');
            }
        }

        $order->delete();
        alert()->success('Order deleted successfully.', 'Success');
        return redirect()->route('dashboard.orders.index');
    }
}
