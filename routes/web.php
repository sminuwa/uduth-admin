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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('admin.dashboard'); })->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix'=> "admin", 'middleware' => 'auth'], function(){
    Route::get('/', function () {return view('admin.dashboard'); });
    Route::get('patients', 'PatientController@index')->name('admin.patients');
    Route::post('patient/stats_year/', 'PatientController@get_stats_year')->name('admin.patient.get_stats_year');

    Route::get('services', 'ServiceController@index')->name('admin.services');
    Route::get('patient/{patient}/add-service', 'PatientController@add_service')->name('admin.patient.add.service');
    Route::post('patient/{patient}/store-service', 'PatientController@store_service')->name('admin.patient.store.service');
    Route::get('patient/{patient}/payment/{payment}/invoice', 'PatientController@payment_invoice')->name('admin.patient.payment.invoice');

    //dashboard
    //Route::post('dashboard/patient-stats/{year}', 'PatientController@user_patient_stats_year')->name('user.dashboard.patient_stats_year');
    //patient control resources
    Route::resource('patient', 'PatientController', [
        'names' => [
            'index' => 'admin.patient.index',
            'store' => 'admin.patient.store',
            'show' => 'admin.patient.show',
            'create' => 'admin.patient.create',
            'edit' => 'admin.patient.edit',
            'update' => 'admin.patient.update',
            'destroy' => 'admin.patient.destroy',
        ]
    ]);

    //report control resources
    Route::resource('report', 'ReportController', [
        'names' => [
            'index' => 'admin.report.index',
            'store' => 'admin.report.store',
            'show' => 'admin.report.show',
            'create' => 'admin.report.create',
            'edit' => 'admin.report.edit',
            'update' => 'admin.report.update',
            'destroy' => 'admin.report.destroy',
        ]
    ]);


    Route::get('user/{id}/suspended', 'UserController@suspend')->name('admin.user.suspend');
    Route::get('user/{id}/activated', 'UserController@activate')->name('admin.user.activate');
    //user control resources
    Route::resource('user', 'UserController', [
        'names' => [
            'index' => 'admin.user.index',
            'store' => 'admin.user.store',
            'show' => 'admin.user.show',
            'create' => 'admin.user.create',
            'edit' => 'admin.user.edit',
            'update' => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
        ]
    ]);

    //user control resources
    Route::resource('service', 'ServiceController', [
        'names' => [
            'index' => 'admin.service.index',
            'store' => 'admin.service.store',
            'show' => 'admin.service.show',
            'create' => 'admin.service.create',
            'edit' => 'admin.service.edit',
            'update' => 'admin.service.update',
            'destroy' => 'admin.service.destroy',
        ]
    ]);

    //user control resources
    Route::resource('service/type', 'ServiceTypeController', [
        'names' => [
            'index' => 'admin.service.type.index',
            'store' => 'admin.service.type.store',
            'show' => 'admin.service.type.show',
            'create' => 'admin.service.type.create',
            'edit' => 'admin.service.type.edit',
            'update' => 'admin.service.type.update',
            'destroy' => 'admin.service.type.destroy',
        ]
    ]);
    Route::post('configuration/disable', 'ConfigurationController@disable')->name('admin.configuration.disable');
    Route::resource('configuration', 'ConfigurationController', [
        'names' => [
            'index' => 'admin.configuration.index',
            'store' => 'admin.configuration.store',
            'show' => 'admin.configuration.show',
            'create' => 'admin.configuration.create',
            'edit' => 'admin.configuration.edit',
            'update' => 'admin.configuration.update',
            'destroy' => 'admin.configuration.destroy',
        ]
    ]);

    //ajax script for patient goes here
    Route::group(['script'], function(){
        Route::post('admin/ajax/services', function(){ return view('admin.ajax.services'); })->name('admin.ajax.services');
        Route::post('admin/ajax/service_type', function(){ return view('admin.ajax.service_type'); })->name('admin.ajax.service_type');
        Route::post('admin/ajax/service_amount', function(){ return view('admin.ajax.service_amount'); })->name('admin.ajax.service_amount');
    });

});

Route::group(['prefix'=> "user", 'middleware' => 'auth'], function(){
//    Route::get('/', function () {return view('user.dashboard'); });
    Route::get('patients', 'PatientController@index')->name('user.patients');
    Route::post('patient/stats_year/', 'PatientController@get_stats_year')->name('user.patient.get_stats_year');
    Route::get('services', 'ServiceController@index')->name('user.services');
    Route::get('patient/{patient}/add-service', 'PatientController@add_service')->name('user.patient.add.service');
    Route::post('patient/{patient}/store-service', 'PatientController@store_service')->name('user.patient.store.service');
    Route::get('patient/{patient}/payment/{payment}/invoice', 'PatientController@payment_invoice')->name('user.patient.payment.invoice');

    //dashboard
//    Route::post('dashboard/patient-stats/{year}', 'PatientController@user_patient_stats_year')->name('user.dashboard.patient_stats_year');

    //patient control resources
    Route::resource('patient', 'PatientController', [
        'names' => [
            'index' => 'user.patient.index',
            'store' => 'user.patient.store',
            'show' => 'user.patient.show',
            'create' => 'user.patient.create',
            'edit' => 'user.patient.edit',
            'update' => 'user.patient.update',
            'destroy' => 'user.patient.destroy',
        ]
    ]);

    //report control resources
    Route::resource('report', 'ReportController', [
        'names' => [
            'index' => 'user.report.index',
            'store' => 'user.report.store',
            'show' => 'user.report.show',
            'create' => 'user.report.create',
            'edit' => 'user.report.edit',
            'update' => 'user.report.update',
            'destroy' => 'user.report.destroy',
        ]
    ]);


    //ajax script for patient goes here
    Route::group(['script'], function(){
        Route::post('user/ajax/services', function(){ return view('user.ajax.services'); })->name('user.ajax.services');
        Route::post('user/ajax/service_type', function(){ return view('user.ajax.service_type'); })->name('user.ajax.service_type');
        Route::post('user/ajax/service_amount', function(){ return view('user.ajax.service_amount'); })->name('user.ajax.service_amount');
    });


});
