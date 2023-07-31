'use strict';

/*****************************************************/
  // PetrolpumpPaymentController           
  // Functionality: Petrolpump list
  // Author : Debamala Dey                                 
  // Created Date : 05/09/2018                                        
  // Purpose:  Developing the functionalities of Petrolpump
/*****************************************************/

function PetrolpumpPaymentController($rootScope, $scope, $http, $window, $q, $location, $timeout, PetrolPumpsService) {

  $scope.titleChange = '<h1>Petrolpump Laser</h1>';
  $rootScope.successMesg = '';
  $scope.status      = 'I';

   /*****************************************************/
    // Function name : viewPetrolpumpList
    // Functionality: View Petrolpump List
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : Developing the functionality of listing Petrolpump with the help of PetrolPumpsService
  /*****************************************************/
  $scope.viewPetrolpumpList = function() {  

    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.allPetrolPumpList())
    .then(function(response){
      if(response.data.success == "true"){
        $scope.records = response.data.petrolpumpList;
         
      }else{  
        var msg = 'Error'; 
        $rootScope.danger = msg;        
      }
    },function(reason){}).finally(function(data){

    });
  }
   /*****************************************************/
    // Function name : addPetrolpumpPayment
    // Functionality: Add Petrolpump Payment
    // Author : Debamala Dey                                 
    // Created Date : 05/09/2018                                          
    // Purpose : Developing the functionality of add Petrolpump payment with the help of PetrolPumpsService
  /*****************************************************/
  $scope.addPetrolpumpPayment = function() {  

    var petrolPumpData = "petrolpump_id=" + $scope.selectPetrolpump +"&amount=" + $scope.amount + "&description=" + $scope.description; 
    /*for Edit and Save petrolPump*/
    PetrolPumpsService.makeAsyncCall(PetrolPumpsService.savePetrolPumpPay(petrolPumpData))
    .then(function(response){
      if(response.data.success == "true"){
        $rootScope.disableSubmitButton(); /*disable submit button after form submission*/
        window.location.href =  baseUrl + "/pay-to-petrolpump";
      } else{  
        var msg = 'Something Error Happened'; 
        $rootScope.danger = msg;
        $rootScope.msgShow();        
      }
        },function(reason){}).finally(function(data){

    });
  }
  
}
