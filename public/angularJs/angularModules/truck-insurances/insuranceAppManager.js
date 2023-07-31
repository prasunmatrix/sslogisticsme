'use strict'
define(
	[ 'angularModules/truck-insurances/controllers/InsurancesController',
			'angularModules/truck-insurances/services/InsurancesService', 'ngSanitize',
			'angular', ], function() {
		var insuranceModule = angular.module('insuranceApp', [ 'ngSanitize' ]);
		//===========================================================

		insuranceModule.value('insurancesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		insuranceModule.controller('insurancesController', InsurancesController);
		insuranceModule.service('InsurancesService', InsurancesService);
		//===========================================================
	});
