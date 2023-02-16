<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Event as EventResource;

class EventController extends Controller
{
    public function index(){

        $events= Event::get((['title','start_date','end_date']));

        $categories = Category::get();

        return response()->json([
            'events' => $events,
            'categories' => $categories,
        ]);

    }
    public function search(Request $request){
        $events = Event::where('title','like','%' .$request->search. '%')->get()->toArray();
        if($events){
            return array_reverse($events);
        }
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'start_date'=> 'required',
            'end_date'=> 'required',
            'color'=> 'required',
            'choose'=> 'required',
            'notify'=> 'required',
            'user_id'=> 'required',
            'category_id'=> 'required'
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $catagory = Event::create([
                'title' => $request->title,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'color' => $request->color,
                'choose' => $request->choose,
                'notify' => $request->notify,
                'user_id'=> $request->user_id,
                'category_id' => $request->category_id,

            ]);
            if($catagory ){
                return response()->json([
                    'status' => 200,
                    'message' => 'Category create sucessfully',
                ],200);
            }
            else{
                return response()->json([
                    'status' => 500,
                    'message' => 'Something Went Wrong',
                ],500);
            }
        }
    }
    public function edit($id){
        $category = Category::find($id);
        if($category ){
            return response()->json([
                'status' => 200,
                'category' => $category,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
}
