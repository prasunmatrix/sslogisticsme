'use strict'
/*****************************************************/
	// Dashboards Service             
	// Service name : DashboardsService
	// Functionality: counter of different module
	// Author : Sanchari Ghosh                              
	// Created Date : 27/07/2018                                        
	// Purpose:  Developing the functionality of dashboard 
/*****************************************************/
function DashboardsService($http, $q, dashboardsAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.dashboardsAPIEndpoint = dashboardsAPIEndpoint;

	this.makeAsyncCall = function(method) {
		try {
			if (!method instanceof Object)
				throw new Error('Invalid async request');
			var defer = this.q.defer();
			defer.resolve(method);

			return defer.promise;
		} catch (error) {
			console.warn('Error occured ' + error.toString());
		}
	};
}

/*****************************************************/
		// Function name : dashboardList
		// Functionality: Dashboard List
		// Author : Sanchari Ghosh                               
		// Created Date : 17/04/2018                                        
		// Purpose:  Developing the listing functionalities 
/*****************************************************/

DashboardsService.prototype.dashboardList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/dashboard-list',
	        data: data,
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	    })
	    .then(function successCallback(response) {	
		    return response;
		  },function errorCallback(response) {
		    return response;
		  });

	} catch (error) {
		console.warn('error occured' + error.toString());
	}
};