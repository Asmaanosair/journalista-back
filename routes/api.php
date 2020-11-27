<?php

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::namespace('api')->group(function () {
    Route::post('/register', 'UserController@register');
    Route::post('/verification/{id}/{code}','UserController@verification');
    Route::post('/pin/{id}/{pin}', 'UserController@pin');
    Route::post('/login', 'UserController@login');

    Route::group(['middleware'=>['jwt.auth']], function () {
        Route::post('/get-profile', 'UserController@getProfile');
        Route::post('/edit-profile', 'UserController@editProfile');
        Route::post('/allNews', 'NewsController@News');
        Route::post('/articles', 'NewsController@Articles');
        Route::get('/article/{id}', 'NewsController@Article');
        Route::post('/news_links', 'NewsController@NewsLink');
        Route::get('/allNews', 'NewsController@allNews');
        Route::post('/chat/getAllChat', 'ChatController@getAllChat');
        Route::post('/chat/getChat/{friend_id}', 'ChatController@getChat');
        Route::post('/chat/sendChat', 'ChatController@sendChat');
        Route::post('/jobs', 'JobController@index');
        Route::post('/jobs/{id}', 'JobController@show');
        Route::post('/favourite_jobs/{job_id}', 'Favourite_jobController@store');
        Route::post('/apply_job/{job_id}', 'JobController@applyJob');
        Route::post('/organizations', 'SearchController@Organization');
        Route::post('/topics', 'SearchController@Topics');
        Route::post('/tags', 'SearchController@Tags');
        Route::post('/search', 'SearchController@Search');
        Route::get('/all_users', 'UserController@getAllUsers');
        Route::post('/get_location', 'UserController@getLocation');
        Route::post('/help', 'HelpController@help');
        Route::post('/notifications', 'HelpController@notifications');

    });


});
