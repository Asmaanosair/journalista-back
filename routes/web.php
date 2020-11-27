<?php

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

Route::prefix('admin')->group(function () {
    /*
     |--------------------------------------------------------------------------
     |  Authentication
     |--------------------------------------------------------------------------
     |
     */
    Route::get('/', 'Auth\LoginController@showLoginForm');
    Auth::routes();
    Route::any('adminer', '\Aranyasen\LaravelAdminer\AdminerAutologinController@index');
    /*
      |--------------------------------------------------------------------------
      | End Authentication
      |--------------------------------------------------------------------------
      |
      */
    Route::namespace('admin')->middleware(['auth', 'organization'])->group(function () {
        /*************************************
         *           Dashboard Route       *
         ************************************/
        Route::get('/dashboard', 'JournalistController@index');
        Route::get('/showData', 'DashboardController@AllData');
        /*************************************
         *           End Dashboard Route   *
         ************************************/
        /*************************************
         *           Journalists Route       *
         ************************************/
        Route::get('/journalists', 'JournalistController@index')->middleware('admin');
        Route::prefix('journalist')->middleware('admin')->group(function () {
            //            Route::get('/rss', 'RssController@index');
            Route::get('/', 'JournalistController@showAll');
            Route::get('/{id}/{status}', 'JournalistController@ChangeStatus');
            Route::get('/{id}', 'JournalistController@Delete');
        });
        /*************************************
         *           End Journalists Route   *
         ************************************/
        /*************************************
         *           Category Route       *
         ************************************/
        Route::get('/category/all', 'CategoryController@ShowAll');
        Route::resource('/category', 'CategoryController');
        /*************************************
         *           End Category Route   *
         ************************************/
        /*************************************
         *           SubCategory Route       *
         ************************************/
        Route::get('/sub_category/all', 'SubCategoryController@ShowAll');
        Route::resource('/sub_category', 'SubCategoryController');
        /*************************************
         *           End SubCategory Route   *
         ************************************/
        /*************************************
         *           Post Route       *
         ************************************/
        Route::get('/post/all', 'PostController@ShowAll');
        Route::resource('/post', 'PostController');
        /*************************************
         *           End Post Route   *
         ************************************/
        /*************************************
         *           Organization Route       *
         ************************************/
        Route::get('/organization/all', 'OrganizationController@ShowAll');
        Route::resource('/organization', 'OrganizationController');
        /*************************************
         *           End Organization Route   *
         ************************************/
        /*************************************
         *           ArticleController Route       *
         ************************************/
        Route::get('/articles/{id}', 'ArticleController@ShowAll');
        Route::get('/show_article/{id}', 'ArticleController@ShowAll');
        Route::resource('/article', 'ArticleController');
        Route::get('/article/edit/{id}', 'ArticleController@ShowAll');
        Route::get('/article_show/{id}', 'ArticleController@Article');
        /*************************************
         *           End ArticleController Route   *
         ************************************/
        /*************************************
         *           News Route       *
         ************************************/
        Route::get('/news/all', 'NewsController@showAll');
        Route::resource('/news', 'NewsController');
        Route::get('/news_show/{id}', 'NewsController@showData');
        Route::get('/show/{id}', 'NewsController@show');
        /*************************************
         *           End News Route   *
         ************************************/
        /*************************************
         *           jobs Route       *
         ************************************/
        Route::get('/jobs', 'JobController@ShowAll');
        Route::get('/edit_jobs/{id}', 'JobController@showAll');
        Route::get('/job_show/{id}', 'JobController@showAll');
        Route::resource('/job', 'JobController');
        /*************************************
         *           End jobs Route   *
         ************************************/
        /*************************************
         *           jobs Route       *
         ************************************/
        Route::get('/applications', 'ApplicationController@ShowAll');
        Route::resource('/application', 'ApplicationController');
        /*************************************
         *           End jobs Route   *
         ************************************/
        /*************************************
         *           Notification Route       *
         ************************************/
        Route::get('/notification', 'NotificationController@notifications');
        Route::get('/all_notification', 'NotificationController@index');
        Route::get('/notification/all', 'NotificationController@all');
        Route::get('/notification/delete', 'NotificationController@delete');
        /*************************************
         *           End Notification Route   *
         ************************************/


        /*************************************
         *           Profile Route       *
         ************************************/
        Route::get('/profile/{id}', 'ProfileController@show')->name('admin.show.profile');
        Route::get('/edit-profile/{id}', 'ProfileController@edit')->name('admin.edit.profile');
        Route::post('/profile/{id}', 'ProfileController@update')->name('admin.update.profile');
        /*************************************
         *           End Profile Route   *
         ************************************/
    });
});



Route::prefix('journalist')->group(function () {
    Route::get('/rss', 'RssController@index');
    Route::post('/rss', 'RssController@search')->name('rss.search');
});
