'use strict'
define(
	[ 		'angularModules/plants/controllers/PlantsController',
			'angularModules/plants/controllers/PlantLaserController',
			'angularModules/plants/controllers/PlantPaymentController',
			'angularModules/plants/controllers/CashReportsController',
			'angularModules/plants/services/PlantsService', 'ngSanitize',
			'angular', ], function() {
		var plantModule = angular.module('plantApp', [ 'ngSanitize' ]);
		//===========================================================

		plantModule.value('plantsAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		plantModule.controller('plantsController', PlantsController);
		plantModule.controller('PlantLaserController', PlantLaserController);
		plantModule.controller('PlantPaymentController', PlantPaymentController);
		plantModule.controller('cashReportsController', CashReportsController);
		plantModule.service('PlantsService', PlantsService);
		//===========================================================
	});
