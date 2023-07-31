'use strict'
/*****************************************************/
	// Countries Service             
	// Service name : CountriesService
	// Functionality: country list 
	// Author : Sanchari Ghosh                               
	// Created Date : 13/08/2018                                        
	// Purpose:  Developing the functionalities of countries  
/*****************************************************/

function CountriesService($http, $q, countriesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.countriesAPIEndpoint = countriesAPIEndpoint;

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
		// Function name : countryList
		// Functionality: Country List
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the listing functionalities of countries
/*****************************************************/

CountriesService.prototype.countryList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-country-list',
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


