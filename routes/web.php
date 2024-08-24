<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PermissionsController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\TaskController;
use App\Http\Controllers\Admin\TaskSubmissionController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Auth\ChangePasswordController;
use App\Http\Controllers\Auth\OtpController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/otp', [OtpController::class, 'index'])->name('otp-login');
Route::post('/otp-login', [OtpController::class, 'otpLogin'])->name('otp-login.store');
Route::view('/confirm-otp', 'auth.otp-confirm')->name('otp-confirm');
Route::post('/otp-verify', [OtpController::class, 'verifyOtp'])->name('otp-verify.store');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    // Permissions
    Route::delete('permissions/destroy', [PermissionsController::class, 'massDestroy'])->name('permissions.massDestroy');
    Route::resource('permissions', PermissionsController::class);

    // Roles
    Route::delete('roles/destroy', [RolesController::class, 'massDestroy'])->name('roles.massDestroy');
    Route::resource('roles', RolesController::class);

    // Users
    Route::delete('users/destroy', [UsersController::class, 'massDestroy'])->name('users.massDestroy');
    Route::resource('users', UsersController::class);

    // Project
    Route::delete('projects/destroy', [ProjectController::class, 'massDestroy'])->name('projects.massDestroy');
    Route::resource('projects', ProjectController::class);

    // Team
    Route::delete('teams/destroy', [TeamController::class, 'massDestroy'])->name('teams.massDestroy');
    Route::resource('teams', TeamController::class);

    // Task
    Route::delete('tasks/destroy', [TaskController::class, 'massDestroy'])->name('tasks.massDestroy');
    Route::resource('tasks', TaskController::class);

    // Task Submission
    Route::delete('task-submissions/destroy', [TaskSubmissionController::class, 'massDestroy'])->name('task-submissions.massDestroy');
    Route::resource('task-submissions', TaskSubmissionController::class);
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', [ChangePasswordController::class, 'edit'])->name('password.edit');
        Route::post('password', [ChangePasswordController::class, 'update'])->name('password.update');
        Route::post('profile', [ChangePasswordController::class, 'updateProfile'])->name('password.updateProfile');
        Route::post('profile/destroy', [ChangePasswordController::class, 'destroy'])->name('password.destroyProfile');
    }
});
