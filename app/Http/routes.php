<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

#Route::get('/admin', 'AdminController@index', ['middleware' => ['auth', 'admin']]);

Route::get('admin/peticoes',             ['as'=>'peticaos.index',     'uses' => 'PeticaoController@index',   'middleware' => ['auth', 'admin']]);
Route::get('admin/peticoes/create',      ['as'=>'peticaos.create',    'uses' => 'PeticaoController@create',  'middleware' => ['auth', 'admin']]);
Route::post('admin/peticoes/create',     ['as'=>'peticaos.store',     'uses' => 'PeticaoController@store',   'middleware' => ['auth', 'admin']]);
Route::get('/{id}',                      ['as'=>'peticaos.show',      'uses' => 'PeticaoController@show']);
Route::get('admin/peticoes/{id}/edit',   ['as'=>'peticaos.edit',      'uses' => 'PeticaoController@edit',    'middleware' => ['auth', 'admin']]);
Route::patch('admin/peticoes/{id}',      ['as'=>'peticaos.update',    'uses' => 'PeticaoController@update',  'middleware' => ['auth', 'admin']]);
Route::delete('admin/peticoes/{id}',     ['as'=>'peticaos.destroy',   'uses' => 'PeticaoController@destroy', 'middleware' => ['auth', 'admin']]);
Route::get('admin/peticoes/export/{id}', ['as'=>'peticaos.export',    'uses' => 'PeticaoController@export',   'middleware' => ['auth', 'admin']]);

Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');

Route::post('/mail/send',    'EmailController@send');
Route::post('/assinar',      'AssinanteController@store');
Route::post('/comentar',     'ComentarioController@store');