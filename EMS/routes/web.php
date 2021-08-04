<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\RegController;

use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;


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


//welcome page
Route::get('/',function(){
    return view('welcome');
});

//login page
Route::get('/signin', function () {
    return view('login');
});

Auth::routes();

//register page
Route::get('/register', function(){
        return view('register');
});
Route::post('/register', [RegController::class, 'getFormData']
);


//Routes to login controller
Route::get("login",[LoginController::class,'login'])->name('login-user');
Route::view('userdashboard','userdashboard');
Route::view('forgotPass','forgotPassword');

Route::post('update',[ForgotPasswordController::class,'updatePassword']);



Route::get('issue',[IssueController::class,'submitIssue']);

Route::get('list',[IssueController::class,'getIssue']);

Route::post('updateMobile',[UserController::class,'updateMobile']);
Route::post('updateAddress',[UserController::class,'updateAddress']);



Route::get('modal', function(){
    return view('modal');
});
//ManagerController
Route::post('addEmp',[ManagerController::class,'addEmployee']);
Route::post('deleteEmp',[ManagerController::class,'deleteEmployee']);


//Admin controls

Route::view('admin','adminDashboard');

Route::get('delete/{id}',[AdminController::class,'deleteEmp']);

Route::post('addProj',[AdminController::class,'addProject']);

Route::get('projdet/{id}',[AdminController::class,'getProjDetails']);
Route::get('empDet/{id}',[AdminController::class,'getEmpDetails']);


Route::put('updatestatus',[AdminController::class,'updateStatusOfIssues']);


Route::get('edit/{id}',[AdminController::class,'showEmpDetailsToEdit']);

Route::get('editproj/{id}',[AdminController::class,'showProjDetailsToEdit']);

Route::post('editproj',[AdminController::class,'updateProjectDetails']);

Route::put('edit/updateEmpDet',[AdminController::class,'updateEmpDetails']);

Route::put('editproj/updateProjectDetails',[ AdminController::class, 'updateProjectDetails']);