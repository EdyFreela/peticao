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

Route::get('/', 'WelcomeController@index');

Route::auth();

#Route::get('/admin', 'AdminController@index', ['middleware' => ['auth', 'admin']]);

Route::get('admin/peticoes',             ['as'=>'peticaos.index',     'uses' => 'PeticaoController@index',   'middleware' => ['auth', 'admin']]);
Route::get('admin/peticoes/create',      ['as'=>'peticaos.create',    'uses' => 'PeticaoController@create',  'middleware' => ['auth', 'admin']]);
Route::post('admin/peticoes/create',     ['as'=>'peticaos.store',     'uses' => 'PeticaoController@store',   'middleware' => ['auth', 'admin']]);
Route::get('/{id}',                      ['as'=>'peticaos.show',      'uses' => 'PeticaoController@show']);
Route::get('admin/peticoes/{id}/edit',   ['as'=>'peticaos.edit',      'uses' => 'PeticaoController@edit',    'middleware' => ['auth', 'admin']]);
Route::patch('admin/peticoes/{id}',      ['as'=>'peticaos.update',    'uses' => 'PeticaoController@update',  'middleware' => ['auth', 'admin']]);
Route::delete('admin/peticoes/{id}',     ['as'=>'peticaos.destroy',   'uses' => 'PeticaoController@destroy', 'middleware' => ['auth', 'admin']]);
Route::get('admin/peticoes/export/{id}', ['as'=>'peticaos.export',    'uses' => 'PeticaoController@export',  'middleware' => ['auth', 'admin']]);

Route::get('admin/configuracoes',           ['as'=>'configuracaos.index',  'uses' => 'ConfiguracaoController@index',   'middleware' => ['auth', 'admin']]);
Route::get('admin/configuracoes/{id}/edit', ['as'=>'configuracaos.edit',   'uses' => 'ConfiguracaoController@edit',    'middleware' => ['auth', 'admin']]);
Route::patch('admin/configuracoes/{id}',    ['as'=>'configuracaos.update', 'uses' => 'ConfiguracaoController@update',  'middleware' => ['auth', 'admin']]);

Route::get('user/profile/{id}/edit',     ['as'=>'profile.edit',       'uses' => 'ProfileController@edit',    'middleware' => ['auth']]);
Route::patch('user/profile/{id}',        ['as'=>'profile.update',     'uses' => 'ProfileController@update',  'middleware' => ['auth']]);

Route::get('admin/assinantes',             ['as'=>'assinantes.index',     'uses' => 'AssinanteController@index',   'middleware' => ['auth', 'admin']]);
Route::get('admin/assinantes/create',      ['as'=>'assinantes.create',    'uses' => 'AssinanteController@create',  'middleware' => ['auth', 'admin']]);
Route::post('admin/assinantes/create',     ['as'=>'assinantes.store',     'uses' => 'AssinanteController@store',   'middleware' => ['auth', 'admin']]);
Route::get('admin/assinantes/{id}',        ['as'=>'assinantes.show',      'uses' => 'AssinanteController@show',    'middleware' => ['auth', 'admin']]);
Route::get('admin/assinantes/{id}/edit',   ['as'=>'assinantes.edit',      'uses' => 'AssinanteController@edit',    'middleware' => ['auth', 'admin']]);
Route::patch('admin/assinantes/{id}',      ['as'=>'assinantes.update',    'uses' => 'AssinanteController@update',  'middleware' => ['auth', 'admin']]);
Route::delete('admin/assinantes/{id}',     ['as'=>'assinantes.destroy',   'uses' => 'AssinanteController@destroy', 'middleware' => ['auth', 'admin']]);

Route::get('admin/usuarios',             ['as'=>'usuarios.index',     'uses' => 'UsuarioController@index',   'middleware' => ['auth', 'admin']]);
Route::get('admin/usuarios/create',      ['as'=>'usuarios.create',    'uses' => 'UsuarioController@create',  'middleware' => ['auth', 'admin']]);
Route::post('admin/usuarios/create',     ['as'=>'usuarios.store',     'uses' => 'UsuarioController@store',   'middleware' => ['auth', 'admin']]);
Route::get('admin/usuarios/{id}',        ['as'=>'usuarios.show',      'uses' => 'UsuarioController@show',    'middleware' => ['auth', 'admin']]);
Route::get('admin/usuarios/{id}/edit',   ['as'=>'usuarios.edit',      'uses' => 'UsuarioController@edit',    'middleware' => ['auth', 'admin']]);
Route::patch('admin/usuarios/{id}',      ['as'=>'usuarios.update',    'uses' => 'UsuarioController@update',  'middleware' => ['auth', 'admin']]);
Route::delete('admin/usuarios/{id}',     ['as'=>'usuarios.destroy',   'uses' => 'UsuarioController@destroy', 'middleware' => ['auth', 'admin']]);

Route::get('user/activation/{token}', 'Auth\AuthController@activateUser')->name('user.activate');

Route::post('/mail/send',    'EmailController@send');
Route::post('/assinar',      'AssinanteController@assinar');
Route::post('/comentar',     'ComentarioController@store');

Route::get('/pg/politica-de-privacidade', 'PgController@privacy');
Route::get('/pg/termos-de-uso',           'PgController@terms');