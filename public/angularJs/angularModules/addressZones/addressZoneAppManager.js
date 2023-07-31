'use strict'
define(
	[ 'angularModules/addressZones/controllers/AddressZonesController',
			'angularModules/addressZones/services/AddressZonesService', 'ngSanitize',
			'angular', ], function() {
		var addressZoneModule = angular.module('addressZoneApp', [ 'ngSanitize' ]);
		//===========================================================

		addressZoneModule.value('addressZonesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		addressZoneModule.controller('addressZonesController', AddressZonesController);
		addressZoneModule.service('AddressZonesService', AddressZonesService);
		//===========================================================
	});
