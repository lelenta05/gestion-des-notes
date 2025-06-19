<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AssistantController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\NoteConrtoller;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Route;


require __DIR__.'/auth.php';

// Login routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']); 

//route pour la page welcome
Route::get('/', [DashboardController::class,'index_welcome'])->name('welcome');
//profile

Route::middleware(['auth'])->group(function(){

Route::get('profile-edit',[ProfileController::class,'edit'])->name('profile.edit');
Route::post('profile-update',[ProfileController::class,'update'])->name('profile.update');

});
//le middleware verifier l'authentification et le role de l'user 

//route pour l'admin
Route::prefix('admin')->middleware(['auth', CheckRole::class.':1'])->name('admin.')->group(function () {
    Route::get('dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('create',[AdminController::class,'create'])->name('create');
    Route::post('create',[AdminController::class,'store'])->name('store');
    Route::get('edit/{id}',[AdminController::class,'edit'])->name('edit');
    Route::put('update/{id}',[AdminController::class,'update'])->name('update');
    Route::delete('delete/{id}',[AdminController::class,'delete'])->name('delete');
    //logs
    Route::get('logs', [LogController::class, 'index'])->name('logs');
    //suppressions de tous les utilisateurs sauf admin et des notes 
    Route::post('delete-notes',[AdminController::class,'destroyNotes'])->name('destroyNotes');
    Route::post('delete-users',[AdminController::class,'destroyUser'])->name('destroyUser');

});

//route pour l'assistant
Route::prefix('assistant')->middleware(['auth', CheckRole::class.':2'])->name('assistant.')->group(function () {
    Route::get('dashboard', [AssistantController::class, 'index'])->name('dashboard');
    Route::get('create',[AssistantController::class,'create'])->name('create');
    Route::post('create',[AssistantController::class,'store'])->name('store');
    Route::get('edit/{id}',[AssistantController::class,'edit'])->name('edit');
    Route::put('update/{id}',[AssistantController::class,'update'])->name('update');
    Route::delete('delete/{id}',[AssistantController::class,'delete'])->name('delete');


});

//route pour acceder a la gestion des notes par admin et assistant 
Route::middleware(['auth',CheckRole::class . ':1,2'])->group(function(){
    //importation des notes 
    Route::get('notes-index4',[NoteConrtoller::class,'index'])->name('notes-index');
    Route::get('import-notes',[NoteConrtoller::class,'showImport'])->name('import-notes-form');
    Route::post('import-notes',[NoteConrtoller::class,'importNotes'])->name('import-notes');
    Route::get('notes/edit/{id}', [NoteConrtoller::class, 'edit'])->name('notes-edit');
    Route::put('notes/update/{id}', [NoteConrtoller::class, 'update'])->name('notes-update');
    Route::delete('notes/delete/{id}', [NoteConrtoller::class, 'delete'])->name('notes-delete');

});

//route pour l'etudiant
Route::prefix('etudiant')->middleware(['auth', CheckRole::class.':3'])->name('etudiant.')->group(function () {
    Route::get('dashboard', [EtudiantController::class, 'mesNotes'])->name('mesNotes');
});


