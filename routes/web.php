<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

/**
 * you can see the list of all the routes with all details by typing,
 * php artisan route:list on the commandline changing directory to
 * this project directory
 */

/**
 * Dashboard Route
 */
Route::get('/dashboard', 'DashBoardController@index')->name('dashboard');

/**
 * Categories Route
 */
Route::resource('/categories', 'CategoriesController');

/**
 * ClosingDates Route
 */
Route::resource('/closingdates', 'ClosingDatesController');

/**
 * PaymentDates Route
 */
Route::resource('/paymentdates', 'PaymentDatesController');

/**
 * Status Route
 */
Route::resource('/status', 'StatusController');

/**
 * Employees Route
 */
Route::resource('/employees', 'EmployeesController');

Route::post('/employees/search', 'EmployeesController@search')->name('employees.search');

/**
 * Clients Route
 */
Route::resource('/clients', 'ClientsController');

Route::post('/clients/search', 'ClientsController@search')->name('clients.search');

/**
 * Workplaces Route
 */
Route::resource('/workplaces', 'WorkplacesController');

Route::post('/workplaces/search', 'WorkplacesController@search')->name('workplaces.search');
Route::get('/workplaces/copy/{id}', 'WorkplacesController@copy')->name('workplaces.copy');

/**
 * SalesHistory Route
 */
Route::resource('/shistories', 'SalesHistoriesController');

// Route::post('/workplaces/search', 'WorkplacesController@search')->name('workplaces.search');

/**
 * DataIO Route
 */
Route::resource('/dataio', 'DataIOController');
Route::post('/dataio/outputclient', 'DataIOController@outputClient')->name('dataio.outputclient');

/**
 * Admins Route
 */
Route::resource('/admins', 'AdminsController');

/**
 * Auth Routes
 */

//Show the login view
Route::get('/', 'AuthController@index')->name('login')->middleware('guest');

//Authenticate a user
Route::post('/', 'AuthController@authenticate')->name('auth.authenticate');

//Logout the user
Route::get('/logout', 'AuthController@logout')->name('auth.logout')->middleware('auth');

//Show user details
Route::get('/admin', 'AuthController@show')->name('auth.detail')->middleware('auth');
