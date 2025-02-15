<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\sAdminProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LecturerDocumentController;
use App\Http\Controllers\LecturerUserController;


Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::get('/super_admin/dashboard', [AdminController::class, 'index'])->name('super_admin.dashboard');
    Route::resource('/super_admin/documents', DocumentController::class);
    Route::resource('/super_admin/users', UserController::class);
    Route::resource('/super_admin/comments', CommentController::class);
    Route::resource('/super_admin/profiles', ProfileController::class);
    Route::resource('/super_admin/settings', SettingController::class);
});
Route::middleware('auth')->group(function () {
    Route::get('/get/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::resource('/users', UserController::class);
    Route::resource('/documents', DocumentController::class);
    Route::get('documents/{id}/download', [DocumentController::class, 'download'])->name('document.download');
    Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::post('/documents/{document}/feedback', [DocumentController::class, 'storeFeedback'])->name('documents.storeFeedback');
    Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('document.download');
    Route::resource('profiles', sAdminProfileController::class);
    Route::resource('/admin/comments', AdminCommentController::class);
    // Route::resource('/admin/users', AdminUserController::class);


});
// Route::resource('/admins/profiles', AdminProfileController::class);
// Route::prefix('lecturer')
//     ->middleware(['auth', 'role:lecturer']) // Add middleware for role-based access
//     ->group(function () {

//     });
    Route::get('/lecturer/documents', [LecturerDocumentController::class, 'index'])->name('lecturer.documents.index');
    Route::get('/lecturer/documents/create', [LecturerDocumentController::class, 'create'])->name('lecturer.documents.create');
    Route::post('/lecturer/documents', [LecturerDocumentController::class, 'store'])->name('lecturer.documents.store');
    Route::get('/lecturer/documents/{id}', [LecturerDocumentController::class, 'show'])->name('lecturer.documents.show');
    Route::get('/lecturer/documents/{id}/edit', [LecturerDocumentController::class, 'edit'])->name('lecturer.documents.edit');
    Route::put('/lecturer/documents/{id}', [LecturerDocumentController::class, 'update'])->name('lecturer.documents.update');
    Route::delete('/lecturer/documents/{id}', [LecturerDocumentController::class, 'destroy'])->name('lecturer.documents.destroy');
    Route::prefix('admin/profiles')->name('admin.profiles.')->group(function () {
        Route::get('/', [AdminProfileController::class, 'index'])->name('index'); // List all profiles
        Route::get('/create', [AdminProfileController::class, 'create'])->name('create'); // Show create form
        Route::post('/store', [AdminProfileController::class, 'store'])->name('store'); // Store new profile
        Route::get('/{profile}', [AdminProfileController::class, 'show'])->name('show'); // Show specific profile
        Route::get('/{profile}/edit', [AdminProfileController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{profile}', [AdminProfileController::class, 'update'])->name('update'); // Update profile
        Route::delete('/{profile}', [AdminProfileController::class, 'destroy'])->name('destroy'); // Delete profile
    });

    Route::prefix('admin/users')->name('admin.users.')->group(function () {
        Route::get('/', [AdminUserController::class, 'index'])->name('index');
        Route::get('/create', [AdminUserController::class, 'create'])->name('create'); // Show create form
        Route::post('/store', [AdminUserController::class, 'store'])->name('store'); // Store new user
        Route::get('/{user}', [AdminUserController::class, 'show'])->name('show'); // Show specific user
        Route::get('/{user}/edit', [AdminUserController::class, 'edit'])->name('edit'); // Show edit form
        Route::put('/{user}', [AdminUserController::class, 'update'])->name('update'); // Update user
        Route::delete('/{user}', [AdminUserController::class, 'destroy'])->name('destroy'); // Delete user
    });


// Route::middleware(['auth', 'role:lecturer'])->prefix('lecturer/users')->name('lecturer.users.')->group(function () {
//     Route::get('/', [LecturerUserController::class, 'index'])->name('index');
//     Route::get('/create', [LecturerUserController::class, 'create'])->name('create');
//     Route::post('/', [LecturerUserController::class, 'store'])->name('store');
//     Route::get('/{id}', [LecturerUserController::class, 'show'])->name('show');
//     Route::get('/{id}/edit', [LecturerUserController::class, 'edit'])->name('edit');
//     Route::put('/{id}', [LecturerUserController::class, 'update'])->name('update');
//     Route::delete('/{id}', [LecturerUserController::class, 'destroy'])->name('destroy');
// });
// Route::resource('/lecture/users', LecturerUserController::class);
require __DIR__.'/auth.php';

Route::get('/login', [AuthenticatedSessionController::class, 'create'])
    ->name('login');
Route::get('/outsider/dashboard', [AdminController::class, 'outsiderDashboard'])
    ->name('outsider.dashboard');

