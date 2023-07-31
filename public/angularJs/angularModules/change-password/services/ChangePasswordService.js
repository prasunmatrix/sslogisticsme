'use strict'
/*****************************************************/
	// Change Password Service             
	// Service name : ChangePasswordService
	// Functionality: change password
	// Author : Sanchari Ghosh                               
	// Created Date : 31/07/2018                                        
	// Purpose:  Developing the functionality of change password etc  
/*****************************************************/

function ChangePasswordService($http, $q, changePasswordAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.changePasswordAPIEndpoint = changePasswordAPIEndpoint;

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
		// Function name : changePasswd
		// Functionality: Change Password
		// Author : Sanchari Ghosh                               
		// Created Date : 31/07/2018                                        
		// Purpose:  Developing the functionality of change password by calling serverside function
/*****************************************************/

ChangePasswordService.prototype.changePassword = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/change-password',
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


