'use strict'
define(
	[ 'angularModules/plant-addresses/controllers/PlantAddressesController',
			'angularModules/plant-addresses/services/PlantAddressesService', 'ngSanitize',
			'angular', ], function() {
		var plantAddressModule = angular.module('plantAddressApp', [ 'ngSanitize' ]);
		//===========================================================

		plantAddressModule.value('plantAddressesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		plantAddressModule.controller('plantAddressesController', PlantAddressesController);
		plantAddressModule.service('PlantAddressesService', PlantAddressesService);
		//===========================================================
	});
