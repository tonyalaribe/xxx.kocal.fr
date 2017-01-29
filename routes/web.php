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

Route::group(['prefix' => 'api'], function() {
    Route::get('inFrontTags', 'ApiController@getInFrontTags');
    Route::get('sortedTags', 'ApiController@getSortedTags');
    Route::get('/{catchall?}', function () {
        return response('', 404);
    })->where('catchall', '(.*)');
});

Route::get('/{catchall?}', function () {
    return view('app');
})->where('catchall', '(.*)');
