<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::get('@{username}', [UserController::class, 'show'])->name('user.show');

Route::get('/search', [HomeController::class, 'search'])->name('user.search');

Route::middleware('auth')->group(function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    Route::get('/user/edit', [UserController::class, 'edit'])->name('user.profile.edit');
    Route::put('/user/edit', [UserController::class, 'update'])->name('user.profile.update');
    
    Route::resource('/post', PostController::class);
    
    //follow and unfollow
    Route::get('/follow/{following_id}', [UserController::class, 'follow'])->name('user.follow');

    //like and unlike
    Route::get('/like/{post_id}', [LikeController::class, 'toggleLike'])->name('user.like');    

    // comments
    Route::post('/comment/{post_id}', [CommentController::class, 'store'])->name('comment.store');
    Route::get('/comment/{comment_id}/edit', [CommentController::class, 'edit'])->name('comment.edit');
    Route::put('/comment/{comment}', [CommentController::class, 'update'])->name('comment.update');
    Route::get('/comment/{comment_id}/delete', [CommentController::class, 'delete'])->name('comment.delete');
});


