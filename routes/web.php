<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\FullCalendarController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\ReminderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\WebexController;
use App\Http\Controllers\WorkshopClientsController;
use App\Http\Controllers\WorkshopController;
use App\Http\Controllers\AccountingController;
use App\Http\Livewire\Attachments\GetAttachments;
use App\Http\Livewire\Companies\CreateCompany;
use App\Http\Livewire\UserImport;
use Illuminate\Support\Facades\Route;
use App\DataTables\ClientsDataTable;
use App\Http\Controllers\UserController;
use Yajra\DataTables\Html\Builder;
use App\Mail\NewClient;
use App\Models\User;
use App\Models\Workshop;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\RoleController;
use Done\LaravelAPM\ApmController;
use App\Http\Controllers\PDFController;
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

require __DIR__.'/auth.php';

////////////////////////////
/// TEST Routes
////////////////////////////
///


Route::view('userst', 'livewire.users');
Route::get('manageTags', [TagController::class ,'manageTags'])
    ->name('manageTags');
Route::get('selectedTags/{id}', [TagController::class ,'selectedTags'])
    ->name('selectedTags');

//Route::mediaLibrary();
    Route::get('testemail', function () {
    Mail::to(['collin@scholl.one'])->send(new NewClient);
    });
Route::view('/Kalender', 'calendar');
////////////////////////////

////////////////////////////
/// Middleware Auth Routes
////////////////////////////
///

    Route::middleware(['auth'])->group(function () {

        Route::get('globalSearch', [SearchController::class, 'getSearchResults'])->name('globalSearch');
    Route::redirect('/', 'dashboard');
    Route::redirect('/pih', '/admin/');
////////////////////////////

////////////////////////////
///   Routes
////////////////////////////
///
        Route::get('inHouse', [FullCalendarController::class, 'index'])->name('inHouse');
        Route::get('getWorkshopEvents', [FullCalendarController::class, 'getWorkshopEvents']);
        Route::get('getWebexEvents', [FullCalendarController::class, 'getWebexEvents']);

        Route::get('getInHouseEvents', [FullCalendarController::class, 'getInHouseEvents']);
        Route::post('editEvents', [FullCalendarController::class, 'editEvents']);
    Route::resource('dashboard', HomeController::class, [
    'names' => [
        'index'   => 'home',
    ]]);

//        Route::get('/getAttachments', GetAttachments::class);
        Route::view('/getAttachments', 'attachments.show-attachments');
        Route::get('/create-reminder', [ReminderController::class ,'create'])
            ->name('reminder.create');
        Route::get('managePermissions', [RoleController::class ,'managePermissions'])
            ->name('managePermissions');
        Route::get('selectedPermissions/{id}', [RoleController::class ,'selectedPermissions'])
            ->name('selectedPermissions');
    Route::resource('roles', RoleController::class, [
        'names' => [
            'index'   => 'roles.index',
            'destroy' => 'roles.destroy',
        ],

    ]);
    Route::get('/changeStatus', [RoleController::class ,'changeStatus'])
        ->name('changeStatus');
    Route::get('users/list', [UserController::class ,'getUsers'])
        ->name('users.list');
    Route::resource('users', UserController::class, [
        'names' => [
            'index'   => 'users',
            'destroy' => 'users.destroy',
        ],

    ]);
        //Route Offers and Invoices
//        Route::get('/getOffers', [AccountingController::class, 'getOffers'])->name('getOffers');
        Route::get('/Angebote', [AccountingController::class, 'offers'])->name('allOffers');

        Route::get('/Angebote/Erstellen', [AccountingController::class, 'createOffer'])->name('createOffer');
        Route::get('/Angebote/{slug}', [AccountingController::class, 'showOffer'])->name('showOffer');
        Route::get('/Angebote/{slug}/edit', [AccountingController::class, 'editOffer'])->name('editOffer');

//        Route::get('/getInvoices', [AccountingController::class, 'getInvoices'])->name('getInvoices');
//        Route::get('/invoices/{slug}', [AccountingController::class, 'showInvoice'])->name('showInvoice');
//        Route::get('/invoices/{slug}/edit', [AccountingController::class, 'editInvoice'])->name('editInvoice');
        Route::view('/accounting', 'accounting.show-offers');
        Route::resource('accounting', AccountingController::class, [
            'names' => [
//                'index'   => 'accounting',
                'offers' => 'accountingOffers',
                'invoices' => 'accountingInvoices',
                'destroy' => 'accounting.destroy',
                'store'     => 'accounting.store',
                'update'    => 'accounting.update'
            ],

        ]);

        Route::get('/generate-offer/{id}', [PDFController::class, 'generateOfferPDF']);
        Route::get('/generate-invoice', [PDFController::class, 'generateInvoicePDF']);

        Route::resource('groups', GroupController::class, [
            'names' => [
                'index'   => 'groups.index',
            ],

        ]);
        Route::resource('companies', CompanyController::class, [
            'names' => [
                'index'   => 'companies',
                'destroy' => 'companies.destroy',
                'store'     => 'companies.store',
                'update'    => 'companies.update',
                'create'    => 'companies.create'
            ],

        ]);

        Route::view('imports', 'importsExports.imports-exports')->name('import');
    Route::get('getAttachableWorkshops', [ClientController::class ,'getAttachableWorkshops'])
        ->name('getAttachableWorkshops');
    Route::get('getCompanies', [ClientController::class ,'getCompanies'])
        ->name('getCompanies');
    Route::get('clients/list', [ClientController::class ,'getClients'])
        ->name('clients.list');
        Route::get('clients/destroy/{client}', [ClientController::class ,'destroy'])
            ->name('clientDestroy');
    Route::resource('clients', ClientController::class, [
    'names' => [
        'index'   => 'clients',
        'destroy' => 'client.destroy',
    ],
    'except' => [
        'deleted',
    ],
]);
        Route::get('trainers/destroy/{trainer}', [TrainerController::class ,'destroy'])
            ->name('trainerDestroy');
    Route::get('trainers/list', [TrainerController::class ,'getTrainers'])
        ->name('trainers.list');
Route::resource('trainers', TrainerController::class, [
    'names' => [
        'index'   => 'trainers',
        'destroy' => 'trainer.destroy',
    ],
    'except' => [
        'deleted',
    ],
]);
        Route::get('staff/destroy/{staff}', [StaffController::class ,'destroy'])
            ->name('staffDestroy');
        Route::get('staff/list', [StaffController::class ,'getTrainers'])
            ->name('staff.list');
        Route::resource('staff', StaffController::class, [
            'names' => [
                'index'   => 'staff',
                'destroy' => 'staff.destroy',
            ],
            'except' => [
                'deleted',
            ],
        ]);
Route::resource('locations', LocationController::class, [
    'names' => [
        'index'   => 'locations',
        'destroy' => 'location.destroy',
    ],
    'except' => [
        'deleted',
    ],
]);
////////////////////////////

////////////////////////////
/// FaceToFace Workshop Routes
////////////////////////////
///
//        Route::get("addmore",[WorkshopController::class, 'addTopic']);

        Route::post("addmore",[WorkshopController::class, 'addTopicPost']);
        Route::post("addWorkshop",[WorkshopController::class, 'addWorkshopPost']);
    Route::get('getClients', [WorkshopController::class, 'getClients'])->name('getClients');

    Route::get('workshops/{slug}/cancel',
    [ WorkshopController::class , 'cancelWorkshop'])
    ->middleware(['auth'])
    ->name('cancelWorkshop');
Route::put('workshops/{slug}/uncancel',
    [ WorkshopController::class , 'uncancelWorkshop'])
    ->name('uncancelWorkshop');

Route::get('workshops/{slug}/edit-clients',
    [ WorkshopClientsController::class , 'edit'])
    ->name('editClients');
Route::post('workshops/{workshop}',
    [ WorkshopClientsController::class , 'update'])
    ->name('updateClients');

    Route::get('workshopsend', [WorkshopController::class ,'setStatusEnded'])
        ->name('workshops.end');
    Route::get('workshops/list/', [WorkshopController::class ,'getWorkshops'])
        ->name('workshops.list');
        Route::get('workshops/destroy/{workshop}', [WorkshopController::class ,'destroy'])
            ->name('workshopDestroy');

Route::resource('workshops', WorkshopController::class, [
    'names' => [
        'index'   => 'workshops',
        'create' => 'workshops.create',
        'cancel' => 'workshops.cancel',
        'destroy' => 'workshops.destroy',
    ],
    'except' => [
        'deleted',
    ],
]);
////////////////////////////

////////////////////////////
/// WebEx Workshop Routes
////////////////////////////

    Route::get('webexes/list/', [WebexController::class ,'getWebexes'])
        ->name('webexes.list');
Route::get('webex/{slug}/edit-clients',
    [ WorkshopClientsController::class , 'edit'])
    ->name('editWebExClients');
Route::post('webex/{webex}',
    [ WorkshopClientsController::class , 'update'])
    ->name('updateWebExClients');
Route::resource('webex', WebexController::class, [
    'names' => [
        'index'   => 'webex',
        'create' => 'webex.create',
        'destroy' => 'webex.destroy',
    ],
    'except' => [
        'deleted',
    ],
]);
////////////////////////////
});
////////////////////////////

////////////////////////////
/// Middleware Auth Routes
////////////////////////////
///
