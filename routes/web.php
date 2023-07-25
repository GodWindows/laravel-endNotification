<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Models\Project;
use App\Models\Admin as ModelsAdmin;
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
    return redirect(env('APP_URL').'/login');
})->name('home');

Route::get('/tasks/{code}', [ProjectController::class, 'tasks'])->name('tasks');

Route::middleware(['auth', 'verified', 'admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/add-project', [ProjectController::class, 'create'])->name('project.add');

    // Route::post('/test-project', [ProjectController::class, 'test'])->name('project.test');

    Route::get('/delete-project/{id}', [ProjectController::class, 'delete'])->name('project.delete');
    Route::post('/edit-project', [ProjectController::class, 'edit'])->name('project.edit');
    Route::get('/project/{id}', [ProjectController::class, 'view'])->name('view.project');

    Route::get('/new-project', function () {
        return view('profile.new-project');
    })->name('new_project');

    Route::get('/dashboard', function () {
        $authUserEmail = Auth::user()->email;
        $superAdminEmails = ModelsAdmin::where('is_super_admin', 1)->pluck('email')->toArray();
        $superAdmin = in_array($authUserEmail, $superAdminEmails) ;
        $data['projects'] = Auth::user()->projects;
        $data['superAdmin'] = $superAdmin;
        return view('dashboard', $data);
    })->name('dashboard');
});

Route::middleware(['auth', 'verified', 'super_admin'])->group(function () {
    Route::get('/edit-admins', [AdminController::class, 'editAdmins'])->name('view.admins.edit');
    Route::post('/add-admins', [AdminController::class, 'addAdmins'])->name('admins.add');
    Route::get('/delete-admins/{id}', [AdminController::class, 'deleteAdmins'])->name('admins.delete');
});

require __DIR__.'/auth.php';
