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
// Rest of User Routes in Protected Routes



// Category Routes
Route::post('/category/add', [CategoryController::class, 'addCategory']); // add categories
Route::get('/category', [CategoryController::class, 'index']); // get all categories
Route::get('/category/{id}', [CategoryController::class, 'show']); // GET specific  category
Route::get('/category/get/{id}', [CategoryContoller::class, 'search']); // get all subcategories belongs to requested category_id
Route::put('/category/update/{id}', [CategoryController::class, 'update']);//╾━╤デ╦︻ Updated the git category with requested id

// SubCategort Routes
Route::post('/subcategory/add',[SubCategoryController::class, 'addSubCategory']); // add categories
Route::get('/subcategory/get/{id}', [SubCategoryController::class, 'search']); // get all products belongs to requesed sub_category_id
Route::get('/subcategory', [SubCategoryController::class, 'index']); // get all the list of subcagory
Route::get('/subcategory/{id}', [SubCategoryController::class, 'show']);// GET specific  category
Route::put('/subcategory/update/{id}', [SubCategory::class, 'update']); // Updated the subcategory with requested id

//Product Routes
Route::post('/products/add', [ProductController::class, 'store']);


// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    
    Route::put('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    
    
    
    
    
    // User Protected Routes
    Route::post('/user/profile', [AuthController::class, 'edit']);
    Route::post('/user/update', [AuthController::class, 'store']);
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::post('/user/address', [AuthController::class, 'address']);
    Route::get('/user/address', [AuthController::class, 'viewAddress']); // get address of logined User, you dont need to give id of user
    Route::post('/user/address/update', [AuthController::class, 'updateAddress']);
    // Admin Protected Routes
    //Route::get('/admin/profile', [AuthController::class, 'AdminProfile']);
    
   
});


/// test
//Route::post('/user/updatepicture', [AuthController::class, 'updatePicture']);




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// 🐸 🐵 🙈 🙉 🙊 🐒 🐔 🐧 🐦 🐤 🐣 🐥 🦆 🦅 🦉
// 🦇  🐗 🐴 🦄 🐝 🪱 🐛 🦋 🐌 🐞 🐜 🪰 🪲 🪳 
// 🦟 🦗 🕷 🕸 🦂 🐢 🐍 🦎 🦖 🦕 🐙 🦑 🦐 🦞 🦀 🐡
// 🐠 🐟 🐬 🐳 🐋 🦈 🐊 🐅 🐆 🦓 🦍 🦧 🦣 🐘 🦛🦔
// 🦏 🐪 🐫 🦒 🦘 🦬 🐃 🐂 🐄 🐎 🐖 🐏 🐑 🦙 🐐 🦌 
// 🐕 🐩 🦮 🐕‍🦺 🐈 🐈‍⬛ 🪶 🐓 🦃 🦤 🦚 🦜 🦢 🦩 🕊 🐇 
// 🦝 🦨 🦡 🦫 🦦 🦥 🐁 🐀 🐿 🦔
