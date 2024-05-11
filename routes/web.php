<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;


Route::get('/mahasiswa/all', [MahasiswaController::class,'all']);
Route::get('/mahasiswa/gabung-1', [MahasiswaController::class,'gabung1']);
Route::get('/mahasiswa/gabung-2', [MahasiswaController::class,'gabung2']);
Route::get('/mahasiswa/gabung-join-1', [MahasiswaController::class,'gabungJoin1']);
Route::get('/mahasiswa/gabung-join-2', [MahasiswaController::class,'gabungJoin2']);
Route::get('/mahasiswa/gabung-join-3', [MahasiswaController::class,'gabungJoin3']);
