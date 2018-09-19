<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use App\Chat;
use DB;

class ChatController extends Controller
{
    protected $base_view_path = 'dashboard.chats.';
    protected $paginate_by = 20;

    public function chats()
    {
        // dd(DB::select('select * ,max(id) as max_id FROM chats GROUP BY order_id'));
        $index = request()->get('page' , 1);
        $data['counter_offset'] = ($index * $this->paginate_by) - $this->paginate_by;
        $data['chats'] = Chat::select('chats_1.*')->from('chats as chats_1')
        ->join(DB::raw('(select max(id) as max_id FROM chats GROUP BY order_id) as chats_2') ,'chats_1.id' ,'=' ,'chats_2.max_id')->orderBy('chats_1.id' ,'DESC')->with('order')
        ->paginate(20);
        // dd($data);
        return view($this->base_view_path . 'index' ,$data);
    }

    public function chat(Order $order)
    {
        $data['order'] = $order;
        return view($this->base_view_path . 'form' ,$data);
    }

    public function send(Request $request ,Order $order)
    {
        $user = auth()->user();
        $input = $request->only(['message']);
        $input['order_id'] = $order->id;
        $input['sender_id'] = $user->id;
        $input['sender_type'] = Chat::SENDER_TYPE_ADMIN;
        Chat::create($input);
        alert()->success('Message sent successfully.', 'Success');
        return redirect()->back();
    }
}
