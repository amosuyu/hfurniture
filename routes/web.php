<?php

use App\Http\Controllers\ckEditorController;
use App\Http\Controllers\SendMailController;
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

Route::group(['middleware' => 'locale'], function () {
    /*Client*/
    Route::get('/', [App\Http\Controllers\ClientController::class, 'index'])->name('homeClient');
    Route::get('loai-san-pham/{id?}', [App\Http\Controllers\ClientController::class, 'productsByCategory'])->name('productsByCategory');
    Route::get('bo-suu-tap/{id?}', [App\Http\Controllers\ClientController::class, 'productsByCollection'])->name('productsByCollection');
    Route::get('lien-he', [App\Http\Controllers\ClientController::class, 'contact'])->name('contact');
    Route::get('thong-tin', [App\Http\Controllers\ClientController::class, 'aboutus'])->name('aboutus');
    Route::get('chinh-sach/{id}', [App\Http\Controllers\ClientController::class, 'policy'])->name('policyClient');
    Route::get('san-pham/{id}', [App\Http\Controllers\ClientController::class, 'productDetail'])->name('productDetail');
    Route::get('tin-tuc/{id}', [App\Http\Controllers\ClientController::class, 'blogDetail'])->name('blogDetail');
    Route::get('danh-sach-tin-tuc/{id}', [App\Http\Controllers\ClientController::class, 'blogList'])->name('blogList');
    Route::get('add-to-cart/{id}/{quantity}', [App\Http\Controllers\CartController::class, 'addToCart'])->name('addToCart');
    Route::get('delete-item-cart/{id}', [App\Http\Controllers\CartController::class, 'deleteItemCart'])->name('deleteItemCart');
    Route::get('gio-hang', [App\Http\Controllers\CartController::class, 'listCart'])->name('listCart');
    Route::get('delete-item-list-cart/{id}', [App\Http\Controllers\CartController::class, 'deleteItemListCart'])->name('deleteItemListCart');
    Route::get('save-item-list-cart/{id}/{quantity}', [App\Http\Controllers\CartController::class, 'saveItemListCart'])->name('saveItemListCart');
    Route::get('cart', [App\Http\Controllers\CartController::class, 'cart']);
    Route::get('total-price-detail', [App\Http\Controllers\CartController::class, 'totalPriceDetail']);
    Route::get('use-voucher/{code}', [App\Http\Controllers\CartController::class, 'useVoucher'])->name('useVoucher');
    Route::get('list-cart-ajax', [App\Http\Controllers\CartController::class, 'listCartAjax']);
    Route::get('thanh-toan-don-hang', [App\Http\Controllers\CartController::class, 'listCartAjax']);
    Route::post('save-all-list-cart', [App\Http\Controllers\CartController::class, 'saveAllListCart']);
    Route::post('delete-all-list-cart', [App\Http\Controllers\CartController::class, 'deleteAllListCart']);
    Route::get('thanh-toan', [App\Http\Controllers\CartController::class, 'payment'])->name('payment');
    Route::post('xu-ly-thanh-toan', [App\Http\Controllers\CartController::class, 'handlePayment'])->name('handlePayment');
    Route::get('hoan-thanh-dat-hang/{id}', [App\Http\Controllers\CartController::class, 'completeOrder'])->name('completeOrder');
    Route::get('thanh-toan-online', [App\Http\Controllers\CartController::class, 'paymentOnline'])->name('paymentOnline');
    Route::get('return-vnpay', [App\Http\Controllers\CartController::class, 'return']);
    Route::post('gui-binh-luan', [App\Http\Controllers\ClientController::class, 'sendComment'])->name('sendComment');
    Route::get('hien-thi-danh-gia/{id}', [App\Http\Controllers\ClientController::class, 'renderRating']);
    Route::get('search-product', [App\Http\Controllers\ClientController::class, 'searchProduct'])->name('searchProduct');
/* Auth */
    Route::get('dang-nhap', [App\Http\Controllers\ClientAuthController::class, 'login'])->name('loginClient');
    Route::post('xu-ly-dang-nhap', [App\Http\Controllers\ClientAuthController::class, 'handleLogin'])->name('handleLogin');
    Route::post('xu-ly-dang-ky', [App\Http\Controllers\ClientAuthController::class, 'handleRegister'])->name('handleRegister');
    Route::get('dang-xuat', [App\Http\Controllers\ClientAuthController::class, 'logout'])->name('handleLogout');
    Route::get('thong-tin-tai-khoan', [App\Http\Controllers\ClientAuthController::class, 'information'])->name('information');
    Route::post('cap-nhat-tai-khoan', [App\Http\Controllers\ClientAuthController::class, 'updateInformation'])->name('updateInformation');
    Route::get('quen-mat-khau', [App\Http\Controllers\ClientAuthController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('reset-password', [App\Http\Controllers\ResetPasswordController::class, 'sendMail'])->name('sendMail');
    Route::post('reset-password/{token}', [App\Http\Controllers\ResetPasswordController::class, 'reset'])->name('reset');
    Route::get('dat-lai-mat-khau/{token}', [App\Http\Controllers\ResetPasswordController::class, 'resetPassword'])->name('resetPassword');
    Route::post('thay-doi-mat-khau', [App\Http\Controllers\ClientAuthController::class, 'changePassword'])->name('changePassword');
   
/* end Auth */

/* location */
    Route::get('getDistrict/{code}', [App\Http\Controllers\CartController::class, 'getDistrict'])->name('getDistrict');
    Route::get('getWard/{code}', [App\Http\Controllers\CartController::class, 'getWard'])->name('getWard');
    Route::get('getShipFee/{code}', [App\Http\Controllers\CartController::class, 'getShipFee'])->name('getShipFee');
/* end location */
/* Send Mail Contact */
    Route::post('send-contact', [App\Http\Controllers\SendMailController::class, 'sendMail'])->name('sendMailContact');
/* End Send Mail Contact*/

/* Change Language*/
    Route::get('change-language/{language}', [App\Http\Controllers\ClientController::class, 'changeLanguage'])->name('changeLanguage');
/* End Change Language*/
/*end Client*/
});

/*Admin*/
Route::group(['middleware' => ['auth', 'ruleAdmin'], 'prefix' => 'quan-tri'], function () {
    Route::GET('/', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    Route::Get('changeYearOfRevenue/{year}', [App\Http\Controllers\DashboardController::class, 'changeYearOfRevenue']);
    Route::POST('ckeditor/upload', [ckEditorController::class, 'upload'])->name('ckeditor.image-upload');
    Route::resource('/mau-sac', App\Http\Controllers\ColorsController::class);
    Route::resource('/san-pham', App\Http\Controllers\ProductsController::class);
    Route::resource('/bo-suu-tap', App\Http\Controllers\CollectionsController::class);
    Route::resource('/khong-gian', App\Http\Controllers\SpacesController::class);
    Route::resource('/giam-gia', App\Http\Controllers\VouchersController::class);
    Route::resource('/loai-blog', App\Http\Controllers\BlogtypesController::class);
    Route::resource('/blog', App\Http\Controllers\BlogsController::class);
    Route::resource('/loai-san-pham', App\Http\Controllers\CategoriesController::class);
    Route::resource('/chinh-sach', App\Http\Controllers\PoliciesController::class);
    Route::resource('/tai-khoan', App\Http\Controllers\UsersController::class);
    Route::resource('/don-hang', App\Http\Controllers\OrdersController::class);
});

Auth::routes();
Route::get('quan-tri/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
Route::get('quan-tri/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/*endAdmin*/
