'use strict'
/*****************************************************/
	// Profile Service            
	// Service name : ProfileService
	// Functionality: get and save profile data
	// Author : Sanchari Ghosh                               
	// Created Date : 30/07/2018                                        
	// Purpose:  Developing the functionality of profile section  
/*****************************************************/

function ProfileService($http, $q, profileAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.profileAPIEndpoint = profileAPIEndpoint;

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
		// Function name : getProfileData
		// Functionality: get profile data
		// Author : Sanchari Ghosh                               
		// Created Date : 01/08/2018                                        
		// Purpose:  get data for profile section
/*****************************************************/
ProfileService.prototype.getProfileData = function() {
	try {
		return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-profile-data',
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




 /*****************************************************/
		// Function name : saveProfileData
		// Functionality: save profile data
		// Author : Sanchari Ghosh                               
		// Created Date : 01/08/2018                                        
		// Purpose:  saving data for profile section
/*****************************************************/
ProfileService.prototype.saveProfileData = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-profile',
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
