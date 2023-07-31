'use strict'
/*****************************************************/
	// States Service             
	// Service name : StatesService
	// Functionality: state list , state add, state edit, state delete
	// Author : Sanchari Ghosh                               
	// Created Date : 03/08/2018                                        
	// Purpose:  Developing the functionalities of states  
/*****************************************************/

function StatesService($http, $q, statesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.statesAPIEndpoint = statesAPIEndpoint;

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
		// Function name : stateList
		// Functionality: State List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/08/2018                                        
		// Purpose:  Developing the listing functionalities of states
/*****************************************************/

StatesService.prototype.stateList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-state-list',
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
		// Function name : stateEdit
		// Functionality: State Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 06/08/2018                                        
		// Purpose:  Developing the functionalities of view edit state page
/*****************************************************/

StatesService.prototype.stateEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-state',
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
		// Function name : saveState
		// Functionality: Save State
		// Author : Sanchari Ghosh                               
		// Created Date : 06/08/2018                                        
		// Purpose:  Developing the functionalities of save states
/*****************************************************/
StatesService.prototype.saveState = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-state',
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
		// Function name : deleteState
		// Functionality: Delete State
		// Author : Sanchari Ghosh                               
		// Created Date : 06/08/2018                                        
		// Purpose:  Developing the functionalities of delete state
/*****************************************************/
StatesService.prototype.deleteState = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-state',
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


