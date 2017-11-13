<?php

Route::group(['namespace' => 'Api', 'middleware' => 'api'], function() {
    Route::get('books', 'BooksController@get')->name('api.books.get');
    Route::post('books', 'BooksController@createPost')->name('api.books.create.post');
    Route::get('books/categories', 'BooksController@getCategories')->name('api.books.categories.get');
});
