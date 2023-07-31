'use strict'
/*****************************************************/
	// PetrolPumps Service             
	// Service name : PetrolPumpsService
	// Functionality: petrolPump list , petrolPump add, petrolPump edit, petrolPump delete, import petrolPump, search Laser petrolPump,save petrolPump pay
	// Author : Sanchari Ghosh                               
	// Created Date : 09/08/2018                                        
	// Purpose:  Developing the functionalities of petrolPumps  
/*****************************************************/

function PetrolPumpsService($http, $q, petrolPumpsAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.petrolPumpsAPIEndpoint = petrolPumpsAPIEndpoint;

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
		// Function name : petrolPumpList
		// Functionality: PetrolPump List
		// Author : Sanchari Ghosh                               
		// Created Date : 09/08/2018                                        
		// Purpose:  Developing the listing functionalities of petrolPumps
/*****************************************************/

PetrolPumpsService.prototype.petrolPumpList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-petrolPump-list',
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
		// Function name : petrolPumpEdit
		// Functionality: PetrolPump Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 09/08/2018                                        
		// Purpose:  Developing the functionalities of view edit petrolPump page
/*****************************************************/

PetrolPumpsService.prototype.petrolPumpEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-petrolPump',
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
		// Function name : savePetrolPump
		// Functionality: Save PetrolPump
		// Author : Sanchari Ghosh                               
		// Created Date : 09/08/2018                                        
		// Purpose:  Developing the functionalities of save petrolPumps
/*****************************************************/
PetrolPumpsService.prototype.savePetrolPump = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-petrolPump',
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
		// Function name : deletePetrolPump
		// Functionality: Delete PetrolPump
		// Author : Sanchari Ghosh                               
		// Created Date : 09/08/2018                                        
		// Purpose:  Developing the functionalities of delete petrolPump
/*****************************************************/
PetrolPumpsService.prototype.deletePetrolPump = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-petrolPump',
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
		// Function name : saveCSVPetrolPump
		// Functionality: save PetrolPump after importing csv
		// Author : Sanchari Ghosh                               
		// Created Date : 27/08/2018                                        
		// Purpose:  Developing the functionalities of save PetrolPumps after importing csv
/*****************************************************/
PetrolPumpsService.prototype.saveCSVPetrolPump = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-csv-petrolPump',
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
// Function name : allPetrolPumpList
// Functionality: PetrolPump List
// Author : Debamala Dey                                 
// Created Date : 05/09/2018                                      
// Purpose:  Developing the listing functionalities of PetrolPump Laser
/*****************************************************/

PetrolPumpsService.prototype.allPetrolPumpList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-allpetrolpump-list',
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
// Function name : searchLaserPetrolPump
// Functionality: PetrolPump Laser search List
// Author : Debamala Dey                                 
// Created Date : 05/09/2018                                      
// Purpose:  Developing the search functionalities of PetrolPump Laser
/*****************************************************/

PetrolPumpsService.prototype.searchLaserPetrolPump = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-petrolpump-laser-list',
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
		// Function name : savePetrolPumpPay
		// Functionality: Save PetrolPump Pay
		// Author : Debamala Dey                                 
		// Created Date : 05/09/2018                                        
		// Purpose:  Developing the functionalities of save petrolPump payment
/*****************************************************/
PetrolPumpsService.prototype.savePetrolPumpPay = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/add-petrolpump-payment',
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
		// Function name : getPetrolPumpDetail
		// Functionality: get particular petrol pump details
		// Author : Sanchari Ghosh                               
		// Created Date : 04/01/2019                                        
		// Purpose:  Developing the functionalities of getting particular petrol pump details
/*****************************************************/
PetrolPumpsService.prototype.getPetrolPumpDetail = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-petrol-pump-details',
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
		// Function name : getDieselReport
		// Functionality: get diesel report
		// Author : Sanchari Ghosh                               
		// Created Date : 04/04/2019                                        
		// Purpose:  Developing the functionalities of getting diesel report
/*****************************************************/
PetrolPumpsService.prototype.getDieselReport = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-diesel-report',
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
		// Function name : activePetrolPumpList
		// Functionality: getting active petrol pump list
		// Author : Sanchari Ghosh                               
		// Created Date : 04/04/2019                                        
		// Purpose:  Developing the functionalities of getting active petrol pump list
/*****************************************************/
PetrolPumpsService.prototype.activePetrolPumpList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-petrolpump-list',
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




