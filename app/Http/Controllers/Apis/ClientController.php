<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Apis\ClientUpdateRequest;
use App\Transformers\ClientTransformer;
use App\Transformers\PromoCodeTransformer;
use App\Models\Contact;
use App\User;
use App\Models\AboutUs;
use App\PromoCode;

class ClientController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user();
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($user)
            ->transformWith(new ClientTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function edit(ClientUpdateRequest $request)
    {
        $user = $request->user();
        $user->update($request->all());
        return response()->json([
            'status' => 'true',
            'data'=>fractal()
            ->item($user)
            ->transformWith(new ClientTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray(),
        ],200);
    }

    public function userPromoCodes(Request $request)
    {
        $promoCodes = PromoCode::where('user_id',$request->user()->id)->get();
        return response()->json(
           fractal()
            ->collection($promoCodes)
            ->transformWith(new PromoCodeTransformer)
            ->serializeWith(new \League\Fractal\Serializer\ArraySerializer())
            ->toArray()
        ,200);
    }

    public function contactUs(Request $request)
    {
        $data = $request->all();
        $createContact = Contact::create($data);
        return response()->json([
            'success' => ['your message has been submited.'],
        ],200);
    }
    public function aboutUs(Request $request)
    {
        $about = AboutUs::first();
        return response()->json([
            'about' => $about,
        ],200);
    }
}
