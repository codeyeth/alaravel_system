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
Route::resource('add_user', 'RrUserManagementController');
Route::resource('change_pass', 'RrChangePasswordController');

//BALLOT TRACKING
Route::get('/ballot_tracking', [App\Http\Controllers\RrBallotTrackingController::class, 'index']);

//COMPOSING SYSTEM
Route::get('/composing_system', [App\Http\Controllers\RrComposingSystemController::class, 'index']);
Route::get('/search_engine_composing', [App\Http\Controllers\RrComposingSearchEngineController::class, 'search_engine']);

//SMD SYSTEM
Route::get('/smd_system', [App\Http\Controllers\RrSmdSystemController::class, 'index']);
Route::get('/logbook_system', [App\Http\Controllers\RrSmdLogbookSystemController::class, 'logbook_system']);


//J Routes
Route::resource('delivery', 'DeliveryjController');
Route::resource('motorpool_request', 'MotorpoolRequestjController');

Route::get('/delivery_ob', 'DeliveryjController@ob');
Route::get('/delivery_fts', 'DeliveryjController@fts');
Route::get('/delivery_configuration', 'DeliveryjController@config');
Route::get('/download_motorpool_letter', ['as' => 'brought', 'uses' => 'MotorpoolRequestjController@savemotorpoolreport']);

Route::get('/download_dr_ob_report', ['as' => 'search', 'uses' => 'DeliveryjController@savepdfobdr']);
Route::get('/download_daily_ob_report', ['as' => 'retrieve', 'uses' => 'DeliveryjController@savepdfobdaily']);
Route::get('/download_batch_ob_report', ['as' => 'extract', 'uses' => 'DeliveryjController@savepdfobbatch']);

Route::get('/download_dr_fts_report', ['as' => 'view', 'uses' => 'DeliveryjController@savepdfftsdr']);
Route::get('/download_daily_fts_report', ['as' => 'look', 'uses' => 'DeliveryjController@savepdfftsdaily']);
Route::get('/download_batch_fts_report', ['as' => 'pull', 'uses' => 'DeliveryjController@savepdfftsbatch']);



