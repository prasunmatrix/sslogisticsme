'use strict'
define(
	[ 'angularModules/parties/controllers/PartiesController',
			'angularModules/parties/services/PartiesService', 'ngSanitize',
			'angular', ], function() {
		var partyModule = angular.module('partyApp', [ 'ngSanitize' ]);
		//===========================================================

		partyModule.value('partiesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		partyModule.controller('partiesController', PartiesController);
		partyModule.service('PartiesService', PartiesService);
		//===========================================================
	});
