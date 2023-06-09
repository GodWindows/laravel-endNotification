<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;


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
})->name('home');

Route::get('/tasks/{code}', [ProjectController::class, 'tasks'])->name('tasks');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/add-project', [ProjectController::class, 'create'])->name('project.add');
    Route::get('/delete-project/{id}', [ProjectController::class, 'delete'])->name('project.delete');
    Route::post('/update-project', [ProjectController::class, 'update'])->name('project.update');
    Route::get('/project/{id}', [ProjectController::class, 'view'])->name('view.project');

    Route::get('/new-project', function () {
        return view('profile.new-project');
    })->name('new_project');

    Route::get('/dashboard', function () {
        $data['projects'] = Auth::user()->projects;
        return view('dashboard', $data);
    })->name('dashboard');
});

Route::middleware(['auth', 'verified', 'super_admin'])->group(function () {
    Route::get('/edit-admins', [AdminController::class, 'editAdmins'])->name('view.admins.edit');
    Route::post('/add-admins', [AdminController::class, 'addAdmins'])->name('admins.add');
    Route::get('/delete-admins/{id}', [AdminController::class, 'deleteAdmins'])->name('admins.delete');
});

require __DIR__.'/auth.php';
