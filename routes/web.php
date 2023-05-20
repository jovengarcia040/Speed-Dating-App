<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;

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

Route::get('/', function () {
    return redirect('/client');
});

/*************************************************************************/
/****************************** Admin API ********************************/
/*************************************************************************/

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        if(Auth::check()) {
            return view('admin.start');
        } else {
            return view('admin.login');
        }
    });
    Route::get(
        '/event', 
        [EventController::class, 'index']
    );
    Route::get('event/create', function () {
        return view('admin.event.create');
    });
    Route::post(
        'event/create', 
        [EventController::class, 'store']
    );
    Route::post(
        'event/delete', 
        [EventController::class, 'deleteEvent']
    );
    Route::get(
        '/event/{id}', 
        [EventController::class, 'show']
    );
    Route::delete(
        '/event/{id}', 
        [EventController::class, 'deleteAll']
    );
    Route::get(
        '/event/{event_id}/guest/{guest_id}', 
        [EventController::class, 'getGuestInfo']
    );
    Route::post(
        '/event/{event_id}/guest/create', 
        [EventController::class, 'storeGuest']
    );
    Route::put(
        '/event/{event_id}/guest/{guest_id}', 
        [EventController::class, 'updateGuest']
    );
    Route::delete(
        '/event/{event_id}/guest/{guest_id}', 
        [EventController::class, 'deleteGuest']
    );
    Route::delete(
        '/event/{event_id}/couple/{couple_id}', 
        [EventController::class, 'deleteCouple']
    );
    Route::post(
        '/event/{event_id}/match/send', 
        [EventController::class, 'sendMatchAll']
    );
    Route::post(
        '/event/match/send/{couple_id}', 
        [EventController::class, 'sendMatch']
    );
    Route::post(
        '/login', 
        [AdminController::class, 'login']
    );
    Route::get(
        '/logout', 
        [AdminController::class, 'logout']
    );
});

/*************************************************************************/
/****************************** Client API *******************************/
/*************************************************************************/
Route::prefix('client')->group(function () {
    Route::get(
        '/', 
        [GuestController::class, 'index']
    );
    Route::any(
        '/getGuestEventData', 
        [GuestController::class, 'getGuestEventData']
    );
    Route::post(
        '/login', 
        [GuestController::class, 'login']
    );
    Route::get(
        '/logout', 
        [GuestController::class, 'logout']
    );
    Route::post(
        '/event/invite', 
        [GuestController::class, 'invite']
    );
    Route::delete(
        '/event/invite/{id}', 
        [GuestController::class, 'inviteDel']
    );
});

/*****************************************************************************/ 
/******************************* console route *******************************/ 
/*****************************************************************************/ 
Route::prefix('artisan')->group(function () {
    Route::get(
        '/hello', function() {
            return response()->json(['message' => 'Hello Artisan.'], 200);
        }
    );
    Route::get(
        '/migrate', function() {
            $res = Artisan::call("migrate:fresh --seed");
            dd('=== migrate === ', $res);
        }
    );
    Route::get(
        '/storage', function() {
            Artisan::call("storage:link");
        }
    );
});