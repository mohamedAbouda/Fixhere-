<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\ClientCreateRequest;
use App\Http\Requests\Dashboard\ClientUpdateRequest;
use App\User;
use App\Role;
use App\Wallet;
use App\WalletTransaction;  

class ClientController extends Controller
{
    protected $base_view_path = 'dashboard.clients.';
    protected $paginate_by = 20;

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $data['resources'] = User::whereHas('roles', function ($query)  {
            $query->where('name','client');
        })->paginate($this->paginate_by);
        $data['total_resources_count'] = User::whereHas('roles', function ($query)  {
            $query->where('name','client');
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
    public function store(ClientCreateRequest $request)
    {
        $data = $request->all();

        $user = User::create($data);

        $role = Role::where('name', 'client')->first();
        $user->attachRole($role);

        alert()->success('Client created successfully.', 'Success');
        return redirect()->back();

    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show(User $client)
    {
        $data['resource'] = $client;
        return view($this->base_view_path . 'show',$data);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit(User $client)
    {
        $data['resource'] = $client;
        return view($this->base_view_path . 'edit',$data);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(ClientUpdateRequest $request, User $client)
    {
        $data = $request->all();

        if (isset($data['password']) && !$data['password']) {
            unset($data['password']);
        }
        if (isset($data['profile_image']) && $data['profile_image'] && $client->profile_image && file_exists(public_path($client->upload_distination.$client->profile_image))) {
            unlink(public_path($client->upload_distination.$client->profile_image));
        }
        $client->update($data);

        alert()->success('Client updated successfully.', 'Success');
        return redirect()->route('dashboard.clients.index');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy(User $client)
    {
        if ($client->profile_image && file_exists(public_path($client->upload_distination.$client->profile_image))) {
            unlink(public_path($client->upload_distination.$client->profile_image));
        }
        $client->delete();
        alert()->success('Client deleted successfully.', 'Success');
        return redirect()->route('dashboard.clients.index');
    }
    public function editWallet($id)
    {
        $wallet = Wallet::where('user_id',$id)->first();
        return view($this->base_view_path . 'editWallet',compact('wallet'));
    }

    public function storeWalletTransaction(Request $request)
    {
        $data =$request->all();
        $createWalletTransaction = WalletTransaction::create($data);
        $walletSum = WalletTransaction::where('wallet_id',$data['wallet_id'])->sum('value');
        $updateWallet = Wallet::where('id',$data['wallet_id'])->update(['value'=>$walletSum]);
        alert()->success('Wallet updated successfully.', 'Success');
        return redirect()->back(); 
    }
}
