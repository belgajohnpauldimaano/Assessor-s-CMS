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
use App\pqa_assessors_info;
// Route::get('/', function () {
//     return view('welcome');
// });



Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'assesor', 'middleware' => 'auth'], function () {

    Route::get('/', 'AssessorController@index')->name('assessor');
    Route::post('/fetch_personal_modal', 'AssessorController@fetch_personal_modal')->name('fetch_personal_modal');
    Route::post('/save_personal_info', 'AssessorController@save_personal_info')->name('save_personal_info');
    Route::post('/fetch_personal_info_ajax', 'AssessorController@fetch_personal_info_ajax')->name('fetch_personal_info_ajax');

    Route::post('/form_education_modal', 'AssessorController@form_education_modal')->name('form_education_modal');
    Route::post('/fetch_education_info', 'AssessorController@fetch_education_info')->name('fetch_education_info');
    Route::post('/save_education', 'AssessorController@save_education')->name('save_education');
    Route::post('/delete_education', 'AssessorController@delete_education')->name('delete_education');
    
    Route::post('/fetch_trainings', 'AssessorController@fetch_trainings')->name('fetch_trainings');
    Route::post('/form_training_modal', 'AssessorController@form_training_modal')->name('form_training_modal');
    Route::post('/save_training', 'AssessorController@save_training')->name('save_training');
    Route::post('/delete_training', 'AssessorController@delete_training')->name('delete_training');
    Route::get('/download', 'AssessorController@download')->name('download');
    

    Route::get('/employment_record', 'AssessorController@employment_record')->name('employment_record');
    Route::post('/fetch_employment_record', 'AssessorController@fetch_employment_record')->name('fetch_employment_record');
    Route::post('/form_employment_record_modal', 'AssessorController@form_employment_record_modal')->name('form_employment_record_modal');
    Route::post('/save_employment_record', 'AssessorController@save_employment_record')->name('save_employment_record');
    Route::post('/delete_employment_record', 'AssessorController@delete_employment_record')->name('delete_employment_record');

    Route::post('/save_consultancy', 'AssessorController@save_consultancy')->name('save_consultancy');


    Route::get('/capability_assessment', 'AssessorController@capability_assessment')->name('capability_assessment');
    Route::post('/save_capability_assessment', 'AssessorController@save_capability_assessment')->name('save_capability_assessment');
    
    Route::get('/disclosure_conflict_interest', 'AssessorController@disclosure_conflict_interest')->name('disclosure_conflict_interest');
    Route::post('/disclosure_conflict_interest_records', 'AssessorController@disclosure_conflict_interest_records')->name('disclosure_conflict_interest_records');
    Route::post('/disclosure_conflict_interest_form_modal', 'AssessorController@disclosure_conflict_interest_form_modal')->name('disclosure_conflict_interest_form_modal');
    Route::post('/disclosure_conflict_interest_save', 'AssessorController@disclosure_conflict_interest_save')->name('disclosure_conflict_interest_save');
    Route::post('/disclosure_conflict_interest_delete', 'AssessorController@disclosure_conflict_interest_delete')->name('disclosure_conflict_interest_delete');
    
    
    Route::get('/materials', 'AssessorController@materials')->name('materials');
    Route::get('/download_file/{file?}', 'AssessorController@download_file')->name('materials_download');

});

Route::get('/', 'Auth\LoginController@index')->name('login');

Route::post('/logout', 'Auth\LoginController@logout')
    ->name('logout')
    ->middleware('auth');

Route::post('/change_password', 'Auth\LoginController@change_password')
    ->name('change_password')
    ;//->middleware('auth');
    
Route::post('/validate', 'Auth\LoginController@validateUser')->name('validate');
Route::get('/showuser', 'Auth\LoginController@showUser')->name('showuser');
