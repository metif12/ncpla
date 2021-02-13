<?php

use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Livewire\Auth\Login;
use App\Http\Livewire\Auth\Passwords\Confirm;
use App\Http\Livewire\Auth\Passwords\Email;
use App\Http\Livewire\Auth\Passwords\Reset;
use App\Http\Livewire\Auth\Register;
use App\Http\Livewire\Auth\Verify;
use App\Http\Livewire\Panel\Forms\CreateGroup;
use App\Http\Livewire\Panel\Forms\CreateLine;
use App\Http\Livewire\Panel\Forms\CreateMaterial;
use App\Http\Livewire\Panel\Forms\CreateOrder;
use App\Http\Livewire\Panel\Forms\CreateProduct;
use App\Http\Livewire\Panel\Forms\CreateReport;
use App\Http\Livewire\Panel\Forms\CreateShift;
use App\Http\Livewire\Panel\Forms\CreateTask;
use App\Http\Livewire\Panel\Forms\CreateUser;
use App\Http\Livewire\Panel\Forms\EditGroup;
use App\Http\Livewire\Panel\Forms\EditLine;
use App\Http\Livewire\Panel\Forms\EditMaterial;
use App\Http\Livewire\Panel\Forms\EditOrder;
use App\Http\Livewire\Panel\Forms\EditPermission;
use App\Http\Livewire\Panel\Forms\EditProduct;
use App\Http\Livewire\Panel\Forms\EditReport;
use App\Http\Livewire\Panel\Forms\EditShift;
use App\Http\Livewire\Panel\Forms\EditTask;
use App\Http\Livewire\Panel\Forms\EditUser;
use App\Http\Livewire\Panel\GroupList;
use App\Http\Livewire\Panel\LinesList;
use App\Http\Livewire\Panel\MaterialsList;
use App\Http\Livewire\Panel\OrdersList;
use App\Http\Livewire\Panel\Password;
use App\Http\Livewire\Panel\PermissionList;
use App\Http\Livewire\Panel\ProductsList;
use App\Http\Livewire\Panel\Profile;
use App\Http\Livewire\Panel\ReportsList;
use App\Http\Livewire\Panel\ShiftsList;
use App\Http\Livewire\Panel\TasksList;
use App\Http\Livewire\Panel\UserList;
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

Route::view('/', 'welcome')->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', Login::class)
        ->name('login');

    Route::get('register', Register::class)
        ->name('register');
});

Route::get('password/reset', Email::class)
    ->name('password.request');

Route::get('password/reset/{token}', Reset::class)
    ->name('password.reset');

Route::middleware('auth')->group(function () {
    Route::get('email/verify', Verify::class)
        ->middleware('throttle:6,1')
        ->name('verification.notice');

    Route::get('password/confirm', Confirm::class)
        ->name('password.confirm');
});

Route::middleware('auth')->group(function () {

    Route::get('email/verify/{id}/{hash}', EmailVerificationController::class)
        ->middleware('signed')
        ->name('verification.verify');

    Route::post('logout', LogoutController::class)
        ->name('logout');

    Route::prefix('panel')
        ->name('panel.')
        ->group(function (){

            Route::view('/', 'panel.dashboard')->name('dashboard');

            Route::get('/profile', Profile::class)->name('profile');
            Route::get('/password', Password::class)->name('password');
            Route::get('/products', ProductsList::class)->name('products');
            Route::get('/orders', OrdersList::class)->name('orders');
            Route::get('/shifts', ShiftsList::class)->name('shifts');
            Route::get('/lines', LinesList::class)->name('lines');
            Route::get('/tasks', TasksList::class)->name('tasks');
            Route::get('/users', UserList::class)->name('users');
            Route::get('/groups', GroupList::class)->name('groups');
            Route::get('/reports', ReportsList::class)->name('reports');
            Route::get('/permissions', PermissionList::class)->name('permissions');
            Route::get('/materials', MaterialsList::class)->name('materials');
            Route::get('/shifts/create', CreateShift::class)->name('shift-create');
            Route::get('/materials/create', CreateMaterial::class)->name('material-create');
            Route::get('/products/create', CreateProduct::class)->name('product-create');
            Route::get('/groups/create', CreateGroup::class)->name('group-create');
            Route::get('/lines/create', CreateLine::class)->name('line-create');
            Route::get('/users/create', CreateUser::class)->name('user-create');
            Route::get('/users/{user}/edit', EditUser::class)->name('user-edit');
            Route::get('/groups/{group}/edit', EditGroup::class)->name('group-edit');
            Route::get('/permissions/{permission}/edit', EditPermission::class)->name('permission-edit');
            Route::get('/orders/{order}/edit', EditOrder::class)->name('order-edit');
            Route::get('/materials/{material}/edit', EditMaterial::class)->name('material-edit');
            Route::get('/lines/{line}/edit', EditLine::class)->name('line-edit');
            Route::get('/shifts/{shift}/edit', EditShift::class)->name('shift-edit');
            Route::get('/tasks/{task}/edit', EditTask::class)->name('task-edit');
            Route::get('/reports/{report}/edit', EditReport::class)->name('report-edit');
            Route::get('/products/{product}/edit', EditProduct::class)->name('product-edit');
            Route::get('/tasks/{task}/reports/create', CreateReport::class)->name('report-create');
            Route::get('/lines/{line}/tasks/create', CreateTask::class)->name('task-create');
            Route::get('/products/{product}/orders/create', CreateOrder::class)->name('order-create');
        });
});
