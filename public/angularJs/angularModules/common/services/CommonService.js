'use strict'
/*****************************************************/
	// Common Service             
	// Service name : CommonService
	// Functionality: commonly used functions (get country/state/city lists)
	// Author : Dilip Kumar Shaw                              
	// Created Date : 26/07/2018                                         
	// Purpose:  Developing the commpnly used functionalities
/*****************************************************/

function CommonService($http, $q, APIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.APIEndpoint = APIEndpoint;

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
		// Function name : getCountryList
		// Functionality: Get Country List
		// Author : Sanchari Ghosh                               
		// Created Date : 06/08/2018                                        
		// Purpose:  Developing the functionalities of getting country lists
/*****************************************************/

CommonService.prototype.getCountryList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-country-list',
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
		// Function name : getStateList
		// Functionality: Get State List
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of getting state lists
/*****************************************************/

CommonService.prototype.getStateList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-state-list',
	        data: 'country_id='+data,
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
		// Function name : getCityList
		// Functionality: Get City List
		// Author : Sanchari Ghosh                               
		// Created Date : 09/08/2018                                        
		// Purpose:  Developing the functionalities of getting city lists
/*****************************************************/

CommonService.prototype.getCityList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-city-list',
	        data: 'state_id='+data,
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
		// Function name : getLatLong
		// Functionality: Get Latitude Longitude from Address
		// Author : Sanchari Ghosh                               
		// Created Date : 17/08/2018                                        
		// Purpose:  Developing the functionalities of getting Latitude Longitude from Address
/*****************************************************/
CommonService.prototype.getLatLong = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url:'https://maps.googleapis.com/maps/api/geocode/json?address='+data+'&key='+ api_key,
	        data: data,
	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
	    })
	    .then(function successCallback(response) {
	    	console.log(response)	;
	    	return response;
		  },function errorCallback(response) {
		    return response;
		  });

	} catch (error) {
		console.warn('error occured' + error.toString());
	}
};







/*****************************************************/
		// Function name : getSupervisor
		// Functionality: Get Supervisor
		// Author : Sanchari Ghosh                               
		// Created Date : 22/08/2018                                        
		// Purpose:  Developing the functionalities of getting lists of supervisors
/*****************************************************/

CommonService.prototype.getSupervisor = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-supervisor-list',
	        data:'data='+data,
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
		// Function name : saveModalAddressZone
		// Functionality: save address zone from modal
		// Author : Sanchari Ghosh                               
		// Created Date : 11/03/2019                                        
		// Purpose:  Developing the functionalities of saving address zone from modal
/*****************************************************/

CommonService.prototype.saveModalAddressZone = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-modal-address-zone',
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
		// Function name : getAddressZoneListing
		// Functionality: get Address Zone List
		// Author : Sanchari Ghosh                               
		// Created Date : 11/03/2019                                        
		// Purpose:  Developing the functionalities of getting Address Zone List
/*****************************************************/
CommonService.prototype.getAddressZoneListing = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-addressZone-listing',
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





