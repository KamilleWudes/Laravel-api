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
Route::get('/categories', [CategorieController::class, 'index'])->name('categories');
Route::post('/categories', [CategorieController::class, 'store'])->name('AddCategories');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categorie');
//Route::get('/categories/{id}',[CategorieController::class, 'edit'])->name('EditCategorie');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('updateCategorie');
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('deleteCategorie');

//Route Users

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::post('/users', [UserController::class, 'store'])->name('Addusers');
Route::get('/users/{id}', [UserController::class, 'show'])->name('user');
//Route::get('/users/{id}', [UserController::class, 'edit'])->name('EditUser');
Route::put('/users/{id}', [UserController::class, 'update'])->name('Updateuser');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('deleteuser');

//Route Articles
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::post('/articles', [ArticleController::class, 'store'])->name('Addarticle');
Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('article');
//Route::get('/articles/{id}', [ArticleController::class, 'edit'])->name('Editarticle');
Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('Updatearticle');
Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('deletearticle');

//Route comment
Route::get('/comment', [CommentaireController::class, 'index'])->name('comment');
Route::post('/Addcomment', [CommentaireController::class, 'store'])->name('Addcomment');
Route::get('/comment/{id}', [CommentaireController::class, 'show'])->name('article');
Route::get('/comment/{id}/edit', [CommentaireController::class, 'edit'])->name('Editcomment');
Route::put('/Updatecomment/{id}/edit', [CommentaireController::class, 'update'])->name('Updatecomment');
Route::delete('/deletecomment/{id}', [CommentaireController::class, 'destroy'])->name('deletecomment');
