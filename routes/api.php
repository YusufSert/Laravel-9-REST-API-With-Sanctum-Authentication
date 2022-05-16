<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;


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

// Route::resource('products', ProductController::class);


// Public  Routes

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/products/search/{name}', [ProductController::class, 'search']);
Route::post('/register', [AuthController::class, 'register']);

// Admin routes
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/login', [AdminController::class, 'viewLogin']);

Route::get('/admin/edit', [AuthController::class, 'AdminEdit']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    
    
    
    
    // User Protected Routes
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/user/edit', [AuthController::class, 'edit']);
    Route::post('/user/update', [AuthController::class, 'store']);

    // Admin Protected Routes
    Route::get('/admin/profile', [AuthController::class, 'AdminProfile']);
   
});


/// test
//Route::post('/user/updatepicture', [AuthController::class, 'updatePicture']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

