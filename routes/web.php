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
	Route::get('/', 'Auth\LoginController@showLoginForm');
	Route::get('/home', 'HomeController@index')->name('home');
	
	Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
	Route::post('login', 'Auth\LoginController@login');
	Route::get('logout', 'Auth\LoginController@logout')->name('logout');

	Route::resource('tower', 'TowerController');
	Route::resource('floor', 'FloorController');
	Route::resource('unit_owner', 'UnitOwnerController');
	Route::resource('unit_renter', 'UnitRenterController');
	Route::resource('tenant', 'TenantController');
	Route::resource('marketing', 'MarketingController');
	Route::resource('unit_apart', 'UnitApartController');
	Route::resource('complain_category', 'ComplainCategoryController');
	Route::resource('complain', 'ComplainController');
	Route::resource('user', 'UserController');
	Route::resource('priv', 'PrivilegeController');
	Route::resource('tenant_category', 'TenantCategoryController');
	Route::resource('menu_category', 'MenuCategoryController');
	Route::resource('unit_apart_tenant', 'UnitApartTenantController');
	Route::resource('unit_tenant', 'UnitTenantController');
	Route::resource('concierge_category', 'ConciergeCategoryController');
	Route::resource('concierge_employee', 'ConciergeEmployeeController');
	Route::resource('concierge', 'ConciergeController');
	Route::resource('menu_tenant', 'MenuTenantController');
	Route::resource('change_password', 'ChangePasswordController');
	Route::resource('reset_password', 'ResetPasswordController');	
	Route::resource('tenant_list', 'UnitTenantController');	
	Route::resource('order_menu_tenant', 'OrderTenantController');
	Route::resource('order_list', 'OrderListController');
	Route::resource('tax_method', 'TaxMethodController');
	Route::resource('e_laundry_menu', 'ElaundryMenuController');
	Route::resource('e_cleaning_menu', 'EcleaningMenuController');
	Route::resource('e_ac_menu', 'EacMenuController');
	Route::resource('groceries_menu', 'GroceriesMenuController');

	Route::get('tower/{id}/delete', 'TowerController@deleteTemplate');
	Route::get('floor/{id}/delete', 'FloorController@deleteTemplate');
	Route::get('unit_owner/{id}/delete', 'UnitOwnerController@deleteTemplate');
	Route::get('unit_renter/{id}/delete', 'UnitRenterController@deleteTemplate');
	Route::get('marketing/{id}/delete', 'MarketingController@deleteTemplate');
	Route::get('unit_apart/{id}/delete', 'UnitApartController@deleteTemplate');
	Route::get('complain_category/{id}/delete', 'ComplainCategoryController@deleteTemplate');
	Route::get('complain/{id}/delete', 'ComplainController@deleteTemplate');
	Route::get('complain/{id}/edit/{id2}', 'ComplainController@edit');
	Route::post('complain/update/{id2}', 'ComplainController@update');
	Route::get('user/{id}/delete', 'UserController@deleteTemplate');
	Route::get('priv/{id}/delete', 'PrivilegeController@deleteTemplate');
	Route::post('user/update/{id2}', 'UserController@update');
	Route::get('tenant_category/{id}/delete', 'TenantCategoryController@deleteTemplate');
	Route::get('menu_category/{id}/delete', 'MenuCategoryController@deleteTemplate');
	Route::get('unit_apart_tenant/{id}/delete', 'UnitApartTenantController@deleteTemplate');
	Route::get('unit_tenant/{id}/delete', 'UnitTenantController@deleteTemplate');
	Route::get('concierge_category/{id}/delete', 'ConciergeCategoryController@deleteTemplate');
	Route::get('concierge_employee/{id}/delete', 'ConciergeEmployeeController@deleteTemplate');
	Route::get('concierge/{id}/delete', 'ConciergeController@deleteTemplate');
	Route::get('concierge/{id}/edit/{id2}', 'ConciergeController@edit');
	Route::post('concierge/update/{id2}', 'ConciergeController@update');
	Route::get('menu_tenant/{id}/delete', 'MenuTenantController@deleteTemplate');
	Route::get('order_menu_tenant/{id}/show', 'OrderTenantController@show');
	Route::get('order_menu_tenant/{id}/create', 'OrderTenantController@create');
	Route::get('tax_method/{id}/delete', 'TaxMethodController@deleteTemplate');
	Route::get('e_laundry_menu/{id}/delete', 'ElaundryMenuController@deleteTemplate');
	Route::get('e_cleaning_menu/{id}/delete', 'EcleaningMenuController@deleteTemplate');
	Route::get('e_ac_menu/{id}/delete', 'EacMenuController@deleteTemplate');
	Route::get('groceries_menu/{id}/delete', 'GroceriesMenuController@deleteTemplate');

	Route::group(['middleware' => 'auth'], function () {
		Route::get('password', 'PasswordController@change')->name('password.change');
		Route::put('password', 'PasswordController@update')->name('password.update');
	});
	
/*
|--------------------------------------------------------------------------
| Bill Type Routes
|--------------------------------------------------------------------------
|
*/	
	Route::resource('bill_type', 'BillTypeController');
	Route::post('bill_type/update/{id}', 'BillTypeController@update');
	Route::get('bill_type/{id}/delete', 'BillTypeController@deleteTemplate');
/*
|--------------------------------------------------------------------------
| Bill Owner Routes
|--------------------------------------------------------------------------
|
*/	
	Route::resource('bill_owner', 'BillOwnerController');
	Route::post('bill_owner/update/{id}', 'BillOwnerController@update');
	Route::get('bill_owner/{id}/delete', 'BillOwnerController@deleteTemplate');
	Route::get('bill_owner/{id}/set_payment', 'BillOwnerController@setPayment')->name('setPay');
	Route::post('bill_owner/save_payment/{id}', 'BillOwnerController@savePayment');
	Route::get('bill_owner/ajax/{id}', 'BillOwnerController@ajaxRequest')->name('ajaxReq');

	Route::resource('bill_aging', 'BillAgingController');
	Route::get('get_bills/{id}', 'BillOwnerController@get_bills');

/*
|--------------------------------------------------------------------------
| Payment Owner Routes
|--------------------------------------------------------------------------
|
*/
	Route::resource('payment_owner', 'PaymentOwnerController');
	Route::post('payment_owner/update/{id}', 'PaymentOwnerController@update');
	Route::get('payment_owner/{id}/delete', 'PaymentOwnerController@deleteTemplate');

/*
|--------------------------------------------------------------------------
| Notification Routes
|--------------------------------------------------------------------------
|
*/
Route::get('new_concierge', 'NotificationController@getNewConcierge');
Route::get('new_complain', 'NotificationController@getNewComplain');

/*
|--------------------------------------------------------------------------
| Export Excel
|--------------------------------------------------------------------------
|
*/

	Route::get('ExportClients', 'ExcelController@ExportClients');

/*
|--------------------------------------------------------------------------
| Mobile Routes
|--------------------------------------------------------------------------
|
*/
Route::get('/csrf_token','MobileController@csrf_token');
Route::get('/auth/{user}/{pwd}','MobileController@auth');
Route::get('/our_tenant/{id}','MobileController@tenant_list');
Route::get('/tenant_menu/{id}','MobileController@menu_list');
Route::get('/tenant_menu_detail/{id}','MobileController@menu_detail');

Route::group(['middleware' => 'cors'], function() {
	Route::post('/create_order','MobileController@create_order');
});
	
/*
|--------------------------------------------------------------------------
| Export Excel & PDF
|--------------------------------------------------------------------------
|
*/
Route::get('BillingExportExcel', 'BillOwnerController@export');
Route::get('BillingAgingExportExcel', 'BillAgingController@export');
Route::get('BillingCreateInvoice', 'BillOwnerController@pdf');
Route::get('BillingExportEfaktur', 'BillOwnerController@exportFaktur');

/*
|--------------------------------------------------------------------------
| Receiveable Card
|--------------------------------------------------------------------------
|
*/
Route::resource('receiveable_card', 'ReceiveableCardController');
Route::resource('forfeit_calculate', 'ForfeitCalculateController');

/*
|--------------------------------------------------------------------------
| Water Meter
|--------------------------------------------------------------------------
|
*/
Route::resource('water_meter', 'WaterMeterController');
Route::resource('water_meter_history', 'WaterMeterHistoryController');
Route::get('WaterMeterExportExcel', 'WaterMeterController@export');
Route::post('WaterMeterImportExcel', 'WaterMeterController@import');

/*
|--------------------------------------------------------------------------
| Electricity Meter
|--------------------------------------------------------------------------
|
*/
Route::resource('electricity_meter', 'ElectricityMeterController');
Route::resource('electricity_meter_history', 'ElectricityMeterHistoryController');
Route::get('ElectricityMeterExportExcel', 'ElectricityMeterController@export');
Route::post('ElectricityMeterImportExcel', 'ElectricityMeterController@import');

Route::get('water/{id}','WaterMeterController@get_meter');
Route::get('electricity/{id}','ElectricityMeterController@get_meter');
Route::get('forfeit/{id}','ForfeitCalculateController@get_forfeit');
Route::get('daya_terpasang/{id}','ElectricityPowerInstalledController@get_power');

/*
|--------------------------------------------------------------------------
| Billing HTML to PDF
|--------------------------------------------------------------------------
|
*/
	
Route::get('invoice/{id}',array('as'=>'invoice','uses'=>'BillOwnerController@invoice'));
Route::get('multi_invoice/{id}',array('as'=>'invoice','uses'=>'BillOwnerController@multi_invoice'));
Route::post('UnitOwnerImportExcel', 'UnitOwnerController@import');

Route::get('receipt/{id}',array('as'=>'receipt','uses'=>'PaymentOwnerController@receipt'));
Route::get('multi_receipt/{id}',array('as'=>'receipt','uses'=>'PaymentOwnerController@multi_receipt'));