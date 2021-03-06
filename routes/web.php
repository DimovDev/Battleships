<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/',['as'=>'pages.index','uses'=>'GameController@indexAction' ]);
Route::get('/play',['as'=>'pages.play','uses'=>'GameController@playGame' ]);
Route::post('/play',['as'=>'pages.play','uses'=>'GameController@shotAction' ]);


