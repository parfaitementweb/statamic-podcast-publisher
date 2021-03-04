<?php

Route::prefix('podcast-publisher')->name('statamic-podcast-publisher.')->group(function() {
    Route::get('/', 'PodcastController@index')->name('index');
});
