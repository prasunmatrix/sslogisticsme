'use strict'
define(
	[ 'angularModules/cities/controllers/CitiesController',
			'angularModules/cities/services/CitiesService', 'ngSanitize',
			'angular', ], function() {
		var cityModule = angular.module('cityApp', [ 'ngSanitize' ]);
		//===========================================================

		cityModule.value('citiesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		cityModule.controller('citiesController', CitiesController);
		cityModule.service('CitiesService', CitiesService);
		//===========================================================
	});
