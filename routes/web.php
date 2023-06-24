<?php

use App\Http\Controllers\CurriculumController;
use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Community\CommunityIndex;
use App\Http\Livewire\Curriculum\CurriculumDetail;
use App\Http\Livewire\Curriculum\CurriculumForm;
use App\Http\Livewire\Curriculum\CurriculumIndex;
use App\Http\Livewire\Dashboard;
use App\Http\Livewire\Example\ExampleForm;
use App\Http\Livewire\Example\ExampleIndex;
use App\Http\Livewire\Profile\ProfileIndex;
use App\Http\Livewire\Question\QuestionDetail;
use App\Http\Livewire\Question\QuestionForm;
use App\Http\Livewire\Question\QuestionIndex;
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

Route::middleware('auth')->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::get('/community', CommunityIndex::class)->name('community');

    Route::get('/profile', ProfileIndex::class)->name('profile.edit');

    Route::group(['prefix' => 'curriculum' , 'as' => 'curriculum.'], function () {
        Route::get('/{id}/pdf', [CurriculumController::class, 'generatePDF'])->name('pdf');

        Route::get('/', CurriculumIndex::class)->name('index');
        Route::get('/create', CurriculumForm::class)->name('create');
        Route::get('/{id}/show', CurriculumDetail::class)->name('show');
    });

    Route::group(['prefix' => 'question' , 'as' => 'question.'], function () {
        Route::get('/', QuestionIndex::class)->name('index');
        Route::get('/create', QuestionForm::class)->name('create');
        Route::get('/{id}/show', QuestionDetail::class)->name('show');
    });

});

require __DIR__ . '/auth.php';
