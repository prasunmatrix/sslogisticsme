'use strict'
/*****************************************************/
	// PartyDestinations Service             
	// Service name : PartyDestinationsService
	// Functionality: partyDestination list , partyDestination add, partyDestination edit, partyDestination delete, import partyDestination
	// Author : Sanchari Ghosh                               
	// Created Date : 13/08/2018                                        
	// Purpose:  Developing the functionalities of partyDestinations  
/*****************************************************/

function PartyDestinationsService($http, $q, partyDestinationsAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.partyDestinationsAPIEndpoint = partyDestinationsAPIEndpoint;

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
		// Function name : partyDestinationList
		// Functionality: PartyDestination List
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the listing functionalities of partyDestinations
/*****************************************************/

PartyDestinationsService.prototype.partyDestinationList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-partyDestination-list',
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
		// Function name : getPartyList
		// Functionality: Get Party List
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the listing functionalities of parties
/*****************************************************/

PartyDestinationsService.prototype.getPartyList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-party-list',
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
		// Function name : partyDestinationEdit
		// Functionality: PartyDestination Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the functionalities of view edit partyDestination page
/*****************************************************/

PartyDestinationsService.prototype.partyDestinationEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-partyDestination',
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
		// Function name : savePartyDestination
		// Functionality: Save PartyDestination
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the functionalities of save partyDestinations
/*****************************************************/
PartyDestinationsService.prototype.savePartyDestination = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-partyDestination',
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
		// Function name : deletePartyDestination
		// Functionality: Delete PartyDestination
		// Author : Sanchari Ghosh                               
		// Created Date : 13/08/2018                                        
		// Purpose:  Developing the functionalities of delete partyDestination
/*****************************************************/
PartyDestinationsService.prototype.deletePartyDestination = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-partyDestination',
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
		// Function name : saveCSVPartyDestination
		// Functionality: save PartyDestination after importing csv
		// Author : Sanchari Ghosh                               
		// Created Date : 28/08/2018                                        
		// Purpose:  Developing the functionalities of save PartyDestination after importing csv
/*****************************************************/
PartyDestinationsService.prototype.saveCSVPartyDestination = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-csv-partyDestination',
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


