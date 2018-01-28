<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Enquiry;
use Auth;
use Illuminate\Pagination\Paginator;

class SupportController extends Controller
{
    protected $base_view_path = 'dashboard.messages.';
    protected $paginate_by = 20;

    public function index(Request $request)
    {
        $center = Auth::user();
        $index = $request->get('page' , 1);

        $data['counter_offset'] = ($index * $this->paginate_by) - $this->paginate_by;

        $ordered = Enquiry::where('from',$center->id)->orWhere('to',$center->id)
        ->orderBy('id','DESC')->get();
        $data['resources'] = $ordered->groupBy('group');
        $data['resources'] = new Paginator($data['resources'] , $this->paginate_by , $index);

        $data['total_resources_count'] = Enquiry::where('from',$center->id)->orWhere('to',$center->id)
        ->orderBy('id','DESC')->groupBy('enquiries.group')->count();

        return view($this->base_view_path . 'index',$data);
    }

    /**
    * vluzrmos/paginate.php
    *
    * @param array|Collection      $items
    * @param int   $perPage
    * @param int  $page
    * @param array $options
    *
    * @return LengthAwarePaginator
    */
    public function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
