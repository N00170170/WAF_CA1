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

Route::get('/', 'PageController@welcome')->name('welcome');
Route::get('/about', 'PageController@about')->name('about');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/admin/home', 'Admin\HomeController@index')->name('admin.home');
Route::get('/doctor/home', 'Doctor\HomeController@index')->name('doctor.home');
Route::get('/patient/home', 'Patient\HomeController@index')->name('patient.home');

//Admin routes
Route::get('/admin/doctors', 'Admin\DoctorController@index')->name('admin.doctors.index');
Route::get('/admin/doctors/create', 'Admin\DoctorController@create')->name('admin.doctors.create');
Route::get('/admin/doctors/{id}', 'Admin\DoctorController@show')->name('admin.doctors.show');
Route::post('/admin/doctors/store', 'Admin\DoctorController@store')->name('admin.doctors.store');
Route::get('/admin/doctors/{id}/edit', 'Admin\DoctorController@edit')->name('admin.doctors.edit');
Route::put('/admin/doctors/{id}', 'Admin\DoctorController@update')->name('admin.doctors.update');
Route::delete('/admin/doctors/{id}', 'Admin\DoctorController@destroy')->name('admin.doctors.destroy');

Route::get('/admin/patients', 'Admin\PatientController@index')->name('admin.patients.index');
Route::get('/admin/patients/create', 'Admin\PatientController@create')->name('admin.patients.create');
Route::get('/admin/patients/{id}', 'Admin\PatientController@show')->name('admin.patients.show');
Route::post('/admin/patients/store', 'Admin\PatientController@store')->name('admin.patients.store');
Route::get('/admin/patients/{id}/edit', 'Admin\PatientController@edit')->name('admin.patients.edit');
Route::put('/admin/patients/{id}', 'Admin\PatientController@update')->name('admin.patients.update');
Route::delete('/admin/patients/{id}', 'Admin\PatientController@destroy')->name('admin.patients.destroy');

Route::get('/admin/visits', 'Admin\VisitController@index')->name('admin.visits.index');
Route::get('/admin/visits/create', 'Admin\VisitController@create')->name('admin.visits.create');
Route::get('/admin/visits/{id}', 'Admin\VisitController@show')->name('admin.visits.show');
Route::post('/admin/visits/store', 'Admin\VisitController@store')->name('admin.visits.store');
Route::get('/admin/visits/{id}/edit', 'Admin\VisitController@edit')->name('admin.visits.edit');
Route::put('/admin/visits/{id}', 'Admin\VisitController@update')->name('admin.visits.update');
Route::delete('/admin/visits/{id}', 'Admin\VisitController@destroy')->name('admin.visits.destroy');

Route::get('/admin/insurance-companies', 'Admin\InsuranceCompanyController@index')->name('admin.insurancecompanies.index');
Route::get('/admin/insurance-companies/create', 'Admin\InsuranceCompanyController@create')->name('admin.insurancecompanies.create');
Route::get('/admin/insurance-companies/{id}', 'Admin\InsuranceCompanyController@show')->name('admin.insurancecompanies.show');
Route::post('/admin/insurance-companies/store', 'Admin\InsuranceCompanyController@store')->name('admin.insurancecompanies.store');
Route::get('/admin/insurance-companies/{id}/edit', 'Admin\InsuranceCompanyController@edit')->name('admin.insurancecompanies.edit');
Route::put('/admin/insurance-companies/{id}', 'Admin\InsuranceCompanyController@update')->name('admin.insurancecompanies.update');
Route::delete('/admin/insurance-companies/{id}', 'Admin\InsuranceCompanyController@destroy')->name('admin.insurancecompanies.destroy');

// Doctor routes
Route::get('/doctor/visits', 'Doctor\VisitController@index')->name('doctor.visits.index');
Route::get('/doctor/visits/create', 'Doctor\VisitController@create')->name('doctor.visits.create');
Route::get('/doctor/visits/{id}', 'Doctor\VisitController@show')->name('doctor.visits.show');
Route::post('/doctor/visits/store', 'Doctor\VisitController@store')->name('doctor.visits.store');
Route::get('/doctor/visits/{id}/edit', 'Doctor\VisitController@edit')->name('doctor.visits.edit');
Route::put('/doctor/visits/{id}', 'Doctor\VisitController@update')->name('doctor.visits.update');
Route::delete('/doctor/visits/{id}', 'Doctor\VisitController@destroy')->name('doctor.visits.destroy'); //do we need?
Route::get('/doctor/patients/{id}/visits', 'Doctor\VisitController@visitswithpatient')->name('doctor.visits.patient.index');
Route::get('/doctor/patients', 'Doctor\VisitController@mypatients')->name('doctor.patients.index');

//Patient routes
Route::get('/patient/visits', 'Patient\VisitController@index')->name('patient.visits.index');
Route::get('/patient/visits/{id}', 'Patient\VisitController@show')->name('patient.visits.show');
Route::delete('/patient/visits/{id}', 'Patient\VisitController@destroy')->name('patient.visits.destroy'); //do we need?
Route::get('/patient/doctors', 'Patient\VisitController@mydoctors')->name('patient.doctors.index');
Route::get('/patient/doctors/{id}/visits', 'Patient\VisitController@visitswithdoctor')->name('patient.visits.doctor.index');
