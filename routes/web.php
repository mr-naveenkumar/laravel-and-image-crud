<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ImageController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// This is for  show some page 
Route::get("hi",function(){
    return 'whatup';
});

// Index page show
Route::get("show-page",[ImageController::class,"showPage"]);

// show create page 
Route::get("create-page",function(){
     return view("image.create");
});

// insert data with images
Route::post("insert-image",[ImageController::class,"insertImage"]);

// edit image 
Route::get("edit-image/{id}",[ImageController::class,"editImage"]);

// now it is image update Page 
Route::put("update-image/{id}",[ImageController::class,"imageUpdate"]);

// To delete data images 
Route::delete("delete-image-data/{id}",[ImageController::class,"deleteImageData"])->name("post.delete");
