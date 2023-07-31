'use strict'
/*****************************************************/
	// User Service             
	// Service name : UsersService
	// Functionality: login
	// Author : Dilip Kumar Shaw                                 
	// Created Date : 26/07/2018                                        
	// Purpose:  Developing the functionality of login
/*****************************************************/

function UsersService($http, $q, usersAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.usersAPIEndpoint = usersAPIEndpoint;

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
		// Function name : loginVerify
		// Functionality: login
		// Author : Sanchari Ghosh                               
		// Created Date : 27/07/2018                                        
		// Purpose:  Developing the functionality of login by calling serverside function
/*****************************************************/

UsersService.prototype.loginVerify = function(data) {

	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/do-login',
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
