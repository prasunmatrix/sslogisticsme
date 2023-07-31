'use strict'
define(
	[ 		'angularModules/petrol-pumps/controllers/PetrolPumpsController',
			'angularModules/petrol-pumps/controllers/PetrolpumpLaserController',
			'angularModules/petrol-pumps/controllers/PetrolpumpPaymentController',
			'angularModules/petrol-pumps/controllers/DieselReportsController',
			'angularModules/petrol-pumps/services/PetrolPumpsService', 'ngSanitize',
			'angular', ], function() {
		var petrolPumpModule = angular.module('petrolPumpApp', [ 'ngSanitize' ]);
		//===========================================================

		petrolPumpModule.value('petrolPumpsAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		petrolPumpModule.controller('petrolPumpsController', PetrolPumpsController);
		petrolPumpModule.controller('PetrolpumpLaserController', PetrolpumpLaserController);
		petrolPumpModule.controller('PetrolpumpPaymentController', PetrolpumpPaymentController);
		petrolPumpModule.controller('dieselReportsController', DieselReportsController);
		petrolPumpModule.service('PetrolPumpsService', PetrolPumpsService);
		//===========================================================
	});
