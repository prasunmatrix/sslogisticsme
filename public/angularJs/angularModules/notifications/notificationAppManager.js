'use strict'
define(
	[ 'angularModules/notifications/controllers/NotificationController',
			'angularModules/notifications/services/NotificationService', 'ngSanitize',
			'angular', ], function() {
		var notificationModule = angular.module('notificationApp', [ 'ngSanitize' ]);
		//===========================================================

		notificationModule.value('notificationAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		notificationModule.controller('NotificationController', NotificationController);
		notificationModule.service('NotificationService', NotificationService);
		//===========================================================
	});
