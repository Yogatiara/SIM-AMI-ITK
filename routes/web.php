<?php

use App\Events\FormUpdated;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Livewire\auth\Login;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {

    Route::get('/login', Login::class)
        ->name('login');

    Route::post('/auth', [AuthController::class, 'auth'])
        ->name('auth');
});


Route::middleware(['auth', 'verified'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Broadcasting
    |--------------------------------------------------------------------------
    */

    // Route::post('/broadcasting/auth', function () {
    //     return Broadcast::auth(request());
    // });


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/', function () {
        return redirect('/dashboard');
    });

    Route::get('/dashboard', [AuthController::class, 'index'])
        ->name('dashboard');

    // Route::get('/dashboard', function () {
    //     return view('index');
    // })->name('dashboard');

    // Route::get('/test', function () {
    //     FormUpdated::dispatch('test1');
    //     // event(new FormUpdated('test'));
    // })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Authentication
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthController::class, 'logout'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | Stage
    |--------------------------------------------------------------------------
    */

    Route::put('/stages/{stage}', [AuthController::class, 'updateStage'])
        ->name('stages.update');


    /*
    |--------------------------------------------------------------------------
    | Roles
    |--------------------------------------------------------------------------
    */

    Route::resource('/roles', RoleController::class);


    /*
    |--------------------------------------------------------------------------
    | Organization
    |--------------------------------------------------------------------------
    */

    Route::resource('/departments', DepartmentController::class);

    Route::resource('/units', UnitController::class);


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::resource('/users', UserController::class);

    Route::get('/getUser', [UserController::class, 'getUser']);

    Route::prefix('contacts')
        ->name('contacts.')
        ->controller(UserController::class)
        ->group(function () {

            Route::get('/{id}/edit', 'editContact')
                ->name('edit');

            Route::put('/{id}', 'updateContact')
                ->name('update');
        });


    /*
    |--------------------------------------------------------------------------
    | Documents
    |--------------------------------------------------------------------------
    */

    Route::resource('/documents', DocumentController::class);

    Route::prefix('documents/drafts')
        ->name('documents.')
        ->controller(DocumentController::class)
        ->group(function () {

            Route::get('/{draft}/edit', 'editDraft')
                ->name('editDraft');

            Route::delete('/{draft}', 'destroyDraft')
                ->name('destroyDraft');
        });


    /*
    |--------------------------------------------------------------------------
    | Forms
    |--------------------------------------------------------------------------
    */

    Route::resource('/forms', FormController::class);

    Route::prefix('forms/{form}')
        ->name('forms.')
        ->controller(FormController::class)
        ->group(function () {

            /*
            |--------------------------------------------------------------------------
            | Submission
            |--------------------------------------------------------------------------
            */

            Route::get('/submission', 'editSubmission')
                ->name('editSubmission');

            Route::put('/submission', 'updateSubmission')
                ->name('updateSubmission');


            /*
            |--------------------------------------------------------------------------
            | Assessment
            |--------------------------------------------------------------------------
            */

            Route::get('/assessment', 'editAssessment')
                ->name('editAssessment');

            Route::put('/assessment', 'updateAssessment')
                ->name('updateAssessment');


            /*
            |--------------------------------------------------------------------------
            | Feedback
            |--------------------------------------------------------------------------
            */

            Route::get('/feedback', 'editFeedback')
                ->name('editFeedback');

            Route::put('/feedback', 'updateFeedback')
                ->name('updateFeedback');


            /*
            |--------------------------------------------------------------------------
            | Validation
            |--------------------------------------------------------------------------
            */

            Route::get('/validation', 'editValidation')
                ->name('editValidation');

            Route::put('/validation', 'updateValidation')
                ->name('updateValidation');


            /*
            |--------------------------------------------------------------------------
            | Meeting
            |--------------------------------------------------------------------------
            */

            Route::get('/meeting', 'editMeeting')
                ->name('editMeeting');

            Route::put('/meeting', 'updateMeeting')
                ->name('updateMeeting');


            /*
            |--------------------------------------------------------------------------
            | Meeting Verification
            |--------------------------------------------------------------------------
            */

            Route::get('/meetingVerification', 'editMeetingVerification')
                ->name('editMeetingVerification');

            Route::put('/meetingVerification', 'updateMeetingVerification')
                ->name('updateMeetingVerification');


            /*
            |--------------------------------------------------------------------------
            | Planning
            |--------------------------------------------------------------------------
            */

            Route::get('/planning', 'editPlanning')
                ->name('editPlanning');

            Route::put('/planning', 'updatePlanning')
                ->name('updatePlanning');


            /*
            |--------------------------------------------------------------------------
            | Signing
            |--------------------------------------------------------------------------
            */

            Route::get('/signing', 'editSigning')
                ->name('editSigning');

            Route::put('/signing', 'updateSigning')
                ->name('updateSigning');


            /*
            |--------------------------------------------------------------------------
            | Signing Verification
            |--------------------------------------------------------------------------
            */

            Route::get('/signingVerification', 'editSigningVerification')
                ->name('editSigningVerification');


            Route::put('/signingVerification', 'updateSigningVerification')
                ->name('updateSigningVerification');


            /*
            |--------------------------------------------------------------------------
            | Report
            |--------------------------------------------------------------------------
            */

            Route::get('/report', 'showReport')
                ->name('showReport');


            /*
            |--------------------------------------------------------------------------
            | Export
            |--------------------------------------------------------------------------
            */

            Route::get('/export', 'export')
                ->name('export');
        });
});
