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

Route::get('/', 'LoginController@Index');
Route::post('login', 'LoginController@Login');
Route::get('logout', 'LoginController@Logout');

#Dashboard Controller & Campaign *****************************

Route::get('dashboard', 'DashboardController@Index');
Route::get('campaign', 'DashboardController@CampaignLeftBar');
Route::get('ajaxcampaign/{data}', 'DashboardController@AjaxCampaign');
Route::post('sendsms', 'DashboardController@SendSms');
Route::get('ajaxgetstakeholder/{data}', 'DashboardController@AjaxGetStakeholder');
Route::get('ajaxtotaladd/{data}', 'DashboardController@AjaxTotalAdd');
Route::get('smsstatus', 'DashboardController@IsmsSummery');
Route::post('smsstatus', 'DashboardController@SummarySearch');

Route::post('confirm-sms', 'DashboardController@Confirm');

Route::get('alldata/{fdat}/{todat}/{stak}', 'DashboardController@AllData');

Route::get('test', 'DashboardController@test');



