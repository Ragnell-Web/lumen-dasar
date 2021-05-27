<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->group(['prefix'=>'api/v1'],function () use ($router)
{
   $router->get('acccustomerinvoicelist','AccCustomerInvoiceController@index');
   $router->post('acccustomerinvoicestore','AccCustomerInvoiceController@create');
   $router->get('acccustomerinvoiceedit','AccCustomerInvoiceController@show');
   $router->put('acccustomerinvoiceupdate','AccCustomerInvoiceController@update');
   $router->delete('acccustomerinvoicedelete','AccCustomerInvoiceController@destroy');

   
   $router->get('ttfentrylist','TtfEntryController@index');
   $router->post('ttfentrystore', 'TtfEntryController@create');   
   $router->put('ttfarhupdate', 'TtfEntryController@updateTtfArh');
   $router->put('ttfarlupdate', 'TtfEntryController@updateTtfArl');

   $router->post('ttfarhstore', 'TtfArhController@create');

   $router->get('customerlist','CustomerListController@index');

   $router->get('customeredit', 'CustomerWhereIdController@show');

   $router->post('detailcustomerstore','DetailCustomerController@create');
   $router->get('detailcustomeredit','DetailCustomerController@show');

   $router->post('detailcustomerupdate','UpdateCustomerController@updateTabelCustomer');

   $router->post('detailinvoiceupdate','UpdateInvoiceController@updateTabelInvoice');

   $router->get('datasuratjalanlist','DataSuratJalanController@index');

   $router->get('addcustomerfromsjlist','AddCustomerFromSjController@index');
   $router->delete('addcustomerfromsjdelete','AddCustomerFromSjController@destroy');

   $router->get('adddodtllist','AddDoDtlController@index');

});
