<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "HomesController");
Route::resource("products", "ProductsController", ["only" => ["index", "show", "create", "store"]]);
Route::get("/products/{id}/sold", "ProductsController@sold");
Route::post("/products/{id}/resale", "ProductsController@resale");
Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/home', 'HomeController@index')->name('home');
Route::post("/rooms", "RoomsController@store");
Route::get("/rooms/{id}", "RoomsController@show");
Route::post("/messages", "MessagesController@store");
Route::post("/favorites", "FavoritesController@store");
Route::post("/favorites/{favorite}", "FavoritesController@update");
