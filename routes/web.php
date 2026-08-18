<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\Settings;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CharacterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homepage');
})->name('home');

//alfay merubah sesuatu aku ubah lagi
use App\Http\Controllers\PlaygroundController;

Route::middleware('auth')->group(function () {

    

});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('api-token', [UserController::class, 'getApiToken'])->name('api-token');


    Route::get('settings/profile', [Settings\ProfileController::class, 'edit'])->name('settings.profile.edit');
    Route::put('settings/profile', [Settings\ProfileController::class, 'update'])->name('settings.profile.update');
    Route::delete('settings/profile', [Settings\ProfileController::class, 'destroy'])->name('settings.profile.destroy');
    Route::get('settings/password', [Settings\PasswordController::class, 'edit'])->name('settings.password.edit');
    Route::put('settings/password', [Settings\PasswordController::class, 'update'])->name('settings.password.update');
    Route::get('settings/appearance', [Settings\AppearanceController::class, 'edit'])->name('settings.appearance.edit');
    Route::put('settings/appearance', [Settings\AppearanceController::class, 'update'])->name('settings.appearance.update');

    // Roles Management - dengan permission check
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index')->middleware('permission:view-roles');
    Route::get('roles/export', [RoleController::class, 'export'])->name('roles.export')->middleware('permission:download-roles');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create')->middleware('permission:create-roles');
    Route::post('roles', [RoleController::class, 'store'])->name('roles.store')->middleware('permission:create-roles');
    Route::get('roles/{role}', [RoleController::class, 'show'])->name('roles.show')->middleware('permission:show-roles');
    Route::get('roles/{role}/edit', [RoleController::class, 'edit'])->name('roles.edit')->middleware('permission:edit-roles');
    Route::put('roles/{role}', [RoleController::class, 'update'])->name('roles.update')->middleware('permission:edit-roles');
    Route::delete('roles/{role}', [RoleController::class, 'destroy'])->name('roles.destroy')->middleware('permission:delete-roles');
    
    // Permissions Management - dengan permission check
    Route::get('permissions', [PermissionController::class, 'index'])->name('permissions.index')->middleware('permission:view-permissions');
    Route::get('permissions/export', [PermissionController::class, 'export'])->name('permissions.export')->middleware('permission:download-permissions');
    Route::get('permissions/create', [PermissionController::class, 'create'])->name('permissions.create')->middleware('permission:create-permissions');
    Route::post('permissions', [PermissionController::class, 'store'])->name('permissions.store')->middleware('permission:create-permissions');
    Route::get('permissions/{permission}', [PermissionController::class, 'show'])->name('permissions.show')->middleware('permission:show-permissions');
    Route::get('permissions/{permission}/edit', [PermissionController::class, 'edit'])->name('permissions.edit')->middleware('permission:edit-permissions');
    Route::put('permissions/{permission}', [PermissionController::class, 'update'])->name('permissions.update')->middleware('permission:edit-permissions');
    Route::delete('permissions/{permission}', [PermissionController::class, 'destroy'])->name('permissions.destroy')->middleware('permission:delete-permissions');
    
    // Users Management - dengan permission check
    Route::get('users', [UserController::class, 'index'])->name('users.index')->middleware('permission:view-users');
    Route::get('users/export', [UserController::class, 'export'])->name('users.export')->middleware('permission:download-users');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create')->middleware('permission:create-users');
    Route::post('users', [UserController::class, 'store'])->name('users.store')->middleware('permission:create-users');
    Route::get('users/{user}', [UserController::class, 'show'])->name('users.show')->middleware('permission:show-users');
    Route::get('users/{user}/edit', [UserController::class, 'edit'])->name('users.edit')->middleware('permission:edit-users');
    Route::put('users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('permission:edit-users');
    Route::delete('users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('permission:delete-users');
    
    // Character Management - dengan permission check
    Route::get('characters', [CharacterController::class, 'index'])->name('characters.index')->middleware('permission:view-characters');
    Route::get('characters/table', [CharacterController::class, 'indexTable'])->name('characters.indexTable')->middleware('permission:view-characters');
    Route::get('characters/export', [CharacterController::class, 'export'])->name('characters.export')->middleware('permission:download-characters');
    Route::get('characters/create', [CharacterController::class, 'create'])->name('characters.create')->middleware('permission:create-characters');
    Route::post('characters', [CharacterController::class, 'store'])->name('characters.store')->middleware('permission:create-characters');
    Route::get('characters/{character}', [CharacterController::class, 'show'])->name('characters.show')->middleware('permission:show-characters');
    Route::get('characters/{character}/edit', [CharacterController::class, 'edit'])->name('characters.edit')->middleware('permission:edit-characters');
    Route::put('characters/{character}', [CharacterController::class, 'update'])->name('characters.update')->middleware('permission:edit-characters');
    Route::delete('characters/{character}', [CharacterController::class, 'destroy'])->name('characters.destroy')->middleware('permission:delete-characters');



    Route::get('/playground', [PlaygroundController::class,'index'])->name('playground.index');
    Route::post('/playground/conversations', [PlaygroundController::class,'createConversation'])->name('playground.conversations.store');
    Route::post('/playground/chat', [PlaygroundController::class,'send'])->name('playground.chat.send');
});

require __DIR__.'/auth.php';
