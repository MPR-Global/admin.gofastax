<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AirDuctCleaningController;
use App\Http\Controllers\BusinessRulesController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\ScheduleBookingController;
use App\Http\Controllers\ZipcodesController;
use App\Http\Controllers\ChangepasswordController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmailReceiverController;
use App\Http\Controllers\AmisteeServicesUserController;
use App\Http\Controllers\MeetTheTeamController;

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
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('logout', [LoginController::class, 'signOut'])->name('logout');
Route::post('authenticate', [LoginController::class, 'checklogin'])->name('authenticate');

// Route::get('/', [BusinessRulesController::class, 'index'])->name('business_rules')->middleware('auth');
Route::get('change_password', [ChangepasswordController::class, 'index'])->name('change_password')->middleware('auth');
Route::get('change_pass', [ChangepasswordController::class, 'changepassword'])->name('change_pass')->middleware('auth');

Route::get('schedule_bookings', [ScheduleBookingController::class, 'index'])->name('schedule_bookings')->middleware('auth');
Route::get('schedule_bookings_graph', [ScheduleBookingController::class, 'schedule_bookings_graph'])->name('schedule_bookings_graph')->middleware('auth');
Route::get('deleteBooking/{id}', [ScheduleBookingController::class, 'destroy'])->name('schedule_bookings.delete')->middleware('auth');
Route::get('deleteTestBookings', [ScheduleBookingController::class, 'clearTestBookings'])->name('schedule_bookings.clearTest')->middleware('auth');
Route::get('bookings_count', [ScheduleBookingController::class, 'count']);

Route::get('email_receivers', [EmailReceiverController::class, 'index'])->name('emailreceivers')->middleware('auth');
Route::post('saveemailreceiver', [EmailReceiverController::class, 'save'])->name('emailreceivers.save')->middleware('auth');
Route::get('delete_email_receiver/{id}', [EmailReceiverController::class, 'destroy'])->name('emailreceivers.delete')->middleware('auth');

Route::get('zipcodes', [ZipcodesController::class, 'index'])->name('zipcodes')->middleware('auth');
Route::get('addzipcode', [ZipcodesController::class, 'create'])->name('zipcodes.add')->middleware('auth');
Route::get('editzipcode/{id}', [ZipcodesController::class, 'edit'])->name('zipcodes.edit')->middleware('auth');
Route::post('savezipcode', [ZipcodesController::class, 'save'])->name('zipcodes.save')->middleware('auth');
Route::post('updatezipcode/{id}', [ZipcodesController::class, 'update'])->name('zipcodes.update')->middleware('auth');
Route::get('deletezipcode/{id}', [ZipcodesController::class, 'destroy'])->name('zipcodes.delete')->middleware('auth');

Route::post('getBusinessRules', [BusinessRulesController::class, 'getBusinessRules'])->name('getBusinessRules')->middleware('auth');;
Route::get('business_rules', [BusinessRulesController::class, 'index'])->name('business_ruless')->middleware('auth');
Route::get('addairductRule', [BusinessRulesController::class, 'create'])->name('airductRules.add')->middleware('auth');
Route::get('editairductRule/{id}', [BusinessRulesController::class, 'edit'])->name('airductRules.edit')->middleware('auth');
Route::post('saveairductRule', [BusinessRulesController::class, 'save'])->name('airductRules.save')->middleware('auth');
Route::post('updateairductRule/{id}', [BusinessRulesController::class, 'update'])->name('airductRules.update')->middleware('auth');
Route::get('deleteairductRule/{id}', [BusinessRulesController::class, 'destroy'])->name('airductRules.delete')->middleware('auth');

Route::get('adddryerventRule', [BusinessRulesController::class, 'createDryerVent'])->name('dryerventRules.add')->middleware('auth');
Route::get('editdryerventRule/{id}', [BusinessRulesController::class, 'editDryerVent'])->name('dryerventRules.edit')->middleware('auth');
Route::post('savedryerventRule', [BusinessRulesController::class, 'saveDryerVent'])->name('dryerventRules.save')->middleware('auth');
Route::post('updatedryerventRule/{id}', [BusinessRulesController::class, 'updateDryerVent'])->name('dryerventRules.update')->middleware('auth');
Route::get('deletedryerventRule/{id}', [BusinessRulesController::class, 'destroyDryerVent'])->name('dryerventRules.delete')->middleware('auth');

Route::get('users', [AdminController::class, 'index'])->name('users')->middleware('auth');
Route::get('addUser', [AdminController::class, 'addUser'])->name('users.add')->middleware('auth');
Route::post('saveUser', [AdminController::class, 'saveUser'])->name('users.save')->middleware('auth');
Route::get('edit_user/{id}', [AdminController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::post('update_user/{id}', [AdminController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('delete_user/{id}', [AdminController::class, 'destroy'])->name('users.delete')->middleware('auth');
Route::get('password', [ChangepasswordController::class, 'index'])->middleware('auth');

Route::get('schdeule_booking', [AdminController::class, 'schdeule_booking'])->name('schdeule_booking')->middleware('auth');

Route::get('/', [MeetTheTeamController::class, 'index'])->name('meettheteam')->middleware('auth');
Route::get('meetTheTeam', [MeetTheTeamController::class, 'index'])->name('meettheteam')->middleware('auth');
Route::post('getTeamData', [MeetTheTeamController::class, 'getTeamData'])->name('meettheteam.datatable')->middleware('auth');
Route::get('addTeamMember', [MeetTheTeamController::class, 'create'])->name('meettheteam.add')->middleware('auth');
Route::post('saveTeamMember', [MeetTheTeamController::class, 'store'])->name('meettheteam.save')->middleware('auth');
Route::post('activateTeamMember/{id}', [MeetTheTeamController::class, 'activate'])->name('meettheteam.activate')->middleware('auth');

Route::post('updateTeamMember/{id}', [MeetTheTeamController::class, 'update'])->name('meettheteam.update')->middleware('auth');
Route::get('meetTheTeam/{id}/edit', [MeetTheTeamController::class, 'edit'])->name('meettheteam.edit')->middleware('auth');
Route::post('meetTheTeam/{id}/delete', [MeetTheTeamController::class, 'destroy'])->name('meettheteam.delete')->middleware('auth');


Route::get('reviews', [ReviewsController::class, 'index'])->name('reviews')->middleware('auth');
Route::post('getReviews', [ReviewsController::class, 'getReviews'])->name('reviews.datatable')->middleware('auth');
Route::get('addReviw', [ReviewsController::class, 'create'])->name('reviews.add')->middleware('auth');
Route::post('saveReview', [ReviewsController::class, 'store'])->name('reviews.save')->middleware('auth');
Route::post('updateReview/{id}', [ReviewsController::class, 'update'])->name('reviews.update')->middleware('auth');
Route::get('reviews/{id}/edit', [ReviewsController::class, 'edit'])->name('reviews.edit')->middleware('auth');
Route::post('reviews/{id}/delete', [ReviewsController::class, 'destroy'])->name('reviews.delete')->middleware('auth');
