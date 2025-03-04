<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('/', function () {
    return 'Hello world!';
});
Route::post('/user', [UserController::class, 'addUser']);
Route::post('/category', [CategoryController::class, 'addCategory']);
Route::post('/news', [NewsController::class, 'addNews']);


Route::get('/users', [UserController::class, 'listUsers']);
Route::get('/categories', [CategoryController::class, 'listCategories']);
Route::get('/news', [NewsController::class, 'listNews']);

Route::get('/user/{id}', [UserController::class, 'listUser']);
Route::get('/category/{id}', [CategoryController::class, 'listCategory']);
Route::get('/news/{id}', [NewsController::class, 'listNew']);

Route::put('/user/{id}', [UserController::class, 'updateUser']);


Route::delete('/user/{id}', [UserController::class, 'deleteUser']);

// Route::middleware('auth:sanctum')->get('/', function (Request $request) {
//     return $request->user();
// });
