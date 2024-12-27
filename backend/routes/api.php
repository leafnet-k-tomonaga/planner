<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\SuggestController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// テスト用
Route::get('/sample', function(){
    return 'Laravel api OK!';
});

// suggestページ用
Route::post('/suggests', [SuggestController::class, 'index'])->name('suggests.index');