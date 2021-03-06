<?php

Route::group([
    'as' => 'admin.',
    'prefix' => 'admin',
    'namespace' => 'Admin',
    'middleware' => ['auth', 'role:admin|manager'],
], function () {
    Route::get('/', function () {
        return redirect()->route('admin.crm.projects.index');
    })->name('index');

    Route::resource('briefs', 'BriefController')->except('show');
    Route::resource('works', 'WorkController')->except('show');
    Route::resource('users', 'UsersController')->except('show');
    Route::resource('contacts', 'ContactsController')->except('show');

    Route::group([
        'as' => 'crm.',
        'prefix' => 'crm'
    ], function () {
        Route::resource('projects', 'ProjectsController');
        Route::resource('projects/{project}/stages', 'StagesController');

        Route::group([
            'as' => 'tags.', 'prefix' => 'tags'
        ], function() {
            Route::get('/', 'TagsController@all')->name('all');
            Route::post('/', 'TagsController@store')->name('store');
        });
    });
});
