'use strict';

/*****************************************************/
  // Forgot Password Controller             
  // Function name : ForgotPasswordController
  // Functionality: forgot password
  // Author : Sanchari Ghosh                                 
  // Created Date : 31/07/2018                                        
  // Purpose:  Developing the functionality of frgot password
/*****************************************************/

function ForgotPasswordController($rootScope, $scope, $http, $window, $q, $location, $timeout, ForgotPasswordService) {
  $rootScope.successMesg = '';

  
   /*****************************************************/
    // Function name : forgotPassword
    // Functionality: Forgot Password
    // Author : Sanchari Ghosh                               
    // Created Date : 31/07/2018                                        
    // Purpose:  Developing the functionality of of forgot password with the help of ForgotPasswordService
  /*****************************************************/
  $scope.forgotPassword = function(formObj) {
    $scope.showLoader = true; 

    /*reducing opacity of background while loader is shown*/
    $scope.hideBox = {
        "opacity": "0.1", 
        "pointer-events" : "none"
    }

    //$rootScope.spinner.on();
    $scope.msg = '';
        
    var userData = "email=" + $scope.email;   

    ForgotPasswordService.makeAsyncCall(ForgotPasswordService.forgotPassword(userData))
    .then(function(response){
      if(response.data.success == "true"){
        $window.location.href = baseUrl + '/';
      } else{  
        var msg = 'This Email Id does not match with any of our data'; 
        $rootScope.danger = msg; 
        $scope.showLoader = false; 
        $scope.hideBox = {
            "opacity": "1", 
            "pointer-events" : "default"
        }  
        $rootScope.msgShow();      
      }
        },function(reason){}).finally(function(data){
            //$rootScope.spinner.off(); 
        });
  }
}
