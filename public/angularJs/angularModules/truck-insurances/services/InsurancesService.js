'use strict'
/*****************************************************/
	// Insurances Service             
	// Service name : InsurancesService
	// Functionality: insurance list , insurance add, insurance edit, insurance delete
	// Author : Sanchari Ghosh                               
	// Created Date : 13/08/2018                                        
	// Purpose:  Developing the functionalities of insurances  
/*****************************************************/

function InsurancesService($http, $q, insurancesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.insurancesAPIEndpoint = insurancesAPIEndpoint;

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
		// Functionality: Insurance List
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the listing functionalities of insurances
/*****************************************************/

InsurancesService.prototype.insuranceList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-truckInsurance-list',
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
		// Function name : getTruckList
		// Functionality: Get Truck List
		// Author : Sanchari Ghosh                               
		// Created Date : 16/08/2018                                        
		// Purpose:  Developing the listing functionalities of trucks
/*****************************************************/

InsurancesService.prototype.getTruckList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-truck-list',
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
		// Function name : insuranceEdit
		// Functionality: Insurance Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the functionalities of view edit insurance page
/*****************************************************/

InsurancesService.prototype.insuranceEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-truckInsurance',
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
		// Function name : saveInsurance
		// Functionality: Save Insurance
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the functionalities of save insurances
/*****************************************************/
InsurancesService.prototype.saveInsurance = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-truckInsurance',
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
		// Function name : deleteInsurance
		// Functionality: Delete Insurance
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the functionalities of delete insurance
/*****************************************************/
InsurancesService.prototype.deleteInsurance = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-truckInsurance',
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


