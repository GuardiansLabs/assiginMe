<?php

Route::group(['prefix' => 'v1'], function (): void {
    Route::post('register', 'LoginRegisterController@Register');
    Route::post('login', 'LoginRegisterController@login');
});
