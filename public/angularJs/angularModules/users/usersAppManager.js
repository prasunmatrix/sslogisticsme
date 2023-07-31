'use strict'
define(
	[ 
        'angular',
        'angularModules/users/controllers/UsersController',	  	  
        'angularModules/users/services/UsersService'  ,'ngSanitize'    
 	], function() {
		var homeModule = angular.module('userApp', ['ngSanitize']);
		//===========================================================
		homeModule.value('usersAPIEndpoint', {
			base : baseUrl			
					
        });
        //===========================================================
		homeModule.controller('usersController', UsersController);
        homeModule.service('UsersService', UsersService);
        //===========================================================
	});
