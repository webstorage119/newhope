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

// Routes not handled by SPA
// <TODO:>Replace all these routers with api</TODO:>
Route::get('submit', 'StaticPagesController@submit_by_file')->name('submit');
Route::any('judge', 'StaticPagesController@judge')->name('judge');

Route::get('signup', 'UsersController@create')->name('signup');

Route::resource('announcements', 'AnnouncementsController', ['only' => ['store', 'update', 'destroy']]);
Route::resource('topics', 'TopicsController', ['only' => ['store', 'update', 'destroy']]);
Route::resource('problems', 'ProblemsController', ['only' => ['store', 'update', 'destroy']]);

Route::resource('replies', 'RepliesController', ['only' => ['store', 'destroy']]);

Route::get('problems/{problem}/topics', 'ProblemsController@show_topics')->name('problem.topics');

Route::post('notifications/{notification}', 'NotificationsController@read_one')->name('notifications.read_one');

Route::post('/contests/{contest}', 'ContestsController@add_user_by_password')->name('contests.add_user_by_password');


// All the rests handled by SPA
Route::get('/{any}', 'StaticPagesController@home')->where('any', '.*');
