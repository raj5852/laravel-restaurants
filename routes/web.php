<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;




Route::view('/', 'login')->name('login');

Route::view('register', 'register');
//Google login
Route::get('login/google', [LoginController::class, 'redirectToGoogle'])->name('login.google');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback']);

//Facebook login
Route::get('login/facebook', [LoginController::class, 'redirectToFacebook'])->name('login.facebook');
Route::get('login/facebook/callback', [LoginController::class, 'handleFacebookCallback']);

//custom auth
Route::post('customlogin', [LoginController::class, 'postLogin'])->name('customlogin');
Route::post('customregister', [LoginController::class, 'postRegistration'])->name('customregister');


Route::group(['middleware' => 'auth'], function () {

    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('category', [CategoryController::class, 'index'])->name('category');
    Route::get('getcategory', [CategoryController::class, 'getCategory'])->name('getcategory');
    Route::post('categorydelete', [CategoryController::class, 'delete'])->name('categorydelete');
    Route::post('category-create', [CategoryController::class, 'create'])->name('categorycreate');
    Route::post('editrequest', [CategoryController::class, 'editrequest'])->name('editrequest');
    Route::post('category-update', [CategoryController::class, 'update'])->name('categoryupdate');
    Route::post('category-status', [CategoryController::class, 'status'])->name('categorystatus');

    Route::get('table',[TableController::class,'index'])->name('table');
    Route::get('table-get',[TableController::class,'tableget'])->name('tableget');
    Route::post('table-create',[TableController::class,'tablecreate'])->name('tablecreate');
    Route::post('table-request',[TableController::class,'tablerequest'])->name('tablerequest');
    Route::post('table-update',[TableController::class,'tableupdate'])->name('tableupdate');
    Route::post('table-delete',[TableController::class,'delete'])->name('tabledelete');
    Route::post('table-status',[TableController::class,'status'])->name('tablestatus');

    Route::get('tax',[TaxController::class,'index'])->name('tax');
    Route::post('tax-create',[TaxController::class,'create'])->name('taxcreate');
    Route::get('tax-get',[TaxController::class,'taxget'])->name('taxget');
    Route::post('tax-edit-request',[TaxController::class,'edit'])->name('taxedit');
    Route::post('tax-update',[TaxController::class,'update'])->name('taxupdate');
    Route::post('tax-delete',[TaxController::class,'delete'])->name('taxdelete');
    Route::post('tax-status',[TaxController::class,'status'])->name('taxstatus');
    
    Route::get('product',[ProductController::class,'index'])->name('product');
    Route::post('product-create',[ProductController::class,'create'])->name('productcreate');
    Route::get('product-get',[ProductController::class,'getproduct'])->name('getproduct');
    Route::post('product-status',[ProductController::class,'status'])->name('productstatus');
    Route::post('product-edit',[ProductController::class,'edit'])->name('productedit');
    Route::post('product-update',[ProductController::class,'update'])->name('productupdate');
    Route::post('product-delete',[ProductController::class,'delete'])->name('productdelete');

    Route::get('user',[UserController::class,'index'])->name('user');
    Route::post('user-create',[UserController::class,'create'])->name('usercreate');
    Route::get('user-get',[UserController::class,'getuser'])->name('getuser');
    Route::post('user-status',[UserController::class,'status'])->name('userstatus');
    Route::post('user-edit',[UserController::class,'useredit'])->name('useredit');
    Route::post('user-update',[UserController::class,'update'])->name('userupdate');
    Route::post('user-delete',[UserController::class,'delete'])->name('userdelete');

    Route::get('order',[OrderController::class,'index'])->name('order');
    Route::post('order-product',[OrderController::class,'product'])->name('orderproduct');
    Route::post('table-submit',[OrderController::class,'tablesubmit'])->name('tablesubmit');
    Route::post('order-call',[OrderController::class,'ordercall'])->name('ordercall');
    Route::post('calltable',[OrderController::class,'callTable'])->name('callTable');
});
