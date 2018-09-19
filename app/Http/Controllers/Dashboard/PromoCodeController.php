<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CreatePromoCode;
use App\Http\Requests\Dashboard\EditPromoCode;
use App\PromoCode;
use Alert;

class PromoCodeController extends Controller
{
    protected $mainUrl = 'dashboard.promo_codes.';

    public function index()
    {
        $promo_codes = PromoCode::paginate(15);
        return view($this->mainUrl . 'index')->with('promo_codes',$promo_codes);
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
    public function store(CreatePromoCode $request)
    {
        $data = $request->all();
        $data['code'] = $this->generateRandomString(8);
        $store = PromoCode::create($data);
        Alert::success('Promo Code created successfully.', 'Success');
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
        $promo_code = PromoCode::where('id',$id)->first();
        return view($this->mainUrl . 'edit')->with(['promo_code'=>$promo_code]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditPromoCode $request, $id)
    {
        $data = $request->all();
        $promo_code = PromoCode::where('id',$id)->first();
        $promo_code->update($data);
        Alert::success('Promo Code updated successfully.', 'Success');
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
        $delete = PromoCode::where('id',$id)->first();
        $delete->delete();
        Alert::success('Promo Code deleted successfully.', 'Success');
        return redirect()->route($this->mainUrl . 'index');
    }
}
