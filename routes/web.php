<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\produitController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ForgotPasswordController;


// use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/register' , [AuthController::class, 'register_page']);
Route::get('/login',[AuthController::class,'login_page']);
Route::get('/categorie',[categorieController::class, 'liste_categorie']);
Route::get('/produit',[produitController::class, 'list_produit']);
Route::get('/user', [UserController::class , 'displayUser']);
Route::get('/role', [RoleController::class , 'displayRole']);


Route::post('/register/act' , [AuthController::class, 'register']);
Route::post('/login/act', [AuthController::class, 'login']);

Route::post('/user/add' , [UserController::class, 'addUser']);
Route::post('/user/update' , [UserController::class , 'updateUser']);
Route::post('/user/delete' , [UserController::class , 'deleteUser']);

Route::post('/categorie/add',[categorieController::class, 'addCategorie']);
Route::post('/categorie/update' , [categorieController::class, 'updateCategorie']);
Route::post('/categorie/delete' , [categorieController::class, 'deleteCategorie']);

Route::post('/produit/add' , [produitController::class, 'addProduit']);
Route::post('/produit/update' , [produitController::class, 'updateProduit']);
Route::post('/produit/delete' , [produitController::class, 'deleteProduit']);

Route::post('/role/add' , [RoleController::class , 'addRole']);
Route::post('/role/update' , [RoleController::class , 'updateRole']);
Route::post('/role/delete' , [RoleController::class , 'deleteRole']);

// routes/web.php

Route::get('/forgotPass', [ForgotPasswordController::class, 'passForm']);
Route::post('/forgotPass', [ForgotPasswordController::class, 'sendEmail']);
