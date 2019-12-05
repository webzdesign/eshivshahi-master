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
	return redirect(route('login'));
});
Auth::routes();
/*Route::post('/login/custom',[
	'uses' => 'Auth\LoginController@login',
	'as' => 'login.custom'
]);*/
Route::post('/login/resetsendotp',[
	'uses' => 'Auth\LoginController@resetsendotp',
	'as' => 'login.resetsendotp'
]);
Route::post('/login/sendotp',[
	'uses' => 'Auth\LoginController@sendOtp',
	'as' => 'login.sendotp'
]);
Route::post('/login/changepwd',[
	'uses' => 'Auth\LoginController@changePwd',
	'as' => 'login.changepwd'
]);
Route::post('/login/changepassword',[
	'uses' => 'Auth\LoginController@changePassword',
	'as' => 'login.changepassword'
]);

Route::get('/resetpassword', function(){
  return view('auth/resetpassword');
});
Route::post('checkMobileNumber','Auth\LoginController@checkMobileNumber');
Route::post('checkOtp','Auth\LoginController@checkOtp');
Route::post('resetcheckMobileNumber','Auth\LoginController@resetcheckMobileNumber');

Route::group(['middleware' => 'auth','preventBackHistory'], function()
{
	Route::get('/home', 'HomeController@index')->name('home');

	Route::post('/checkpassword', 'ChangepasswordController@checkpassword');
	Route::post('/changepassword', 'ChangepasswordController@update');
	Route::get('/changepwd', 'ChangepasswordController@index');
/*  Puja */
	/* Division*/
	//	Route::get('division','DivisionController@index');
		Route::get('divisiondata','DivisionController@divisiondata');
		Route::post('checkdivision', 'DivisionController@checkdivision');
		Route::resource('division','DivisionController');

		/* Depot*/
		Route::get('depotdata','DepotController@depotdata');
		Route::post('checkdepot','DepotController@checkdepot');
		Route::resource('depot','DepotController');
  /* Access Type */
		Route::post('checkaccesstype','AccesstypeController@checkaccesstype');
		Route::get('accesstypedata','AccesstypeController@accesstypedata');
		Route::resource('accesstype','AccesstypeController');


		/* Vehicle */
		Route::get('vehicleactiveinactive/{type}/{id}','VehicleController@vehicleactiveinactive');
		Route::get('vehicledata','VehicleController@vehicledata');
		Route::post('getRoutesVehicle','VendorinvoicesController@getRoutesVehicle');
		Route::post('validatevehiclenum','VehicleController@validatevehiclenum');

		/** Hardik (For Get Depot)**/
	//	Route::post('/getvehicledepotdata','VehicleController@getDepot');
	  /** Hardik End **/
		Route::resource('vehicle','VehicleController');
	  /* Vendor Accountant */
		Route::post('checkVendorAcAllowUser','VendorAccountantController@checkAllowUser');/* Hardik Check Allow User*/
		Route::get('getvendoraccountant','VendorAccountantController@getvendoraccountant');
		Route::resource('vendoraccountant','VendorAccountantController');

	 /*  Puja */

	/*  Hardik */

		 /* User */
		 Route::resource('user','UserController');
		 Route::get('/getuserdata','UserController@get_data');
		 Route::get('/getuserhistroy','UserController@getuserhistroy');
		 Route::get('useractiveinactive/{type}/{id}','UserController@useractiveinactive');
		 Route::post('/getuserdepotdata','UserController@getDepotData');

		 /* User Type */
		Route::post('checkusertype','UsertypeController@checkusertype');
		Route::get('usertypedata','UsertypeController@usertypedata');
		Route::resource('usertype','UsertypeController');

		/* Vendor */
		Route::resource('vendordetail','VendorController');
		Route::get('/getvendordata','VendorController@get_data');
		Route::get('vendoractiveinactive/{type}/{id}','VendorController@vendoractiveinactive');

		/* Vendor Manger */
		Route::get('getvendormanger','VendorManagerController@getVendorManager');
		Route::resource('vendormanager','VendorManagerController');
		Route::post('checkVendorManagerAllowUser','VendorManagerController@checkAllowUser');

		/* Allow User Login */
		Route::get('allowuserdata','AllowuserController@allowuserdata');
		Route::post('checkallowuser','AllowuserController@checkallowuser');
		Route::resource('allowuser','AllowuserController');

		/* Vendor Invoice */
		Route::get('/vendor_invoice_print/{id}','VendorinvoicesController@printInvoice');
		Route::get('getvendorinvoicedata','VendorinvoicesController@getvendorinvoicedata');
		Route::post('getvehicleofvendor','VendorinvoicesController@getVehicleOfVendor');
		Route::post('getvendorinvoicedivisondepot','VendorinvoicesController@getDepotDivison');
		Route::post('getvendorinvoicedepot','VendorinvoicesController@getDepot');
		Route::post('checkduplicateinvoiceno','VendorinvoicesController@checkDuplicateInvoice');
		Route::post('confirmvendorinvoice','VendorinvoicesController@confirmvendorinvoice');
		Route::post('getschedulekm','VendorinvoicesController@getschedulekm');
		Route::post('getavgrate','VendorinvoicesController@getavgrate');
		Route::get('printVendorinvoice/{id}','VendorinvoicesController@printVendorinvoice');
		Route::post('checkInvoiceDateVehicle','VendorinvoicesController@checkInvoiceDateVehicle');
		Route::post('getScheduleNumber','VendorinvoicesController@getScheduleNumber');
		Route::resource('vendorinvoice','VendorinvoicesController');


		Route::get('getparisishthab','VendorinvoicesController@getparisishthab');
		Route::post('checkvoucher','VendorinvoicesController@checkvoucher');
		Route::post('getinvoicedata','VendorinvoicesController@getinvoicedata');
		Route::post('checkinvoice','VendorinvoicesController@checkinvoice');
		Route::post('getinvoice','VendorinvoicesController@getinvoice');
		Route::post('getparisishthadepotondivision','VendorinvoicesController@getDepot');
		Route::post('checkcityname','VendorinvoicesController@checkCityName');
		Route::post('addcityname','VendorinvoicesController@addCityName');

		Route::post('getVehicleVendorWise','VendorinvoicesController@getVehicle');
		Route::post('invoiceCheckdate','VendorinvoicesController@invoiceCheckdate');
		Route::post('getIdelingminutesInvoice','VendorinvoicesController@getIdelingminutes');
		Route::resource('vendorinvoice','VendorinvoicesController');



		/* Parisishtha A */
		Route::get('getParisisthB','ParisishthaAController@getParisisthB');
		Route::get('parisishthaa/create/{id}', [
			'as' => 'parisishthaa.create',
			'uses' => 'ParisishthaAController@create'
		]);
		Route::get('edithistoryA/{id}','ParisishthaAController@edithistoryA');
		Route::get('printparisishthaA/{id}','ParisishthaAController@printparisishthaA');

		Route::resource('parisishthaa','ParisishthaAController');

		/* Parisishtha B */
		Route::post('getschedulekm','ParisishthaBController@getschedulekm');
		Route::get('getparisishthab','ParisishthaBController@getparisishthab');
		Route::get('edithistory/{id}','ParisishthaBController@edithistory');
		Route::post('checkvoucher','ParisishthaBController@checkvoucher');
		Route::post('getinvoicedata','ParisishthaBController@getinvoicedata');
		Route::post('checkinvoice','ParisishthaBController@checkinvoice');
		Route::post('getinvoicepb','ParisishthaBController@getinvoice');
		Route::post('getparisishthadepotondivision','ParisishthaBController@getDepot');
		Route::post('checkcityname','ParisishthaBController@checkCityName');
		Route::post('addcityname','ParisishthaBController@addCityName');
		Route::post('getScheduledtime','ParisishthaBController@getScheduledtime');
		Route::post('checkperiod','ParisishthaBController@checkperiod');
		Route::post('getVehicleVendorWise','ParisishthaBController@getVehicle');
		Route::post('checkbus','ParisishthaBController@checkbus');
		Route::post('Checkdate','ParisishthaBController@Checkdate');
		Route::get('printparisishthaB/{id}','ParisishthaBController@printparisishthaB');
		Route::post('getIdelingminutes','ParisishthaBController@getIdelingminutes');
		Route::post('checkDisealPrice', 'ParisishthaBController@checkDisealPrice');
		Route::resource('parisishthab','ParisishthaBController');




		/* Bill Summary */
		Route::get('queryresolved/{id}','BillsummaryController@queryresolved');
		Route::get('getbillsummarydata','BillsummaryController@getBillSummayData');

		Route::post('/getvehicleData','BillsummaryController@getVehicleData');
		Route::post('/getBillSummay','BillsummaryController@getBillSummay');
		Route::post('/checkinvoiceab','BillsummaryController@checkinvoiceab');
		Route::get('billsummary/showapproval/{id}','BillsummaryController@showApproval');
		Route::get('editHistoryBillSummary/{id}','BillsummaryController@editHistoryBillSummary');

		Route::get('printBillsummary/{id}','BillsummaryController@printBillsummary');
		Route::resource('billsummary','BillsummaryController');

		/* parisishthabinvoice */
		Route::resource('parisishthabinvoice','ParisishthaBInvoiceController');
		Route::get('getparisishthabdataForBInvoice','ParisishthaBInvoiceController@getparisishthabData');
		Route::get('parisishthaBinvoiceconfirm/{id}','ParisishthaBInvoiceController@confirmInvoice');

	/*  Hardik */

	/* Permission Pratik on 12-09-2018*/
	Route::post('getPermission','PermissionController@permissionData');
	Route::resource('permission','PermissionController');

	/*
		By : Sneha Doso
		On : 13-09-2018
		Desc: For heirarchy set
	*/
	Route::group(['prefix' => 'hierarchy'], function() {
		Route::get('/', 'HierarchyController@index');
		Route::get('/set_hierarchy/{module}', 'HierarchyController@set_hierarchy');
		Route::post('/update_hierarchy', 'HierarchyController@update_hierarchy');
	});

	/*
		By : Pratik Donga
		On : 13-09-2018
		Desc: Bill Summary Confirm.
	*/

	Route::post('/getconfirmdatasummary', 'BillSummaryConfirmController@getconfirmdatasummary');
	Route::post('billsummaryconfirm/insertremarks', 'BillSummaryConfirmController@insertremarks');
	Route::post('/vendorconfirmsummary', 'BillSummaryConfirmController@vendorConfirmSummary');
	Route::post('/paribconfirmsummary', 'BillSummaryConfirmController@paribConfirmSummary');
	Route::post('/pariaconfirmsummary', 'BillSummaryConfirmController@pariaConfirmSummary');
	Route::resource('billsummaryconfirm','BillSummaryConfirmController');
	Route::get('getbillsummarydataForConfirm','BillSummaryConfirmController@getBillSummaryData');

	Route::resource('billsummarymanagerconfirm','BillSummaryConfirmManagerController');
	Route::get('getbillsummarydataForManagerConfirm','BillSummaryConfirmManagerController@getBillSummaryData');
	Route::get('showVendorInvoice/{id}','BillSummaryConfirmManagerController@showVendorInvoice');
	Route::get('showparisishthb/{id}','BillSummaryConfirmManagerController@showParisishthB');
	Route::get('showparisishthaa/{id}','BillSummaryConfirmManagerController@showParisishthA');

	 /* Rate Master */
	 Route::get('ratemasterdata','RateMasterController@rateMasterData');
	 Route::post('checkkm','RateMasterController@checkkm');
	 Route::resource('ratemaster','RateMasterController');

	/* Route Master */
	Route::get('routeMasterData','RouteMasterController@routeMasterData');
	Route::post('getdepot','RouteMasterController@getdepot');
	Route::post('checkmaxIdelingMinutes','RouteMasterController@checkmaxIdelingMinutes');
	Route::get('routeActiveInactive/{type}/{id}', 'RouteMasterController@routeActiveInactive');
	Route::post('checkScheduledTiming','RouteMasterController@checkScheduledTiming');
	Route::post('checkScheduledNumber','RouteMasterController@checkScheduledNumber');
	
	Route::resource('routemaster','RouteMasterController');


	/* vendor manager approval */
	Route::resource('vmmanager','VmManagerController');

	/* Charges Master */
	Route::get('getchargesdata','ChargesController@getchargesdata');
	Route::resource('charges','ChargesController');

	/* Query Billsummary */
	Route::get('getquerybillsummary','QueryController@getquerybillsummary');
	Route::resource('query','QueryController');
});
