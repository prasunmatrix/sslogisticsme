'use strict'
/*****************************************************/
	// Vendors Service             
	// Service name : VendorsService
	// Functionality: vendor list , vendor add, vendor edit, vendor delete
	// Author : Sanchari Ghosh                               
	// Created Date : 24/12/2018                                        
	// Purpose:  Developing the functionalities of vendors  
/*****************************************************/

function VendorsService($http, $q, vendorsAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.vendorsAPIEndpoint = vendorsAPIEndpoint;

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
		// Function name : vendorList
		// Functionality: Vendor List
		// Author : Sanchari Ghosh                               
		// Created Date : 24/12/2018                                        
		// Purpose:  Developing the listing functionalities of vendors
/*****************************************************/

VendorsService.prototype.vendorList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-vendor-list',
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
		// Function name : getVendorDetail
		// Functionality: get the details of Vendor
		// Author : Sanchari Ghosh                               
		// Created Date : 26/12/2018                                        
		// Purpose:  Developing the functionalities of getting the details of Vendor
/*****************************************************/
VendorsService.prototype.getVendorDetail = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-vendor-details',
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
		// Function name : vendorEdit
		// Functionality: Vendor Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 24/12/2018                                        
		// Purpose:  Developing the functionalities of view edit vendor page
/*****************************************************/

VendorsService.prototype.vendorEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-vendor',
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
		// Function name : saveVendor
		// Functionality: Save Vendor
		// Author : Sanchari Ghosh                               
		// Created Date : 24/12/2018                                        
		// Purpose:  Developing the functionalities of save vendors
/*****************************************************/
VendorsService.prototype.saveVendor = function(data) {
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
		// Function name : deleteVendor
		// Functionality: Delete Vendor
		// Author : Sanchari Ghosh                               
		// Created Date : 24/12/2018                                        
		// Purpose:  Developing the functionalities of delete vendor
/*****************************************************/
VendorsService.prototype.deleteVendor = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-vendor',
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
		// Function name : getCustomerReport
		// Functionality: getting customer report
		// Author : Sanchari Ghosh                               
		// Created Date : 01/04/2019                                        
		// Purpose:  Developing the functionalities of getting customer report
/*****************************************************/
VendorsService.prototype.getCustomerReport = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-vendor-report',
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
		// Function name : activeVendorList
		// Functionality: getting active vendor list
		// Author : Sanchari Ghosh                               
		// Created Date : 02/04/2019                                        
		// Purpose:  Developing the functionalities of getting active vendor list
/*****************************************************/
VendorsService.prototype.activeVendorList = function(data) {
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
		// Function name : getVendorReport
		// Functionality: getting vendor report
		// Author : Sanchari Ghosh                               
		// Created Date : 02/04/2019                                        
		// Purpose:  Developing the functionalities of getting vendor report
/*****************************************************/
VendorsService.prototype.getVendorReport = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-plant-trip-report',
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
		// Created Date : 02/04/2019                                        
		// Purpose:  Developing the functionalities of getting active plant list
/*****************************************************/
VendorsService.prototype.activePlantList = function(data) {
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


/*****************************************************/
		// Function name : getBankList
		// Functionality: getting active bank list
		// Author : Sanchari Ghosh                               
		// Created Date : 25/04/2019                                        
		// Purpose:  Developing the functionalities of getting active bank list
/*****************************************************/
VendorsService.prototype.getBankList = function(data) {
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
VendorsService.prototype.getBankifscDetails = function(data) {
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
		// Function name : saveVendorPay
		// Functionality: Save Vendor Pay
		// Author : Sanchari Ghosh                               
		// Created Date : 03/07/2019                                        
		// Purpose:  Developing the functionalities of save vendor pay
/*****************************************************/
VendorsService.prototype.saveVendorPay = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-vendor-payment',
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
		// Function name : getVendorList
		// Functionality: Get Vendor List
		// Author : Sanchari Ghosh                               
		// Created Date : 03/07/2019                                       
		// Purpose:  Developing the functionalities of getting vendor list
/*****************************************************/
VendorsService.prototype.getVendorList = function(data) {
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












