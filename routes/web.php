<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\member;
use App\Http\Controllers\Order;
use App\Http\Controllers\updateorder;
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


Route::get('customer',[member::class,'customer']);

// Customer
Route::post('customer_Add',[member::class,'customer_add']);
Route::post('customer_Update',[member::class,'customer_update']);
Route::post('customer_Delete',[member::class,'customer_delete']);



Route::get('orders',[Order::class,'orders']);


Route::any('updateorder/{id}',[updateorder::class,'updateorder']);



Route::put('/test2/{id}', [updateorder::class,'test2']);

// Route::any('updateorder',[updateorder::class,'testorder']);


Route::any('webhooks',[updateorder::class,'webhooks']);


Route::get('test',function(){


     return session('data');
});


