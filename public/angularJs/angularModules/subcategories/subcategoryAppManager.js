'use strict'
define(
	[ 'angularModules/subcategories/controllers/SubcategoriesController',
			'angularModules/subcategories/services/SubcategoriesService', 'ngSanitize',
			'angular', ], function() {
		var subcategoryModule = angular.module('subcategoryApp', [ 'ngSanitize' ]);
		//===========================================================

		subcategoryModule.value('subcategoriesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		subcategoryModule.controller('subcategoriesController', SubcategoriesController);
		subcategoryModule.service('SubcategoriesService', SubcategoriesService);
		//===========================================================
	});
