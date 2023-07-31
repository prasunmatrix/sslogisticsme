'use strict'
define(
	[ 'angularModules/change-password/controllers/ChangePasswordController',
			'angularModules/change-password/services/ChangePasswordService', 'ngSanitize',
			'angular', ], function() {
		var changePasswdModule = angular.module('changePasswordApp', [ 'ngSanitize' ]);
		//===========================================================
		changePasswdModule.value('changePasswordAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		changePasswdModule.controller('changePasswordController', ChangePasswordController);
		changePasswdModule.service('ChangePasswordService', ChangePasswordService);
		//===========================================================
	});
