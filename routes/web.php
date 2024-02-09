<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\categorieController;
use App\Http\Controllers\produitController;


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

Route::get('/categorie',[categorieController::class, 'liste_categorie']);
Route::get('/produit',[produitController::class, 'list_produit']);


Route::post('/categorie/add',[categorieController::class, 'addCategorie']);
Route::post('/categorie/update' , [categorieController::class, 'updateCategorie']);
Route::post('/categorie/delete' , [categorieController::class, 'deleteCategorie']);


Route::post('/produit/add' , [produitController::class, 'addProduit']);
Route::post('/produit/update' , [produitController::class, 'updateProduit']);
Route::post('/produit/delete' , [produitController::class, 'deleteProduit']);
