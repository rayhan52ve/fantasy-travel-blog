<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\App;


//frontend
Route::namespace('App\Http\Controllers')->group(function(){
    Route::get('/','IndexController@frontend')->name('frontend');

    // Route::middleware(['admin' , 'auth'])->group(function () {
        Route::get('/category','IndexController@category')->name('category');
        Route::get('/categoryChield/{id}','IndexController@categoryChield')->name('categoryChield');
        Route::get('/archive','IndexController@archive')->name('archive');
        Route::get('/post-details/{id}','IndexController@postDetails')->name('postDetails');
        Route::get('/contact','IndexController@contact')->name('contact');
        Route::get('/ct-store','ContactController@store')->name('contact.store');
        Route::get('/comment','CommentController@store')->name('comment.store');
        Route::post('comment-delete','CommentController@destroy')->name('comment.destroy');
        Route::post('comment-delete-admin','CommentController@adminDestroy')->name('adminComment.destroy');
    // });
  
});


//admin
Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    Route::match(['get','post'],'/',[AdminController::class,'login'])->name('login');
    
    Route::group(['middleware' => ['admin']],function(){
        
        Route::get('logout', 'AdminController@logout')->name('logout');
        Route::get('/dashboard', 'AdminController@dashboard')->name('dashboard');

        Route::get('profile','AdminController@profile')->name('profile');
        Route::get('profile-edit','AdminController@profile_edit')->name('profile_edit');
        Route::post('profile-update','AdminController@profile_update')->name('profile_update');


        
        Route::resource('post','PostController',['names'=>'posts']);
        Route::resource('category','CategoryController',['names'=>'categories']);
        Route::get('get-all-getSubcategory','CategoryController@getSubcategory')->name('categories.getSubcategory');
        Route::get('get-all-category','PostController@getAllCategory')->name('getAllCategory');
        Route::get('get-all-post','TagController@getAllPost')->name('getAllPost');
        Route::resource('tag','TagController',['names'=>'tags']);
        Route::resource('menu','MenuController',['names'=>'menues']);

    });
});

//User
Route::prefix('/')->namespace('App\Http\Controllers\User')->group(function(){
    Route::match(['get','post'],'/user',[UserController::class,'userlogin'])->name('userlogin');
    Route::match(['get','post'],'register',[UserController::class,'register'])->name('register');

    Route::group(['middleware' => ['auth']],function(){
        Route::get('Userlogout', 'UserController@Userlogout')->name('Userlogout');

        Route::get('/user-dashboard', 'UserController@userDashboard')->name('userDashboard');
        Route::get('userprofile-edit','UserController@user_edit')->name('user_edit');
        Route::post('userprofile-update{id}','UserController@user_update')->name('user_update');

        Route::get('change-pass','UserController@password')->name('password');
        Route::post('change-pass','UserController@changePassword')->name('changePassword');
    });
});










