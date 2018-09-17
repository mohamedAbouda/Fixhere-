<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Region;
use App\City;
use Alert;

class RegionController extends Controller
{
    protected $mainUrl = 'dashboard.regions.';

    public function index()
    {
        $regions = Region::with('city')->paginate(15);
        return view($this->mainUrl . 'index')->with('regions',$regions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view($this->mainUrl . 'create')->with('cities',$cities);
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
        $store = Region::create($data);
        Alert::success('Region created successfully.', 'Success');
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
        $cities = City::all();
        $region = Region::where('id',$id)->first();
        return view($this->mainUrl . 'edit')->with(['region'=>$region,'cities'=>$cities]);
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
        $city = Region::where('id',$id)->first();
        $city->update($data);
        Alert::success('Region updated successfully.', 'Success');
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
        $delete = Region::where('id',$id)->first();
        $delete->delete();
        Alert::success('Region deleted successfully.', 'Success');
        return redirect()->route($this->mainUrl . 'index');
    }
}
