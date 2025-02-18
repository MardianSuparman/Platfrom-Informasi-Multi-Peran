<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\WriterController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ================== ADMIN ROUTES ===================
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'role:Admin']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');

    // Resource routes untuk Data Master
    Route::resource('users', UserController::class);
    Route::resource('roles', RolesController::class);
    Route::resource('categories', CategorieController::class);

    // Resource routes untuk information
    Route::resource('information', InformationController::class)->names([
        'index' => 'admin.information.index', // Nama route untuk admin
        'create' => 'admin.information.create',
        'store' => 'admin.information.store',
        'show' => 'admin.information.show',
        'edit' => 'admin.information.edit',
        'update' => 'admin.information.update',
        'destroy' => 'admin.information.destroy',
    ]);
});

// ================== WRITER ROUTES ===================
Route::middleware(['auth', 'role:Writer'])->prefix('writer')->group(function () {
    Route::get('/', [WriterController::class, 'index'])->name('writer.index');

    // Resource route untuk Data Master
    Route::resource('information', InformationController::class)->names([
        'index' => 'writer.information.index', // Nama route untuk writer
        'create' => 'writer.information.create',
        'store' => 'writer.information.store',
        'show' => 'writer.information.show',
        'edit' => 'writer.information.edit',
        'update' => 'writer.information.update',
        'destroy' => 'writer.information.destroy',
    ]);
});

// Route::group(['prefix' => 'writer', 'middleware' => ['auth', 'role:Writer']], function () {
//     Route::get('/', [WriterController::class, 'index'])->name('writer.index');

//     // Tambahkan route lain yang hanya bisa diakses oleh Writer
//     // Route::resource('posts', PostController::class);
// });

// ================== USER ROUTES ===================
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'role:User']], function () {
    Route::post('/comment', [UserController::class, 'comment'])->name('user.comment');
});


    // Route::group(['middleware'=> ['auth']], function() {
    //     Route::resource('roles', RolesController::class);
    //     Route::resource('user', UserController::class);
    //     Route::resource('categorie', CategorieController::class);
    // });
