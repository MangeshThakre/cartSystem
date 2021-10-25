<?php

use Illuminate\Support\Facades\Route;
use  App\Http\controllers\dbcontroller;
use App\Http\controllers\registerController;


// /// cartcontroller//
use App\http\controllers\cartcontroller;
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






Route::get('/register',[registerController::class,'show']);

Route::post('/register',[dbcontroller::class,'registerValue']);


Route::get('/login',[registerController::class,'showlogin']);

Route::post('/account',[dbcontroller::class,'loginValue']);



Route::get('/account',[dbcontroller::class,'account']);

Route::get('/logout',[dbcontroller::class,'logout']);

//landing page
 
Route::get('/',[registerController::class,'landing_page']);


////////cart /////
Route::get('/cart',[cartcontroller::class,'cart']);
/////cart database
Route::post('cartpost',[cartcontroller::class,'AddtoCart']);


//// item count sub (-)///
Route::post('sub',[cartcontroller::class,'sub']);

////item count add //
Route::post('add',[cartcontroller::class,'add']);

///item remove ///
Route::post('remove',[cartcontroller::class,'remove']); 



//COUNT
Route::get('count',[cartcontroller::class,'count']);

//getcount///
Route::get('buy',[cartcontroller::class,'buy']);

// ///    store order data in database///
Route::get('order',[cartcontroller::class,'order']);


////get order data in acount
// Route::get('/account',[cartcontroller::class,'orderget']);