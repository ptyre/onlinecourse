<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    
    Route::resource('contacts', 'ContactsController', ['except' => ['create', 'edit']]);

    Route::resource('titles', 'TitlesController', ['except' => ['create', 'edit']]);

    Route::resource('commentstudents', 'CommentstudentsController', ['except' => ['create', 'edit']]);

    Route::resource('news', 'NewsController', ['except' => ['create', 'edit']]);

    Route::resource('tags', 'TagsController', ['except' => ['create', 'edit']]);

    Route::resource('titlefooters', 'TitlefootersController', ['except' => ['create', 'edit']]);

    Route::resource('header_indices', 'HeaderIndicesController', ['except' => ['create', 'edit']]);

        Route::resource('services', 'ServicesController', ['except' => ['create', 'edit']]);

        Route::resource('registers', 'RegistersController', ['except' => ['create', 'edit']]);

        Route::resource('qoutes', 'QoutesController', ['except' => ['create', 'edit']]);
});
