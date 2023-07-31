'use strict';
define(
	[ 
        'angular',
        'angularModules/profile/controllers/ProfileController',	  	  
        'angularModules/profile/services/ProfileService','ngSanitize',
        'bower_components/crop/slim/slim.angular',
        //'bower_components/ngImgCrop/compile/unminified/ng-img-crop',   
 	], function() {
		var profileModule = angular.module('profileApp', ['ngSanitize','slim']);
		//===========================================================
		profileModule.value('profileAPIEndpoint', {
			base : baseUrl			
					
        });


        //===========================================================
	profileModule.controller('profileController', ProfileController);
        profileModule.service('ProfileService', ProfileService);
        //===========================================================
	});
