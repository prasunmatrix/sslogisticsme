'use strict'
/*****************************************************/
	// Parties Service             
	// Service name : PartiesService
	// Functionality: party list , party add, party edit, party delete, party import
	// Author : Sanchari Ghosh                               
	// Created Date : 10/08/2018                                        
	// Purpose:  Developing the functionalities of parties  
/*****************************************************/

function PartiesService($http, $q, partiesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.partiesAPIEndpoint = partiesAPIEndpoint;

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
		// Function name : partyList
		// Functionality: Party List
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the listing functionalities of parties
/*****************************************************/

PartiesService.prototype.partyList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-party-list',
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
		// Function name : partyEdit
		// Functionality: Party Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the functionalities of view edit party page
/*****************************************************/

PartiesService.prototype.partyEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-party',
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
		// Function name : saveParty
		// Functionality: Save Party
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the functionalities of save parties
/*****************************************************/
PartiesService.prototype.saveParty = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-party',
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
		// Function name : deleteParty
		// Functionality: Delete Party
		// Author : Sanchari Ghosh                               
		// Created Date : 10/08/2018                                        
		// Purpose:  Developing the functionalities of delete party
/*****************************************************/
PartiesService.prototype.deleteParty = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-party',
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
		// Function name : saveCSVParty
		// Functionality: save parties after importing csv
		// Author : Sanchari Ghosh                               
		// Created Date : 27/08/2018                                        
		// Purpose:  Developing the functionalities of save parties after importing csv
/*****************************************************/
PartiesService.prototype.saveCSVParty = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-csv-party',
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
		// Function name : getPartyDetail
		// Functionality: get particular party details
		// Author : Sanchari Ghosh                               
		// Created Date : 03/01/2019                                        
		// Purpose:  Developing the functionalities of getting particular party details
/*****************************************************/
PartiesService.prototype.getPartyDetail = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-party-details',
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


