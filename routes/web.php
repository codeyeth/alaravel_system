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

Route::get('/download_motorpool_letter', ['as' => 'brought', 'uses' => 'MotorpoolRequestjController@save_motorpool_report']);

Route::get('/download_pdf_dr', ['as' => 'look', 'uses' => 'DeliveryjController@save_dr_pdf']);

Route::get('/view_sales_invoice', ['as' => 'catch', 'uses' => 'SmdjController@sales_invoice']);
Route::get('/view_delivery_receipt', ['as' => 'caught', 'uses' => 'SmdjController@delivery_receipt']);

Route::get('/view_daily_sales_generic', ['as' => 'generic', 'uses' => 'SmdjController@daily_sales_generic']);
Route::get('/view_daily_sales_specialized', ['as' => 'specialized', 'uses' => 'SmdjController@daily_sales_specialized']);
Route::get('/view_monthly_sales', ['as' => 'monthly', 'uses' => 'SmdjController@monthly_sales_invoice']);
Route::get('/view_claimed_generic', ['as' => 'genericclaimed', 'uses' => 'SmdjController@claimed_generic']);
Route::get('/view_claimed_specialized', ['as' => 'specializedclaimed', 'uses' => 'SmdjController@claimed_specialized']);
Route::get('/view_unclaimed_generic', ['as' => 'genericunclaimed', 'uses' => 'SmdjController@unclaimed_generic']);
Route::get('/view_unclaimed_specialized', ['as' => 'specializedunclaimed', 'uses' => 'SmdjController@unclaimed_specialized']);

