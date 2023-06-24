<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Example\ExampleForm;
use App\Http\Livewire\Example\ExampleIndex;
use App\Http\Livewire\Profile\ProfileIndex;
use App\Http\Livewire\Users\UserForm;
use App\Http\Livewire\Users\UserIndex;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');

    Route::get('/profile', ProfileIndex::class)->name('profile.edit');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::group(['prefix' => 'example', 'as' => 'example.'], function () {
        Route::get('/', ExampleIndex::class)->name('index');
        Route::get('/create', ExampleForm::class)->name('create');
        Route::get('/{id}/edit', ExampleForm::class)->name('edit');
    });
});

require __DIR__ . '/auth.php';
