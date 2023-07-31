'use strict'
define(
	[ 'angularModules/forgot-password/controllers/ForgotPasswordController',
			'angularModules/forgot-password/services/ForgotPasswordService', 'ngSanitize',
			'angular', ], function() {
		var forgotPasswdModule = angular.module('forgotPasswordApp', [ 'ngSanitize' ]);
		//===========================================================
		forgotPasswdModule.value('forgotPasswordAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		forgotPasswdModule.controller('forgotPasswordController', ForgotPasswordController);
		forgotPasswdModule.service('ForgotPasswordService', ForgotPasswordService);
		//===========================================================
	});
