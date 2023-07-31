'use strict'
/*****************************************************/
	// Reset Password Service             
	// Service name : ResetPasswordService
	// Functionality: reset password
	// Author : Sanchari Ghosh                               
	// Created Date : 01/08/2018                                        
	// Purpose:  Developing the functionality of reset password etc  
/*****************************************************/

function ResetPasswordService($http, $q, resetPasswordAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.resetPasswordAPIEndpoint = resetPasswordAPIEndpoint;

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
		// Function name : resetPasswd
		// Functionality: Reset Password
		// Author : Sanchari Ghosh                               
		// Created Date : 01/08/2018                                        
		// Purpose:  Developing the functionality of reset password by calling serverside function
/*****************************************************/

ResetPasswordService.prototype.resetPassword = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/reset-password',
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


