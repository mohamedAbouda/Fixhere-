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
        $data['total_resources_count'] = $data['resources']->count();
        $data['resources'] = new Paginator($data['resources'] , $this->paginate_by , $index);

        return view($this->base_view_path . 'index',$data);
    }

    public function show(Request $request , $group)
    {
        $data['index'] = $request->get('page' , 1);
        $data['group'] = $group;
        $limit = 5 * $data['index'];
        $messages_count = Enquiry::where('group',$group)->count();
        if ($messages_count > $limit) {
            $data['messages'] =  Enquiry::where('group',$group)->skip($messages_count - $limit)->take($limit)->get();
        }else{
            $data['messages'] =  Enquiry::where('group',$group)->get();
        }
        $data['messages_count'] = $messages_count;
        $data['limit'] = $limit;

        return view($this->base_view_path . 'show',$data);
    }

    public function reply(Request $request , $group)
    {
        $check_message = Enquiry::where('group',$group)->first();
        if (!$check_message) {
            alert()->error('You aren\'t authorized to perform this action.', 'Error');
            return redirect()->route('dashboard.enquiries.index');
        }
        $input = $request->all();
        $input['from'] = Auth::user()->id;
        $input['group'] = $group;
        $input['to'] = $check_message->from === $input['from'] ? $check_message->to : $check_message->from;

        Enquiry::create($input);

        alert()->success('Reply sent successfully.', 'Success');
        return redirect()->back();
    }
}
