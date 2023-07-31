'use strict'
define(
	[ 
        'angular',
        'angularModules/dashboards/controllers/DashboardsController',	  	  
        'angularModules/dashboards/services/DashboardsService'      
 	], function() {
		var dashboardModule = angular.module('dashboardApp', []);
		//===========================================================
		dashboardModule.value('dashboardsAPIEndpoint', {
			base : baseUrl			
					
        });
        //===========================================================
		dashboardModule.controller('dashboardsController',DashboardsController);
        dashboardModule.service('DashboardsService', DashboardsService);
        //===========================================================
	});
