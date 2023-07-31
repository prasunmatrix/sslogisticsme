'use strict';

/*****************************************************/
  // Change Password Controller             
  // Function name : ChangePasswordController
  // Functionality: change password
  // Author : Sanchari Ghosh                                 
  // Created Date : 31/07/2018                                        
  // Purpose:  Developing the functionality of change password
/*****************************************************/

function ChangePasswordController($rootScope, $scope, $http, $window, $q, $location, $timeout, ChangePasswordService) {
  $scope.titleChange = '<h1>Change Password</h1>';
  $rootScope.successMesg = '';


   /*****************************************************/
    // Function name : changePassword
    // Functionality: Change Password
    // Author : Sanchari Ghosh                               
    // Created Date : 31/07/2018                                        
    // Purpose:  Developing the functionality of of change password with the help of ChangePasswordService
  /*****************************************************/
  $scope.changePassword = function(formObj) {
    $scope.msg = '';
    var userData = "old_password=" + $scope.old_password+ "&password=" + $scope.password+ "&confirm_password=" + $scope.confirm_password;   

    ChangePasswordService.makeAsyncCall(ChangePasswordService.changePassword(userData))
    .then(function(response){
      if(response.data.success == "true")
      {
        var userData = "id=" + response.data.userDetails.id + "&email=" + response.data.userDetails.username + "&profilePicture=" + response.data.userDetails.profile_picture + "&phoneNumber=" + response.data.userDetails.phone_number; 

        var userDataForLocal = {
          user_id     : response.data.userDetails.id,
          email       : response.data.userDetails.username,
          profilePicture  : response.data.userDetails.profile_picture,
          phoneNumber   : response.data.userDetails.phone_number,
          password    : response.data.userDetails.password,
        }   
        localStorage.removeItem('userDataForLocal');
        localStorage.setItem("userDataForLocal", JSON.stringify(userDataForLocal));   
        $window.location.href = baseUrl + '/view-change-password';
      } else {  
        var msg = response.data.message; 
        $rootScope.danger = msg;  
        $rootScope.msgShow();       
      }
        },function(reason){}).finally(function(data){

        });
  }
}
