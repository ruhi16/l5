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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'AdminController@home');

Route::get('/login', 'AdminController@login');
Route::post('/login-submit', 'AdminController@loginSubmit');

Route::get('/register', 'AdminController@register');
Route::post('/register-submit', 'AdminController@registerSubmit');


Route::group(['middleware' => 'admin',], function(){

	Route::get('/subject',   'SubjectController@subject');
	Route::get('/addSubject','SubjectController@addSubject');
	Route::post('/xyz', 'SubjectController@xyz')->name('xyz');
	Route::get('/updateSubject', 'SubjectController@updateSubject');


	Route::post('/updateMarks', 'SubjectController@updateMarks')->name('updateMarks');
	Route::post('/insertMarks', 'SubjectController@insertMarks')->name('insertMarks');


	Route::get('/classDetails', 'ClassController@classDetails');
	Route::get('/addClass', 'ClassController@addClass');



	Route::get('/test' , 'SubjectController@test');
	Route::get('/selectSubject', 'SubjectController@selectSubject');
  Route::post('/updateRoll', 'SubjectController@updateRoll');


	Route::post('updateIndividualMarks', 'ResultController@updateIndividualMarks');




	Route::get('/reportDetails', 'ResultController@reportDetails');
	Route::get('/studentResultPdf', 'ResultController@studentResultPdf');
	Route::get('/resultTableAll', 'ResultController@resultTableAll');
	Route::get('/studentRegisterPdf', 'ResultController@studentRegisterPdf');
	Route::get('/selectSubjectPdf', 'ResultController@selectSubjectPdf');
	Route::get('/studentSubRegisterPdf', 'ResultController@studentSubRegisterPdf');

  Route::post('/downloadResult', 'ResultController@downloadResult');
  Route::get('/qrTest', 'ResultController@qrTest');






	Route::get('/individualStudent/{id}', 'StudentController@individualStudent');



	Route::get('/students', 'StudentController@students');
	Route::get('/addStudent','AdminController@addStudent');
	Route::get('/editStudent/{n}',
		['as' => 'group', 'uses' => 'AdminController@getShow']
	)->where(['n'=>"[0-9]+"]);

	Route::get('/studentRoll', 'StudentController@studentRoll');
	Route::post('/rollUpdate', 'StudentController@rollUpdate');


	Route::post('/addMarks', 'SubjectController@addMarks');
	Route::get('/test2' , 'AdminController@test2');
	Route::post('/AddSubMrk', 'SubjectController@AddSubMrk');









	Route::get('/dashboard','AdminController@dashboard');


	Route::get('/logout',function(){
		session()->flush();
	    return redirect()->to('/home');
	});
});
