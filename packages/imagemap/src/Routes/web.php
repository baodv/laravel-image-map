<?php
Route::get('demo-image-map',function(){
    return 'contact';
});
Route::group(['prefix' => 'image-map','namespace' => 'BaoDo\ImageMap\Http\Controllers'], function () {
	Route::get('/','ImageMapController@index');
	Route::post('/','ImageMapController@store')->name('image.map.store');

	Route::post('add-point','ImageMapController@addPoint')->name('image.map.add.point');
});