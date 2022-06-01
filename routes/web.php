<?php

use App\Http\Controllers\BranchController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ProjectUserController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserBranchController;
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

Route::get('projects/password/{project}', [ProjectUserController::class, 'password'])->name('project.password');
Route::post('projects/confirm/{project}', [ProjectUserController::class, 'confirm'])->name('project.confirm');
Route::view('projects/{project}/empty', 'front.projects.empty')->name('project.empty');
Route::get('projects/show/{project}/{department?}/{branch?}', [ProjectUserController::class, 'show'])->name('show.project');

Route::resource('comments', CommentController::class);
Route::redirect('/', 'admin/projects');

Route::prefix('admin')->group(function () {
    require __DIR__ . '/auth.php';

    Route::middleware('auth')->group(function () {
        Route::resource('projects', ProjectController::class);
        Route::get('departments_by_project', [ProjectController::class, 'departments_by_project'])->name('departments_by_project');

        Route::resource('departments', DepartmentController::class);
        Route::get('{project}/departments', [DepartmentController::class, 'index'])->name('show_departments_by_project');
        Route::get('{project}/{department}/branches', [DepartmentController::class, 'branches'])->name('branches');
        Route::get('{project}/{department}/subBranches', [DepartmentController::class, 'subBranches'])->name('subBranches');
        Route::resource('files', FileController::class);

        Route::get('settings', [SettingController::class,'index'])->name('settings.index');
        Route::put('settings', [SettingController::class,'update'])->name('settings.update');
    });
});
