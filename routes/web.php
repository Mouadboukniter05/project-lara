<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

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
Route::get('locale/{locale}', function ($locale){
    Session::put('locale', $locale);
    return redirect()->back();
});
Auth::routes();
Route::get('/index', function() {
    return view('index');
});

Route::get('/', function () {
	// return view('welcome');
	return redirect('/login') ;
});

Route::post('/contacts/store', 'ContactController@store')->name('contact.store');
Route::get('/contacts/create', 'ContactController@create')->name('contact.create') ;

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function(){

	// PDF-----------------------------------------------------------//

	Route::get('/PDF/{id}', 'PDFController@gen')->name('PDF.Print') ;
	Route::get('/convertNumberToWord/{num}', 'PDFController@convertNumberToWord')->name('conv.Print') ;

	//Customers----------------------------------------------------//
	// ==============================================================
	Route::get('/messages', 'LetterController@index')->name('message.show') ;

	Route::get('/messages/create', 'LetterController@create')->name('message.create') ;

	Route::get('/messages/delete/{id}', 'LetterController@destroy')->name('message.delete') ;

	Route::get('/message/see/{id}', 'LetterController@showmess')->name('letter.pola');

	Route::post('/messages/store', 'LetterController@store')->name('message.store');
	// =============================================================================
	Route::get('/boit_messages', 'MessageController@index')->name('boit_message.show') ;
	
	Route::get('/boit_messages_in', 'MessageController@index_in')->name('boit_message_in.show') ;

	Route::get('/boit_messages/create', 'MessageController@create')->name('boit_message.create') ;

	Route::get('/boit_messages/delete/{id}', 'MessageController@destroy')->name('boit_message.delete') ;

	Route::post('/boit_messages/store', 'MessageController@store')->name('boit_message.store');



	//======================================================================== 
	Route::get('/customers', 'CustomerController@index')->name('customer.show') ;

	Route::get('/customers/create', 'CustomerController@create')->name('customer.create') ;

	Route::get('/customers/edit/{id}', 'CustomerController@edit')->name('customer.edit') ;

	Route::post('/customers/update/{id}', 'CustomerController@update')->name('customer.update') ;

	Route::get('/customers/delete/{id}', 'CustomerController@destroy')->name('customer.delete') ;

	// Store the new project from the form posted with the view Above
	Route::post('/customers/store', 'CustomerController@store')->name('customer.store');

	// ==================== Contact =======================


	Route::get('/contacts', 'ContactController@index')->name('contact.show') ;


	Route::get('/contacts/delete/{id}', 'ContactController@destroy')->name('contact.delete') ;


	Route::get('/contacts/show/{id}','ContactController@show')->name('contact.view') ;



	

	


// ====================  Reports =======================
// Route::get('/reports','ReportController@index')->name('report.show') ;

// Route::get('/reports/view/{id}','ReportController@view')->name('report.view') ;

// // Display the Create Task View form
// Route::get('/reports/create', 'ReportController@create')->name('report.create'); 

// // Store the new task from the form posted with the view Above
// Route::post('/reports/store', 'ReportController@store')->name('report.store');

// Route::get('/reports/edit/{id}','ReportController@edit')->name('report.edit');

// Route::get('/reports/delete/{id}', 'ReportController@destroy')->name('report.delete') ;
// Route::post('/reports/update/{id}', 'ReportController@update')->name('report.update') ;



// ===============================projet======================================================================


// Route::get('/projets','ProjetController@index')->name('projet.show') ;

// Route::get('/projets/view/{id}','ProjetController@view')->name('projet.view') ;

// // Display the Create Task View form
// Route::get('/projets/create', 'ProjetController@create')->name('projet.create'); 

// // Store the new task from the form posted with the view Above
// Route::post('/projets/store', 'ProjetController@store')->name('projet.store');

// // Search view
// Route::get('/projets/search', 'ProjetController@searchProjet')->name('projet.search');

// // Sort Table
// Route::get('/projets/sort/{key}', 'ProjetController@sort')->name('projet.sort') ;

// Route::get('/projets/edit/{id}','ProjetController@edit')->name('projet.edit');

Route::get('/projets/list/{customertid}','ProjetController@projetlist')->name('projet.list');
Route::get('/projets/delete/{id}', 'ProjetController@destroy')->name('projet.delete') ;
Route::get('/projets/deletefile/{id}', 'ProjetController@deleteFile')->name('projet.deletefile') ;
Route::post('/projets/update/{id}', 'ProjetController@update')->name('projet.update') ;
Route::get('/projets/completed/{id}','ProjetController@completed')->name('projet.completed');


// ==================================End Projet===============================================================



// ===============================Check======================================================================


Route::get('/checks','CheckController@index')->name('check.show') ;
Route::get('/checks_2','CheckController@index_2')->name('check.show_2') ;

Route::get('/checks/view/{id}','CheckController@view')->name('check.view') ;

// Display the Create Task View form
Route::get('/checks/create', 'CheckController@create')->name('check.create'); 

// Store the new task from the form posted with the view Above
Route::post('/checks/store', 'CheckController@store')->name('check.store');

// Search view
// Route::get('/checks/search', 'CheckController@searchCheck')->name('check.search');

// Sort Table
// Route::get('/checks/sort/{key}', 'CheckController@sort')->name('check.sort') ;

 Route::get('/checks/edit/{id}','CheckController@edit')->name('check.edit');

 Route::get('/checks/list/{customerid}','CheckController@checklist')->name('check.list'); 
 Route::get('/checks/delete/{id}', 'CheckController@destroy')->name('check.delete') ;
 Route::get('/checks/deletefile/{id}', 'CheckController@deleteFile')->name('check.deletefile') ;
 Route::post('/checks/update/{id}', 'CheckController@update')->name('check.update') ;
 Route::get('/checks/completed/{id}','CheckController@completed')->name('check.completed');


 // ==================================End Cheks=====================================================================


	// =====================  USERS   ============================
	Route::get('/users', 'UserController@index')->name('user.index'); 
	Route::get('/users/list/{id}','UserController@userCheckList')->name('user.list');
	Route::get('/users/create', 'UserController@create')->name('user.create');  
    Route::post('/users/store', 'UserController@store')->name('user.store'); 
	Route::get('/users/edit/{id}', 'UserController@edit')->name('user.edit'); 
	Route::post('/users/update/{id}', 'UserController@update')->name('user.update') ;
    Route::get('/users/activate/{id}', 'UserController@activate')->name('user.activate') ; 
    Route::get('/users/delete/{id}', 'UserController@destroy')->name('user.delete') ;
    Route::get('/users/disable/{id}', 'UserController@disable')->name('user.disable') ;

});
