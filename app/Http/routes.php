<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','HomeController@home');

Route::get('/dashboard','HomeController@dashboard');

Route::get('profile', 'Auth\AuthController@show');
Route::get('profile/edit', 'Auth\AuthController@edit');
Route::post('profile/edit', 'Auth\AuthController@update');
Route::post('profile/edit/picture', 'Auth\AuthController@picture');

// Authentication routes
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@logout');

// Registration routes
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Tasks routes
Route::get('project/tasks', 'ProjectController@pdf');
Route::get('project/{id}/tasks', 'TaskController@index');


Route::get('project/{id}/tasks/search', 'TaskController@index');
Route::post('project/{id}/tasks/search', 'TaskController@search');
Route::get('project/{id}/tasks/create', 'TaskController@create');
Route::post('project/{id}/tasks/create', 'TaskController@store');
Route::get('project/{id}/tasks/ended', 'TaskController@showEnded');
Route::get('project/{id}/tasks/pending', 'TaskController@showPending');
Route::get('project/{id}/tasks/sort/title', 'TaskController@byTitle');
Route::get('project/{id}/tasks/sort/begin', 'TaskController@sortBeg');
Route::get('project/{id}/tasks/sort/end', 'TaskController@sortEnd');
Route::get('project/{id}/tasks/{task_id}/edit', 'TaskController@edit');
Route::post('project/{id}/tasks/{task_id}/edit', 'TaskController@update');
Route::get('project/{id}/tasks/{task_id}/file/{file_id}/delete', 'TaskController@deleteFile');
Route::get('project/{id}/tasks/{task_id}/file', 'TaskController@getFile');
Route::post('project/{id}/tasks/{task_id}/file', 'TaskController@uploadfile');
Route::post('project/{id}/tasks/{task_id}/comment', 'CommentController@commentTask');
Route::get('project/{id}/tasks/{task_id}/delete', 'TaskController@delete');
Route::get('project/{id}/tasks/{task_id}/end','TaskController@endTask');
Route::get('project/{id}/tasks/{task_id}/validate','TaskController@validateTask');
Route::get('project/{id}/tasks/{task_id}/cancel','TaskController@cancelEnd');
Route::get('project/{id}/tasks/{task_id}', 'TaskController@show');


// Project routes
Route::get('project/create', 'ProjectController@create');
Route::post('project/create', 'ProjectController@store');
Route::get('project/all','ProjectController@index');
Route::get('project/sort/ended','ProjectController@indexEnded');
Route::get('project/sort/pending','ProjectController@indexPending');
Route::get('project/sort/cancelled','ProjectController@indexCanceled');
Route::get('project/{id}/end','ProjectController@end');
Route::get('project/{id}/validate','ProjectController@validateProject');
Route::get('project/{id}/cancel','ProjectController@cancel');
Route::get('project/{id}/restore','ProjectController@restore');
Route::get('project/{id}/delete','ProjectController@delete');
Route::get('project/{id}/edit', 'ProjectController@edit');
Route::post('project/{id}/edit', 'ProjectController@update');
Route::post('project/{id}/comment', 'CommentController@commentProject');
Route::get('project/{id}/historic', 'ProjectController@historic');
Route::get('project/{id}/files', 'ProjectController@files');
Route::get('project/{id}', 'ProjectController@show');

// Meeting routes
Route::get('meeting/show','MeetingController@showall');
Route::get('meeting/all', 'MeetingController@index');
Route::get('meeting/pending', 'MeetingController@pending');
Route::get('meeting/create', 'MeetingController@create');
Route::post('meeting/create','MeetingController@store');
Route::get('meeting/{id}/edit', 'MeetingController@edit');
Route::post('meeting/{id}/edit','MeetingController@update');
Route::get('meeting/{id}/delete', 'MeetingController@destroy');
Route::get('meeting/{id}/valide', 'MeetingController@valide');
Route::get('meeting/show', 'MeetingController@showAll');


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});
