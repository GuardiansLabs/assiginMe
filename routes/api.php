<?php

Route::group(['prefix' => 'v1'], function () {
    Route::post('register', 'LoginRegisterController@Register');
    Route::post('login', 'LoginRegisterController@login');
});
