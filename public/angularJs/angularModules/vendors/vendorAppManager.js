'use strict'
define(
	[ 'angularModules/vendors/controllers/VendorsController',
	  'angularModules/vendors/controllers/CustomerReportsController',
	  'angularModules/vendors/controllers/VendorReportsController',
	  'angularModules/vendors/controllers/VendorPaymentController',
			'angularModules/vendors/services/VendorsService', 'ngSanitize',
			'angular', ], function() {
		var vendorModule = angular.module('vendorApp', [ 'ngSanitize' ]);
		//===========================================================

		vendorModule.value('vendorsAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		vendorModule.controller('vendorsController', VendorsController);
		vendorModule.controller('customerReportsController', CustomerReportsController);
		vendorModule.controller('vendorReportsController', VendorReportsController);
		vendorModule.controller('vendorPaymentController', VendorPaymentController);
		vendorModule.service('VendorsService', VendorsService);
		//===========================================================
	});
