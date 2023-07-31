'use strict'
/*****************************************************/
	// Approval Manage Service             
	// Service name : ApprovalManageService
	// Functionality: misclleneous list
    // Author : Debamala Dey                                 
    // Created Date : 10/09/2018                                       
	// Purpose:  Developing the functionalities of Approval Manage  
/*****************************************************/

function ApprovalManageService($http, $q, approvalAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.approvalAPIEndpoint = approvalAPIEndpoint;

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
		// Function name : allMisclleneousList
		// Functionality: misclleneous List
	    // Author : Debamala Dey                                 
	    // Created Date : 10/09/2018                                       
		// Purpose:  Developing the listing functionalities of misclleneous
/*****************************************************/

ApprovalManageService.prototype.allMisclleneousList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-misclleneous-list',
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
		// Function name : approveMisclleneousList
		// Functionality: approve misclleneous List
	    // Author : Debamala Dey                                 
	    // Created Date : 10/09/2018                                       
		// Purpose:  approving misclleneous
/*****************************************************/

ApprovalManageService.prototype.approveMisclleneousList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/approve-misclleneous',
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
		// Function name : allAdvanceList
		// Functionality: advance List
	    // Author : Debamala Dey                                 
	    // Created Date : 10/09/2018                                       
		// Purpose:  Developing the listing functionalities of advance
/*****************************************************/

ApprovalManageService.prototype.allAdvanceList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-adv-list',
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
		// Function name : approveDisapproveAdv
		// Functionality: approve/disapprove List
	    // Author : Debamala Dey                                 
	    // Created Date : 10/09/2018                                       
		// Purpose:  Developing the approve/disapprove functionalities of advance
/*****************************************************/

ApprovalManageService.prototype.approveDisapproveAdv = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/approve-disapprove-adv',
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
		// Function name : allDieselList
		// Functionality: Diesel List
	    // Author : Debamala Dey                                 
	    // Created Date : 10/09/2018                                       
		// Purpose:  Developing the listing functionalities of Diesel
/*****************************************************/

ApprovalManageService.prototype.allDieselList = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-dsl-list',
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
		// Function name : approveDisapproveDiesel
		// Functionality: approve/disapprove List
	    // Author : Debamala Dey                                 
	    // Created Date : 10/09/2018                                       
		// Purpose:  Developing the approve/disapprove functionalities of Diesel
/*****************************************************/

ApprovalManageService.prototype.approveDisapproveDiesel = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/approve-disapprove-dsl',
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
		// Function name : approveDisapproveMisc
		// Functionality: approve/disapprove misclleneous-view
	    // Author : Sanchari Ghosh                                 
	    // Created Date : 15/03/2018                                       
		// Purpose:  Developing the approve/disapprove functionalities of misclleneous
/*****************************************************/

ApprovalManageService.prototype.approveDisapproveMisc = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/approve-disapprove-misclleneous',
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


