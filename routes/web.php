<?php

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

use App\Http\Middleware\admin;
use App\Http\Middleware\Authenticate;
use App\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::get('test',function (){
   return view('index');
});


Route::resource('/users/post','UsersPostsController');

Route::resource('/users/comment','commentController');

Route::resource('/users/comment/reply','CommentReplyController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('/admin/users','adminUsersController')->middleware(admin::class);
Route::resource('/admin/posts','adminPostController')->middleware(admin::class);
Route::resource('/admin/category','adminCategoryController')->middleware(admin::class);
Route::resource('/admin/comment','adminCommentController')->middleware(admin::class);






