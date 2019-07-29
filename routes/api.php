<?php

Route::group(['prefix' => 'v1'], function (): void {
    Route::post('register', 'LoginRegisterController@Register');
    Route::post('login', 'LoginRegisterController@login');
});

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function (): void {
    Route::get('get-my-board', 'LoginRegisterController@getMyBoard');
});
