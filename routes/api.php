<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\StudentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('signUp', [AuthController::class, 'signUp']);
Route::post('login', [AuthController::class, 'login']);

Route::group(['middleware'=>'auth:sanctum'], function(){
    Route::get('/students', [StudentController::class, 'students_list']);
    Route::post('/add-student', [StudentController::class, 'addStudent']);
    Route::put('/update-student/{id}', [StudentController::class, 'updateStudent']);
    Route::delete('/delete-student/{id}', [StudentController::class, 'deleteStudent']);
    
});
Route::get('/search-student/{name}', [StudentController::class, 'searchStudent']);

// Route::resource('member', MemberController::class);