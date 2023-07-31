'use strict'
/*****************************************************/
	// Trips Service             
	// Service name : TripsService
	// Functionality: trip list , trip add, trip edit, trip delete, upload pod for trip, trip close, search trip, add trip payment, edit request for ADV & DSL amount
	// Author : Sanchari Ghosh                               
	// Created Date : 31/08/2018                                        
	// Purpose:  Developing the functionalities of trips  
/*****************************************************/

function TripsService($http, $q, tripsAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.tripsAPIEndpoint = tripsAPIEndpoint;

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
		// Function name : tripList
		// Functionality: Trip List
		// Author : Sanchari Ghosh                               
		// Created Date : 31/08/2018                                        
		// Purpose:  Developing the listing functionalities of trips
/*****************************************************/

TripsService.prototype.tripList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-trip-list',
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
		// Function name : tripEdit
		// Functionality: Trip Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 05/09/2018                                        
		// Purpose:  Developing the functionalities of view edit trip page
/*****************************************************/

TripsService.prototype.tripEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-trip',
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
		// Function name : getTripDetail
		// Functionality: get the details of Trip
		// Author : Sanchari Ghosh                               
		// Created Date : 31/08/2018                                        
		// Purpose:  Developing the functionalities of getting the details of Trip
/*****************************************************/
TripsService.prototype.getTripDetail = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-trip-details',
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
		// Function name : saveTrip
		// Functionality: Save Trip
		// Author : Sanchari Ghosh                               
		// Created Date : 04/09/2018                                        
		// Purpose:  Developing the functionalities of save trips
/*****************************************************/
TripsService.prototype.saveTrip = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-trip',
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
		// Function name : getTripPlantList
		// Functionality: Get Plant List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the functionalities of getting plant lists
/*****************************************************/
TripsService.prototype.getTripPlantList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-trip-plantList',
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
		// Function name : getTripPartyList
		// Functionality: Get trip Party List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of parties
/*****************************************************/

TripsService.prototype.getTripPartyList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-trip-partyList',
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
		// Function name : getTripPetrolPumpList
		// Functionality: Get trip Petrol Pump List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of Petrol Pumps
/*****************************************************/

TripsService.prototype.getTripPetrolPumpList = function(data) {
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




/*****************************************************/
		// Function name : getTripTruckList
		// Functionality: Get truck List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/09/2018                                        
		// Purpose:  Developing the listing functionalities of Trucks
/*****************************************************/

// TripsService.prototype.getTripTruckList = function(data) {
// 	try {
		
// 	    return this.http({
// 	        method: 'POST',
// 	        url: baseUrl + '/view-truck-list',
// 	        data: data,
// 	        headers: {'Content-Type': 'application/x-www-form-urlencoded'}
// 	    })
// 	    .then(function successCallback(response) {	
// 		    return response;
// 		  },function errorCallback(response) {
// 		    return response;
// 		  });

// 	} catch (error) {
// 		console.warn('error occured' + error.toString());
// 	}
// };





/*****************************************************/
		// Function name : getEditTripTruckList
		// Functionality: Get truck List for edit page
		// Author : Sanchari Ghosh                               
		// Created Date : 05/09/2018                                        
		// Purpose:  Developing the listing functionalities of Trucks for edit page
/*****************************************************/

TripsService.prototype.getEditTripTruckList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-edit-trip-truck-list',
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
		// Function name : getTruckOwner
		// Functionality: Get truck owner
		// Author : Sanchari Ghosh                               
		// Created Date : 04/09/2018                                        
		// Purpose:  Developing the functionalities of getting Truck Owner
/*****************************************************/
TripsService.prototype.getTruckOwner = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-truckowner',
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
		// Function name : savePOD
		// Functionality: Save POD
		// Author : Sanchari Ghosh                               
		// Created Date : 04/09/2018                                        
		// Purpose:  Developing the functionalities of save pod
/*****************************************************/
TripsService.prototype.savePOD = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-pod-file',
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
		// Function name : ADVeditRequest
		// Functionality: Advance Amount edit request
		// Author : Sanchari Ghosh                               
		// Created Date : 04/09/2018                                        
		// Purpose:  Developing the functionalities of Advance Amount edit request
/*****************************************************/
TripsService.prototype.ADVeditRequest = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/ADV-edit-request',
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
		// Function name : DSLeditRequest
		// Functionality: Diesel Amount edit request
		// Author : Sanchari Ghosh                               
		// Created Date : 04/09/2018                                        
		// Purpose:  Developing the functionalities of Diesel Amount edit request
/*****************************************************/
TripsService.prototype.DSLeditRequest = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/DSL-edit-request',
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
		// Function name : searchTrip
		// Functionality: Search Trip
		// Author : Sanchari Ghosh                               
		// Created Date : 10/09/2018                                        
		// Purpose:  Developing the functionalities of searching trips
/*****************************************************/
TripsService.prototype.searchTrip = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/search-trip',
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
		// Function name : saveTripPayment
		// Functionality: Save Trip Payemnts (Freight, Toll, Unloading, Tare)
		// Author : Sanchari Ghosh                               
		// Created Date : 11/09/2018                                        
		// Purpose:  Developing the functionality of saving Trip Payemnts
/*****************************************************/
TripsService.prototype.saveTripPayment = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-trip-payment',
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
		// Function name : closeTrip
		// Functionality: Close Trip
		// Author : Sanchari Ghosh                               
		// Created Date : 12/09/2018                                        
		// Purpose:  Developing the functionality of closing Trip
/*****************************************************/
TripsService.prototype.closeTrip = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/close-trip',
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
		// Function name : getPlantTripList
		// Functionality: Get Plant wise Trip List
		// Author : Sanchari Ghosh                               
		// Created Date : 26/09/2018                                        
		// Purpose:  Developing the functionality of getting Plant wise Trip List
/*****************************************************/
TripsService.prototype.getPlantTripList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-plant-trip-list',
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
		// Function name : getTripCategoryList
		// Functionality: Get Category List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/10/2018                                        
		// Purpose:  Developing the functionalities of getting Categories
/*****************************************************/

TripsService.prototype.getTripCategoryList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-category-list',
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
		// Function name : viewTripSubcatList
		// Functionality: Get Subcategory List with respect to Category List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/10/2018                                        
		// Purpose:  Developing the functionalities of getting Subcategories
/*****************************************************/

TripsService.prototype.viewTripSubcatList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-subcategory-list',
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
		// Function name : getSelectedSubCatDetails
		// Functionality: Get selected Subcategory details
		// Author : Sanchari Ghosh                               
		// Created Date : 08/10/2018                                        
		// Purpose:  Developing the functionalities of getting selected Subcategory details
/*****************************************************/

TripsService.prototype.getSelectedSubCatDetails = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-selected-subcategory-details',
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
		// Function name : savePlantEditRequest
		// Functionality: save Advance Amount data for a trip
		// Author : Sanchari Ghosh                               
		// Created Date : 10/10/2018                                        
		// Purpose:  Developing the functionalities of saving Advance Amount data for a trip
/*****************************************************/

TripsService.prototype.savePlantEditRequest = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-plant-edit-request',
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
		// Function name : savePetrolPumpEditRequest
		// Functionality: save Diesel Amount data for a trip
		// Author : Sanchari Ghosh                               
		// Created Date : 10/10/2018                                        
		// Purpose:  Developing the functionalities of saving Diesel Amount data for a trip
/*****************************************************/

TripsService.prototype.savePetrolPumpEditRequest = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-petrolpump-edit-request',
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
		// Function name : getGPSTripList
		// Functionality: get the list of Trips for GPS tracking
		// Author : Sanchari Ghosh                               
		// Created Date : 10/10/2018                                        
		// Purpose:  Developing the functionalities of getting the list of Trips for GPS tracking
/*****************************************************/
TripsService.prototype.getGPSTripList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-gps-trip-list',
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
		// Function name : saveTripCategory
		// Functionality: Save Category
		// Author : Sanchari Ghosh                               
		// Created Date : 23/01/2018                                        
		// Purpose:  Developing the functionalities of save categories
/*****************************************************/
TripsService.prototype.saveTripCategory = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-category',
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
		// Function name : saveTripPlant
		// Functionality: Save Plant
		// Author : Sanchari Ghosh                               
		// Created Date : 23/01/2018                                        
		// Purpose:  Developing the functionalities of save plants
/*****************************************************/
TripsService.prototype.saveTripPlant = function(data) {
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
		// Function name : saveTripParty
		// Functionality: Save Party
		// Author : Sanchari Ghosh                               
		// Created Date : 24/01/2019                                        
		// Purpose:  Developing the functionalities of save parties
/*****************************************************/
TripsService.prototype.saveTripParty = function(data) {
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
		// Function name : saveTripPetrolPump
		// Functionality: Save PetrolPump
		// Author : Sanchari Ghosh                               
		// Created Date : 24/01/2019                                        
		// Purpose:  Developing the functionalities of save petrolPumps
/*****************************************************/
TripsService.prototype.saveTripPetrolPump = function(data) {
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
		// Function name : saveTripSubCategory
		// Functionality: Save Subcategory
		// Author : Sanchari Ghosh                               
		// Created Date : 24/01/2019                                       
		// Purpose:  Developing the functionalities of save subcategories
/*****************************************************/
TripsService.prototype.saveTripSubCategory = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-subcategory',
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
		// Function name : getTripVendorList
		// Functionality: Get Vendor List
		// Author : Sanchari Ghosh                               
		// Created Date : 24/01/2019                                       
		// Purpose:  Developing the functionalities of getting vendor list for trip
/*****************************************************/
TripsService.prototype.getTripVendorList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-trip-vendor-list',
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
		// Function name : saveTripVendor
		// Functionality: Save Vendor
		// Author : Sanchari Ghosh                               
		// Created Date : 24/1/2019                                        
		// Purpose:  Developing the functionalities of save vendors
/*****************************************************/
TripsService.prototype.saveTripVendor = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-vendor',
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
		// Function name : viewTripTruckList
		// Functionality: Get truck List with respect to company
		// Author : Sanchari Ghosh                               
		// Created Date : 25/01/2019                                        
		// Purpose:  Developing the listing functionalities of Trucks with respect to company
/*****************************************************/

TripsService.prototype.viewTripTruckList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-trip-truck-list',
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
		// Function name : saveTripTruck
		// Functionality: Save Trip Truck
		// Author : Sanchari Ghosh                               
		// Created Date : 25/01/2019                                        
		// Purpose:  Developing the functionalities of save trucks
/*****************************************************/
TripsService.prototype.saveTripTruck = function(data) {
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
		// Function name : getAddressZoneDetail
		// Functionality: getting address zone details
		// Author : Sanchari Ghosh                               
		// Created Date : 13/02/2019                                        
		// Purpose:  Developing the functionalities of getting address zone details
/*****************************************************/
TripsService.prototype.getAddressZoneDetail = function(data) {
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




/*****************************************************/
		// Function name : getAddressWisePartyDetails
		// Functionality: getting address wise party details
		// Author : Sanchari Ghosh                               
		// Created Date : 14/02/2019                                        
		// Purpose:  Developing the functionalities of getting address wise party details
/*****************************************************/
TripsService.prototype.getAddressWisePartyDetails = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-addresswise-party-listing',
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
		// Function name : viewTripPartyAddressZone
		// Functionality: getting address of selected party
		// Author : Sanchari Ghosh                               
		// Created Date : 14/02/2019                                        
		// Purpose:  Developing the functionalities of getting address of selected party
/*****************************************************/
TripsService.prototype.viewTripPartyAddressZone = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-trip-party-address',
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
		// Function name : saveTripPOD
		// Functionality: saving pod status from modal
		// Author : Sanchari Ghosh                               
		// Created Date : 13/03/2019                                        
		// Purpose:  Developing the functionalities of saving pod status from modal
/*****************************************************/
TripsService.prototype.saveTripPOD = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-trip-pod',
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
		// Function name : tripWisePOD
		// Functionality: getting trip wise pod
		// Author : Sanchari Ghosh                               
		// Created Date : 13/03/2019                                        
		// Purpose:  Developing the functionalities of getting trip wise pod
/*****************************************************/
TripsService.prototype.tripWisePOD = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/trip-wise-pod',
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
		// Function name : tripLatestPOD
		// Functionality: getting latest pod of a trip
		// Author : Sanchari Ghosh                               
		// Created Date : 13/03/2019                                        
		// Purpose:  Developing the functionalities of getting latest pod of a trip
/*****************************************************/
TripsService.prototype.tripLatestPOD = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/trip-latest-pod',
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
		// Function name : getTripReport
		// Functionality: getting trip report
		// Author : Sanchari Ghosh                               
		// Created Date : 18/03/2019                                        
		// Purpose:  Developing the functionalities of getting trip report
/*****************************************************/
TripsService.prototype.getTripReport = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-trip-report',
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
		// Function name : getPaymentReport
		// Functionality: getting payment report
		// Author : Sanchari Ghosh                               
		// Created Date : 03/04/2019                                        
		// Purpose:  Developing the functionalities of getting payment report
/*****************************************************/
TripsService.prototype.getPaymentReport = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-payment-report',
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
		// Function name : saveTripAddress
		// Functionality: save Trip Address
		// Author : Sanchari Ghosh                               
		// Created Date : 24/04/2019                                        
		// Purpose:  Developing the functionalities of saving address zone from trip
/*****************************************************/
TripsService.prototype.saveTripAddress = function(data) {
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
		// Function name : getBankList
		// Functionality: getting active bank list
		// Author : Sanchari Ghosh                               
		// Created Date : 25/04/2019                                        
		// Purpose:  Developing the functionalities of getting active bank list
/*****************************************************/
TripsService.prototype.getBankList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-active-bank-list',
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
		// Function name : getBankifscDetails
		// Functionality: getting ifsc code with respect to bank
		// Author : Sanchari Ghosh                               
		// Created Date : 25/04/2019                                        
		// Purpose:  Developing the functionalities of getting ifsc code with respect to bank
/*****************************************************/
TripsService.prototype.getBankifscDetails = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-ifsc-list',
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
		// Function name : deletePOD
		// Functionality: deleting POD
		// Author : Sanchari Ghosh                               
		// Created Date : 14/05/2019                                        
		// Purpose:  Developing the functionalities of deleting POD
/*****************************************************/
TripsService.prototype.deletePOD = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-POD',
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
		// Function name : getPlantWiseActiveTruckList
		// Functionality: get plant wise active truck list
		// Author : Sanchari Ghosh                               
		// Created Date : 15/05/2019                                        
		// Purpose:  Developing the functionalities of getting plant wise active truck list
/*****************************************************/
TripsService.prototype.getPlantWiseActiveTruckList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/plant-wise-truck-list',
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
		// Function name : getTruckWiseTripList
		// Functionality: get truck wise trip list
		// Author : Sanchari Ghosh                               
		// Created Date : 15/05/2019                                        
		// Purpose:  Developing the functionalities of getting truck wise trip list
/*****************************************************/
TripsService.prototype.getTruckWiseTripList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/truck-wise-trip-list',
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
		// Function name : deleteTrip
		// Functionality: delete trip list
		// Author : Sanchari Ghosh                               
		// Created Date : 15/05/2019                                        
		// Purpose:  Developing the functionalities of deleting trip list
/*****************************************************/
TripsService.prototype.deleteTrip = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/trip-delete',
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
		// Function name : domPDF
		// Functionality: generate pdf using dom pdf
		// Author : Sanchari Ghosh                               
		// Created Date : 03/05/2019                                        
		// Purpose:  Developing the functionalities of generating pdf using dom pdf
/*****************************************************/
TripsService.prototype.domPDF = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-dom-pdf',
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
		// Function name : tcpdf
		// Functionality: generate pdf using tcpdf
		// Author : Sanchari Ghosh                               
		// Created Date : 03/06/2019                                        
		// Purpose:  Developing the functionalities of generating pdf using tcpdf
/*****************************************************/
TripsService.prototype.tcpdf = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-tcpdf',
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
		// Function name : generateBill
		// Functionality: save trip's bill details in database
		// Author : Sanchari Ghosh                               
		// Created Date : 03/06/2019                                        
		// Purpose:  Developing the functionalities of saving trip's bill details in database
/*****************************************************/
TripsService.prototype.generateBill = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/generate-bill',
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
		// Function name : extraCashList
		// Functionality: Extra Cash List
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                         
		// Purpose:  Developing the listing functionalities of Extra Cash
/*****************************************************/

TripsService.prototype.extraCashList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-extra-cash-list',
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
		// Function name : extraCashEdit
		// Functionality: Extra Cash Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                         
		// Purpose:  Developing the functionalities of view edit extra cash page
/*****************************************************/

TripsService.prototype.extraCashEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-extra-cash',
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
		// Function name : saveExtraCash
		// Functionality: Save Extra Cash
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                        
		// Purpose:  Developing the functionalities of save extra cash
/*****************************************************/
TripsService.prototype.saveExtraCash = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-extra-cash',
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
		// Function name : deleteExtraCash
		// Functionality: Delete Extra Cash
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                         
		// Purpose:  Developing the functionalities of delete extra cash
/*****************************************************/
TripsService.prototype.deleteExtraCash = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-extra-cash',
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
		// Function name : extraDieselList
		// Functionality: Extra Diesel List
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                         
		// Purpose:  Developing the listing functionalities of Extra Diesel
/*****************************************************/

TripsService.prototype.extraDieselList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-extra-diesel-list',
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
		// Function name : extraDieselEdit
		// Functionality: Extra Diesel Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                         
		// Purpose:  Developing the functionalities of view edit extra diesel page
/*****************************************************/

TripsService.prototype.extraDieselEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-extra-diesel',
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
		// Function name : saveExtraDiesel
		// Functionality: Save Extra Diesel
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                        
		// Purpose:  Developing the functionalities of save extra diesel
/*****************************************************/
TripsService.prototype.saveExtraDiesel = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-extra-diesel',
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
		// Function name : deleteExtraDiesel
		// Functionality: Delete Extra Diesel
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                         
		// Purpose:  Developing the functionalities of delete extra diesel
/*****************************************************/
TripsService.prototype.deleteExtraDiesel = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-extra-diesel',
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
		// Function name : viewCashTruckList
		// Functionality: view truck list
		// Author : Sanchari Ghosh                               
		// Created Date : 02/07/2019                                         
		// Purpose:  Developing the functionalities of view truck list with respect to vendor
/*****************************************************/
TripsService.prototype.viewCashTruckList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-cash-truck-list',
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
		// Function name : getEditTruckList
		// Functionality: Get truck List for edit page
		// Author : Sanchari Ghosh                               
		// Created Date : 03/07/2019                                        
		// Purpose:  Developing the listing functionalities of Trucks for edit page
/*****************************************************/

TripsService.prototype.getEditTruckList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/view-edit-truck-list',
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
		// Function name : getLedgerReport
		// Functionality: Get ledger reports
		// Author : Sanchari Ghosh                               
		// Created Date : 04/07/2019                                        
		// Purpose:  Developing the listing functionalities of ledger reports
/*****************************************************/
TripsService.prototype.getLedgerReport = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-ledger-report',
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
		// Function name : getBillDetails
		// Functionality: Get bill details
		// Author : Sanchari Ghosh                               
		// Created Date : 09/09/2019                                        
		// Purpose:  Developing the functionalities of getting bill details
/*****************************************************/
TripsService.prototype.getBillDetails = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-bill-details',
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



















