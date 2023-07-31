'use strict'
/*****************************************************/
	// Forgot Password Service             
	// Service name : ForgotPasswordService
	// Functionality: forgot password
	// Author : Sanchari Ghosh                               
	// Created Date : 31/07/2018                                        
	// Purpose:  Developing the functionality of forgot password etc  
/*****************************************************/

function ForgotPasswordService($http, $q, forgotPasswordAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.forgotPasswordAPIEndpoint = forgotPasswordAPIEndpoint;

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
		// Function name : forgotPasswd
		// Functionality: Forgot Password
		// Author : Sanchari Ghosh                               
		// Created Date : 31/07/2018                                        
		// Purpose:  Developing the functionality of forgot password by calling serverside function
/*****************************************************/

ForgotPasswordService.prototype.forgotPassword = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/forgot-password',
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


