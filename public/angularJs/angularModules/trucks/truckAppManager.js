'use strict'
define(
	[ 'angularModules/trucks/controllers/TrucksController',
			'angularModules/trucks/services/TrucksService', 'ngSanitize',
			'angular', ], function() {
		var truckModule = angular.module('truckApp', [ 'ngSanitize' ]);
		//===========================================================

		truckModule.value('trucksAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		truckModule.controller('trucksController', TrucksController);
		truckModule.service('TrucksService', TrucksService);
		//===========================================================
	});
