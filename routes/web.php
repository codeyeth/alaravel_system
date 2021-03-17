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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/user_mgt', [App\Http\Controllers\RrUserManagementController::class, 'index']);
Route::get('/ballot_tracking', [App\Http\Controllers\RrBallotTrackingController::class, 'index']);
Route::get('/composing_system', [App\Http\Controllers\RrComposingSystemController::class, 'index']);


Route::resource('add_user', 'RrUserManagementController');
Route::resource('change_pass', 'RrChangePasswordController');















//J Routes
Route::resource('delivery', 'DeliveryjController');
Route::resource('motorpool_request', 'MotorpoolRequestjController');

Route::get('/delivery_ob', 'DeliveryjController@ob');
Route::get('/delivery_fts', 'DeliveryjController@fts');
Route::get('reports/pdf', ['as' => 'set', 'uses' => 'MotorpoolRequestjController@pdf']);

Route::get('/download_dr_ob_report', ['as' => 'search', 'uses' => 'DeliveryjController@savepdfobdr']);
Route::get('/download_daily_ob_report', ['as' => 'retrieve', 'uses' => 'DeliveryjController@savepdfobdaily']);
Route::get('/download_batch_ob_report', ['as' => 'extract', 'uses' => 'DeliveryjController@savepdfobbatch']);

Route::get('/download_dr_fts_report', ['as' => 'view', 'uses' => 'DeliveryjController@savepdfftsdr']);
Route::get('/download_daily_fts_report', ['as' => 'look', 'uses' => 'DeliveryjController@savepdfftsdaily']);
Route::get('/download_batch_fts_report', ['as' => 'pull', 'uses' => 'DeliveryjController@savepdfftsbatch']);



