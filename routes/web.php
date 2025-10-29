<?php

use App\Http\Controllers\Admin\DataUserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// route biasanya
Route::get('/kenalan', function(){
    return('halooo namaku Aisy');
});

// route parameter

Route::get('/halo/{nama}', function($nama){
    return 'selamat datang' . $nama;
});

// route name

Route::get('/buah', function(){
    return 'stroberi, mangga, apel';
})->name('fruit');

// route view
// jika file html nya didalam folder maka panggil dulu nama foldernya
// contoh : namafolder.namafile
// tetapi jika file html nya langsung menyentuh folder view maka langsung saja panggil nama filenya

Route::get('/landing-page', function(){ 
    return view('landingpage');
});

// route untuk admin
// 
Route::prefix('admin')->middleware(['auth','admin'])->group(function (){
    Route::get('/dashboardAdmin', function (){
        return view('admin.dashboardAdmin');
    });
    Route::controller(DataUserController::class)->group(function(){
        // ini buat nampilin table data user
        Route::get('/data-user', 'index')->name('index.data-user');
        // ini route untuk menampilkan form data user
        Route::get('/form-data-user', 'formDataUser')->name('form.dataUser');
        // ini route ubtuk proses create/tambah data user
        Route::post('/create-data-user', 'createDataUser')->name('create.dataUser');
        // ini route untuk menampilkan edit
        Route::get('edit-data-user/{id}', 'editDataUser')->name('edit.dataUser');
        // ini route untuk proses dupdate data
        Route::put('update-data-user/{id}', 'updateDataUser')->name('update.dataUser');
        Route::delete('delete-data-user/{id}', 'deleteDataUser')->name('delete.dataUser');
    });
});

// route untuk user
Route::prefix('user')->middleware(['auth','user'])->group(function (){
    Route::get('/dashboardUser', function (){
        return view('user.dashboardUser');
    });
    
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

