<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\LoginController;
use App\Models\Employee;
use App\Models\Mahasiswa;
use App\Models\Dosen;

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

Route::get('/', function () {
    $jumlahpegawai = Employee::count();
    $jumlahpegawaicowo = Employee::where('jeniskelamin','cowo')->count();
    $jumlahpegawaicewe = Employee::where('jeniskelamin','cewe')->count();
    $jumlahmahasiswa = Mahasiswa::count();
    $jumlahmahasiswacowo = Mahasiswa::where('jeniskelamin','cowo')->count();
    $jumlahmahasiswacewe = Mahasiswa::where('jeniskelamin','cewe')->count();
    $jumlahdosen = Dosen::count();
    $jumlahdosencowo = Dosen::where('jeniskelamin','cowo')->count();
    $jumlahdosencewe = Dosen::where('jeniskelamin','cewe')->count();

    return view('welcome',compact('jumlahpegawai','jumlahpegawaicowo','jumlahpegawaicewe','jumlahmahasiswa','jumlahmahasiswacowo','jumlahmahasiswacewe','jumlahdosen','jumlahdosencowo','jumlahdosencewe'));
})->middleware('auth');

Route::get('/pegawai',[EmployeeController::class, 'index'])->name('pegawai')->middleware('auth');
Route::get('/mahasiswa',[MahasiswaController::class, 'index2'])->name('mahasiswa')->middleware('auth');
Route::get('/dosen',[DosenController::class, 'index3'])->name('dosen')->middleware('auth');

Route::get('/tambahpegawai',[EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
Route::post('/insertdata',[EmployeeController::class, 'insertdata'])->name('insertdata');

Route::get('/tambahmahasiswa',[MahasiswaController::class, 'tambahmahasiswa'])->name('tambahmahasiswa');
Route::post('/insertdata2',[MahasiswaController::class, 'insertdata2'])->name('insertdata2');

Route::get('/tambahdosen',[DosenController::class, 'tambahdosen'])->name('tambahdosen');
Route::post('/insertdata3',[DosenController::class, 'insertdata3'])->name('insertdata3');

Route::get('/tampilkandata/{id}',[EmployeeController::class, 'tampilkandata'])->name('tampilkandata');
Route::post('/updatedata1/{id}',[EmployeeController::class, 'updatedata1'])->name('updatedata1');

Route::get('/tampilkandata2/{id}',[MahasiswaController::class, 'tampilkandata2'])->name('tampilkandata2');
Route::post('/updatedata2/{id}',[MahasiswaController::class, 'updatedata2'])->name('updatedata2');

Route::get('/tampilkandata3/{id}',[DosenController::class, 'tampilkandata3'])->name('tampilkandata3');
Route::post('/updatedata/{id}',[DosenController::class, 'updatedata'])->name('updatedata');

Route::get('/delete/{id}',[EmployeeController::class, 'delete'])->name('delete');
Route::get('/delete/{id}',[MahasiswaController::class, 'delete'])->name('delete');
Route::get('/delete/{id}',[DosenController::class, 'delete'])->name('delete');

Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/loginproses',[LoginController::class, 'loginproses'])->name('loginproses');


Route::get('/register',[LoginController::class, 'register'])->name('register');
Route::post('/registeruser',[LoginController::class, 'registeruser'])->name('registeruser');

Route::get('/logout',[LoginController::class, 'logout'])->name('logout');




Route::get('/datareligion',[ReligionController::class, 'index'])->name('datareligion')->middleware('auth');
Route::get('/tambahagama',[ReligionController::class, 'create'])->name('tambahagama');

Route::post('/insertdatareligion',[ReligionController::class, 'store'])->name('insertdatareligion');

