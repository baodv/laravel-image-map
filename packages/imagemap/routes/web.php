<?php
Route::get('demo-image-map',function(){
    return 'contact';
});
Route::group(['prefix' => 'image-map','namespace' => 'BaoDo\ImageMap\Http\Controllers'], function () {
	Route::get('/','ImageMapController@index')->name('image.map.index');
	Route::get('/create','ImageMapController@create')->name('image.map.create');
	Route::post('/','ImageMapController@store')->name('image.map.store');

	Route::get('/{id}/edit','ImageMapController@edit')->name('image.map.edit');
	Route::get('/{id}','ImageMapController@show')->name('image.map.show');

	Route::post('add-point','ImageMapController@addPoint')->name('image.map.add.point');
});