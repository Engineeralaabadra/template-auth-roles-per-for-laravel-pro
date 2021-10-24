<?php

use App\Http\Controllers\API\User\AddvertismentController;
use App\Http\Controllers\API\User\BannerController;
use App\Http\Controllers\API\User\CartController;
use App\Http\Controllers\API\User\ProductController;
use App\Http\Controllers\API\User\CategoryController;
use App\Http\Controllers\API\User\CouponcodeController;
use App\Http\Controllers\API\User\DeliveryController;
use App\Http\Controllers\API\User\OrderController;
use App\Http\Controllers\API\User\RoleController;
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
/**************************Auth************************************* */
Route::get('/auth', [RegisterController::class, 'authLogin'])
                ->middleware('guest')
                ->name('login');
Route::get('/register', [RegisterController::class, 'create'])
                ->middleware('guest')
                ->name('register');

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

             ############################user routes######################################
############################products######################################
Route::group(['middleware'=>'auth:sanctum'],function(){
    Route::group(['prefix'=>'user'],function(){
        Route::group(['prefix'=>'roles'],function(){
            Route::get('index', [RoleController::class,'index']);
            Route::post('store', [RoleController::class,'store']);
            Route::post('update/{id}', [RoleController::class,'update']);
            Route::get('show/{id}', [RoleController::class,'show']);
            Route::get('destroy/{id}', [RoleController::class,'delete']);
        });
        Route::group(['prefix'=>'categories'],function(){
            Route::get('index', [CategoryController::class,'index']);
            Route::get('main-categories', [CategoryController::class,'getMainCategories']);
            Route::get('sub-categories', [CategoryController::class,'getSubCategories']);
            Route::get('view-feature-sub-categories', [CategoryController::class,'viewFeatureSubCategories']);
            Route::get('show/{id}', [CategoryController::class,'show']);
            Route::get('show-products-category/{category_id}', [CategoryController::class,'showProductsCategory']);
        });
        Route::group(['prefix'=>'products'],function(){
            Route::get('index', [ProductController::class,'index']);
            Route::get('get-products-for-sub-category/{category_id}', [ProductController::class,'getProductsForSubCategory']);
            Route::get('show/{id}', [ProductController::class,'show']);
            Route::get('get-modern-products/', [ProductController::class,'getModernProducts']);
        });

        Route::group(['prefix'=>'orders'],function(){
            Route::get('index', [OrderController::class,'index']);
            Route::post('store', [OrderController::class,'store']);
            Route::post('update/{id}', [OrderController::class,'update']);
            Route::get('show/{id}', [OrderController::class,'show']);
            Route::get('destroy/{id}', [OrderController::class,'delete']);
        });
        Route::group(['prefix'=>'deliveries'],function(){
            Route::get('index', [DeliveryController::class,'index']);
            Route::post('store', [DeliveryController::class,'store']);
            Route::post('update/{id}', [DeliveryController::class,'update']);
            Route::get('show/{id}', [DeliveryController::class,'show']);
            Route::get('destroy/{id}', [DeliveryController::class,'delete']);
        });
        Route::group(['prefix'=>'couponcodes'],function(){
            Route::get('index', [CouponcodeController::class,'index']);
            Route::post('store', [CouponcodeController::class,'store']);
            Route::post('update/{id}', [CouponcodeController::class,'update']);
            Route::get('show/{id}', [CouponcodeController::class,'show']);
            Route::get('destroy/{id}', [CouponcodeController::class,'delete']);
        });
        Route::group(['prefix'=>'banners'],function(){
            Route::get('index', [BannerController::class,'index']);
            Route::post('store', [BannerController::class,'store']);
            Route::post('update/{id}', [BannerController::class,'update']);
            Route::get('show/{id}', [BannerController::class,'show']);
            Route::get('destroy/{id}', [BannerController::class,'delete']);
        });

        Route::group(['prefix'=>'addvertisments'],function(){
            Route::get('index', [AddvertismentController::class,'index']);
            Route::post('store', [addvertismentController::class,'store']);
            Route::post('update/{id}', [addvertismentController::class,'update']);
            Route::get('show/{id}', [addvertismentController::class,'show']);
            Route::get('destroy/{id}', [addvertismentController::class,'delete']);
        });

    });
});

Route::group(['prefix'=>'carts'],function(){
    Route::get('index', [CartController::class,'index']);
    Route::post('store', [CartController::class,'store']);
    Route::get('clear', [CartController::class,'clear']);
    Route::post('update/{id}', [CartController::class,'update']);
    Route::get('show/{id}', [CartController::class,'show']);
    Route::get('destroy/{id}', [CartController::class,'delete']);
});