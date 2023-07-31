'use strict'
/*****************************************************/
	// Plants Service             
	// Service name : PlantsService
	// Functionality: plant list , plant add, plant edit, plant delete, plant import, search plant laser, save plant pay
	// Author : Sanchari Ghosh                               
	// Created Date : 08/08/2018                                        
	// Purpose:  Developing the functionalities of plants  
/*****************************************************/

function PlantsService($http, $q, plantsAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.plantsAPIEndpoint = plantsAPIEndpoint;

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
		// Function name : plantList
		// Functionality: Plant List
		// Author : Sanchari Ghosh                               
		// Created Date : 08/08/2018                                        
		// Purpose:  Developing the listing functionalities of plants
/*****************************************************/

PlantsService.prototype.plantList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-plant-list',
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
		// Function name : plantEdit
		// Functionality: Plant Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 08/08/2018                                        
		// Purpose:  Developing the functionalities of view edit plant page
/*****************************************************/

PlantsService.prototype.plantEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-plant',
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
		// Function name : savePlant
		// Functionality: Save Plant
		// Author : Sanchari Ghosh                               
		// Created Date : 08/08/2018                                        
		// Purpose:  Developing the functionalities of save plants
/*****************************************************/
PlantsService.prototype.savePlant = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-plant',
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
		// Function name : deletePlant
		// Functionality: Delete Plant
		// Author : Sanchari Ghosh                               
		// Created Date : 08/08/2018                                        
		// Purpose:  Developing the functionalities of delete plant
/*****************************************************/
PlantsService.prototype.deletePlant = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-plant',
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
		// Function name : saveCSVPlant
		// Functionality: save plants after importing csv
		// Author : Sanchari Ghosh                               
		// Created Date : 24/08/2018                                        
		// Purpose:  Developing the functionalities of save plants after importing csv
/*****************************************************/
PlantsService.prototype.saveCSVPlant = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-csv-plant',
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
		// Function name : allPlanList
		// Functionality: Plant List
		// Author : Debamala Dey                                 
    	// Created Date : 03/09/2018                                      
		// Purpose:  Developing the listing functionalities of plants
/*****************************************************/

PlantsService.prototype.allPlantList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-allplant-list',
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
		// Function name : searchLaserPlant
		// Functionality: Plant Laser List
		// Author : Debamala Dey                                 
    	// Created Date : 04/09/2018                                      
		// Purpose:  Developing the listing functionalities of Plant Laser
/*****************************************************/

PlantsService.prototype.searchLaserPlant = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-plantLaser-list',
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
// Function name : savePlantPay
// Functionality: Save Plant Pay
// Author : Debamala Dey                                 
// Created Date : 05/09/2018                                        
// Purpose:  Developing the functionalities of save Plant payment
/*****************************************************/
PlantsService.prototype.savePlantPay = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/add-plant-payment',
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
		// Function name : getPlantDetail
		// Functionality: get particular plant details
		// Author : Sanchari Ghosh                               
		// Created Date : 31/12/2018                                        
		// Purpose:  Developing the functionalities of getting particular plant details
/*****************************************************/
PlantsService.prototype.getPlantDetail = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-plant-details',
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
		// Function name : getCashReport
		// Functionality: get cash report
		// Author : Sanchari Ghosh                               
		// Created Date : 03/04/2019                                        
		// Purpose:  Developing the functionalities of getting cash report
/*****************************************************/
PlantsService.prototype.getCashReport = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-cash-report',
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
		// Function name : activePlantList
		// Functionality: getting active plant list
		// Author : Sanchari Ghosh                               
		// Created Date : 03/04/2019                                        
		// Purpose:  Developing the functionalities of getting active plant list
/*****************************************************/
PlantsService.prototype.activePlantList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-active-plant-list',
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
