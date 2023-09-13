<?php

use App\Http\Controllers\DynamicFormsStorageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\ProfileFormController;
use App\Http\Controllers\User\DeathController;

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
    return redirect(route("login"));
});

Route::get('/test',function (){
    return view('builder');
})->name('test');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


/*Admin Routes*/
Route::group(['prefix' => 'admin','middleware' => 'auth','is_admin'], function () {

    Route::get('/dashboard',          [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/users',              [AdminController::class, 'users'])->name('admin.users');
    Route::get('/forms',              [AdminController::class, 'forms'])->name('admin.forms');
    Route::get('/forms/add',          [AdminController::class, 'show'])->name('add.forms');
    Route::get('/forms/{id}',         [DynamicFormsStorageController::class, 'show'])->name('form.detail');
    Route::post('/forms/update/{id}', [DynamicFormsStorageController::class, 'update'])->name('form.update');
    Route::get('/forms/delete/{id}',  [DynamicFormsStorageController::class, 'delete'])->name('form.delete');
    Route::get('/logout',             [LoginController::class, 'logout'])->name('admin.logout');

});
    Route::post('/submit/form',       [AdminController::class, 'storeForm']); 

/*User Routes*/
Route::group(['prefix' => 'user','middleware' => 'auth'], function () {

    Route::get('/dashboard', [UserController::class, 'index'])->name('user.dashboard');
    Route::get('/form/{id}', [UserController::class, 'form'])->name('user.form');
    Route::post('/form/submit/{id}', [UserController::class, 'submitform'])->name('user.form.submit');
    Route::get('/all',       [UserController::class, 'show_all'])->name('all.user');
    Route::get('/profile',   [UserController::class, 'profile'])->name('user_profile');
    Route::get('/profile/primary/{id}',   [UserController::class, 'primary'])->name('update.profile.primary');
    Route::get('/profile/secondary/{id}',   [UserController::class, 'secondary'])->name('update.profile.secondary');
    Route::get('/profile/form',       [ProfileFormController::class, 'index'])->name('profile.form');
    Route::get('/profile/form/{id}',  [ProfileFormController::class, 'show'])->name('profile.form.show');
    Route::get('/complete/form',      [ProfileFormController::class, 'completeform'])->name('user.complete.form');
    Route::get('/contacts',      [UserController::class, 'contacts'])->name('user.contact');
    Route::get('/register/death',      [DeathController::class, 'create'])->name('death.create');
    Route::post('/register/death/{id}',      [DeathController::class, 'store'])->name('death.store');
    Route::get('/logout',        [UserController::class, 'logout'])->name('user.logout');
});

// Route::post('/submit-form', [\App\Http\Controllers\BuilderController::class,'store'])->name('submit.dynamic.form');
Route::prefix('dynamic-forms')->name('dynamic-forms.')->group(function () {
    // Dummy route so we can use the route() helper to give formiojs the base path for this group
    Route::get('/',[\App\Http\Controllers\BuilderController::class,'create'])->name('index');
    
    Route::post('storage/s3', [DynamicFormsStorageController::class, 'storeS3'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::get('storage/s3', [DynamicFormsStorageController::class, 'showS3'])->name('S3-file-download');
    Route::get('storage/s3/{fileKey}', [DynamicFormsStorageController::class, 'showS3'])->name('S3-file-redirect');

    Route::post('storage/url', [DynamicFormsStorageController::class, 'storeURL'])
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);

    Route::get('storage/url', [DynamicFormsStorageController::class, 'showURL'])->name('url-file-download');
    Route::delete('storage/url', [DynamicFormsStorageController::class, 'deleteURL']);
});
