<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

Route::post('/like/{user}/{post}', [LikeController::class, 'add'])->name('like');
Route::get('/my-posts', [PostController::class, 'showUserPosts'])->name('my-posts');
Route::get('/{post}/comments', [CommentController::class, 'index'])->name('comments');
Route::post('/{post}/comment/store', [CommentController::class, 'store'])->name('comment.store');
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
// Route::get('/posts/results', [PostController::class, 'results'])->name('posts.results');

Route::resource('posts', PostController::class);
