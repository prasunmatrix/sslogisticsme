'use strict'
/*****************************************************/
	// Notification Service             
	// Service name : NotificationService
	// Functionality: insurance List , permit List,tax List, pollution List, registration List
	// Author : Debamala Dey                                
	// Created Date : 03/09/2018                                      
	// Purpose:  Developing the functionalities of insurance List , permit List,tax List, pollution List, registration List  
/*****************************************************/

function NotificationService($http, $q, notificationAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.notificationAPIEndpoint = notificationAPIEndpoint;

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
		// Function name : insuranceList
		// Functionality: insurance List
		// Author : Debamala Dey                                
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of insurance
/*****************************************************/

NotificationService.prototype.insuranceList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-insurance-list',
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


/*****************************************************/
		// Function name : permitList
		// Functionality: permit List
		// Author : Debamala Dey                                
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of permit
/*****************************************************/

NotificationService.prototype.permitList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-permit-list',
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

/*****************************************************/
		// Function name : taxList
		// Functionality: tax List
		// Author : Debamala Dey                                
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of tax
/*****************************************************/

NotificationService.prototype.taxList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-tax-list',
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

/*****************************************************/
		// Function name : pollutionList
		// Functionality: pollution List
		// Author : Debamala Dey                                
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of pollution
/*****************************************************/

NotificationService.prototype.pollutionList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-pollution-list',
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
/*****************************************************/
		// Function name : registrationList
		// Functionality: registration List
		// Author : Debamala Dey                                
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of registration
/*****************************************************/

NotificationService.prototype.registrationList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-registration-list',
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