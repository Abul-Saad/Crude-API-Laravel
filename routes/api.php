<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/testapi', function(){
    return ['name'=>'Saad Coder','email'=>'saad@gmail.com','phone'=>'741258963'];
});


Route::get('listApi',[CustomerController::class,'listApi']);
Route::post('addApi',[CustomerController::class,'addApi']);
Route::put('updateApi/{id}',[CustomerController::class,'updateApi']);
Route::delete('deleteApi/{id}',[CustomerController::class,'deleteApi']);

//here is Resources Crud
Route::resource('crudApi',CrudController::class);