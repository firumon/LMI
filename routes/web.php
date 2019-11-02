<?php

    Route::group([
        'middleware' => ['web'],
        'namespace' => 'Firumon\\LLM\\Controller'
    ], function () {
        Route::view('home','lmi::home')->name('home');
        Route::group([
            'prefix' => 'v',
        ],function(){
            Route::get('orders','OrderController@apiList');
            Route::get('invoices','InvoiceController@apiList');
            Route::get('receipts','ReceiptController@apiList');
            Route::get('deliveries','DeliveryController@apiList');
        });
    });
