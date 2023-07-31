'use strict'
/*****************************************************/
	// PlantAddresses Service             
	// Service name : PlantAddressesService
	// Functionality: plantAddress list , plantAddress add, plantAddress edit, plantAddress delete, plantAddress import
	// Author : Sanchari Ghosh                               
	// Created Date : 16/08/2018                                        
	// Purpose:  Developing the functionalities of plantAddresses  
/*****************************************************/

function PlantAddressesService($http, $q, plantAddressesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.plantAddressesAPIEndpoint = plantAddressesAPIEndpoint;

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
		// Function name : plantAddressList
		// Functionality: PlantAddress List
		// Author : Sanchari Ghosh                               
		// Created Date : 16/08/2018                                        
		// Purpose:  Developing the listing functionalities of plantAddresses
/*****************************************************/

PlantAddressesService.prototype.plantAddressList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-plantAddress-list',
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
		// Function name : getPlantList
		// Functionality: Get Plant List
		// Author : Sanchari Ghosh                               
		// Created Date : 16/08/2018                                        
		// Purpose:  Developing the listing functionalities of plants
/*****************************************************/

PlantAddressesService.prototype.getPlantList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-plant-list',
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
		// Function name : plantAddressEdit
		// Functionality: PlantAddress Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 16/08/2018                                        
		// Purpose:  Developing the functionalities of view edit plantAddress page
/*****************************************************/

PlantAddressesService.prototype.plantAddressEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-plantAddress',
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
		// Function name : savePlantAddress
		// Functionality: Save PlantAddress
		// Author : Sanchari Ghosh                               
		// Created Date : 16/08/2018                                        
		// Purpose:  Developing the functionalities of save plantAddresses
/*****************************************************/
PlantAddressesService.prototype.savePlantAddress = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-plantAddress',
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
		// Function name : deletePlantAddress
		// Functionality: Delete PlantAddress
		// Author : Sanchari Ghosh                               
		// Created Date : 16/08/2018                                        
		// Purpose:  Developing the functionalities of delete plantAddress
/*****************************************************/
PlantAddressesService.prototype.deletePlantAddress = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-plantAddress',
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
		// Function name : saveCSVPlantAddress
		// Functionality: save PlantAddress after importing csv
		// Author : Sanchari Ghosh                               
		// Created Date : 27/08/2018                                        
		// Purpose:  Developing the functionalities of save PlantAddress after importing csv
/*****************************************************/
PlantAddressesService.prototype.saveCSVPlantAddress = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-csv-plantAddress',
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
















