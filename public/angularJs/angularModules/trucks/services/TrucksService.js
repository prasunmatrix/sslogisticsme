'use strict'
/*****************************************************/
	// Trucks Service             
	// Service name : TrucksService
	// Functionality: truck list , truck add, truck edit, truck delete, truck detail
	// Author : Sanchari Ghosh                               
	// Created Date : 10/08/2018                                        
	// Purpose:  Developing the functionalities of trucks  
/*****************************************************/

function TrucksService($http, $q, trucksAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.trucksAPIEndpoint = trucksAPIEndpoint;

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
		// Function name : truckList
		// Functionality: Truck List
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the listing functionalities of trucks
/*****************************************************/

TrucksService.prototype.truckList = function(data) {
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
		// Function name : truckEdit
		// Functionality: Truck Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the functionalities of view edit truck page
/*****************************************************/

TrucksService.prototype.truckEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-truck',
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
		// Function name : saveTruck
		// Functionality: Save Truck
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the functionalities of save trucks
/*****************************************************/
TrucksService.prototype.saveTruck = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-truck',
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
		// Function name : deleteTruck
		// Functionality: Delete Truck
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the functionalities of delete truck
/*****************************************************/
TrucksService.prototype.deleteTruck = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-truck',
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
		// Function name : getTruckDetail
		// Functionality: get the details of Truck
		// Author : Sanchari Ghosh                               
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the functionalities of getting the details of Truck
/*****************************************************/
TrucksService.prototype.getTruckDetail = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-truck-details',
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
		// Function name : getGPSTruckList
		// Functionality: get the list of Trucks for GPS tracking
		// Author : Sanchari Ghosh                               
		// Created Date : 21/10/2018                                        
		// Purpose:  Developing the functionalities of getting the list of Trucks for GPS tracking
/*****************************************************/
TrucksService.prototype.getGPSTruckList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-gps-truck-list',
	        data:data,
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
		// Function name : getAllVendorList
		// Functionality: get all the list of Vendors
		// Author : Sanchari Ghosh                               
		// Created Date : 27/12/2018                                        
		// Purpose:  Developing the functionalities of getting the all the list of Vendors
/*****************************************************/
TrucksService.prototype.getAllVendorList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-all-vendor-list',
	        data:data,
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
		// Function name : checkVendorDetails
		// Functionality: check whether vandor name exists or not
		// Author : Sanchari Ghosh                               
		// Created Date : 28/12/2018                                        
		// Purpose:  Developing the functionalities of checking whether vandor name exists or not
/*****************************************************/
TrucksService.prototype.checkVendorNameDetails = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/check-vendor-name-details',
	        data:data,
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



