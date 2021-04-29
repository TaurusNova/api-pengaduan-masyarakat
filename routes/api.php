<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\OfficerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResponseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Auth
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);

// Admin
Route::post('/admin/register_petugas', [AuthController::class, 'registerPetugas']);
Route::post('/admin/delete_complaint', [ComplaintController::class, '']);
Route::post('/admin/delete_response', [ResponseController::class, '']);
Route::post('/admin/report/date', [ReportController::class, 'showDate']);

// Show Peoples
Route::get('/peoples', [PeopleController::class, 'index']);
Route::get('/show_people/{nik}', [PeopleController::class, 'show']);
Route::get('/search_people/{keyword}', [PeopleController::class, 'search']);

// Show Officers
Route::get('/officers', [OfficerController::class, 'index']);
Route::get('/show_officer/{id}', [OfficerController::class, 'show']);
Route::get('/search_officer/{keyword}', [OfficerController::class, 'search']);

// Complaints
Route::get('/complaints', [ComplaintController::class, 'index']);
Route::post('/create_complaint', [ComplaintController::class, 'store']);
Route::get('/complaint/{id}', [ComplaintController::class, 'show']);
// People Route
Route::get('/people/complaints/{nik}', [ComplaintController::class, 'showPeopleComplaints']);
// Officer Route
Route::get('/officer/complaints', [ComplaintController::class, 'showComplaints']);
Route::get('/officer/null_complaints', [ComplaintController::class, 'showNullComplaints']);
Route::get('/officer/process_complaints', [ComplaintController::class, 'showProcessComplaints']);
Route::get('/officer/completed_complaints', [ComplaintController::class, 'showCompletedComplaints']);
Route::get('/verify_complaint/{id}', [ComplaintController::class, 'verify']);
Route::get('/reject_complaint/{id}', [ComplaintController::class, 'reject']);
Route::post('/complete_complaint/{id}', [ComplaintController::class, 'complete']);
// Delete
Route::post('/user/delete_complaint/{id}', [ComplaintController::class, 'userDelete']);
Route::post('/officer/delete_complaint/{id}', [ComplaintController::class, 'officerDelete']);

// Response
Route::get('/responses', [ResponseController::class, 'index']);
Route::get('/response/{id}', [ResponseController::class, 'show']);
Route::post('/create_response/{id}', [ResponseController::class, 'store']);
Route::post('/update_response/{id}', [ResponseController::class, 'update']);
Route::post('/delete_response', [ResponseController::class, '']);

// Reports
Route::get('/report', [ReportController::class, '']);

// Progress
// Verify, Show People by NIK, Search People, Show Officer by ID, Search Officer, Create Response, Update Response
// Complete Response

Route::any('{any}', function(){
    return response()->json([
        'message'   => 'Page Not Found.',
    ], 404);
})->where('any', '.*');
