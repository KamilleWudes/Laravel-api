<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\CommentaireController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route Categories
Route::get('/categories',[CategorieController::class, 'index'])->name('categories');
Route::post('/Addcategorie',[CategorieController::class, 'store'])->name('AddCategories');
Route::get('/categorie/{id}',[CategorieController::class, 'show'])->name('categorie');
Route::get('/categorie/{id}/edit',[CategorieController::class, 'edit'])->name('EditCategorie');
Route::put('/Updatecategorie/{id}/edit',[CategorieController::class, 'update'])->name('updateCategorie');
Route::delete('/deletecategorie/{id}',[CategorieController::class, 'destroy'])->name('deleteCategorie');

//Route Users

Route::get('/users',[UserController::class, 'index'])->name('users');
Route::post('/Addusers',[UserController::class, 'store'])->name('Addusers');
Route::get('/user/{id}',[UserController::class, 'show'])->name('user');
Route::get('/user/{id}/edit',[UserController::class, 'edit'])->name('EditUser');
Route::put('/Updateuser/{id}/edit',[UserController::class, 'update'])->name('Updateuser');
Route::delete('/deleteuser/{id}',[UserController::class, 'destroy'])->name('deleteuser');

//Route Articles
Route::get('/articles',[ArticleController::class, 'index'])->name('articles');
Route::post('/Addarticle',[ArticleController::class, 'store'])->name('Addarticle');
Route::get('/article/{id}',[ArticleController::class, 'show'])->name('article');
Route::get('/article/{id}/edit',[ArticleController::class, 'edit'])->name('Editarticle');
Route::put('/Updatearticle/{id}/edit',[ArticleController::class, 'update'])->name('Updatearticle');
Route::delete('/deletearticle/{id}',[ArticleController::class, 'destroy'])->name('deletearticle');

//Route comment
Route::get('/comment',[CommentaireController::class, 'index'])->name('comment');
Route::post('/Addcomment',[CommentaireController::class, 'store'])->name('Addcomment');
Route::get('/comment/{id}',[CommentaireController::class, 'show'])->name('article');
Route::get('/comment/{id}/edit',[CommentaireController::class, 'edit'])->name('Editcomment');
Route::put('/Updatecomment/{id}/edit',[CommentaireController::class, 'update'])->name('Updatecomment');
Route::delete('/deletecomment/{id}',[CommentaireController::class, 'destroy'])->name('deletecomment');




