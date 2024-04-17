<?php

use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\TimeAttendanceReportController;
use App\Http\Controllers\Admin\ProcurementController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SupllierController;
use App\Http\Controllers\Admin\SalesServicesController;
use App\Http\Controllers\Admin\SalesAutomationController;
use App\Http\Controllers\Admin\CustomerServiceController;
use App\Http\Controllers\Admin\AnalyticsController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FingerprintController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('/');
################################
# // Application Routes start  #
################################
Route::controller(ApplicationController::class)->group(function(){
    Route::get('/application/form','showForm')->name('application.form');
    Route::post('/application/submit','submitForm')->name('application.submit');
});
################################
# // Application Routes end    #
################################
######################################
# // User Registration Routes start  #
######################################
// Route::group(['prefix' => 'admin'], function () {
    // });
    Route::controller(LoginController::class)->group(function(){
        Route::post('login', 'login')->name('login');
        Route::get('logout', 'logout')->name('logout');
    });
######################################
# // User Registration Routes end    #
######################################

######################################
# // Admin  Routes start          // #
######################################
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'custom.auth']], function () {
    Route::get('dashboard', [HomeController::class, 'dashboard'])->name('admin.dashboard');
    ######################### HR management start ###################
    Route::controller(EmployeeController::class)->group(function(){
        Route::get('list/employee', 'index')->name('admin.employee.list');
        Route::get('add/employee', 'create')->name('admin.create-employee');
        Route::post('store/employee', 'store')->name('admin.employee.store');
        Route::get('edit/employee/{id}', 'edit')->name('admin.employee.edit');
        Route::post('update/employee/{id}', 'update')->name('admin.employee.update');
        Route::get('delete/employee/{id}', 'destroy')->name('admin.employee.delete');
    });
    Route::controller(PayrollController::class)->group(function(){
        Route::get('list/payroll', 'index')->name('admin.payroll.list');
        Route::get('add/payroll', 'create')->name('admin.payroll.create');
        Route::post('store/payroll', 'store')->name('admin.payroll.store');
        Route::get('edit/payroll/{id}', 'edit')->name('admin.payroll.edit');
        Route::post('update/payroll/{id}', 'update')->name('admin.payroll.update');
        Route::get('delete/payroll/{id}', 'destroy')->name('admin.payroll.delete');
        Route::get('/get-employee-details/{id}', 'getEmployeeDetails');
    });
    Route::controller(TimeAttendanceReportController::class)->group(function(){
        Route::get('list/time_attendance_reports', 'index')->name('admin.time-attendance-reports.list');
        Route::get('add/time_attendance_reports', 'create')->name('admin.create.time-attendance-reports');
        Route::post('store/time_attendance_reports', 'store')->name('admin.store.time-attendance-reports');
        Route::get('edit/time_attendance_reports/{id}', 'edit')->name('admin.time-attendance-reports.edit');
        Route::post('update/time_attendance_reports/{id}', 'update')->name('admin.time-attendance-reports.update');
        Route::get('delete/time_attendance_reports/{id}', 'destroy')->name('admin.time-attendance-reports.delete');
        Route::get('/get-office-time/{employeeId}', 'getOfficeTime');
    });
    Route::controller(ApplicationController::class)->group(function(){
        Route::get('list/talent_acquisitions','index')->name('admin.talent_acquisitions.list');
        Route::get('view/talent_acquisitions/{id}','show')->name('admin.talent_acquisitions.view');
    });
    // pdf controller for talent acquisitions
    Route::get('/pdf/{id}', [PdfController::class, 'showPdf'])->name('pdf.show');
    ######################### HR management end ###################
    ######################### CRM management start ################
     Route::controller(CompanyController::class)->group(function(){
         Route::get('list/crm_companies', 'index')->name('admin.company-list');
         Route::get('create/crm_companies', 'create')->name('admin.company-create');
         Route::post('store/crm_companies', 'store')->name('admin.companies-store');
         Route::get('edit/crm_companies/{id}', 'edit')->name('admin.company-edit');
         Route::post('update/crm_companies/{id}', 'update')->name('admin.company-update');
         // Route::get('edit/crm_companies/{id}', 'edit')->name('admin.company-edit');
         Route::get('delete/crm_companies/{id}', 'destroy')->name('admin.company-delete');
     });
    Route::controller(CustomerController::class)->group(function(){
        Route::get('list/crm_customers', 'index')->name('admin.customer-list');
        Route::get('add/crm_customers', 'create')->name('admin.customer-create');
        Route::post('store/crm_customers', 'store')->name('admin.customer-store');
        Route::get('edit/crm_customers/{id}', 'edit')->name('admin.customer-edit');
        Route::post('update/crm_customers/{id}', 'update')->name('admin.customer-update');
        Route::get('delete/crm_customers/{id}', 'destroye')->name('admin.customer-delete');
    });

    //  customers Routes end
    // saleservices route start
    Route::controller(SalesServicesController::class)->group(function(){
        Route::get('list/crm-salesServices-list','index')->name('admin.crm-salesServices-list');
        Route::get('list/crm-salesServices-create','create')->name('admin.crm-salesServices-create');
        Route::post('list/crm-salesServices-store','store')->name('admin.crm-salesServices-store');
        Route::get('list/crm-salesServices-edit/{id}','edit')->name('admin.crm-salesServices-edit');
        Route::post('list/crm-salesServices-update/{id}','update')->name('admin.crm-salesServices-update');
        Route::get('list/crm-salesServices-delete/{id}','destroy')->name('admin.crm-salesServices-delete');

    });
    // saleservices route end

     ######################### CRM management end #####################


     ######################### Inventory management start #####################

     //  product  routes start
     Route::controller(ProductController::class)->group(function(){
            Route::get('/product/product-list','index')->name('admin.product-list');
            Route::get('/product/product-create','create')->name('admin.product-create');
            Route::post('/product/product-list','store')->name('admin.product-store');
            Route::get('/product/product-edit/{id}','edit')->name('admin.product-edit');
            Route::post('/product/product-update/{id}','update')->name('admin.product-update');
            Route::get('/product/product-delete/{id}','destroy')->name('admin.product-delete');
     });
     //  product  routes end

    //  suppliers route start
    Route::controller(SupllierController::class)->group(function(){
        Route::get('/supplier/supplier-list','index')->name('admin.supplier-list');
        Route::get('/supplier/supplier-create','create')->name('admin.supplier-create');
        Route::post('/supplier/supplier-store','store')->name('admin.supplier-store');
        Route::get('/supplier/supplier-edit/{id}','edit')->name('admin.supplier-edit');
        Route::post('/supplier/supplier-update/{id}','update')->name('admin.supplier-update');
        Route::get('/supplier/supplier-delete/{id}','destroy')->name('admin.supplier-delete');
    });
    //  suppliers route end

     //  procurement routes start
     Route::controller(ProcurementController::class)->group(function() {
        Route::get('/inventory/procurement-list', 'index')->name('admin.procurement-list');
        Route::get('/inventory/create-form', 'create')->name('admin.procurement-create');
        Route::post('/inventory/create-store', 'store')->name('admin.procurement-store');
        Route::get('/inventory/create-edit/{id}', 'edit')->name('admin.procurement-edit');
        Route::post('/inventory/create-update/{id}', 'update')->name('admin.procurement-update');
        Route::get('/inventory/create-delete/{id}', 'destroy')->name('admin.procurement-delete');
        // Route::delete('/feedback/{id}', 'destroy');


        Route::get('/inventory-get-supplier-products','getSupplierProducts')->name('admin.procurement-get-supplier-products');
    });
    //  procurement routes end

     ######################### Inventory management end #######################

     ######################### Finance and accounting section start ######################
     Route::controller(SalesAutomationController::class)->group(function(){
            Route::get('/finance-accounting/sales-automation-list','index')->name('admin.sales.automation-list');
            Route::get('/finance-accounting/sales-automation-create','create')->name('admin.sales.automation-create');
            Route::post('/finance-accounting/sales-automation-store','store')->name('admin.sales.automation-store');
            Route::get('/finance-accounting/sales-automation-edit/{id}','edit')->name('admin.sales.automation-edit');
            Route::get('/finance-accounting/sales-automation-delete/{id}','destroy')->name('admin.sales.automation-delete');
            Route::get('/finance-accounting/sales-automation-get-customer-prodcuts','getCustomerProducts')->name('admin.sales.automation-get-customer-prodcuts');
            Route::get('/finance-accounting/sales-automation-customer-prodcuts-data','getCustomerProductData')->name('admin.sales.automation-customer-prodcuts-data');
     });
     Route::controller(CustomerServiceController::class)->group(function(){
            Route::get('/finance-accounting/customer-service-list','index')->name('admin.customer.service-list');
            Route::get('/finance-accounting/customer-service-create','create')->name('admin.customer.service-create');
            Route::post('/finance-accounting/customer-service-store','store')->name('admin.customer.service-store');
     });
     Route::controller(AnalyticsController::class)->group(function(){
            Route::get('/finance-accounting/analytics-list','index')->name('admin.analytics-list');
     });

     #########################  Finance and accounting section end #######################



    //  Route::get('/get-attendance', [FingerprintController::class, 'getAttendance']);
});
######################################
# // Admin  Routes end            // #
######################################
