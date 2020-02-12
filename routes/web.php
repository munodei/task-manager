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

Route::get('/', function () {
    return view('welcome');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//->middleware('auth');


Route::middleware(['auth'])->group(function () {

    Route::resource('companies', 'CompaniesController');

    Route::get('projects/create/{company_id?}', 'ProjectsController@create');
    Route::post('/projects/adduser', 'ProjectsController@adduser')->name('projects.adduser');
    Route::resource('projects', 'ProjectsController');

    Route::resource('roles', 'RolesController');

    Route::resource('tasks', 'TasksController');
    Route::post('task-update/{task}',['uses'=>'TasksController@update','as'=>'task-update']);
    Route::get('add-task-to-group/{project_id}/{group_id}',['uses'=>'TasksController@addTaskToGroup','as'=>'add-task-to-group']);
    Route::any('/task/adduser', 'TasksController@addUser')->name('task.adduser');

    Route::resource('task-groups', 'TaskGroupsController');
    Route::post('task-group-update/{task}',['uses'=>'TaskGroupsController@update','as'=>'task-group-update']);
    Route::get('task-group/create/{project_id}',['uses'=>'TaskGroupsController@create','as'=>'create-task-group']);
    Route::get('project/task-groups/{project_id}',['uses'=>'TaskGroupsController@index','as'=>'project-task-groups']);
    Route::any('/task-group/adduser', 'TaskGroupsController@addUser')->name('task-group.adduser');

    Route::resource('task-notes', 'TaskNotesController');
    Route::resource('users', 'UsersController');

    Route::resource('comments', 'CommentsController');
    Route::any('/add-task-comment',['uses'=>'CommentsController@addTaskComment' ,'as'=>'add-task-comment']);
    Route::get('/show-comment/{id}',['uses'=>'CommentsController@showComments' ,'as'=>'show_comments']);

});
