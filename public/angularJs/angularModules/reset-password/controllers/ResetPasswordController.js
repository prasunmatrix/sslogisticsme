'use strict';

/*****************************************************/
  // Reset Password Controller             
  // Function name : ResetPasswordController
  // Functionality: reset password
  // Author : Sanchari Ghosh                                 
  // Created Date : 01/08/2018                                        
  // Purpose:  Developing the functionality of reset password
/*****************************************************/

function ResetPasswordController($rootScope, $scope, $http, $window, $q, $location, $timeout, ResetPasswordService) {
  $rootScope.successMesg = '';


   /*****************************************************/
    // Function name : viewResetPassword
    // Functionality: View Reset Password
    // Author : Sanchari Ghosh                               
    // Created Date : 01/08/2018                                        
    // Purpose:  View Reset Password
  /*****************************************************/
  $scope.viewResetPassword = function(formObj) {
    $scope.token = $location.absUrl();
  } 
 
   /*****************************************************/
    // Function name : resetPassword
    // Functionality: Reset Password
    // Author : Sanchari Ghosh                               
    // Created Date : 01/08/2018                                        
    // Purpose:  Developing the functionality of of reset password with the help of ResetPasswordService
  /*****************************************************/
  $scope.resetPassword = function(formObj) {
    //$scope.msg = '';
    
    var userData = "password=" + $scope.password + "&token=" + $scope.token;   

    ResetPasswordService.makeAsyncCall(ResetPasswordService.resetPassword(userData))
    .then(function(response){
      if(response.data.success == "true"){
        $window.location.href = baseUrl + '/';
      } else{  
        var msg = response.data.msg; 
        $rootScope.danger = msg;  
        $rootScope.msgShow();          
      }
        },function(reason){}).finally(function(data){

        });

  }
}
