<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\WelcomeController;

use App\Models\Admin\Project;

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

    $project = Project::all();

    return view('guest.welcome', compact('project'));
})->name('guest.welcome');

Route::get('/403', function () {

    return view('guest.403');
})->name('403');

Route::middleware(['auth', 'verified'])->name('admin.')->group(function () {
    Route::get('logged/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('dashboard');


});

Route::resource('/projects', ProjectController::class)->names([
    'index' => 'admin.projects.index',
    'store' => 'projects.store',
    'edit' => 'admin.projects.edit',
    'destroy' => 'project.destroy',
]);

require __DIR__ . '/auth.php';