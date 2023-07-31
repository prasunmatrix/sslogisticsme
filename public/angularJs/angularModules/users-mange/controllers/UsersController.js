'use strict';


/*****************************************************/
	// Users Controller             
	// Function name : UsersController
	// Functionality: login, forgot password
	// Author : Dilip Kumar Shaw                                 
	// Created Date : 26/07/2018                                        
	// Purpose:  Developing the functionality of login, forgot password etc  
/*****************************************************/

function UsersController($rootScope, $scope, $http, $window, $timeout, $q, $location, UsersService) {
  $scope.title2 = 'Login Controller Testing'; 

  $scope.password 	=	'';
  $scope.username 	=	'';

	
    /*****************************************************/
		// Function name : adminLogin
		// Functionality: login
		// Author : Sanchari Ghosh                               
		// Created Date : 27/07/2018                                        
		// Purpose:  Developing the functionality of login with the help of UsersService
	/*****************************************************/
     $scope.adminLogin = function(){

		$scope.msg = '';
				
		var loginData = "username=" + $scope.username + "&password=" + $scope.password;		

		UsersService.makeAsyncCall(UsersService.loginVerify(loginData))
		.then(function(response){
			if(response.data.success == "true")
			{
				var userData = "id=" + response.data.userDetails[0].id + "&email=" + response.data.userDetails[0].username + "&profilePicture=" + response.data.userDetails[0].profile_picture + "&phoneNumber=" + response.data.userDetails[0].phone_number;	

				var userDataForLocal = {
					user_id 			: response.data.userDetails[0].id,
					email 				: response.data.userDetails[0].username,
					profilePicture 		: response.data.userDetails[0].profile_picture,
					phoneNumber 		: response.data.userDetails[0].phone_number,
					password 			: response.data.userDetails[0].password,
				}		
						
				localStorage.setItem("userDataForLocal", JSON.stringify(userDataForLocal));	
				localStorage.setItem("lastLoginIP",response.data.userDetails[0].last_login_ip);	
				localStorage.setItem("lastLoginDateTime",response.data.userDetails[0].last_login_datetime);	
				$window.location.href = baseUrl + '/dashboard';
			}else{	

				var msg = 'Invalid username and password'; 
				$rootScope.danger = msg;				
			}
      	},function(reason){}).finally(function(data){

        });
	}
}