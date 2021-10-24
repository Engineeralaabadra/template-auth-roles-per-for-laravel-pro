<?php

use App\Http\Controllers\API\Admin\AddvertismentController;
use App\Http\Controllers\API\Admin\BannerController;
use App\Http\Controllers\API\Admin\ProductController;
use App\Http\Controllers\API\Admin\CategoryController;
use App\Http\Controllers\API\Admin\CouponcodeController;
use App\Http\Controllers\API\Admin\DeliveryController;
use App\Http\Controllers\API\Admin\OrderController;
use App\Http\Controllers\API\Admin\RoleController;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\User\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\Auth\ConfirmablePasswordController;
use App\Http\Controllers\API\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\API\Auth\EmailVerificationPromptController;
use App\Http\Controllers\API\Auth\NewPasswordController;
use App\Http\Controllers\API\Auth\PasswordResetLinkController;
use App\Http\Controllers\API\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Artisan;

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
Route::get('clear-cache',function(){
    Artisan::call('cache:clear');
    return "Cache is cleared";
});
Route::get('route-cache',function(){
    Artisan::call('route:clear');
    return "Cache is routed";
});
Route::get('config-cache',function(){
    Artisan::call('config:clear');
    return "Cache is configed";
});
Route::get('migrate',function(){
    Artisan::call('migrate', ["--force" => true ]);
});
Route::get('/dashboard',function(){
    return view('dashboard');
  })->middleware(['auth'])->name('dshboard');

/**************************Auth************************************* */
Route::get('/auth', [RegisterController::class, 'authLogin'])
                ->middleware('guest')
                ->name('login');
// Route::get('/register', [RegisterController::class, 'create'])
//                 ->middleware('guest')
//                 ->name('register');



Route::post('/register', [RegisterController::class, 'store'])
                ->middleware('guest');

Route::get('/login', [LoginController::class, 'create'])
                ->middleware('guest')
                ->name('create-login');

Route::post('/login', [LoginController::class, 'store'])
                ->middleware('guest');

Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->middleware('guest')
                ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->middleware('guest')
                ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->middleware('guest')
                ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
                ->middleware('guest')
                ->name('password.update');

Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
                ->middleware('auth')
                ->name('verification.notice');

Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
                ->middleware(['auth', 'signed', 'throttle:6,1'])
                ->name('verification.verify');

Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware(['auth', 'throttle:6,1'])
                ->name('verification.send');

Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->middleware('auth')
                ->name('password.confirm');

Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
                ->middleware('auth');

Route::get('/logout', [LoginController::class, 'destroy'])
                ->middleware('auth:sanctum')
                ->name('logout');


             ############################admin routes######################################

Route::group(['middleware'=>'auth:sanctum'],function(){
 Route::group(['namespace'=>'API'],function(){
     Route::group(['namespace'=>'Admin'],function(){
    Route::group(['prefix'=>'admin'],function(){
        Route::group(['prefix'=>'users'],function(){
            Route::get('index', [UserController::class,'index']);
            Route::post('store', [UserController::class,'store']);
            Route::post('update/{id}', [UserController::class,'update']);
            Route::get('show/{id}', [UserController::class,'show']);
            Route::get('destroy/{id}', [UserController::class,'delete']);
        });
        Route::group(['prefix'=>'roles'],function(){
            Route::get('index', [RoleController::class,'index']);
            Route::post('store', [RoleController::class,'store']);
            Route::post('update/{id}', [RoleController::class,'update']);
            Route::get('show/{id}', [RoleController::class,'show']);
            Route::get('destroy/{id}', [RoleController::class,'delete']);
        });
    });
 });
 });
 });

// require __DIR__.'/user.php';
