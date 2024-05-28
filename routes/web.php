<?php

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

Route::get('/', function () {
    return view('index');
});

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index']);

Route::get('/dashboard/tag/create', [App\Http\Controllers\TagController::class, 'create']);
Route::get('/dashboard/tag/{id}/delete', [App\Http\Controllers\TagController::class, 'delete']);
Route::resource('/dashboard/tag', App\Http\Controllers\TagController::class)->except('create');

Route::get('/dashboard/conhecimento/create', [App\Http\Controllers\BaseConhecimentoController::class, 'create']);
Route::get('/dashboard/conhecimento/{id}/delete', [App\Http\Controllers\BaseConhecimentoController::class, 'delete']);
Route::get('/dashboard/conhecimento/anexo/{id}', [App\Http\Controllers\BaseConhecimentoController::class, 'anexo']);
Route::delete('/dashboard/conhecimento/anexo/excluir/{id}/{baseId}', [App\Http\Controllers\BaseConhecimentoController::class, 'deleteAnexo']);
Route::resource('/dashboard/conhecimento', App\Http\Controllers\BaseConhecimentoController::class)->except('create');

Route::get('/dashboard/users/new', [App\Http\Controllers\UserController::class, 'new']);
Route::get('/dashboard/users/{id}/delete', [App\Http\Controllers\UserController::class, 'delete']);
Route::get('/dashboard/profile/{name}/{id}', [App\Http\Controllers\UserController::class, 'profile']);
Route::get('/dashboard/users/update-password/{id}', [App\Http\Controllers\UserController::class, 'updatePassword']);
Route::get('/dashboard/users/update-pic-profile/{id}', [App\Http\Controllers\UserController::class, 'updatePicProfile']);
Route::resource('/dashboard/profile', App\Http\Controllers\UserController::class)->except('create');

Route::get('/dashboard/perfil/create', [App\Http\Controllers\UserController::class, 'create']);
Route::get('/dashboard/perfil/{id}/delete', [App\Http\Controllers\UserController::class, 'delete']);
Route::resource('/dashboard/perfil', App\Http\Controllers\UserController::class)->except('create');

Route::get('/dashboard/memorias/criar', [App\Http\Controllers\MemoriasController::class, 'criar']);
Route::get('/dashboard/memorias/{id}/delete', [App\Http\Controllers\MemoriasController::class, 'delete']);
Route::resource('/dashboard/memorias', App\Http\Controllers\MemoriasController::class)->except('create');

Route::get('/dashboard/midias/criar', [App\Http\Controllers\MidiaController::class, 'criar']);
Route::get('/dashboard/midias/{id}/delete', [App\Http\Controllers\MidiaController::class, 'delete']);
Route::resource('/dashboard/midias', App\Http\Controllers\MidiaController::class)->except('create');

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/contact', function () {
    return view('contact');
});

//Route::get('/', [App\Http\Controllers\BaseConhecimentoController::class, 'dashboard']);
// Route::get('/base', [App\Http\Controllers\BaseConhecimentoController::class, 'baseLista']);
// Route::get('/base/{urlamigavel}/{id}', [App\Http\Controllers\BaseConhecimentoController::class, 'baseDetalhes']);


require __DIR__.'/auth.php';
