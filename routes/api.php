<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CategoryController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

 Route::group(['middleware'=>['auth:sanctum']],function(){
   
    Route::post('logout',[AuthController::class,'logout']);
    
    Route::get('posts_archive',[PostController::class,'posts_archive'])->name('posts_archive');
    Route::get('fetch_archive/{user_id}',[PostController::class,'fetch_archive']);
    Route::get('users_archive',[UserController::class,'users_archive'])->name('users_archive');
    
   Route::post('category',[CategoryController::class,'addCategory']);
   Route::delete('category/{id}',[CategoryController::class,'deleteCategory']);

   Route::apiResource('posts',PostController::class)->except(['index','show']);
   Route::apiResource('users',UserController::class);
   Route::get('users/restore/{id}',[UserController::class,'restore']);
   Route::get('users/force_delete/{id}',[UserController::class,'force_delete']);

   Route::get('users/restore/{id}',[PostController::class,'restore']);
   Route::get('users/force_delete/{id}',[PostController::class,'force_delete']);
   
   Route::apiResource('comments',CommentController::class)->only('store');
  
} );

// Route::apiResource('posts',PostController::class);
// Route::apiResource('users',UserController::class);
Route::apiResource('posts',PostController::class)->only(['index','show']);
Route::get('getPostsByCategory/{id}',[PostController::class,'getPostsByCategory']);
Route::post('is_login',[AuthController::class,'is_login']);

Route::get('search/{search}',[PostController::class,'search'])->name('search');
Route::get('posts_profile/{user_id}',[PostController::class,'posts_profile'])->name('posts_profile');

Route::get('comments_users/{postId}',[CommentController::class,'getCommentsAndUsersOfPost'])->name('getCommentsAndUsersOfPost');


Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
});
// Route::post('logout',[AuthController::class,'logout']);
