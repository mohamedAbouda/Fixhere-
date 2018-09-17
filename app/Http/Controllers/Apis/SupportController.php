<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Transformers\EnquiryTransformer;
use App\Enquiry;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $filter = $request->get('filter');

        $query = Enquiry::where(function($query) use($user) {
            $query->where('from',$user->id)
            ->orWhere('to',$user->id);
        });
        if ($filter) {
            $query = $query->where('type',$filter);
        }

        $ordered = $query->orderBy('id','DESC')->get();
        $resources = $ordered->groupBy('group');

        return response()->json([
            'status' => 'true',
            'data' => fractal()
            ->collection($resources)
            ->transformWith(new EnquiryTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }

    public function show(Request $request ,$group)
    {
        $user = $request->user();

        $index = $request->get('index');
        $resources = null;

        if ($index) {
            $limit = 10 * $index;
            $messages_count = Enquiry::where('group',$group)->count();
            $resources =  Enquiry::where('group',$group)->where(function($query) use($user) {
                $query->where('from',$user->id)
                ->orWhere('to',$user->id);
            })->skip($messages_count - $limit)
            ->take($limit)->get();
        }else{
            $resources =  Enquiry::where('group',$group)->where(function($query) use($user) {
                $query->where('from',$user->id)
                ->orWhere('to',$user->id);
            })->get();
        }

        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->collection($resources)
            ->transformWith(new EnquiryTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()['data'],
        ],200);
    }

    public function newChat(Request $request)
    {
        $user = $request->user();
        $input = $request->all();
        // 'message' ,'to' ,'title' ,'type'

        $input['group'] = str_random(30);
        $input['from'] = $user->id;

        Enquiry::create($input);

        return response()->json([
            'status' => 'true',
            'message' => 'Message sent successfully'
        ],200);
    }

    public function reply(Request $request ,$group)
    {
        $user = $request->user();
        $input = $request->all();
        // 'message' ,'to'

        $chat =  Enquiry::where('group',$group)->where(function($query) use($user) {
            $query->where('from',$user->id)
            ->orWhere('to',$user->id);
        })->first();

        if (!$chat) {
            return response()->json([
                'status' => 'false',
                'error' => 'Unauthorized to do this action.',
            ],403);
        }

        $input['from'] = $user->id;
        $input['group'] = $chat->group;
        $input['type'] = $chat->type;
        $input['title'] = $chat->title;

        Enquiry::create($input);

        return response()->json([
            'status' => 'true',
            'message' => 'Message sent successfully'
        ],200);
    }
}
