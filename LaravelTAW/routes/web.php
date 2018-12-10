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
#Ruta welcome
Route::get('/', function () {
    return view('welcome');
});
#Rutas de autorizacion
Auth::routes();
#Ruta home
Route::get('/home', 'HomeController@index')->name('home');
#Rutas resources projects
Route::resource('projects', 'ProjectsController');
#Ruta buscar proyectos
Route::get('/search_projects', 'ProjectsController@search')->name('search_projects');
#Ruta para crear propuesta
Route::get('/projects/{id}/create_prop', 'ProjectsController@create_prop');
Route::post('/projects/{id}/create_prop', 'ProjectsController@create_prop_store');
Route::patch('/projects/{id}/create_prop', 'ProjectsController@create_prop_update');
Route::put('/projects/{id}/acept_prop', 'ProjectsController@acept_prop');
Route::put('/projects/{id}/end_project', 'ProjectsController@end_project');
#Rutas de usuarios
#Perfil
Route::get('/user/{id}/profile', 'UsersController@index');
Route::put('/user/profile/edit_desc', 'UsersController@edit_desc');
#Propuestas del usuario
Route::get('/user/propuestas', 'UsersController@propuestas');
#Foto de perfil
Route::post('/user/profile/edit_foto', 'UsersController@edit_foto');
#Todos los freelancers
Route::get('/freelancers', 'UsersController@freelancers')->name('freelancers');
#Ruta a show freelancer
Route::get('/user/{id}/freelancer', 'UsersController@show_freelancer');
