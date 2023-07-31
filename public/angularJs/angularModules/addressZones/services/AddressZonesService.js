'use strict'
/*****************************************************/
	// AddressZones Service             
	// Service name : AddressZonesService
	// Functionality: addressZone list , addressZone add, addressZone edit, addressZone delete
	// Author : Sanchari Ghosh                               
	// Created Date : 21/12/2018                                        
	// Purpose:  Developing the functionalities of addressZones  
/*****************************************************/

function AddressZonesService($http, $q, addressZonesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.addressZonesAPIEndpoint = addressZonesAPIEndpoint;

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
		// Function name : addressZoneList
		// Functionality: AddressZone List
		// Author : Sanchari Ghosh                               
		// Created Date : 21/12/2018                                        
		// Purpose:  Developing the listing functionalities of addressZones
/*****************************************************/

AddressZonesService.prototype.addressZoneList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-addressZone-list',
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
		// Function name : deleteAddressZone
		// Functionality: Delete AddressZone
		// Author : Sanchari Ghosh                               
		// Created Date : 21/12/2018                                        
		// Purpose:  Developing the functionalities of delete addressZone
/*****************************************************/
AddressZonesService.prototype.deleteAddressZone = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-addressZone',
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


