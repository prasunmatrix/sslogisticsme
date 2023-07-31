'use strict'
define(
	[ 'angularModules/states/controllers/StatesController',
			'angularModules/states/services/StatesService', 'ngSanitize',
			'angular', ], function() {
		var stateModule = angular.module('stateApp', [ 'ngSanitize' ]);
		//===========================================================

		stateModule.value('statesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		stateModule.controller('statesController', StatesController);
		stateModule.service('StatesService', StatesService);
		//===========================================================
	});
