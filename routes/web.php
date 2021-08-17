<?php

use App\Http\Controllers\AjaxController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;


Route::get('/', function () {
    return view('auth.login');
});

Route::group(['middleware' => 'auth'], function () {

    //product
    Route::group(['prefix' => 'product'], function (Router $router) {

        $router->get('', [ProductController::class, 'index'])->name('product.index');
        $router->get('/create', [ProductController::class, 'create'])->name('product.create');
        $router->post('/store', [ProductController::class, 'store'])->name('product.store');
        $router->get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
        $router->post('/update', [ProductController::class, 'update'])->name('product.update');
        $router->get('/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');
        $router->get('/available', [ProductController::class,'availableProducts'])->name('available.product');
        $router->get('/purchase/{id}', [ProductController::class,'purchaseData']);
        $router->post('/insert-purchase', [ProductController::class,'storePurchase']);
    });

    //invoice
    Route::group(['prefix' => 'invoice'], function (Router $router) {

        $router->get('', [InvoiceController::class, 'index'])->name('invoice.index');
        $router->get('/create', [InvoiceController::class, 'create'])->name('invoice.create');
        $router->post('/store', [InvoiceController::class, 'store'])->name('invoice.store');
        $router->get('/add-invoice/{id}', [InvoiceController::class,'formData']);
        $router->get('/sold-products', [InvoiceController::class,'soldProducts'])->name('sold.products');
        $router->get('/invoice-details', [InvoiceController::class,'invoiceDetails'])->name('invoice.details');

    });

    //order
    Route::group(['prefix' => 'order'], function (Router $router) {

        $router->get('', [OrderController::class, 'index'])->name('order.index');
        $router->get('/create', [OrderController::class, 'create'])->name('order.create');
        $router->post('/store', [OrderController::class, 'store'])->name('order.store');
        $router->get('/add/{name}', [ProductController::class,'formData'])->name('add.order');
        $router->get('/pending', [OrderController::class,'pendingOrders'])->name('pending.orders');
        $router->get('/delivered', [OrderController::class,'deliveredOrders'])->name('delivered.orders');
        $router->post('/insert-new-order', [OrderController::class,'newStore'])->name('neworder.insert');
    });

    //customer
    Route::group(['prefix' => 'customer'], function (Router $router) {

        $router->get('', [CustomerController::class, 'index'])->name('customer.index');
        $router->get('/create', [CustomerController::class, 'create'])->name('customer.create');
        $router->post('/store', [CustomerController::class, 'store'])->name('customer.store');
        
    });

    Route::get('/ajax/email/name/{id}', [AjaxController::class, 'customerName'])->name('customer.name');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

});




require __DIR__.'/auth.php';
