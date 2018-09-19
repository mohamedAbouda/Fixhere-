<?php

namespace App\Http\Controllers\Apis;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\FAQ;

class FAQController extends Controller
{
    public function index()
    {
        $faqs = FAQ::get();
        return response()->json([
            'status' => 'true',
            'data' => $faqs
        ],200);
    }
}
