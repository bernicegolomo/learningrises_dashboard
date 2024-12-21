<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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



Route::get('/', [Controller::class, 'index'])->name('index');
Route::get('dashboard/{id}', [Controller::class, 'dashboard'])->name('dashboard');
Route::get('dashboardyear/{id}', [Controller::class, 'dashboardyear'])->name('dashboardyear');

Route::get('getScoreDistributionData/{id}', [Controller::class, 'getScoreDistributionData'])->name('getScoreDistributionData');
Route::get('getClassSizeByYear/{id}', [Controller::class, 'getClassSizeByYear'])->name('getClassSizeByYear');
Route::get('getAverageScoreByYear/{id}', [Controller::class, 'getAverageScoreByYear'])->name('getAverageScoreByYear');
Route::get('getScoreDistributionByYear/{id}', [Controller::class, 'getScoreDistributionByYear'])->name('getScoreDistributionByYear');

Route::any('reports', [Controller::class, 'reports'])->name('reports');
Route::post('/startassessment',[Controller::class, 'startassessment'])->name('startassessment');
Route::post('/submitscores',[Controller::class, 'submitscores'])->name('submitscores');
Route::post('/submitbulkscores',[Controller::class, 'submitbulkscores'])->name('submitbulkscores');
Route::post('/submitscoresyear',[Controller::class, 'submitscoresyear'])->name('submitscoresyear');
Route::get('/downloadexcel/{class}/{subject}/{year}',[Controller::class, 'downloadexcel'])->name('downloadexcel');

