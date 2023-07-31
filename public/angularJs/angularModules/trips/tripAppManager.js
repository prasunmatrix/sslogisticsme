'use strict'
define(
	[ 'angularModules/trips/controllers/TripsController',
	  'angularModules/trips/controllers/ConsolidatedTripsController',
	  'angularModules/trips/controllers/PDFTripsController',
	  'angularModules/trips/controllers/TripReportsController',
	  'angularModules/trips/controllers/PaymentReportsController',
	  'angularModules/trips/controllers/ExtraCashDieselsController',
	  'angularModules/trips/controllers/LedgerReportsController',
			'angularModules/trips/services/TripsService', 'ngSanitize',
			'angular', ], function() {
		var tripModule = angular.module('tripApp', [ 'ngSanitize' ]);
		//===========================================================

		tripModule.value('tripsAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		tripModule.controller('tripsController', TripsController);
		tripModule.controller('consolidatedTripsController', ConsolidatedTripsController);
		tripModule.controller('pdfTripsController', PDFTripsController);
		tripModule.controller('tripReportsController',TripReportsController);
		tripModule.controller('paymentReportsController',PaymentReportsController);
		tripModule.controller('extraCashDieselsController',ExtraCashDieselsController);
		tripModule.controller('ledgerReportsController',LedgerReportsController);
		tripModule.service('TripsService', TripsService);
		//===========================================================
	});
