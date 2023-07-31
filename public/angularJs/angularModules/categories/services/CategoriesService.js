'use strict'
/*****************************************************/
	// Categories Service             
	// Service name : CategoriesService
	// Functionality: category list , category add, category edit, category delete
	// Author : Sanchari Ghosh                               
	// Created Date : 07/08/2018                                        
	// Purpose:  Developing the functionalities of categories  
/*****************************************************/

function CategoriesService($http, $q, categoriesAPIEndpoint) {
	this.http = $http;
	this.q = $q;
	this.categoriesAPIEndpoint = categoriesAPIEndpoint;

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
		// Function name : categoryList
		// Functionality: Category List
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the listing functionalities of categories
/*****************************************************/

CategoriesService.prototype.categoryList = function(data) {
	try {
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-category-list',
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
		// Function name : categoryEdit
		// Functionality: Category Edit
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of view edit category page
/*****************************************************/

CategoriesService.prototype.categoryEdit = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/get-edit-category',
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
		// Function name : saveCategory
		// Functionality: Save Category
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of save categories
/*****************************************************/
CategoriesService.prototype.saveCategory = function(data) {
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
		// Function name : deleteCategory
		// Functionality: Delete Category
		// Author : Sanchari Ghosh                               
		// Created Date : 07/08/2018                                        
		// Purpose:  Developing the functionalities of delete category
/*****************************************************/
CategoriesService.prototype.deleteCategory = function(data) {
	try {
		
	    return this.http({
	        method: 'POST',
	        url: baseUrl + '/delete-category',
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


