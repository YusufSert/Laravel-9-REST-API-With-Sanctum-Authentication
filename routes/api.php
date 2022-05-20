<?php

use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Models\Admin;
use App\Models\SubCategory;

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


// Admin routes
Route::post('/admin/login', [AdminController::class, 'login']);
Route::get('/admin/login', [AdminController::class, 'viewLogin']);
Route::get('/admin/profile', [AdminController::class, 'AdminProfile']);
Route::get('/admin/edit', [AdminController::class, 'AdminEdit']);
Route::post('/admin/store', [AdminController::class, 'AdminStore']);


// Public User Routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);



// Category Controller

Route::post('/category/add', [CategoryController::class, 'addCategory']);
Route::get('/category/view', [CategoryController::class, 'viewCategory']);




// SubCategort Controller
Route::post('/subcategory/add',[SubCategoryController::class, 'addSubCategory']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/products', [ProductController::class, 'store']);
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    
    
    
    
    
    // User Protected Routes
    Route::post('/user/edit', [AuthController::class, 'edit']);
    Route::post('/user/update', [AuthController::class, 'store']);
    Route::post('/logout', [AuthController::class, 'logout']);


    // Admin Protected Routes
    //Route::get('/admin/profile', [AuthController::class, 'AdminProfile']);
    
   
});


/// test
//Route::post('/user/updatepicture', [AuthController::class, 'updatePicture']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

