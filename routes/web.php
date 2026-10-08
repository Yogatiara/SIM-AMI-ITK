<?php

use App\Events\FormUpdated;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StageManagementController;
use App\Http\Controllers\FacultyController;
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
    | Role Switching (jangan diubah)
    |--------------------------------------------------------------------------
    */

    Route::get('/roles', [RoleController::class, 'choseRole']);

    Route::post('/roles', [RoleController::class, 'store']);




    /*
    |--------------------------------------------------------------------------
    | Roles Management (khusus admin)
    |--------------------------------------------------------------------------
    */

    Route::middleware('can:manage roles')->group(function () {
        Route::get('/roles-management', [RoleController::class, 'index'])
            ->name('roles-management.index');

        Route::get('/roles-management/create', [RoleController::class, 'create'])
            ->name('roles-management.create');

        Route::post('/roles-management', [RoleController::class, 'store'])
            ->name('roles-management.store');

        Route::get('/roles-management/{role}', [RoleController::class, 'show'])
            ->name('roles-management.show');

        Route::get('/roles-management/{role}/edit', [RoleController::class, 'edit'])
            ->name('roles-management.edit');

        Route::put('/roles-management/{role}', [RoleController::class, 'update'])
            ->name('roles-management.update');

        Route::delete('/roles-management/{role}', [RoleController::class, 'destroy'])
            ->name('roles-management.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Permissions Management (khusus admin)
    |--------------------------------------------------------------------------
    */

    Route::middleware('can:manage permissions')->group(function () {
        Route::get('/permissions-management', [PermissionController::class, 'index'])
            ->name('permissions-management.index');

        Route::get('/permissions-management/create', [PermissionController::class, 'create'])
            ->name('permissions-management.create');

        Route::post('/permissions-management', [PermissionController::class, 'store'])
            ->name('permissions-management.store');

        Route::get('/permissions-management/{permission}', [PermissionController::class, 'show'])
            ->name('permissions-management.show');

        Route::get('/permissions-management/{permission}/edit', [PermissionController::class, 'edit'])
            ->name('permissions-management.edit');

        Route::put('/permissions-management/{permission}', [PermissionController::class, 'update'])
            ->name('permissions-management.update');

        Route::delete('/permissions-management/{permission}', [PermissionController::class, 'destroy'])
            ->name('permissions-management.destroy');
    });


    /*
    |--------------------------------------------------------------------------
    | Stages Management (PJM & Admin)
    |--------------------------------------------------------------------------
    */

    Route::middleware('can:manage stages')->group(function () {
        Route::get('/stages-management', [StageManagementController::class, 'index'])
            ->name('stages-management.index');

        Route::get('/stages-management/create', [StageManagementController::class, 'create'])
            ->name('stages-management.create');

        Route::post('/stages-management', [StageManagementController::class, 'store'])
            ->name('stages-management.store');

        Route::get('/stages-management/{stage}', [StageManagementController::class, 'show'])
            ->name('stages-management.show');

        Route::get('/stages-management/{stage}/edit', [StageManagementController::class, 'edit'])
            ->name('stages-management.edit');

        Route::put('/stages-management/{stage}', [StageManagementController::class, 'update'])
            ->name('stages-management.update');

        Route::delete('/stages-management/{stage}', [StageManagementController::class, 'destroy'])
            ->name('stages-management.destroy');

        Route::put('/stages-management/{stage}/move-up', [StageManagementController::class, 'moveUp'])
            ->name('stages-management.move-up');

        Route::put('/stages-management/{stage}/move-down', [StageManagementController::class, 'moveDown'])
            ->name('stages-management.move-down');

        Route::put('/stages-management/{stage}/toggle', [StageManagementController::class, 'toggleActive'])
            ->name('stages-management.toggle');
    });


    /*
    |--------------------------------------------------------------------------
    | Organization
    |--------------------------------------------------------------------------
    */

    Route::resource('/faculties', FacultyController::class);
    Route::get('/faculties/{faculty}/show', [FacultyController::class, 'show'])
        ->name('faculties.show');

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

            Route::get('/get-activity', 'getActivity')
                ->name('getActivity');


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
