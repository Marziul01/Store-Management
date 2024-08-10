<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminLoginController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\CategoryController;
use App\Http\Controllers\admin\SubCategoryController;
use App\Http\Controllers\admin\BrandController;
use App\Http\Controllers\admin\ProductController;
use App\Http\Controllers\admin\CkEditorController;
use App\Http\Controllers\admin\ProductSubCategoryController;
use App\Http\Controllers\admin\TempImageController;
use App\Http\Controllers\admin\ProductImageController;
use App\Http\Controllers\SiteSettingsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\admin\VariationController;
use App\Http\Controllers\admin\ShippingController;
use App\Http\Controllers\admin\OrderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeePositionController;
use App\Http\Controllers\PaymentMethodsController;
use App\Http\Controllers\UserController;
use App\Models\Employee;

Route::group(['middleware' => 'admin.guest'],function(){
    Route::get('/',[AdminLoginController::class,'index'])->name('admin.login');
    Route::post('/authenticate',[AdminLoginController::class,'authenticate'])->name('admin.authenticate');
});

Route::group(['prefix' => 'admin'],function(){

    Route::group(['middleware' => 'admin.auth'],function(){
        Route::get('/',[DashboardController::class,'index'])->name('admin.dashboard');
        Route::get('/logout',[DashboardController::class,'logout'])->name('admin.logout');
        Route::resources(['category' => CategoryController::class]);
        Route::resources(['subcategory' => SubCategoryController::class]);
        Route::resources(['brand' => BrandController::class]);
        Route::resources(['product' => ProductController::class]);
        Route::resources(['variations' => VariationController::class]);
        Route::resources(['payment' => PaymentMethodsController::class]);
        Route::post('/upload',[CkEditorController::class,'upload'])->name('ck.upload');
        Route::post('/images/upload',[TempImageController::class,'store'])->name('temp-images.create');
        Route::get('/product-subcategories',[ProductSubCategoryController::class,'index'])->name('product-subcategories');
        Route::delete('/product-images/{image}',[ProductImageController::class,'destroy'])->name('product-images.delete');
        Route::post('/product-images',[ProductImageController::class,'store'])->name('product-images.store');
        Route::get('/header/settings',[SiteSettingsController::class,'header'])->name('headerSettings');
        Route::get('/footer/settings',[SiteSettingsController::class,'footer'])->name('footerSettings');
        Route::post('/save/siteSettings',[SiteSettingsController::class,'update'])->name('updateSiteSettings');
        Route::post('/save/headerSettings',[SiteSettingsController::class,'updateHeader'])->name('updateHeaderSettings');
        Route::post('/save/footerSettings',[SiteSettingsController::class,'updateFooter'])->name('updateFooterSettings');
        Route::post('/save/profileSettings',[ProfileController::class,'profileUpdate'])->name('profileUpdate');
        Route::get('/profile/details',[ProfileController::class,'profile'])->name('profile');
        Route::get('/profile/settings',[ProfileController::class,'profileSettings'])->name('profileSettings');
        Route::get('/variation/size',[VariationController::class,'size'])->name('variationSize');
        Route::post('/variation/size/save',[VariationController::class,'save'])->name('variation.save');
        Route::post('/variation/size/update/{id}',[VariationController::class,'updates'])->name('variation.updates');
        Route::post('/variations/update',[ProductController::class,'variationUpdate'])->name('updateVariations');
        Route::post('variation/color/image/delete/{id}',[ProductController::class,'colorImageDelete'])->name('colorImageDelete');
        Route::get('/shipping/methods',[ShippingController::class,'index'])->name('shipping');
        Route::post('/shipping/methods/store',[ShippingController::class,'store'])->name('shippingStore');
        Route::post('/shipping/methods/delete/{id}',[ShippingController::class,'delete'])->name('shippingDelete');
        Route::post('/shipping/methods/update/{id}',[ShippingController::class,'update'])->name('shippingUpdate');
        Route::get('/orders',[OrderController::class,'index'])->name('ordersPending');
        Route::get('/orders/complete',[OrderController::class,'ordersComplete'])->name('ordersComplete');
        Route::get('/orders/cancel',[OrderController::class,'ordersCancel'])->name('ordersCancel');
        Route::get('/view/orders/{id}',[OrderController::class,'viewOrders'])->name('viewOrders');
        Route::post('/save/orders',[OrderController::class,'saveOrder'])->name('saveOrder');
        Route::post('/order/status/update/{id}',[OrderController::class,'orderStatusUpdate'])->name('order-status-update');
        Route::post('/order/payment/status/update/{id}',[OrderController::class,'orderPaymentStatusUpdate'])->name('order-paymentStatus-update');
        Route::resources(['users' => UserController::class]);
        Route::get('notificationRead/{id}',[DashboardController::class,'notificationRead'])->name('notificationRead');
        Route::post('messages/mark-all-as-read',[DashboardController::class,'markAllAsRead'])->name('messages.markAllAsRead');
        Route::resources(['employeePosition' => EmployeePositionController::class]);
        Route::resources(['employee' => EmployeeController::class]);
    });

});
