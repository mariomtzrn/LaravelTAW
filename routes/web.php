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
#Rutas de usuarios
#Perfil
Route::get('/user/profile', 'UsersController@index')->name('profile');
#Propuestas del usuario
Route::get('/user/{id}/propuestas', 'UsersController@propuestas');
#Todos los freelancers
Route::get('/freelancers', 'UsersController@freelancers')->name('freelancers');
#Ruta a show freelancer
Route::get('/user/{id}/freelancer', 'UsersController@show_freelancer');
