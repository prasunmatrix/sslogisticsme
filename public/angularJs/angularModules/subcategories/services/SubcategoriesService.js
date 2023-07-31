'use strict'
/*****************************************************/
	// Subcategories Service             
	// Service name : SubcategoriesService
	// Functionality: subcategory list , subcategory add, subcategory edit, subcategory delete, import subcategory
	// Author : Sanchari Ghosh                               
	// Created Date : 07/08/2018                                        
	// Purpose:  Developing the functionalities of subcategories  
/*****************************************************/

function SubcategoriesService($http, $q, subcategoriesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.subcategoriesAPIEndpoint = subcategoriesAPIEndpoint;

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
		// Function name : getSubcategoryList
		// Functionality: Get Subcategory List
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of getting subcategory lists
/*****************************************************/

SubcategoriesService.prototype.getCategoryList = function(data) {
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
		// Function name : subcategoryList
		// Functionality: Subcategory List
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the listing functionalities of subcategories
/*****************************************************/

SubcategoriesService.prototype.subcategoryList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-subcategory-list',
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
		// Function name : subcategoryEdit
		// Functionality: Subcategory Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of view edit subcategory page
/*****************************************************/

SubcategoriesService.prototype.subcategoryEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-subcategory',
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
		// Function name : saveSubcategory
		// Functionality: Save Subcategory
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of save subcategories
/*****************************************************/
SubcategoriesService.prototype.saveSubcategory = function(data) {
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
		// Function name : deleteSubcategory
		// Functionality: Delete Subcategory 
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of delete subcategory
/*****************************************************/
SubcategoriesService.prototype.deleteSubcategory = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-subcategory',
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
		// Function name : saveCSVSubcategory
		// Functionality: save subcategories after importing csv
		// Author : Sanchari Ghosh                               
		// Created Date : 27/08/2018                                        
		// Purpose:  Developing the functionalities of save subcategories after importing csv
/*****************************************************/
SubcategoriesService.prototype.saveCSVSubcategory = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/save-csv-subcategory',
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



