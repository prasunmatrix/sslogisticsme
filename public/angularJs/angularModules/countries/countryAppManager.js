'use strict'
define(
	[ 'angularModules/countries/controllers/CountriesController',
			'angularModules/countries/services/CountriesService', 'ngSanitize',
			'angular', ], function() {
		var countryModule = angular.module('countryApp', [ 'ngSanitize' ]);
		//===========================================================

		countryModule.value('countriesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		countryModule.controller('countriesController', CountriesController);
		countryModule.service('CountriesService', CountriesService);
		//===========================================================
	});
