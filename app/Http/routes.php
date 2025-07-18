<?php
       /*Cache Clear*/
        Route::get('/clear-cache', function() {
    		Artisan::call('cache:clear');
    		Artisan::call('view:clear');
		});
		// Cron Job Routing
		Route::get('cronjob', 'CronController@index');

		/* Admin part routing */
		Route::get('/', 'LoginController@login');
		Route::get('/login', 'LoginController@login');
		Route::post('/authenticate', 'LoginController@authenticate');
		Route::get('/logout', 'LoginController@logout');
		// Password Reset Routes...
		Route::get('password/resets/{token?}', 'LoginController@showResetForm');
		Route::post('password/resets/{token?}', 'LoginController@setPassword');
		Route::post('password/email', 'LoginController@sendResetLinkEmail');
		Route::get('password/reset', 'LoginController@reset');

		// Customer Login Route 
		Route::get('customer', 'CustomerAuth\AuthController@showLoginForm');
		Route::post('customer/authenticate', 'CustomerAuth\AuthController@login');
		Route::get('customer/logout', 'CustomerAuth\AuthController@logout');

		Route::get('customer/dashboard', 'CustomerPanelController@index');
		Route::get('customer/profile', 'CustomerPanelController@profile');
		Route::post('customer/profile', 'CustomerPanelController@updateProfile');

		Route::get('customer-panel/order/{id}','CustomerPanelController@salesOrder');
		Route::get('customer-panel/view-order-details/{id}','CustomerPanelController@viewOrderDetails');
		Route::get('customer-panel/orderPdf/{order_id}','CustomerPanelController@orderPdf');
		Route::get('customer-panel/orderPrint/{order_id}','CustomerPanelController@orderPrint');

		Route::get('customer-panel/invoice/{id}','CustomerPanelController@invoice');
		Route::get('customer-panel/view-detail-invoice/{order_id}/{invoice_id}','CustomerPanelController@viewInvoiceDetails');
		Route::get('customer-panel/invoice-pdf/{order_id}/{invoice_id}','CustomerPanelController@invoicePdf');
		Route::get('customer-panel/invoice-print/{order_id}/{invoice_id}','CustomerPanelController@invoicePrint');

		Route::get('customer-panel/payment/{id}','CustomerPanelController@payment');
		Route::get('customer-panel/view-receipt/{id}','CustomerPanelController@viewReceipt');
		
		Route::get('customer-panel/shipment/{id}','CustomerPanelController@shipment');
		Route::get('customer-panel/view-shipment-details/{order_id}/{shipment_id}','CustomerPanelController@shipmentDetails');

		Route::get('customer-panel/branch/{id}','CustomerPanelController@branch');
		Route::get('customer-panel/branch/edit/{id}','CustomerPanelController@branchEdit');
		Route::post('customer-panel/branch/update/{id}','CustomerPanelController@branchUpdate');
        //New added by ashraf
        Route::get('customer-panel/payment-pdf/{id}','CustomerPanelController@createReceiptPdf');
        Route::get('customer-panel/payment-print/{id}','CustomerPanelController@printReceipt');
        Route::get('customer-panel/shipment-pdf/{order_id}/{shipment_id}','CustomerPanelController@shipmentPdf');
        Route::get('customer-panel/shipment-print/{order_id}/{shipment_id}','CustomerPanelController@shipmentPrint');
        
	Route::group(['middleware' => ['auth','locale'] ], function() {
	
		/* User Actions */
		Route::get('dashboard','DashboardController@index');
		Route::post('change-lang','DashboardController@switchLanguage');
		Route::get('users','UserController@index')->middleware(['permission:manage_team_member']);
		Route::get('create-user','UserController@create')->middleware(['permission:add_team_member']);
		Route::post('save-user','UserController@store');
		Route::get('edit-user/{id}','UserController@edit')->middleware(['permission:add_team_member']);
		Route::post('update-user/{id}','UserController@update');
		Route::post('delete-user/{id}','UserController@destroy')->middleware(['permission:delete_team_member']);
		Route::post('email-valid','UserController@validEmail');
		Route::get('profile','UserController@profile');
		Route::get('change-password/{id}','UserController@changePassword');
		Route::post('change-password/{id}','UserController@updatePassword');
		// Details 
		Route::get('user/purchase-list/{id}','UserController@userPurchaseOrderList');
		Route::get('user/sales-order-list/{id}','UserController@userSalesOrderList');
		Route::get('user/sales-invoice-list/{id}','UserController@userSalesInvoiceList');
		Route::get('user/user-transfer-list/{id}','UserController@userTransferList');
		Route::get('user/user-payment-list/{id}','UserController@userPaymentList');

		Route::get('role/list','RoleController@index')->middleware(['permission:manage_role']);
		Route::get('role/create','RoleController@create')->middleware(['permission:add_role']);
		Route::post('role/save','RoleController@store');
		Route::get('role/edit/{id}','RoleController@edit')->middleware(['permission:edit_role']);
		Route::post('role/update','RoleController@update');
		Route::post('role/delete','RoleController@destroy')->middleware(['permission:delete_role']);

		// item category
		Route::get('item-category','CategoryController@index');
		Route::get('create-category','CategoryController@create')->middleware(['permission:add_item_category']);
		Route::post('save-category','CategoryController@store');
		Route::post('edit-category','CategoryController@edit')->middleware(['permission:edit_item_category']);
		Route::post('update-category','CategoryController@update');
		Route::post('delete-category/{id}','CategoryController@destroy')->middleware(['permission:delete_item_category']);
		Route::get('categorydownloadExcel/{type}', 'CategoryController@downloadCsv');
		Route::get('categoryimport', 'CategoryController@import');
		Route::post('categoryimportcsv', 'CategoryController@importCsv');

		// item Unit
		Route::get('unit','UnitController@index')->middleware(['permission:manage_unit']);
		Route::get('create-unit','UnitController@create')->middleware(['permission:add_unit']);
		Route::post('save-unit','UnitController@store');
		Route::post('edit-unit','UnitController@edit')->middleware(['permission:edit_unit']);
		Route::post('update-unit','UnitController@update');
		Route::post('delete-unit/{id}','UnitController@destroy')->middleware(['permission:delete_unit']);

		
		// Location
		Route::get('location','LocationController@index')->middleware(['permission:manage_location']);
		Route::get('create-location','LocationController@create')->middleware(['permission:add_location']);
		Route::post('save-location','LocationController@store');
		Route::get('edit-location/{id}','LocationController@edit')->middleware(['permission:edit_location']);
		Route::post('update-location/{id}','LocationController@update');
		Route::post('delete-location/{id}','LocationController@destroy')->middleware(['permission:delete_location']);
		Route::get('loc_code-valid','LocationController@validLocCode');

		// Item
		Route::get('item','ItemController@index')->middleware(['permission:manage_item']);
		Route::get('create-item/{tab}','ItemController@create')->middleware(['permission:add_item']);
		Route::post('save-item','ItemController@store');
		Route::get('edit-item/{tab}/{id}','ItemController@edit')->middleware(['permission:edit_item']);
		Route::get('copy-item/{id}','ItemController@copy');
		Route::get('show-item/{id}','ItemController@show');
		Route::post('update-item/{id}','ItemController@update');
		Route::post('item/delete/{id}','ItemController@destroy')->middleware(['permission:delete_item']);

		Route::post('save-sale-price','ItemController@storeSalePrice');
		Route::post('save-purchase-price','ItemController@storePurchasePrice');
		Route::post('update-item-info','ItemController@updateItemInfo');
		Route::post('add-sale-price','ItemController@addSalePrice');
		Route::post('edit-sale-price','ItemController@editSalePrice');
		Route::post('update-sale-price','ItemController@updateSalePrice');
		Route::post('delete-sale-price/{id}/{item_id}','ItemController@deleteSalePrice');
		Route::post('update-purchase-price','ItemController@updatePurchasePrice');

		Route::post('add-stock','ItemController@addStock');
		Route::post('remove-stock','ItemController@removeStock');
		Route::post('move-stock','ItemController@moveStock');
		Route::post('stock-valid','ItemController@stockValidChk');
		Route::post('qty-valid','ItemController@qtyValidAjax');
		Route::get('trans-details/{id}','ItemController@showFullDetails');

		Route::get('itemdownloadcsv/{type}', 'ItemController@downloadCsv');
		Route::get('itemimport', 'ItemController@import');
		Route::post('itemimportcsv', 'ItemController@importCsv');

		// Company 
		Route::get('company','CompanyController@index');
		Route::get('create-company','CompanyController@create');
		Route::post('save-company','CompanyController@store');
		Route::get('edit-company/{id}','CompanyController@edit');
		Route::post('update-company/{id}','CompanyController@update');
		Route::post('delete-company/{id}','CompanyController@destroy');

		// create direct sale / invoive
		Route::get('sales/list','SalesController@index')->middleware(['permission:manage_invoice']);
		Route::get('sales/add','SalesController@create')->middleware(['permission:add_invoice']);
		Route::post('sales/save','SalesController@store');
		Route::get('sales/edit/{id}','SalesController@edit')->middleware(['permission:edit_invoice']);
		Route::post('sales/update','SalesController@update');
		Route::post('sales/delete/{id}','SalesController@destroy')->middleware(['permission:delete_invoice']);
		Route::post('sales/reference-validation','SalesController@referenceValidation');
		Route::post('sales/get-branches','SalesController@customerBranches');
		
		Route::post('sales/search','SalesController@search');
		Route::post('sales/quantity-validation','SalesController@quantityValidation');
		Route::post('sales/check-item-qty','SalesController@checkItemQty');
		Route::get('sales/preview/{id}','SalesController@pdfview');
        Route::post('sales/quantity-validation-with-localtion','SalesController@quantityValidationWithLocaltion');
		Route::post('sales/quantity-validation-edit-invoice','SalesController@quantityValidationEditInvoice');
		Route::get('sales/filtering','SalesController@salesFiltering');
		
		// create sales order
		Route::get('order/list','SalesOrderController@index')->middleware(['permission:manage_order']);
		Route::get('order/add','SalesOrderController@create')->middleware(['permission:add_order']);
		Route::post('order/save','SalesOrderController@store');
		Route::get('order/edit/{id}','SalesOrderController@edit')->middleware(['permission:edit_order']);
		Route::post('order/update','SalesOrderController@update');
		Route::post('order/delete/{id}','SalesOrderController@destroy')->middleware(['permission:delete_order']);
		Route::get('order/view-order/{id}','SalesOrderController@viewOrder');
		Route::post('order/convert-order','SalesOrderController@convertOrder');

		Route::post('order/search','SalesOrderController@search');
		Route::post('order/quantity-validation','SalesOrderController@quantityValidation');

		Route::get('order/view-order-details/{id}','SalesOrderController@viewOrderDetails');
		Route::get('order/manual-invoice-create/{id}','SalesOrderController@manualInvoiceCreate');
		Route::post('order/save-manual-invoice','SalesOrderController@storeManualInvoice');
		Route::get('order/auto-invoice-create/{id}','SalesOrderController@autoInvoiceCreate');
		Route::post('order/check-quantity-after-invoice','SalesOrderController@checkQuantityAfterInvoice');
		Route::get('order/pdf/{order_id}','SalesOrderController@orderPdf');
		Route::get('order/print/{order_id}','SalesOrderController@orderPrint');
		Route::post('order/email-order-info','SalesOrderController@sendOrderInformationByEmail');	
		Route::get('order/filtering','SalesOrderController@orderFiltering');	


		// Invoice Routing
		Route::get('invoice/view-detail-invoice/{orderId}/{invoiceId}','InvoiceController@viewInvoiceDetails');
		Route::post('invoice/email-invoice-info','InvoiceController@sendInvoiceInformationByEmail');
		Route::get('invoice/pdf/{order_id}/{invoice_id}','InvoiceController@invoicePdf');
		Route::get('invoice/print/{order_id}/{invoice_id}','InvoiceController@invoicePrint');		
		Route::post('invoice/delete/{id}','InvoiceController@destroy');
		Route::get('invoice/delete-invoice/{id}','InvoiceController@destroy');
		// Customer 
		Route::get('customer/list','CustomerController@index')->middleware(['permission:manage_customer']);
		Route::get('create-customer','CustomerController@create')->middleware(['permission:add_customer']);
		Route::post('save-customer','CustomerController@store');
		Route::get('customer/edit/{id}','CustomerController@edit')->middleware(['permission:edit_customer']);
		Route::get('customer/order/{id}','CustomerController@salesOrder');
		Route::get('customer/invoice/{id}','CustomerController@invoice');
		Route::get('customer/payment/{id}','CustomerController@payment');
		Route::get('customer/shipment/{id}','CustomerController@shipment');
		Route::post('update-customer/{id}','CustomerController@update');
		Route::post('customer/update-password','CustomerController@updatePassword');
		Route::post('delete-customer/{id}','CustomerController@destroy')->middleware(['permission:delete_customer']);

		Route::get('customerdownloadCsv/{type}', 'CustomerController@downloadCsv');
		Route::get('customerimport', 'CustomerController@import');
		Route::post('customerimportcsv', 'CustomerController@importCsv');
		Route::post('customer/delete-sales-info', 'CustomerController@deleteSalesInfo');
		//Route::post('customerimportcsv', 'CustomerController@importCsv');

		// Customer Branch
		Route::get('branch','CustomerController@index');
		Route::get('create-branch','CustomerController@create');
		Route::post('save-branch','CustomerController@storeBranch');
		Route::post('edit-branch','CustomerController@editBranch');
		Route::post('update-branch','CustomerController@updateBranch');
		Route::post('delete-branch/{id}','CustomerController@destroyBranch');

		// supplier 
		Route::get('supplier','SupplierController@index')->middleware(['permission:manage_supplier']);
		Route::get('create-supplier','SupplierController@create')->middleware(['permission:add_supplier']);
		Route::post('save-supplier','SupplierController@store');
		Route::get('edit-supplier/{id}','SupplierController@edit')->middleware(['permission:edit_supplier']);
		Route::post('update-supplier/{id}','SupplierController@update');
		Route::post('delete-supplier/{id}','SupplierController@destroy')->middleware(['permission:delete_supplier']);
        Route::get('supplier/orders/{id}','SupplierController@orderList');

		Route::get('supplierdownloadCsv/{type}', 'SupplierController@downloadCsv');
		Route::get('supplierimport', 'SupplierController@import');
		Route::post('supplierimportcsv', 'SupplierController@importCsv');

		// check-in Purchese Order
		Route::get('purchase/list','PurchaseController@index')->middleware(['permission:manage_purchase']);
		Route::get('purchase/add','PurchaseController@create')->middleware(['permission:add_purchase']);
		Route::post('purchase/save','PurchaseController@store');
		Route::get('purchase/edit/{id}','PurchaseController@edit')->middleware(['permission:edit_purchase']);
		Route::post('purchase/update','PurchaseController@update');
		Route::post('purchase/delete/{id}','PurchaseController@destroy')->middleware(['permission:delete_purchase']);
		
		Route::post('purchase/item-search','PurchaseController@searchItem');
		Route::get('purchase/view-purchase-details/{id}','PurchaseController@viewPurchaseInvoiceDetail');
	
		Route::get('purchase/pdf/{order_id}','PurchaseController@invoicePdf');
		Route::get('purchase/print/{order_id}','PurchaseController@invoicePrint');
		Route::post('purchase/reference-validation','PurchaseController@referenceValidation');
		
		Route::get('purchase/filtering','PurchaseController@Filtering');
		Route::post('purchase/email-purchase-info','PurchaseController@sendPurchaseInformationEmail');

		// Stock Transfer Routing
		Route::get('transfer/list','StockTransferController@index')->middleware(['permission:manage_transfer']);
		Route::get('transfer/create','StockTransferController@create')->middleware(['permission:add_transfer']);
		Route::post('transfer/search','StockTransferController@itemSearch');
		Route::post('transfer/get-destination','StockTransferController@destinationList');
		Route::post('transfer/check-item-qty','StockTransferController@checkItemQty');
		Route::post('transfer/save','StockTransferController@store');
		Route::get('transfer/view-details/{id}','StockTransferController@details');
		Route::post('transfer/delete/{id}','StockTransferController@destroy')->middleware(['permission:delete_transfer']);
		// Payment Routing
		Route::post('payment/save','PaymentController@createPayment');

		// item Tax
		Route::get('tax','TaxController@index');
		Route::get('create-tax','TaxController@create')->middleware(['permission:add_tax']);
		Route::post('save-tax','TaxController@store');
		Route::post('edit-tax','TaxController@edit')->middleware(['permission:edit_tax']);
		Route::post('update-tax','TaxController@update');
		Route::post('delete-tax/{id}','TaxController@destroy')->middleware(['permission:delete_tax']);

		// item Sales Type
		Route::get('sales-type','SalesTypeController@index')->middleware(['permission:manage_sales_type']);

		Route::post('save-sales-type','SalesTypeController@store');
		Route::post('edit-sales-type','SalesTypeController@edit')->middleware(['permission:edit_sales_type']);
		Route::post('update-sales-type','SalesTypeController@update');
		Route::post('delete-sales-type/{id}','SalesTypeController@destroy')->middleware(['permission:delete_sales_type']);

		// Settings
		Route::get('setting-general','SettingController@index');
		Route::get('setting-email-template','SettingController@mailTemp');
		Route::get('setting-preference','SettingController@preference');
		Route::get('setting-finance','SettingController@finance');
		Route::get('setting-company','SettingController@company');
		Route::post('save-preference','SettingController@savePreference');

		Route::get('currency','SettingController@currency')->middleware(['permission:manage_currency']);
		Route::post('save-currency','SettingController@store');
		Route::post('edit-currency','SettingController@edit')->middleware(['permission:edit_currency']);
		Route::post('update-currency','SettingController@update');
		Route::post('delete-currency/{id}','SettingController@destroy')->middleware(['permission:delete_currency']);

		Route::get('backup/list','SettingController@backupList')->middleware(['permission:manage_db_backup']);

		Route::get('back-up','SettingController@backupDB');
		Route::get('email/setup','SettingController@emailSetup');
		Route::post('save-email-config','SettingController@emailSaveConfig');
		Route::post('test-email','SettingController@testEmailConfig');

		
		//Payment route
		Route::get('payment/terms','SettingController@paymentTerm')->middleware(['permission:manage_payment_term']);
		Route::post('payment/terms/add','SettingController@addPaymentTerms')->middleware(['permission:add_payment_term']);
		Route::post('payment/terms/edit','SettingController@editPaymentTerms')->middleware(['permission:edit_payment_term']);
		Route::post('payment/terms/update','SettingController@updatePaymentTerms');
		Route::post('payment/terms/delete/{id}','SettingController@deletePaymentTerm')->middleware(['permission:delete_payment_term']);

		Route::get('payment/method','SettingController@paymentMethod')->middleware(['permission:manage_payment_method']);
		Route::post('payment/method/add','SettingController@addPaymentMethod')->middleware(['permission:add_payment_method']);
		Route::post('payment/method/edit','SettingController@editPaymentMethod')->middleware(['permission:edit_payment_method']);
		Route::post('payment/method/update','SettingController@updatePaymentMethod');
		Route::post('payment/method/delete/{id}','SettingController@deletePaymentMethod')->middleware(['permission:delete_payment_method']);
		Route::get('company/setting','SettingController@companySetting');
		Route::post('company/setting/save','SettingController@companySettingSave');
		//New added by  ashraf
		Route::post('company/image_delete','SettingController@deleteImage');
		//mail template
		Route::get('mail-temp','MailTemplateController@index');
		Route::get('customer-invoice-temp/{id}','MailTemplateController@customerInvTemp');
		Route::post('customer-invoice-temp/{id}','MailTemplateController@update');

		// Payment Routing
		Route::get('payment/list','PaymentController@index')->middleware(['permission:manage_payment']);
		Route::post('payment/delete','PaymentController@delete')->middleware(['permission:delete_payment']);
		Route::get('payment/view-receipt/{id}','PaymentController@viewReceipt');
		Route::get('payment/create-receipt/{id}','PaymentController@createReceiptPdf');
		Route::get('payment/print-receipt/{id}','PaymentController@printReceipt');
		Route::post('payment/email-payment-info','PaymentController@sendPaymentInformationByEmail');
		Route::get('payment/pay-all/{orderid}','PaymentController@payAllAmount');

		Route::get('payment/filtering','PaymentController@paymentFiltering');
		
		// Shipment Routing
		Route::get('shipment/add/{id}','ShipmentController@createShipment')->middleware(['permission:add_shipment']);
		Route::post('shipment/store','ShipmentController@storeShipment');
		Route::get('shipment/create-auto-shipment/{id}','ShipmentController@storeAutoShipment');
		Route::get('shipment/list','ShipmentController@index')->middleware(['permission:manage_shipment']);
		Route::post('shipment/status-change','ShipmentController@StatusChange');
		Route::post('shipment/delete/{id}','ShipmentController@destroy');
		Route::get('shipment/view-details/{order_id}/{shipment_id}','ShipmentController@shipmentDetails');
		Route::get('shipment/pdf/{order_id}/{shipment_id}','ShipmentController@pdfMake');
		Route::get('shipment/print/{order_id}/{shipment_id}','ShipmentController@shipmentPrint');
		Route::get('shipment/edit/{id}','ShipmentController@edit')->middleware(['permission:edit_shipment']);
		Route::post('shipment/quantity-validation','ShipmentController@shipmentQuantityValidation');
		Route::post('shipment/update','ShipmentController@update');
		Route::post('shipment/email-shipment-info','ShipmentController@sendShipmentInformationByEmail');
		Route::get('shipment/delivery/{oid}/{sid}','ShipmentController@makeDelivery');

		Route::get('shipment/filtering','ShipmentController@shipmentFiltering');

		// Report Routing
		Route::get('report/inventory-stock-on-hand','ReportController@inventoryStockOnHand')->middleware(['permission:manage_stock_on_hand']);
		
		Route::get('report/inventory-stock-on-hand-pdf','ReportController@inventoryStockOnHandPdf');
		Route::get('report/inventory-stock-on-hand-csv','ReportController@inventoryStockOnHandCsv');
		Route::get('report/sales-report','ReportController@salesReport')->middleware(['permission:manage_sale_report']);
		Route::get('report/sales-report-pdf','ReportController@salesReportPdf');
		Route::get('report/sales-report-csv','ReportController@salesReportCsv');
		Route::get('report/sales-report-by-date/{date}','ReportController@salesReportByDate');
		Route::get('report/sales-report-by-date-pdf/{date}','ReportController@salesReportByDatePdf');
		Route::get('report/sales-report-by-date-csv/{date}','ReportController@salesReportByDateCsv');
	
		Route::get('report/sales-history-report','ReportController@salesHistoryReport')->middleware(['permission:manage_sale_history_report']);
		Route::get('report/sales-history-report-pdf','ReportController@salesHistoryReportPdf');
		Route::get('report/sales-history-report-csv','ReportController@salesHistoryReportCsv');
		// Purchase Report
        Route::get('report/purchase-report','ReportController@purchaseReport')->middleware(['permission:manage_purchase_report']);
        Route::get('report/purchase-report-pdf','ReportController@purchaseReportPdf');
        Route::get('report/purchase-report-csv','ReportController@purchaseReportCsv');
        Route::get('report/purchase_report_datewise/{time}','ReportController@purchaseReportDateWise');
        Route::get('report/purchase-year-list','ReportController@purchaseYearList');

        Route::get('report/member-report','UserController@memberReport')->middleware(['permission:manage_team_report']);
		
		// Barcode Generation
		Route::match(['get','post'],'barcode/create',  'BarcodeController@index')->middleware(['permission:manage_barcode']);
		Route::post('barcode/search','BarcodeController@search');

		/// Purchase Order Items Received
		Route::get('purchase_receive/list','ReceiveController@receiveList');
		
		Route::get('receive/all/{id}','ReceiveController@allReceive');
		Route::post('receive/all_store','ReceiveController@allStore');
		Route::get('receive/manual/{id}','ReceiveController@manualReceive');
		Route::post('receive/manual_store','ReceiveController@manualStore');
		Route::get('receive/details/{id}','ReceiveController@receiveDetails');
		Route::get('receive/pdf/{id}','ReceiveController@receivePdf');
		Route::get('receive/print/{id}','ReceiveController@receivePrint');
        Route::post('receive/delete','ReceiveController@destroy');
        Route::get('receive/edit/{id}','ReceiveController@edit');
        Route::post('receive/update','ReceiveController@update');
        Route::post('receive/email-purchase-info','ReceiveController@purchaseReceivedEmail');
        Route::get('receive/filter','ReceiveController@receiveFilter');


	});