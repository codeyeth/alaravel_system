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

//R ROUTES
Route::get('/', function () {
    if (Auth::guard()) {
        return redirect('/home');
    }else{
        return view('auth.login');
    }
});

Auth::routes();

//DASHBOARD
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//USER MANAGEMENT
Route::get('/user_mgt', [App\Http\Controllers\RrUserManagementController::class, 'index']);
Route::get('/user_profile/{id}', function ($user_id) {
    $breadcrumb = "User Profile";
    $sidebar = "User Management";
    
    return view('rr_user_mgt.user_profile')->with('user_id', $user_id)->with('breadcrumb', $breadcrumb)->with('sidebar', $sidebar);
});

Route::resource('change_pass', 'RrChangePasswordController');

//BALLOT TRACKING
Route::get('/ballot_tracking', [App\Http\Controllers\RrBallotTrackingController::class, 'index']);
Route::get('/status_view', [App\Http\Controllers\RrBallotTrackingController::class, 'status_view']);

//COMPOSING SYSTEM
Route::get('/composing_system', [App\Http\Controllers\RrComposingSystemController::class, 'index']);
Route::get('/search_engine_composing', [App\Http\Controllers\RrComposingSearchEngineController::class, 'search_engine']);

//SMD SYSTEM
Route::get('/smd_system', [App\Http\Controllers\RrSmdSystemController::class, 'index']);
Route::get('/logbook_system', [App\Http\Controllers\RrSmdLogbookSystemController::class, 'logbook_system']);
Route::get('/client_ledger/{id}', function ($client_id) {
    return view('rr_smd_system.client_ledger')->with('client_id', $client_id);
});
Route::get('/view_courier/{id}', function ($courierId) {
    return view('rr_smd_system.courier')->with('courierId', $courierId);
});
Route::get('/accomplished_si/{monthSelected}/{preparedBy}/{prepPosition}/{submittedBy}/{subPosition}', function ($monthSelected, $preparedBy, $prepPosition, $submittedBy, $subPosition) {
    return view('rr_smd_system.accomplished_si')
    ->with('monthSelected', $monthSelected)
    ->with('preparedBy', $preparedBy)
    ->with('prepPosition', $prepPosition)
    ->with('submittedBy', $submittedBy)
    ->with('subPosition', $subPosition);
});

//J Routes
Route::resource('delivery', 'DeliveryjController');
Route::resource('motorpool_request', 'MotorpoolRequestjController');

Route::get('/delivery_ob', 'DeliveryjController@ob');
Route::get('/delivery_fts', 'DeliveryjController@fts');
Route::get('/delivery_configuration', 'DeliveryjController@config');

Route::get('/download_motorpool_letter', ['as' => 'brought', 'uses' => 'MotorpoolRequestjController@savemotorpoolreport']);

Route::get('/download_dr_ob_report', ['as' => 'search', 'uses' => 'DeliveryjController@savepdfobdr']);
Route::get('/download_dated_ob_report', ['as' => 'retrieve', 'uses' => 'DeliveryjController@savepdfobdated']);

Route::get('/download_dr_fts_report', ['as' => 'view', 'uses' => 'DeliveryjController@savepdfftsdr']);
Route::get('/download_dated_fts_report', ['as' => 'look', 'uses' => 'DeliveryjController@savepdfftsdated']);

Route::get('/view_sales_invoice', ['as' => 'catch', 'uses' => 'SmdjController@si']);
Route::get('/view_daily_sales_generic', ['as' => 'generic', 'uses' => 'SmdjController@dailysalesgeneric']);
Route::get('/view_daily_sales_specialized', ['as' => 'specialized', 'uses' => 'SmdjController@dailysalesspecialized']);
Route::get('/view_monthly_sales', ['as' => 'monthly', 'uses' => 'SmdjController@monthlysales']);

