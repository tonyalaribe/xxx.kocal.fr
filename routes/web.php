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
    return redirect('videos', 302);
})->name('home');

Route::get('/videos', 'VideosController@showLastVideosAction')
    ->name('videos');

Route::get('/videos/search', 'VideosController@showVideosBySearchTerms')
    ->name('videos_by_search_terms');

Route::get('/videos/{tag}', 'VideosController@showVideosByTagAction')
    ->name('videos_by_tag');

Route::get('/categories', 'TagsController@showCategoriesAction')
    ->name('categories');

Route::get('/tags', 'TagsController@showTagsAction')
    ->name('tags');

Route::get('/tags/{tag}', 'TagsController@showTagAction')
    ->name('tag');

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'middleware' => 'shield'
], function () {
    Route::get('/', 'AdminController@showIndex')->name('index');

    Route::delete('/delete_video/{id}', 'AdminController@deleteVideo')->name('delete_video');
});

Route::get('/logout', function () {
    return response(view('logout'), 401);
})->name('logout');

