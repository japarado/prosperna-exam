<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\UserController;
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


Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return redirect('dashboard');
    });

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('tests', TestController::class)->parameter('tests', 'id');

	Route::prefix('subscriptions')->group(function() {
		Route::get('mine', [SubscriptionController::class, 'mine'])->name('subscriptions.mine');
	});

});

Route::middleware(['guest'])->group(function() {
	Route::prefix('users')->group(function() {
		Route::post('debug-delete-all', [UserController::class, 'debugDeleteAll'])->name('users.debug-delete-all');
	});
});

require __DIR__.'/auth.php';
