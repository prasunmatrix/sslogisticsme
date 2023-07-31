'use strict'
define(
	[ 		'angularModules/approval/controllers/ApprovalManageController',
			'angularModules/approval/services/ApprovalManageService', 'ngSanitize',
			'angular', ], function() {
		var approvalModule = angular.module('approvalApp', [ 'ngSanitize' ]);
		//===========================================================

		approvalModule.value('approvalAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		approvalModule.controller('ApprovalManageController', ApprovalManageController);
		approvalModule.service('ApprovalManageService', ApprovalManageService);
		//===========================================================
	});
