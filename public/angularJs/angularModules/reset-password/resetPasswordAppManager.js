'use strict'
define(
	[ 'angularModules/reset-password/controllers/ResetPasswordController',
			'angularModules/reset-password/services/ResetPasswordService', 'ngSanitize',
			'angular', ], function() {
		var resetPasswdModule = angular.module('resetPasswordApp', [ 'ngSanitize' ]);
		//===========================================================
		resetPasswdModule.value('resetPasswordAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		resetPasswdModule.controller('resetPasswordController', ResetPasswordController);
		resetPasswdModule.service('ResetPasswordService', ResetPasswordService);
		//===========================================================
	});
