'use strict'
define(
	[ 'angularModules/party-destinations/controllers/PartyDestinationsController',
			'angularModules/party-destinations/services/PartyDestinationsService', 'ngSanitize',
			'angular', ], function() {
		var partyDestinationModule = angular.module('partyDestinationApp', [ 'ngSanitize' ]);
		//===========================================================

		partyDestinationModule.value('partyDestinationsAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		partyDestinationModule.controller('partyDestinationsController', PartyDestinationsController);
		partyDestinationModule.service('PartyDestinationsService', PartyDestinationsService);
		//===========================================================
	});
