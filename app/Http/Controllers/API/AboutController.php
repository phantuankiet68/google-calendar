<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
class AboutController extends Controller
{
    public function edit_about(){
        $about = About::orderBy('id','desc')->first();
        return response()->json($about);
     }
}
