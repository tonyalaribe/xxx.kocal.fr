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

Route::get('/', 'VideosController@showLastVideosAction')
    ->name('home');

Route::get('/categories', 'VideosController@showCategoriesAction')
    ->name('categories');

Route::get('/tags', 'TagsController@showTagsAction')
    ->name('tags');

Route::get('/tags/{tag}', 'TagsController@showTagAction')
    ->name('tag');

