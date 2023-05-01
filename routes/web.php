<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/projects/{slug}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
Route::get('projects/trash', [ProjectController::class, 'trash'])->name('projects.trash');
Route::put('/projects/{id}/restore', [App\Http\Controllers\ProjectController::class, 'restore'])->name('projects.restore');
Route::delete('/projects/{id}/force-delete', [ProjectController::class, 'forceDelete'])->name('projects.force-delete');


Route::resource('projects', ProjectController::class)->parameters([
    'projects' => 'project:slug'
]);

Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
Route::get('/projects/{project}/types', [ProjectController::class, 'types'])->name('projects.types');
Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update')->middleware('can:update,project');

Route::resource('types', TypeController::class);

Route::get('/types', [TypeController::class, 'index'])->name('types.index');

Route::get('/types/create', [TypeController::class, 'create'])->name('types.create');

Route::post('/types', [TypeController::class, 'store'])->name('types.store');

Route::get('/types/{type}', [TypeController::class, 'show'])->name('types.show');

Route::get('/types/{type}/edit', [TypeController::class, 'edit'])->name('types.edit');

Route::put('/types/{type}', [TypeController::class, 'update'])->name('types.update');

Route::delete('/types/{type}', [TypeController::class, 'destroy'])->name('types.destroy');


require __DIR__.'/auth.php';

