'use strict'
/*****************************************************/
	// Cities Service             
	// Service name : CitiesService
	// Functionality: city list , city add, city edit, city delete
	// Author : Sanchari Ghosh                               
	// Created Date : 07/08/2018                                        
	// Purpose:  Developing the functionalities of cities  
/*****************************************************/

function CitiesService($http, $q, citiesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.citiesAPIEndpoint = citiesAPIEndpoint;

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
		// Function name : cityList
		// Functionality: City List
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the listing functionalities of cities
/*****************************************************/

CitiesService.prototype.cityList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-city-list',
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
		// Function name : cityEdit
		// Functionality: City Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of view edit city page
/*****************************************************/

CitiesService.prototype.cityEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-city',
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
		// Function name : saveCity
		// Functionality: Save City
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of save cities
/*****************************************************/
CitiesService.prototype.saveCity = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-city',
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
		// Function name : deleteCity
		// Functionality: Delete City
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of delete city
/*****************************************************/
CitiesService.prototype.deleteCity = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-city',
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


