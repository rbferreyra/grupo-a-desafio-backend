<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'v1',
    'namespace' => '\\App\\Http\\Controllers\\',
], function () {
    Route::get('/students/{id}', 'StudentsController@show')->name('api.students.show');
    Route::put('/students/{id}', 'StudentsController@update')->name('api.students.update');
    Route::delete('/students/{id}', 'StudentsController@destroy')->name('api.students.destroy');
    Route::post('/students', 'StudentsController@store')->name('api.students.store');
    Route::get('/students', 'StudentsController@index')->name('api.students.index');
});
