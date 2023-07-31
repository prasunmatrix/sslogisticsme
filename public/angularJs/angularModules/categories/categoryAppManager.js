'use strict'
define(
	[ 'angularModules/categories/controllers/CategoriesController',
			'angularModules/categories/services/CategoriesService', 'ngSanitize',
			'angular', ], function() {
		var categoryModule = angular.module('categoryApp', [ 'ngSanitize' ]);
		//===========================================================

		categoryModule.value('categoriesAPIEndpoint', {
			base : baseUrl,
		});
		//===========================================================
		categoryModule.controller('categoriesController', CategoriesController);
		categoryModule.service('CategoriesService', CategoriesService);
		//===========================================================
	});
