'use strict';


/*****************************************************/
	//  Controller             
	// Function name : ProfileController
	// Functionality: profile management
	// Author : Sanchari Ghosh                                  
	// Created Date : 30/07/2018                                        
	// Purpose:  Developing the functionality of profile management  
/*****************************************************/

function ProfileController($rootScope, $scope, $http, $window, $timeout, $q, $location, ProfileService,fileUploadService) {
  $scope.title3 = 'Profile Controller Testing'; 


  	$scope.imageName = 'test.jpeg';
  	$scope.file = '';
  	$scope.name = '';

  	

  	/*****************************************************/
		// Function name : getAdminProfileData
		// Functionality: get profile data
		// Author : Sanchari Ghosh                               
		// Created Date : 01/08/2018                                        
		// Purpose:  Developing the functionality of get profile data with the help of Service
	/*****************************************************/
    $scope.getAdminProfileData = function(){ 

		ProfileService.makeAsyncCall(ProfileService.getProfileData())
		.then(function(response){ 
			if(response.data.success == "true") {
				$scope.fullName 			= response.data.userDetails.full_name;
				$scope.phoneNumber 			= response.data.userDetails.phone_number;
				if (response.data.userDetails.profile_picture == null) {
					$scope.profilePictureName   = '';
					$scope.profilePicture  		= baseUrl + '/uploads/user_profile_picture/common_customer_image.jpg';
				} else {
					$scope.profilePictureName   = response.data.userDetails.profile_picture;
					$scope.profilePicture  		= baseUrl + '/uploads/user_profile_picture/' + response.data.userDetails.profile_picture;
				}

				if (localStorage.getItem("lastLoginIP") === 'null') {
					$scope.lastLoginIP = '';
				} else {
					$scope.lastLoginIP = localStorage.getItem("lastLoginIP");
				}

				if (localStorage.getItem("lastLoginDateTime") === 'null') {
					$scope.lastLoginDateTime = '';
				} else {
					$scope.lastLoginDateTime = localStorage.getItem("lastLoginDateTime");
				}
			} else {	

						
			}
      	},function(reason){}).finally(function(data){

        });
	}





	/*****************************************************/
		// Function name : adminProfile
		// Functionality: save profile data
		// Author : Sanchari Ghosh                               
		// Created Date : 31/07/2018                                        
		// Purpose:  Developing the functionality of saving profile data with the help of Service
	/*****************************************************/
     $scope.adminProfile = function(){
		$scope.msg   	= '';
		var fileName 	= '';
		var success  	= '';
		var imageError 	= 0;

		var allPromises = [];

	    /*uploading profile image*/
	    if ($scope.myFile !== undefined) {
	      var file = $scope.myFile;	
          allPromises.push(new Promise((resolve, reject)=>{
            fileUploadService.uploadFileToUrl(file,  baseUrl + '/upload-profile-image').then((data)=>{
              var response = data;
              fileName = response.data.imageName;
              success  = response.data.success;
              resolve(fileName);
            })
          }))
	    } else if ($scope.profilePictureName !== ''){ /*if picture is there already and no new picture is uploaded*/
	    	fileName = $scope.profilePictureName;
            success  = 'true';
	    } 

		Promise.all(allPromises).then((resolveData)=>{

			if (success == 'false') {
	      		imageError = 1
	      	}
	      	
			if (success == '') {
				fileName  = 'common_customer_image.jpg';
			}
			var profileData = "full_name=" + $scope.fullName +"&phoneNumber=" + $scope.phoneNumber + "&profile_picture=" + fileName + "&imageError=" + imageError;		
			ProfileService.makeAsyncCall(ProfileService.saveProfileData(profileData))
			.then(function(response){
				if(response.data.success == "true")
				{
					var userDataForLocal = {
						user_id 		: response.data.userDetails.id,
						email 			: response.data.userDetails.username,
						fullName 		: response.data.userDetails.full_name,
						profilePicture 	: fileName,
						phoneNumber 	: response.data.userDetails.phone_number,
						password 		: response.data.userDetails.password,
						user_role 		: response.data.userDetails.user_role_id,
					}		
					localStorage.removeItem('userDataForLocal');		
					localStorage.setItem("userDataForLocal", JSON.stringify(userDataForLocal));		
					$window.location.href = baseUrl + '/view-profile';
				} else {	
					var msg = 'Please upload proper Image File';
        			$rootScope.danger = msg;  
        			$rootScope.msgShow(); 
				}
	      	},function(reason){}).finally(function(data){

	        });
	      	
        })
	}

	// $scope.slim = {

 //        // called when slim has initialized
 //        init: function (data, slim) {
 //            // slim instance reference
 //            console.log(slim);

 //            // current slim data object and slim reference
 //            console.log(data);
 //        },

 //        // called when upload button is pressed or automatically if push is enabled
 //        service: function (formdata, progress, success, failure, slim) {
 //            // form data to post to server
 //            // set data-service-format to "file" to receive an array of files
 //            console.log(formdata);

 //            // call these methods to handle upload state
 //            $scope.file = slim.data.input.file;
 //            $scope.name = slim.data.input.name;
 //            // reference to Slim instance
 //            console.log(slim);
 //        }
 //    }

}