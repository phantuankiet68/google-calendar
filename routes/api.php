<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\EventController;
use App\Http\Controllers\API\AboutController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
});
Route::controller(CategoryController::class)->group(function(){
    Route::get('/category','index');
    Route::post('/category/create','create');
    Route::get('/category/list/','list');
    Route::delete('/category/delete/{id}','delete');
    Route::get('/category/edit/{id}','edit');
    Route::put('/category/edit/{id}','update');
});
Route::controller(EventController::class)->group(function(){
    //Route::get('/home','index');
    Route::get('/home','index');
    Route::post('/event/create','create');
    Route::get('/home/search','search');
});

Route::resource('event',EventController::class);

Route::controller(AboutController::class)->group(function(){
    //Route::get('/home','index');
    Route::get('/home/edit_about','edit_about');
});