<?php

//Vue js Api Route
Route::apiResources(
	[
		'user' => 'API\UserController',
		'photo' => 'API\PhotoController',
		'role' => 'API\RoleController',
		'permission' => 'API\PermissionController',
		'category' => 'API\CategoryController',
		'article' => 'API\PostController',
	]
);

Route::get('/profile', 'API\UserController@profile');
Route::put('/profile', 'API\UserController@updateProfile');
Route::get('/search', 'API\UserController@search');
