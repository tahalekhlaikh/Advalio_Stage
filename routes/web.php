<?php

use Illuminate\Support\Facades\Route;

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



Auth::routes();


Auth::routes();




Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@About');
Route::get('/services', 'PagesController@services');
Route::resource('posts','PostsController');
Auth::routes();

Route::get('/consultant/dashboard', 'ConsultantController@EditProfile')->name('consultant.dashboard');

Route::post('ajaxdata/postdata', 'AjaxdataController@postdata')->name('ajaxdata.postdata');

route::namespace('Admin')->prefix('admin')->middleware(['auth','auth.admin'])->name('admin.')->group(function(){
    route::resource('/users','UserController',['except'=>['show']]);
    route::get('/documents','UserController@document');
    route::get('/pending','UserController@pending');
    Route::put('/post/{id}/approve','UserController@approval')->name('post.approve');
    Route::delete('/post/{id}/approve','UserController@DestroyDocument')->name('post.destroydocument');
    route::post('/users/CreateMission_Consultant/{id}','UserController@CreateMission_Consultant');
    route::post('/users/CreateMission_Salarié/{id}','UserController@CreateMission_Salarié');
    route::get('/missions','UserController@mission');
    route::get('/users/{id}/missions','UserController@Affecter_Mission');
    route::delete('/Mission/{id}/destroy','UserController@DestroyMission')->name('users.destroyMission');

 
});
route::namespace('Consultant')->prefix('consultant')->middleware(['auth','auth.consultant'])->name('consultant.')->group(function(){
    route::resource('/dashboard','ConsultantController');

    route::get('/dashboard/{id}/Adresse_Famille_Edit','ConsultantController@Adresse_Famille_Edit');
    route::put('/dashboard/UpdateProfile/{id}','ConsultantController@UpdateProfile');
    route::get('/dashboard/{id}/Entreprise_Edit','ConsultantController@Entreprise_Edit');
    route::put('/dashboard/UpdateEntreprise/{id}','ConsultantController@UpdateEntreprise');
    route::get('/documents','ConsultantController@document')->name('documents');
    route::get('/missions','ConsultantController@mission')->name('missions');
    route::post('/Timesheet','ConsultantController@TimeSheet')->name('dashboard.TimeSheet');
    route::get('/Timesheet','ConsultantController@TimeSheet')->name('dashboard.TimeSheet');
  
    route::get('/Remplir','ConsultantController@Remplir')->name('remplir');
    Route::get('/export_excel/excel1', 'ConsultantController@export')->name('export_excel.excel');
    Route::get('/export_excel/excel', 'ConsultantController@export_view')->name('export_excel.excel.view');
    Route::get('/dynamic_pdf/pdf', 'ConsultantController@pdf');
    route::get('/cra','ConsultantController@cra')->name('cra');
    route::get('/tableau','ConsultantController@tableau')->name('tableau');
    route::post('/dashboard/CreateCra/{id}','ConsultantController@CreateCRA');
    route::get('/fiche','ConsultantController@fiche')->name('fiche');
    Route::get('/select/{id}/Month','ConsultantController@Select_Month');
      
});

route::namespace('Salarié')->prefix('salarié')->middleware(['auth','auth.salarié'])->name('salarié.')->group(function(){
    route::resource('/dashboard','SalarieController',['except'=>['show']]);
   
    route::get('/dashboard/{id}/Adresse_Famille_Edit','SalarieController@Adresse_Famille_Edit');
    route::put('/dashboard/UpdateProfile/{id}','SalarieController@UpdateProfile');
    route::get('/dashboard/{id}/Entreprise_Edit','SalarieController@Entreprise_Edit');
    route::put('/dashboard/UpdateEntreprise/{id}','SalarieController@UpdateEntreprise');
    route::get('/documents','SalarieController@document')->name('documents');
    route::get('/CRA','SalarieController@CRA')->name('cra');
    route::get('/missions','SalarieController@mission')->name('missions');
    route::get('/fiche','SalarieController@fiche')->name('fiche');
    route::post('/dashboard/CreateCra/{id}','SalarieController@CreateCRA');
    Route::get('/select/{id}/month','SalarieController@Select_Month');
  
});
// Create file upload form
Route::get('/upload-file', 'DocumentUpload@createForm');

// Store file
Route::post('/upload-file', 'DocumentUpload@fileUpload')->name('fileUpload');


