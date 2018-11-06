<?php

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
    return view('welcome');
});

// Route::get('food', 'FoodController@index')->name('food.index');
// Route::get('food/{id}', 'FoodController@show')->name('food.show');

Route::get('food/export', 'FoodController@export');
Route::post('food/search', 'FoodController@search');
Route::get('food/feed', 'FoodController@feed');
Route::resource('food', 'FoodController');

// Route::get('intake', 'IntakeController@index')->name('intake.index');
// Route::get('intake/{id}', 'IntakeController@show')->name('intake.show');
route::get('intake/daily/{day?}', 'IntakeController@daily')->name('intake.daily');

Route::post('intake/addRecipe', 'IntakeController@addRecipe');
Route::resource('intake', 'IntakeController');

Route::get('suggest/food', 'SearchController@suggestFood');
Route::get('suggest/recipe', 'SearchController@suggestRecipe');


Route::get('recipe/refresh/{id}', 'RecipeController@refresh');
Route::post('recipe/add', 'RecipeController@addFood');
Route::post('recipe/remove', 'RecipeController@removeFood');
Route::resource('recipe', 'RecipeController');