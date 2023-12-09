<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SignupController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SignupPublicController;
use App\Http\Controllers\MentorController;


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

Route::get('/login', [LoginController::class, 'loginView']);
Route::get('/login/{alert}', [LoginController::class, 'loginAlert']);
Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LogoutController::class, 'logout']);

Route::get('/index', [IndexController::class, 'index']);
Route::get('/index/{alert}', [IndexController::class, 'indexAlert']);
Route::get('/aboutUs', [IndexController::class, 'aboutUs']);

Route::get('/signup', [SignupController::class, 'signupView']);
Route::get('/signup/{alert}', [SignupController::class, 'signupAlert']);
Route::post('/signup', [SignupController::class, 'signup']);

Route::get('/signupPublic', [SignupController::class, 'signupPublicView']);
Route::post('/signupPublic', [SignupController::class, 'signupPublic']);

Route::get('/manage', [ManageController::class, 'manageView']);
Route::get('/manage/{alert}', [ManageController::class, 'manageAlert']);
Route::post('/manage', [ManageController::class, 'manage']);

Route::get('/goals', [GoalsController::class, 'goalsView']);
Route::post('/goals', [GoalsController::class, 'goals']);
Route::get('/goals_alert/{alert}', [GoalsController::class, 'goalsAlert']);
Route::get('/goals/{idDelete}', [GoalsController::class, 'goalsDelete']);

Route::get('/basket_form', [BasketController::class, 'basketForm']);
Route::post('/basket', [BasketController::class, 'basket']);
Route::get('/basket/{idCanasta}', [BasketController::class, 'basketView']);
Route::get('/basket_delete/{idCanasta}', [BasketController::class, 'basketDelete']);
Route::post('/basket/{idCanasta}', [BasketController::class, 'productBasketSearch']);
Route::get('/basket_add/{idCanasta}/{idProductoPaquete}', [BasketController::class, 'basketAdd']);
Route::post('/basket_update/{idCanasta}', [BasketController::class, 'productQuantityUpdate']);

Route::get('/product_profile', [ProductController::class, 'productView']);
Route::get('/product_list', [ProductController::class, 'listProductsView']);
Route::get('/product_suggestion', [ProductController::class, 'productSuggestion']);

Route::post('/smart_basket_view', [BasketController::class, 'smartBasketView']);
Route::get('/smart_basket_form', [BasketController::class, 'smartBasketForm']);

Route::get('/mentor_view', [MentorController::class, 'mentorView']);
Route::post('/mentor_update', [MentorController::class, 'mentorUpdate']);
Route::post('/mentor_profile', [MentorController::class, 'mentorProfile']);
Route::post('/import_canasta', [MentorController::class, 'mentorImport']);



