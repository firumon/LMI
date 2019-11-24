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
            Route::get('hubs','HubController@apiList');
            Route::get('hub/{id}/detail','HubController@apiDetail');
            Route::get('image/{type}/{type_id}/{num?}','ImageController@image');
            Route::post('hub/authenticate','HubController@apiAuthenticate');
            Route::post('hub/jobs','OrderItemServiceController@apiJobs');
            Route::post('hub/providers','HubController@apiProviders');
        });
    });
